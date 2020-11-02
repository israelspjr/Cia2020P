<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FuncionarioSetor = new FuncionarioSetor();
$Funcionario = new Funcionario();
$Setor = new Setor();

$idSetor = $_REQUEST["id"];

if( is_numeric($idSetor) ){
	
	$valor = $Setor->selectSetor(" WHERE id = $idSetor");

	$nome = $valor[0]['nome'];
	$idSetor = $valor[0]['idSetor'];
			
}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onClick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Criar novo setor</legend>
    <form id="form_FuncionarioSetor" class="validate" method="post" action="" onSubmit="return false" >
      <p>
        <label>Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $nome?>" /></p>
        <p>
        <label for="Excluido">Inativo:</label>
        <input type="checkbox" name="excluido" id="excluido" value="1" class="">
      </p>
         <p>
        <button class="button blue" 
        onclick="postForm('form_FuncionarioSetor', '<?php echo CAMINHO_MODULO."configuracoes/setor/grava2.php?id=$idSetor"?>');"> Enviar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();
</script> 
