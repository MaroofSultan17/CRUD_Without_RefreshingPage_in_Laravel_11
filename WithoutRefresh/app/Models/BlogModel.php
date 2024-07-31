<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    use HasFactory;
    protected $primarykey = "id";
    protected $table = "blog";
    protected $fillable = [
        'title',
        'image',
        'content'
    ];
}
