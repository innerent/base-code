<?php

namespace Innerent\Contact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'max:255',
            'type' => 'max:255',

            'addresses.*.street'        => 'required|max:255',
            'addresses.*.number'        => 'max:255',
            'addresses.*.complement'    => 'max:255',
            'addresses.*.neighborhood'  => 'max:255',
            'addresses.*.zip'           => 'max:255',
            'addresses.*.county'        => 'max:255',
            'addresses.*.city'          => 'max:255',
            'addresses.*.state'         => 'max:255',
            'addresses.*.country'       => 'max:255',
            'addresses.*.description'   => 'max:255',

            'emails.*.address'      => 'required|max:255',
            'emails.*.type'         => 'max:255',
            'emails.*.provider'     => 'max:255',
            'emails.*.description'  => 'max:255',

            'phones.*.country_code' => 'max:255',
            'phones.*.area_code'    => 'max:255',
            'phones.*.number'       => 'required|max:255',
            'phones.*.type'         => 'max:255',
            'phones.*.description'  => 'max:255',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
