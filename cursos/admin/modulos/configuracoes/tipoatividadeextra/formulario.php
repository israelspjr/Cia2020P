<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoAtividadeExtra.class.php");
	
	
	$TipoAtividadeExtra = new TipoAtividadeExtra();
		
$idTipoAtividadeExtra = $_REQUEST['id'];

if($idTipoAtividadeExtra != '' && $idTipoAtividadeExtra  > 0){

	$valor = $TipoAtividadeExtra->selectTipoAtividadeExtra('WHERE idTipoAtividadeExtra='.$idTipoAtividadeExtra);
	
	$idTipoAtividadeExtra = $valor[0]['idTipoAtividadeExtra'];
		 $nome = $valor[0]['nome'];
		 $inativo = $valor[0]['inativo'];
		 $dataCadastro = $valor[0]['dataCadastro'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Tipo Atividade Extra</legend>
    <form id="form_TipoAtividadeExtra" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idTipoAtividadeExtra ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                
                <p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_TipoAtividadeExtra', '<?php echo CAMINHO_MODULO?>configuracoes/tipoatividadeextra/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

