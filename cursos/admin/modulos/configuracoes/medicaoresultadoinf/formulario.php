<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MedicaoResultadoINF.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RelacionamentoINF.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MedicaoResultado.class.php");
	
	
	$MedicaoResultadoINF = new MedicaoResultadoINF();
	$RelacionamentoINF = new RelacionamentoINF();
	$MedicaoResultado = new MedicaoResultado();
		
$idMedicaoResultadoINF = $_REQUEST['id'];

if($idMedicaoResultadoINF != '' && $idMedicaoResultadoINF  > 0){

	$valor = $MedicaoResultadoINF->selectMedicaoResultadoINF('WHERE idMedicaoResultadoINF='.$idMedicaoResultadoINF);
	
	$idMedicaoResultadoINF = $valor[0]['idMedicaoResultadoINF'];
		 $relacionamentoINF_idRelacionamentoINF = $valor[0]['relacionamentoINF_idRelacionamentoINF'];
		 $medicaoResultado_idMedicaoResultado = $valor[0]['medicaoResultado_idMedicaoResultado'];
		 $qtd = $valor[0]['qtd'];
		 $inativo = $valor[0]['inativo'];
		 $dataCadastro = $valor[0]['dataCadastro'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Medição Resultado I.N.F.</legend>
    <form id="form_MedicaoResultadoINF" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idMedicaoResultadoINF ?>" />
				
                <p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                
                <p>
				<label>Relacionamento I.N.F.:</label>
                 <?php echo $RelacionamentoINF->selectRelacionamentoINFSelect("required", $relacionamentoINF_idRelacionamentoINF, " WHERE R.inativo = 0 AND R.excluido = 0"); ?>
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Medição Resultado:</label>
                <?php echo $MedicaoResultado->selectMedicaoResultadoSelect("required", $medicaoResultado_idMedicaoResultado, ""); ?>

				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Qtd.:</label>
				<input type="text" name="qtd" id="qtd" class="required" value="<?php echo $qtd?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_MedicaoResultadoINF', '<?php echo CAMINHO_MODULO?>configuracoes/medicaoresultadoinf/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

