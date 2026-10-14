<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['customer_name', 'rating', 'comment', 'image', 'is_approved'];

    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): ?string
    {
        return \App\Support\Media::url($this->image);
    }
}
