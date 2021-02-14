<?php

namespace Modules\Learn\Entities;

use Modules\User\Entities\User;
use Modules\Core\Traits\UsesUuid;
use Modules\Learn\Entities\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use UsesUuid;
    use SoftDeletes;
    // protected $fillable = [];
    protected $guarded 				    	= ['id'];

    protected $dates = [
        'start_at',
        "end_at"   
    ];

    public function student()
    {
        return $this->belongsTo(User::class, "student_id");
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, "teacher_id");
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, "subject_id");
    }

    public function payment()
    {
        return $this->morphOne(Payment::class, "order");
    }

    public function scopePaied($query)
    {
        return $query->where('is_paied', 1);
    }

    public function scopeWorking($query)
    {
        $date = now();
        $query->where("start_at","<=",$date->toDateTimeString())
        ->where("end_at",">",$date->toDateTimeString());
    }

    public function scopeInComming($query)
    {
        $date = now();
        $query->where("start_at",">",$date->toDateTimeString());
    }

    public function scopePrevious($query)
    {
        $date = now();
        $query->where("end_at","<",$date->toDateTimeString());
    }

    public function scopeTalent($query)
    {
        $user = auth()->user();

        if ($user->type == "student") {
            $query->where("student_id", $user->id);
        } else {
            $query
                    ->where("teacher_id", $user->id)
                    ->paied();
        }

    }

    public function isRuuning(){
        $date = now();
        return $date->between($this->start_at, $this->end_at);
    }

    

}
