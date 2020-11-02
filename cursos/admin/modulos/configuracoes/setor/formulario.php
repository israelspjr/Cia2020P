<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FuncionarioSetor = new FuncionarioSetor();
$Funcionario = new Funcionario();

$idFuncionarioSetor = $_REQUEST["id"];

if( is_numeric($idFuncionarioSetor) ){
	
	$valor = $FuncionarioSetor->selectFuncionarioSetor(" WHERE idFuncionarioSetor = $idFuncionarioSetor");

	$idFuncionario = $valor[0]['funcionario_idFuncionario'];
	$idSetor = $valor[0]['setor_idSetor'];
			
}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Vinculo funcionario com setor</legend>
    <form id="form_FuncionarioSetor" class="validate" method="post" action="" onsubmit="return false" >
      <p>
        <label>Funcionario:</label>
        <?php echo $Funcionario->selectFuncionarioSelect($idFuncionario, "required", "");?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Setor:</label>
        <?php echo $FuncionarioSetor->selectSetorSelect($idSetor, "required", "");?> <span class="placeholder">Campo Obrigatório</span> </p>    
      <p>
        <button class="button blue" 
        onclick="postForm('form_FuncionarioSetor', '<?php echo CAMINHO_MODULO."configuracoes/setor/grava.php?id=$idFuncionarioSetor"?>');"> Enviar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();
</script> 
