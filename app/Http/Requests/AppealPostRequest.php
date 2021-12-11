<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppealPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public static function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:20'],
            'surname' => ['required', 'string', 'max:40'],
            'patronymic' => ['nullable', 'string', 'max:20'],
            'age' => ['required', 'integer', 'between:14, 123'],
            'gender' => ['required', Rule::in([Gender::MALE, Gender::FEMALE])],
            'message' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'required_without:email', 'string', 'regex:/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/'],
            'email' => ['nullable', 'required_without:phone', 'string', 'max:100', 'regex:/^[\w\.-]+@\w+\.\w+\b$/']
        ];
    }
}
