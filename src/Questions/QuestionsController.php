<?php

namespace Anax\Questions;

class QuestionsController implements  \Anax\DI\IInjectionAware {



use \Anax\DI\TInjectable;

private $questionId;
private $answerId;

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

    $this->answerCtrl = new \Anax\Answers\AnswersController();
    $this->answerCtrl->setDI($this->di);

    $this->answers = new \Anax\Answers\Answer();
    $this->answers->setDI($this->di);


}

public function aboutAction(){
    $this->theme->setTitle("About");
    $this->views->add('main/about', [
        'title' => 'About'
        ]);
}
public function getQuestionsAction(){

	$question = $this->questions->listAllQuestions();

	$tags = $this->tags->listTags();


	




	        $this->views->add('questions/list', [ 
           
            'questions' => $question,
            'tags' => $tags,
            
        ]); 


}


public function viewAction(){




	$this->theme->setTitle("Questions");
	$this->views->add('questions/list');




}

public function getUserId(){

    $name = $this->session->get('loggedIn');

    $user = $this->users->findName($name);

    return $user->id;
}

public function increseUserActivity($id){

    $user = $this->users->find($id);

    $activity = $user->activity;
    $activity++;

    return $activity;
}

public function insertTags($string){

$tagArray = explode(',', $string);

return $tagArray;

}

public function getLatestQuestionId($now){
	$question = $this->questions->getLatestQuestionId($now);

	return $question->id;
}



public function addQuestionAction(){
	$form = $this->form; 

        $form = $form->create([], [ 
            'title' => [ 
                'type'        => 'text',
                'class' 	  => 'input-md', 
                'label'       => 'Title', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
            ], 
            'question' => [ 
                'type'        => 'textarea',
                'class' 	  => 'input-md',  
                'label'       => 'Question', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
            ], 

            'tags' => [ 
            	'id' 		  => 'tags',
                'type'        => 'text',
                'class' 	  => 'input-md',  
                'placeholder' => 'tags', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
            ], 

            
            
            'submit' => [ 
                'type'      => 'submit',
                'class' => 'btn btn-success', 
                'value' => 'Ask',
                'callback'  => function($form) { 



                    $now = date('l - H:i:s | M-Y'); 
              
                    $this->questions->save([ 
                        'question'     => $form->Value('question'), 
                        'title'     => $form->Value('title'), 
                        'time'         => $now, 
                        'userId'     => $this->getUserId(),
                        'isAnswered' => false, 
                        
                    ]); 

                    $this->users->save([
                        'id' => $this->getUserId(),
                        'activity' => $this->increseUserActivity($this->getUserId()),
                        ]);


                    $tags = $this->insertTags($form->Value('tags'));
                    $qId = $this->getLatestQuestionId($now);
                    

                    



                  

                    foreach($tags as $tag){




                    		$this->db->insert(
        					'tag',
        					['title', 'questionId', 'amount']
    						);
 
    
 
    						$this->db->execute([
        						strtolower($tag),
        						$qId,
        						1
        
    						]);
                    	

                    	

                    	

                            

                    }



                    return true; 
                } 
            ], 

        ]); 

        // Check the status of the form 
        $status = $form->check(); 

        if ($status === true) { 
          
            
            $url = $this->url->create('questions/getQuestions'); 
            $this->response->redirect($url); 
            
            
         
        } else if ($status === false) { 
         
            // What to do when form could not be processed? 
            $form->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>"); 
            header("Location: " . $_SERVER['PHP_SELF']); 
        } 

        $this->theme->setTitle("Ask question"); 
        $this->views->add('questions/askQuestion', [ 
            'title' => "Lägg till användare", 
            'form' => $form->getHTML() 
        ]); 

}


public function getQuestionAction($qId){

    $question = $this->questions->listQuestion($qId);
    $comment  = $this->getComments($qId);

    $commentForm = $this->addComment($qId);
   
    $answer = $this->answers->getAnswers($qId);

    $answerComments = $this->comments->getAllComments();

    


   
    

    $content = $this->textFilter->doFilter($question->question, 'shortcode, markdown');

   
    

    $this->views->add('questions/question', [
        'title' => 'Question',
        'questions' => $question,
        'content' =>$content,
        'comments' => $comment,
        'form' => $commentForm->getHTML(),
        'answerComments' => $answerComments,
        'answers' => $answer,
                
        
        ]);
}

public function getComments($qId){
    $comments = $this->comments->getComments($qId);

    return $comments;

    

}


