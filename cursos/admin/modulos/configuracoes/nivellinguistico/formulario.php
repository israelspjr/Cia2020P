<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NivelLinguistico.class.php");
	
	
	$NivelLinguistico = new NivelLinguistico();
		
$idNivelLinguistico = $_REQUEST['id'];

if($idNivelLinguistico != '' && $idNivelLinguistico  > 0){

	$valor = $NivelLinguistico->selectNivelLinguistico('WHERE idNivelLinguistico='.$idNivelLinguistico);
	
	$idNivelLinguistico = $valor[0]['idNivelLinguistico'];
		 $nivel = $valor[0]['nivel'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Nivel Linguístico</legend>
    <form id="form_NivelLinguistico" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idNivelLinguistico ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Nível:</label>
				<input type="text" name="nivel" id="nivel" class="required" value="<?php echo $nivel?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_NivelLinguistico', '<?php echo CAMINHO_MODULO?>configuracoes/nivellinguistico/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

