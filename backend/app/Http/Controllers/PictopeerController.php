<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Models\Post;
use App\Models\SuggestionStrategy\HashtagsSuggester;
use App\Models\SuggestionStrategy\MutualFriendsSuggester;
use App\Models\SuggestionStrategy\Suggester;
use App\Models\SuggestionStrategy\SuggesterFactory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class PictopeerController extends Controller
{
    /*
     * En esta funcion obtengo todos los datos necesarios para generar la
     * vista home, tengo que setear la lista de amigos del usuario porque el
     * metodo getFriends() no devuelve una instancia del ORM Eloquent, sino
     * que está hecha con query builder, por lo tanto laravel no gestiona el
     * modelo de forma automatizada seteando el atributo como si hace con los
     * demás métodos.
     */
    public function index()
    {
        $user = Auth::user();
        $user->friends = $user->getFriends();

        $suggester = $this->getSuggesterByUserState($user);
        $friendSuggestions = $suggester->getFriendsSuggestion($user);
        $friendPosts = Post::getPostsByUserIds($user->friends->pluck('id'));
        $posts = $suggester->getPostsSuggestion($user)->merge($friendPosts)->sortByDesc('date');

        return view(
            'pages.home',
            [
                'user' => $user,
                'notifications' => $user->notifications,
                'friendRequests' => $user->friendRequests,
                'posts' => $posts,
                'likesGiven' => $user->likesGiven,
                'friendSuggestions' => $friendSuggestions,
            ]
        );
    }

    public function profile()
    {
        return view('pages.profile');
    }

    /*
     * En caso de que el usuario tenga amigos, se le recomiendan amigos basados
     * en amigos en común, si no tiene amigos pero ha dado like a alguna
     * publicación se le sugieren usuarios basados en sus gustos, si ninguna
     * condición se cumple se realizan recomendaciones por defecto basadas
     * en los usuarios y publicaciones mas populares.
     */
    private function getSuggesterByUserState($user): Suggester
    {
        switch ($user) {
            case $user->hasFriends():
                $type = SuggesterFactory::MUTUAL_FRIENDS_SUGGESTER;
                break;
            case $user->hasLikesGiven():
                $type = SuggesterFactory::HASHTAGS_SUGGESTER;
                break;
            default: $type = SuggesterFactory::DEFAULT_SUGGESTER;
        }

        return SuggesterFactory::getSuggester($type);
    }

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
}
