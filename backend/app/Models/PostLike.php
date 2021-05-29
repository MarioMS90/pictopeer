<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    protected $hidden = [
        'created_at', 'updated_at', 'is_new'
    ];

    protected $fillable = ['post_id', 'user_id'];
}
