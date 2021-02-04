<?php

use Modules\User\ViewComposers\Dashboard\UserComposer;

view()->composer([
    'auction::dashboard.auction.*'  ,
    "order::dashboard.orders.index",
    "ads::dashboard.*" ,
  
    ]
, UserComposer::class);