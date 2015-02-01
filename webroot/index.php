<?php
require __DIR__.'/config_with_app.php'; 
$di  = new \Anax\DI\CDIFactoryDefault();
$app = new \Anax\Kernel\CAnax($di);




$app->theme->configure(ANAX_APP_PATH . 'config/theme.php');

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

$di->set('form', '\Mos\HTMLForm\CForm');
// START CONTROLLERS

$di->set('QuestionsController', function () use ($di) {
    $controller = new \Anax\Questions\QuestionsController();
    $controller->setDI($di);
    return $controller;
});

$di->set('TagsController', function () use ($di) {
    $controller = new \Anax\Tags\TagsController();
    $controller->setDI($di);
    return $controller;
});

$di->set('UsersController', function () use ($di) {
    $controller = new \Anax\Users\UsersController();
    $controller->setDI($di);
    return $controller;
});

$di->set('AccountController', function () use ($di) {
    $controller = new \Anax\Account\AccountController();
    $controller->setDI($di);
    return $controller;
});

$di->set('HomeController', function () use ($di) {
    $controller = new \Anax\Homes\HomesController();
    $controller->setDI($di);
    return $controller;
});

$di->set('AnswerController', function () use ($di) {
    $controller = new \Anax\Answers\AnswersController();
    $controller->setDI($di);
    return $controller;
});


$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/config_sqlite.php');
    $db->connect();
    return $db;
});


// END CONTROLLERS



	if($app->AccountController->isLoggedIn()){
		$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_loggedIn.php');
		
	}
	else{
		$app->navbar->configure(ANAX_APP_PATH . 'config/navbar.php'); 
		
	}
	

	

 









$app->router->add('', function() use ($app) {

   $app->dispatcher->forward([
        'controller' => 'Home',
        'action'     => 'view',
        
       
    ]);


 
});



$app->router->handle();
$app->theme->render();
