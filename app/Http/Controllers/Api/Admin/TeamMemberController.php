<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Model;

class TeamMemberController extends ResourceController
{
    protected function model(): string
    {
        return TeamMember::class;
    }

    protected function rules(?Model $record = null): array
    {
        return [
            'name' => [...$this->req($record), 'string', 'max:255'],
            'position' => [...$this->req($record), 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
