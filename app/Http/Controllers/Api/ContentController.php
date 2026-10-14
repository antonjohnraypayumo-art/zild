<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\Review;
use App\Models\Setting;
use App\Models\TeamMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/** Read-only website content (blog, team, reviews, settings) plus the contact and review forms. */
class ContentController extends Controller
{
    public function blog(): JsonResponse
    {
        return response()->json(
            BlogPost::published()->latest('published_at')->latest('id')
                ->get(['id', 'title', 'slug', 'excerpt', 'image', 'published_at'])
        );
    }

    public function blogPost(string $slug): JsonResponse
    {
        return response()->json(BlogPost::published()->where('slug', $slug)->firstOrFail());
    }

    public function team(): JsonResponse
    {
        return response()->json(TeamMember::where('is_active', true)->orderBy('sort_order')->get());
    }

    public function reviews(): JsonResponse
    {
        return response()->json(Review::where('is_approved', true)->latest()->get());
    }

    public function storeReview(Request $request): JsonResponse
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['required', 'string', 'max:2000'],
        ]);

        Review::create($data); // is_approved defaults to false; an admin approves it first

        return response()->json(['message' => 'Thank you! Your review will appear once approved.'], 201);
    }

    public function settings(): JsonResponse
    {
        return response()->json(Setting::allAsMap());
    }

    public function contact(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::create($data);

        return response()->json(['message' => 'Message sent. We will get back to you soon!'], 201);
    }
}
