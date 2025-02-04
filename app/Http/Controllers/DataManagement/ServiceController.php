<?php

namespace App\Http\Controllers\DataManagement;

use Illuminate\Http\Request;
use App\Models\Services;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Services::all();
        return view('main.service.index', compact('service'));
    }

    public function create()
    {
        return view('main.service.create');
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'title' => 'required',
                'description' => 'required'
            ];

            $request->validate($rules);
            $input = $request->except(['_token', '_method']);

            Services::create($input);

            return redirect('services')->with('success', 'Service successfully added!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to save. Please input the right value!');
        }
    }

    public function show(Services $service)
    {
        return view('main.service.view', compact('service'));
    }

    public function edit(Services $service)
    {
        return view('main.service.update', compact('service'));
    }

    public function update(Request $request, Services $services)
    {
        try {
            $rules = [
                'title' => 'required',
                'description' => 'required',
            ];

            $services = Services::find($request['id']);

            if (!$services) {
                return redirect()->back()->with('error', 'Record not found.');
            }

            $request->validate($rules);

            $input = $request->except(['_token', '_method']);

            $services->update($input);

            return redirect()->route('services.index')
                ->with('success', 'Service updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to Update. Please input in the correct format!');
        }
    }
}
