<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Gerente = new Gerente();

?>
<fieldset>
  <legend>Filtros</legend>
   
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_filtra_Grupos"  class="validate" method="post" action="" onsubmit="return false" >
      <div class="esquerda">
      
      <p>
      <label> Tipo: </label>
      <input type="radio" name="tipo" id="tipo" value="0" checked onchange="selectTipo(0)"/>Aluno </br>
      <div id="tipoAluno" style="margin-top: -10px; margin-left: 12px;">
      <input type="radio" name="tipoAluno" id="tipoAluno" value="0"  />Ativo </br>
      <input type="radio" name="tipoAluno" id="tipoAluno" value="1"  />Inativo </br>
      <input type="radio" name="tipoAluno" id="tipoAluno3" value="-" checked />Ambos </br>
      
      </div>
      <input type="radio" name="tipo" id="tipo" value="1" onchange="selectTipo(1)"/>Professor</p>
      <div id="tipoProfessor" style="display:none;margin-top: -10px; margin-left: 12px;">
      <input type="radio" name="tipoP" id="tipoP" value="1"  />Ativo com Grupo</br>
      <input type="radio" name="tipoP" id="tipoP" value="2"  />Ativo </br>
     <!-- <input type="radio" name="tipoP" id="tipoP3" value="-"  checked="checked" />Ambos </br>-->
      
      </div>
     
      
         <p>
          <label>Data de aniversário:</label>
          de
          <input type="text" name="dataCadastro" id="dataCadastro" class="required data" value=""  />
          a
          <input type="text" name="dataCadastro2" id="dataCadastro2" class="required data" value="" />
          <span class="placeholder"></span></p>
 
       </div>
      <div class="direita">
      <label>Coordenador:</label>
      <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0"); ?>
       <p>
       <label> Contratado / Candidato: </label>
      <input type="radio" name="tipoC" id="tipoAluno" value="0"  />Contratado </br>
      <input type="radio" name="tipoC" id="tipoAluno" value="1"  />Candidato </br>
      <input type="radio" name="tipoC" id="tipoAluno3" value="-" checked />Ambos </br>

      </p>
      </div>
      <div class="linha-inteira">
        <button class="button blue" id="bt" onclick="filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_RELAT."aniversarios/principal.php"?>', '', '#lista_res')" >Buscar</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Aniversariantes</legend>
  <div id="lista_res" class="lista"> </div>
</fieldset>
<script>
ativarForm();

function selectTipo(x) {

if (x == 0) {
	$('#tipoAluno').show();	
	$('#tipoProfessor').hide();	
	$('#tipoAluno3').prop('checked', true); 
} else {
	$('#tipoAluno').hide();	
	$('#tipoProfessor').show();	
	$('#tipoP3').prop('checked', true); 
}
	
}
</script>
