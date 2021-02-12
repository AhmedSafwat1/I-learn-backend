<?php

namespace Modules\Learn\Entities;

use Modules\Core\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class HomeWorkAttach extends Model
{
    use UsesUuid;
    protected $guarded 				    	= ['id'];

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($model) {
            if($model->url) deleteFileInStroage($model->url);
        });
    }
    /**
     * Get the parent imageable model (user or post).
     */
    public function owner()
    {
        return $this->morphTo();
    }
}
