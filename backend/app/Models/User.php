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
* no hará la consulta.
*/
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id', 'alias', 'email', 'password', 'photo_profile_url', 'new_user'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasFriends()
    {
        return $this->friends->isNotEmpty();
    }

    public function hasLikesGiven()
    {
        return $this->likesGiven->isNotEmpty();
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function likesGiven(): HasMany
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
            ->select('users.*');

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
            ->select('users.*')
            ->union($firstQuery)->get();

        return $friends->map(function ($user) {
            return new User((array) $user);
        });
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

    public static function getUsersByUserIds($usersId): Collection
    {
        $users = DB::table('users')
            ->select('users.*')
            ->whereIn('users.id', $usersId)
            ->get();

        return $users->map(function ($user) {
            return new User((array) $user);
        });
    }
}
