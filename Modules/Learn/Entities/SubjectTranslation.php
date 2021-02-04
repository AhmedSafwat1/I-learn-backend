<?php

namespace Modules\Learn\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasCompositePrimaryKey;

class SubjectTranslation extends Model
{
    use HasCompositePrimaryKey;
    protected $primaryKey = ["subject_id", "locale"]; 
}
