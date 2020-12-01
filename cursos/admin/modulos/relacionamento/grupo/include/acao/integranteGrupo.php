<?php require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$IntegranteGrupo = new IntegranteGrupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$PsaControle = new PsaControle();
$Log = new Log();
$ClientePf = new ClientePf();

$arrayRetorno = array();

$idIntegranteGrupo = $_REQUEST['id'];

if($_REQUEST['acao']=="deletar"){

	$idIntegranteGrupo = $_REQUEST['id'];
	$dataSaida = Uteis::gravarData($_POST['dataSaida']);
	$dataRetorno = Uteis::gravarData($_POST['dataRetorno']);
	$motivo = $_POST['motivo'];
	$inativar = $_POST['inativar'];
	$area = $_POST['area'];
    
	$manterRateamento = $_POST['manterRateamento'];   
	$dataSaidaDemonstrativo = Uteis::gravarData($_POST['dataSaidaDemonstrativo']);    
        
	$valorIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupo(" WHERE idIntegranteGrupo = ".$idIntegranteGrupo);
	$dataEntrada = $valorIntegranteGrupo[0]['dataEntrada'];
	$idClientePf = $valorIntegranteGrupo[0]['clientePf_idClientePf'];
	
	$mesAtual = date("YYYY-mm-01");
    
	if($dataSaida < $dataEntrada ){
		$arrayRetorno['mensagem'] = "Data do desvinculo deve ser maior ou igual a ".Uteis::exibirData($dataEntrada);		
	}elseif($manterRateamento && $dataSaidaDemonstrativo <= $dataEntrada){
		$arrayRetorno['mensagem'] = "Data do desvinculo do rateamento deve ser maior que ".Uteis::exibirData($dataEntrada);		
	}else{		
	
		//verifica se ja existe dias na ff para este aluno no periodo
		$sql = " SELECT idDiaAulaFFIndividual FROM diaAulaFFIndividual AS DFI 
		INNER JOIN diaAulaFF AS DF ON DF.idDiaAulaFF = DFI.diaAulaFF_idDiaAulaFF
		INNER JOIN folhaFrequencia AS FF ON FF.idFolhaFrequencia = DF.folhaFrequencia_idFolhaFrequencia AND ( FF.finalizadaParcial = 1 OR FF.finalizadaPrincipal = 1)
		WHERE DFI.integranteGrupo_idIntegranteGrupo = $idIntegranteGrupo AND dataAula >= '$dataSaida'";
		//echo $sql;
		$result = mysqli_num_rows($IntegranteGrupo->query($sql));

        //if( $result ){
        //	$arrayRetorno['mensagem'] = "Não é possível excluir nessa data.<br /><small>
		//	Ja existe uma folha de frequência finalizada onde o aluno assistiu uma aula nessa data ou depois.</small>";
		//}else{
			if ($dataSaida > $dataAtual) {
                $IntegranteGrupo->setIdIntegranteGrupo($idIntegranteGrupo);
                $IntegranteGrupo->updateFieldIntegranteGrupo("dataSaida", $dataSaida);
                $IntegranteGrupo->updateFieldIntegranteGrupo("obs", $motivo);
                $IntegranteGrupo->updateFieldIntegranteGrupo("dataRetorno", $dataRetorno);
                $Log -> Log('Excluindo Integrante', 0, "IntegranteGrupo:".$idIntegranteGrupo." - Data:".$dataSaida,array("usuario"=>$_SESSION['usuario'],"idUsuario"=>$_SESSION['idUsuario']));
			} else {
	    		$arrayRetorno['mensagem'] = "Não é possível excluir nessa data.<br /><small>
    			Data de Saida Precisa ser maior que o mês atual : ".Uteis::exibirData($mesAtual);
			}
			
			//Não enviar PSA
			
			$rs = $PsaControle->selectPsaControle( "WHERE clientePf_idClientePf =".$idClientePf);
			
			foreach($rs as $valor) {
			$PsaControle->setIdPsaControle($valor['idPsaControle']);
			$PsaControle->updateFieldPsaControle("excluido",1);	
				
			}
			
		/*	if($manterRateamento && $dataSaidaDemonstrativo) */
            $IntegranteGrupo->updateFieldIntegranteGrupo("dataSaidaDemonstrativo", $dataSaidaDemonstrativo);
			$arrayRetorno['mensagem'] = MSG_CADDEL;;
			$arrayRetorno['fecharNivel'] = true;
        //}
		if ($inativar == 1) {
			$ClientePf->setIdClientePf($idClientePf);
			$ClientePf->updateFieldClientePf("inativo",1);
			$ClientePf->updateFieldClientePf("dataInativar", $dataSaida);
			$ClientePf->updateFieldClientePf("motivo", $motivo);
			$ClientePf->updateFieldClientePf("dataRetorno", $dataRetorno);	
			$ClientePf->updateFieldClientePf("area",$area);
			
		}
		
	}
	
	echo json_encode($arrayRetorno);
	
}elseif ($_REQUEST['acao']=="atualizarPsa"){
	$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
	$IntegranteGrupo->setIdIntegranteGrupo($idIntegranteGrupo);
	$psa = $_REQUEST['envioPSA'];
	$IntegranteGrupo->updateFieldIntegranteGrupo("envioPsa", $psa);	
	$arrayRetorno['mensagem'] = "Cadastro Atualizado com sucesso";
	$arrayRetorno['fecharNivel'] = true;
	
echo json_encode($arrayRetorno);	
	
}elseif ($_REQUEST['acao']=="atualizarObs") {
	$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
	$IntegranteGrupo->setIdIntegranteGrupo($idIntegranteGrupo);
	$obs = $_REQUEST['obs'];
	$IntegranteGrupo->updateFieldIntegranteGrupo("obs", $obs);	
	$arrayRetorno['mensagem'] = "Cadastro Atualizado com sucesso";
	$arrayRetorno['fecharNivel'] = true;

echo json_encode($arrayRetorno);
	
}elseif ($_REQUEST['acao']=="deletarF") {
//	$idIntegranteGrupo = $_REQUEST['id'];
	$IntegranteGrupo->setIdIntegranteGrupo($idIntegranteGrupo);
	$IntegranteGrupo->deleteIntegranteGrupo();

	$arrayRetorno['mensagem'] = "Aluno eliminado do grupo com sucesso";
	$arrayRetorno['fecharNivel'] = true;

echo json_encode($arrayRetorno);
	
	
	
}else{
	
	$idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];
	$dataEntrada = Uteis::gravarData($_POST['dataEntrada']);
	
	$valorPlanoAcaoGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
	$dataInicioEstagio = $valorPlanoAcaoGrupo[0]['dataInicioEstagio'];
	$psa = $_POST['envioPSA'];
	if($dataInicioEstagio > $dataEntrada){
		$dataEntrada = $dataInicioEstagio;
		$obs = "<br /><small> O aluno nao pode ser vinculado antes do inicio do estagio. O sistema registrou a data correta (".Uteis::exibirData($dataEntrada).").</small>";	
	}else $obs = "";
	
	//$IntegranteGrupo->setIdIntegranteGrupo();
	$IntegranteGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
    $IntegranteGrupo->setEnvioPsa($psa);
	$IntegranteGrupo->setClientePfIdClientePf($_POST['idClientePf']);
	$IntegranteGrupo->setDataEntrada($dataEntrada);
	$IntegranteGrupo->setProfessorIdProfessor($_POST['idProfessor']);
	$idIntegranteGrupo = $IntegranteGrupo->addIntegranteGrupo();
	
	//Ativa Cliente
	if ($_POST['idProfessor']) {
	$ClientePf->setIdClientePf($_POST['idClientePf']);
	$ClientePf->updateFieldClientepf("inativo", 0);
	
	//Controle PSA
	$rs = $PsaControle->selectPsaControle( "WHERE clientePf_idClientePf = " .$idClientePf." AND excluido != 1");
	
	if (!$rs) {
	$PsaControle->setClientePfIdClientePf($idClientePf);
	$PsaControle->setAtivo(1);
	$PsaControle->setTipoPsa(1);
	$PsaControle->setExcluido(0);
	$PsaControle->addPsaControle();
		
		}
	}
	
	
    //echo $idIntegranteGrupo;exit;
	$arrayRetorno['mensagem'] = "Cadastro efetuado com sucesso".$obs;
	$arrayRetorno['fecharNivel'] = true;
	
	echo json_encode($arrayRetorno);

}

?>