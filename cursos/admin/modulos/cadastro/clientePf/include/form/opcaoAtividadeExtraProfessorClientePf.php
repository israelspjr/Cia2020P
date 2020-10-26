<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");  
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");	
		  	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoAtividadeExtraProfessor.class.php");
	
	$TipoAtividadeExtraProfessor = new TipoAtividadeExtraProfessor();
	
	$idClientePf = $_GET['id'];
?>

<fieldset>
  <legend>Perfil do professor de preferência do aluno</legend>
  <div class="menu_interno"><img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CONFIG."atividadeextraprofessor/formulario.php";?>', '', '#');" /></div>
  <form id="form_opcaoAtividadeExtraProfessorClientePf" class="validate" method="post" onsubmit="return false" >
    <p>
    	<?php echo $TipoAtividadeExtraProfessor->selectTipoatividadeextraprofessorField($idClientePf, "clientePf");?> 
    </p>
    <div class="linha-inteira">
    <p>
      <button class="button blue" onclick="postForm('form_opcaoAtividadeExtraProfessorClientePf', '<?php echo CAMINHO_CAD."clientePf/include/acao/opcaoAtividadeExtraProfessorClientePf.php?id=$idClientePf"?>')">Salvar</button>
    </p></div>
  </form>
</fieldset>
<script>ativarForm();</script> 
