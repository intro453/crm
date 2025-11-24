<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RequestTopic\StoreRequest;
use App\Http\Requests\Admin\RequestTopic\UpdateRequest;
use App\Models\RequestTopic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RequestTopicController extends Controller
{
    public function index(Request $request): View
    {
        $query = RequestTopic::query();

        $search = trim((string) $request->query('search'));
        if ($search !== '') {
            $query->where('name', 'like', "%{$search}%");
        }

        $isActive = $request->query('is_active');
        if ($isActive !== null && $isActive !== '') {
            $query->where('is_active', (bool) $isActive);
        }

        $topics = $query
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.topics.index', [
            'topics' => $topics,
            'filters' => [
                'search' => $search,
                'is_active' => $isActive,
            ],
        ]);
    }

    public function create(): View
    {
        return view('admin.topics.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        RequestTopic::create($request->validated());

        return redirect()->route('admin.topics.index')
            ->with('status', 'topic-created');
    }

    public function edit(RequestTopic $topic): View
    {
        return view('admin.topics.edit', compact('topic'));
    }

    public function update(UpdateRequest $request, RequestTopic $topic): RedirectResponse
    {
        $topic->update($request->validated());

        return redirect()->route('admin.topics.edit', $topic)
            ->with('status', 'topic-updated');
    }

    public function destroy(RequestTopic $topic): RedirectResponse
    {
        $topic->delete();

        return redirect()->route('admin.topics.index')
            ->with('status', 'topic-deleted');
    }
}
