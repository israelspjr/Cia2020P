<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$idDemonstrativoCobranca = $_REQUEST['id'];
$DemonstrativoCobranca = new DemonstrativoCobranca();
$dc = $DemonstrativoCobranca->selectDemonstrativoCobranca("WHERE idDemonstrativoCobranca = ".$idDemonstrativoCobranca);
$dataVencimento = Uteis::exibirData($dc[0]['dataVencimento']);
?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Alterar Vencimento</legend>
    <form id="form_alterarVencimento" class="validate"  method="post" onsubmit="return false" >
      <input id="acao" name="acao" type="hidden" value="alterar" />
      <input id="idDemonstrativoCobranca" name="idDemonstrativoCobranca" type="hidden" value="<?php echo $idDemonstrativoCobranca ?>" />
      <p>
        <label>Data:</label>
        <input type="text" id="dataVencimento" name="dataVencimento" id="dataVencimento" class="data required" value="<?php echo $dataVencimento?>" />
        <span class="placeholder">Campo obrigatório</span>
      </p>      
      <p>        
      <button class="button blue" onclick="postForm('form_alterarVencimento', '<?php echo CAMINHO_COBRANCA?>demonstrativo/include/acao/alterarVencimento.php')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();

</script>