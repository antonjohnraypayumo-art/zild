<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class CategoryController extends ResourceController
{
    protected function model(): string
    {
        return Category::class;
    }

    protected function slugSource(): ?string
    {
        return 'name';
    }

    protected function rules(?Model $record = null): array
    {
        return [
            'name' => [...$this->req($record), 'string', 'max:255', Rule::unique('categories', 'name')->ignore($record?->id)],
            'slug' => ['sometimes', 'string', 'max:255', Rule::unique('categories', 'slug')->ignore($record?->id)],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
        ];
    }
}
