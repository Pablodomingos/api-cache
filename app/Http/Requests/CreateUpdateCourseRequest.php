<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateCourseRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $uuid = $this->uuid ?? '';

        $comonRules = [
            'name' => [
                'required',
                'min:3',
                'max:255',
                "unique:courses,name,{$uuid},uuid"
            ],
            'description' => [
                'sometimes',
                'nullable',
                'min:3',
                'max:9999'
            ]
        ];

        $postRules = [];
        $putRules = [];

        if ($this->isMethod('post')) {
            $postRules = [
                //
            ];
        }

        if ($this->isMethod('put')) {
            $putRules = [
                //
            ];
        }

        return array_merge($comonRules, $postRules, $putRules);
    }
}
