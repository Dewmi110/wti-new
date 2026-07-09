<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourInclusion;
use App\Models\TourExclusion;
use App\Models\CancellationPolicy;
use Illuminate\Http\Request;

class TourPolicyController extends Controller
{
    private const TYPES = ['inclusions', 'exclusions', 'cancellation-policies'];

    /**
     * Resolve the model class for a given tab type.
     */
    private function modelFor(string $type): string
    {
        return match ($type) {
            'inclusions'             => TourInclusion::class,
            'exclusions'             => TourExclusion::class,
            'cancellation-policies'  => CancellationPolicy::class,
            default => abort(404),
        };
    }

    public function index()
    {
        $inclusions = TourInclusion::latest()->get();
        $exclusions = TourExclusion::latest()->get();
        $cancellationPolicies = CancellationPolicy::latest()->get();

        return view('backend.tour_policies.index', compact(
            'inclusions', 'exclusions', 'cancellationPolicies'
        ));
    }

    public function store(Request $request, string $type)
    {
        if (! in_array($type, self::TYPES, true)) {
            abort(404);
        }

        $rules = [
            'title'  => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ];

        if ($type === 'cancellation-policies') {
            $rules['description'] = 'nullable|string';
        }

        $validated = $request->validate($rules);
        $validated['status'] = $request->has('status') ? 1 : 0;

        $modelClass = $this->modelFor($type);
        $modelClass::create($validated);

        return redirect()
            ->route('admin.tour-policies.index', ['tab' => $type])
            ->with('success', 'Item added successfully.');
    }

    public function update(Request $request, string $type, int $id)
    {
        if (! in_array($type, self::TYPES, true)) {
            abort(404);
        }

        $modelClass = $this->modelFor($type);
        $record = $modelClass::findOrFail($id);

        $rules = [
            'title'  => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ];

        if ($type === 'cancellation-policies') {
            $rules['description'] = 'nullable|string';
        }

        $validated = $request->validate($rules);
        $validated['status'] = $request->has('status') ? 1 : 0;

        $record->update($validated);

        return redirect()
            ->route('admin.tour-policies.index', ['tab' => $type])
            ->with('success', 'Item updated successfully.');
    }

    public function destroy(string $type, int $id)
    {
        if (! in_array($type, self::TYPES, true)) {
            abort(404);
        }

        $modelClass = $this->modelFor($type);
        $modelClass::findOrFail($id)->delete();

        return redirect()
            ->route('admin.tour-policies.index', ['tab' => $type])
            ->with('success', 'Item deleted.');
    }
}