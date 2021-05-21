<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use App\Models\Post;
use App\Http\Controllers\SuggestionStrategy\Suggester;
use App\Http\Controllers\SuggestionStrategy\SuggesterFactory;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use function React\Promise\map;

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

        $suggester = $this->getSuggesterByUserState($user);
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

        $suggester = $this->getSuggesterByUserState($user);
        $postSuggestions = $suggester->getPostsSuggestion($user);
        $friendPosts = Post::getPostsByUserIds($user->friends->pluck('id'));

        $paginateResult = $friendPosts->union($postSuggestions)
        ->orderBy('date', 'desc')
        ->cursorPaginate(self::POSTS_PER_PAGE)->toArray();
        $posts = $this->setHashtagsAndUserLikes($paginateResult['data'], $user->postsLiked);

        return response()->json([
            'posts' => $posts,
            'nextCursor' => $paginateResult['nextCursor']
        ]);
    }

     /*
     * Seteo en cada post su lista de hashtags y si el usuario le ha dado
     * like o no a ese post para poder mostrarlo en la vista.
     */
    private function setHashtagsAndUserLikes($posts, $postsLiked)
    {
        return collect($posts)->map(function ($post) use($postsLiked) {
            $post->hashtags = Hashtag::query()->join(
                'hashtag_post',
                'hashtag_post.hashtag_id',
                '=',
                'hashtags.id'
            )->where(
                'hashtag_post.post_id',
                '=',
                $post->id
            )->select('hashtags.name')->get();

            $post->postLiked = $postsLiked->some(function ($like) use($post){
                return $like->post_id == $post->id;
            });

            return $post;
        });
    }

    /*
     * Con esta función compruebo el estado del usuario para la recomendación 
     * de publicaciones, si ha dado algún like se retorna un recomendador del 
     * tipo hashtag, si no ha dado ningun like pero tiene amigos se retorna 
     * uno del tipo amigos comunes, si ninguna condición se cumple se 
     * retorna uno por defecto.
     */
    private function getSuggesterByUserState($user): Suggester
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
     * Devuelvo al usuario autenticado mediante token, tengo que setear la lista
     * de amigos, los posts y la cantidad de likes recibidos porque esos metodos
     * no devuelven una instancia del ORM Eloquent, sino que está hecha con
     * query builder, por lo tanto laravel no gestiona el modelo de forma
     * automatizada seteando el atributo como si hace con los demás métodos.
     */
    public function getAuthUser()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $user->friends = $user->getFriends();
        $user->posts = $user->getPosts();
        $user->likesReceivedCount = $user->likesReceived()->count();

        return $user;
    }
}
