<?php
//pagina conteudo o formulario 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoAtividadeExtraProfessor.class.php");


$TipoAtividadeExtraProfessor = new TipoAtividadeExtraProfessor();
		
$idTipoAtividadeExtraProfessor = $_REQUEST['id'];

if($idTipoAtividadeExtraProfessor != '' && $idTipoAtividadeExtraProfessor  > 0){

	$valor = $TipoAtividadeExtraProfessor->selectTipoAtividadeExtraProfessor('WHERE idTipoAtividadeExtraProfessor='.$idTipoAtividadeExtraProfessor);
	
	//$idTipoAtividadeExtraProfessor = $valor[0]['idTipoAtividadeExtraProfessor'];
	$nome = $valor[0]['nome'];
	$inativo = $valor[0]['inativo'];
	$excluido = $valor[0]['excluido'];	 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Tipo Atividade Extra Professor</legend>
    <form id="form_TipoAtividadeExtraProfessor" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idTipoAtividadeExtraProfessor ?>" />
      <p>
        <label>Nome:</label>
        <input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label for="inativo">Inativo</label>
        <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <button class="button blue" onclick="postForm('form_TipoAtividadeExtraProfessor', '<?php echo CAMINHO_MODULO?>configuracoes/tipoatividadeextraprofessor/grava.php')">Salvar</button>
      
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
