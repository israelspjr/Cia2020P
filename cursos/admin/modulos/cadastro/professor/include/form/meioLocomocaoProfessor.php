<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MeioLocomocao.class.php");
	
$MeioLocomocao = new MeioLocomocao();
$idProfessor = $_GET['id'];

?>

<fieldset>
  <legend>Meio de locomoção professor</legend>

  <form id="form_meioLocomocaoProfessor" class="validate" action="" method="post" onsubmit="return false" >
    <?php echo $MeioLocomocao->selectMeioLocomocaoCheckbox($idProfessor);?> <br />
    <div class="linha-inteira">
      <p>
        <button class="button blue" onclick="postForm('form_meioLocomocaoProfessor', '<?php echo CAMINHO_CAD."professor/include/acao/meioLocomocaoProfessor.php?id=$idProfessor"?>');" >Salvar</button>
      </p>
    </div>
  </form>
</fieldset>
<script>ativarForm();</script> 
