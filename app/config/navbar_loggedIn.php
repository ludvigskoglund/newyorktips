<?php
/**
 * Config-file for navigation bar.
 *
 */



return [

    // Use for styling the menu
    'class' => 'navbar',
 
    // Here comes the menu strcture
    // This is a menu item



    'items' => [


                  'newyork' => [
            'text'  =>'<i class="fa fa-home"></i><b> NewYorkTips.com</b>',
            'url'   => '',
            'title' => 'New york tips'
        ],   
        // This is a menu item
        'questions'  => [
            'text'  => '<i class="fa fa-question-circle red"></i> Questions',
            'url'   => 'questions/getQuestions',
            'title' => 'Questions'
        ],
 
       
        
 
        // This is a menu item
        'tags' => [
            'text'  =>'<i class="fa fa-tag darkblue"></i> Tags',
            'url'   => 'tags/view',
            'title' => 'Internal route within this frontcontroller'
        ],

        // This is a menu item
        'users' => [
            'text'  =>' <i class="fa fa-users yellow"></i> Users',
            'url'   => 'users/list',
            'title' => 'Internal route within this frontcontroller'
        ],

        // This is a menu item
        'about' => [
            'text'  =>'<i class="fa fa-info-circle blue"></i> About',
            'url'   => 'questions/about',
            'title' => 'Internal route within this frontcontroller'
        ],

        
        /*
        // This is a menu item
        'setup' => [
            'text'  =>'Setup',
            'url'   => 'users/setup',
            'title' => 'Internal route within this frontcontroller'
        ],
        */
        
         // This is a menu item
        'askQuestion' => [
            'class' => ' pull-right ',
            'text'  =>'Ask a question',
            'url'   => 'questions/addQuestion',
            'title' => 'Internal route within this frontcontroller'
        ],


        // This is a menu item
        'logout' => [
            'class' => 'pull-right logoutBtn',
            'text'  =>  '<i class="fa fa-sign-out"> </i> Logout',
            'url'   => 'account/logout',
            'title' => 'Internal route within this frontcontroller'
        ],

        'profile' => [
            'class' => 'pull-right',
            'text'  =>' <i class="fa fa-user"></i> Profile',
            'url'   => 'users/getMyProfile',
            'title' => 'Internal route within this frontcontroller'
        ],

       


        
    ],
 
    // Callback tracing the current selected menu item base on scriptname
    'callback' => function ($url) {
        if ($url == $this->di->get('request')->getRoute()) {
                return true;
        }
    },

    // Callback to create the urls
    'create_url' => function ($url) {
        return $this->di->get('url')->create($url);
    },
];





