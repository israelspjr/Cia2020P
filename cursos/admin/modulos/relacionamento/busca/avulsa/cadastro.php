<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$PlanoAcao = new PlanoAcao();

$idBuscaProfessor = $_GET['idBuscaProfessor'];
?>

<div id="cadastro_avulsa" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="div_cadastro_avulsaForm_aba" divExibir="div_cadastro_avulsaForm" class="aba_interna ativa">
			Busca avulsa
		</div>
	</div>
	<div id="modulos_PlanoAcao" class="conteudo_nivel">
		<div class="div_aba_interna" id="div_cadastro_avulsaForm">
			<?php require_once 'include/form/avulsa.php';?>
		</div>
	</div>
</div>
<script>
</script>