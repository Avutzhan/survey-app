<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'survey_id' => 'required|integer',
            'question_id' => 'required|integer',
            'id' => 'required|unique:answers,id,' . $this->input('id'),
            'body' => 'nullable|string|max:255'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.*
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }
}
