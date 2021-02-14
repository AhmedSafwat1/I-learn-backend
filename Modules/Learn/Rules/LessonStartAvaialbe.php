<?php

namespace Modules\Learn\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\User\Concerns\AvailabityTrait;

class LessonStartAvaialbe implements Rule
{
    public $teacher_id;
    public $exculdue_id ;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($teacher_id, $exculdue_id=null)
    {
        //
        $this->teacher_id = $teacher_id;
        $this->exculdue_id = $exculdue_id;

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
        //$

        $x = AvailabityTrait::checkIfDateReserivationQuery($value, $this->teacher_id, $this->exculdue_id);
       
        return !$x;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __("learn::dashboard.leasons.validation.start_at.not_availbel");
    }
}
