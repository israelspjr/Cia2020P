<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AtividadeExtra.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoAtividadeExtra.class.php");
	
	
	$AtividadeExtra = new AtividadeExtra();
	$TipoAtividadeExtra = new TipoAtividadeExtra();
		
$idAtividadeExtra = $_REQUEST['id'];

if($idAtividadeExtra != '' && $idAtividadeExtra  > 0){

	$valor = $AtividadeExtra->selectAtividadeExtra('WHERE idAtividadeExtra='.$idAtividadeExtra);
	
	$idAtividadeExtra = $valor[0]['idAtividadeExtra'];
		 $tipoAtividadeExtra_idTipoAtividadeExtra = $valor[0]['tipoAtividadeExtra_idTipoAtividadeExtra'];
		 $nome = $valor[0]['nome'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 $ativar = $valor[0]['ativar'];
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro de Atividade Extra</legend>
    <form id="form_AtividadeExtra" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idAtividadeExtra ?>" />
         		<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
				<p>
				<?php echo $TipoAtividadeExtra->selectTipoAtividadeExtraSelect("required", $tipoAtividadeExtra_idTipoAtividadeExtra, " WHERE inativo = 0 AND excluido = 0"); ?>
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				<p>
        <label for="ativar">Aceita Comentário</label>
        <input type="checkbox" name="ativar" id="ativar" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
				<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_AtividadeExtra', '<?php echo CAMINHO_MODULO?>configuracoes/atividadeextra/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

