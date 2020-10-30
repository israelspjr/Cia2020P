<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$BancoHoras = new BancoHoras();
$Professor = new Professor();
$BancoHorasAulasRepostas = new BancoHorasAulasRepostas();

$arrayRetorno = array();
$idBancoHoras = $_REQUEST['id'];
$idBancoHorasAulasRepostas = $_REQUEST['idBancoHorasAulasRepostas'];

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

//echo $idPlanoAcaoGrupo;

//echo $idBancoHorasAulasRepostas;
$BancoHoras -> setIdBancoHoras($idBancoHoras);
$valorBanco = $BancoHoras->selectBancoHoras("where idBancoHoras = ".$idBancoHoras);

$idDiaAulaFFO = $valorBanco[0]['diaAulaFF_idDiaAulaFF'];
$horasRepor = $valorBanco[0]['horas'];

//echo $idDiaAulaFFO;

if ($idBancoHorasAulasRepostas > 0) {
	
	
$sql = "SELECT DFF.idDiaAulaFF, DFF.horaRealizada, DFF.dataAula, DFF.professor_NomeProfessorRep, P.nome, P.idProfessor, FF.dataReferencia
				FROM folhaFrequencia AS FF 
				INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo 
				INNER JOIN professor AS P ON P.idProfessor = FF.professor_idProfessor 
				INNER JOIN diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
				WHERE idDiaAulaFF = ".$idBancoHorasAulasRepostas;	
				
//				Uteis::pr ( $sql);		
			$result = Uteis::executarQuery($sql);
			
					
			$idAulaReposta = $result[0]['idDiaAulaFF'];
			$dataAulaRepostas = $result[0]['dataAula'];
			$horaReposta = $result[0]['horaRealizada'];
			$idProfessor = $result[0]['idProfessor'];
			$dataReferenciaFinal = $result[0]['dataReferencia'];
			
}



if ($_POST['acao'] == "deletar") {
	
	if ($idBancoHoras) {
		$BancoHorasAulasRepostas->setIdBancoHorasAulasRepostas($idBancoHorasAulasRepostas);
		$BancoHorasAulasRepostas->updateFieldBancoHorasAulasRepostas("excluido", 1);
		$BancoHoras -> updateFieldBancoHoras("professor_NomeProfessorRep", " ");
		
		
		
	}
		

//	$BancoHoras -> setIdBancoHoras($idBancoHoras);
//	 $BancoHoras -> deleteBancoHoras();
	 $arrayRetorno['mensagem'] = MSG_CADDEL;

} else {

	if ($idBancoHoras) {
		
	//	$idProfessor = $_POST['idProfessor'];
		
		if ($idProfessor == ' ') {
		$nomeProfessor = ' ';
		} else {
		$nomeProfessor = $Professor->getNome($idProfessor);
		}
		
		$BancoHoras -> updateFieldBancoHoras("professor_NomeProfessorRep", $nomeProfessor);
			
	//	$BancoHorasAulasRepostas->setDiaAulaFFIdDiaAulaFF($idAulaReposta);
		$BancoHorasAulasRepostas->setHorasRepostas($horasRepor);
		$BancoHorasAulasRepostas->setBancoHorasIdBancoHoras($idBancoHoras);
		$BancoHorasAulasRepostas->setProfessoridProfessor($idProfessor);
		$BancoHorasAulasRepostas->setAtivo(1);
		$BancoHorasAulasRepostas->setDiaAulaFFIdDiaAulaFF($idDiaAulaFFO);
		$BancoHorasAulasRepostas->setExcluido(0);
		$BancoHorasAulasRepostas->setTotalReposto($horaReposta);
		$BancoHorasAulasRepostas->setDataReferenciaFinal($dataReferenciaFinal);
		$BancoHorasAulasRepostas->setOcorrenciaExpirada(0);
		$BancoHorasAulasRepostas->setFinalizado(1);
		$BancoHorasAulasRepostas->setIdDiaAulaFFR($idAulaReposta);		
		$BancoHorasAulasRepostas->setSomaReposicao($horasRepor);
		$BancoHorasAulasRepostas->setHoraSobra(0);		
		$BancoHorasAulasRepostas->setPlanoAcaoGrupoidPlanoAcaoGrupo($idPlanoAcaoGrupo);	
		$BancoHorasAulasRepostas->setBancoHorasIdBancoHoras($idBancoHoras);
		$BancoHorasAulasRepostas->addBancoHorasAulasRepostas();
		
		
		$arrayRetorno['mensagem'] = MSG_CADATU;
		
		$arrayRetorno['fecharNivel'] = true;

	} else {

		$arrayRetorno['mensagem'] = "Não foi possível alterar o professor de reposição.";

	}

}

echo json_encode($arrayRetorno);
?>