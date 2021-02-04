<?php

view()->composer(
    ['vendor::dashboard.vendors.*', "post::dashboard.*", "ads::dashboard.matchs.*" ],
    \Modules\Section\ViewComposers\Dashboard\SectionComposer::class
);
view()->composer(['vendor::dashboard.vendors.*'], \Modules\Section\ViewComposers\Dashboard\SectionMainComposer::class);