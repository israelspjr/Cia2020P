<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$MeioLocomocao = new MeioLocomocao();
$idProfessor = $_SESSION['idProfessor_SS'];

?>

<fieldset>
  <legend>Meio de locomoção professor</legend>

  <form id="form_meioLocomocaoProfessor" class="validate" action="" method="post" onsubmit="return false" >
    <?php echo $MeioLocomocao->selectMeioLocomocaoCheckbox($idProfessor);?> <br />
    <div class="linha-inteira">
      <p>
        <button class="Bblue" onclick="enviadoOK();postForm('form_meioLocomocaoProfessor', '<?php echo "modulos/cadastro/meioLocomocaoProfessorAcao.php?id=$idProfessor"?>');" >Salvar</button>
       </p>
    </div>
  </form>
</fieldset>
<script>//ativarForm();</script> 
