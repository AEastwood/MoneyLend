<?php

namespace App\Http\Requests\Lender;

use Illuminate\Foundation\Http\FormRequest;

class LenderStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['alpha_num', 'required', 'max:255'],
            'last_name' => ['alpha_num', 'required', 'max:255'],
        ];
    }
}
