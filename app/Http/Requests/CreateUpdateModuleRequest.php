<?php

namespace App\Http\Requests;

class CreateUpdateModuleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $comonRules = [
            'name' => [
                'required',
                'min:3',
                'max:255',
            ],
            'course' => [
                'required',
                'exists:courses,uuid'
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
            $postRules = [
                //
            ];
        }

        return $this->merge_rules($comonRules, $postRules, $putRules);
    }

    public function prepareForValidation()
    {
        $this->merge(['course' => $this->route('course')]);
    }
}
