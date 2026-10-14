<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Review;
use Illuminate\Database\Eloquent\Model;

/** Moderation: list all reviews, approve/hide (PATCH is_approved), delete. */
class ReviewController extends ResourceController
{
    protected function model(): string
    {
        return Review::class;
    }

    protected function rules(?Model $record = null): array
    {
        return [
            'customer_name' => ['sometimes', 'string', 'max:255'],
            'rating' => ['sometimes', 'integer', 'between:1,5'],
            'comment' => ['sometimes', 'string', 'max:2000'],
            'is_approved' => ['sometimes', 'boolean'],
        ];
    }
}
