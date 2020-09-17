<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$RespostaPsaProfessor = new RespostaPsaProfessor();
$RespostaPsaRegular = new RespostaPsaRegular();
$PsaProfessor = new PsaProfessor();
$PsaRegular = new PsaRegular();
$PsaIntegranteGrupo = new PsaIntegranteGrupo();
$IntegranteGrupo = new IntegranteGrupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$PlanoAcao = new PlanoAcao();
$Proposta = new Proposta();
$GerenteTem = new GerenteTem();
$Funcionario = new Funcionario();
$Gerente = new Gerente();
$Grupo = new Grupo();
$NotasTipoNota = new NotasTipoNota();
$Professor = new Professor();

$arrayRetorno = array();

$idRespostaPsaProfessor = $_REQUEST['idRespostaPsaProfessor'];
$idRespostaPsaRegular = $_REQUEST['idRespostaPsaRegular'];

$obs = $_REQUEST['obs'];
$idProfessor = $_REQUEST['idProfessor'];
$idNotasTipoNota = $_REQUEST['idNotasTipoNota'];

if($idRespostaPsaProfessor != "" && $idRespostaPsaProfessor > 0){

	$obsMsg = "<br><small>".$Professor->getNome($idProfessor)."</small>";
	$nomeProfessor = $Professor->getNome($idProfessor);

	$RespostaPsaProfessor->setIdRespostaPsaProfessor($idRespostaPsaProfessor);
	$RespostaPsaProfessor->updateFieldRespostaPsaProfessor("professor_idProfessor", "$idProfessor");
	$RespostaPsaProfessor->updateFieldRespostaPsaProfessor("notasTipoNota_idNotasTipoNota", "$idNotasTipoNota");
	$RespostaPsaProfessor->updateFieldRespostaPsaProfessor("obs", "$obs");
	
	if (($idNotasTipoNota == 5) || ($idNotasTipoNota == 6) || ($idNotasTipoNota == 7)) {
		$valor = $RespostaPsaProfessor->selectRespostaPsaProfessor(" WHERE idRespostaPsaProfessor = ".$idRespostaPsaProfessor);
		$idPsaIntegranteGrupo = $valor[0]['psaIntegranteGrupo_idPsaIntegranteGrupo'];
		$titulo = $valor[0]['titulo'];
		$nomeNota = $NotasTipoNota->getNome($idNotasTipoNota);
		$valor2 = $PsaIntegranteGrupo->selectPsaIntegranteGrupo(" WHERE idPsaIntegranteGrupo = ".$idPsaIntegranteGrupo);
		$idIntegranteGrupo = $valor2[0]['integranteGrupo_idIntegranteGrupo'];
		$nomeAluno = $IntegranteGrupo->getNomePF($idIntegranteGrupo);
		$valor3 = $IntegranteGrupo->selectIntegranteGrupo(" WHERE idIntegranteGrupo =".$idIntegranteGrupo);
		$idPlanoAcaoGrupo = $valor3[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
		$valor4 = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo =".$idPlanoAcaoGrupo);
	    $nomeGrupo = $Grupo->getNome($valor4[0]['grupo_idGrupo']);
		$idPlanoAcao = $valor4[0]['planoAcao_idPlanoAcao'];
		$valor7 = $PlanoAcao->selectPlanoAcao(" WHERE idPlanoAcao =".$idPlanoAcao);
 	    $idProposta = $valor7[0]['proposta_idProposta'];
		$valor5 = $Proposta->selectProposta(" WHERE idProposta =".$idProposta);
		$idClientePj = $valor5[0]['clientePj_idClientePj'];
	    $valor6 = $GerenteTem->selectGerenteTem(" WHERE clientePj_idClientePj =".$idClientePj." AND dataExclusao is null");
		$idGerente = $valor6[0]['gerente_idGerente'];
		$valor7 = $Gerente->selectGerente(" WHERE idGerente = ".$idGerente);
		$idFuncionario = $valor7[0]['funcionario_idFuncionario'];

		$email = $Funcionario->getEmail($idFuncionario);
		$nome = $Funcionario->getNome($idFuncionario);

		$assunto = "Ahhhhhhhhh Tivemos um Professor avaliado com nota baixa ";
		$msg = "Professor:".$nomeProfessor."<br>
		Nota:  ".$nomeNota."    <br>
        Grupo: ".$nomeGrupo."<br>
		Aluno: ".$nomeAluno."<br>
		Obs.: ".$obs;
		
		if ($email) {

 			 $paraQuem = array("nome" => $nome, "email" => $email);			
			 $paraQuem1 = array("nome" => "Site", "email" => "envio@companhiadeidiomas.com.br");
			 $rs = Uteis::enviarEmail($assunto, $msg, $paraQuem); 
			 $rs1 = Uteis::enviarEmail($assunto, $msg, $paraQuem1);   
			}	
//		}
}
	
		
}elseif($idRespostaPsaRegular != "" && $idRespostaPsaRegular > 0){
	
	$obsMsg = "<br /><small>".$PsaRegular->getNome($_REQUEST['psaRegular_idPsa'])."</small>";
	
	$RespostaPsaRegular->setIdRespostaPsaRegular($idRespostaPsaRegular);
	$RespostaPsaRegular->updateFieldRespostaPsaRegular("notasTipoNota_idNotasTipoNota", "$idNotasTipoNota");
	$RespostaPsaRegular->updateFieldRespostaPsaRegular("obs", "$obs");
	
	if (($idNotasTipoNota == 5) || ($idNotasTipoNota == 6) || ($idNotasTipoNota == 7) || ($idNotasTipoNota == 8) || ($idNotasTipoNota == 9) || ($idNotasTipoNota == 10) || ($idNotasTipoNota == 11) || ($idNotasTipoNota == 12) || ($idNotasTipoNota == 13) || ($idNotasTipoNota == 18)) {
		$valor = $RespostaPsaRegular->selectRespostaPsaRegular(" WHERE idRespostaPsaRegular = ".$idRespostaPsaRegular);
		$idPsaIntegranteGrupo = $valor[0]['psaIntegranteGrupo_idPsaIntegranteGrupo'];
		$titulo = $valor[0]['titulo'];
		$nomeNota = $NotasTipoNota->getNome($idNotasTipoNota);
		$valor2 = $PsaIntegranteGrupo->selectPsaIntegranteGrupo(" WHERE idPsaIntegranteGrupo = ".$idPsaIntegranteGrupo);
		$idIntegranteGrupo = $valor2[0]['integranteGrupo_idIntegranteGrupo'];
		$nomeAluno = $IntegranteGrupo->getNomePF($idIntegranteGrupo);
		$valor3 = $IntegranteGrupo->selectIntegranteGrupo(" WHERE idIntegranteGrupo =".$idIntegranteGrupo);
		$idPlanoAcaoGrupo = $valor3[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
		$valor4 = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo =".$idPlanoAcaoGrupo);
	    $nomeGrupo = $Grupo->getNome($valor4[0]['grupo_idGrupo']);
		$idPlanoAcao = $valor4[0]['planoAcao_idPlanoAcao'];
		$valor7 = $PlanoAcao->selectPlanoAcao(" WHERE idPlanoAcao =".$idPlanoAcao);
 	    $idProposta = $valor7[0]['proposta_idProposta'];
		$valor5 = $Proposta->selectProposta(" WHERE idProposta =".$idProposta);
		$idClientePj = $valor5[0]['clientePj_idClientePj'];
	    $valor6 = $GerenteTem->selectGerenteTem(" WHERE clientePj_idClientePj =".$idClientePj." AND dataExclusao is null");
		$idGerente = $valor6[0]['gerente_idGerente'];
		$valor7 = $Gerente->selectGerente(" WHERE idGerente = ".$idGerente);
		$idFuncionario = $valor7[0]['funcionario_idFuncionario'];

$email = $Funcionario->getEmail($idFuncionario);
$nome = $Funcionario->getNome($idFuncionario);

$assunto = "Ahhhhhhhhh Tivemos uma nota baixa em ".$titulo;
$msg = "Nota:  ".$nomeNota."    <br>
        Grupo: ".$nomeGrupo."<br>
		Aluno: ".$nomeAluno."<br>
		Obs.: ".$obs;
		
		if ($email) {

 			 $paraQuem = array("nome" => $nome, "email" => $email);			
			 $paraQuem1 = array("nome" => "Site", "email" => "envio@companhiadeidiomas.com.br");
			 $rs = Uteis::enviarEmail($assunto, $msg, $paraQuem); 
			 $rs1 = Uteis::enviarEmail($assunto, $msg, $paraQuem1);   
		}
		
	}
}

$arrayRetorno['mensagem'] = "PSA atualizada com sucesso".$obsMsg;

echo json_encode($arrayRetorno);
?>

