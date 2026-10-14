<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
    * POST /api/orders : the signed-in customer's cart becomes an order.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'payment_method' => ['required', Rule::in(Order::PAYMENT_METHODS)],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $authUser = $request->user('sanctum');
        abort_unless($authUser, 401);

        if (! $authUser->delivery_address
            || $authUser->delivery_latitude === null
            || $authUser->delivery_longitude === null) {
            throw ValidationException::withMessages([
                'delivery_location' => ['Save your delivery address and map pin before placing an order.'],
            ]);
        }

        $data['address'] = $authUser->delivery_address;
        $data['delivery_latitude'] = $authUser->delivery_latitude;
        $data['delivery_longitude'] = $authUser->delivery_longitude;

        if (! $authUser->phone) {
            throw ValidationException::withMessages(['account' => ['Add a phone number to your account before ordering.']]);
        }

        $cart = CartController::resolveCart($request);
        $summary = $cart->summary();

        if (count($summary['items']) === 0) {
            throw ValidationException::withMessages(['cart' => ['Your cart is empty.']]);
        }

        if (collect($summary['items'])->contains(fn ($i) => ! $i['is_available'])) {
            throw ValidationException::withMessages(['cart' => ['Some items in your cart are no longer available.']]);
        }

        $order = DB::transaction(function () use ($data, $summary, $cart, $authUser) {
            $paymentStatus = 'unpaid';

            if ($data['payment_method'] === 'credits') {
                $user = User::whereKey($authUser->id)->lockForUpdate()->first();

                if ((float) $user->credits < $summary['total']) {
                    throw ValidationException::withMessages(['payment_method' => ['Not enough credits for this order.']]);
                }

                $user->decrement('credits', $summary['total']);
                $paymentStatus = 'paid';
            }

            $order = Order::create($data + [
                'order_number' => Order::generateNumber(),
                'user_id' => $authUser?->id,
                'customer_name' => $authUser->name,
                'phone' => $authUser->phone,
                'payment_status' => $paymentStatus,
                'status' => 'pending',
                'subtotal' => $summary['subtotal'],
                'total' => $summary['total'],
            ]);

            foreach ($summary['items'] as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'product_size_id' => $item['product_size_id'],
                    'product_name' => $item['name'],
                    'size_name' => $item['size'],
                    'unit_price' => $item['unit_price'],
                    'quantity' => $item['quantity'],
                    'line_total' => $item['line_total'],
                ]);
            }

            $cart->items()->delete();

            return $order;
        });

        return response()->json($order->load('items'), 201);
    }

    /** GET /api/orders/track?order_number=ZC-...&phone=09... : guests look up an order with number + phone. */
    public function track(Request $request): JsonResponse
    {
        $data = $request->validate([
            'order_number' => ['required', 'string'],
            'phone' => ['required', 'string'],
        ]);

        $order = Order::with('items')
            ->where('order_number', $data['order_number'])
            ->where('phone', $data['phone'])
            ->firstOrFail();

        return response()->json($order);
    }

    /** GET /api/my-orders : order history of the logged-in customer. */
    public function mine(Request $request): JsonResponse
    {
        return response()->json(
            $request->user()->orders()->with('items')->latest()->paginate(15)
        );
    }
}
