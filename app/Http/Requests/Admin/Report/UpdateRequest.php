<?php

namespace App\Http\Requests\Admin\Report;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'period_start' => ['required', 'date'],
            'period_end' => ['required', 'date', 'after_or_equal:period_start'],
            'total_applications' => ['required', 'integer', 'min:0'],
            'completed_applications' => ['required', 'integer', 'min:0'],
            'total_revenue' => ['required', 'numeric', 'min:0'],
            'summary' => ['nullable', 'string'],
        ];
    }
}
