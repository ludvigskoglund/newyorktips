<?php

namespace Anax\MVC;
 
/**
 * Model for Users.
 *
 */
class CDatabaseModel implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

	
    /**
 * Get the table name.
 *
 * @return string with the table name.
 */
public function getSource()
{
    return strtolower(implode('', array_slice(explode('\\', get_class($this)), -1)));
}


/**
 * Find and return all.
 *
 * @return array
 */
public function findAll()
{
    $this->db->select()
             ->from($this->getSource());
 
    $this->db->execute();
    $this->db->setFetchModeClass(__CLASS__);
    return $this->db->fetchAll();
}


public function findAllExceptMe($id){
        $this->db->select()
             ->from($this->getSource())
             ->where('id != ?');
 
    $this->db->execute([$id]);
    $this->db->setFetchModeClass(__CLASS__);
    return $this->db->fetchAll();
}

public function findAllTagsDistinct()
{
    $this->db->select('distinct title')
             ->from($this->getSource());

 
    $this->db->execute();
    $this->db->setFetchModeClass(__CLASS__);
    return $this->db->fetchAll();
}

public function getTop5()
{
        $this->db->select("question.*, user.name")
    ->from('question')
    ->join('user', 'question.userId = user.id')
    ->orderBy("question.id DESC")
    ->limit('5');
 
    $this->db->execute();
    $this->db->setFetchModeClass(__CLASS__);
    return $this->db->fetchAll();
}

public function countTags($title){
        $this->db->select('count(title)')
             ->from($this->getSource())
             ->where('title = ?');
 
    $this->db->execute([$title]);
    
         return $this->db->fetchInto($this);
}


/**
 * Get object properties.
 *
 * @return array with object properties.
 */
public function getProperties()
{
    $properties = get_object_vars($this);
    unset($properties['di']);
    unset($properties['db']);
 
    return $properties;
}

public function getTagsByTitle($title){
        $this->db->select()
    ->from($this->getSource())
    
    ->where("title = ?");

     $this->db->execute([$title]);
    return $this->db->fetchAll();
}

public function listQuestion($qId){

    $this->db->select('question.*, user.name')
    ->from('question')
    ->join('user', 'question.userId = user.id')
    ->where("question.id = ?");

     $this->db->execute([$qId]);
    return $this->db->fetchOne();
}

public function getComments($qId){
       $this->db->select("comment.*, user.name, user.gravatar")
    ->from('comment')
    ->join('user', 'comment.userId = user.id')
    ->where('comment.questionId = ?')
    ->orderBy("comment.id ASC");


    
 
$this->db->execute([$qId]);

return $this->db->fetchAll();

}


public function getAllComments(){
       $this->db->select("comment.*, user.name, user.gravatar")
    ->from('comment')
    ->join('user', 'comment.userId = user.id')
    ->orderBy("comment.id ASC");


    
 
$this->db->execute();

return $this->db->fetchAll();

}

public function getMostActiveUsers(){
    $this->db->select()
    ->from($this->getSource())
    ->orderBy('activity DESC')
    ->Limit('5');

    $this->db->execute();

return $this->db->fetchAll();
}

public function getAnswers($qId){
       $this->db->select("answer.*, user.name, user.gravatar")
    ->from('answer')
    ->join('user', 'answer.userId = user.id')
    ->where('answer.questionId = ?')
    ->orderBy("answer.id ASC");


    
 
$this->db->execute([$qId]);

return $this->db->fetchAll();
}

public function getAnswer($aId){
    $this->db->select()
    ->from('answer')
    ->where('id = ?');

    $this->db->execute([$aId]);

return $this->db->fetchOne(); 

}


public function getAnswerComments($aId){
    $this->db->select()
    ->from('comment')
    ->where('answerId = ?');


    $this->db->execute([$aId]);

return $this->db->fetchAll();
}

public function listAllQuestions(){

    $this->db->select("question.*, user.name")
    ->from('question')
    ->join('user', 'question.userId = user.id')
    ->orderBy("question.id DESC");


    
 
$this->db->execute();

return $this->db->fetchAll();
}

