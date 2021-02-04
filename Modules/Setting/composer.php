<?php

view()->composer(['worker::dashboard.workers.*', "user::dashboard.*", "ads::dashboard.ads.*" ],
 \Modules\Setting\ViewComposers\Dashboard\CountriesCodeComposer::class);
