<?php

namespace Anax\Tags;
 
/**
 * Model for Users.
 *
 */
class Tag extends \Anax\MVC\CDatabaseModel
{


	public function countTags($title){
        $this->db->select('count(title)')
             ->from($this->getSource())
             ->where('title = ?');
 
    $this->db->execute([$title]);
    
         return $this->db->fetchAll();
}


 
}