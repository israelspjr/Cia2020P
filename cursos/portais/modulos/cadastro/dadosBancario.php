<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
		
$DadosBancarios = new DadosBancarios();

$idProfessor = $_SESSION['idProfessor_SS'];

if($idProfessor != '' && is_numeric($idProfessor)){

	$valor = $DadosBancarios->selectDadosBancarios(" WHERE professor_idProfessor = ".$idProfessor);
	
	$idDadosBancarios= $valor[0]['idDadosBancarios'];
	$banco= $valor[0]['banco'];
	$agencia= $valor[0]['agencia'];
	$tipo= $valor[0]['tipo'];
	$numero= $valor[0]['numero'];
	$favorecido = $valor[0]['favorecido'];
	$cpf = $valor[0]['cpf'];
}
	
?>

<fieldset>
  <legend>Dados Bancários</legend>
  <div class="agrupa" id="div_form_dadosBancario">
    <form id="form_dadosBancario" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" name="professor_idProfessor" id="professor_idProfessor" value="<?php echo $idProfessor?>" />
      <input type="hidden" name="idDadosBancarios" id="idDadosBancarios" value="<?php echo $idDadosBancarios?>" />
      <div class="linha-inteira">
        <p>
          <label>Banco:</label>
          <input type="text" name="banco" id="banco" class="required" value="<?php echo $banco?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Agência:</label>
          <input type="text" name="agencia" id="agencia" class="required" value="<?php echo $agencia?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Tipo:</label>
          <select name="tipo" id="tipo" class="required">
            <option value="">Selecione</option>
            <option value="cp" <?php if($tipo=="cp"){?> selected="selected" <?php } ?>>Conta Poupança</option>
            <option value="cc" <?php if($tipo=="cc"){?> selected="selected" <?php } ?>>Conta Corrente</option>
          </select>
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Número:</label>
          <input type="text" name="numero" id="numero" class="required" value="<?php echo $numero?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
         <p>
          <label>Favorecido:</label>
          <input type="text" name="favorecido" id="favorecido" class="required" value="<?php echo $favorecido?>" />
		 </p>
          <p>
          <label>CPF:</label>
          <input type="text" name="cpf" id="cpf" class="required" value="<?php echo $cpf?>" />
          </p> 
          
      </div>
      <div class="linha-inteira">
        <p>
          <button class="Bblue" onclick="enviadoOK();postForm('form_dadosBancario', 'modulos/cadastro/dadosBancarioAcao.php');" >Salvar</button>
          
           <button class="button gray" 
        onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/dadosBancario.php', '#centro');" >Fechar</button>
          
        </p>
      </div>
    </form>
  </div>
</fieldset>
<script>
//ativarForm();

 //function enviadoOK() {
//	alert("Conteúdo inserido/alterado com sucesso!");
//}
</script> 