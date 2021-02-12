<?php

namespace Modules\Learn\Entities;

use Modules\Core\Traits\UsesUuid;
use Modules\Learn\Entities\HomeWork;
use Illuminate\Database\Eloquent\Model;
use Modules\Learn\Entities\HomeWorkAttach;

class HomeWorkSolution extends Model
{
    use UsesUuid;
    
    protected $touches = ['homework'];

    protected $guarded 				    	= ['id'];


    public function homework()
    {
        return $this->belongsTo(HomeWork::class, "home_work_id");
    }

    public function attachs()
    {
        return $this->morphOne(HomeWorkAttach::class, "owner");
    }
}
