<?php
//pagina conteudo o formulario 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/KitMaterialINF.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/KitMaterial.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RelacionamentoINF.class.php");


$KitMaterialINF = new KitMaterialINF();
$KitMaterial = new KitMaterial();
$RelacionamentoINF = new RelacionamentoINF();
		
$idKitMaterialINF = $_REQUEST['id'];

if($idKitMaterialINF != '' && $idKitMaterialINF  > 0){

	$valor = $KitMaterialINF->selectKitMaterialINF('WHERE idKitMaterialINF='.$idKitMaterialINF);
	
	//$idKitMaterialINF = $valor[0]['idKitMaterialINF'];
	 $kitMaterial_idKitMaterial = $valor[0]['kitMaterial_idKitMaterial'];
	 $relacionamentoINF_idRelacionamentoINF = $valor[0]['relacionamentoINF_idRelacionamentoINF'];
	 $inativo = $valor[0]['inativo'];
	 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro de Kit Material I.N.F.</legend>
    <form id="form_KitMaterialINF" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idKitMaterialINF ?>" />
      <p>
        <label>Kit Material:</label>
        <?php echo $KitMaterial->selectKitMaterialSelect("required", $kitMaterial_idKitMaterial, ""); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Relacionamento I.N.F.:</label>
        <?php echo $RelacionamentoINF->selectRelacionamentoINFSelect("required", $relacionamentoINF_idRelacionamentoINF, " WHERE R.inativo = 0 AND R.excluido = 0"); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label for="inativo">Inativo</label>
        <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <button class="button blue" onclick="postForm('form_KitMaterialINF', '<?php echo CAMINHO_MODULO?>configuracoes/kitmaterialinf/grava.php')">Salvar</button>
      
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
