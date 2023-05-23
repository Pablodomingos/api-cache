<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateLessonRequest extends BaseRequest
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
                'string',
                'min:3',
                'max:255',
                "unique:lessons,name,{$uuid},uuid"
            ],
            'url' => [
                'string',
                'url',
                "unique:lessons,url,{$uuid},uuid"
            ],
            'description' => [
                'sometimes',
                'nullable',
                'min:3',
                'max:9999'
            ],
            'module' => [
                'required',
                'exists:modules,uuid'
            ]
        ];

        $postRules = [];
        $putRules = [];

        if ($this->isMethod('post')) {
            $postRules = [
                'name' => [
                    'required'
                ],
                'url' => [
                    'required'
                ]
            ];
        }

        if ($this->isMethod('put')) {
            $postRules = [
                'name' => [
                    'sometimes'
                ],
                'url' => [
                    'sometimes'
                ]
            ];
        }

        return $this->merge_rules($comonRules, $postRules, $putRules);
    }

    public function prepareForValidation()
    {
        $this->merge(['module' => $this->route('module')]);
    }
}
