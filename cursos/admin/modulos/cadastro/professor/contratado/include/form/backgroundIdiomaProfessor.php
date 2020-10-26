<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/BackgroudIdiomaProfessor.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Escola.class.php");

	$BackgroudIdiomaProfessor = new BackgroudIdiomaProfessor();
	$Escola = new Escola();
	
	$idBackgroudIdiomaProfessor = $_GET['id'];	
	$idiomaProfessor_idIdiomaProfessor = $_GET['idIdiomaProfessor'];	
	
	if($idBackgroudIdiomaProfessor!=''){
		
		$valorBackgroudIdiomaProfessor = $BackgroudIdiomaProfessor->selectBackgroudIdiomaProfessor("WHERE idBackgroudIdiomaProfessor = ".$idBackgroudIdiomaProfessor);
		
		$idiomaProfessor_idIdiomaProfessor = $valorBackgroudIdiomaProfessor[0]['idiomaProfessor_idIdiomaProfessor'];		
		$idEscola = $valorBackgroudIdiomaProfessor[0]['escola_idEscola'];
		$comentario1 = $valorBackgroudIdiomaProfessor[0]['comentario1'];
		$comentario2 = $valorBackgroudIdiomaProfessor[0]['comentario2'];			
		$obs = $valorBackgroudIdiomaProfessor[0]['obs'];				
	}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Background do idioma do professor</legend>
    <form id="form_backgroundIdiomaProfessor" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" name="idiomaProfessor_idIdiomaProfessor" id="idiomaProfessor_idIdiomaProfessor" value="<?php echo $idiomaProfessor_idIdiomaProfessor?>" />
      <p>
        <label>Escola:</label>
        <?php echo $Escola->selectEscolaSelect("required", $idEscola );?> <!--escola--> 
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Tempo que estudou:</label>
        <input type="text" name="comentario1" id="comentario1" class="required" value="<?php echo $comentario1?>"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
            
      <p>
        <label>Cursos, viagens, etc:</label>
        <textarea name="comentario2" id="comentario2" cols="40" rows="4" ><?php echo $comentario2?></textarea>
      </p>
        
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4" ><?php echo $obs?></textarea>
      </p>
      <p>
        <button class="button blue" onclick="postForm('form_backgroundIdiomaProfessor', '<?php echo CAMINHO_CAD."professor/"?>contratado/include/acao/backgroundIdiomaProfessor.php?id=<?php echo $idBackgroudIdiomaProfessor?>');" >Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 