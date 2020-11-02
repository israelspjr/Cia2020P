<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idPlanoAcaoGrupo = $_GET['id'];
$mes = $_GET['mes'];
$ano = $_GET['ano'];

$caminhoAbrir = CAMINHO_COBRANCA."demonstrativo/include/form/disparoEmail.php";
$caminhoAtualizar = CAMINHO_COBRANCA."demonstrativo/include/resourceHTML/disparoEmail.php?id=$idPlanoAcaoGrupo&mes=$mes&ano=$ano";
$onde = "";
$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel()"></div>
  <?php 
	require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_MODULO."disparoEmail/resourceHTML.php"; 
	?>
</div>
