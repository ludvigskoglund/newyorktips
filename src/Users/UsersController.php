<?php

namespace Anax\Users;

/**
 * A controller for users and admin related events.
 *
 */
class UsersController implements \Anax\DI\IInjectionAware
{


    use \Anax\DI\TInjectable;









    /**
 * Initialize the controller.
 *
 * @return void
 */
public function initialize()
{
    $this->users = new \Anax\Users\User();
    $this->users->setDI($this->di);

    $this->questions = new \Anax\Questions\Question();
    $this->questions->setDI($this->di);

    $this->answers = new \Anax\Answers\Answer();
    $this->answers->setDI($this->di);
}
 

public function getMyProfileAction(){

    $name = $this->session->get('loggedIn');

    $user = $this->users->findName($name);

    $question = $this->questions->findQuestionByUserId($user->id);
        $this->views->add('profile/myProfile', [
        'users' => $user,
        'questions' => $question,
        
    ]);




}

public function getMyId(){
    $name = $this->session->get('loggedIn');

    $user = $this->users->findName($name);

    return $user->id;
}

















/**
 * List all users.
 *
 * @return void
 */
public function listAction()
{
    $this->initialize();
    if($this->getUserId() != null){
         $all = $this->users->findAllExceptMe($this->getUserId());
    }
    else{
        $all = $this->users->findAll();
    }
 
   
 
    $this->theme->setTitle("Users");
    $this->views->add('users/list-all', [
        'users' => $all,
        'title' => "<i class='fa fa-users'></i> Users",
    ]);
}


public function getUserId(){

    $name = $this->session->get('loggedIn');

    $user = $this->users->findName($name);

    if($user){
return $user->id;
    }
    else{
        return null;
    }

    
}

/**
 * List user with id.
 *
 * @param int $id of user to display
 *
 * @return void
 */
public function idAction($id = null)
{
    $this->initialize();
 
    $user = $this->users->find($id);
 
    $this->theme->setTitle("View user with id");
    $this->views->add('users/view', [
        'user' => $user,
    ]);
}


public function getUserProfileAction($id){
    $user = $this->users->find($id);
   $question = $this->questions->findQuestionByUserId($user->id);
   




 
    $this->theme->setTitle("user");
    $this->views->add('profile/sharedProfile', [
        'users' => $user,
        'questions' => $question,

    ]);
}


public function addViewAction()
{
    $this->initialize();
 
    
 
    $this->theme->setTitle("Add user");
    $this->views->add('users/add', [
        
    ]);
}


public function updateAction($id = null)  
    {  
        $form = $this->form; 

        $user = $this->users->find($id); 

        $form = $form->create([], [ 
            'firstname' => [ 
                'type'        => 'text', 
                'placeholder'       => 'Firstname', 
                
                'validation'  => ['not_empty'], 
                'value' => $user->firstname, 
            ], 
            'lastname' => [ 
                'type'        => 'text', 
                'placeholser'       => 'Lastname', 
                'validation'  => ['not_empty'], 
                'value' => $user->lastname, 
            ], 
            'email' => [ 
                'type'        => 'text', 
                'placeholder' => 'Email',
                'validation'  => ['not_empty', 'email_adress'], 
                'value' => $user->email, 
            ], 
            'submit' => [ 
                'type'      => 'submit',
                'class' => 'btn btn-success', 
                'callback'  => function($form) use ($user) { 

                    $now = date(DATE_RFC2822); 

                    $this->users->save([ 
                        'id'        => $user->id, 
                        'firstname'     => $form->Value('firstname'), 
                        'lastname'     => $form->Value('lastname'), 
                        'email'         => $form->Value('email'), 
                        
                    ]); 

                    return true; 
                } 
            ], 

        ]); 

        // Check the status of the form 
        $status = $form->check(); 

        if ($status === true) { 
            $url = $this->url->create('users/getMyProfile/'); 
            $this->response->redirect($url); 
         
        } else if ($status === false) { 
            header("Location: " . $_SERVER['PHP_SELF']); 
            exit; 
        } 

        $this->theme->setTitle("Editera användare"); 
        $this->views->add('users/edit', [ 
            'title' => "Update", 
            'form' => $form->getHTML() 
        ]); 
    }  







public function setupAction(){
    $this->db->setVerbose();

    $default = "http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?f=y";
                    $size = 40;
    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( 'asd@asd.com' ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
 
    $this->db->dropTableIfExists('user')->execute();
    $this->db->dropTableIfExists('question')->execute();
    $this->db->dropTableIfExists('comment')->execute();
    $this->db->dropTableIfExists('tag')->execute();
    $this->db->dropTableIfExists('answer')->execute();
 
    $now = date('l - H:i:s | M-Y'); 
    $this->db->createTable(
        'user',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'name' => ['varchar(80)'],
            'password' => ['varchar(255)'],
            'gravatar' => ['varchar(255)'],
            'firstname' => ['varchar(255)'],
            'lastname' => ['varchar(255)'],
            'email' => ['varchar(255)'],
            'activity' => ['integer']


        ]
        )->execute();

  $this->db->createTable(
        'question',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'question' => ['varchar(144)'],
            'title' => ['varchar(144)'],
            'time' => ['datetime'],
            'userId' => ['integer'],
            'isAnswered' => ['boolean']


        ]

         )->execute();
          $this->db->createTable(

        'comment',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'comment' => ['varchar(144)'],
            'time' => ['datetime'],
            'userId' => ['integer'],
            'questionId' => ['integer'],
            'answerId' => ['integer'],
            
        ]

         )->execute();
          $this->db->createTable(

        'tag',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'title' => ['varchar(144)'],
            'questionId' => ['integer'],
            'amount' => ['integer']
        ]


    )->execute();

          $this->db->createTable(
        'answer',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'answer' => ['varchar(255)'],
            'questionId' => ['integer'],
            'userId' => ['integer'],
            'time' => ['datetime']
          


        ]
        )->execute();


        $this->db->insert(
        'user',
        ['name', 'password', 'gravatar', 'firstname', 'lastname', 'email', 'activity']
    );
 
    

 
    

    $this->db->insert(
        'question',
        ['question', 'title', 'time', 'userId']
    );
 
    


        $this->db->insert(
        'comment',
        ['comment', 'time', 'userId', 'questionId']
    );
 
    
 
   

       $this->db->insert(
        'answer',
        ['answer', 'questionId', 'userId', 'time']
    );

  

     $this->db->insert(
        'tag',
        ['title', 'questionId', 'amount']
    );






}




}