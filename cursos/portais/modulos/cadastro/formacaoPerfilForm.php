<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$FormacaoPerfil = new FormacaoPerfil();

$idFormacaoPerfil = $_GET['id'];	
$clientePfIdClientePf = $_SESSION['idClientePf_SS'];

if($idFormacaoPerfil!=''){
	
	$valorFormacaoperfil = $FormacaoPerfil->selectFormacaoperfil("WHERE idFormacaoPerfil=".$idFormacaoPerfil);
	
	$clientePfIdClientePf = $valorFormacaoperfil[0]['clientePf_idClientePf'];			
	$formacao = $valorFormacaoperfil[0]['formacao'];
	$curso = $valorFormacaoperfil[0]['curso'];
	$instituicao = $valorFormacaoperfil[0]['instituicao'];
	$obs = $valorFormacaoperfil[0]['obs'];
}
	
?>

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
    --><fieldset>
    <legend>Formação escolar</legend>
    <form id="form_formacaoPerfil" class="validate" method="post" onsubmit="return false" >
      <input name="clientePf_idClientePf" type="hidden" value="<?php echo $clientePfIdClientePf?>" />
      <p>
        <label>Formação:</label>
        <input type="text" name="formacao" id="formacao" class="required" value="<?php echo $formacao ?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Curso:</label>
        <input type="text" name="curso" id="curso" class="required" value="<?php echo $curso ?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Instituição:</label>
        <input type="text" name="instituicao" id="instituicao" class="required" value="<?php echo $instituicao ?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs ?></textarea>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <button class="Bblue" onclick="enviadoOK();postForm('form_formacaoPerfil', '<?php echo "modulos/cadastro/formacaoPerfilAcao.php?id=$idFormacaoPerfil"?>')">Salvar</button>
        
         <button class="gray" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/formacaoPerfil.php', '#centro');">Fechar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>//ativarForm();</script> 
