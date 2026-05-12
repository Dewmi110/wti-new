<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Country;

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
            'status' => 'nullable|in:0,1'
        ]);
        $data['status'] = $request->has('status') ? 1 : 0;
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
            'status' => 'nullable|in:0,1'
        ]);
        $data['status'] = $request->has('status') ? 1 : 0;
        $destination->update($data);
        return redirect()->route('admin.destinations.index')->with('success', 'Destination updated');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('admin.destinations.index')->with('success', 'Destination deleted');
    }
}
