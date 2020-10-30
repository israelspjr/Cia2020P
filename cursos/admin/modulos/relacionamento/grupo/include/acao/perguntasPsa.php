<?php 

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RespostaPsaRegular.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RespostaPsaProfessor.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PsaIntegranteGrupo.class.php");	

$RespostaPsaProfessor = new RespostaPsaProfessor();
$RespostaPsaRegular = new RespostaPsaRegular();	
$PsaIntegranteGrupo = new PsaIntegranteGrupo();	
	
	
$acao = $_REQUEST['acao'];

$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
		
if($acao == "addProfessor"){
	
	$idPsaIntegranteGrupo = $_REQUEST['id'];
	$idPsaProfessor = $_REQUEST['idPsaProfessor'];
				
    $RespostaPsaProfessor->setPsaIntegranteGrupoIdPsaIntegranteGrupo($idPsaIntegranteGrupo);
	$RespostaPsaProfessor->setPsaProfessorIdPsaProfessor($idPsaProfessor);
    
	
	$RespostaPsaProfessor->addRespostaPsaProfessor();
	
	$arrayRetorno['mensagem'] = "Adicionado com sucesso.";
	
	$arrayRetorno['pagina'] = CAMINHO_REL."grupo/include/form/perguntasPsa.php?id=".$idPsaIntegranteGrupo."&idIntegranteGrupo=".$idIntegranteGrupo;	
	$arrayRetorno['atualizarNivelAtual'] = true;	
	
}elseif($acao == "finalizar"){
	
	$idPsaIntegranteGrupo = $_REQUEST['idPsaIntegranteGrupo'];	
	$PsaIntegranteGrupo->finalizarPSA($idPsaIntegranteGrupo);
	
	$arrayRetorno['mensagem'] = "Finalizado com sucesso.";
    
	$arrayRetorno['fecharNivel'] = true;	
	
}elseif($acao == "desfinalizar"){
    
    $idPsaIntegranteGrupo = $_REQUEST['idPsaIntegranteGrupo'];  
    $PsaIntegranteGrupo->desfinalizarPSA($idPsaIntegranteGrupo);
    
    $arrayRetorno['mensagem'] = "Desfinalizado com sucesso.";
    $arrayRetorno['fecharNivel'] = true;
    
}
echo json_encode($arrayRetorno);