<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/VivenciaProfessor.class.php");

$VivenciaProfessor = new VivenciaProfessor();
$idProfessor = $_GET['id'];
?>

<fieldset>
  <legend>Vivencia no exterior</legend>
  <div class="menu_interno"> 
  <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Nova vivência" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/include/form/vivenciaProfessor.php?idProfessor=$idProfessor"?>', '<?php echo CAMINHO_CAD."professor/include/resourceHTML/vivenciaProfessor.php?id=$idProfessor"?>', '#div_lista_vivenciaProfessor');" /> 
  </div>
  <table id="tb_lista_vivenciaProfessor" class="registros">
    <thead>
      <tr>
        <th>Pais</th>
        <th>Data de partida</th>
        <th>Data de retorno</th>
         <th>Atividade</th>
        <th>Obs</th>
           <th></th>
      </tr>
    </thead>
    <tbody>
      <?php echo $VivenciaProfessor->selectVivenciaProfessorTr(CAMINHO_CAD."professor/include/", CAMINHO_CAD."professor/include/resourceHTML/vivenciaProfessor.php?id=".$idProfessor, "#div_lista_vivenciaProfessor", " WHERE professor_idProfessor = ".$idProfessor);?>
    </tbody>
    <tfoot>
      <tr>
        <th>Pais</th>
        <th>Data de partida</th>
        <th>Data de retorno</th>
        <th>Atividade</th>
         <th>Obs</th>
     <th></th>
      </tr>
    </tfoot>
  </table>
</fieldset>
<script> tabelaDataTable('tb_lista_vivenciaProfessor', 'simples');</script> 