public function listTags(){
    $this->db->select()
    ->from('tag');

        $this->db->execute();

return $this->db->fetchAll();
}

/**
 * Find and return specific.
 *
 * @return this
 */
public function find($id)
{
    $this->db->select()
             ->from($this->getSource())
             ->where("id = ?");
 
    $this->db->execute([$id]);
    return $this->db->fetchInto($this);
}

public function getLatestQuestionId($now){
    $this->db->select("id")
    ->from($this->getSource())
    ->where("time = ?");
    
    $this->db->execute([$now]);

return $this->db->fetchInto($this);
}





public function findName($name)
{
    $this->db->select()
             ->from($this->getSource())
             ->where("name = ?");
 
    $this->db->execute([$name]);
    return $this->db->fetchInto($this);
}

public function findTag($title)
{
    $this->db->select()
             ->from($this->getSource())
             ->where("title = ?");
 
    $this->db->execute([$title]);
    return $this->db->fetchInto($this);
}

public function findQuestionByUserId($id)
{
    $this->db->select()
             ->from($this->getSource())
             ->where("userId = ?");
 
    $this->db->execute([$id]);
    return $this->db->fetchAll();
}

/**
 * Save current object/row.
 *
 * @param array $values key/values to save or empty to use object properties.
 *
 * @return boolean true or false if saving went okey.
 */
public function save($values = [])
{
    $this->setProperties($values);
    $values = $this->getProperties();
 
    if (isset($values['id'])) {
        return $this->update($values);
    } else {
        return $this->create($values);
    }
}

public function saveTags($values = [])
{
    $this->setProperties($values);
    $values = $this->getProperties();


 
    
        return $this->create($values);
    
    
}

/**
 * Set object properties.
 *
 * @param array $properties with properties to set.
 *
 * @return void
 */
public function setProperties($properties)
{
    // Update object with incoming values, if any
    if (!empty($properties)) {
        foreach ($properties as $key => $val) {
            $this->$key = $val;
        }
    }
}

public function create($values)
{
    $keys   = array_keys($values);
    $values = array_values($values);
 
    $this->db->insert(
        $this->getSource(),
        $keys
    );
 
    $res = $this->db->execute($values);
 
    $this->id = $this->db->lastInsertId();
 
    return $res;
}


/**
 * Update row.
 *
 * @param array $values key/values to save.
 *
 * @return boolean true or false if saving went okey.
 */
public function update($values)
{
    $keys   = array_keys($values);
    $values = array_values($values);
 
    // Its update, remove id and use as where-clause
    unset($keys['id']);
    $values[] = $this->id;
 
    $this->db->update(
        $this->getSource(),
        $keys,
        "id = ?"
    );
 
    return $this->db->execute($values);
}







/**
 * Delete row.
 *
 * @param integer $id to delete.
 *
 * @return boolean true or false if deleting went okey.
 */
public function delete($id)
{
    $this->db->delete(
        $this->getSource(),
        'id = ?'
    );

    return $this->db->execute([$id]);
}




/**
 * Build a select-query.
 *
 * @param string $columns which columns to select.
 *
 * @return $this
 */
public function query($columns = '*')
{
    $this->db->select($columns)
             ->from($this->getSource());
 
    return $this;
}

/**
 * Build the where part.
 *
 * @param string $condition for building the where part of the query.
 *
 * @return $this
 */
public function where($condition)
{
    $this->db->where($condition);
 
    return $this;
}


/**
 * Build the where part.
 *
 * @param string $condition for building the where part of the query.
 *
 * @return $this
 */
public function andWhere($condition)
{
    $this->db->andWhere($condition);
 
    return $this;
}


/**
 * Execute the query built.
 *
 * @param string $query custom query.
 *
 * @return $this
 */
public function execute($params = [])
{
    $this->db->execute($this->db->getSQL(), $params);
    $this->db->setFetchModeClass(__CLASS__);
 
    return $this->db->fetchAll();
}
 
}