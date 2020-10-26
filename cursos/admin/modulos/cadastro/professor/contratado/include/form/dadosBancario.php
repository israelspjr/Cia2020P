<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
		
$DadosBancarios = new DadosBancarios();

$idProfessor = $_GET['id'];	

if($idProfessor != '' && is_numeric($idProfessor)){

	$valor = $DadosBancarios->selectDadosBancarios(" WHERE professor_idProfessor = ".$idProfessor);
	$idDadosBancarios= $valor[0]['idDadosBancarios'];
	$banco= $valor[0]['banco'];
	$agencia= $valor[0]['agencia'];
	$tipo= $valor[0]['tipo'];
	$numero= $valor[0]['numero'];
	$favorecido = $valor[0]['favorecido'];
	$cobrarDoc = $valor[0]['cobrarDoc'];
	$valorR = $valor[0]['valor'];
	$dataInicio = $valor[0]['dataInicio'];
	$dataFim = $valor[0]['dataFim'];
	$retiraCheque = $valor[0]['retiraCheque'];
	$obs = $valor[0]['obs'];
	$cpf = $valor[0]['cpf'];
}
?>
<fieldset>
  <legend>Dados Bancário</legend>
  <div id="div_form_dadosBancario">
    <form id="form_dadosBancario" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" name="professor_idProfessor" id="professor_idProfessor" value="<?php echo $idProfessor?>" />
      <input type="hidden" name="idDadosBancarios" id="idDadosBancarios" value="<?php echo $idDadosBancarios?>" />
      <div class="esquerda">
        <p>
          <label>Banco:</label>
          <input type="text" name="banco" id="banco" value="<?php echo $banco?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
           <p>
          <label>Tipo:</label>
          <select name="tipo" id="tipo">
            <option value="">Selecione</option>
            <option value="cp" <?php if($tipo=="cp"){?> selected="selected" <?php } ?>>Conta Poupança</option>
            <option value="cc" <?php if($tipo=="cc"){?> selected="selected" <?php } ?>>Conta Corrente</option>
          </select>
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Agencia:</label>
          <input type="text" name="agencia" id="agencia" value="<?php echo $agencia?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
            <p>
              <p>
          <label>Número:</label>
          <input type="text" name="numero" id="numero" value="<?php echo $numero?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
           <p>
          <label>Favorecido:</label>
          <input type="text" name="favorecido" id="favorecido" value="<?php echo $favorecido?>" />
         </p>
         <p>
          <label>CPF:</label>
          <input type="text" name="cpf" id="cpf" value="<?php echo $cpf?>" />
         </p>
        </div>
        <div class="direita">
        
      		<p><label>
           <input type="checkbox" name="cobrarDoc" id="cobrarDoc" <?php 
		  if ($cobrarDoc == 1) {
			  echo "checked"; 
		  }?> />
          Cobrar Doc</label>
    <!--      <label> Valor: </label>-->
    <!--      <input type="hidden" name="valorR" id="valorR" value="<?php //echo $valorR?>" />
	<!--		</p>-->
            <p>
          <label>Cobrar a partir de:</label>
          <input type="text" name="dataInicio" id="dataInicio" value="<?php echo $dataInicio?>" class="data "/>
			
          <label>Cobrar até:</label>
          <input type="text" name="dataFim" id="dataFim" value="<?php echo $dataFim?>" class="data "/>
			</p>
            <p>
            <label>Retira Cheque</label>
            <input type="checkbox" name="retiraCheque" id="retiraCheque" <?php if($retiraCheque == 1) {echo "checked"; }?> />
            </p>
            <p>
            <label>Observações:</label>
            <textarea name="obs" id="obs" cols="45" rows="5"><?php echo $obs?></textarea>
            </p>
      </div>
      <div class="linha-inteira">
    
        <p>
          <button class="button blue" onclick="postForm('form_dadosBancario', '<?php echo CAMINHO_CAD."professor/contratado/include/acao/dadosBancario.php"?>');" >Salvar</button>
          
        </p>
      </div>
    </form>
  </div>
</fieldset>
<script>
ativarForm();
</script> 