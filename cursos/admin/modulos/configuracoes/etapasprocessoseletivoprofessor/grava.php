<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EtapasProcessoSeletivoProfessor.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$EtapasProcessoSeletivoProfessor = new EtapasProcessoSeletivoProfessor();
	

$idEtapasProcessoSeletivoProfessor = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$EtapasProcessoSeletivoProfessor->setIdEtapasProcessoSeletivoProfessor($idEtapasProcessoSeletivoProfessor);	
	$EtapasProcessoSeletivoProfessor->updateFieldEtapasProcessoSeletivoProfessor("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$EtapasProcessoSeletivoProfessor->setIdEtapasProcessoSeletivoProfessor($idEtapasProcessoSeletivoProfessor);
	$EtapasProcessoSeletivoProfessor->setNome($nome);
	$EtapasProcessoSeletivoProfessor->setInativo($inativo);
	
	
	
	if($idEtapasProcessoSeletivoProfessor != "" && $idEtapasProcessoSeletivoProfessor > 0 ){
		$EtapasProcessoSeletivoProfessor->updateEtapasProcessoSeletivoProfessor();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idEtapasProcessoSeletivoProfessor = $EtapasProcessoSeletivoProfessor->addEtapasProcessoSeletivoProfessor();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>