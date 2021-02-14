<?php

namespace Modules\Learn\Entities;

use Modules\User\Entities\User;
use Modules\Core\Traits\UsesUuid;
use Modules\Learn\Entities\Payment;
use Illuminate\Database\Eloquent\Model;
use Modules\Learn\Entities\HomeWorkAttach;
use Modules\Learn\Entities\HomeWorkSolution;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeWork extends Model
{
    use UsesUuid;
    use SoftDeletes;
    protected $guarded 				    	= ['id'];

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($model) {
            if ($model->isForceDeleting()) {
                deleteDirecotoryInStroage("homeworks/".$model->id);
            }
        });
    }

    public function student()
    {
        return $this->belongsTo(User::class, "student_id");
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, "teacher_id");
    }

    public function solution()
    {
        return $this->hasOne(HomeWorkSolution::class, "home_work_id");
    }

    public function attachs()
    {
        return $this->morphMany(HomeWorkAttach::class, "owner");
    }

    public function payment()
    {
        return $this->morphOne(Payment::class, "order");
    }

    public function scopePaied($query)
    {
        return $query->where('is_paied', 1);
    }
}
