<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompany extends FormRequest
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
        $id = request()->route('company');
        return [
            'name' => [
                    'required',
                    Rule::unique('companies')->ignore($id),
                    'max:255'
                ],

            'email_address' => [
                    'required',
                    Rule::unique('companies')->ignore($id),
                    'max:255'
                ],

            'website' => 'required',

            // If the id is set then an image is no longer required
            'logo' => ($id) ? 'dimensions:min_width=100,min_height=100' : 'required|dimensions:min_width=100,min_height=100'
        ];
    }
}
