<?php

view()->composer(
    [ "user::dashboard.teachers.*" ],
    \Modules\Learn\ViewComposers\Dashbord\SubjectComposer::class
);