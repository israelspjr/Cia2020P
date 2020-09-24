<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$VivenciaProfessor = new VivenciaProfessor();
$idProfessor = $_SESSION['idProfessor_SS'];
?>

<fieldset>
  <legend>Vivência no exterior</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Nova vivência" onclick="zerarCentro();carregarModulo('<?php echo "modulos/cadastro/vivenciaProfessorForm.php?idProfessor=$idProfessor"?>',  '#centro');" /> </div>
  <div class="lista">
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
        <?php echo $VivenciaProfessor->selectVivenciaProfessorTr("modulos/cadastro/", "modulos/cadastro/vivenciaProfessor.php?id=".$idProfessor, "#div_lista_vivenciaProfessor", " WHERE professor_idProfessor = ".$idProfessor, 1);?>
      </tbody>
      
    </table>
  </div>
</fieldset>
<script> //tabelaDataTable('tb_lista_vivenciaProfessor', 'simples');</script> 