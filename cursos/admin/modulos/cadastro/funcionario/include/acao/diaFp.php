<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FolhaPonto = new FolhaPonto();
$DiaFolhaPonto = new DiaFolhaPonto();

$arrayRetorno = array();

	$idFolhaPonto = $_REQUEST['idFolhaPonto'];
	
	if ($idFolhaPonto != "") {
		$valorFolhaPonto = $FolhaPonto->selectFolhaPonto(" WHERE idFolhaPonto = $idFolhaPonto");
		$dataReferencia = $valorFolhaPonto[0]['dataReferencia'];
		
		 $ano = date('Y', strtotime($dataReferencia));
         $mes = date('m', strtotime($dataReferencia));

		
		//Inserindo os dias na Folha de Ponto
		$dias = cal_days_in_month(CAL_GREGORIAN, $mes , $ano); 
			for ($x = 1;$x<=$dias;$x++) {
				
				$DiaFolhaPonto->setFolhaPontoIdFolhaPonto($idFolhaPonto);
				$DiaFolhaPonto->setDia($x);
				$DiaFolhaPonto->setEntrada(Uteis::gravarHoras($_POST['entrada_'.$x]));
				$DiaFolhaPonto->setSaidaAlmoco(Uteis::gravarHoras($_POST['almoco_'.$x]));
				$DiaFolhaPonto->setVoltaAlmoco(Uteis::gravarHoras($_POST['volta_'.$x]));
				$DiaFolhaPonto->setSaida(Uteis::gravarHoras($_POST['saida_'.$x]));
				$DiaFolhaPonto->setCreditos(Uteis::gravarHoras($_POST['cred_'.$x]));
				$DiaFolhaPonto->setDebitos(Uteis::gravarHoras($_POST['deb_'.$x]));
				$DiaFolhaPonto->setOcorrenciaFP($_POST['idOcorrenciaFP_'.$x]);
				$DiaFolhaPonto->setObs($_POST['obs_'.$x]);
				$DiaFolhaPonto->setBanco(Uteis::gravarHoras($_POST['banco_'.$x]));
							
				$DiaFolhaPonto->updateDiaFP( $idFolhaPonto, $x);
		

			}
		$arrayRetorno['mensagem'] = "Dados inserido com sucesso!";
		
	}
		

echo json_encode($arrayRetorno);
?>