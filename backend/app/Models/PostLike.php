<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    protected $hidden = [
        'created_at', 'updated_at', 'isNew'
    ];

    protected $fillable = ['post_id', 'user_id'];
}
