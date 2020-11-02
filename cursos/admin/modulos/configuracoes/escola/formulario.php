<?php
//pagina conteudo o formulario 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Escola.class.php");


$Escola = new Escola();
		
$idEscola = $_REQUEST['id'];

if($idEscola != '' && $idEscola  > 0){

	$valor = $Escola->selectEscola('WHERE idEscola='.$idEscola);
	
	//$idEscola = $valor[0]['idEscola'];
	 $nome = $valor[0]['nome'];
	 $inativo = $valor[0]['inativo'];
	 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Escola</legend>
    <form id="form_Escola" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idEscola ?>" />
      <p>
        <label for="inativo">Inativo</label>
        <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label>Nome:</label>
        <input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <button class="button blue" onclick="postForm('form_Escola', '<?php echo CAMINHO_MODULO?>configuracoes/escola/grava.php')">Salvar</button>
      
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
