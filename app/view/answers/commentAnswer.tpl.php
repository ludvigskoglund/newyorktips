<script data-require="jquery@*" data-semver="2.1.1" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">





<div class="panel panel-primary">
	<div class="panel-heading">Answer</div>
	<div class="panael-body">
	<table class="table table-striped table-hover">

	<?=$answer?>


	
	

	</table>


	</div>
</div>


<div class="panel panel-info">
	<div class="panel-heading">Comment</div>
	<div class="panael-body">

		<div class="row">
			<div class="col-md-6">
		<?php echo $form ?>
			</div>

			<div class="col-md-6">
			<h4>Markdown</h4>
				<button class="btn btn-default btn sm" id="h1">H1</button>
				<button class="btn btn-default btn sm" id="h2">H2</button>
				<button class="btn btn-default btn sm" id="h3">H3</button>
				<button class="btn btn-default btn sm" id="h4">H4</button>
				<button class="btn btn-default btn sm" id="list"><i class="fa fa-list-ul"></i></button>
				<br><br>
			</div>
		</div>

	</div>
</div>

