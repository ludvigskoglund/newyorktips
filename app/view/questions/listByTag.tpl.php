<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<div class="row">
			<div class="col-md-12">	
				<div id='main' class="panel panel-success">
					<div class="panel-heading">Questions</div>
				<div class="panel-body">
				

				<table class="table ">
									<?php foreach ($questions as $question) : ?>
    					<!---<td><a href='id/<?=$user->id?>'>-->

    					<tr>
    					<td><i class="fa fa-question-circle red"></i> <a href='getQuestion/<?=$question->id ?>'><?=$question->title?></a></td>
    					<td><i class="fa fa-user blue"></i> <a href='../users/getUserProfile/<?=$question->userId?>'><?=$question->name?></a></td>
    					<td><span class="comment-time"><i class="fa fa-clock-o"></i>  <?=$question->time?></span></td>
    					</tr>
                        <tr>
                        

                    


                        <td colspan="3">
                        <?php foreach ($tags as $tag) : ?>
                            <?php if($tag->questionId == $question->id) : ?>
                                <span class="label label-primary"><i class="fa fa-tag"> </i> <?=$tag->title?></span>

                            <?php endif; ?>                         
                            
                        <?php endforeach; ?>
                            <hr></td>
                    
 </tr>
  
					<?php endforeach; ?>
</table>



				</div>
				</div>
			</div>

			

</div>


