<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployee extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Auth middleware already in use
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $id = request()->route('employee');
        return [
            'first_name' => 'required|max:255',
            'surname' => 'required|max:255',
            'phone' => 'required|max:255',
            'email_address' => [
                'required',
                Rule::unique('employees')->ignore($id),
                'max:255'
            ],
            'company_id' => 'required'
        ];

    }
}
