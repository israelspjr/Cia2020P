<?php
//pagina conteudo o formulario 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AtividadeExtraProfessor.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoAtividadeExtraProfessor.class.php");

$AtividadeExtraProfessor = new AtividadeExtraProfessor();
$TipoAtividadeExtraProfessor = new TipoAtividadeExtraProfessor();
	
$idAtividadeExtraProfessor = $_REQUEST['id'];

if($idAtividadeExtraProfessor != '' && $idAtividadeExtraProfessor  > 0){

	$valor = $AtividadeExtraProfessor->selectAtividadeExtraProfessor('WHERE idAtividadeExtraProfessor='.$idAtividadeExtraProfessor);
	
	//$idAtividadeExtraProfessor = $valor[0]['idAtividadeExtraProfessor'];
	 $tipoAtividadeExtraProfessor_idTipoAtividadeExtraProfessor = $valor[0]['tipoAtividadeExtraProfessor_idTipoAtividadeExtraProfessor'];
	 $nome = $valor[0]['nome'];
     $ativar = $valor[0]['ativar'];
	 $inativo = $valor[0]['inativo'];
	 $excluido = $valor[0]['excluido'];
	 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();"></div>
  <fieldset>
    <legend>Cadastro - Atividade Extra Professor</legend>
    <form id="form_AtividadeExtraProfessor" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idAtividadeExtraProfessor ?>" />
      <p>
        <label for="inativo">Inativo</label>
        <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label for="ativar">Aceita Comentário</label>
        <input type="checkbox" name="ativar" id="ativar" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label>Tipo Atividade Extra Professor:</label>
        <?php echo $TipoAtividadeExtraProfessor->selectTipoAtividadeExtraProfessorSelect("required", $tipoAtividadeExtraProfessor_idTipoAtividadeExtraProfessor, " WHERE inativo = 0 AND excluido = 0"); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Nome:</label>
        <input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <button class="button blue" onclick="postForm('form_AtividadeExtraProfessor', '<?php echo CAMINHO_MODULO?>configuracoes/atividadeextraprofessor/grava.php')">Salvar</button>
      
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
