<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/KitMaterialDidatico.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/KitMaterial.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MaterialDidatico.class.php");
	
	
	$KitMaterialDidatico = new KitMaterialDidatico();
	$MaterialDidatico = new MaterialDidatico();
	$KitMaterial = new KitMaterial();
		
$idKitMaterialDidatico = $_REQUEST['id'];

if($idKitMaterialDidatico != '' && $idKitMaterialDidatico  > 0){

	$valor = $KitMaterialDidatico->selectKitMaterialDidatico('WHERE idKitMaterialDidatico='.$idKitMaterialDidatico);
	
	$idKitMaterialDidatico = $valor[0]['idKitMaterialDidatico'];
		 $kitMaterial_idKitMaterial = $valor[0]['kitMaterial_idKitMaterial'];
		 $materialDidatico_idMaterialDidatico = $valor[0]['materialDidatico_idMaterialDidatico'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Kit Material Didático</legend>
    <form id="form_KitMaterialDidatico" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idKitMaterialDidatico ?>" />
				<p>
				<label>Kit Material:</label>
			
                <?php echo $KitMaterial->selectKitMaterialSelect("required", $kitMaterial_idKitMaterial, ""); ?>

				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Material Didatico:</label>
			
                <?php echo $MaterialDidatico->selectMaterialDidaticoSelect("required", $materialDidatico_idMaterialDidatico, " WHERE M.inativo = 0 AND M.excluido = 0"); ?>

				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
	  
        <button class="button blue" onclick="postForm('form_KitMaterialDidatico', '<?php echo CAMINHO_MODULO?>configuracoes/kitmaterialdidatico/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

