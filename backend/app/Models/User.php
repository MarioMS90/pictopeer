<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

/*
* Este modelo actua como su propio servicio como es convención en laravel,
* la otra alternativa habría sido utilizar el patrón repositorio que añade una
* capa mas donde se realizarían las operaciones crud para cada modelo, esto
* se recomienda mas en proyectos grandes cuando se tienen varios controladores.
* https://medium.com/@cesiztel/repository-pattern-en-laravel-f66fcc9ea492
*
* Las ventajas de utilizar el modelo como servicio es que si utilizamos eloquent
* para acceder a la DB, laravel se va a encargar de gestionar los atributos del
* modelo seteando los valores la primera vez que accedemos a ese atributo.
*
* Por ejemplo, el metodo friendRequests() devuelve una instancia de eloquent,
* cuando accedemos al atributo friendRequests del usuario (no a la función)
* laravel va a ejecutar la funcion friendRequests(), accediendo a los datos de
* la BD y seteando el atributo de tal manera que la siguiente vez que accedamos
* no hará la consulta, ahorrando tiempo de ejecución.
*/

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'id', 'alias', 'email', 'password', 'photo_profile_url', 'new_user'
    ];

    protected $hidden = [
        'password', 'remember_token', 'two_factor_secret', 'two_factor_recovery_codes', 'created_at', 'updated_at', 'postsLiked'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasFriends()
    {
        return $this->friends->isNotEmpty();
    }

    public function hasPostsLiked()
    {
        return $this->postsLiked->isNotEmpty();
    }

    public function getPosts()
    {
        return Post::getPostsByUserIds([$this->id])->get();
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function likesReceived(): Collection
    {
        return PostLike::query()
            ->whereIn('post_id', $this->posts->pluck('id'))
            ->get();
    }

    public function postsLiked(): HasMany
    {
        return $this->hasMany(PostLike::class);
    }

    public function getFriends(): Collection
    {
        $firstQuery = DB::table('friends')
            ->join('users', 'friends.user_sender', '=', 'users.id')
            ->where(
                'friends.user_receiver',
                '=',
                $this->id
            )->where(
                'friends.status',
                '=',
                Config::get('enums.FRIEND_STATUS.ACCEPTED')
            )
            ->select('users.id', 'users.alias', 'users.email')
            ->selectRaw('users.photo_profile_url as photoProfileUrl');

        $friends = DB::table('friends')
            ->join('users', 'friends.user_receiver', '=', 'users.id')
            ->where(
                'friends.user_sender',
                '=',
                $this->id
            )->where(
                'friends.status',
                '=',
                Config::get('enums.FRIEND_STATUS.ACCEPTED')
            )
            ->select('users.id', 'users.alias', 'users.email')
            ->selectRaw('users.photo_profile_url as photoProfileUrl')
            ->union($firstQuery)->get();

        return $friends;
    }

    public function friendRequests(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'friends',
            'user_receiver',
            'user_sender'
        )->where(
            'status',
            '=',
            Config::get('enums.FRIEND_STATUS.PENDING')
        );
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function getUsersByUserIds($usersId): Collection
    {
        return DB::table('users')
            ->whereIn('users.id', $usersId)
            ->select('users.id', 'users.alias', 'users.email')
            ->selectRaw('users.photo_profile_url as photoProfileUrl')
            ->get();
    }
}
