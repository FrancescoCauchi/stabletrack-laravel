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
    public function index(Request $request)
    {
        $statuses = HorseStatus::orderBy('name')->get();

        $query = Horse::with(['stable', 'status']);

        // Filter by status (query param: ?status=ID)
        $statusId = $request->query('status');
        if (!empty($statusId)) {
            $query->where('horse_status_id', $statusId);
        }

        // Sort (query param: ?sort=...)
        $sort = $request->query('sort', 'name_asc');

        switch ($sort) {
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;

            case 'stable_asc':
                $query->join('stables', 'horses.stable_id', '=', 'stables.id')
                      ->orderBy('stables.name', 'asc')
                      ->select('horses.*');
                break;

            case 'stable_desc':
                $query->join('stables', 'horses.stable_id', '=', 'stables.id')
                      ->orderBy('stables.name', 'desc')
                      ->select('horses.*');
                break;

            case 'status_asc':
                $query->leftJoin('horse_statuses', 'horses.horse_status_id', '=', 'horse_statuses.id')
                      ->orderBy('horse_statuses.name', 'asc')
                      ->select('horses.*');
                break;

            case 'status_desc':
                $query->leftJoin('horse_statuses', 'horses.horse_status_id', '=', 'horse_statuses.id')
                      ->orderBy('horse_statuses.name', 'desc')
                      ->select('horses.*');
                break;

            case 'name_asc':
            default:
                $query->orderBy('name', 'asc');
                break;
        }

        $horses = $query->get();

        return view('horses.index', [
            'horses' => $horses,
            'statuses' => $statuses,
            'statusId' => $statusId,
            'sort' => $sort,
        ]);
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
            'horse_status_id' => ['required', 'exists:horse_statuses,id'],
            'name' => ['required', 'string', 'max:255'],
            'breed' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0'],
            'notes' => ['nullable', 'string'],
            'letrot_url' => ['nullable', 'url', 'max:255'],
        ]);

        // External validation using LeTROT
        $leTrot = new LeTrotService();
        if (!empty($validated['letrot_url']) && !$leTrot->profileExists($validated['letrot_url'])) {
            return back()
                ->withErrors(['letrot_url' => 'LeTROT profile URL is not reachable or not valid.'])
                ->withInput();
        }

        // Slug generation + uniqueness
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
            'horse_status_id' => ['required', 'exists:horse_statuses,id'],
            'name' => ['required', 'string', 'max:255'],
            'breed' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0'],
            'notes' => ['nullable', 'string'],
            'letrot_url' => ['nullable', 'url', 'max:255'],
        ]);

        // External validation using LeTROT
        $leTrot = new LeTrotService();
        if (!empty($validated['letrot_url']) && !$leTrot->profileExists($validated['letrot_url'])) {
            return back()
                ->withErrors(['letrot_url' => 'LeTROT profile URL is not reachable or not valid.'])
                ->withInput();
        }

        // Regenerate slug if name changed
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
