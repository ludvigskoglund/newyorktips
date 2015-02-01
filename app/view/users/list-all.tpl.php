
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="row">
			<div class="col-md-12">	
				<div id='main' class="panel panel-danger">
					<div class="panel-heading"><?=$title?></div>
				<div class="panel-body ">		

					<?php foreach ($users as $user) : ?>
    					<!---<td><a href='id/<?=$user->id?>'>-->

    					<div class="col-md-4">
    					<a href='getUserProfile/<?=$user->id?>'><div class="user" id="users"><img class="circular" src=<?=$user->gravatar?> /> <?=$user->name?></div></a>
  						</div>
					<?php endforeach; ?>


				</div>
				</div>
			</div>		
</div>


