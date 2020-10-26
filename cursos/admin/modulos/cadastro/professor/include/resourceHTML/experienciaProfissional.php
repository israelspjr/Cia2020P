<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ExperienciaProfissional = new ExperienciaProfissional();

$idProfessor = $_REQUEST['id'];
?>

<fieldset>
  <legend>Experiência profissional</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/include/form/experienciaProfissional.php?idProfessor=$idProfessor"?>', '<?php echo CAMINHO_CAD."professor/include/resourceHTML/experienciaProfissional.php?id=$idProfessor"?>', '#div_lista_experienciaProfissional');" /> </div>
  <table id="tb_lista_experienciaProfissional" class="registros">
    <thead>
      <tr>
        <th>Empresa</th>
        <th>Função</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php echo $ExperienciaProfissional->selectExperienciaProfissionalTr(CAMINHO_CAD."professor/include/", CAMINHO_CAD."professor/resourceHTML/experienciaProfissional.php?id=".$idProfessor, "#div_lista_experienciaProfissional", " WHERE professor_idProfessor = ".$idProfessor);?>
    </tbody>
    <tfoot>
      <tr>
        <th>Empresa</th>
        <th>Função</th>
        <th></th>
      </tr>
    </tfoot>
  </table>
</fieldset>
<script> tabelaDataTable('tb_lista_experienciaProfissional', 'simples');</script> 
