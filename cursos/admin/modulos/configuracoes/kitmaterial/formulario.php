<?php
//pagina conteudo o formulario 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/KitMaterial.class.php");


$KitMaterial = new KitMaterial();
		
$idKitMaterial = $_REQUEST['id'];

if($idKitMaterial != '' && $idKitMaterial  > 0){

	$valor = $KitMaterial->selectKitMaterial('WHERE idKitMaterial='.$idKitMaterial);
	
	//$idKitMaterial = $valor[0]['idKitMaterial'];
	$nome = $valor[0]['nome'];
	$obs = $valor[0]['obs'];
	$dataCadastro = $valor[0]['dataCadastro'];
	$inativo = $valor[0]['inativo'];
	$excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Kit Material</legend>
    <form id="form_KitMaterial" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idKitMaterial ?>" />
      <p>
        <label for="inativo">Inativo</label>
        <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label>Nome:</label>
        <input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <button class="button blue" onclick="postForm('form_KitMaterial', '<?php echo CAMINHO_MODULO?>configuracoes/kitmaterial/grava.php')">Salvar</button>
      
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
