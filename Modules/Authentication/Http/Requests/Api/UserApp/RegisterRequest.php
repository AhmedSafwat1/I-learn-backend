<?php

namespace Modules\Authentication\Http\Requests\Api\UserApp;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       
        return [
            "type"       => "required|in:student,teacher"   ,
            "gender"     => "required|in:male,female", 
            'name'      => 'required',
            "phone_code" => "required",
            'mobile'     => ['required',
                             Rule::unique("users")->where(function($query){
                                $query->where("mobile", $this->mobile)
                                ->where("phone_code", $this->phone_code);
                             }),
                            'numeric','digits_between:8,8'], 
            'email'          => 'nullable|email|unique:users,email',
            'password'       => 'required|confirmed|min:6',
            "image"          => "nullable|image" ,
            "description"    => "nullable|string",
            "sections"       => "nullable|array",
            "sections.*"     => "required|exists:sections,id",
            "categories"     => "nullable|array",
            "categories.*"   => "required|exists:categories,id",    
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

    public function messages()
    {

        $v = [
            'name.required'         =>   __('authentication::api.register.validation.name.required'),
            'mobile.required'       =>   __('authentication::api.register.validation.mobile.required'),
            'mobile.unique'         =>   __('authentication::api.register.validation.mobile.unique'),
            'mobile.numeric'        =>   __('authentication::api.register.validation.mobile.numeric'),
            'mobile.digits_between' =>   __('authentication::api.register.validation.mobile.digits_between'),
            'email.required'        =>   __('authentication::api.register.validation.email.required'),
            'email.unique'          =>   __('authentication::api.register.validation.email.unique'),
            'email.email'           =>   __('authentication::api.register.validation.email.email'),
            'password.required'     =>   __('authentication::api.register.validation.password.required'),
            'password.min'          =>   __('authentication::api.register.validation.password.min'),
            'password.confirmed'    =>   __('authentication::api.register.validation.password.confirmed'),
        ];

        return $v;
    }
}
