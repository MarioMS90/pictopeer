<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\SuggestionStrategy\Suggester;
use App\Http\Controllers\SuggestionStrategy\SuggesterFactory;
use App\Models\PostLike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
        $user->posts = $user->getPosts();
        $user->likesReceivedCount = $user->likesReceived()->count();
        $user->newLikesReceived = $user->likesReceived()->filter(function (
            $like
        ) {
            return $like->is_new;
        });
        $user->friendRequests = $user->friendRequests();

        $suggester = $this->getFriendSuggesterByUserState($user);
        $user->friendSuggestions = $this->removeColumnPriority($suggester->getFriendsSuggestion($user));

        return response()->json($user);
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
    public function getPosts()
    {
        $user = $this->getAuthUser();
        $user->friends = $user->getFriends();

        $suggester = $this->getPostSuggesterByUserState($user);
        $postSuggestions = $suggester->getPostsSuggestion($user);
        $friendPosts = Post::getPostsByUserIds($user->friends->pluck('id'));

        $paginateResult = $friendPosts->union($postSuggestions)
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

    public function updateFriendRequest(Request $request)
    {
        DB::table('friends')
            ->where('id', $request->id)
            ->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
        ]);
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
