<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FormacaoPerfil = new FormacaoPerfil();

$idProfessor = $_REQUEST['id'];

?>



<fieldset>

  <legend>Formação escolar</legend>

  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."formacaoPerfil/include/form/formacaoPerfil.php?idProfessor=$idProfessor"?>', '<?php echo CAMINHO_CAD."professor/include/resourceHTML/formacaoPerfil.php?id=$idProfessor"?>', '#div_lista_formacaoPerfil');" /> </div>

  <table id="tb_lista_formacaoPerfil" class="registros">

    <thead>

      <tr>

        <th>Formação</th>

        <th>Curso</th>

        <th>Instituição</th>
     <th>obs</th>
          <th>Finalizado</th>
  
        <th></th>

      </tr>

    </thead>

    <tbody>

      <?php echo $FormacaoPerfil->selectFormacaoperfilTr(CAMINHO_CAD."formacaoPerfil/include/", CAMINHO_CAD."professor/include/resourceHTML/formacaoPerfil.php?id=".$idProfessor, "#div_lista_formacaoPerfil", " WHERE professor_idProfessor = ".$idProfessor);?>

    </tbody>

    <tfoot>

      <tr>

        <th>Formação</th>

        <th>Curso</th>

        <th>Instituição</th>
     <th>obs</th>
          <th>Finalizado</th>
  
        <th></th>

      </tr>

    </tfoot>

  </table>

</fieldset>

<script> tabelaDataTable('tb_lista_formacaoPerfil', 'simples');</script> 