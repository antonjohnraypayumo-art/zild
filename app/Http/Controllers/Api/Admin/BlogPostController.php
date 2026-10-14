<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class BlogPostController extends ResourceController
{
    protected function model(): string
    {
        return BlogPost::class;
    }

    protected function slugSource(): ?string
    {
        return 'title';
    }

    protected function rules(?Model $record = null): array
    {
        return [
            'title' => [...$this->req($record), 'string', 'max:255'],
            'slug' => ['sometimes', 'string', 'max:255', Rule::unique('blog_posts', 'slug')->ignore($record?->id)],
            'excerpt' => ['nullable', 'string'],
            'content' => [...$this->req($record), 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'is_published' => ['sometimes', 'boolean'],
            'published_at' => ['nullable', 'date'],
        ];
    }
}
