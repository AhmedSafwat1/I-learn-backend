<?php

namespace Modules\Section\Entities;

use Modules\Core\Filters\Filters;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Filters\Search\SearchManager;


class SectionTranslation extends Model
{
    use Filters ;
    use SearchManager;
    protected $fillable = ['description' , 'title' , 'slug' ];
}
