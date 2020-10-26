<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProcessoSeletivoProfessorComEtapas.class.php");

	$ProcessoSeletivoProfessorComEtapas = new ProcessoSeletivoProfessorComEtapas();
	$idProcessoSeletivoProfessor = $_GET['id'];
?>

<fieldset>
  <legend>Etapas processo seletivo</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/include/form/processoSeletivoProfessorComEtapas.php?idProcessoSeletivoProfessor=".$idProcessoSeletivoProfessor?>', '<?php echo CAMINHO_CAD."professor/include/resourceHTML/processoSeletivoProfessorComEtapas.php?id=".$idProcessoSeletivoProfessor?>', '#div_lista_processoSeletivoProfessorComEtapas');" /> </div>
  <table id="tb_lista_processoSeletivoProfessorComEtapas" class="registros">
    <thead>
      <tr>
        <th></th>
        <th>Etapa</th>
        <th>Data de referência</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php echo $ProcessoSeletivoProfessorComEtapas->selectProcessoSeletivoProfessorComEtapasTr(CAMINHO_CAD."professor/include/form/processoSeletivoProfessorComEtapas.php", CAMINHO_CAD."professor/include/resourceHTML/processoSeletivoProfessorComEtapas.php?id=".$idProcessoSeletivoProfessor, "#div_lista_processoSeletivoProfessorComEtapas", " WHERE processoSeletivoProfessor_idProcessoSeletivoProfessor = ".$idProcessoSeletivoProfessor, "&idProcessoSeletivoProfessor=".$idProcessoSeletivoProfessor);?>
    </tbody>
    <tfoot>
      <tr>
        <th></th>
        <th>Etapa</th>
        <th>Data de referência</th>
        <th>Status</th>
        <th></th>
      </tr>
    </tfoot>
  </table>
</fieldset>
<script> tabelaDataTable('tb_lista_processoSeletivoProfessorComEtapas', 'ordenaColuna');</script>