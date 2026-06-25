<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactBannerController extends Controller
{
    public function index()
    {
        $contactBanners = ContactBanner::latest()->get();

        return view('backend.image_slider.index', compact('contactBanners'));
    }

    public function create()
    {
        return view('backend.image_slider.create_contact_banner');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $imagePath = $request->file('image')->store('contact_banners', 'public');

        ContactBanner::create([
            'banner_image' => $imagePath,
        ]);

        return redirect()->route('admin.contact_banners.index')
            ->with('success', 'Contact banner created successfully.');
    }

    public function edit(ContactBanner $contactBanner)
    {
        return view('backend.image_slider.edit_contact_banner', compact('contactBanner'));
    }

    public function update(Request $request, ContactBanner $contactBanner)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        // Delete old image before storing the new one
        if ($contactBanner->banner_image) {
            Storage::disk('public')->delete($contactBanner->banner_image);
        }

        $imagePath = $request->file('image')->store('contact_banners', 'public');

        $contactBanner->update([
            'banner_image' => $imagePath,
        ]);

        return redirect()->route('admin.contact_banners.index')
            ->with('success', 'Contact banner updated successfully.');
    }

    public function destroy(ContactBanner $contactBanner)
    {
        if ($contactBanner->banner_image) {
            Storage::disk('public')->delete($contactBanner->banner_image);
        }

        $contactBanner->delete();

        return redirect()->route('admin.contact_banners.index')
            ->with('success', 'Contact banner deleted successfully.');
    }
}
