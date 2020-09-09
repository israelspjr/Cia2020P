<?php

//PASTAS
require_once "padrao.php";

define("NOME_APP", "Administrativo");

define("CAMINHO_MODULO", "/cursos/admin/modulos/");
define("CAMINHO_CAD", CAMINHO_MODULO . "cadastro/");
define("CAMINHO_CONFIG", CAMINHO_MODULO . "configuracoes/");
define("CAMINHO_VENDAS", CAMINHO_MODULO . "vendas/");
define("CAMINHO_REL", CAMINHO_MODULO . "relacionamento/");
define("CAMINHO_COBRANCA", CAMINHO_MODULO . "cobranca/");
define("CAMINHO_PAG", CAMINHO_MODULO . "pagamento/");
define("CAMINHO_RELAT", CAMINHO_MODULO . "relatorios/");
define("CAMINHO_BIBLIOTECA", CAMINHO_MODULO . "biblioteca/");
define("CAMINHO_EVENTOS", CAMINHO_MODULO . "workshop/");
define("CAMINHO_PA", "/cursos/planoAcao/");
//Por Telefone
define("P_TELEFONE", 6013);

//Por Skype
define("P_SKYPE", 6014);

//Local Companhia de Idiomas
define("LOC_CIA", 6012);
header('Content-Type: text/html; charset=utf-8');
//require_once $_SERVER['DOCUMENT_ROOT']."/../_config.php";

$Login = new Login();

if ($Login -> verificarLogin() && $pgLogin) {
//    require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/css.php");
//    require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/js.php");
 //   header('Location:/cursos/admin/index.php');

} elseif (!($Login -> verificarLogin()) && !$pgLogin) {

//    header('Location:/cursos/admin/login.php');

}

