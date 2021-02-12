<?php

namespace Modules\Learn\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SolutionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            "attachs"  => "nullable|array" ,
            "attachs.*"=> "required|file" ,
            "note"     => "nullable|string" 
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
