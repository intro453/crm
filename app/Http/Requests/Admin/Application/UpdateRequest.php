<?php

namespace App\Http\Requests\Admin\Application;

use App\Models\Application;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'manager_id' => $this->input('manager_id') ?: null,
            'lawyer_id' => $this->input('lawyer_id') ?: null,
            'topic_id' => $this->input('topic_id') ?: null,
            'court_id' => $this->input('court_id') ?: null,
            'estimated_hours' => $this->input('estimated_hours') !== null ? str_replace(',', '.', $this->input('estimated_hours')) : null,
            'cost' => $this->input('cost') !== null ? str_replace(',', '.', $this->input('cost')) : null,
        ]);
    }

    public function rules(): array
    {
        $statusKeys = array_keys(Application::getStatusLabels());
        $typeKeys = array_keys(Application::getTypeLabels());

        $courtRule = ['nullable', 'exists:courts,id'];
        $travelDateRule = ['nullable', 'date'];
        $completionRule = ['nullable', 'string'];

        if ($this->input('type') === Application::TYPE_VISIT) {
            $courtRule = ['required', 'exists:courts,id'];
            $travelDateRule = ['required', 'date'];
        }

        if ($this->input('status') === Application::STATUS_COMPLETED) {
            $completionRule = ['required', 'string'];
        }

        return [
            'client_id' => ['required', 'exists:clients,id'],
            'manager_id' => ['nullable', 'exists:users,id'],
            'lawyer_id' => ['nullable', 'exists:users,id'],
            'topic_id' => ['nullable', 'exists:request_topics,id'],
            'court_id' => $courtRule,
            'status' => ['required', Rule::in($statusKeys)],
            'type' => ['required', Rule::in($typeKeys)],
            'estimated_hours' => ['nullable', 'numeric', 'min:0'],
            'cost' => ['required', 'numeric', 'min:0'],
            'scheduled_start_at' => ['nullable', 'date'],
            'scheduled_end_at' => ['nullable', 'date', 'after_or_equal:scheduled_start_at'],
            'travel_date' => $travelDateRule,
            'description' => ['nullable', 'string'],
            'completion_comment' => $completionRule,
        ];
    }
}
