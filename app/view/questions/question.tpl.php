<script data-require="jquery@*" data-semver="2.1.1" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<div class="panel panel-success">
	<div class="panel-heading"><?=$questions->title?> <span class="pull-right"><?=$questions->name?></span></div>
		<div class="panel-body">
		<?=$content?>
		</div>
		<div class="panel-footer">

<?php
      if($this->AccountController->isLoggedIn()) :?>

<?php echo $form ?>

<?php endif ?>
<table class="table table-striped">
	<?php if ($comments) : ?>
			<?php foreach ($comments as $comment) : ?>
				<tr>
				<td style="width: 15%;">
				<img class="circular" src="<?=$comment->gravatar?>"/><br>
				<span class="comment-name"><?=$comment->name?></span>


				</td>
				<td><i class="commentText">
				 <?php
				 echo $this->textFilter->doFilter($comment->comment, 'shortcode, markdown'); 
				 ?>
				 

				 	</i> <br>
					<span class="pull-right comment-time"><i class="fa fa-clock-o"></i> <?=$comment->time?></span></td>
				</tr>

				

				<!--<p><i class="fa fa-comment"> </i> <i><?=$comment->comment?></i> <span class="comment-time"><i class="fa fa-clock-o"></i> <?=$comment->time?></span><span class="comment-name"> <i class="fa fa-user"></i> <?=$comment->name?></span></p> -->

	

			<?php endforeach; ?>
			<?php else : ?>

				<?php if($this->AccountController->isLoggedIn()) :?>
<tr><td style="width: 15%;"><i>Be the first one to comment!</i></td></tr>

<?php else :?>
<tr><td style="width: 15%;"><i>Please <a href="../../account/login">login</a> to comment!</i></td></tr>

	<?php endif?>


<?php endif?>


			</table>
		

			
		</div>

</div>


<div class="panel panel-primary">
	<div class="panel-heading">Answers</div>
	<div class="panael-body">
	<table class="table table-striped table-hover">

	<?php foreach ($answers as $answer) : ?>
<?php  $acontent = $this->textFilter->doFilter($answer->answer, 'shortcode, markdown') ?>
	<tr class="answer">
	<td style="width: 15%;"> <img class="circular" src="<?=$answer->gravatar?>"/><br> <?=$answer->name?></td>
	<td><article><?=$acontent?></article><br>
	<span class="pull-right comment-time"><i class="fa fa-clock-o"></i> <?=$answer->time?></span><br>
	<a href="../addAnswerComment/<?=$answer->id."/" . $questions->id?>"><button class="btn btn-default btn-xs pull-right"> Comment</button></a>
	

	</td>
	</tr>

	<?php foreach($answerComments as $answerComment) :?>
	<?php if($answer->id == $answerComment->answerId) :?>
		<tr>
		<td style="width: 20%">
		<span  style="margin-left: 30px"><img class="circular-sm" src="<?=$answerComment->gravatar?>"/> <?=$answerComment->name?></span>
		</td>
		<td>		<i style="color:gray"> <?php
				 echo $this->textFilter->doFilter($answerComment->comment, 'shortcode, markdown'); 
				 ?></i> <span class="pull-right comment-time"><i class="fa fa-clock-o"></i> <?=$answerComment->time?></span></td>
		</tr>

	<?php endif?>
<?php endforeach ?>
	

<?php endforeach ?>



	
	

	</table>


	</div>
</div>

<?php if($this->AccountController->isLoggedIn()) :?>
<a href="../addAnswer/<?=$questions->id?>"><button class="btn btn-info"> Answer this question</button></a>

<?php else :?>
	<i>Please <a href="../../account/login">login</a> to answer!</i>
	
<?php endif ?>



