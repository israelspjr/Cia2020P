<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/DiasBuscaAvulsa.class.php");


$DiasBuscaAvulsa = new DiasBuscaAvulsa();

$arrayRetorno = array();

$idDiasBuscaAvulsa = $_REQUEST['id'];
$DiasBuscaAvulsa->setIdDiasBuscaAvulsa($idDiasBuscaAvulsa);

if($_POST['acao']=="deletar"){
    $DiasBuscaAvulsa->updateFieldDiasBuscaAvulsa("excluida", "1");	
	$arrayRetorno['mensagem'] = "Dia da busca avulsa excluido com sucesso.";
	
}else{
    // daniel: adicionei estas linhas
    if (isset($_POST['idDiasBuscaAvulsa'])){
    $idDiasBuscaAvulsa = $_POST['idDiasBuscaAvulsa'];
    $DiasBuscaAvulsa->setIdDiasBuscaAvulsa($idDiasBuscaAvulsa);
    }
    // fim
	$DiasBuscaAvulsa->setBuscaAvulsaIdBuscaAvulsa($_POST['idBuscaAvulsa']);
	$DiasBuscaAvulsa->setTipo($_POST['tipo']);
	$DiasBuscaAvulsa->setHoraInicio(Uteis::gravarHoras($_POST['horaInicio']));
	$DiasBuscaAvulsa->setHoraFim(Uteis::gravarHoras($_POST['horaFim']));
	$DiasBuscaAvulsa->setDiaSemanaAula($_POST['diaSemanaAula']);
	$DiasBuscaAvulsa->setDataAula(Uteis::gravarData($_POST['dataAula']));			
	$DiasBuscaAvulsa->setObs($_POST['obs']);

	if( $idDiasBuscaAvulsa ){
		$DiasBuscaAvulsa->updateDiasBuscaAvulsa();			
		$arrayRetorno['mensagem'] = "Dia da busca avulsa atualizado com sucesso.";
		
	}else{
		
		$idDiasBuscaAvulsa = $DiasBuscaAvulsa->addDiasBuscaAvulsa();
		$arrayRetorno['mensagem'] = "Dia da busca avulsa inserido com sucesso.";
	}
	
	$arrayRetorno['fecharNivel'] = true;
}
echo json_encode($arrayRetorno);