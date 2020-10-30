<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$id = $_REQUEST['id'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Desvincular professor</legend>
    <form id="form_finalizar" class="validate" method="post" action="" onsubmit="return false">
      <p>
        <label>Data do desvínculo:<font color="#cc0000"><strong>Este campo deve ser preenchido com a última data de aula que o professor dará a este grupo</strong></font></label>
        <input type="text" name="dataFim" id="dataFim" class="required data"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Selecione o motivo:</label>
          <select name="motivo" id="motivo" class="required">
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
      <p>
        <button class="button blue" 
        onclick="postForm('form_finalizar', '<?php echo CAMINHO_REL."grupo/include/acao/deleta_professor.php?id=".$id?>')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();

function submenu() {
var a = $('#motivo').val();	
	if (a == 3) {
		$('#subMotivo1').attr("class", "required");
		$('#sub1').show();
		$('#sub2').hide();
	} else if(a == 4) {
		$('#sub1').hide();
		$('#subMotivo2').attr("class", "required");
		$('#sub2').show();	
		
	} else {
		$('#sub1').hide();
		$('#sub2').hide();	
	}
	
	
}
$('#motivo').attr('onchange', 'submenu()');

</script> 
