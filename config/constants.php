<?php
return [
    'options' => [
        'def_user' => 'pourasghar2006@gmail.com',
        'image_max_size' => 5242880,
        'resize_image_x' => 100,
        'upload_path' => 'uploads',
        'thumbnail' => 'thumbnail',
    ],
    'backend' => [
        'limit' => '50',
        'step' => '50',
    ],
    'frontend' => [
        'limit' => '5',
        'alphabetLimit' => '80',
        'step' => '1',
    ],
    'person_role' => [
        'writer' => '1',
        'translator' => '5',
    ],
    'sms' => [
        'user' => '09122500752',
        'password' => '57c67e'
    ]
    ,
    'persianAlphabet' => ['الف', 'ب', 'پ', 'ت', 'ث', 'ج', 'چ', 'ح', 'خ', 'د', 'ذ', 'ر', 'ز', 'ژ', 'س', 'ش', 'ص', 'ض', 'ظ', 'ع', 'غ', 'ف', 'ق', 'ک', 'گ', 'ل', 'م', 'ن', 'و', 'ه', 'ی'],
    'site_url' => 'http://127.0.0.1:8000'
];
