//
var submitForm = false;

/* Required message */
var requiredMsg = "Campo obrigatório!";
/* E-mail message */
var mailMsg = "O e-mail informado é inválido!";
/* CPF message */
var cpfMsg = "CPF informado é inválido!";
/* cnpj message */
var cnpjMsg = "CNPJ informado é inválido!";
/* cnpj message */
var rneMsg = "RNE informado é inválido!";
/* cnpj message */
var rneMsg = "RNE informado é inválido!";
/* cnpj message */
var passMsg = "Passaporte informado é inválido!";
/* Data message */
var dataMsg = "Data informada é inválida!";    
/* Numeric message */
var numericMsg = "O valor deve ser númerico!";
/* minlength message */
var minMsg = "Informe ao menos X caracters!";
/* maxlength message */
var maxMsg = "A quantidade máxima é de X caracters!";
/* Password message */
var passwordMsg = "Senhas não conferem!";
/* Telefone message */
var foneMsg = "O telefone informado é inválido.";
/* Percentual message */
var percentualMsg = "Deve estar entre 0 e 100 (utilize a virgula como casa decimal).";    
/* Percentual message */
var rgMsg = "O RG informado é inválido.";  
/* Percentual message */
var horaMsg = "A hora informada é inválida.";   
/* Percentual message */
var notaMsg = "Deve estar entre 0 a 10 (utilize a virgula como casa decimal).";  
/* Percentual message */
var seteDiasMsg = "Valor deve estar entre 1 e 7."; 
//valor minimo
			
function campoInvalido(obj, msg){
	//
	$('body,html').animate({						
		scrollTop: $(obj).offset().top - 25
	});
				
	$(obj).removeClass('valid').addClass('invalid');					
	$(obj).focus();
	$(obj).parent().find('span.placeholder').html(msg).stop(true, true).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);

}

function campoValido(obj){
	$(obj).removeClass('invalid').addClass('valid');
	$(obj).parent().find('span.placeholder').stop(true, true).fadeOut(500);	
}

function ativarForm(){		
	 	
	try{
		$(function(){	
							
			$('.validate p span').hide();
										
			/* mascara data */
			$('.data')
			.mask('99/99/9999')
			.datepicker({					
				dateFormat: 'dd/mm/yy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
				nextText: 'Próximo',
				prevText: 'Anterior'
			});
			
			//min em password
			$('.password').attr('minlength','6');
			/* mascara horas do dia */
			$('.hora').mask('99:99');
			/* mascara horas do dia */
			$('.hora2').mask('999:99');
			/* mascara cpf */
			$('.cpf').mask('999.999.999-99');			
			/* mascara cnpj */
			$('.cnpj').mask('99.999.999/9999-99');
			/* mascara RNE*/
			$('.rne').mask('A999999-A');
			/* mascara passaporte*/
			$('.passaporte').mask('AAAAAAZZZZZZZZZ', {translation:  {'Z': '[A-Za-z0-9]?'}} );
			/* mascara telefone */
			$('.fone').mask('99999-9999');						
			/* mascara cep */
			$('.cep').mask('99999-999'); 
			/*mascara rg*/
			$('.rg').mask('99.999.999-AA');			
			/* mascara mes */
			$('.mes').mask('99');			
			/* mascara ano */
			$('.ano').mask('9999');	
									
			/* Aplicando Placeholder com texto do SPAN */
			$(this).find('.required').each(function(){
				$(this).attr('placeholder', $(this).parent().find('span').html() );
			});
							
		});
	}catch(err){
		alert("error in "+err.description);
	}
}

