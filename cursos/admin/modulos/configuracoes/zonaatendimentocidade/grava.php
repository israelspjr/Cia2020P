<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ZonaAtendimentoCidade.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$ZonaAtendimentoCidade = new ZonaAtendimentoCidade();
	

$idZonaAtendimentoCidade = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$ZonaAtendimentoCidade->setIdZonaAtendimentoCidade($idZonaAtendimentoCidade);	
	$ZonaAtendimentoCidade->updateFieldZonaAtendimentoCidade("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$cidade_idCidade = $_POST['idCidade'];
	$pais_idPais = $_POST['pais_idPais'];
	$zona = $_POST['zona'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$ZonaAtendimentoCidade->setIdZonaAtendimentoCidade($idZonaAtendimentoCidade);
	$ZonaAtendimentoCidade->setCidadeIdCidade($cidade_idCidade);
	$ZonaAtendimentoCidade->setPaisIdPais($pais_idPais);
	$ZonaAtendimentoCidade->setZona($zona);
	$ZonaAtendimentoCidade->setInativo($inativo);
	
	
	
	if($idZonaAtendimentoCidade != "" && $idZonaAtendimentoCidade > 0 ){
		$ZonaAtendimentoCidade->updateZonaAtendimentoCidade();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idZonaAtendimentoCidade = $ZonaAtendimentoCidade->addZonaAtendimentoCidade();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>