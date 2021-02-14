<?php

namespace Modules\Learn\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Modules\Learn\Rules\TeacherWorking;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Learn\Rules\LessonStartAvaialbe;

class LessonStoreRequest extends FormRequest
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
            "note"     => "nullable|string" ,
            "title"    => "nullable|max:255" ,
            "subject_id"  => "required|exists:subjects,id",
            "lesson_type" => "required|in:online,house",
            "start_at"    => [
                    "required","date","after:".date('Y-m-d H:i') ,
                    new TeacherWorking($this->teacher_id) ,
                    new LessonStartAvaialbe($this->teacher_id)
             ]
            

        ];

        
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
