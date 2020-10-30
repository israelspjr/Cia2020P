<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");


$idPlanoAcaoGrupo = $_GET['idCampanhaEmail'];
$mes = $_GET['mes'];
$ano = $_GET['ano'];

$caminhoAbrir = CAMINHO_CAD."disparoEmail/form.php";
$caminhoAtualizar = CAMINHO_REL."campanhaEmail/disparoEmail.php?id=$idPlanoAcaoGrupo&mes=$mes&ano=$ano";
$onde = "";
$where = " WHERE campanhaEmail_idCampanhaEmail = ".$idPlanoAcaoGrupo;?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel()"></div>
  <?php 
	require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."disparoEmail/resourceHTML.php"; 
	?>
</div>
