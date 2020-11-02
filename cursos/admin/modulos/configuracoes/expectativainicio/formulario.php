<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ExpectativaInicio.class.php");
	
	
	$ExpectativaInicio = new ExpectativaInicio();
		
$idExpectativaInicio = $_REQUEST['id'];

if($idExpectativaInicio != '' && $idExpectativaInicio  > 0){

	$valor = $ExpectativaInicio->selectExpectativaInicio('WHERE idExpectativaInicio='.$idExpectativaInicio);
	
	$idExpectativaInicio = $valor[0]['idExpectativaInicio'];
		 $expectativa = $valor[0]['expectativa'];
		 $inativo = $valor[0]['inativo'];
		 $dataCadastro = $valor[0]['dataCadastro'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Expectativa Início</legend>
    <form id="form_ExpectativaInicio" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idExpectativaInicio ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Expectativa:</label>
				<input type="text" name="expectativa" id="expectativa" class="required" value="<?php echo $expectativa?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_ExpectativaInicio', '<?php echo CAMINHO_MODULO?>configuracoes/expectativainicio/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

