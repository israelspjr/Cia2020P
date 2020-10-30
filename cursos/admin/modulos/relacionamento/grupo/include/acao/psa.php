<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$PsaIntegranteGrupo = new PsaIntegranteGrupo();
$RespostaPsaProfessor = new RespostaPsaProfessor();
$RespostaPsaRegular = new RespostaPsaRegular();

$arrayRetorno = array();

if ($_POST['acao'] == "deletar") {

	$idPsaIntegranteGrupo = $_REQUEST['id'];  
  $PsaIntegranteGrupo -> setIdPsaIntegranteGrupo($idPsaIntegranteGrupo);
	$PsaIntegranteGrupo-> deletePsaIntegranteGrupo();

	$arrayRetorno['mensagem'] = MSG_CADDEL;
	//$arrayRetorno['mensagem'] = "Ferramenta em desenvolvimeto";

} elseif ($_POST['acao'] == "email") {

	$IntegranteGrupo = new IntegranteGrupo();
	$Aviso = new Aviso();
	$PlanoAcaoGrupo = new PlanoAcaoGrupo();
	$TextoEmailPadrao = new TextoEmailPadrao();
	$ClientePf = new ClientePf();

	$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
	$idClientePf = $IntegranteGrupo->getIdClientePf($idIntegranteGrupo);

	$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
	$nomeGrupo = $PlanoAcaoGrupo -> getNomeGrupo($idPlanoAcaoGrupo);

	//envio de email
	$assunto = "Nova pesquisa de satisfação disponível";
	
	  $sql2 = "WHERE tipoCliente_idTipoCliente = 3 AND inativo = 0 AND excluido = 0 AND idClientePf =" . $idClientePf;

                $rs2 = $ClientePf->selectClientepf($sql2);
//			var_dump($rs2);

                $senhaAcesso = $rs2[0]['senhaAcesso'];
                $ValorTipo = $rs2[0]['documentoUnico'];

                if ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 1) {

                    $tipo = "cpf";

                } elseif ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 2) {

                    $tipo = "RNE";

                } elseif ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 3) {

                    $tipo = "Passaporte";
                }


	$nome = $IntegranteGrupo -> getNomePF($idIntegranteGrupo);
 	$emails = $IntegranteGrupo -> getEmail($idIntegranteGrupo);
	
	//$paraQuem = array();
 
	/*foreach ($emails as $email)*/
	  $paraQuem = array("nome" => $nome,	"email" => $email);
	  $Copia = array("nome" => 'Companhia de Idiomas', "email" => 'envio@companhiadeidiomas.com.br');
	
	$mensagem = $TextoEmailPadrao -> getTexto("6");
	
	 $mensagem .= "Para acessar o portal do aluno <a href=http://" . $_SERVER['SERVER_NAME'] . "/cursos/mobile/aluno/login.php?responderPsa=1&ano=" . $ano . "&" . $tipo . "=" . $ValorTipo . "&password=" . EncryptSenha::B64_Decode($senhaAcesso) . ">clique aqui</a><p> A equipe Companhia de Idiomas agradece.</p>Atenciosamente,</p>";

	//ENVIO POR EMAIL
	
	Uteis::enviarEmail($assunto, $mensagem, $paraQuem, "", $Copia, "");
	
	$arrayRetorno['mensagem'] = "Aviso de PSA enviado com sucesso para o aluno.";

} else {

	$idPsaIntegranteGrupo = $_REQUEST['id'];
	$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];

	$PsaIntegranteGrupo -> setIdPsaIntegranteGrupo($idPsaIntegranteGrupo);
	$PsaIntegranteGrupo -> setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
	$PsaIntegranteGrupo -> setDataReferencia(Uteis::gravarData($_POST['dataReferencia']));

	$PsaIntegranteGrupo -> setObs($_POST['obs']);
	$PsaIntegranteGrupo -> setFinalizado($_POST['finalizado']);

	if ($idPsaIntegranteGrupo != "" && $idPsaIntegranteGrupo > 0) {

		$PsaIntegranteGrupo -> updatePsaIntegranteGrupo();
		$arrayRetorno['mensagem'] = "PSA atualizada com sucesso";
		$arrayRetorno['fecharNivel'] = true;

	} else {

		$check_PsaProfessor = $_POST['check_PsaProfessor'];
		$check_PsaRegular = $_POST['check_PsaRegular'];
        $nota = $_POST['nota'];    
		if ($check_PsaProfessor || $check_PsaRegular) {

			$idPsaIntegranteGrupo = $PsaIntegranteGrupo -> addPsaIntegranteGrupo();

			if ($check_PsaProfessor) {
				foreach ($check_PsaProfessor as $valor) {
					$RespostaPsaProfessor -> setPsaIntegranteGrupoIdPsaIntegranteGrupo($idPsaIntegranteGrupo);
					$RespostaPsaProfessor -> setPsaProfessorIdPsaProfessor($valor);
                    $RespostaPsaProfessor -> setNotasTipoNotaIdNotasTipoNota($nota[$valor]);
					$RespostaPsaProfessor -> addRespostaPsaProfessor();
				}
			}

			if ($check_PsaRegular) {
				foreach ($check_PsaRegular as $valor) {

					$RespostaPsaRegular -> setPsaIntegranteGrupoIdPsaIntegranteGrupo($idPsaIntegranteGrupo);
					$RespostaPsaRegular -> setPsaRegularIdPsa($valor);
                    $RespostaPsaRegular -> setNotasTipoNotaIdNotasTipoNota($nota[$valor]);
					$RespostaPsaRegular -> addRespostaPsaRegular();
				}
			}
			$arrayRetorno['mensagem'] = "PSA cadastrada com sucesso.";
			$arrayRetorno['fecharNivel'] = true;
		} else {
			$arrayRetorno['mensagem'] = "Nenhuma pergunta selecionada.";
		}

	}

}

echo json_encode($arrayRetorno);
?>