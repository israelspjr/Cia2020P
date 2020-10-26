<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/DisponibilidadeProfessor.class.php");


$DisponibilidadeProfessor = new DisponibilidadeProfessor();

$idDisponibilidadeProfessor = $_REQUEST['id'];

$DisponibilidadeProfessor->setIdDisponibilidade($idDisponibilidadeProfessor);

$arrayRetorno = array();

if($_REQUEST['acao']=="deletar"){
		
	$DisponibilidadeProfessor->deleteDisponibilidadeProfessor();
	
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	$arrayRetorno['fecharNivel'] = true;
	
}else{
	
	$horaInicio = Uteis::gravarHoras($_POST['horaInicio']);
	$horaFim = Uteis::gravarHoras($_POST['horaFim']);
	
	if($horaFim < $horaInicio + 15){
		$arrayRetorno['mensagem'] = "Hora de fim deve ser maior que hora de inicio, com um intervalo de no minimo 15 minutos.";
	}elseif($horaInicio < 360 || $horaFim > 1320){
		$arrayRetorno['mensagem'] = "O periodo de disponibilidade disponivel para cadastro é das 06:00 às 22:00.";
	}else{
		
		$idProfessor = $_POST['professor_idProfessor'];
		$diaSemana = $_POST['diaSemana'];

		$where = " WHERE professor_idProfessor = ".$idProfessor." AND diaSemana = ".$diaSemana;
		if($idDisponibilidadeProfessor) $where .= " AND idDisponibilidade NOT IN(".$idDisponibilidadeProfessor.") ";
		$where .= " AND (";
		$where .= " 	".$horaInicio." BETWEEN horaInicio+1 AND horaFim-1 ";
		$where .= " 	OR ";
		$where .= " 	".$horaFim." BETWEEN horaInicio+1 AND horaFim-1 ";
		$where .= " 	OR ";
		$where .= " 	(".$horaInicio." < horaInicio AND ".$horaFim." > horaFim ) ";
		$where .= " )";
		$valorDisponibilidadeProfessor = $DisponibilidadeProfessor->selectDisponibilidadeProfessor($where);	
		
		if($valorDisponibilidadeProfessor){
			
			$arrayRetorno['mensagem'] = "Ja existe uma disponibilidade cadastrada para o periodo \n".Uteis::exibirHoras($valorDisponibilidadeProfessor[0]['horaInicio'])." às ".Uteis::exibirHoras($valorDisponibilidadeProfessor[0]['horaFim']);
			
		}else{
			$DisponibilidadeProfessor->setProfessorIdProfessor($idProfessor);
			$DisponibilidadeProfessor->setStatusAgendaIdStatusAgenda($_POST['statusAgenda_idStatusAgenda']);
			$DisponibilidadeProfessor->setHoraInicio( $horaInicio );
			$DisponibilidadeProfessor->setHoraFim( $horaFim );
			$DisponibilidadeProfessor->setexibirDiaSemana($diaSemana);
			$DisponibilidadeProfessor->setObs($_POST['obs']);
			$DisponibilidadeProfessor->setDataDisponibilidade(date("Y-m-d hh:mm:ss"));
			
			if($idDisponibilidadeProfessor){
				
				$DisponibilidadeProfessor->updateDisponibilidadeProfessor();		
				$arrayRetorno['mensagem'] = MSG_CADATU;
				
			}else{
				
				$idDisponibilidadeProfessor = $DisponibilidadeProfessor->addDisponibilidadeProfessor();
				$arrayRetorno['mensagem'] = MSG_CADNEW;	
			}
			
			$arrayRetorno['fecharNivel'] = true;
		}
	}
}

echo json_encode($arrayRetorno);

?>
