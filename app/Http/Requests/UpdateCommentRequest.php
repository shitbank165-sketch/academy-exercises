<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author_name' => ['nullable', 'string', 'max:255'],
            'author_email' => ['nullable', 'email'],
            'message' => ['nullable', 'string'],
        ];
    }
}
