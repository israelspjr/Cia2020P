<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");	
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Escola.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Idioma.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/IdiomaBackgroundPerfil.class.php");
	
	$Escola = new Escola();	
	$Idioma = new Idioma();	
	$IdiomaBackgroundPerfil = new IdiomaBackgroundPerfil();	
	
	$clientePfIdClientePf = $_GET['idClientePf'];	
	$idIdiomabackgroundperfil = $_GET['id'];	
	
	if($idIdiomabackgroundperfil!=''){
		
		$valorIdiomabackgroundperfil = $IdiomaBackgroundPerfil->selectIdiomabackgroundperfil("WHERE idIdiomaBackgroundPerfil =".$idIdiomabackgroundperfil);
			
		$IdiomaBackgroundPerfil = $valorIdiomabackgroundperfil[0]['idIdiomaBackgroundPerfil'];
		
		//CHAVES ESTRANGEIRAS
		$clientePfIdClientePf = $valorIdiomabackgroundperfil[0]['clientePf_idClientePf'];		
		//		
		$idIdioma = $valorIdiomabackgroundperfil[0]['idioma_idIdioma'];				
		$idEscola = $valorIdiomabackgroundperfil[0]['escola_idEscola'];				
		$obs = $valorIdiomabackgroundperfil[0]['obs'];				

	}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Idioma de background</legend>
    <form id="form_idiomaBackgroundPerfil" class="validate" method="post" onsubmit="return false" >
      <input name="clientePf_idClientePf" type="hidden" value="<?php echo $clientePfIdClientePf?>" />
      <p> 
        <label>Idioma:</label>
        <?php echo $Idioma->selectIdiomaSelect("required", $idIdioma);?><span class="placeholder">Campo Obrigatório</span> 
        <!--funcao retorna idioma --> </p>
      <p>
        <label>Escola:</label>
        <?php echo $Escola->selectEscolaSelect("required", $idEscola);?><span class="placeholder">Campo Obrigatório</span> 
        <!--funcao retorna escola --> 
      </p>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4" ><?php echo $obs?></textarea>
      </p>
      <p>
        <button class="button blue" onclick="postForm('form_idiomaBackgroundPerfil', '<?php echo CAMINHO_CAD."clientePf/include/acao/idiomaBackgroundPerfil.php?id=$idIdiomabackgroundperfil"?>')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 