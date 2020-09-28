$('tr p, table form').css({'margin':'0'});

function gravarHoras(caminhoGravar){
	
	
	var gravado = false, form = new Array(), idForm;
	
	$.each(forms_base, function(index) {       
	 
	 	idForm = forms_base[index][0];
	  form = carregarValorFormsInicial( idForm );
//	 console.log(forms_base[index]); 
//     console.log(form[0]);
	  //VERIFICA SE CAMPO NAO ESTA EM BRANCO E DIFERENTE DO VALOR INICIAL
	  if( forms_base[index][1] != form[0][1] || forms_base[index][2] != form[0][2] ){ //} || forms_base[index][3] != form[0][3] ){			
			gravado = true;
			postForm(idForm, caminhoGravar);						
	  }		  
		
  });
	
	if( !gravado ) alert('Nenhum dia foi alterado.');	
	
	forms_base = carregarValorFormsInicial();
	
}


function carregarValorFormsInicial( id ){	
	var forms = new Array();
	var idOcorrenciaFF;
	
	var seletor = 'form.ff';
	if( id != undefined )	seletor = seletor + '[id='+id+']';
		
	$(seletor).each(function(i) { 		
		
		forms[i] = new Array();		
		
		forms[i][0] = $(this).attr('id'); 
		forms[i][1] = $(this).find('input[type=time].horas').val();
		idOcorrenciaFF = $(this).find('select[name=idOcorrenciaFF]').val();
		forms[i][2] = (idOcorrenciaFF == undefined ? '' : idOcorrenciaFF);
		
  });	
	return forms;
}

var forms_base = carregarValorFormsInicial();

function  gravarAulaInexistente(e, form, caminho){
	$('#'+e).val('00:00');
	postForm(form, caminho, '&acao=aulaInexistente');	
}

function preencheCampo(id, id2){
	$('#'+id2).val( $('#'+id).val() ); 
}

function AllInexistente(){
    $( "form.ff" ).each(function() {
        $('input[name=horasDadas]').val('00:00');
   //     alert($(this).attr('id'));
        postForm($(this).attr('id'), '/cursos/admin/modulos/relacionamento/grupo/include/acao/diaAulaFF.php', '&acao=aulaInexistente');
    });
	alert("Aulas inativadas com sucesso");
}

function AllInexistenteAut(){
    $( "form.ff" ).each(function() {
        $('input[name=horasDadas]').val('00:00');
   //     alert($(this).attr('id'));
        postForm($(this).attr('id'), '/cursos/admin/modulos/relacionamento/grupo/include/acao/diaAulaFF.php', '&acao=aulaAut');
    });
//	alert("Aulas inativadas com sucesso");
}

function AllInexistenteProf(){
    $( "form.ff" ).each(function() {
        $('input[name=horasDadas]').val('00:00');
   //     alert($(this).attr('id'));
        postForm($(this).attr('id'), '/cursos/portais/modulos/ff/professor/diaAulaFFAcao.php', '&acao=aulaAut');
    });
//	alert("Aulas inativadas com sucesso");
}
