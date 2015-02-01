<?php

namespace Anax\Answers;

class AnswersController implements  \Anax\DI\IInjectionAware {



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

    $this->answers = new \Anax\Answers\Answer();
    $this->answers->setDI($this->di);


     $this->answerCtrl = new \Anax\Answers\AnswersController();
    $this->answerCtrl->setDI($this->di);


}

public function getUserId(){

    $name = $this->session->get('loggedIn');

    $user = $this->users->findName($name);

    return $user->id;
}

public function getQuestion($qId){

$question = $this->questions->listQuestion($qId);

return $question;
}

public function hejAction(){
$this->theme->setTitle("Ask question"); 
        $this->views->add('answers/answer', [ 
            'title' => "Lägg till användare", 
            'form' => $form->getHTML() 
        ]); 

}




private $questionId;
public function addAnswerAction($qId){
$this->questionId = $qId;



	$form = $this->form; 

        $form = $form->create([], [ 
            'answer' => [ 
                'type'        => 'textarea',
                'class' 	  => 'input-md',                 
              	'placeholder' => 'Your answer',
                'validation'  => ['not_empty'], 
            ],        

                      
            
            'submit' => [ 
                'type'      => 'submit',
                'class' => 'btn btn-success btn-sm', 
                'value' => 'Add answer',
                'callback'  => function($form) { 

                     
                    $now = date('l - H:i:s | M-Y'); 

                    $this->answers->save([ 
                        'answer'     => $form->Value('answer'), 
                        'questionId'     => 1, 
                        'userId'         => 1, 
                        'time'     => $now, 
                        
                    ]); 

                     
                                               	
                  	                                       

                    return true; 
                } 
            ], 

        ]); 

        // Check the status of the form 
        $status = $form->check(); 

        if ($status === true) { 
          
            
            $url = $this->url->create('questions/getQuestion/'.$questionId ); 
            $this->response->redirect($url); 
            
            
            
         
        } else if ($status === false) { 
         
            // What to do when form could not be processed? 
                        $form->AddOutput("<div class='alert alert-dismissable alert-danger' style='width: 50%'>

  <strong>Oh snap!</strong> <br>You must type in an answer.
</div>"); 
            header("Location: " . $_SERVER['PHP_SELF']); 
        } 

              $this->theme->setTitle("Ask question"); 
        $this->views->add('answers/answer', [ 
            'title' => "Lägg till användare", 
            'form' => $form->getHTML() 
        ]); 

}







}