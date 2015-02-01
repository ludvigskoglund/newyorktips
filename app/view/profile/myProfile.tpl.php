
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<div class="row">
			<div class="col-md-6">	
				<div id='main' class="panel panel-danger">
					<div class="panel-heading"><?=$users->name?>'s profile <a href="update/<?=$users->id?>" class="pull-right"><i class="fa fa-edit"> </i></a></div>
				<div class="panel-body">
					<div class="row">
				<div class="col-md-2">
				<img class="circular" src="<?=$users->gravatar?>"/>
				</div>
				<div class="col-md-10">
				<i class="fa fa-user"></i> <?=$users->firstname?> <?=$users->lastname?><br>
				<i class="fa fa-envelope"></i> <?=$users->email?><br>
				<i class="fa fa-line-chart" title="Activity"></i> <?=$users->activity?>
				</div>
				</div>
				</div>


				</div>

			</div>

			<div class="col-md-6">	
				<div id='main' class="panel panel-success">
					<div class="panel-heading"><?=$users->name?>'s questions</div>
				<div class="panel-body">
				<?php foreach ($questions as $question) : ?>
    					<!---<td><a href='id/<?=$user->id?>'>-->

    					
    					<h4><a href='../questions/getQuestion/<?=$question->id ?>'><?=$question->title?></a></h4>
    					
    					<hr>
  
					<?php endforeach; ?>	
				</div>

				</div>
			</div>

			

</div>