public function addComment($qId){
$this->questionId = $qId;
   
    $form = $this->form; 

        $form = $form->create([], [ 
            'comment' => [ 
                'type'        => 'textarea',
                'class'       => 'input-md', 
                'id' => 'comments',
                'placeholder' => 'Add comment',
                'validation'  => ['not_empty'], 
            ],          

          

            
            
            'submit' => [ 
                'id' => 'comment',
                'type'      => 'submit',
                'class' => 'btn btn-success btn-sm', 
                'value' => 'Add comment',
                'callback'  => function($form) { 



                    $now = date('l - H:i:s | M-Y'); 

                    $this->comments->save([ 
                        'comment'     => $form->Value('comment'), 
                        'time'     => $now, 
                        'userId'         => $this->getUserId(), 
                        'questionId'     => $this->questionId
                        
                    ]); 

                    $this->users->save([
                        'id' => $this->getUserId(),
                        'activity' => $this->increseUserActivity($this->getUserId()),
                        ]);
    

                    return true; 
                } 
            ], 

        ]); 

        // Check the status of the form 
        $status = $form->check(); 

        if ($status === true) { 
          
            
            $url = $this->url->create('questions/getQuestion/' . $qId); 
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


public function addAnswerAction($qId){
$this->questionId = $qId;

$question = $this->questions->listQuestion($this->questionId);
 $content = $this->textFilter->doFilter($question->question, 'shortcode, markdown');


    $form = $this->form; 

        $form = $form->create([], [ 
            'answer' => [ 
                'type'        => 'textarea',
                'class'       => 'input-md',                 
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
                        'questionId'     => $this->questionId, 
                        'userId'         => $this->getUserId(), 
                        'time'     => $now, 
                        
                    ]); 

                    $this->users->save([
                        'id' => $this->getUserId(),
                        'activity' => $this->increseUserActivity($this->getUserId()),
                        ]);

                    $this->questions->save([ 
                        'id' => $this->questionId,
                        'isAnswered' => true,
                        
                    ]); 
                                                
                                                           

                    return true; 
                } 
            ], 

        ]); 

        // Check the status of the form 
        $status = $form->check(); 

        if ($status === true) { 
          
            
            $url = $this->url->create('questions/getQuestion/'.$this->questionId ); 
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
            'form' => $form->getHTML(),
            'questions' => $question,
            'content' => $content,
            'comments' => $this->getComments($this->questionId),
            'answers' => $this->answers->getAnswers($qId)
        ]); 

}


public function getQuestionByTagAction($title){

$title = urldecode($title);


    $tags = $this->tags->getTagsByTitle($this->replaceTagTitle($title));

    $questions = array();
        foreach($tags as $tag){

            $question = $this->questions->listQuestion($tag->questionId);
            array_push($questions, $question);

    }

$tags = $this->tags->listTags();
          


            $this->views->add('questions/list', [ 
           
            'questions' => $questions,
            'tags' => $tags,
            
           
            
        ]);


    

}


public function replaceTagTitle($title){
    
    if(strpos($title, '%20')){
            $title =  str_replace("%20"," ",$title);
            return $title;
    }
    if(strpos($title, '%C3%A5')){
            $title =  str_replace("%C3%A5","å",$title);
            return $title;
    }
    else{
        return $title;
    }

}


public function addAnswerCommentAction($aId, $qId){
   
$this->answerId = $aId;
$answer = $this->answers->getAnswer($aId);


 $content = $this->textFilter->doFilter($answer->answer, 'shortcode, markdown');


    $form = $this->form; 

        $form = $form->create([], [ 
            'comment' => [ 
                'type'        => 'textarea',
                'class'       => 'input-md',                 
                'placeholder' => 'Your comment',
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
                        'answerId'     => $this->answerId,
                        
                    ]); 

                    $this->users->save([
                        'id' => $this->getUserId(),
                        'activity' => $this->increseUserActivity($this->getUserId()),
                        ]);

                    
                                                
                                                           

                    return true; 
                } 
            ], 

        ]); 

        // Check the status of the form 
        $status = $form->check(); 

        if ($status === true) { 
          
            
            $url = $this->url->create('questions/getQuestion/'.$qId ); 
            $this->response->redirect($url); 
            
            
            
         
        } else if ($status === false) { 
         
            // What to do when form could not be processed? 
                        $form->AddOutput("<div class='alert alert-dismissable alert-danger' style='width: 50%'>

  <strong>Oh snap!</strong> <br>You must type in an answer.
</div>"); 
            header("Location: " . $_SERVER['PHP_SELF']); 
        } 

              $this->theme->setTitle("Ask question"); 
        $this->views->add('answers/commentAnswer', [ 
            'title' => "Lägg till användare", 
            'form' => $form->getHTML(),
            'answer' => $content
        ]); 

}






}