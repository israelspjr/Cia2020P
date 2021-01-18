<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

	$Complemento = new ComplementoAbordagem();
	$idPlanoAcao = $_GET['id'];
?>
<fieldset>
  <legend>Complemento de Abordagem</legend>
 <form id="form_Abordagem"  class="validate" action="" method="post"  enctype="multipart/form-data" onsubmit="return false" >
     <?php echo $Complemento->selectAbordagemCheckbox($idPlanoAcao); ?> 
    <br />
    <div class="linha-inteira">
      <p>
        <button class="button blue" onclick="postForm('form_Abordagem', '<?php echo CAMINHO_VENDAS."planoAcao/include/acao/planoAcaoComplemento.php?id=$idPlanoAcao"?>')" > Enviar</button>
      </p>
    </div>
  </form>
</fieldset>
<script>
function abrirFormulario2(div, img, apenasFecha) {
	alert("a");
	var obj_div = $('#' + div);
	if (img != undefined && img != '')
		var obj_img = $('#' + img);

	if (obj_div.css('display') == "block") {
		if (obj_img != undefined)
			obj_img.attr('src', caminhoImg + 'mais.png');
		obj_div.hide();
	} else {
		if (obj_img != undefined)
			obj_img.attr('src', caminhoImg + 'menos.png');
		obj_div.show();
	}
}


ativarForm();

</script> 