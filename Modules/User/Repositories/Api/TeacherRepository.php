<?php

namespace Modules\User\Repositories\Api;

use Modules\User\Entities\User;

class TeacherRepository
{
    public function __construct(User $user)
    {
        $this->user      = $user;
    }

    public function getAllActive(&$request, $with=[]){
     
        return $this->user->teacherUser()
                    ->userAvaialabel()
                    ->searchFilter($request)
                    ->with($with)
                    ->paginate($request->page_count ?? env("PAGE_COUNT", 15));

    }


    public function findById($id, $with){
        return $this->user->teacherUser()->userAvaialabel()->with($with)->where("id",$id)->first();
    }
}
