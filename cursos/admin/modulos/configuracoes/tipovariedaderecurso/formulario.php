<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoVariedadeRecurso.class.php");
	
	
	$TipoVariedadeRecurso = new TipoVariedadeRecurso();
		
$idTipoVariedadeRecurso = $_REQUEST['id'];

if($idTipoVariedadeRecurso != '' && $idTipoVariedadeRecurso  > 0){

	$valor = $TipoVariedadeRecurso->selectTipoVariedadeRecurso('WHERE idTipoVariedadeRecurso='.$idTipoVariedadeRecurso);
	
	$idTipoVariedadeRecurso = $valor[0]['idTipoVariedadeRecurso'];
		 $tipo = $valor[0]['tipo'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];	 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Tipo Variedade Recurso</legend>
    <form id="form_TipoVariedadeRecurso" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idTipoVariedadeRecurso ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Tipo:</label>
				<input type="text" name="tipo" id="tipo" class="required" value="<?php echo $tipo?>" />
				<span class="placeholder">Campo Obrigatório</span></p> 
						
	  
        <button class="button blue" onclick="postForm('form_TipoVariedadeRecurso', '<?php echo CAMINHO_MODULO?>configuracoes/tipovariedaderecurso/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

