<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = ['name', 'position', 'bio', 'photo', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute(): ?string
    {
        return \App\Support\Media::url($this->photo);
    }
}
