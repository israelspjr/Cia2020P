// JavaScript Document

$('#copiaAdd').click(function(){
	var obj = $('#copiaAux');
	var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
	
	if (!er.test($.trim( obj.val() ))){
		obj.removeClass('valid').addClass('invalid').focus().parent().find('span').html('e-mail inválido').fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
	}else{
		$('#copia').append($('<option>').text( obj.val() ));
		obj.removeClass('invalid').addClass('valid').val('').focus().parent().find('span').fadeOut(500);		
	}			
});

$('#copiaRemove').click(function(){
	$('#copia').find('option:selected').remove();	
});

$('#copiaOcultaAdd').click(function(){
	var obj = $('#copiaOcultaAux');
	var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
	
	if (!er.test($.trim( obj.val() ))){
		obj.removeClass('valid').addClass('invalid').focus().parent().find('span').html('e-mail inválido').fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
	}else{
		$('#copiaOculta').append($('<option>').text( obj.val() ));
		obj.removeClass('invalid').addClass('valid').val('').focus().parent().find('span').fadeOut(500);		
	}			
});

$('#copiaOcultaRemove').click(function(){
	$('#copiaOculta').find('option:selected').remove();	
});