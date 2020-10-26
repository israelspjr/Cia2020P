<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/LocalAulaProfessor.class.php");

$LocalAulaProfessor = new LocalAulaProfessor();	
$idProfessor = $_GET['id'];	
?>

<fieldset>
  <legend>Locais de aula do professor</legend>
  <div class="menu_interno"> 
  
  <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/include/form/localAulaProfessor.php?idProfessor=$idProfessor"?>', '<?php echo CAMINHO_CAD."professor/include/resourceHTML/localAulaProfessor.php?id=$idProfessor"?>', '#div_localAula_professor');" />
  
  </div>
  
  <div id="div_lista_localaulaprofessor" class="lista">
    <table id="tb_lista_localAulaProfessor" class="registros">
      <thead>
        <tr>
          <th>Pais</th>
          <th>Estado</th>
          <th>Cidade</th>
          <th>Zona</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $LocalAulaProfessor->selectLocalAulaProfessorTr(CAMINHO_CAD."professor/include/", CAMINHO_CAD."professor/include/resourceHTML/localAulaProfessor.php?id=".$idProfessor, "#div_localAula_professor", " WHERE professor_idProfessor = ".$idProfessor); ?>
      </tbody>
      <tfoot>
        <tr>
          <th>Pais</th>
          <th>Estado</th>
          <th>Cidade</th>
          <th>Zona</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_localAulaProfessor');</script> 
