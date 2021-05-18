<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\SuggestionStrategy\Suggester;
use App\Http\Controllers\SuggestionStrategy\SuggesterFactory;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    const POSTS_PER_PAGE = 6;

    public function getUser()
    {
        $user = $this->getAuthUser();

        $suggester = $this->getSuggesterByUserState($user);
        $user->friendSuggestions = $suggester->getFriendsSuggestion($user)
            ->map(function ($friend) {
                unset($friend->priority);
                return $friend;
            });

        return response()->json([
            'user' => [
                'id' => $user->id,
                'alias' => $user->alias,
                'email' => $user->email,
                'photoProfileUrl' => $user->photo_profile_url,
                'friends' => $user->friends,
                'posts' => $user->posts,
                'friendSuggestions' => $user->friendSuggestions,
                'likesReceived' => $user->likesReceived
            ]
        ]);
    }

    public function getPosts(): JsonResponse
    {
        $user = $this->getAuthUser();

        $suggester = $this->getSuggesterByUserState($user);
        $postSuggestions = $suggester->getPostsSuggestion($user);
        $friendPosts = Post::getPostsByUserIds($user->friends->pluck('id'));

        $posts = $friendPosts->union($postSuggestions)->cursorPaginate(self::POSTS_PER_PAGE);

        return response()->json([
            'posts' => $posts,
        ]);
    }

    /*
     * En caso de que el usuario tenga amigos, se le recomiendan usuarios
     * basados en amigos en común, si no tiene amigos pero ha dado like a
     * alguna publicación se le sugieren usuarios basados en sus gustos, si
     * ninguna condición se cumple se realizan recomendaciones por defecto
     * basadas en los usuarios y publicaciones mas populares.
     */
    private function getSuggesterByUserState($user): Suggester
    {
        switch ($user) {
            case $user->hasLikesGiven():
                return SuggesterFactory::getSuggester(SuggesterFactory::HASHTAGS_SUGGESTER);
            case $user->hasFriends():
                return SuggesterFactory::getSuggester(SuggesterFactory::MUTUAL_FRIENDS_SUGGESTER);
            default:
                return SuggesterFactory::getSuggester(SuggesterFactory::DEFAULT_SUGGESTER);
        }
    }

    /*
     * Devuelvo al usuario autenticado mediante token, tengo que setear la lista
     * de amigos, los posts y los likes recibidos porque el metodo getFriends()
     * no devuelve una instancia del ORM Eloquent, sino que está hecha con
     * query builder, por lo tanto laravel no gestiona el modelo de forma
     * automatizada seteando el atributo como si hace con los demás métodos.
     */
    public function getAuthUser()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $user->friends = $user->getFriends();
        $user->posts = $user->getPosts();
        $user->likesReceived = $user->getLikesReceived();

        return $user;
    }
}
