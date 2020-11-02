<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/OperadoraCelular.class.php");
	
	
	$OperadoraCelular = new OperadoraCelular();
		
$idOperadoraCelular = $_REQUEST['id'];

if($idOperadoraCelular != '' && $idOperadoraCelular  > 0){

	$valor = $OperadoraCelular->selectOperadoraCelular('WHERE idOperadoraCelular='.$idOperadoraCelular);
	
	$idOperadoraCelular = $valor[0]['idOperadoraCelular'];
		 $nome = $valor[0]['nome'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Operadora Celular</legend>
    <form id="form_OperadoraCelular" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idOperadoraCelular ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
				<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
	  
        <button class="button blue" onclick="postForm('form_OperadoraCelular', '<?php echo CAMINHO_MODULO?>configuracoes/operadoracelular/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

