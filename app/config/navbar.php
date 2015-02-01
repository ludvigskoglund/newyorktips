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
            'text'  => 'Questions',
            'url'   => 'questions/getQuestions',
            'title' => 'Questions'
        ],
 
       
        
 
        // This is a menu item
        'tags' => [
            'text'  =>'Tags',
            'url'   => 'tags/view',
            'title' => 'Internal route within this frontcontroller'
        ],

        // This is a menu item
        'users' => [
            'text'  =>'Users',
            'url'   => 'users/list',
            'title' => 'Internal route within this frontcontroller'
        ],

        // This is a menu item
        'about' => [
            'text'  =>'About',
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
        'login' => [
            'class' => 'pull-right',
            'text'  =>' Login',
            'url'   => 'account/login',
            'title' => 'Internal route within this frontcontroller'
        ],

        'register' => [
            'class' => 'pull-right',
            'text'  =>' Register',
            'url'   => 'account/register',
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





