<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Report\StoreRequest;
use App\Http\Requests\Admin\Report\UpdateRequest;
use App\Models\Report;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $query = Report::query();

        $search = trim((string) $request->query('search'));
        if ($search !== '') {
            $query->where('title', 'like', "%{$search}%");
        }

        $reports = $query
            ->orderByDesc('period_end')
            ->paginate(15)
            ->withQueryString();

        return view('admin.reports.index', [
            'reports' => $reports,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return view('admin.reports.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        Report::create($request->validated());

        return redirect()->route('admin.reports.index')
            ->with('status', 'report-created');
    }

    public function edit(Report $report): View
    {
        return view('admin.reports.edit', compact('report'));
    }

    public function update(UpdateRequest $request, Report $report): RedirectResponse
    {
        $report->update($request->validated());

        return redirect()->route('admin.reports.edit', $report)
            ->with('status', 'report-updated');
    }

    public function destroy(Report $report): RedirectResponse
    {
        $report->delete();

        return redirect()->route('admin.reports.index')
            ->with('status', 'report-deleted');
    }
}
