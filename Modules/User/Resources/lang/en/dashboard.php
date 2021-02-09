<?php

return [
    'admins'        => [
        'create'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General Info.',
                'image'             => 'Profile Image',
                'info'              => 'Info.',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Password',
                'roles'             => 'Roles',
            ],
            'title' => 'Create Admins',
        ],
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'email'         => 'Email',
            'image'         => 'Image',
            'mobile'        => 'Mobile',
            'name'          => 'Name',
            'options'       => 'Options',
        ],
        'index'     => [
            'title' => 'Admins',
        ],
        'update'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General info.',
                'image'             => 'Profile Image',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Change Password',
                'roles'             => 'Roles',
            ],
            'title' => 'Update Admins',
        ],
        'validation'=> [
            'email'     => [
                'required'  => 'Please enter the email of admin',
                'unique'    => 'This email is taken before',
            ],
            'mobile'    => [
                'digits_between'    => 'Please add mobile number only 8 digits',
                'numeric'           => 'Please enter the mobile only numbers',
                'required'          => 'Please enter the mobile of admin',
                'unique'            => 'This mobile is taken before',
            ],
            'name'      => [
                'required'  => 'Please enter the name of admin',
            ],
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'Please enter the password of admin',
                'same'      => 'The Password confirmation not matching',
            ],
            'roles'     => [
                'required'  => 'Please select the role of admin',
            ],
        ],
    ],
    'users'         => [
        'create'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General Info.',
                'image'             => 'Profile Image',
                'info'              => 'Info.',
                "description"       => "Description" ,
                "location"          => "Location" ,
                "lat"          => "lat" ,
                "lng"          => "lng" ,
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Password',
                "country"           => "Country",
                "restore"           => "Restore",
                "user_name"         =>  "User Name" ,
                "status"            => "Status", 
                "money"             => "Deposit Money",
                "banckAccount"      => "Bank Account ",
                "pass_deposit"      => "Pass deposit",
                "bank"              => [
                    "user_name"   => "Account user name  ",
                    "bank_name"   => "Bank Name",
                    "account_number"=> "Account Number",
                    "address"       => "Address",
                    "iban"          => "Iban "
                ]
            ],
            'title' => 'Create Users',
        ],
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'email'         => 'Email',
            "status"            => "Status", 
            'image'         => 'Image',
            "gender"            => "Gender" ,
            'mobile'        => 'Mobile',
            'name'          => 'Name',
            'options'       => 'Options',
            "verifed"       => "Verifed Status" ,
            "is_verifed"    => "Verifed" ,
            "not_verifed"   => "Not Verifed" ,

            "auction_status"=>"Auction status "
        ],
        'index'     => [
            'title' => 'Studnets',
        ],
        'update'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General info.',
                'image'             => 'Profile Image',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Change Password',
                "description"       => "Description" ,
                "location"          => "Location" ,
                "lat"               => "lat" ,
                "lng"               => "lng" , 
            ],
            'title' => 'Update Student',
        ],
        'validation'=> [
            'email'     => [
                'required'  => 'Please enter the email of user',
                'unique'    => 'This email is taken before',
            ],
            'mobile'    => [
                'digits_between'    => 'Please add mobile number only 8 digits',
                'numeric'           => 'Please enter the mobile only numbers',
                'required'          => 'Please enter the mobile of user',
                'unique'            => 'This mobile is taken before',
            ],
            'name'      => [
                'required'  => 'Please enter the name of user',
            ],
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'Please enter the password of user',
                'same'      => 'The Password confirmation not matching',
            ],
        ],
    ],
    'teachers'         => [
        'create'    => [
            'form'  => [
                "subjects"          => "Subjects" ,
                "sections"          => "Educational stages" ,
                "lesson_type"       => "Lession Type" ,
                "online_price"      => "Online lession price",
                "house_price"       => "House lession price" ,
                'teacher'           => 'Teacher Basic Info',
                'confirm_password'  => 'Confirm Password',
                "working"           => "Schedule" , 
                'email'             => 'Email',
                'general'           => 'General Info.',
                'image'             => 'Profile Image',
                'info'              => 'Info.',
                "description"       => "Description" ,
                "location"          => "Location" ,
                "lat"          => "lat" ,
                "lng"          => "lng" ,
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Password',
                "country"           => "Country",
                "restore"           => "Restore",
                "user_name"         =>  "User Name" ,
                "status"            => "Status", 
                "money"             => "Deposit Money",
                "banckAccount"      => "Bank Account ",
                "pass_deposit"      => "Pass deposit",
                "bank"              => [
                    "user_name"   => "Account user name  ",
                    "bank_name"   => "Bank Name",
                    "account_number"=> "Account Number",
                    "address"       => "Address",
                    "iban"          => "Iban "
                ]
            ],
            'title' => 'Create Teacher',
        ],
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'email'         => 'Email',
            "status"            => "Status", 
            'image'         => 'Image',
            "online"        => "Online" ,
            "house"         => "In house" ,
            "all"           => "All", 
            "subjects"          => "Subjects" ,
            "sections"          => "Educational stages" ,
            "lesson_type"       => "Lesson type" ,
            "online_price"      => "Online lession price",
            "weak"          => [
                "monday"   => "Monday",
                "tuesday"  => "Tuesday"  ,
                "wednesday"=> "Wednesday" ,
                "thursday" => "Thursday" ,
                "friday"    => "Friday" ,
                "saturday"  => "Saturday" ,
                "sunday"    => "Sunday"
            ],
            "house_price"       => "House lession price" ,
            "gender"            => "Gender" ,
            'mobile'        => 'Mobile',
            'name'          => 'Name',
            'options'       => 'Options',
            "verifed"       => "Verifed Status" ,
            "is_verifed"    => "Verifed" ,
            "not_verifed"   => "Not Verifed" ,

            "auction_status"=>"Auction status "
        ],
        'index'     => [
            'title' => 'Teachers',
        ],
        'update'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General info.',
                'image'             => 'Profile Image',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Change Password',
                "description"       => "Description" ,
                "location"          => "Location" ,
                "lat"               => "lat" ,
                "lng"               => "lng" , 
                "working"           => "Schedule" , 
                "subjects"          => "Subjects" ,
                "sections"          => "ُducational stages" ,
                "lesson_type"       => "Lession Type" ,
                "online_price"      => "Online lession price",
                "house_price"       => "House lession price" ,
                'teacher'           => 'Teacher Basic Info',
            ],
            'title' => 'Update Teacher',
        ],
        'validation'=> [
            'email'     => [
                'required'  => 'Please enter the email of user',
                'unique'    => 'This email is taken before',
            ],
            'mobile'    => [
                'digits_between'    => 'Please add mobile number only 8 digits',
                'numeric'           => 'Please enter the mobile only numbers',
                'required'          => 'Please enter the mobile of user',
                'unique'            => 'This mobile is taken before',
            ],
            'name'      => [
                'required'  => 'Please enter the name of user',
            ],
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'Please enter the password of user',
                'same'      => 'The Password confirmation not matching',
            ],
        ],
    ],
    
   
];
