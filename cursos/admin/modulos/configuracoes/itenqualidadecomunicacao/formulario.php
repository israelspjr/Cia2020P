<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItenQualidadeComunicacao.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoQualidadeComunicacao.class.php");
	
	
	$ItenQualidadeComunicacao = new ItenQualidadeComunicacao();
	$TipoQualidadeComunicacao = new TipoQualidadeComunicacao();
  $Idioma = new Idioma();
	
		
$idItenQualidadeComunicacao = $_REQUEST['id'];

if($idItenQualidadeComunicacao != '' && $idItenQualidadeComunicacao  > 0){

	$valor = $ItenQualidadeComunicacao->selectItenQualidadeComunicacao('WHERE idItenQualidadeComunicacao='.$idItenQualidadeComunicacao);
	
	$idItenQualidadeComunicacao = $valor[0]['idItenQualidadeComunicacao'];
		 $tipoQualidadeComunicacao_idTipoQualidadeComunicacao = $valor[0]['tipoQualidadeComunicacao_idTipoQualidadeComunicacao'];
		 $nome = $valor[0]['nome'];
         $nome = $valor[0]['descricao'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Item Qualidade Comunicação</legend>
    <form id="form_ItenQualidadeComunicacao" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idItenQualidadeComunicacao ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Tipo Qualidade Comunicação:</label>
				
                <?php echo $TipoQualidadeComunicacao->selectTipoQualidadeComunicacaoSelect("required", $tipoQualidadeComunicacao_idTipoQualidadeComunicacao, " WHERE inativo = 0 AND excluido = 0"); ?>
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
        <label>Descrição:</label>
        <textarea name="descricao_base" id="descricao_base" ></textarea>
        <textarea name="descricao" id="descricao" class="required" ></textarea>
        <span class="placeholder">Campo obrigatório</span></p>
        </p> 
				
	  
        <button class="button blue" onclick="postForm_editor('descricao','form_ItenQualidadeComunicacao', '<?php echo CAMINHO_MODULO?>configuracoes/itenqualidadecomunicacao/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>
viraEditor('descricao');
ativarForm();
</script> 

