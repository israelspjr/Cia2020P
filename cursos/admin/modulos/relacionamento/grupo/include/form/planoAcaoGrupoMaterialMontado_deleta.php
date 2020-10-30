<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$id = $_REQUEST['id'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Desvincular material montado/personalizado</legend>
    <form id="form_desvincular" class="validate" method="post" action="" onsubmit="return false">
      <input type="hidden" name="acao" id="acao" value="deletar" />
      <p>
        <label>Data do desvínculo:</label>
        <input type="text" name="dataFim" id="dataFim" class="required data"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <button class="button blue" 
        onclick="postForm('form_desvincular', '<?php echo CAMINHO_REL."grupo/include/acao/planoAcaoGrupoMaterialMontado.php?id=".$id?>')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();</script> 
