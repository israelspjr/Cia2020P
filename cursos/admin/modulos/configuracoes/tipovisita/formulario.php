<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoVisita.class.php");
	
	
	$TipoVisita = new TipoVisita();
		
$idTipoVisita = $_REQUEST['id'];

if($idTipoVisita != '' && $idTipoVisita  > 0){

	$valor = $TipoVisita->selectTipoVisita('WHERE idTipoVisita='.$idTipoVisita);
	
	$idTipoVisita = $valor[0]['idTipoVisita'];
		 $tipo = $valor[0]['tipo'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Tipo Visita</legend>
    <form id="form_TipoVisita" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idTipoVisita ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                
                <p>
				<label>Tipo:</label>
				<input type="text" name="tipo" id="tipo" value="<?php echo $tipo?>" class="required" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_TipoVisita', '<?php echo CAMINHO_MODULO?>configuracoes/tipovisita/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

