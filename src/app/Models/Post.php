<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// week46　論理削除
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'image_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}