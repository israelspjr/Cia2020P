<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$TipoAtividadeExtraProfessor = new TipoAtividadeExtraProfessor();
$Habilidades = new Habilidades();

$idProfessor = $_GET['id'];
$caminhoAtualizar = CAMINHO_CAD."professor/include/form/opcaoAtividadeExtraProfessor.php?id=".$idProfessor;
$ondeAtualiza = "#div_lista_opcaoAtividadeExtraProfessor";
?>

<fieldset>
 

  <form id="form_opcaoHabilidadesProfessor" class="validate" method="post" onsubmit="return false" >
     <p>
    	<?php echo $Habilidades->selectInteressePerguntas(" WHERE tipo > 0 AND habilidade_idHabilidade = 0", $idProfessor);?> 
    </p>
 <legend>Hobby / Interesses / Vivências</legend>
 <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova Habilidade" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."habilidades/include/form/habilidades.php?idProfessor=".$idProfessor;?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>')" />    
    <p>
    	<?php echo $Habilidades->selectHabilidadesCheckbox(" WHERE tipo = 0 AND habilidade_idHabilidade = 0", $idProfessor);?> 
    </p>
   
    
    
    <div class="linha-inteira">
    <p>
      <button class="button blue" onclick="postForm('form_opcaoHabilidadesProfessor', '<?php echo CAMINHO_CAD."professor/"?>include/acao/opcaoHabilidadesProfessor.php?id=<?php echo $idProfessor?>')">Salvar</button>
    </p></div>
  </form>
</fieldset>

<script>
ativarForm();

function exibir() {
	
$("#outros").show();	
	
}
</script> 
