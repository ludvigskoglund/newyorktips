
	$('.logoutBtn').click(function(){

		
		$('#logoutAlert').removeClass('hidden');
		
		
		

	});

/* Markdown code */
$('#h1').click(function(){
$('#form-element-question').val($('#form-element-question').val()+'Your header \n================='); 
});

$('#h2').click(function(){
$('#form-element-question').val($('#form-element-question').val()+'Your header \n------------'); 
});


$('#h3').click(function(){
$('#form-element-question').val($('#form-element-question').val()+'### Your header'); 
});

$('#h4').click(function(){
$('#form-element-question').val($('#form-element-question').val()+'#### Your header'); 
});

$('#list').click(function(){
$('#form-element-question').val($('#form-element-question').val()+'* item1\n* item2\n* item3'); 
});

/* ANSWER */

$('#h1').click(function(){
$('#form-element-answer').val($('#form-element-answer').val()+'Your header \n================='); 
});

$('#h2').click(function(){
$('#form-element-answer').val($('#form-element-answer').val()+'Your header \n------------'); 
});


$('#h3').click(function(){
$('#form-element-answer').val($('#form-element-answer').val()+'### Your header'); 
});

$('#h4').click(function(){
$('#form-element-answer').val($('#form-element-answer').val()+'#### Your header'); 
});

$('#list').click(function(){
$('#form-element-answer').val($('#form-element-answer').val()+'* item1\n* item2\n* item3'); 
});