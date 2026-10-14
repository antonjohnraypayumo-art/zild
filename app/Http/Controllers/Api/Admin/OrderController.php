<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /** GET /api/admin/orders?status=pending&search=ZC-2610 */
    public function index(Request $request): JsonResponse
    {
        $orders = Order::with('items')
            ->when($request->query('status'), fn ($q, $status) => $q->where('status', $status))
            ->when($request->query('search'), fn ($q, $term) => $q->where(fn ($w) => $w
                ->where('order_number', 'like', "%{$term}%")
                ->orWhere('customer_name', 'like', "%{$term}%")
                ->orWhere('phone', 'like', "%{$term}%")))
            ->latest()
            ->paginate(25);

        return response()->json($orders);
    }

    public function show(Order $order): JsonResponse
    {
        return response()->json($order->load(['items', 'user:id,name,email']));
    }

    /** PATCH /api/admin/orders/{id} : change status and/or payment status. */
    public function update(Request $request, Order $order): JsonResponse
    {
        $data = $request->validate([
            'status' => ['sometimes', Rule::in(Order::STATUSES)],
            'payment_status' => ['sometimes', Rule::in(['unpaid', 'paid', 'refunded'])],
        ]);

        DB::transaction(function () use ($order, $data) {
            $order = Order::whereKey($order->getKey())->lockForUpdate()->firstOrFail();

            if (isset($data['status']) && ! $order->canTransitionTo($data['status'])) {
                throw ValidationException::withMessages([
                    'status' => ["An order cannot move from {$order->status} to {$data['status']}."],
                ]);
            }

            if (isset($data['payment_status']) && ! $order->canTransitionPaymentTo($data['payment_status'])) {
                throw ValidationException::withMessages([
                    'payment_status' => ["A payment cannot move from {$order->payment_status} to {$data['payment_status']}."],
                ]);
            }

            $creditsWerePaid = $order->payment_method === 'credits'
                && $order->payment_status === 'paid'
                && $order->user_id;
            $paymentWasRefunded = $order->payment_status === 'refunded';
            $cancelledWithPaidCredits = ($data['status'] ?? null) === 'cancelled' && $creditsWerePaid;
            $markedAsRefunded = ($data['payment_status'] ?? null) === 'refunded';

            $order->update($data);

            if (! $paymentWasRefunded && $creditsWerePaid && ($cancelledWithPaidCredits || $markedAsRefunded)) {
                User::whereKey($order->user_id)->increment('credits', $order->total);
                $order->update(['payment_status' => 'refunded']);
            }
        });

        return response()->json($order->fresh()->load('items'));
    }
}
