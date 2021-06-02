<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'id',
        'movie_id',
        'user_id',
        'comment',
        'created_at',
        'updated_at'
    ];


    public function user() {
        return $this->hasOne('App\Models\User','user_id','id');
    }


}
