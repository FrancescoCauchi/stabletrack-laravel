<?php

namespace App\Http\Controllers;

use App\Models\Stable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StableController extends Controller
{
    public function index()
    {
        $stables = Stable::orderBy('name')->get();
        return view('stables.index', compact('stables'));
    }

    public function create()
    {
        return view('stables.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $base = $validated['slug'];
        $i = 2;
        while (Stable::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $base . '-' . $i;
            $i++;
        }

        $stable = Stable::create($validated);

        return redirect()
            ->route('stables.show', $stable)
            ->with('success', 'Stable created successfully.');
    }

    public function show(Stable $stable)
    {
        // Load horses relationship for display
        $stable->load(['horses' => function ($q) {
            $q->orderBy('name');
        }]);

        return view('stables.show', compact('stable'));
    }

    public function edit(Stable $stable)
    {
        return view('stables.edit', compact('stable'));
    }

    public function update(Request $request, Stable $stable)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        if ($validated['name'] !== $stable->name) {
            $slug = Str::slug($validated['name']);
            $base = $slug;
            $i = 2;

            while (Stable::where('slug', $slug)->where('id', '!=', $stable->id)->exists()) {
                $slug = $base . '-' . $i;
                $i++;
            }

            $validated['slug'] = $slug;
        }

        $stable->update($validated);

        return redirect()
            ->route('stables.show', $stable)
            ->with('success', 'Stable updated successfully.');
    }

    public function destroy(Stable $stable)
    {
        $stable->delete();

        return redirect()
            ->route('stables.index')
            ->with('success', 'Stable deleted successfully.');
    }
}
