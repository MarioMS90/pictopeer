<?php

namespace App\Http\Controllers\SuggestionStrategy;

use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DefaultSuggester implements Suggester
{
    /*
     * Se obtienen los cuatro usuarios mas populares (con mas amigos), para
     * ello realizo una consulta de la tabla friends relacionandola con la
     * tabla users, agrupo por usuario y cuento las veces que aparecen en la
     * tabla friends, tengo que usar union porque el mismo usuario puede estar
     * tanto en user_sender como en user_receiver (El que ha enviado o recibido
     * la solicitud de amistad).
     */
    public function getFriendsSuggestion($user): Collection
    {
        $unionQuery = DB::table('friends')
            ->join('users', 'users.id', '=', 'friends.user_receiver')
            ->where(
                'friends.status',
                '=',
                Config::get('enums.FRIEND_STATUS.ACCEPTED')
            )->select('users.*');

        $subquery = DB::table('friends')
            ->join('users', 'users.id', '=', 'friends.user_sender')
            ->where(
                'friends.status',
                '=',
                Config::get('enums.FRIEND_STATUS.ACCEPTED')
            )->select('users.*')
            ->unionAll($unionQuery);

        $query = DB::query()->fromSub($subquery, 'subquery')
            ->select('subquery.id')
            ->selectRaw('count(subquery.id) as friends_count')
            ->groupBy('subquery.id')
            ->orderBy('friends_count', 'desc')
            ->limit('4')
            ->get();

        return User::getUsersByUserIds($query->pluck('id'));
    }

    /*
     * Se obtienen los posts con mas likes relacionando la tabla posts
     * con la tabla likes, luego agrupo por publicación y cuento las veces que
     * aparecen en la tabla likes.
     */
    public function getPostsSuggestion($user): Builder
    {
        return DB::table('post_likes')
            ->join('posts', 'posts.id', '=', 'post_likes.post_id')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->groupBy('posts.id')
            ->select('posts.*', 'users.photo_profile_url', 'users.alias')
            ->selectRaw('count(post_likes.post_id) as likeCount')
            ->orderBy('likeCount', 'desc');
    }
}
