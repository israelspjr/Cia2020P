<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupoMaterialMontado.class.php");

$PlanoAcaoGrupoMaterialMontado = new PlanoAcaoGrupoMaterialMontado();

$idPlanoAcaoGrupo = $_GET['id'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Histórico de material montado/personalizado</legend>
    <div class="lista">
    <table id="tb_lista_PlanoAcaoGrupoMaterialMontado_HIST" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Inicio</th>
          <th>Fim</th>
        </tr>
      </thead>
      <tbody>
        <?php 
	$where = " AND PAG.idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;	
	echo $PlanoAcaoGrupoMaterialMontado->selectPlanoAcaoGrupoMaterialMontadoTr_historico($where);
	?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Inicio</th>
          <th>Fim</th>
        </tr>
      </tfoot>
    </table>
    </div>
  </fieldset>
</div>
<script>
tabelaDataTable('tb_lista_PlanoAcaoGrupoMaterialMontado_HIST', 'simples');
</script> 
