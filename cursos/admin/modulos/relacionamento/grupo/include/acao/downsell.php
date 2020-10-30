<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Downsell = new Downsell();

$arrayRetorno = array();



if($_POST['acao']=="deletar"){
    
    $arrayRetorno['mensagem'] = MSG_CADDEL;;
    
    
    $idDownsell = $_REQUEST['id'];
    $Downsell->setIdDownsell($idDownsell);
    $Downsell->updateFieldDownsell('inativo',1);

    echo json_encode($arrayRetorno);
    
}else{
    
    $idDownsell = $_REQUEST['id'];

    $Downsell->setIdDownsell($idDownsell);
    $Downsell->setPlanoAcaoGrupo($_POST['idPlanoAcaoGrupo']);
    $Downsell->setTipo($_POST['tipo']);
    $Downsell->setDataInicio(Uteis::gravarData($_POST['dataInicio']));
    $Downsell->setDataTermino(Uteis::gravarData($_POST['dataTermino']));
    $Downsell->setDescricao($_POST['obs']);
    $Downsell->setInativo($_POST['inativo']);
	$Downsell->setUpselling($_POST['upselling']);
	$Downsell->setCargaAntiga(Uteis::gravarHoras($_POST['cargaAntiga']));
	$Downsell->setCargaNova(Uteis::gravarHoras($_POST['cargaNova']));
	
 
if($idDownsell != "" && $idDownsell > 0 ){
        $Downsell->updateDownsell();
        $arrayRetorno['mensagem'] = MSG_CADATU;
        $arrayRetorno['fecharNivel'] = true;
    }else{
        $idDownsell = $Downsell->addDownsell();
        $arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['fecharNivel'] = true;
	//	$arrayRetorno['pagina'] = CAMINHO_REL."grupo/include/resourceHTML/downsell.php?idPlanoAcaoGrupo=".$_POST['idPlanoAcaoGrupo'];
    //    $arrayRetorno['atualizarNivelAtual'] = true;
    }
    
    echo json_encode($arrayRetorno);
}
?>