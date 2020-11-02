<?php
//pagina conteudo o formulario 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NivelLinguisticoIdioma.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Idioma.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NivelLinguistico.class.php");


$NivelLinguisticoIdioma = new NivelLinguisticoIdioma();
$Idioma = new Idioma();
$NivelLinguistico = new NivelLinguistico();
		
$idNivelLinguisticoIdioma = $_REQUEST['id'];

if( $idNivelLinguisticoIdioma ){

	$valor = $NivelLinguisticoIdioma->selectNivelLinguisticoIdioma('WHERE idNivelLinguisticoIdioma='.$idNivelLinguisticoIdioma);
	
	//$idNivelLinguisticoIdioma = $valor[0]['idNivelLinguisticoIdioma'];
	$nivelLinguistico_idNivelLinguistico = $valor[0]['nivelLinguistico_idNivelLinguistico'];
	$idioma_idIdioma = $valor[0]['idioma_idIdioma'];
	$inativo = $valor[0]['inativo'];
	$excluido = $valor[0]['excluido'];
		 	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Nivel Linguístico Idioma</legend>
    <form id="form_NivelLinguisticoIdioma" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idNivelLinguisticoIdioma ?>" />
      <p>
        <label for="inativo">Inativo</label>
        <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label>Nivel Linguístico:</label>
        <?php echo $NivelLinguistico->selectNivelLinguisticoSelect("required", $nivelLinguistico_idNivelLinguistico, "  excluido = 0"); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Idioma:</label>
        <?php echo $Idioma->selectIdiomaSelect("required", $idioma_idIdioma, " AND excluido = 0"); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <button class="button blue" onclick="postForm('form_NivelLinguisticoIdioma', '<?php echo CAMINHO_MODULO?>configuracoes/nivellinguisticoidioma/grava.php')">Salvar</button>
      
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
