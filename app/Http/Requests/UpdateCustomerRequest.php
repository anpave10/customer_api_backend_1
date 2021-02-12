<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class UpdateCustomerRequest extends FormRequest
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
        $customer = $this->route('customer');
        return [
            'first_name' => 'required | min:3',
            'last_name' => 'required | min:3 ',
            'email' => 'required | email | unique:customers,email,'.$customer->_id.',_id',
            'phone_number' => 'required | unique:customers,phone_number,'.$customer->_id.',_id',
        ];
    }
}
