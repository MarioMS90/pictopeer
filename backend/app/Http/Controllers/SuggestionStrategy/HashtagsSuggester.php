<?php

namespace App\Http\Controllers\SuggestionStrategy;

use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\Query\Builder;

class HashtagsSuggester implements Suggester
{
    public function getFriendsSuggestion($user): Collection
    {
        return $this->getUsersByFavouriteHashtags($user)->slice(0,
            4)->map(function ($friend) {
            unset($friend->priority);
            return $friend;
        });
    }

    public function getPostsSuggestion($user): Builder
    {
        $users = $this->getUsersByFavouriteHashtags($user)->pluck('id');

        return Post::getPostsByUserIds($users);
    }

    /*
     * Se obtiene una lista de usuarios teniendo en cuenta que sus publicaciones
     * tengan los hashtags favoritos del usuario (a los que más likes ha dado),
     * se agrupan por id de usuario y se cuentan, de esta manera aparecen ordenados
     * por prioridad.
     */
    private function getUsersByFavouriteHashtags($user): Collection
    {
        $likesGiven = $user->postsLiked->pluck('post_id');

        $favouriteHashtags = DB::table('posts')
            ->join(
                'hashtag_post',
                'posts.id',
                '=',
                'hashtag_post.post_id'
            )->whereIn('hashtag_post.post_id', $likesGiven)
            ->select('hashtag_post.hashtag_id')
            ->selectRaw('count(hashtag_post.hashtag_id) as priority')
            ->groupBy('hashtag_post.hashtag_id')
            ->orderBy('priority', 'desc')
            ->get()->pluck('hashtag_id');

        return DB::table('posts')
            ->join(
                'hashtag_post',
                'posts.id',
                '=',
                'hashtag_post.post_id'
            )
            ->join(
                'users',
                'users.id',
                '=',
                'posts.user_id'
            )->whereIn('hashtag_post.hashtag_id', $favouriteHashtags)
            ->where('users.id', '!=', $user->id)
            ->select('users.id', 'users.alias', 'users.email')
            ->selectRaw('users.photo_profile_url as photoProfileUrl')
            ->selectRaw('count(users.id) as priority')
            ->groupBy('users.id')
            ->orderBy('priority', 'desc')->get();
    }
}
