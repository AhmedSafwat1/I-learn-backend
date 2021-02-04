<?php

return [
    'forget_password'   => [
        'mail'      => [
            'subject'   => 'تعين كلمة مرور جديدة',
        ],
        'messages'  => [
            'success'   => 'تم ارسال تعين كلمة المرور الجديدة بنجاح عبر البريد الالكتروني',
        ],
    ],
    'login'             => [
        'validation'    => [
            'email'     => [
                'email'     => 'من فضلك ادخل البريد بشكل صحيح',
                'required'  => 'من فضلك ادخل البريد الالكتروني',
            ],
            'failed'    => 'هذه البيانات غير متطابقة لدينا من فضلك تآكد من بيانات تسجيل الدخول',
            'password'  => [
                'min'       => 'كلمة المرور يجب ان تكون اكثر من ٦ مدخلات',
                'required'  => 'يجب ان تدخل كلمة المرور',
            ],
            "code_verified"=>[
                "not_correct" => "كود التاكيد المدخل غير صحيح"
            ]
        ],
    ],
    'logout'            => [
        'messages'  => [
            'failed'    => 'فشلت عملية تسجيل الخروج',
            'success'   => 'تم تسجيل الخروج بنجاح',
        ],
    ],
    "resend"=> [
        "success" => "تم ارسال الكود بنجاح"
    ],
    'password'          => [
        'messages'      => [
            'sent'  => 'تم ارسال بريد بتعين كلمة مرور جديدة',
        ],
        'validation'    => [
            'email' => [
                'email'     => 'من فضلك ادخل البريد بشكل صحيح',
                'exists'    => 'هذا البريد غير موجود لدينا',
                'required'  => 'من فضلك ادخل البريد الالكتروني',
            ],
        ],
    ],
    'register'          => [
        'messages'      => [
            'failed'    => 'فشلت عملية تسجيل الدخول ، حاول مره اخرى',
        ],
        'validation'    => [
            'email'     => [
                'email'     => 'من فضلك ادخل البريد بشكل صحيح',
                'required'  => 'من فضلك ادخل البريد الالكتروني',
                'unique'    => 'هذا البريد الالكتروني تم حجزة من قبل شخص اخر',
            ],
            'mobile'    => [
                'digits_between'    => 'يجب ان يتكون رقم الهاتف من ٨ ارقام',
                'numeric'           => 'من فضلك ادخل رقم الهاتف من ارقام انجليزية فقط',
                'required'          => 'من فضلك ادخل رقم الهاتف',
                'unique'            => 'رقم الهاتف تم حجزه من قبل شخص اخر',
            ],
            'name'      => [
                'required'  => 'من فضلك ادخل الاسم الشخصي',
            ],
            'password'  => [
                'confirmed' => 'كلمة المرور غير متطابقة مع التآكيد',
                'min'       => 'كلمة المرور يجب ان تتكون من اكثر من ٦ مدخلات',
                'required'  => 'يجب ان تدخل كلمة المرور',
            ],
        ],
    ],
    'reset'             => [
        'mail'          => [
            'button_content'    => 'تعين كلمة مرور جديدة',
            'header'            => 'انت تستقبل هذا البريد الالكتروني لآنك قمت بطلب تعين كلمة مرور جديدة لفقدانك القديمة',
            'subject'           => 'تعين كلمة مرور جديدة',
        ],
        'title'         => 'تعين كلمة مرور جديدة',
        'validation'    => [
            'email'     => [
                'email'     => 'من فضلك ادخل البريد بشكل صحيح',
                'exists'    => 'هذا البريد غير موجود لدينا',
                'required'  => 'من فضلك ادخل البريد الالكتروني',
            ],
            'password'  => [
                'min'       => 'كلمة المرور يجب ان تتكون من اكثر من ٦ مدخلات',
                'required'  => 'يجب ان تدخل كلمة المرور',
            ],
            'token'     => [
                'exists'    => 'انتهت صلاحية هذا الدفع',
                'required'  => 'لا تملك صلاحية تعين كلمة مرور جديدة قم بعمل طلب جديد',
            ],
        ],
    ],
    'workers'       => [
        'mail'          => [
            'btn'               => 'عرض المشهور الجديد',
            'header'            => 'تم تسجيل مشهور جديد من و في انتظار التفعيل للحساب الخاص به',
            'subject'           => 'تسجيل مشهور جديد',
        ],
    ],
];