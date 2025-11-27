<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Court\StoreRequest;
use App\Http\Requests\Admin\Court\UpdateRequest;
use App\Jobs\DeleteSoftDeletedCourtsJob;
use App\Jobs\DispatchBlockUsersJob;
use App\Models\Application;
use App\Models\Court;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function index(): View
    {
        $courts = Court::orderBy('name')->paginate(15);

        return view('admin.courts.index', compact('courts'));
    }

    public function create(): View
    {
        return view('admin.courts.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        Court::create($request->validated());
        //DispatchBlockUsersJob::dispatch();
        DeleteSoftDeletedCourtsJob::dispatch(); //асинхронно

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
        if(Application::query()->where('court_id',$court->id)->doesntExist()){
            $court->delete();

            return redirect()->route('admin.courts.index')
                ->with('status', 'court-deleted');
        }
        return redirect()->route('admin.courts.index')
            ->with('status', 'court-not-deleted');
    }
}
