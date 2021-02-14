<?php

namespace Modules\Learn\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class HomeWorkStoreRequst extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule =  [
            "teacher_id"  => ["required",
                                      Rule::exists("users","id")
                                            ->where("type","teacher")
                                            ->where("is_active", 1)
                                            ->where("is_verified", 1)
        ],
            "attachs"  => "nullable|array" ,
            "attachs.*"=> "required|file" ,
            "note"     => "nullable|string" ,
            "title"    => "nullable|max:255"    
        ];

        if($this->id){
            // dd("hi");
            $rule["teacher_id"]  = str_replace("required","nullable", $rule["teacher_id"] );
        }
        return $rule;
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
