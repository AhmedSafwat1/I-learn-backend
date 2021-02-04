<?php

namespace Modules\Learn\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getMethod())
        {
            // handle creates
            case 'post':
            case 'POST':

                return [
                  'title.*'         => 'required|unique:subject_translations,title',
                  "image"           => "nullable|image"
               
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'title.*'          => 'required|unique:subject_translations,title,'.$this->id.',subject_id',
                    "image"           => "nullable|image"
                ];
        }
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

        foreach (config('laravellocalization.supportedLocales') as $key => $value) {

          $v["title.".$key.".required"]  = __('learn::dashboard.subjects.validation.title.required').' - '.$value['native'].'';

          $v["title.".$key.".unique"]    = __('learn::dashboard.subjects.validation.title.unique').' - '.$value['native'].'';

          $v["description.".$key.".required"]  = __('learn::dashboard.subjects.validation.description.required').' - '.$value['native'].'';

        }

        return $v;

    }
}
