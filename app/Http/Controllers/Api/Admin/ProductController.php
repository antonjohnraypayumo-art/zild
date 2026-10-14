<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $products = Product::with(['category:id,name,slug', 'sizes'])
            ->when($request->query('category_id'), fn ($q, $id) => $q->where('category_id', $id))
            ->when($request->query('q'), fn ($q, $term) => $q->where('name', 'like', "%{$term}%"))
            ->orderBy('category_id')->orderBy('id')
            ->paginate(25);

        return response()->json($products);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json($product->load(['category:id,name,slug', 'sizes']));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate($this->rules());

        $product = DB::transaction(function () use ($request, $data) {
            $product = Product::create($this->productFields($request, $data) + ['slug' => $this->uniqueSlug($data['name'])]);
            $this->syncSizes($product, $data['sizes'] ?? []);

            return $product;
        });

        return response()->json($product->load('sizes'), 201);
    }

    public function update(Request $request, Product $product): JsonResponse
    {
        $data = $request->validate($this->rules($product));

        DB::transaction(function () use ($request, $product, $data) {
            $product->update($this->productFields($request, $data));

            if (array_key_exists('sizes', $data)) {
                $this->syncSizes($product, $data['sizes'] ?? []);
            }
        });

        return response()->json($product->fresh()->load('sizes'));
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete(); // cart items and sizes cascade; past order items keep their snapshot

        return response()->json(null, 204);
    }

    private function rules(?Product $product = null): array
    {
        $required = $product ? ['sometimes', 'required'] : ['required'];

        return [
            'category_id' => [...$required, 'integer', 'exists:categories,id'],
            'name' => [...$required, 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => [...$required, 'numeric', 'min:0', 'max:99999999.99'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'is_available' => ['sometimes', 'boolean'],
            'is_featured' => ['sometimes', 'boolean'],
            'sizes' => ['sometimes', 'array'],
            'sizes.*.name' => ['required', 'string', 'max:60'],
            'sizes.*.code' => ['required', 'string', 'max:40', 'distinct'],
            'sizes.*.price_modifier' => ['nullable', 'numeric', 'min:-99999999.99', 'max:99999999.99'],
            'sizes.*.is_default' => ['sometimes', 'boolean'],
        ];
    }

    /** Only the products-table columns; handles an optional uploaded image (needs `php artisan storage:link`). */
    private function productFields(Request $request, array $data): array
    {
        $fields = collect($data)->except(['sizes', 'image_file'])->all();

        if ($request->hasFile('image_file')) {
            $fields['image'] = 'storage/' . $request->file('image_file')->store('products', 'public');
        }

        return $fields;
    }

    private function syncSizes(Product $product, array $sizes): void
    {
        $product->sizes()->delete();

        foreach (array_values($sizes) as $i => $size) {
            $product->sizes()->create([
                'name' => $size['name'],
                'code' => $size['code'],
                'price_modifier' => $size['price_modifier'] ?? 0,
                'is_default' => $size['is_default'] ?? false,
                'sort_order' => $i,
            ]);
        }
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'product';
        $slug = $base;
        $i = 2;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
