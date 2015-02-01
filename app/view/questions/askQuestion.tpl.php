<script data-require="jquery@*" data-semver="2.1.1" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="../../webroot/js/jquery.tagsinput.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../webroot/css/jquery.tagsinput.css" />
<div class="row">
<div class="col-md-6">
<?php


echo $form;
?>
</div>

<div class="col-md-6">
<h3>Markdown</h3>
<i>You can use markdown to style your question.</i>
<hr>

<button class="btn btn-default btn sm" id="h1">H1</button>
<button class="btn btn-default btn sm" id="h2">H2</button>
<button class="btn btn-default btn sm" id="h3">H3</button>
<button class="btn btn-default btn sm" id="h4">H4</button>
<button class="btn btn-default btn sm" id="list"><i class="fa fa-list-ul"></i></button>

</div>
</div>

<script>
	

	$('#tags').tagsInput();
</script>