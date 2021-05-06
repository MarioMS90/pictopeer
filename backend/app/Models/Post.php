<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    /*
     * Con esta funcion obtengo los posts de una lista de usuarios, los post
     * tienen que llevar la cantidad de likes, el alias y la foto de perfil de
     * cada usuario que lo ha publicado para mostrarlo en cada post.
     */
    public static function getPostsByUserIds($users): Collection
    {
        if ($users->isEmpty()) {
            return new Collection();
        }

        return DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('post_likes', 'post_likes.post_id', '=', 'posts.id')
            ->whereIn('posts.user_id', $users)
            ->select('posts.*', 'users.photo_profile_url', 'users.alias')
            ->selectRaw('count(post_likes.id) as likeCount')
            ->groupBy('posts.id')->get();
    }

    public function hashtags(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Hashtag');
    }
}
