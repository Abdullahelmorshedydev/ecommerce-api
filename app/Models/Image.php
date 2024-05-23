<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'morphable_type',
        'morphable_id',
        'image',
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
