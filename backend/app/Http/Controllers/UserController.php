<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\SuggestionStrategy\Suggester;
use App\Http\Controllers\SuggestionStrategy\SuggesterFactory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    const POSTS_PER_PAGE = 8;

    /*
     * En esta funcion devuelvo todos los datos necesarios del usuario,
     * tengo que setear la lista de amigos porque el metodo getFriends() no
     * devuelve una instancia del ORM Eloquent, sino que está hecha con query
     * builder, por lo tanto laravel no gestiona el modelo de forma
     * automatizada seteando el atributo como si hace con los demás métodos.
     */
    public function getUser()
    {
        $user = $this->getAuthUser();

        $suggester = $this->getSuggesterByUserState($user);
        $user->friendSuggestions = $suggester->getFriendsSuggestion($user);
        $friendPosts = Post::getPostsByUserIds($user->friends->pluck('id'));
        $user->postSuggestions = $suggester->getPostsSuggestion($user)->merge($friendPosts)->sortByDesc('date');

        return response()->json([
            'user' => 'hola'
        ]);
    }

    public function getPostSuggestions($page)
    {
        $user = $this->getAuthUser();

        if ($user->hasLikesGiven()) {
            $suggester = SuggesterFactory::getSuggester(SuggesterFactory::HASHTAGS_SUGGESTER);
        } else {
            $suggester = $this->getSuggesterByUserState($user);
        }

        $friendPosts = Post::getPostsByUserIds($user->friends->pluck('id'))->paginate(5,
        '*', 'page', $page);

        $nextPostsAmount = UserController::POSTS_PER_PAGE - $friendPosts->count();

        $postSuggestions = $suggester->getPostsSuggestion($user)->paginate($nextPostsAmount,
        '*', 'page', $page);

        /*$user->postSuggestions = $friendPosts->merge($postSuggestions)->sortByDesc('date');*/

        return response()->json([
            'posts' => $postSuggestions->count(),
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
            case $user->hasFriends():
                return SuggesterFactory::getSuggester(SuggesterFactory::MUTUAL_FRIENDS_SUGGESTER);
            case $user->hasLikesGiven():
                return SuggesterFactory::getSuggester(SuggesterFactory::HASHTAGS_SUGGESTER);
            default: return SuggesterFactory::getSuggester(SuggesterFactory::DEFAULT_SUGGESTER);
        }
    }

    public function getAuthUser()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $user->friends = $user->getFriends();

        return $user;
    }
}
