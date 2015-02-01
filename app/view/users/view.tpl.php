<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">




<h1><i class="fa fa-user"></i> <?=$user->name?></h1> 
<hr>
<h4><i class="fa fa-user"></i> <?=$user->acronym?></h4> 
<h4><i class="fa fa-envelope"></i> <?=$user->email?></h4> 
<p>Created: <?=$user->created?></p> 
<?php if (isset($user->active)): ?> 
    <h4>Active since: <?=$user->active?></h4> 
<?php endif ?> 
<?php if (isset($user->deleted)): ?> 
    <p>In trash since: <?=$user->deleted?></p> 
<?php endif ?> 

<p><a href='<?=$this->url->create('users/list')?>'>List All</a></p> 