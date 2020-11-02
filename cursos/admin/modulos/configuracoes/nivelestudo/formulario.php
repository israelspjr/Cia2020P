<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NivelEstudo.class.php");
	
	
	$NivelEstudo = new NivelEstudo();
		
$idNivelEstudo = $_REQUEST['id'];

if($idNivelEstudo != '' && $idNivelEstudo  > 0){

	$valor = $NivelEstudo->selectNivelEstudo('WHERE idNivelEstudo='.$idNivelEstudo);
	
	$IdNivelEstudo = $valor[0]['IdNivelEstudo'];
		 $nivel = $valor[0]['nivel'];
		 $inativo = $valor[0]['inativo'];
		 $dataCadastro = $valor[0]['dataCadastro'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Nível Estudo</legend>
    <form id="form_NivelEstudo" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idNivelEstudo ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
               
				
				<p>
				<label>Nível:</label>
				<input type="text" name="nivel" id="nivel" class="required" value="<?php echo $nivel?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_NivelEstudo', '<?php echo CAMINHO_MODULO?>configuracoes/nivelestudo/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

