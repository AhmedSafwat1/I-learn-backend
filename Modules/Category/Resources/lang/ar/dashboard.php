<?php

return [
    'categories'    => [
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'image'         => 'الصورة',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            'title'         => 'العنوان',
        ],
        'form'      => [
            'color'             => 'اللون',
            'image'             => 'الصورة',
            'main_category'     => 'قسم رئيسي',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            'status'            => 'الحالة',
            'tabs'              => [
                'category_level'    => 'مستوى  انواع الخدمات ',
                'general'           => 'بيانات عامة',
                'seo'               => 'SEO',
            ],
            'title'             => 'عنوان',
        ],
        'routes'    => [
            'create'    => 'اضافة  انواع الخدمات ',
            'index'     => ' انواع الخدمات ',
            'update'    => 'تعديل   انواع الخدمات',
        ],
        'validation'=> [
            'category_id'   => [
                'required'  => 'من فضلك اختر مستوى البرند',
            ],
            'image'         => [
                'required'  => 'من فضلك اختر الصورة',
            ],
            'title'         => [
                'required'  => 'من فضلك ادخل العنوان',
                'unique'    => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],
];
