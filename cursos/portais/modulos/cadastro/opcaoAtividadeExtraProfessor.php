<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Habilidades = new Habilidades();


?>
<fieldset>
 
 
  <form id="form_opcaoHabilidadesProfessor" class="validate" method="post" onsubmit="return false" >
      <p>
    	<?php echo $Habilidades->selectInteressePerguntas(" WHERE tipo > 0 AND habilidade_idHabilidade = 0", $idProfessor);?> 
    </p>
     <legend>Hobby / Interesses / Vivências </legend>
    <p>
    	<?php echo $Habilidades->selectHabilidadesCheckbox(" WHERE tipo = 0 AND habilidade_idHabilidade = 0", $idProfessor);?> 
    </p>
    <p>&nbsp;</p>
  
    <p><input type="text" name="outros" id="outros" value=""  style="display:none"/></p>
    <div class="linha-inteira">
    <p>
      <button class="Bblue" onclick="enviadoOK();postForm('form_opcaoHabilidadesProfessor', 'modulos/cadastro/opcaoHabilidadesProfessorAcao.php?id=<?php echo $_SESSION['idProfessor_SS']?>')">Salvar</button>
    
    </p></div>
  </form>
</fieldset>

<script>//ativarForm();
function enviadoOK() {
	alert("Conteúdo inserido/alterado com sucesso!");
}

function exibir() {
	
$("#outros").show();	
	
}

</script> 
