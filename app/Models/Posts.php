<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $cast = [
        "share" => "boolean",
    ];

    protected $fillable = [
        'title', 'sub_content', 'content', 'user_id', ' category_id', 'views', 'share', 'image'
    ];
}
