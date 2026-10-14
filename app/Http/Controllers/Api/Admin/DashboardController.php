<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $notCancelled = fn ($q) => $q->where('status', '!=', 'cancelled');

        return response()->json([
            'orders_today' => Order::whereDate('created_at', today())->where($notCancelled)->count(),
            'revenue_today' => (float) Order::whereDate('created_at', today())->where($notCancelled)->sum('total'),
            'revenue_total' => (float) Order::where($notCancelled)->sum('total'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'products' => Product::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'reviews_waiting' => Review::where('is_approved', false)->count(),
            'top_products' => OrderItem::select('product_name', DB::raw('SUM(quantity) as units'), DB::raw('SUM(line_total) as revenue'))
                ->groupBy('product_name')
                ->orderByDesc('units')
                ->limit(5)
                ->get(),
        ]);
    }
}
