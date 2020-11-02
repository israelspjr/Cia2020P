<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoQualidadeComunicacao.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Idioma.class.php");
	
	
	$TipoQualidadeComunicacao = new TipoQualidadeComunicacao();
	$Idioma = new Idioma();
		
$idTipoQualidadeComunicacao = $_REQUEST['id'];

if($idTipoQualidadeComunicacao != '' && $idTipoQualidadeComunicacao  > 0){

	$valor = $TipoQualidadeComunicacao->selectTipoQualidadeComunicacao('WHERE idTipoQualidadeComunicacao='.$idTipoQualidadeComunicacao);
	
	$idTipoQualidadeComunicacao = $valor[0]['idTipoQualidadeComunicacao'];
		 $idioma_idIdioma = $valor[0]['idioma_idIdioma'];
		 $nome = $valor[0]['nome'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();"></div>
  <fieldset>
    <legend>Cadastro - Tipo Qualidade Comunicação</legend>
    <form id="form_TipoQualidadeComunicacao" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idTipoQualidadeComunicacao ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
				<p>
				<label>Idioma:</label>
				<?php echo $Idioma->selectIdiomaSelect("required", $idioma_idIdioma, "  AND excluido = 0"); ?>

				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
	  
        <button class="button blue" onclick="postForm('form_TipoQualidadeComunicacao', '<?php echo CAMINHO_MODULO?>configuracoes/tipoqualidadecomunicacao/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

