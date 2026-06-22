<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourType;
use Illuminate\Support\Facades\Storage;

class TourTypeController extends Controller
{
    public function index()
    {
        $items = TourType::paginate(20);
        return view('backend.tour_types.index', compact('items'));
    }

     public function indexBanner()
    {
        $tourTypes = TourType::orderBy('type_name')->get();

        return view('backend.image_slider.index', compact('tourTypes'));
    }

    public function create()
    {
        return view('backend.tour_types.create');
    }

    public function createBanner(Request $request)
    {
        $tourTypes = TourType::orderBy('type_name')->get();

        $selectedTourType = null;
        if ($request->filled('tour_type_id')) {
            $selectedTourType = TourType::find($request->query('tour_type_id'));
        }

        return view('backend.image_slider.create_tour_banner', [
            'tourTypes'        => $tourTypes,
            'selectedTourType' => $selectedTourType,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['type_name' => 'required|string|max:255','status'=>'nullable|in:0,1']);
        TourType::create($data);
        return redirect()->route('admin.tour-types.index')->with('success','Type created');
    }

    public function storeBanner(Request $request)
    {
        $request->validate([
            'tour_type_id' => 'required|exists:tour_types,id',
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $tourType = TourType::findOrFail($request->tour_type_id);

        if ($tourType->banner_image) {
            Storage::disk('public')->delete($tourType->banner_image);
        }

        $imagePath = $request->file('image')->store('tour_banners', 'public');

        $tourType->update([
            'banner_image' => $imagePath,
        ]);

        return redirect()->route('admin.tour_banners.index')
            ->with('success', 'Tour banner saved successfully.');
    }

    public function edit(TourType $tourType)
    {
        return view('backend.tour_types.edit', ['item' => $tourType]);
    }

    public function update(Request $request, TourType $tourType)
    {
        $data = $request->validate(['type_name' => 'required|string|max:255','status'=>'nullable|in:0,1']);
        $tourType->update($data);
        return redirect()->route('admin.tour-types.index')->with('success','Type updated');
    }

    public function destroy(TourType $tourType)
    {
        $tourType->delete();
        return redirect()->route('admin.tour-types.index')->with('success','Type removed');
    }
}

