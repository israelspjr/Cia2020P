<?php  
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Gestor.class.php");
	
	
		
	$Gestor = new Gestor();
	
	$idGestor = $_GET['id'];
	
	if($idGestor != '' && is_numeric($idGestor)){
		$valor = $Gestor->selectGestor("WHERE idGestor =".$idGestor);
		$idClientePf =$valor[0]['clientePf_idClientePf'];
		$idFuncionario =$valor[0]['funcionario_idFuncionario'];
		$idProfessor =$valor[0]['professor_idProfessor'];
		$obs =$valor[0]['obs'];
	}	
?>




<div id="cadastro_gestor" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_cadastro_gestor" divExibir="div_cadastro_gestor" class="aba_interna ativa">Cadastro</div>
  </div>
  <div id="modulos_gerente" class="conteudo_nivel">
    <div id="div_cadastro_gestor" style="" class="div_aba_interna">
      <?php require_once 'include/form/gestor.php';?>
    </div>
  </div>
</div>
