<?php

return [
    
    
    'atlassian-domain-verification.html' => 'site/atlassian-domain-verification',
    
    // auth;
    
        'login' => 'site/login',
        'logout' => 'app/logout',
        'forgot-password' => 'site/forgot-password',
        'new-password/<username:\w+>/<id:\d+>/<hash:\w+>' => 'site/new-password',

        // '<alias:\w+>' => 'site/<alias>',

    
    // END auth;

    'question' => 'app/footer-modal-question',
    'change-password' => 'app/change-password',
    'upload' => 'app/upload',
    'about-me' => 'app/about-me',
    'change-info-about-me' => 'app/change-info-about-me',
    'empty-telegram-id' => 'app/empty-telegram-id',
    'change-telegram-id' => 'app/change-telegram-id',
    'info-about-director' => 'app/info-about-director',
    'close-change-telegram-id' => 'app/close-change-telegram-id',
    'support/<action>' => 'app/support/<action>',
    'payments' => 'app/payments/index',
    'payments/<action>' => 'app/payments/<action>',
    'privacy-policy' => 'app/privacy-policy',
    'refund-policy' => 'app/refund-policy',
    'public-offer' => 'app/public-offer',
    
    // '<action>' => 'app/<action>',

    // bot;

    'bot/save-telegram-chat-id/<telegram_chat_id>/<username>/<hash>' => 'bot/save-telegram-chat-id',

    // END bot;


    // director-teacher

        'directors/teachers/my-class/schedule' => 'directors/_teacher/_my_class/schedule/schedule',
        'directors/teachers/my-class/schedule-edit/<day>' => 'directors/_teacher/_my_class/schedule/schedule-edit',
        'directors/teachers/my-class/subjects' => 'directors/_teacher/_my_class/subjects/subjects',
 
        'directors/teachers/<controller>/<action>/<id:\d+>' => 'directors/_teacher/<controller>/<action>',
        'directors/teachers/<controller>/<action>' => 'directors/_teacher/<controller>/<action>',
        
        'directors/teachers/my-class/<controller>/<action>' => 'directors/_teacher/_my_class/<controller>/<action>',
        

    // END director-teacher


    // Teachers

        'teachers/my-class/schedule' => 'teachers/_my_class/schedule/schedule',
        'teachers/my-class/schedule-edit/<day>' => 'teachers/_my_class/schedule/schedule-edit',
        'teachers/my-class/subjects' => 'teachers/_my_class/subjects/subjects',
 
        'teachers/<controller>/<action>/<id:\d+>' => 'teachers/<controller>/<action>',
        'teachers/<controller>/<action>' => 'teachers/<controller>/<action>',
        
        'teachers/my-class/<controller>/<action>' => 'teachers/_my_class/<controller>/<action>',
        
    // END Teachers

    // Students

        'students/my-class/schedule' => 'students/_my_class/schedule/schedule',
        'students/my-class/subjects' => 'students/_my_class/subjects/subjects',
 
        'students/<controller>/<action>/<id:\d+>' => 'students/<controller>/<action>',
        'students/<controller>/<action>' => 'students/<controller>/<action>',
        
        'students/my-class/<controller>/<action>' => 'students/_my_class/<controller>/<action>',
        
    // END Students

    // Parents

        'parents/my-class/schedule' => 'parents/_my_class/schedule/schedule',
        'parents/my-class/subjects' => 'parents/_my_class/subjects/subjects',
 
        'parents/<controller>/<action>/<id:\d+>' => 'parents/<controller>/<action>',
        'parents/<controller>/<action>' => 'parents/<controller>/<action>',
        
        'parents/my-class/<controller>/<action>' => 'parents/_my_class/<controller>/<action>',
        
    // END Parents


    /*
    *
    *
    */

    // students;


    // END students;

    /*
    *
    *
    */

    // admins;

        'admins/users' => 'admins/user/index',

    // END admins;


];
