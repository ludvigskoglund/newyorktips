<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<div class="row">
			<div class="col-md-6">	
				<div id='main' class="panel panel-success">
					<div class="panel-heading">Latest questions</div>
				<div class="panel-body">
				<table class="table table-striped table-hover">
  <?php foreach ($questions as $question) : ?>
  <!--<a href='questions/getQuestion/<?=$question->id?>'><span class="label label-default label-m"><i class="fa fa-question-circle"></i> <?=$question->title?></span></a><a href='users/getUserProfile/<?=$question->userId?>' class="pull-right"><?=$question->name?></a>
  <hr>-->
<tr>
	<td><a href='questions/getQuestion/<?=$question->id?>'><i class="fa fa-question-circle red"></i> <?=$question->title?></a></td>
	<td><a href='users/getUserProfile/<?=$question->userId?>'><?=$question->name?></a></td>
</tr>

<?php endforeach?>
  </table>

				
				</div>
				</div>
			</div>

			<div class="col-md-6">	
				<div id='main' class="panel panel-primary">
					<div class="panel-heading">Popular tags</div>
				<div class="panel-body taggar">
<?php foreach ($tags as $tag) : ?>
    					<!---<td><a href='id/<?=$user->id?>'>-->
    						<?php $counts = 0; foreach ($alltags as $all) : ?>
    					<?php if ($all->title == $tag->title) : ?>
    						<?php $counts = $counts + 1;?>

    					<?php endif;?>
    					<?php endforeach; ?>

    					<?php if ($counts < 2) : ?>	

    					<a href='questions/getQuestionByTag/<?php if(strpos($tag->title, '#')) : ?><?= $tag->title =  str_replace("#","%23",$tag->title); ?> <?php else : ?><?=$tag->title?> <?php endif ?> ' class="small"><?=$tag->title?></a>
    					<?php endif;?>

    					<?php if ($counts == 2) : ?>	
    							<a href='#' class="medium"><?=$tag->title?></a>
    						<?php endif;?>

    								<?php if ($counts == 3) : ?>	
    							<a href='questions/getQuestionByTag/<?php if(strpos($tag->title, '#')) : ?><?= $tag->title =  str_replace("#","%23",$tag->title); ?> <?php else : ?><?=$tag->title?> <?php endif ?> ' class="large"><?=$tag->title?></a>
    						<?php endif;?>
    							<?php if ($counts > 3) : ?>	
    							<a href='questions/getQuestionByTag/<?php if(strpos($tag->title, '#')) : ?><?= $tag->title =  str_replace("#","%23",$tag->title); ?> <?php else : ?><?=$tag->title?> <?php endif ?> ' class="xLarge"><span style="color:#3498db"><?=$tag->title?></span></a>
    						<?php endif;?>
  
					<?php endforeach; ?>
  

					
				</div>
				</div>
			</div>	

</div>


<div class="row">
			<div class="col-md-6">	
				<div id='main' class="panel panel-danger">
					<div class="panel-heading">Most active users</div>
				<div class="panel-body">


				  <?php foreach ($users as $user) : ?>
				  	<?php if($user->activity > 0) : ?>
				  		<img class="circular-sm" src="<?=$user->gravatar?>"> <a href="users/getUserProfile/<?=$user->id?>"><?=$user->name?></a> <span class="pull-right"><i class="fa fa-line-chart"></i> <?=$user->activity?></span>
				  		<hr>

				  	<?php endif?>	
				  	<?php endforeach?>

				</div>
				</div>
			</div>

			

</div>