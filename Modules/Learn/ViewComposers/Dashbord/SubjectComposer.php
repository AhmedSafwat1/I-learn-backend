<?php
namespace Modules\Learn\ViewComposers\Dashbord;

use Modules\Learn\Repositories\Dashboard\SubjectRepository;
use Illuminate\View\View;

class SubjectComposer {
    public $subjects = [];

    public function __construct(SubjectRepository $subject)
    {
        $this->subjects =  $subject->getAllActive();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('subjects' , $this->subjects);
    }
}