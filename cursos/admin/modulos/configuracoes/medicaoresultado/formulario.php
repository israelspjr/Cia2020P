<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MedicaoResultado.class.php");
	
	
	$MedicaoResultado = new MedicaoResultado();
		
$idMedicaoResultado = $_REQUEST['id'];

if($idMedicaoResultado != '' && $idMedicaoResultado  > 0){

	$valor = $MedicaoResultado->selectMedicaoResultado('WHERE idMedicaoResultado='.$idMedicaoResultado);
	
	$idMedicaoResultado = $valor[0]['idMedicaoResultado'];
		 $medicao = $valor[0]['medicao'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Medição Resultado</legend>
    <form id="form_MedicaoResultado" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idMedicaoResultado ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Medição:</label>
				<input type="text" name="medicao" id="medicao" class="required" value="<?php echo $medicao?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_MedicaoResultado', '<?php echo CAMINHO_MODULO?>configuracoes/medicaoresultado/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

