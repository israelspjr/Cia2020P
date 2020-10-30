<!DOCTYPE html>
<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/css.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/js.php");

$Configuracoes = new Configuracoes();

$config = $Configuracoes->selectConfig();

if($_SESSION['idFuncionario_SS']==""){
    session_destroy();
}
?>

<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo NOME_APP?></title>
<link rel="shortcut icon" href="../upload/imagem/empresa/<?php echo $config[0]['favIcon'];?>">
<script>
	verificaNovoAviso('/cursos/admin/verificaAviso.php');
</script>
</head>

<body class="body" >	

<div id="divs_jquery"> </div>
<div id="cssmenu">
  <?php require_once "menu.php"?>
</div>
<div id="alertas"></div>
<div id="centro"></div>
<!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
</body>
</html>