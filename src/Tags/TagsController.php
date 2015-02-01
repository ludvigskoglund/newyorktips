<?php

namespace Anax\Tags;

class TagsController implements  \Anax\DI\IInjectionAware {



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


public function viewAction(){

	$tag = $this->tags->findAllTagsDistinct();

	$tagall = $this->tags->findAll();
	
	$amount = array();
	foreach($tagall as $tags){
		
$amounts = $this->tags->countTags($tags->title);

array_push($amount, $amounts);
	
	}



	$this->theme->setTitle("Tags");
	$this->views->add('Tags/list', [
		'tags' => $tag,
		'alltags' =>$tagall,
		'counts' => 0 
		
	
		]);


}

public function countAction(){
	

	



	
}




}