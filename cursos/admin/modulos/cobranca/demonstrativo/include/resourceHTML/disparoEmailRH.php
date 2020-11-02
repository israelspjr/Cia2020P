<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idClientePj = $_GET['idClientePj'];

$mes = $_GET['mes'];
$ano = $_GET['ano'];

$caminhoAbrir = CAMINHO_COBRANCA."demonstrativo/include/form/disparoEmailRH.php";
$caminhoAtualizar = CAMINHO_COBRANCA."demonstrativo/include/resourceHTML/disparoEmailRH.php?idClientePj=$idClientePj&mes=$mes&ano=$ano";
$onde = "";
$where = " WHERE clientePJ_idClientePj = ".$idClientePj;?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel()"></div>
  <?php 
	require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_MODULO."disparoEmail/resourceHTML.php"; ?>
</div>
