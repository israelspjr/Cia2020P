<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$LocalAulaProfessor = new LocalAulaProfessor();	
$idProfessor = $_SESSION['idProfessor_SS'];
?>

<fieldset>
  <legend>Locais de aula do professor</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="zerarCentro();carregarModulo('<?php echo "modulos/cadastro/localAulaProfessorForm.php?idProfessor=$idProfessor"?>',  '#centro');" /> 
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
        <?php echo $LocalAulaProfessor->selectLocalAulaProfessorTr("modulos/cadastro/", "modulos/cadastro/localAulaProfessor.php?id=".$idProfessor, "#centro", " WHERE professor_idProfessor = ".$idProfessor,1); ?>
      </tbody>
     
    </table>
  </div>
</fieldset>
<script> //tabelaDataTable('tb_lista_localAulaProfessor','simples');</script> 
