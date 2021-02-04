<?php

namespace Modules\Apps\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Ads\Repositories\Dashboard\AdsRepositry;
use Modules\User\Repositories\Dashboard\UserRepository;
use Modules\Ads\Repositories\Dashboard\EquipmentRepositry;
use Modules\Section\Repositories\Dashboard\SectionRepository;
use Modules\Category\Repositories\Dashboard\CategoryRepository;



class DashboardController extends Controller
{
    public function index()
    {

      
        $userRepo = app()->make(UserRepository::class);
        $userCreated = $userRepo->userCreatedStatistics();
      

        $categoryRepo = app()->make(CategoryRepository::class);
        $categoryData = $categoryRepo->getStatistics();

      

       

       
      
    //    dd($equipmentData);
       
    
        return view('apps::dashboard.index', compact(
            "userCreated" ,
            
            "categoryData" ,
           
           
        ))
        ;
    }
}
