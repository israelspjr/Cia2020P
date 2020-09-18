<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");  
	
	$TipoAtividadeExtraProfessor = new TipoAtividadeExtraProfessor();
	
	$idClientePf = $_SESSION['idClientePf_SS'];
?>

<fieldset>
  <legend>Perfil do professor de preferência do aluno</legend>
  <p>
  Indique abaixo o perfil de professor ideal para suas aulas para selecionarmos o mais próximo da sua indicação.
  </p>
  <div class="menu_interno"></div>
  <form id="form_opcaoAtividadeExtraProfessorClientePf" class="validate" method="post" onsubmit="return false" >
    <p>
    	<?php echo $TipoAtividadeExtraProfessor->selectTipoatividadeextraprofessorField($idClientePf, "clientePf");?> 
    </p>
    <div class="linha-inteira">
    <p>
      <button class="Bblue" onclick="enviadoOK();postForm('form_opcaoAtividadeExtraProfessorClientePf', '<?php echo "modulos/cadastro/opcaoAtividadeExtraProfessorClientePfAcao.php?id=$idClientePf"?>');">Salvar</button>
      <button class="gray" onclick="zerarCentro();carregarModulo('cursos/portais/index.php', '#centro');">Fechar</button>
    </p></div>
  </form>
</fieldset>
<script>//ativarForm();
//function refresh() {
// window.location = "http://www.companhiadeidiomas.net/cursos/portais/"; 

//}</script> 
