<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AgendamentoVisita.class.php");


$AgendamentoVisita = new AgendamentoVisita();

$idAgendamentoVisita= $_REQUEST['id'];

if($_REQUEST['acao'] == 'deletar'){
	$AgendamentoVisita->setIdAgendamentoVisita($idAgendamentoVisita);
	$AgendamentoVisita->deleteAgendamentoVisita();
	$arrayRetorno['mensagem'] = "Excluído com sucesso";
}else{

	$AgendamentoVisita->setIdAgendamentoVisita($idAgendamentoVisita);
    $AgendamentoVisita->setPropostaIdProposta($_POST['proposta_idProposta']);
    $AgendamentoVisita->setTipoVisitaIdTipoVisita($_POST['idTipoVisita']);
    $AgendamentoVisita->setEnderecoIdEndereco($_POST['idEndereco']);
    $AgendamentoVisita->setObs($_POST['obs']);
    $AgendamentoVisita->setDataVisita(Uteis::gravarData($_POST['dataVisita']));

	
    $AgendamentoVisita->setHoraInicio( Uteis::gravarHoras( $_POST['horaInicio'] ) );
    $AgendamentoVisita->setHoraFim( Uteis::gravarHoras( $_POST['horaFim'] ) );
    $AgendamentoVisita->setRealizada($_POST['realizada']);
	
	
	
	if($idAgendamentoVisita!= "" && $idAgendamentoVisita> 0 ){
		$AgendamentoVisita->updateAgendamentoVisita();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		$arrayRetorno['fecharNivel'] = true;
		
	}else{
		$AgendamentoVisita->addAgendamentoVisita();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['fecharNivel'] = true;
	}				
}

echo json_encode($arrayRetorno);

?>