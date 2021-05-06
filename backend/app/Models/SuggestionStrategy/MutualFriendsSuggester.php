<?php

namespace App\Models\SuggestionStrategy;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MutualFriendsSuggester implements Suggester
{
    public function getFriendsSuggestion($user): Collection
    {
        $mutualFriends = $this->getMutualFriends($user);

        return User::getUsersByUserIds($mutualFriends);
    }

    public function getPostsSuggestion($user): Collection
    {
        $mutualFriends = $this->getMutualFriends($user);

        return Post::getPostsByUserIds($mutualFriends);
    }

    /*
     * Se obtienen los cuatro usuarios que mas amigos en común tienen con el
     * usuario logueado, esto lo hago haciendo una consulta de todos los
     * amigos de su lista de amigos, luego cuento las veces que se repiten y
     * los ordeno por ese campo, de esa forma me salen primero los que mas
     * relaciones en común tienen con el usuario, hay que usar union por lo ya
     * explicado en DefaultSuggester, y en esta caso también una subconsulta,
     * ya que el union y el groupBy no funcionan juntos, teniendo que hacerse
     * la consulta por separado.
     */
    private function getMutualFriends($user): Collection
    {
        $friendIds = $user->friends->pluck('id');

        $unionQuery = DB::table('friends')
            ->join(
                'users',
                'friends.user_sender',
                '=',
                'users.id'
            )->whereIn('friends.user_receiver', $friendIds)
            ->where(
                'friends.status',
                '=',
                Config::get('enums.FRIEND_STATUS.ACCEPTED')
            )->where('users.id', '!=', $user->id)
            ->whereNotIn('users.id', $friendIds)
            ->select('users.*');

        $subquery = DB::table('friends')
            ->join(
                'users',
                'friends.user_receiver',
                '=',
                'users.id'
            )->whereIn('friends.user_sender', $friendIds)
            ->where(
                'friends.status',
                '=',
                Config::get('enums.FRIEND_STATUS.ACCEPTED')
            )->where('users.id', '!=', $user->id)
            ->whereNotIn('users.id', $friendIds)
            ->select('users.*')
            ->unionAll($unionQuery);

        return DB::query()->fromSub($subquery, 'subquery')
            ->select('subquery.id')
            ->selectRaw('count(id) as priority')
            ->groupBy('id')
            ->orderBy('priority', 'desc')
            ->limit('4')
            ->get()->pluck('id');
    }
}
