<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$Professor = new Professor();

	
?>

<fieldset>
  <legend>Impostos atribuidos</legend>
  <div class="agrupa" id="div_form_dadosBancario">
    <form id="form_impostoProfessor" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" name="professor_idProfessor" id="professor_idProfessor" value="<?php echo $idProfessor?>" />
      <div class="linha-inteira"> <?php echo $Professor->impostoProfessor($idProfessor);?> </div>
      <div class="linha-inteira">
        <p>
          <button class="button blue" onclick="postForm('form_impostoProfessor', '<?php echo CAMINHO_CAD."professor/"?>contratado/include/acao/impostosProfessor.php?id=<?php echo $idProfessor?>');" >Salvar</button>
          
        </p>
      </div>
    </form>
  </div>
</fieldset>
<script>
ativarForm();
</script> 