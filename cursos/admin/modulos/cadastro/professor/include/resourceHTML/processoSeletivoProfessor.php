<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();
$idProfessor = $_GET['id'];
?>

<fieldset>
  <legend>Processo seletivo</legend>
  
  <div class="menu_interno"> 
  
  <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/include/form/processoSeletivoProfessor.php?idProfessor=".$idProfessor?>', '<?php echo CAMINHO_CAD."professor/include/resourceHTML/processoSeletivoProfessor.php?id=".$idProfessor?>', '#div_processoSeletivo_professor');" /> 
  
<!--  <img src="<?php echo CAMINHO_IMG."copy.png";?>" title="Contratar professor" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/include/form/contratar.php?idProfessor=".$idProfessor?>', '<?php echo CAMINHO_CAD."professor/include/resourceHTML/processoSeletivoProfessor.php?id=".$idProfessor?>', '#div_processoSeletivo_professor');" /> -->
  
  </div>
  <div class="lista">
    <table id="tb_lista_processoSeletivoProfessor" class="registros">
      <thead>
        <tr>
          <th>Idioma</th>
          <th>Nivel do idioma</th>
          <th>Data de referência</th>
          <th>Nota Teste</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $ProcessoSeletivoProfessor->selectProcessoSeletivoProfessorTr(CAMINHO_CAD."professor/include/form/processoSeletivoProfessor.php", CAMINHO_CAD."professor/include/resourceHTML/processoSeletivoProfessor.php?id=".$idProfessor, "#div_processoSeletivo_professor", "WHERE professor_idProfessor = ".$idProfessor);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Idioma</th>
          <th>Nivel do idioma</th>
          <th>Data de referência</th>
          <th>Nota Teste</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> 
tabelaDataTable('tb_lista_processoSeletivoProfessor', 'simples');
</script> 
