<?php

namespace App\Http\Controllers;

use App\Models\HorseStatus;
use Illuminate\Http\Request;

class HorseStatusController extends Controller
{
    public function index()
    {
        // show each status + count horses
        $statuses = HorseStatus::withCount('horses')->orderBy('name')->get();
        return view('statuses.index', compact('statuses'));
    }

    public function create()
    {
        return view('statuses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:horse_statuses,name'],
        ]);

        HorseStatus::create($validated);

        return redirect()
            ->route('statuses.index')
            ->with('success', 'Status created successfully.');
    }

    public function edit(HorseStatus $status)
    {
        return view('statuses.edit', compact('status'));
    }

    public function update(Request $request, HorseStatus $status)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:horse_statuses,name,' . $status->id],
        ]);

        $status->update($validated);

        return redirect()
            ->route('statuses.index')
            ->with('success', 'Status updated successfully.');
    }

    public function destroy(HorseStatus $status)
    {
       
        $status->delete();

        return redirect()
            ->route('statuses.index')
            ->with('success', 'Status deleted successfully.');
    }
}
