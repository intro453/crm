<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Court\StoreRequest;
use App\Http\Requests\Admin\Court\UpdateRequest;
use App\Models\Court;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function index(Request $request): View
    {
        $query = Court::query();

        $search = trim((string) $request->query('search'));
        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('region', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $courts = $query
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.courts.index', [
            'courts' => $courts,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return view('admin.courts.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        Court::create($request->validated());

        return redirect()->route('admin.courts.index')
            ->with('status', 'court-created');
    }

    public function edit(Court $court): View
    {
        return view('admin.courts.edit', compact('court'));
    }

    public function update(UpdateRequest $request, Court $court): RedirectResponse
    {
        $court->update($request->validated());

        return redirect()->route('admin.courts.edit', $court)
            ->with('status', 'court-updated');
    }

    public function destroy(Court $court): RedirectResponse
    {
        $court->delete();

        return redirect()->route('admin.courts.index')
            ->with('status', 'court-deleted');
    }
}
