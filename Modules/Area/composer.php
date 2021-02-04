<?php

view()->composer([
    'area::dashboard.cities.*', 'user::dashboard.users.*' ,
  
    ]
, \Modules\Area\ViewComposers\Dashboard\CountryComposer::class);

view()->composer([
  
   
    'area::dashboard.states.*',
    "academy::dashboard.academies.*"
], \Modules\Area\ViewComposers\Dashboard\CityComposer::class);
