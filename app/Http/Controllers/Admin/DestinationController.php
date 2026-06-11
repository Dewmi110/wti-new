<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        $items = Destination::with('country')->orderBy('name')->paginate(20);

        return view('backend.destinations.index', compact('items'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->get();

        return view('backend.destinations.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'status' => 'nullable|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        Destination::create($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Destination created');
    }

    public function edit(Destination $destination)
    {
        $countries = Country::orderBy('name')->get();

        return view('backend.destinations.edit', ['item' => $destination, 'countries' => $countries]);
    }

    public function update(Request $request, Destination $destination)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'status' => 'nullable|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($destination->image) {
                Storage::disk('public')->delete($destination->image);
            }
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination->update($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Destination updated');
    }

    public function destroy(Destination $destination)
    {
        if ($destination->image) {
            Storage::disk('public')->delete($destination->image);
        }
        $destination->delete();

        return redirect()->route('admin.destinations.index')->with('success', 'Destination deleted');
    }
}
