<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProcessoSeletivoProfessor.class.php");

$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();

$idProfessor = $_GET['idProfessor'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Contratar professor</legend>
    <form id="form_contratar" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" name="idProfessor" id="idProfessor" value="<?php echo $idProfessor?>" />
      <p>
        <label>Idiomas disponíveis: </label>
        <?php echo $ProcessoSeletivoProfessor->selectProcessoSeletivoProfessor_checkBox($idProfessor)?></p>
      <p>
        <button class="button blue" onclick="postForm('form_contratar', '<?php echo CAMINHO_CAD."professor/include/acao/contratar.php"?>');" >Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();

function ativaOutrosCampos( obj ){
  
  var from = $(obj).attr('from');

  if( $(obj).attr('checked') == 'checked' ){
	$('#div_processoSeletivoProfessor_'+from).slideDown();
	$('#dataContratacao_processoSeletivoProfessor_'+from).attr('disabled', false).addClass('required');
	$('#idNivelLinguistico_processoSeletivoProfessor_'+from).attr('disabled', false).addClass('required');
  }else{
	$('#div_processoSeletivoProfessor_'+from).slideUp();
   	$('#dataContratacao_processoSeletivoProfessor_'+from).attr('disabled', true).removeClass('invalid required');
   	$('#idNivelLinguistico_processoSeletivoProfessor_'+from).attr('disabled', true).removeClass('invalid required');    
  }
} 
</script>