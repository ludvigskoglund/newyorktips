<?php

namespace Anax\Comments;

class CommentsController implements  \Anax\DI\IInjectionAware {



use \Anax\DI\TInjectable;


public function initialize()
{
    $this->questions = new \Anax\Questions\Question();
    $this->questions->setDI($this->di);

    $this->users = new \Anax\Users\User();
    $this->users->setDI($this->di);

    $this->tags = new \Anax\Tags\Tag();
    $this->tags->setDI($this->di);

    $this->comments = new \Anax\Comments\Comment();
    $this->comments->setDI($this->di);

     $this->addComment = new \Anax\Comments\CommentsController();
    $this->addComment->setDI($this->di);


}

public function getUserId(){

    $name = $this->session->get('loggedIn');

    $user = $this->users->findName($name);

    return $user->id;
}



public function addComment($qId){
	$form = $this->form; 

        $form = $form->create([], [ 
            'comment' => [ 
                'type'        => 'text',
                'class' 	  => 'input-md', 
                
              	'placeholder' => 'Add comment',
                'validation'  => ['not_empty'], 
            ],          

          

            
            
            'submit' => [ 
                'type'      => 'submit',
                'class' => 'btn btn-success btn-sm', 
                'value' => 'Add comment',
                'callback'  => function($form) { 



                    $now = date('l - H:i:s | M-Y'); 

                    $this->comments->save([ 
                        'comment'     => $form->Value('comment'), 
                        'time'     => $now, 
                        'userId'         => $this->getUserId(), 
                        'questionId'     => $qId, 
                        
                    ]); 
                                               	
                  	                                       

                    return true; 
                } 
            ], 

        ]); 

        // Check the status of the form 
        $status = $form->check(); 

        if ($status === true) { 
          
            
            $url = $this->url->create('questions/getQuestions/'); 
            $this->response->redirect($url); 
            
            
         
        } else if ($status === false) { 
         
            // What to do when form could not be processed? 
                        $form->AddOutput("<div class='alert alert-dismissable alert-danger' style='width: 50%'>

  <strong>Oh snap!</strong> <br>You must type in a comment.
</div>"); 
            header("Location: " . $_SERVER['PHP_SELF']); 
        } 

       return $form;

}







}