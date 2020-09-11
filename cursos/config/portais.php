<?php
require_once "padrao.php";

define("CAMINHO_UNICO", "/cursos/portais/");
define("CAMINHO_MODULO", CAMINHO_UNICO . "modulos/");
define("CAMINHO_CONFIG", CAMINHO_MODULO . "configuracoes/");
define("CAMINHO_CAD", CAMINHO_MODULO . "cadastro/");
define("CAMINHO_GRUPO", CAMINHO_MODULO . "grupo/");
define("CAMINHO_PSA", CAMINHO_MODULO . "psa/");
define("CAMINHO_PAG", CAMINHO_MODULO . "demonstrativoPagamento/");
define("CAMINHO_BH", CAMINHO_MODULO . "bancoHoras/");
/*
$Login = new Login();
//echo "teste3";

if ($Login -> verificarLogin_Unico() /*&& $pgUnico*/ /*) {
	echo "teste";
   header('Location:/cursos/portais/index.php');
} elseif (!($Login -> verificarLogin_Unico()) && ($pgUnico == 1)) {
   echo "teste@";
   echo '<meta http-equiv="refresh" content="0;url=/cursos/">';
} 
?>