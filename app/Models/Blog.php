<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;

    const IMG_URL = '/blog';

    protected $fillable = [
        'title',
        'article',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'morphable');
    }

    public function getImageAttribute()
    {
        return Storage::url($this->image()->first()->image);
    }
}
