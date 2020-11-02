<?php
//pagina conteudo a pagina de gravação
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RelacionamentoINF.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$RelacionamentoINF = new RelacionamentoINF();
	
$idRelacionamentoINF = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
			
	$RelacionamentoINF->setIdRelacionamentoINF($idRelacionamentoINF);	
	$RelacionamentoINF->updateFieldRelacionamentoINF("excluido", "1");		
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$idioma_idIdioma = $_POST['idIdioma'];
	$nivelEstudo_IdNivelEstudo = $_POST['IdNivelEstudo'];
	$focoCurso_idFocoCurso = $_POST['idFocoCurso'];
	$cargaHoraria = Uteis::gravarHoras($_POST['cargaHoraria']);
		
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$tem = $RelacionamentoINF->selectRelacionamentoINF(" WHERE idioma_idIdioma = $idioma_idIdioma AND nivelEstudo_IdNivelEstudo = $nivelEstudo_IdNivelEstudo AND  focoCurso_idFocoCurso = $focoCurso_idFocoCurso AND excluido = 0");
	
	if (( $tem ) && ($idRelacionamentoINF == "" && $idRelacionamentoINF == 0)){
	
		$arrayRetorno['mensagem'] = "Vinculo já existe";
	
	}else{
		$RelacionamentoINF->setIdRelacionamentoINF($idRelacionamentoINF);
		$RelacionamentoINF->setIdiomaIdIdioma($idioma_idIdioma);
		$RelacionamentoINF->setNivelEstudoIdNivelEstudo($nivelEstudo_IdNivelEstudo);
		$RelacionamentoINF->setFocoCursoIdFocoCurso($focoCurso_idFocoCurso);
		$RelacionamentoINF->setCargaHoraria($cargaHoraria);
		$RelacionamentoINF->setInativo($inativo);
				
		if($idRelacionamentoINF != "" && $idRelacionamentoINF > 0 ){
			$RelacionamentoINF->updateRelacionamentoINF();
			$arrayRetorno['mensagem'] = MSG_CADATU;
		}else{
			$idRelacionamentoINF = $RelacionamentoINF->addRelacionamentoINF();
			$arrayRetorno['mensagem'] = MSG_CADNEW;
		}
		$arrayRetorno['fecharNivel'] = true;
	}
}

echo json_encode($arrayRetorno);
?>