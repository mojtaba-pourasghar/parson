<?php
return [

    'theme' => [
        'folder' => 'themes',
        'active' => ['front'=>'parson','mobile'=>'parson_mobile','back'=>'default'],
    ]
    ,
    'templates' => [
        //'page' => App\Templates\PageTemplate::class
        'home' => App\Templates\HomeTemplate::class,
        'blog' => App\Templates\BlogTemplate::class,
        'blog.post' => App\Templates\BlogPostTemplate::class
    ]

];
