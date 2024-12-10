<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomainExtensionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes()
    {
        return __('messages.domain_extension.fields');
    }
    public function rules()
    {
        $id = request()->id ? ',' . request()->id : '';
        return [
            'name' => 'required|string', // max 10000kb
            // 'password' => 'required|string|min:6', // max 10000kb
            // 're_password' => 'required|string|same:password', // max 10000kb
        ];
    }
    public function messages() : array
    {
        // $id = request()->id ? ',' . request()->id : '';
        return [
            'name.required' => __('validation.required'), // max 10000kb
        ];
    }
}
