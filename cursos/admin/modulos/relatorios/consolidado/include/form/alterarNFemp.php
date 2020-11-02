<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$idDemonstrativoCobranca = $_REQUEST['idDemonstrativoCobranca'];
$DemonstrativoCobranca = new DemonstrativoCobranca();
$dc = $DemonstrativoCobranca->selectDemonstrativoCobranca("WHERE idDemonstrativoCobranca = ".$idDemonstrativoCobranca);
$obs = /*Uteis::exibirData(*/$dc[0]['obs'];//);
?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Inserir NFe</legend>
    <form id="form_alterarVencimento" class="validate"  method="post" onsubmit="return false" >
      <input id="acao" name="acao" type="hidden" value="alterar" />
      <input id="idDemonstrativoCobranca" name="idDemonstrativoCobranca" type="hidden" value="<?php echo $idDemonstrativoCobranca ?>" />
      <p>
        <label>Número:</label>
        <input type="text" id="obs" name="obs" class="required" value="<?php echo $obs?>" />
        <span class="placeholder">Campo obrigatório</span>
      </p>      
      <p>        
      <button class="button blue" onclick="postForm('form_alterarVencimento', '<?php echo CAMINHO_RELAT?>consolidado/include/acao/alterarNFemp.php?tr=1')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();
</script>