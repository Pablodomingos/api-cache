<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function merge_rules(...$rules): array
    {
        $r = [];

        foreach ($rules as $rule) {
            foreach($rule as $k => $v) {
                if (is_string($v)) {
                    $v = explode('|', $v);
                }
                if (in_array($k, array_keys($r))) {
                    $r[$k] = array_merge($r[$k], $v);
                }
                else {
                    $r[$k] = $v;
                }
            }
        }

        return $r;
    }
}
