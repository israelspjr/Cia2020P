<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idPlanoAcaoGrupo = $_GET['id'];

$caminhoAbrir = CAMINHO_REL."busca/vendas/include/form/disparoEmail.php";
$caminhoAtualizar = CAMINHO_REL."busca/vendas/include/resourceHTML/disparoEmail.php?id=$idPlanoAcaoGrupo";
$onde = "";
$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel()"></div>
  <?php 
	require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_MODULO."disparoEmail/resourceHTML.php"; ?>
</div>
