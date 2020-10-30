<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

	$Complemento = new ComplementoAbordagem();
	$PlanoAcaoGrupo = new PlanoAcaoGrupo();
	$idPlanoAcao = $PlanoAcaoGrupo->getIdPlanoAcao($idPlanoAcaoGrupo);
//	$idPlanoAcao = $_GET['id'];
?>
<div>
<fieldset>
  <legend>Complemento de Abordagem</legend>
  <form id="form_Abordagem"  action="<?php echo CAMINHO_VENDAS."planoAcao/include/acao/planoAcaoComplemento.php?id=$idPlanoAcao"?>" method="post"  target="abordagem">
<!--class="validate2" onsubmit="return false" -->
    <?php echo $Complemento->selectAbordagemCheckbox($idPlanoAcao); ?> 
    <br />
    <div class="linha-inteira">
      <p>
        <button class="button blue" onclick="enviar2();"> <!--onclick="postForm('form_Abordagem', '');" >-->
        Enviar</button>
      </p>
    </div>
  </form>
</fieldset>
<iframe id="abordagem" name="abordagem" style="display:none"></iframe></div>
<script>
function enviar2() {
alert("Conteúdo gravado com sucesso!");	
	
}

//ativarForm();</script> 