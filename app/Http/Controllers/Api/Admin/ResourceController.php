<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/** Small base class so simple admin CRUD endpoints (categories, blog, team...) stay tiny. */
abstract class ResourceController extends Controller
{
    /** @return class-string<Model> */
    abstract protected function model(): string;

    /** Validation rules. $record is set on update (use it for "unique" ignores). */
    abstract protected function rules(?Model $record = null): array;

    /** Column to build a slug from when none is supplied (null = model has no slug). */
    protected function slugSource(): ?string
    {
        return null;
    }

    /** ['required'] on create, ['sometimes', 'required'] on update so PATCH can send partial data. */
    protected function req(?Model $record): array
    {
        return $record ? ['sometimes', 'required'] : ['required'];
    }

    public function index(): JsonResponse
    {
        return response()->json($this->model()::latest('id')->paginate(25));
    }

    public function show(string $id): JsonResponse
    {
        return response()->json($this->model()::findOrFail($id));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate($this->rules());
        $data = $this->withSlug($data);

        return response()->json($this->model()::create($data), 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $record = $this->model()::findOrFail($id);
        $data = $request->validate($this->rules($record));

        $record->update($data);

        return response()->json($record->fresh());
    }

    public function destroy(string $id): JsonResponse
    {
        $this->model()::findOrFail($id)->delete();

        return response()->json(null, 204);
    }

    protected function withSlug(array $data): array
    {
        $source = $this->slugSource();

        if ($source && empty($data['slug'])) {
            $base = Str::slug($data[$source]);
            $slug = $base;
            $i = 2;

            while ($this->model()::where('slug', $slug)->exists()) {
                $slug = $base . '-' . $i++;
            }

            $data['slug'] = $slug;
        }

        return $data;
    }
}
