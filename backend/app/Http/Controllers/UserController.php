<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Hashtag;
use App\Models\Post;
use App\Http\Controllers\SuggestionStrategy\Suggester;
use App\Http\Controllers\SuggestionStrategy\SuggesterFactory;
use App\Models\PostLike;
use App\Models\User;
use CURLFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    const POSTS_PER_PAGE = 6;

    /*
    * Devuelvo al usuario autenticado mediante token con todos los datos
    * necesarios para el frontend.
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
        $user->friendSuggestions = $this->removeColumnPriority($suggester->getFriendsSuggestion($user));

        $jsonResponse = response()->json($user);

        if ($user->new_user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['new_user' => false]);
        }

        return $jsonResponse;
    }

    public function getProfile($alias)
    {
        $userProfile = User::where('alias', $alias)->first();

        $userProfile->posts = $this->setHashtagsAndUserLikes(
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

        $isFriend = $user->getFriends()->some(function ($friend) use (
            $userProfile
        ) {
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

    private function removeColumnPriority($friendSuggestions)
    {
        return $friendSuggestions
            ->map(function ($friend) {
                unset($friend->priority);
                return $friend;
            });
    }

    /*
    * Seteo en cada post su lista de hashtags y si el usuario le ha dado
    * like o no a ese post para poder mostrarlo en la vista.
    */
    private function setHashtagsAndUserLikes($posts, $postsLiked)
    {
        return collect($posts)->map(function ($post) use ($postsLiked) {
            $post->hashtags = DB::table('hashtags')->join(
                'hashtag_post',
                'hashtag_post.hashtag_id',
                '=',
                'hashtags.id'
            )->where(
                'hashtag_post.post_id',
                '=',
                $post->id
            )->select('hashtags.name')->get();

            $post->postLiked = $postsLiked->some(function ($like) use ($post) {
                return $like->post_id == $post->id;
            });

            return $post;
        });
    }

    /*
    * Endpoint para retornar posts paginados mezclo tanto los posts de
    * los amigos del usuario como los posts recomendados y los ordeno
    * por fecha, de esta forma voy creando una lista fluida de posts que
    * al usuario le gustaría ver.
    *
    * Para realizar la paginación he usado cursores utilizando la
    * biblioteca cursor-pagination que gestiona las colas de paginación
    * indicando cual es el siguiente cursor, de tal manera que al front
    * le devuelvo la lista de posts y el cursor con el que
    * debe de hacer la siguiente petición.
    */
    public function getHomePosts()
    {
        $user = $this->getAuthUser();
        $user->friends = $user->getFriends();

        $suggester = $this->getPostSuggesterByUserState($user);
        $postSuggestions = $suggester->getPostsSuggestion($user);
        $friendPosts = Post::getPostsByUserIds($user->friends->pluck('id'));

        $subquery = $postSuggestions->union($friendPosts);

        $paginateResult = DB::query()->fromSub($subquery, 'subquery')
            ->orderBy('date', 'desc')
            ->cursorPaginate(self::POSTS_PER_PAGE)->toArray();

        $posts = $this->setHashtagsAndUserLikes(
            $paginateResult['data'],
            $user->postsLiked
        );

        return response()->json([
            'posts' => $posts,
            'nextCursor' => $paginateResult['nextCursor']
        ]);
    }

    /*
     * Con esta función compruebo el estado del usuario para las sugerencias
     * de publicaciones, si ha dado algún like se retorna un suggester del
     * tipo hashtag, si no ha dado ningun like pero tiene amigos se retorna
     * uno del tipo amigos comunes, si ninguna condición se cumple se
     * retorna uno por defecto.
     */
    private function getPostSuggesterByUserState($user): Suggester
    {
        switch ($user) {
            case $user->hasPostsLiked():
                return SuggesterFactory::getSuggester(SuggesterFactory::HASHTAGS_SUGGESTER);
            case $user->hasFriends():
                return SuggesterFactory::getSuggester(SuggesterFactory::MUTUAL_FRIENDS_SUGGESTER);
            default:
                return SuggesterFactory::getSuggester(SuggesterFactory::DEFAULT_SUGGESTER);
        }
    }

    /*
     * Igual que la anterior función compruebo el estado del usuario para las
     * sugerencias de amistad, en este caso priorizo que el usuario tiene
     * amigos para retornar un suggester basado en amigos en común.
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

    public function createPost(Request $request)
    {
        $image = $request->file('image');
        $hashtags = collect(json_decode($request->hashtags));

        $uploadResponse = $this->uploadImage($image);
        $user = $this->getAuthUser();

        if ($uploadResponse['success']) {
            $photoUrl = $uploadResponse['data']['link'];

            $post = new Post([
                'user_id' => $user->id,
                'photo_url' => $photoUrl,
                'date' => date('Y-m-d')
            ]);
            $post->save();

            $hashtags->each(function($hashtag) use ($post){
                if (substr($hashtag, 0, 1) != '#') {
                    $hashtag = "#" . $hashtag;
                };

                $hashtagFromDB = Hashtag::query()->where(
                    'name',
                    '=',
                    $hashtag
                )->first();

                if ($hashtagFromDB == null) {
                    $hashtagFromDB = new Hashtag([
                        'name' => $hashtag,
                    ]);
                    $hashtagFromDB->save();
                }

                $post->hashtags()->attach($hashtagFromDB);
            });
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function createLike(Request $request)
    {
        $like = new PostLike([
            'post_id' => $request->postId,
            'user_id' => $request->userId,
        ]);
        $like->save();

        return response()->json([
            'success' => true,
        ]);
    }

    public function updateProfileImage(Request $request)
    {
        $image = $request->file('image');
        $uploadResponse = $this->uploadImage($image);
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

    public function uploadImage($image)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.imgur.com/3/upload',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'image' => new CURLFILE($image)
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Client-ID 546c25a59c58ad7'
                //.env('IMGUR_CLIENT_ID'),
            ),
        ));

        $response = curl_exec($curl);
        if ($error = curl_error($curl)) {
            die('cURL error:'.$error);
        }

        curl_close($curl);
        return json_decode($response, true);
    }

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

    public function deleteLike($postId)
    {
        $user = $this->getAuthUser();
        $like = PostLike::where('post_id', '=', $postId)
            ->where('user_id', '=', $user->id)
            ->first();

        $like->delete();
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

    public function updateFriendRequest(Request $request)
    {
        DB::table('friends')
            ->where('id', $request->id)
            ->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
        ]);
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

    /*
     * Devuelvo al usuario autenticado mediante token y seteo los parámetros
     * necesarias.
     */
    public function getAuthUser()
    {
        $user = JWTAuth::parseToken()->authenticate();

        return $user;
    }
}
