<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Post extends Model
{

    protected $fillable = ['user_id', 'photo_url', 'date'];

    /*
     * Con esta funcion obtengo los posts de una lista de usuarios, los post
     * tienen que llevar la cantidad de likes, el alias y la foto de perfil de
     * cada usuario que lo ha publicado para mostrarlo en cada post.
     */
    public static function getPostsByUserIds($users): Builder
    {
        return DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('post_likes', 'post_likes.post_id', '=', 'posts.id')
            ->whereIn('posts.user_id', $users)
            ->select('posts.date', 'posts.id', 'users.alias')
            ->selectRaw('count(post_likes.id) as likeCount')
            ->selectRaw('users.photo_profile_url as photoProfileUrl')
            ->selectRaw('posts.photo_url as photoUrl')
            ->groupBy('posts.id');
    }

    public function hashtags(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Hashtag');
    }
}
