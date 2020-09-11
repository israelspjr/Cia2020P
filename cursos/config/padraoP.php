<?php
error_reporting(0);
session_start();
ob_start();

ini_set("register_globals","Off");

mb_internal_encoding("UTF-8");

set_time_limit(0);
//CONFIGURA��O DE LOCALE
if (strpos($_SERVER["SERVER_SOFTWARE"], "Win32")) {
	define("LOCALE","ptb");
} else {
	define("LOCALE","pt_BR");
}
setlocale(LC_ALL, LOCALE);

define("VERSAO", "2.0");

//PASTAS PADR�O
define("CAMINHO_UP", "/cursos/upload/");
define("CAMINHO_UP_ROOT", $_SERVER['DOCUMENT_ROOT']."/cursos/upload/");

define("CAMINHO_IMG", "/cursos/images/");
define("CAMINHO_IMG2", "https://".$_SERVER['SERVER_NAME']."/cursos/images/");

define("CAMINHO_CFG", "/cursos/config/");	

define("CAMINHO_VER_PP", $_SERVER['SERVER_NAME']."/cursos/proposta/");
define("CAMINHO_VER_PA", $_SERVER['SERVER_NAME']."/cursos/planoAcao/");
define("CAMINHO_VER_DM", $_SERVER['SERVER_NAME']."/cursos/demonstrativo/");

define("MSG_CADNEW", "Cadastro efetuado com sucesso.");
define("MSG_CADATU", "Cadastro atualizado com sucesso.");
define("MSG_CADDEL", "Cadastro deletado com sucesso.");

require_once $_SERVER['DOCUMENT_ROOT']."/../_config.php";

//AUTOLOAD DE CLASSES
function __autoload($class) {
	
	$caminhoClass = $_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."class/".$class.".class.php";
		
	if( file_exists($caminhoClass) ){ 
		require_once $caminhoClass;
		return true; 
	}else{
		echo "Erro: Classe não encontrada $class";
		exit;
	}
		
}