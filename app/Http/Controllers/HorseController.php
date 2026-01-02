<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use App\Models\Stable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HorseController extends Controller
{
    public function index()
    {
        $horses = Horse::with('stable')->orderBy('name')->get();
        return view('horses.index', compact('horses'));
    }

    public function create()
    {
        $stables = Stable::orderBy('name')->get();
        return view('horses.create', compact('stables'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stable_id' => ['required', 'exists:stables,id'],
            'name' => ['required', 'string', 'max:255'],
            'breed' => ['nullable', 'string', 'max:255'],
            'age' => ['nullable', 'integer', 'min:0'],
            'notes' => ['nullable', 'string'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $base = $validated['slug'];
        $i = 2;
        while (Horse::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $base . '-' . $i;
            $i++;
        }

        $horse = Horse::create($validated);

        return redirect()
            ->route('horses.show', $horse)
            ->with('success', 'Horse created successfully.');
    }

    public function show(Horse $horse)
    {
        $horse->load('stable');
        return view('horses.show', compact('horse'));
    }

    public function edit(Horse $horse)
    {
        $stables = Stable::orderBy('name')->get();
        return view('horses.edit', compact('horse', 'stables'));
    }

    public function update(Request $request, Horse $horse)
    {
        $validated = $request->validate([
            'stable_id' => ['required', 'exists:stables,id'],
            'name' => ['required', 'string', 'max:255'],
            'breed' => ['nullable', 'string', 'max:255'],
            'age' => ['nullable', 'integer', 'min:0'],
            'notes' => ['nullable', 'string'],
        ]);

        if ($validated['name'] !== $horse->name) {
            $slug = Str::slug($validated['name']);
            $base = $slug;
            $i = 2;

            while (Horse::where('slug', $slug)->where('id', '!=', $horse->id)->exists()) {
                $slug = $base . '-' . $i;
                $i++;
            }

            $validated['slug'] = $slug;
        }

        $horse->update($validated);

        return redirect()
            ->route('horses.show', $horse)
            ->with('success', 'Horse updated successfully.');
    }

    public function destroy(Horse $horse)
    {
        $horse->delete();

        return redirect()
            ->route('horses.index')
            ->with('success', 'Horse deleted successfully.');
    }
}
