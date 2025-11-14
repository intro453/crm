@php
    $scheduledStartValue = old('scheduled_start_at', optional($application->scheduled_start_at ?? null)->format('Y-m-d\TH:i'));
    $scheduledEndValue = old('scheduled_end_at', optional($application->scheduled_end_at ?? null)->format('Y-m-d\TH:i'));
    $travelDateValue = old('travel_date', optional($application->travel_date ?? null)->format('Y-m-d'));
@endphp
<div class="row g-1">
    <div class="col-md-4">
        <label class="form-label" for="applicationClient">Клиент</label>
        <select id="applicationClient" name="client_id" class="form-select" required>
            <option value="">Выберите клиента</option>
            @foreach($clients as $clientOption)
                <option value="{{ $clientOption->id }}" @selected(old('client_id', $application->client_id ?? '') == $clientOption->id)>
                    {{ $clientOption->name }}
                </option>
            @endforeach
        </select>
        @error('client_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="applicationTopicSelect">Тема</label>
        <select id="applicationTopicSelect" name="topic_id" class="form-select">
            <option value="">Не выбрано</option>
            @foreach($topics as $topicOption)
                <option value="{{ $topicOption->id }}" @selected(old('topic_id', $application->topic_id ?? '') == $topicOption->id)>
                    {{ $topicOption->name }}
                </option>
            @endforeach
        </select>
        @error('topic_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="applicationStatus">Статус</label>
        <select id="applicationStatus" name="status" class="form-select" required>
            @foreach($statusOptions as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $application->status ?? '') == $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="applicationType">Тип заявки</label>
        <select id="applicationType" name="type" class="form-select" required>
            @foreach($typeOptions as $value => $label)
                <option value="{{ $value }}" @selected(old('type', $application->type ?? '') == $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('type')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="applicationManager">Менеджер</label>
        <select id="applicationManager" name="manager_id" class="form-select">
            <option value="">Не назначен</option>
            @foreach($managers as $managerOption)
                <option value="{{ $managerOption->id }}" @selected(old('manager_id', $application->manager_id ?? '') == $managerOption->id)>
                    {{ $managerOption->full_name }}
                </option>
            @endforeach
        </select>
        @error('manager_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="applicationLawyer">Юрист</label>
        <select id="applicationLawyer" name="lawyer_id" class="form-select">
            <option value="">Не назначен</option>
            @foreach($lawyers as $lawyerOption)
                <option value="{{ $lawyerOption->id }}" @selected(old('lawyer_id', $application->lawyer_id ?? '') == $lawyerOption->id)>
                    {{ $lawyerOption->full_name }}
                </option>
            @endforeach
        </select>
        @error('lawyer_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-4 court-field">
        <label class="form-label" for="applicationCourt">Суд</label>
        <select id="applicationCourt" name="court_id" class="form-select">
            <option value="">Не выбрано</option>
            @foreach($courts as $courtOption)
                <option value="{{ $courtOption->id }}" @selected(old('court_id', $application->court_id ?? '') == $courtOption->id)>
                    {{ $courtOption->name }}
                </option>
            @endforeach
        </select>
        @error('court_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="applicationHours">Часы на работу</label>
        <input type="number" step="0.5" min="0" id="applicationHours" name="estimated_hours" class="form-control"
               value="{{ old('estimated_hours', $application->estimated_hours ?? '') }}">
        @error('estimated_hours')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="applicationCost">Стоимость, ₽</label>
        <input type="number" step="0.01" min="0" id="applicationCost" name="cost" class="form-control"
               value="{{ old('cost', $application->cost ?? 0) }}" required>
        @error('cost')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="applicationStart">Начало работы</label>
        <input type="datetime-local" id="applicationStart" name="scheduled_start_at" class="form-control"
               value="{{ $scheduledStartValue }}">
        @error('scheduled_start_at')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="applicationEnd">Окончание работы</label>
        <input type="datetime-local" id="applicationEnd" name="scheduled_end_at" class="form-control"
               value="{{ $scheduledEndValue }}">
        @error('scheduled_end_at')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-4 travel-field">
        <label class="form-label" for="applicationTravelDate">Дата выезда</label>
        <input type="date" id="applicationTravelDate" name="travel_date" class="form-control"
               value="{{ $travelDateValue }}">
        @error('travel_date')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-12">
        <label class="form-label" for="applicationDescription">Описание</label>
        <textarea id="applicationDescription" name="description" class="form-control" rows="4">{{ old('description', $application->description ?? '') }}</textarea>
        @error('description')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-12 completion-field">
        <label class="form-label" for="applicationCompletionComment">Комментарий к завершению</label>
        <textarea id="applicationCompletionComment" name="completion_comment" class="form-control" rows="4">{{ old('completion_comment', $application->completion_comment ?? '') }}</textarea>
        @error('completion_comment')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
