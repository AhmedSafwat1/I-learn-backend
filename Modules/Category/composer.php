<?php

// Dashboard ViewComposr
view()->composer([
  'category::dashboard.categories.*',
  'worker::dashboard.workers.*',
  'user::dashboard.users.*',
  'vendor::dashboard.vendors.*',
  
 
], \Modules\Category\ViewComposers\Dashboard\CategoryComposer::class);

view()->composer([
  'apps::dashboard.index',
], \Modules\Category\ViewComposers\Dashboard\CountCategoryComposer::class);

view()->composer([
  "auction::dashboard.auction.*" ,
  "ads::dashboard.matchs.*" ,
  'advertising::dashboard.advertising.*',
], \Modules\Category\ViewComposers\Dashboard\CategoryAllComposer::class);



view()->composer([
  'vendor::vendor.offers.*',
], \Modules\Category\ViewComposers\Vendor\CategoryComposer::class);
