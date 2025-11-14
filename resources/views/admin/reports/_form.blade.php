<div class="row g-1">
    <div class="col-md-6">
        <label class="form-label" for="reportTitle">Название</label>
        <input type="text" id="reportTitle" name="title" class="form-control" value="{{ old('title', $report->title ?? '') }}" required>
        @error('title')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label" for="reportPeriodStart">Начало периода</label>
        <input type="date" id="reportPeriodStart" name="period_start" class="form-control" value="{{ old('period_start', optional($report->period_start ?? null)->format('Y-m-d')) }}" required>
        @error('period_start')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label" for="reportPeriodEnd">Конец периода</label>
        <input type="date" id="reportPeriodEnd" name="period_end" class="form-control" value="{{ old('period_end', optional($report->period_end ?? null)->format('Y-m-d')) }}" required>
        @error('period_end')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label" for="reportTotalApplications">Всего заявок</label>
        <input type="number" id="reportTotalApplications" name="total_applications" min="0" class="form-control" value="{{ old('total_applications', $report->total_applications ?? 0) }}" required>
        @error('total_applications')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label" for="reportCompletedApplications">Завершено</label>
        <input type="number" id="reportCompletedApplications" name="completed_applications" min="0" class="form-control" value="{{ old('completed_applications', $report->completed_applications ?? 0) }}" required>
        @error('completed_applications')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label" for="reportTotalRevenue">Выручка, ₽</label>
        <input type="number" step="0.01" min="0" id="reportTotalRevenue" name="total_revenue" class="form-control" value="{{ old('total_revenue', $report->total_revenue ?? 0) }}" required>
        @error('total_revenue')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-12">
        <label class="form-label" for="reportSummary">Описание</label>
        <textarea id="reportSummary" name="summary" class="form-control" rows="4">{{ old('summary', $report->summary ?? '') }}</textarea>
        @error('summary')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
