<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idSubvencaoMaterialGrupo = $_REQUEST['id'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Desvincular subvenção</legend>
    <form id="form_finalizar" class="validate" method="post" action="" onsubmit="return false">
      <input type="hidden" name="acao" id="acao" value="deletar"/>
      <p>
        <label>Data do desvínculo:</label>
        <input type="text" name="dataSaida" id="dataSaida" class="required data"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <button class="button blue" 
        onclick="postForm('form_finalizar', '<?php echo CAMINHO_REL."grupo/include/acao/subvencaoMaterialGrupo.php?id=".$idSubvencaoMaterialGrupo?>')">
        Enviar</button>       
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
