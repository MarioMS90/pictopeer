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


    public function hashtags(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Hashtag');
    }

    /*
     * Con esta funcion obtengo las publicaciones de una lista de usuarios,
     * tienen que incluir la cantidad de likes, el alias y la foto de perfil de
     * cada usuario para poder mostrarlo junto con la publicación en la vista.
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

    /*
    * Metodo para setear en cada post su lista de hashtags y si el usuario
    * logeado le ha dado me gusta o no a esa publicación.
    */
    public static function setHashtagsAndUserLikes($posts, $postsLiked)
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
}
