<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class ContactMessageController extends ResourceController
{
    protected function model(): string
    {
        return ContactMessage::class;
    }

    protected function rules(?Model $record = null): array
    {
        return ['is_read' => ['sometimes', 'boolean']];
    }

    /** Opening a message marks it as read. */
    public function show(string $id): JsonResponse
    {
        $message = ContactMessage::findOrFail($id);

        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        return response()->json($message);
    }
}
