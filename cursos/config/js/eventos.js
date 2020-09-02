document.onkeyup = function(e){
   if(e.which == 27){
		fecharNivel();
	    return false;
   }
};

function eventAbas(){
	
	//EVENTOS PARA AS ABAS
	var onClick = function(){		
		var id_div;		 		
		
		$('div[nivel='+nivel+'].camada').find('div').find('div.aba_interna').each(function(){			
			id_div = $(this).removeClass('ativa').attr('divExibir');		
			$('#' + id_div).slideUp();
		});				
		
		id_div = $(this).addClass('ativa').attr('divExibir');				
		
		$('#'+id_div).slideDown();						
		
	};
	
	$('body').off('click', '.aba_interna').on('click', '.aba_interna', onClick);
	
}

function eventRolarParaTopo(){
	$('body,html').animate({
		scrollTop: 0
	});
}

function eventDestacar(tipo){

	var mouseover;
	var mouseout;
	
	if( tipo == 1 ){
		
		mouseover = function(){
			$(this).addClass('destacado');
		};
		
		mouseout = function(){
			$(this).removeClass('destacado');
		};
		
	}else if( tipo == 2 ){
		
		mouseover = function(){
			$('.destacaLinha[ref='+$(this).attr('ref')+']').addClass('destacado');
		};
		
		mouseout = function(){
			$('.destacaLinha[ref='+$(this).attr('ref')+']').removeClass('destacado');
		};
		
	}
	
	$('body').off('mouseover,mouseout', '.destacaLinha')
	.on('mouseover', '.destacaLinha', mouseover).on('mouseout', '.destacaLinha', mouseout);
	
}

function eventValidateForm(){
	$('body').off('submit', '.validate').on('submit', '.validate', validateForm);
}

function eventFechar(){
	/*var mouseover = function(){		
		$(this).css({'background':'url("'+caminhoImg+'fechar2.png") no-repeat'});
	};
	
	var mouseout = function(){
		$(this).css({'background':'url("'+caminhoImg+'fechar.png") no-repeat'});
	};
		
	$('body').off('mouseover,mouseout', '.fechar')
	.on('mouseover', '.fechar', mouseover).on('mouseout', '.fechar', mouseout);	*/
}

function eventFocoForm(){
	
	var focoIn = function(){		
		$(this).addClass('emFoco');
	};
	
	var focoOut = function(){
		$(this).removeClass('emFoco');
	};

	$('body').off('focusin, focusout', 'form input, form select, form textarea')
	.on('focusin', 'form input, form select, form textarea', focoIn)
	.on('focusout', 'form input, form select, form textarea', focoOut);	
	
}

function eventMostrarTitle(){
	
	var onClick = function(){		
		$('.mostrarTitle').remove();
		mostrarTitle( this );
	};
	
	var onClose = function(){
		$(this).remove();	
	};

	$('body').off('click', '[mostrarTitle]').on('click', '[mostrarTitle]', onClick);
	
}