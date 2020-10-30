<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$idPlanoAcaoGrupo = $_GET['id'];
?>

<div id="div_folhaFrequencia">
  <?php require_once "folhaFrequencia.php" ?>
    <div style="width: 100%;;overflow: hidden;">
        <a onclick="eventRolarParaTopo();" class="button gray" style="float: right; display: block;margin-right:40px">Topo</a>
    </div>
</div>
<div id="div_bancoHoras">
  <?php require_once "bancoHoras.php" ?>
    <div style="width: 100%;;overflow: hidden;">
        <a onclick="eventRolarParaTopo();" class="button gray" style="float: right; display: block;margin-right:40px">Topo</a>
    </div>
</div>
<div id="div_bancoHoras">
  <?php require_once "bancoHoras_lancamentos.php" ?>
    <div style="width: 100%;;overflow: hidden;">
        <a onclick="eventRolarParaTopo();" class="button gray" style="float: right; display: block;margin-right:40px">Topo</a>
    </div>
</div>