<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$StatusCobranca = new StatusCobranca();
		
$idStatusCobranca = $_REQUEST['id'];

$cor = "#000000";
if( $idStatusCobranca ){

	$valor = $StatusCobranca->selectStatusCobranca(' WHERE idStatusCobranca='.$idStatusCobranca);
	
	$status = $valor[0]['status'];
	$cor = $valor[0]['cor'];	  
	$inativo = $valor[0]['inativo'];
}

?>

<script type="text/javascript" src="<?php echo CAMINHO_CFG."js/farbtastic.js"?>"></script>
<link href="<?php echo CAMINHO_CFG?>css/farbtastic/farbtastic.css" type="text/css" media="screen" rel="stylesheet" />

<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
  	$('#picker').farbtastic('#cor');
  });
 </script>
 
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Status de Cobrança</legend>
    <form id="form_StatusCobranca" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idStatusCobranca ?>" />
      <p>
        <label>Nome:</label>
        <input type="text" name="status" id="status" class="required" value="<?php echo $status?>" />
        <span class="placeholder">Campo obrigatório</span>
      </p>
      
      <p><label>Cor de identificação:</label>
      <input type="text" id="cor" name="cor" value="<?php echo $cor?>" class="required" maxlength="7" />
      <span class="placeholder"></span>
      <div id="picker"></div></p>  
      
      <p>
        <label for="inativo">Inativo</label>
        <input type="checkbox" name="inativo" id="inativo" value="1" <?php echo ($inativo != 0) ? "checked" : "" ?> />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <button class="button blue" onclick="postForm('form_StatusCobranca', '<?php echo CAMINHO_MODULO?>configuracoes/statusCobranca/grava.php')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();

</script>