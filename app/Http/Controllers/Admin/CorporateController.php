<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Corporate;

class CorporateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $corporates = Corporate::latest()->get();
        return view('backend.image_slider.index', compact('corporates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.image_slider.create_corporate_banner');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'sub_title'    => 'required|string|max:255',
            'description'  => 'required|string',
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $imagePath = $request->file('banner_image')->store('corporate_banners', 'public');

        Corporate::create([
            'title'        => $request->title,
            'sub_title'    => $request->sub_title,
            'description'  => $request->description,
            'banner_image' => $imagePath,
        ]);

        return redirect()->route('admin.corporate_banners.index')
            ->with('success', 'Corporate banner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Corporate $corporateBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * Route is /{corporateBanner}/edit, so the parameter here
     * MUST be named $corporateBanner for implicit route-model
     * binding to inject the correct single record.
     */
    public function edit(Corporate $corporateBanner)
    {
        return view('backend.image_slider.edit_corporate_banner', [
            'corporateBanner' => $corporateBanner,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Corporate $corporateBanner)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'sub_title'    => 'required|string|max:255',
            'description'  => 'required|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $data = [
            'title'       => $request->title,
            'sub_title'   => $request->sub_title,
            'description' => $request->description,
        ];

        if ($request->hasFile('banner_image')) {
            if ($corporateBanner->banner_image) {
                Storage::disk('public')->delete($corporateBanner->banner_image);
            }
            $data['banner_image'] = $request->file('banner_image')->store('corporate_banners', 'public');
        }

        $corporateBanner->update($data);

        return redirect()->route('admin.corporate_banners.index')
            ->with('success', 'Corporate banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Corporate $corporateBanner)
    {
        if ($corporateBanner->banner_image) {
            Storage::disk('public')->delete($corporateBanner->banner_image);
        }

        $corporateBanner->delete();

        return redirect()->route('admin.corporate_banners.index')
            ->with('success', 'Corporate banner deleted successfully.');
    }
}
