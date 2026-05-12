<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $items = Country::orderBy('name')->paginate(20);
        return view('backend.countries.index', compact('items'));
    }

    public function create()
    {
        return view('backend.countries.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:countries,name',
            'status' => 'nullable|in:0,1'
        ]);

        $data['status'] = $request->has('status') ? 1 : 0;
        Country::create($data);
        return redirect()->route('admin.countries.index')->with('success', 'Country created');
    }

    public function edit(Country $country)
    {
        return view('backend.countries.edit', ['item' => $country]);
    }

    public function update(Request $request, Country $country)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:countries,name,' . $country->id,
            'status' => 'nullable|in:0,1'
        ]);
        $data['status'] = $request->has('status') ? 1 : 0;
        $country->update($data);
        return redirect()->route('admin.countries.index')->with('success', 'Country updated');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('admin.countries.index')->with('success', 'Country deleted');
    }

    public function destinations($id)
    {
        $list = \App\Models\Destination::where('country_id', $id)->where('status', 1)->orderBy('name')->get();
        return response()->json($list);
    }
}
