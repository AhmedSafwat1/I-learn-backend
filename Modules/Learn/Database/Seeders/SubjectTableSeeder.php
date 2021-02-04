<?php

namespace Modules\Learn\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Learn\Entities\Subject;
use Illuminate\Database\Eloquent\Model;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        $this->createSubjectBase();
    }

    public function createSubjectBase()
    {
        $data = [
            [
                "image" =>"/uploads/default.png",
                "color" => "#e08b8b",
                "status" => true,
                "en"=>[
                    "title"=>"Arabic",
                    "description"  => "Arabic",
                   
                ],
                "ar"=>[
                    "title"=>" اللغه العربيه ",
                    "description"  => " اللغه العربيه ",
                   
                ]
            ] ,

            [
                "image" =>"/uploads/default.png",
                "color" => "#e08b8b",
                "status" => true,
                "en"=>[
                    "title"=>"English",
                    "description"  => "English",
                   
                ],
                "ar"=>[
                    "title"=>" اللغه الانجليزيه ",
                    "description"  => " اللغه الانجليزيه ",
                   
                ]
            ] ,


            [
                "image" =>"/uploads/default.png",
                "color" => "#e08b8b",
                "status" => true,
                "en"=>[
                    "title"=>"French language",
                    "description"  => "French language",
                   
                ],
                "ar"=>[
                    "title"=>" اللغه الفرنسيه ",
                    "description"  => " اللغه الفرنسيه ",
                   
                ]
            ] ,

            [
                "image" =>"/uploads/default.png",
                "color" => "#e08b8b",
                "status" => true,
                "en"=>[
                    "title"=>"Maths",
                    "description"  => "",
                   
                ],
                "ar"=>[
                    "title"=>"الرياضيات",
                    "description"  => "الرياضيات",
                   
                ]
            ] ,

            [
                "image" =>"/uploads/default.png",
                "color" => "#e08b8b",
                "status" => true,
                "en"=>[
                    "title"=>"Chemistry",
                    "description"  => "Chemistry",
                   
                ],
                "ar"=>[
                    "title"=>"الكيمياء",
                    "description"  => "الكيمياء",
                   
                ]
            ] ,

            [
                "image" =>"/uploads/default.png",
                "color" => "#e08b8b",
                "status" => true,
                "en"=>[
                    "title"=>"Physics",
                    "description"  => "Physics",
                   
                ],
                "ar"=>[
                    "title"=>"الفيزياء",
                    "description"  => "الفيزياء",
                   
                ]
            ] ,

            [
                "image" =>"/uploads/default.png",
                "color" => "#e08b8b",
                "status" => true,
                "en"=>[
                    "title"=>"Psychology",
                    "description"  => "Psychology",
                   
                ],
                "ar"=>[
                    "title"=>"علم نفس",
                    "description"  => "علم نفس",
                   
                ]
            ] ,

            [
                "image" =>"/uploads/default.png",
                "color" => "#e08b8b",
                "status" => true,
                "en"=>[
                    "title"=>"Biology",
                    "description"  => "Biology",
                   
                ],
                "ar"=>[
                    "title"=>"احياء",
                    "description"  => " احياء",
                   
                ]
            ] ,
            
            [
                "image" =>"/uploads/default.png",
                "color" => "#e08b8b",
                "status" => true,
                "en"=>[
                    "title"=>"Literature",
                    "description"  => "literature",
                   
                ],
                "ar"=>[
                    "title"=>"الادب",
                    "description"  => "الادب",
                   
                ]
            ] ,
            
            
                ];

        foreach ($data as $section) {
            # code...
            Subject::create($section);
        }
    }

}
