<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

	$Complemento = new ComplementoAbordagem();
	$idPlanoAcao = $_GET['id'];
?>
<fieldset>
  <legend>Complemento de Abordagem</legend>
 <form id="form_Abordagem2"  class="validate" action="" method="post"  enctype="multipart/form-data" onsubmit="return false" >
     <?php echo $Complemento->selectAbordagemCheckbox($idPlanoAcao, "", "", "", "d"); ?> 
    <br />
    <div class="linha-inteira">
      <p>
        <button class="button blue" onclick="postForm('form_Abordagem2', '<?php echo CAMINHO_VENDAS."planoAcao/include/acao/planoAcaoComplemento.php?id=$idPlanoAcao"?>')" > Enviar</button>
      </p>
    </div>
  </form>
</fieldset>
<script>

ativarForm();

</script> 