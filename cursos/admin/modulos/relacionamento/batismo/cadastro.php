<?php  
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcao.class.php");
	
	$PlanoAcao = new PlanoAcao();
	
	$idPlanoAcao = $_GET['id'];
		
?>

<div id="cadastro_PlanoAcao" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_cadastro_PlanoAcao" divExibir="div_cadastro_PlanoAcao" class="aba_interna ativa">Novo grupo</div>
  </div>
  <div id="modulos_PlanoAcao" class="conteudo_nivel">
    <div id="div_cadastro_PlanoAcao" class="div_aba_interna">
      <?php require_once 'include/form/batismo.php';?>
    </div>
  </div>
</div>
