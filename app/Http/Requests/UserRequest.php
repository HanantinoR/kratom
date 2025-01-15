<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class UserRequest extends FormRequest
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
        $method = strtolower($this->method());
        $user_id = $this->route()->user;

        $rules = [];
        switch ($method) {
            case 'post':
                $rules = [
                    'username' => 'required|max:20',
                    'password' => 'required|confirmed|min:8',
                    'email' => 'required|max:191|email|unique:users',
                    'phone_number'=>'max:13',
                    'user_type' => 'required',
                    'user_sign' => 'required',
                    'branch_office' => 'required',
                    // 'company_id'=>'required'
                ];
                break;
            case 'patch':
                $rules = [
                    'username' => 'required|max:20',
                    'email' => 'required|max:191|email|unique:users,email,'.$user_id,
                    'phone_number'=>'max:13',
                    'password' => 'confirmed|min:8|nullable',
                    'user_type' => 'required',
                    'user_sign' => 'required',
                    // 'branch_office' => 'required',
                ];
                break;

        }

        return $rules;
    }

    public function messages()
    {
        return [
            'username'  =>'Username belum di isi.',
            'email'  =>'Email belum di isi.',
            'phone_number'  =>'Nomor Telephone belum di isi.',
            'password'  =>'Password belum di isi.',
            'user_type'  =>'Role belum di pilih.',
            'user_sign'  =>'Type Penandatangan belum di pilih.',
            // 'branch_office'  =>'Kantor Cabang belum di pilih.',
        ];
    }

     /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator){
        $data = [
            'status' => true,
            'message' => $validator->errors()->first(),
            'all_message' =>  $validator->errors()
        ];

        if ($this->ajax()) {
            throw new HttpResponseException(response()->json($data,422));
        } else {
            throw new HttpResponseException(redirect()->back()->withInput()->with('errors', $validator->errors()));
        }
    }


}
