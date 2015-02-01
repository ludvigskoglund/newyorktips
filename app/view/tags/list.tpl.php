<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="row">
			<div class="col-md-12">	
				<div id='main' class="panel panel-primary">
					<div class="panel-heading">Tags</div>
				<div class="panel-body">
				<?php foreach ($tags as $tag) : ?>
    					<!---<td><a href='id/<?=$user->id?>'>-->


    						<?php $counts = 0; foreach ($alltags as $all) : ?>
    					<?php if ($all->title == $tag->title) : ?>
    						<?php $counts = $counts + 1;?>

    					<?php endif;?>
    					<?php endforeach; ?>

                        <?php $tagName = $tag->title?>

    					<?php if ($counts < 2) : ?>	

    					<a href='../questions/getQuestionByTag/<?php if(strpos($tag->title, '#')) : ?><?= $tag->title =  str_replace("#","%23",$tag->title); ?> <?php else : ?><?=$tag->title?> <?php endif ?> '><span class="label label-primary label-s"><i class="fa fa-tag"> </i> <?=$tagName?></span></span></a>
    					<?php endif;?>

    					<?php if ($counts == 2) : ?>	
    					<a href='../questions/getQuestionByTag/<?php if(strpos($tag->title, '#')) : ?><?= $tag->title =  str_replace("#","%23",$tag->title); ?> <?php else : ?><?=$tag->title?> <?php endif ?> '><span class="label label-primary label-m"><i class="fa fa-tag"> </i> <?=$tagName?></span></span></a>
    						<?php endif;?>

    								<?php if ($counts == 3) : ?>	
    					<a href='../questions/getQuestionByTag/<?php if(strpos($tag->title, '#')) : ?><?= $tag->title =  str_replace("#","%23",$tag->title); ?> <?php else : ?><?=$tag->title?> <?php endif ?> '><span class="label label-primary label-l"><i class="fa fa-tag"> </i> <?=$tagName?></span></span></a>
    						<?php endif;?>
    							<?php if ($counts > 3) : ?>	
    					<a href='../questions/getQuestionByTag/<?php if(strpos($tag->title, '#')) : ?><?= $tag->title =  str_replace("#","%23",$tag->title); ?> <?php else : ?><?=$tag->title?> <?php endif ?> '><span class="label label-primary label-xl"><i class="fa fa-tag"> </i> <?=$tagName?></span></span></a>
    						<?php endif;?>
  
					<?php endforeach; ?>






				</div>
				</div>
			</div>

			

</div>


