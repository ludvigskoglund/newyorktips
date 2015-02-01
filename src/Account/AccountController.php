<?php

namespace Anax\Account;


class AccountController implements \Anax\DI\IInjectionAware
{


    use \Anax\DI\TInjectable;

   private $userName = null;
    
    public function __construct(){
       
    	$session = new \Anax\Session\CSession();
        
     
    }

public function initialize()
{
    $this->users = new \Anax\Users\User();
    $this->users->setDI($this->di);
}

public function loginAction()  
    { 
        $form = $this->form; 

        $form = $form->create([], [ 
            'name' => [ 
                'type'        => 'text',
                'class' 	  => 'input-md', 
                'label'       => 'Username', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
            ], 
            'password' => [ 
                'type'        => 'password',
                'class' 	  => 'input-md',  
                'label'       => 'Password', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
            ], 
            
            'submit' => [ 
                'type'      => 'submit',
                'class' => 'btn btn-success', 
                'value' => 'Login',
                'callback'  => function($form) { 
                	  
                	  $user = $this->users->findName($form->Value('name'));

                	  if(isset($user->name)){
                	  	$password = $user->password;

                	  	 $this->userName = $user->name;


                    return password_verify($form->Value('password'),$password ); 

                	  }
                	  	$form->saveInSession = false;
                	  return false;
                } 
            ], 

        ]); 

        // Check the status of the form 
        $status = $form->check(); 

        if ($status === true) { 
          
            $this->session->set('loggedIn', $this->userName);
            $url = $this->url->create(''); 
            $this->response->redirect($url); 

           
         
        } else if ($status === false) { 
         
            // What to do when form could not be processed? 
            $form->AddOutput("<div class='alert alert-dismissable alert-danger' style='width: 50%'>

  <strong>Oh snap!</strong> <br>Did you type in the right username or password?
</div>"); 
            header("Location: " . $_SERVER['PHP_SELF']); 
        } 

        $this->theme->setTitle("Login"); 
        $this->views->add('account/login', [ 
            'title' => "Lägg till användare", 
            'form' => $form->getHTML() 
        ]); 
    }  

public function isLoggedIn(){

	$ok = $this->session->has('loggedIn');
        if($ok){
           return true;
        }
        else{

        	return false;
        }
}

public function logoutAction(){

	
           $this->session->clearSession('loggedIn');

            $url = $this->url->create(''); 
            $this->response->redirect($url);       	      
                

}

public function get(){
	$ok = $this->session->has('loggedIn');
        if($ok){
	echo "Logged in as: " . $this->session->get('loggedIn');

	
}
}


public function registerAction(){

    { 
        $form = $this->form; 

        $form = $form->create([], [ 
            'name' => [ 
                'type'        => 'text',
                'class'       => 'input-md', 
                'label'       => 'Username', 
                'required'    => true, 
                'validation'  => ['not_empty'], 

            ], 
            'email' => [ 
                'type'        => 'text',
                'class'       => 'input-md', 
                'label'       => 'email', 
                'required'    => true, 
                'validation'  => ['not_empty', 'email_adress'], 
            ],

            'password' => [ 
                'type'        => 'password',
                'class'       => 'input-md',  
                'label'       => 'Password', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
            ], 
            
            'submit' => [ 
                'type'      => 'submit',
                'class' => 'btn btn-success', 
                'value' => 'register',
                'callback'  => function($form) { 
                    $default = "http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?f=y";
                    $size = 40;

                    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $form->Value('email') ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

                      
                      $this->users->save([  
                        'name'         => $form->Value('name'),
                        'email'     => $form->Value('email'),                          
                        'password'     => password_hash($form->Value('password'), PASSWORD_BCRYPT),
                        'gravatar' =>  $grav_url,
                        'activity' => 0
                       
                    ]); 

                    $user = $this->users->findName($form->Value('name'));

                      if(isset($user->name)){
                        $password = $user->password;

                         $this->userName = $user->name;


                    return password_verify($form->Value('password'),$password ); 

                      }
                      return false;
                } 
            ], 

        ]); 

        // Check the status of the form 
        $status = $form->check(); 

        if ($status === true) { 
          
            $this->session->set('loggedIn', $this->userName);
            $url = $this->url->create(''); 
            $this->response->redirect($url); 

           
         
        } else if ($status === false) { 
         
            // What to do when form could not be processed? 
            $form->AddOutput("<div class='alert alert-dismissable alert-danger'>
  <button type='button' class='close' data-dismiss='alert'>×</button>
  <strong>Oh snap!</strong> Did you type in the right username or password?
</div>"); 
            header("Location: " . $_SERVER['PHP_SELF']); 
        } 

        $this->theme->setTitle("Register"); 
        $this->views->add('account/register', [ 
            'title' => "Register", 
            'form' => $form->getHTML() 
        ]); 
}




}
}