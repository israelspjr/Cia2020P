<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idAulaPermanenteGrupo = $_REQUEST['idAulaPermanenteGrupo'];
$idAulaDataFixa = $_REQUEST['idAulaDataFixa'];

$tipo = $_REQUEST['tipo'];

$dataInicio = $_GET['dataInicio'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Nova busca de professores</legend>
    <form id="form_finalizar" class="validate" method="post" action="" onsubmit="return false">
      <input type="hidden" name="tipo" id="tipo" value="<?php echo $tipo?>" />
      <input type="hidden" name="idAulaDataFixa" id="idAulaDataFixa" value="<?php echo $idAulaDataFixa?>" />
      <input type="hidden" name="idAulaPermanenteGrupo" id="idAulaPermanenteGrupo" value="<?php echo $idAulaPermanenteGrupo?>" />
      
      <?php if($dataInicio){?>
      	<input type="hidden" name="dataInicio" id="dataInicio" value="<?php echo $dataInicio?>" />
      <?php }else{?>      
      <p>
        <label>Início aula em:</label>
        <input type="text" name="dataInicio" id="dataInicio" class="required data"  />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <?php }?>      
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4" ></textarea>
      </p>
      <p>
        <label>Urgente
          <input type="checkbox" name="urgente" id="urgente" value="1" />
        </label>
      </p>
      <p>
        <button class="button blue" 
        onclick="postForm('form_finalizar', '<?php echo CAMINHO_REL."grupo/include/acao/buscaProfessor.php"?>')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();</script> 