var validateForm = function() {
				
	//alert( $(this).attr('id') );				
	var valid = true;
				
	$(this).find('input[type=text], input[type=password], select, textarea').each(function(i){

		/* required */
		if ( $(this).hasClass('required') ){
			if ( $.trim( $(this).val() ) == ''){
				campoInvalido(this, requiredMsg);					
				valid = false;
				return false;						
			}else{
				campoValido(this);							
			}
		}
		
		/*rg*/
		if ( $(this).hasClass('rg') ){										
			if( $.trim($(this).val()).length < 10 && $.trim($(this).val())!='' ){
				campoInvalido(this, rgMsg);
				valid = false;
				return false;  
			}else{
				campoValido(this);
			} 
		}
		
		/*nota*/
		if ( $(this).hasClass('nota') ){												
			var nan = new RegExp(/(^-?\d\d*\,\d*$)|(^-?\d\d*$)|(^-?\,\d\d*$)/);																					
			if( $.trim($(this).val())!='' &&
				( !nan.test($.trim($(this).val())) || $(this).val().replace(',','.') > 10 || $(this).val().replace(',','.') < 0 )
			){
				campoInvalido(this, notaMsg);							
				valid = false;
				return false;  
			}else{
				campoValido(this);
			} 
		}
		
		/*percentual*/
		if ( $(this).hasClass('percentual') ){		
		
			var nan = new RegExp(/(^-?\d\d*\,\d*$)|(^-?\d\d*$)|(^-?\,\d\d*$)/);																					
			
			if( $.trim($(this).val())!='' && 
				( !nan.test($.trim($(this).val())) || $(this).val().replace(',','.') > 100 || $(this).val().replace(',','.') < 0 )
			){
				campoInvalido(this, percentualMsg);							
				valid = false;
				return false;  
			}else{
				campoValido(this);
			} 
		}
	
		/*fone*/
		if ( $(this).hasClass('fone') ){										
			if( $.trim($(this).val()).length < 9 && $.trim($(this).val())!='' ){
				campoInvalido(this, foneMsg);
				valid = false;
				return false;  
			}else{
				campoValido(this);
			} 
		}
		
		/*passaporte*/
		if ( $(this).hasClass('passaporte') ){										
			if( $.trim($(this).val())!='' && $.trim($(this).val()).length < 6 ){
				campoInvalido(this, passMsg);
				valid = false;
				return false;  
			}else{
				campoValido(this);
			} 
		}
	
		/*hora*/
		if ( $(this).hasClass('hora') ){											
			if( $.trim($(this).val()).length < 5 && $.trim($(this).val())!='' ){							
				campoInvalido(this, horaMsg);
				valid = false;
				return false;  
			}else{
				campoValido(this);
			} 
		}
		
		/*hora2*/
		if ( $(this).hasClass('hora2') ){											
			if( $.trim($(this).val()).length < 6 && $.trim($(this).val())!='' ){							
				campoInvalido(this, horaMsg);
				valid = false;
				return false;  
			}else{
				campoValido(this);
			} 
		}
												
		/*rne*/					
		if ( $(this).hasClass('rne') ){											
			if( $.trim($(this).val()).length < 9 && $.trim($(this).val())!=''){
				campoInvalido(this, rneMsg);
				valid = false;
				return false;  						
			}else{
				campoValido(this);
			} 
		}
		
		/*seteDias*/					
		if ( $(this).hasClass('seteDias') ){											
			if( $.trim($(this).val()) != '' && ( parseInt($(this).val()) < 1 || parseInt($(this).val()) > 7 ) ){
				campoInvalido(this, seteDiasMsg);
				valid = false;
				return false;  						
			}else{
				campoValido(this);
			} 
		}
	
		/* mail */
		if ( $(this).hasClass('email') ){			
			var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
			if ($.trim($(this).val())!='' && !er.test($.trim($(this).val())) ){
				campoInvalido(this, mailMsg);
				valid = false;
				return false;
			}
			else{
				campoValido(this);
			}
		}
	
				
		/* minlength value */
		if ( $(this).attr('minlength') ){
			if($.trim($(this).val()).length < $(this).attr('minlength') ){
				campoInvalido(this, minMsg.replace(/X/g,minMsg));
				valid = false;
				return false;
			}
			else{
				campoValido(this);
			}
		}
		
		/* numeric value */
		if ( $(this).hasClass('numeric') ){
			var nan = new RegExp(/(^-?\d\d*\,\d*$)|(^-?\d\d*$)|(^-?\,\d\d*$)/);
			if ( $.trim($(this).val())!='' && !nan.test($.trim( $(this).val() ))){
				campoInvalido(this, numericMsg);
				$(this).select();
				valid = false;
				return false;
			}
			else{
				campoValido(this);
			}
		}
		
		/* cpf */
		if ( $(this).hasClass('cpf') ){
			if( $.trim($(this).val())!='' ){						
				if( $.trim($(this).val()).length < 14){	
					campoInvalido(this, cpfMsg);
					valid = false;
					return false;
				} else {	
					var cpf = $(this).val().replace('.','');
					cpf = cpf.replace('.','');
					cpf = cpf.replace('-','');
					//while(cpf.length < 11) cpf = "0"+ cpf;
					var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
					var a = [];
					var b = new Number;
					var c = 11;
					for (i=0; i<11; i++){
						a[i] = cpf.charAt(i);
						if (i < 9) b += (a[i] * --c);
					}
					if ((x = b % 11) < 2) {
						a[9] = 0
					} else {
						a[9] = 11-x
					}
					b = 0;
					c = 11;
					for (y=0; y<10; y++) b += (a[y] * c--);
					if ((x = b % 11) < 2) {
						a[10] = 0;
					} else {
						a[10] = 11-x;
					}
					//alert(cpf);
					if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) {
						campoInvalido(this, cpfMsg);
						valid = false;
						return false;
					} else {								
						campoValido(this);
					}										
				}						
			}
		}
	
		/* data */
		if ( $(this).hasClass('data') ){
			if( $.trim($(this).val())!='' ){
				var sdata = $(this).val();
				if(sdata.length!=10){
					campoInvalido(this, dataMsg);
					valid = false;
					return false;   
				}							
				var data        = sdata;
				var dia         = data.substr(0,2);
				var barra1      = data.substr(2,1);
				var mes         = data.substr(3,2);
				var barra2      = data.substr(5,1);
				var ano         = data.substr(6,4);
				
				if(data.length!=10||barra1!="/"||barra2!="/"||isNaN(dia)||isNaN(mes)||isNaN(ano)||dia>31||mes>12) {
					campoInvalido(this, dataMsg);
					valid = false;
					return false;            
				}else if((mes==4||mes==6||mes==9||mes==11) && dia==31){
					campoInvalido(this, dataMsg);
					valid = false;
					return false;
				} else if(mes==2 && (dia>29||(dia==29 && ano%4!=0))){
					campoInvalido(this, dataMsg);
					valid = false;
					return false;
				} else if(ano < 1900){
					campoInvalido(this, dataMsg);
					valid = false;
					return false;
				} else {
					campoValido(this);
				}
			}
		} 
							
		/*valida cnpj*/
		if($(this).hasClass('cnpj')){
			if( $.trim($(this).val())!='' ){									
				var cnpj = $(this).val()
				cnpj = cnpj.replace('.','');
				cnpj = cnpj.replace('.','');
				cnpj = cnpj.replace('/','');
				cnpj = cnpj.replace('-','');
				var a = new Array();
				var b = new Number;
				var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];
				for (i=0; i<12; i++){
					a[i] = cnpj.charAt(i);
					b += a[i] * c[i+1];
				}
				if ((x = b % 11) < 2) {
					a[12] = 0
				} else {
					a[12] = 11-x
				}
				b = 0;
				for (y=0; y<13; y++) {
					b += (a[y] * c[y]);
				}
				if ((x = b % 11) < 2) {
					a[13] = 0;
				} else {
					a[13] = 11-x;
				}
				if ((cnpj.charAt(12) != a[12]) || (cnpj.charAt(13) != a[13])){
					campoInvalido(this, cnpjMsg);                    
					valid = false;
					return false;
				} else {
					campoValido(this);
				}
			}
		}
	
		/* maxlength value */
		if ( $(this).attr('maxlength') ){
			if($.trim($(this).val()).length > $(this).attr('maxlength') ){
				campoInvalido(this, maxMsg.replace(/X/g,$(this).attr('maxlength')));			
				valid = false;
				return false;
			}
			else{
				campoValido(this);
			}
		}	

		/* password */
		if ( $(this).hasClass('password') && $(this).parent().parent().find('.password').hasClass('password')){ 						
			if ( $.trim( $(this).val() ) != $.trim( $(this).parent().parent().find('.password').val() ) ){
				campoInvalido(this, passwordMsg);
				valid = false;
				return false;
			}else{ 
				$(this).parent().find('span').html('').fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
				$(this).nextAll('.password').removeClass('invalid').addClass('valid');
				$(this).parent().find('.password').removeClass('invalid').addClass('valid');
				$(this).parent().parent().find('.password').removeClass('invalid').addClass('valid');
				$(this).parent().find('span').fadeOut(500);
			}
		}	
														
	});
					
	submitForm = valid;
	return valid;
	
};


