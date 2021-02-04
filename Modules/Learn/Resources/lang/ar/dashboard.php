<?php

return [
    'subjects'  => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            "image"         => "صوره" ,
            'title'         => 'اسم الماده',
            'description'       => 'الوصف',
        ],
        'form'      => [
            "icon"              => "شعار اللعبه" ,
            'description'       => 'الوصف',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            'status'            => 'الحالة',
            "image"             => "الصوره",        
            'tabs'              => [
                'general'   => 'بيانات عامة',
                'seo'       => 'SEO',
            ],
            'title'             => 'عنوان',
        ],
        'routes'    => [
            'create'    => 'اضافة ماده ',
            'index'     => 'المواد التعليميه ',
            'update'    => 'تعديل ماده',
        ],
        'validation'=> [
            'description'   => [
                'required'  => 'من فضلك ادخل وصف القسم',
            ],
            'title'         => [
                'required'  => 'من فضلك ادخل اسم الماده ',
                'unique'    => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],
];
