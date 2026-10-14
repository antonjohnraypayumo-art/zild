<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Server-side shopping cart. The browser keeps the cart "token" (returned in the JSON body and the
 * X-Cart-Token response header) and sends it back in the X-Cart-Token request header.
 */
class CartController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        return $this->respond($this->resolveCart($request));
    }

    public function addItem(Request $request): JsonResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'product_size_id' => ['nullable', 'integer', 'exists:product_sizes,id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:50'],
        ]);

        $product = Product::with('sizes')->findOrFail($data['product_id']);

        if (! $product->is_available) {
            throw ValidationException::withMessages(['product_id' => ['This product is currently unavailable.']]);
        }

        $sizeId = $data['product_size_id'] ?? null;

        // A product that has sizes needs one; fall back to its default size like the menu pop-up does.
        if ($sizeId === null && $product->sizes->isNotEmpty()) {
            $sizeId = ($product->sizes->firstWhere('is_default', true) ?? $product->sizes->first())->id;
        }

        if ($sizeId !== null && ! $product->sizes->contains('id', $sizeId)) {
            throw ValidationException::withMessages(['product_size_id' => ['That size does not belong to this product.']]);
        }

        $cart = $this->resolveCart($request);
        $quantity = $data['quantity'] ?? 1;

        $item = $cart->items()->where('product_id', $product->id)->where('product_size_id', $sizeId)->first();

        if ($item) {
            $item->update(['quantity' => min(50, $item->quantity + $quantity)]);
        } else {
            $cart->items()->create(['product_id' => $product->id, 'product_size_id' => $sizeId, 'quantity' => $quantity]);
        }

        return $this->respond($cart, 201);
    }

    public function updateItem(Request $request, CartItem $item): JsonResponse
    {
        $cart = $this->resolveCart($request);
        abort_unless($item->cart_id === $cart->id, 404);

        $data = $request->validate(['quantity' => ['required', 'integer', 'min:1', 'max:50']]);
        $item->update($data);

        return $this->respond($cart);
    }

    public function removeItem(Request $request, CartItem $item): JsonResponse
    {
        $cart = $this->resolveCart($request);
        abort_unless($item->cart_id === $cart->id, 404);

        $item->delete();

        return $this->respond($cart);
    }

    public function clear(Request $request): JsonResponse
    {
        $cart = $this->resolveCart($request);
        $cart->items()->delete();

        return $this->respond($cart);
    }

    /** Find the cart for the X-Cart-Token header, or start a new one. */
    public static function resolveCart(Request $request): Cart
    {
        if ($token = $request->header('X-Cart-Token')) {
            if ($cart = Cart::where('token', $token)->first()) {
                if (! $cart->user_id && ($user = $request->user('sanctum'))) {
                    $cart->update(['user_id' => $user->id]);
                }

                return $cart;
            }
        }

        return Cart::create([
            'token' => (string) Str::uuid(),
            'user_id' => $request->user('sanctum')?->id,
        ]);
    }

    private function respond(Cart $cart, int $status = 200): JsonResponse
    {
        return response()->json($cart->summary(), $status)->header('X-Cart-Token', $cart->token);
    }
}
