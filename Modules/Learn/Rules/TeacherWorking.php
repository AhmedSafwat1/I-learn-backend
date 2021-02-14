<?php

namespace Modules\Learn\Rules;

use Modules\User\Entities\User;
use Illuminate\Contracts\Validation\Rule;

class TeacherWorking implements Rule
{
    public $teacher_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($teacher_id)
    {
        //
        $this->teacher_id = $teacher_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $teacher = User::with("profile")->findOrFail($this->teacher_id);
        return $teacher->profile->checkWorkingInDate($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __("learn::dashboard.leasons.validation.start_at.not_working");
    
    }
}
