<?php

return [
    'subjects'  => [
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'options'       => 'Options',
            'status'        => 'Status',
            'title'         => 'Title',
            'description'       => 'Description',
            "image"             => "Image",    
        ],
        'form'      => [
            "icon"              => "Icon " ,
            'description'       => 'Description',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            'status'            => 'Status',
            "image"             => "Image",     
            'tabs'              => [
                'general'   => 'General Info.',
                'seo'       => 'SEO',
            ],
            'title'             => 'Title',
        ],
        'routes'    => [
            'create'    => 'Create Subject',
            'index'     => ' Subjects ',
            'update'    => 'Update Subject ',
        ],
        'validation'=> [
            'description'   => [
                'required'  => 'Please enter the description of Subject',
            ],
            'title'         => [
                'required'  => 'Please enter the title of Subject',
                'unique'    => 'This title subject is taken before',
            ],
        ],
    ],
    "leasons" =>[
            "validation"=>[
                "start_at"=>[
                    "not_availbel"=>"The chosen class time is not available for this teacher .",
                    "not_working"=>"The chosen time and date are not in the teacher's schedule." ,
                ]
            ]
  
    ]
];
