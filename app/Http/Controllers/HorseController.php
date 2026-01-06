<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use App\Models\Stable;
use App\Models\HorseStatus;
use App\Services\LeTrotService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HorseController extends Controller
{
    public function index()
    {
        $horses = Horse::with(['stable', 'status'])->orderBy('name')->get();
        return view('horses.index', compact('horses'));
    }

    public function create(Request $request)
    {
        $stables = Stable::orderBy('name')->get();
        $statuses = HorseStatus::orderBy('name')->get();
        $selectedStableId = $request->query('stable_id');

        return view('horses.create', compact('stables', 'statuses', 'selectedStableId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stable_id' => ['required', 'exists:stables,id'],
            'name' => ['required', 'string', 'max:255'],
            'breed' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0'],
            'notes' => ['nullable', 'string'],
            'letrot_url' => ['nullable', 'url', 'max:255'],
            'horse_status_id' => ['required', 'exists:horse_statuses,id'], 
        ]);

        $leTrot = new LeTrotService();
        if (!empty($validated['letrot_url']) && !$leTrot->profileExists($validated['letrot_url'])) {
            return back()
                ->withErrors(['letrot_url' => 'LeTROT profile URL is not reachable or not valid.'])
                ->withInput();
        }

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
        $horse->load(['stable', 'status']);
        return view('horses.show', compact('horse'));
    }

    public function edit(Horse $horse)
    {
        $stables = Stable::orderBy('name')->get();
        $statuses = HorseStatus::orderBy('name')->get();

        return view('horses.edit', compact('horse', 'stables', 'statuses'));
    }

    public function update(Request $request, Horse $horse)
    {
        $validated = $request->validate([
            'stable_id' => ['required', 'exists:stables,id'],
            'name' => ['required', 'string', 'max:255'],
            'breed' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0'],
            'notes' => ['nullable', 'string'],
            'letrot_url' => ['nullable', 'url', 'max:255'],
            'horse_status_id' => ['required', 'exists:horse_statuses,id']
        ]);

        $leTrot = new LeTrotService();
        if (!empty($validated['letrot_url']) && !$leTrot->profileExists($validated['letrot_url'])) {
            return back()
                ->withErrors(['letrot_url' => 'LeTROT profile URL is not reachable or not valid.'])
                ->withInput();
        }

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
