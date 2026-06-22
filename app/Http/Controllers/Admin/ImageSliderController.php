<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageSlider;
use Illuminate\Http\Request;

class ImageSliderController extends Controller
{
    public function index()
    {
        $sliders = ImageSlider::all();

        return view('backend.image_slider.index', compact('sliders'));
    }

    public function createHomeSlider()
    {
        return view('backend.image_slider.create_home_slider');
    }

    public function editHomeSlider(ImageSlider $imageSlider)
    {
        return view('backend.image_slider.edit_home_slider', compact('imageSlider'));
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'header'      => 'nullable|string|max:255',
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image_path'] = $request->file('image')->store('sliders', 'public');
    }

    ImageSlider::create($validated);

    return redirect()->route('admin.image_sliders.index')  // was: admin.image-sliders.index
        ->with('success', 'Image slider created successfully.');
}

public function update(Request $request, ImageSlider $imageSlider)
{
    $validated = $request->validate([
        'header'      => 'nullable|string|max:255',
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        if ($imageSlider->image_path && \Storage::disk('public')->exists($imageSlider->image_path)) {
            \Storage::disk('public')->delete($imageSlider->image_path);
        }
        $validated['image_path'] = $request->file('image')->store('sliders', 'public');
    }

    $imageSlider->update($validated);

    return redirect()->route('admin.image_sliders.index')  // was: admin.image-sliders.index
        ->with('success', 'Image slider updated successfully.');
}

public function destroy(ImageSlider $imageSlider)
{
    if ($imageSlider->image_path && \Storage::disk('public')->exists($imageSlider->image_path)) {
        \Storage::disk('public')->delete($imageSlider->image_path);
    }

    $imageSlider->delete();

    return redirect()->route('admin.image_sliders.index')  // was: admin.image-sliders.index
        ->with('success', 'Image slider deleted successfully.');
}
}
