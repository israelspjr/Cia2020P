<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoContatoProposta.class.php");
	
	
	$TipoContatoProposta = new TipoContatoProposta();
		
$idTipoContatoProposta = $_REQUEST['id'];

if($idTipoContatoProposta != '' && $idTipoContatoProposta  > 0){

	$valor = $TipoContatoProposta->selectTipoContatoProposta('WHERE idTipoContatoProposta='.$idTipoContatoProposta);
	
	$idTipoContatoProposta = $valor[0]['idTipoContatoProposta'];
		 $tipo = $valor[0]['tipo'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Tipo Contato Proposta</legend>
    <form id="form_TipoContatoProposta" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idTipoContatoProposta ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Tipo:</label>
				<input type="text" name="tipo" id="tipo" class="required" value="<?php echo $tipo?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_TipoContatoProposta', '<?php echo CAMINHO_MODULO?>configuracoes/tipocontatoproposta/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

