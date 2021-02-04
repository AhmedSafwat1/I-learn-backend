<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Modules\Authorization\Entities\Permission;;

class CreatePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create {route :  route name like users}';

    protected $mapKey = [
        "show" => [
            "lang" => [
                "ar" => [
                    "description" => "عرض"
                ] ,
                "en" => [
                    "description" => "show"
                ] ,
               
            ]
        ],
        "add" => [
            "lang" => [
                "ar" => [
                    "description" => "أضافه"
                ] ,
                "en" => [
                    "description" => "add"
                ] 
                 
            ]
        ],
        "edit" => [
            "lang" => [
                "ar" => [
                    "description" => "تعديل"
                ] ,
                "en" => [
                    "description" => "edit"
                ] 
                
            ]
        ],
        "delete" => [
            "lang" => [
                "ar" => [
                    "description" => "حذف"
                ] ,
                "en" => [
                    "description" => "delete"
                ] 
                 
            ]
        ],
    ];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create permission for the routes ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $route = $this->argument('route');
        $route = trim($route);
        $routeSingular = $route;
       
        Permission::where("display_name", $route)->delete();
        foreach ($this->mapKey as $key => $value) {
            # code...
          
            Permission::create(
               array_merge(
                [
                    
                    "display_name"        => $route ,
                    "name"                => $key."_".$routeSingular


                ], 
                $value["lang"]
               )
            );
           
        }
        $this->info("done");
    }
}
