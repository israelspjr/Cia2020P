<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$idAulaPermanenteGrupo = $_REQUEST['idAulaPermanenteGrupo'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Desvincular dia</legend>
    <form id="form_finalizar" class="validate" method="post" action="" onsubmit="return false">
      <input type="hidden" name="acao" id="acao" value="deletar" />
      <p>
        <label>
          <input type="checkbox" value="1" name="reverter" id="reverter" onclick="desabilitarData()" />
          Tentar remover permanentemente (caso não haja vínculo)</label>
      </p>
      <p>
        <label>Data do desvínculo: <font color="#cc0000"><strong>Preencher com a data da ultima Aula</strong></font></label>
        <input type="text" name="dataFim" id="dataFim" class="required data"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
   <fieldset>
   <legend>Desvincular professor (Usado para troca de professor)</legend>
        
        <p>
          <label>Selecione o motivo:</label>
          <select name="motivo" id="motivo" class="required">
          <option value="">Selecione</option>
          <option value="1"> Alteração de dia / horário </option>
          <option value="2"> Insatisfação Aluno ou RH </option>
          <option value="3"> Professor deixou o grupo </option>
          <option value="4"> Decisão CI (Coordenação) </option>
          <option value="5"> Previsto em contrato </option>
          <option value="13"> Grupo Fechou </option>          
          </select>
          <span class="placeholder">Campo Obrigatório</span> </p>
          <p>
          <div id="sub1" name="sub1" style="display:none">
          <label>Escolha o Sub-motivo: </label>
          <select name="subMotivo" id="subMotivo" >
          <option value="">Selecione</option>
          <option value="6">Emprego CLT/ Passou em concurso </option>
          <option value="7">Indisponibilidade de agenda </option>
          <option value="8">Mudou de região/ cidade </option>
          <option value="9">Problemas de saúde </option>
          <option value="10">Não adaptação ao método</option>
          </select>
          </div>
          
           <div id="sub2" name="sub2" style="display:none">
          <label>Escolha o Sub-motivo: </label>
          <select name="subMotivo2" id="subMotivo2" >
          <option value="">Selecione</option>
          <option value="11">Pedagógico </option>
          <option value="12">Comportamental</option>
          </select>
          </div>
          
          </p>    
   		</fieldset>
 
      <p>
        <button class="button blue" 
        onclick="finalizar()">Salvar</button>
      </p>

    </form>
    </fieldset>
</div>
<script>

function desabilitarData(){
	
	var $dataFim = $('#form_finalizar #dataFim');
	
	if( $('#form_finalizar #reverter').is(':checked') ){
		$dataFim.hide().removeClass('invalid required').val('');
	}else{
		$dataFim.show().addClass('required').val('');
	}
	
}


ativarForm();

function submenu() {
var a = $('#motivo').val();	
	if (a == 3) {
		$('#subMotivo1').addClass("required");
		$('#sub1').show();
		$('#sub2').hide();
	} else if(a == 4) {
		$('#sub1').hide();
		$('#subMotivo2').addClass("required");
		$('#sub2').show();	
		
	} else {
		$('#sub1').hide();
		$('#sub2').hide();	
		$('#subMotivo2').removeClass("required");
		$('#subMotivo1').removeClass("required");
	}
	
	
}
$('#motivo').attr('onchange', 'submenu()');

function finalizar() {
	
	var a = $('#motivo').val();
	var s = $("#subMotivo").val();
	var z = $("#subMotivo2").val();	
	if (a == '') {
		alert("Favor Escolher um motivo");
	} else if ((a == 3) && (s == '')) {
		alert("Favor Escolher um SubMotivo");
	} else if ((a == 4) && (z == '')) {
		alert("Favor Escolher um SubMotivo");
	} else {
	
		postForm('form_finalizar', '<?php echo CAMINHO_REL."grupo/include/acao/aulaPermanenteGrupo.php?id=".$idAulaPermanenteGrupo?>')	
	}
}
</script> 
