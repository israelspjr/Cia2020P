<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");


$CalendarioProva = new CalendarioProva();
$GerenteTem = new GerenteTem();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$Funcionario = new Funcionario();
$Grupo = new Grupo();

$arrayRetorno = array();

$mesAtual = date('m');
$anoAtual = date('Y');

$validacao = ($_REQUEST['validacao'] == "1") ? "1" : "0";
//echo $_REQUEST['validacao'];

if($_POST['acao']=="deletar"){

	
} else{

//if ($validacao == 1) {
	$dataValidacao = date("Y-m-d");
//}

	$idCalendarioProva = $_REQUEST['id'];
	$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
	
	$IdGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);
	$nomeGrupo = $Grupo->getNome($IdGrupo);
		
	$idGerente = $GerenteTem->selectGerenteTem_porGrupo($idPlanoAcaoGrupo);
//	echo $idGerente;
	
	$nome = $Funcionario->getNome($idGerente);
	$email = $Funcionario->getEmail($idGerente);

	$CalendarioProva->setIdCalendarioProva($idCalendarioProva);
		
//	$CalendarioProva->setDataPrevistaNova(Uteis::gravarData($_REQUEST['dataPrevistaNova']));	
//	$CalendarioProva->setDataAplicacao(Uteis::gravarData($_REQUEST['dataAplicacao']));	
//	$CalendarioProva->setObs($_REQUEST['obs']);
//	$CalendarioProva->setValidacao($dataValidacao);	

	if( $_REQUEST['dataAplicacao'] ) {
		
		   if (Uteis::verEmail($email)) {
			   
			   $assunto = "Prova Aplicada Grupo: ".$nomeGrupo ."";
			   $msg = "Data: ".$_POST['dataAplicacao']."";
			
		            $paraQuem = array("nome" => $nome, "email" => $email);
 //                   $paraQuem1 = array("nome" => "Site", "email" => "envio@companhiadeidiomas.com.br");
                    $rs = Uteis::enviarEmail($assunto, $msg, $paraQuem);
    //                $rs1 = Uteis::enviarEmail($assunto, $msg, $paraQuem1);   
	   
		   }
		
		$CalendarioProva->updateFieldCalendarioProva("dataAplicacao", $_REQUEST['dataAplicacao']);
		$CalendarioProva->updateFieldCalendarioProva("obs", $_REQUEST['obs']);
	
		$arrayRetorno['fecharNivel'] = true;
	}
	
	if (($_REQUEST['dataPrevistaNova']) && ($_REQUEST['obs'])) {
		
		if ($validacao == 1) {
		
		if (Uteis::verEmail($email)) {
			   
			   $assunto = "Nova data de prova prevista para o Grupo: ".$nomeGrupo ."";
			   $msg = "Nova data prevista: ".$_REQUEST['dataPrevistaNova'].".<br><br>Motivo:".$_REQUEST['obs']."";
			
		            $paraQuem = array("nome" => $nome, "email" => $email);
  //                  $paraQuem1 = array("nome" => "Site", "email" => "envio@companhiadeidiomas.com.br");
                    $rs = Uteis::enviarEmail($assunto, $msg, $paraQuem);
  //                  $rs1 = Uteis::enviarEmail($assunto, $msg, $paraQuem1);   
	   
		   }
   	$CalendarioProva->updateFieldCalendarioProva("dataPrevistaNova", $_REQUEST['dataPrevistaNova']);
	$CalendarioProva->updateFieldCalendarioProva("obs", $_REQUEST['obs']);
	//$CalendarioProva->updateFieldCalendarioProva("validacao", $dataValidacao);
	//$arrayRetorno['fecharNivel'] = true;
	$dataV = date("Y-m-d"); 
//	$CalendarioProva->updateFieldCalendarioProva("validacao", $dataV);
    	$arrayRetorno['mensagem'] = "Validação inserida com sucesso!";
		$arrayRetorno['fecharNivel'] = true;	
		} else {
		$arrayRetorno['mensagem'] = "É necessário validar a data de prova (agendada).";		

		}

		if (($_REQUEST['dataPrevistaNova'] != '') && ($_REQUEST['obs'] == '')) {
		
	$arrayRetorno['mensagem'] = "Mensagem de observação não inserida";	
		}
	}
	
		$CalendarioProva->updateFieldCalendarioProva("validacao", $dataValidacao);
		
		
	$codLiberacao = ($_REQUEST['codLiberacao']);
		
		if ($codLiberacao == '') {
		$codLiberacao = Uteis::criarCode();	
			
		}
		


	$CalendarioProva->updateFieldCalendarioProva("codLiberacao", $codLiberacao);	
		
//	$arrayRetorno['ondeAtualizar'] = "#div_ff_geral";
//	$arrayRetorno['pagina'] = "modulos/ff/form/folhaFrequencia.php?idFolhaFrequencia=".$idFolhaFrequencia;	
//	$arrayRetorno['fecharNivel'] = true;
	
	echo json_encode($arrayRetorno);
}


?>