<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'comment',
        'status',
        'blog_id',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
