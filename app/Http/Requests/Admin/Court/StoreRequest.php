<?php

namespace App\Http\Requests\Admin\Court;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:courts']
        ];
    }
}
