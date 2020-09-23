<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$TextoEmailPadrao = new TextoEmailPadrao();

$idTextoEmailPadrao = $_REQUEST['id'];

$arrayRetorno = array();

if ($_POST['acao'] == "deletar") {

	/*$TextoEmailPadrao -> setIdTextoEmailPadrao($idTextoEmailPadrao);
	$TextoEmailPadrao -> updateFieldTextoEmailPadrao("excluido", "1");

	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
	*/
	
} else {

	$idtextoEmailPadrao = $_POST['id'];
	$texto = $_POST['texto'];
	$titulo = $_POST['titulo'];
	$inativo = $_POST['inativo'];
	$candidato = $_POST['candidato'];

	
	$TextoEmailPadrao -> setTexto($texto);
	$TextoEmailPadrao -> setTitulo($titulo);
  $TextoEmailPadrao ->setExcluido($inativo);

	if ($idTextoEmailPadrao != "") {
	  $TextoEmailPadrao -> setIdtextoEmailPadrao($idTextoEmailPadrao);
		$rs = $TextoEmailPadrao -> updateTextoEmailPadrao();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	} else {
		$idTextoEmailPadrao = $TextoEmailPadrao -> addTextoEmailPadrao();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>