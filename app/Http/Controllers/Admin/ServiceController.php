<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $items = Service::with('serviceType')->latest()->paginate(10);
        return view('backend.services.index', compact('items'));
    }

    public function create()
    {
        $serviceTypes = ServiceType::orderBy('name')->get();
        return view('backend.services.create', compact('serviceTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            's_id' => 'required|exists:service_types,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $banner_image = $request->file('banner_image')->store('services', 'public');

        $service = Service::create(
            $request->only('s_id', 'title', 'description') + ['banner_image' => $banner_image]
        );

        // if ($request->hasFile('banner_image')) {

        //     $image = $request->file('banner_image');
        //     $filename = time().'_'.$image->getClientOriginalName();

        //     $image->move(public_path('uploads/services'), $filename);

        //     $service->banner_image = 'uploads/services/'.$filename;
        //     $service->save(); 
        // }

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $serviceTypes = ServiceType::orderBy('name')->get();
        return view('backend.services.edit', compact('service', 'serviceTypes'));
    }

    public function update(Request $request, Service $service)
{
    $request->validate([
        's_id' => 'required|exists:service_types,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
    ]);

    $data = $request->only('s_id', 'title', 'description');

    if ($request->hasFile('banner_image')) {

        if ($service->banner_image) {
            Storage::disk('public')->delete($service->banner_image);
        }

        $data['banner_image'] = $request->file('banner_image')
            ->store('services', 'public');
    }

    $service->update($data);

    return redirect()->route('admin.services.index')
        ->with('success', 'Service updated successfully.');
}

    public function destroy(Service $service)
{
    if ($service->banner_image) {
        Storage::disk('public')->delete($service->banner_image);
    }

    $service->delete();

    return redirect()->route('admin.services.index')
                     ->with('success', 'Service deleted.');
}
}
