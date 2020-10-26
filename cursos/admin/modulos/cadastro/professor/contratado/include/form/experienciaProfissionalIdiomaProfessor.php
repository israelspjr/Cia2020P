<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ExperienciaProfissionaldiomaProfessor.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Escola.class.php");

	$ExperienciaProfissionaldiomaProfessor = new ExperienciaProfissionaldiomaProfessor();
	$Escola = new Escola();
	
	$idExperienciaProfissionaldiomaProfessor = $_GET['id'];	
	$idiomaProfessor_idIdiomaProfessor = $_GET['idIdiomaProfessor'];	
	
	if($idExperienciaProfissionaldiomaProfessor!=''){
		
		$valorExperienciaProfissionaldiomaProfessor = $ExperienciaProfissionaldiomaProfessor->selectExperienciaProfissionaldiomaProfessor("WHERE idExperienciaProfissionaldiomaProfessor = ".$idExperienciaProfissionaldiomaProfessor);
		
		$idiomaProfessor_idIdiomaProfessor = $valorExperienciaProfissionaldiomaProfessor[0]['idiomaProfessor_idIdiomaProfessor'];		
		$nivel = $valorExperienciaProfissionaldiomaProfessor[0]['nivel'];
		$comentario = $valorExperienciaProfissionaldiomaProfessor[0]['comentario'];
		$idEscola = $valorExperienciaProfissionaldiomaProfessor[0]['escola_idEscola'];				
	}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro de experiência profissional no idioma </legend>
    <form id="form_ExperienciaProfissionaldiomaProfessor" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" name="idiomaProfessor_idIdiomaProfessor" id="idiomaProfessor_idIdiomaProfessor" value="<?php echo $idiomaProfessor_idIdiomaProfessor?>" />
      <p>
        <label>Escola:</label>
        <?php echo $Escola->selectEscolaSelect("required", $idEscola );?> <!--escola--> 
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Nível que lecionou:</label>
        <input type="text" name="nivel" id="nivel" class="required" value="<?php echo $nivel?>"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Observação:</label>
        <textarea name="comentario" id="comentario" cols="40" rows="4" ><?php echo $comentario?></textarea>
      </p>
      <p>
        <button class="button blue" onclick="postForm('form_ExperienciaProfissionaldiomaProfessor', '<?php echo CAMINHO_CAD."professor/"?>contratado/include/acao/experienciaProfissionalIdiomaProfessor.php?id=<?php echo $idExperienciaProfissionaldiomaProfessor?>');" >Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 