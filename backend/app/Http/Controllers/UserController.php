<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Post;
use App\Http\Controllers\SuggestionStrategy\Suggester;
use App\Http\Controllers\SuggestionStrategy\SuggesterFactory;
use App\Models\PostLike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    /*
    * Devuelvo al usuario autenticado mediante token con todos los datos
    * necesarios para la página de inicio de la app, las notificaciones
    * sugerencias de amistad...etc.
    */
    public function getUser()
    {
        $user = $this->getAuthUser();
        $user->friends = $user->getFriends();
        $user->newLikesReceived = $user->likesReceived()
            ->filter(function ($like) use ($user) {
                return $like->is_new && $like->user_id != $user->id;
            });
        $user->friendRequests = $user->friendRequests();

        $suggester = $this->getFriendSuggesterByUserState($user);
        $user->friendSuggestions = $suggester->getFriendsSuggestion($user);

        $jsonResponse = response()->json($user);
        if ($user->new_user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['new_user' => false]);
        }
        return $jsonResponse;
    }

    /*
    * Devuelvo la información del perfil del usuario que se ha visitado, con sus
    * publicaciones y las estadisticas que se muestran en cada perfil.
    */
    public function getProfile($alias)
    {
        $userProfile = User::where('alias', $alias)->first();

        $userProfile->posts = Post::setHashtagsAndUserLikes(
            $userProfile->getPosts(),
            $userProfile->postsLiked
        );
        $userProfile->likesReceivedCount = $userProfile->likesReceived()->count();

        $user = $this->getAuthUser();
        $friendRequest = DB::table('friends')
            ->where('friends.user_sender', $user->id)
            ->where('friends.user_receiver', $userProfile->id)
            ->select('friends.status')->first();

        if ($friendRequest) {
            $status = (int) $friendRequest->status;
        } else {
            $status = null;
        }

        $isFriend = $user->getFriends()
            ->some(function ($friend) use ($userProfile) {
                return $friend->id == $userProfile->id;
            });

        if ($isFriend) {
            $status = Config::get('enums.FRIEND_STATUS.ACCEPTED');
        }

        return response()->json([
            'id' => $userProfile->id,
            'alias' => $userProfile->alias,
            'photoProfileUrl' => $userProfile->photo_profile_url,
            'posts' => $userProfile->posts,
            'likesReceivedCount' => $userProfile->likesReceivedCount,
            'friendsCount' => $userProfile->getFriends()->count(),
            'friendStatus' => $status
        ]);
    }

    /*
     * Con esta función compruebo el estado del usuario para las sugerencias
     * de amistad, si el usuario tiene amigos se retorna un suggester del tipo
     * amigos comunes, si no tiene amigos pero ha dado algún like se retorna un
     * suggester del tipo hashtag, si ninguna condición se cumple se retorna uno
     * por defecto basado en popularidad.
     */
    private function getFriendSuggesterByUserState($user): Suggester
    {
        switch ($user) {
            case $user->hasFriends():
                return SuggesterFactory::getSuggester(SuggesterFactory::MUTUAL_FRIENDS_SUGGESTER);
            case $user->hasPostsLiked():
                return SuggesterFactory::getSuggester(SuggesterFactory::HASHTAGS_SUGGESTER);
            default:
                return SuggesterFactory::getSuggester(SuggesterFactory::DEFAULT_SUGGESTER);
        }
    }

    public function searchUsersByAlias($value)
    {
        $searchResults = DB::table('users')
            ->where("alias", "LIKE", "%{$value}%")
            ->select('alias', 'photo_profile_url')
            ->limit(50)
            ->get();

        return response()->json($searchResults);
    }

    public function updateProfileImage(Request $request)
    {
        $image = $request->file('image');
        $uploadResponse = ImageController::uploadImage($image);
        $user = $this->getAuthUser();

        if ($uploadResponse['success']) {
            $photoUrl = $uploadResponse['data']['link'];

            DB::table('users')
                ->where('id', $user->id)
                ->update(['photo_profile_url' => $photoUrl]);
        }

        return response()->json([
            'photoUrl' => $photoUrl
        ]);
    }

    /*
     * Endpoint para que el frontend confirme que el usuario ha visto las
     * últimas notificaciones sobre likes recibidos, modifico el campo is_new
     * y lo pongo en false para que no vuelvan a aparecer en su lista de
     * notificaciones.
     */
    public function updateLikesViewed(Request $request)
    {
        foreach ($request->all() as $like) {
            DB::table('post_likes')
                ->where('id', '=', $like['id'])
                ->update(['is_new' => false]);
        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function createFriendRequest(Request $request)
    {
        $friendRequest = DB::table('friends')
            ->where('friends.user_receiver', $request->idUserSender)
            ->where('friends.user_sender', $request->idUserReceiver)
            ->select('*')->first();

        if (!$friendRequest) {
            $friendRequest = new Friend([
                'user_sender' => $request->idUserSender,
                'user_receiver' => $request->idUserReceiver,
                'status' => $request->status,
            ]);
            $friendRequest->save();
        } else {
            DB::table('friends')
                ->where('id', $friendRequest->id)
                ->update(['status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')]);
        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function deleteFriend($friendId)
    {
        $user = $this->getAuthUser();
        $friend = Friend::where('user_sender', $user->id)
            ->where('user_receiver', $friendId)
            ->orWhere(function ($query) use ($user, $friendId) {
                $query->where('user_sender', $friendId)
                    ->where('user_receiver', $user->id);
            })->first();
        $friend->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function updateFriendRequest(Request $request)
    {
        DB::table('friends')
            ->where('id', $request->id)
            ->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
        ]);
    }

    private function getAuthUser()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return $user;
    }
}
