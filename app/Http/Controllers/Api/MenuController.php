<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /** GET /api/menu : every category with its available products and sizes (drinks.html + foods.html). */
    public function menu(): JsonResponse
    {
        return response()->json(
            Category::orderBy('sort_order')
                ->with(['products' => fn ($q) => $q->where('is_available', true)->orderBy('id')->with('sizes')])
                ->get()
        );
    }

    /** GET /api/products?category=drinks&q=matcha&featured=1 */
    public function products(Request $request): JsonResponse
    {
        $products = Product::query()
            ->where('is_available', true)
            ->with(['category:id,name,slug', 'sizes'])
            ->when($request->query('category'), fn ($q, $slug) => $q->whereHas('category', fn ($c) => $c->where('slug', $slug)))
            ->when($request->query('q'), fn ($q, $term) => $q->where(fn ($w) => $w
                ->where('name', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%")))
            ->when($request->boolean('featured'), fn ($q) => $q->where('is_featured', true))
            ->orderBy('category_id')->orderBy('id')
            ->get();

        return response()->json($products);
    }

    public function show(string $slug): JsonResponse
    {
        return response()->json(
            Product::where('slug', $slug)->where('is_available', true)->with(['category:id,name,slug', 'sizes'])->firstOrFail()
        );
    }
}
