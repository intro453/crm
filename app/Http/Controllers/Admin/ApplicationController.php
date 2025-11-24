<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Application\StoreRequest;
use App\Http\Requests\Admin\Application\UpdateRequest;
use App\Models\Application;
use App\Models\Client;
use App\Models\Court;
use App\Models\RequestTopic;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request): View
    {
        $query = Application::query()->with(['client', 'manager', 'lawyer', 'topic', 'court']);

        $filters = [
            'status' => $request->query('status'),
            'type' => $request->query('type'),
            'manager_id' => $request->query('manager_id'),
            'lawyer_id' => $request->query('lawyer_id'),
            'topic_id' => $request->query('topic_id'),
            'client' => trim((string) $request->query('client')),
            'date_from' => $request->query('date_from'),
            'date_to' => $request->query('date_to'),
        ];

        if ($filters['status']) {
            $query->where('status', $filters['status']);
        }

        if ($filters['type']) {
            $query->where('type', $filters['type']);
        }

        if ($filters['manager_id']) {
            $query->where('manager_id', $filters['manager_id']);
        }

        if ($filters['lawyer_id']) {
            $query->where('lawyer_id', $filters['lawyer_id']);
        }

        if ($filters['topic_id']) {
            $query->where('topic_id', $filters['topic_id']);
        }

        if ($filters['client'] !== '') {
            $clientSearch = "%{$filters['client']}%";
            $query->whereHas('client', function ($builder) use ($clientSearch) {
                $builder->where('name', 'like', $clientSearch)
                    ->orWhere('phone', 'like', $clientSearch)
                    ->orWhere('email', 'like', $clientSearch);
            });
        }

        if ($filters['date_from']) {
            $query->whereDate('scheduled_start_at', '>=', $filters['date_from']);
        }

        if ($filters['date_to']) {
            $query->whereDate('scheduled_start_at', '<=', $filters['date_to']);
        }

        $applications = $query
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        $statusOptions = Application::getStatusLabels();
        $typeOptions = Application::getTypeLabels();
        $managers = User::query()->where('role', User::ROLE_MANAGER)->orderBy('last_name')->get();
        $lawyers = User::query()->where('role', User::ROLE_LAWYER)->orderBy('last_name')->get();
        $topics = RequestTopic::query()->orderBy('name')->get();

        return view('admin.applications.index', compact(
            'applications',
            'filters',
            'statusOptions',
            'typeOptions',
            'managers',
            'lawyers',
            'topics'
        ));
    }

    public function create(): View
    {
        return view('admin.applications.create', $this->formOptions());
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        Application::create($request->validated());

        return redirect()->route('admin.applications.index')
            ->with('status', 'application-created');
    }

    public function edit(Application $application): View
    {
        return view('admin.applications.edit', array_merge(
            ['application' => $application->load(['client', 'manager', 'lawyer', 'topic', 'court'])],
            $this->formOptions()
        ));
    }

    public function update(UpdateRequest $request, Application $application): RedirectResponse
    {
        $application->update($request->validated());

        return redirect()->route('admin.applications.edit', $application)
            ->with('status', 'application-updated');
    }

    public function destroy(Application $application): RedirectResponse
    {
        $application->delete();

        return redirect()->route('admin.applications.index')
            ->with('status', 'application-deleted');
    }

    protected function formOptions(): array
    {
        return [
            'clients' => Client::query()->orderBy('name')->get(),
            'managers' => User::query()->where('role', User::ROLE_MANAGER)->orderBy('last_name')->get(),
            'lawyers' => User::query()->where('role', User::ROLE_LAWYER)->orderBy('last_name')->get(),
            'topics' => RequestTopic::query()->orderBy('name')->get(),
            'courts' => Court::query()->orderBy('name')->get(),
            'statusOptions' => Application::getStatusLabels(),
            'typeOptions' => Application::getTypeLabels(),
        ];
    }
}
