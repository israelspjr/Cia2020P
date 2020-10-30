<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/VariedadeRecurso.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$VariedadeRecurso = new VariedadeRecurso();

$arrayRetorno = array();



if($_POST['acao']=="deletar"){
    
    $arrayRetorno['mensagem'] = MSG_CADDEL;;
    
    
    $idVariedadeRecurso = $_REQUEST['id'];
    $VariedadeRecurso->setIdVariedadeRecurso($idVariedadeRecurso);
    $VariedadeRecurso->deleteVariedadeRecurso();

    echo json_encode($arrayRetorno);
    
}else{
    
    $idVariedadeRecurso = $_REQUEST['id'];

    $VariedadeRecurso->setIdVariedadeRecurso($idVariedadeRecurso);
	$VariedadeRecurso->setAcompanhamentoCursoIdAcompanhamentoCurso($_POST['idAcompanhamentoCurso']);
	$VariedadeRecurso->setTipoVariedadeRecursoIdTipoVariedadeRecurso($_POST['idTipoVariedadeRecurso']);
	$VariedadeRecurso->setTitulo($_POST['titulo']);
	$VariedadeRecurso->setDataAplicacao(Uteis::gravarData($_POST['dataAplicacao']));
	$VariedadeRecurso->setObs($_POST['obs']);
	
	if($idVariedadeRecurso != "" && $idVariedadeRecurso > 0 ){
        $VariedadeRecurso->updateVariedadeRecurso();
        $arrayRetorno['mensagem'] = MSG_CADATU;
        $arrayRetorno['fecharNivel'] = true;
    }else{
        $idVariedadeRecurso = $VariedadeRecurso->addVariedadeRecurso();
        $arrayRetorno['mensagem'] = MSG_CADNEW;
        $arrayRetorno['fecharNivel'] = true;
    }
    
    echo json_encode($arrayRetorno);
}
?>