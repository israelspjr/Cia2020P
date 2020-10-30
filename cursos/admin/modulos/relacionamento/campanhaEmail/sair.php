<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/planoAcao.php");

$EmailsMkt = new EmailsMkt();

$email = $_REQUEST['email'];
$idSegmento = $_REQUEST['idsegmento'];

$rs = $EmailsMkt->selectEmailsMkt(" WHERE valor = '".$email."' AND segmento_idSegmento = ".$idSegmento);


if ($id > 0) {

$EmailsMkt->setIdEmailsMkt($rs[0]['idEmailsMkt']);
$EmailsMkt->updateFieldEmailsMkt("inativo", 1);


}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Email Mkt</title>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."include/css.php");
require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."include/js.php");


?>

</head>

<body class="body" > 
    <div id="centro">
	<div style="padding:50px;font-weight:bold;">Email excluido com sucesso!</div>
    </div>
</body>
</html>

