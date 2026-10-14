<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:30'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create($data);
        $this->claimGuestCart($request, $user);

        return response()->json([
            'user' => $user->fresh(),
            'token' => $user->createToken('auth')->plainTextToken,
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages(['email' => ['The provided credentials are incorrect.']]);
        }

        $this->claimGuestCart($request, $user);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('auth')->plainTextToken,
        ]);
    }

    public function customerLogin(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || $user->role !== 'customer' || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages(['email' => ['The provided credentials are incorrect.']]);
        }

        $this->claimGuestCart($request, $user);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('customer-auth')->plainTextToken,
        ]);
    }

    public function adminLogin(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! $user->isAdmin() || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages(['email' => ['The provided credentials are incorrect.']]);
        }

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('admin-auth')->plainTextToken,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out.']);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }

    public function updateDeliveryLocation(Request $request): JsonResponse
    {
        $data = $request->validate([
            'delivery_address' => ['required', 'string', 'max:1000'],
            'delivery_latitude' => ['required', 'numeric', 'between:-90,90'],
            'delivery_longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        $request->user()->update($data);

        return response()->json($request->user()->fresh());
    }

    /** If the visitor already had a guest cart, attach it to the account they just signed into. */
    private function claimGuestCart(Request $request, User $user): void
    {
        if ($token = $request->header('X-Cart-Token')) {
            Cart::where('token', $token)->whereNull('user_id')->update(['user_id' => $user->id]);
        }
    }
}
