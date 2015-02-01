<?php

namespace Anax\Homes;

class HomesController implements  \Anax\DI\IInjectionAware {



use \Anax\DI\TInjectable;


public function initialize()
{
    $this->questions = new \Anax\Questions\Question();
    $this->questions->setDI($this->di);

    $this->users = new \Anax\Users\User();
    $this->users->setDI($this->di);

    $this->tags = new \Anax\Tags\Tag();
    $this->tags->setDI($this->di);


}

public function aboutAction(){
	$this->theme->setTitle("About");
	$this->views->add('main/about', [
		'title' => 'About'
		]);
}


public function viewAction(){

	$tag = $this->tags->findAllTagsDistinct();

	$tagall = $this->tags->findAll();
	
	$amount = array();
	foreach($tagall as $tags){
		
$amounts = $this->tags->countTags($tags->title);

array_push($amount, $amounts);
	
	}


$question = $this->questions->getTop5();

$users = $this->getMostActiveUsers();


	$this->theme->setTitle("Home");
	$this->views->add('main/index', [
		'tags' => $tag,
		'alltags' =>$tagall,
		'counts' => 0,
		'questions' => $question,
		'users' => $users

		
	
		]);


}


public function getMostActiveUsers(){
	$users = $this->users->getMostActiveUsers();

	return $users;
}




}