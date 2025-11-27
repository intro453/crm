<?php

namespace App\Http\Requests\Admin\Court;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('courts', 'name')->ignore($this->route('court')->id)],
        ];
    }
}
