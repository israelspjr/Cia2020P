<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");


$permissao = new PermProfessor();
if($_GET['idProfessor']=="") $idProfessor = $_GET['id']; else 	$idProfessor = $_GET['idProfessor'];

?>

<fieldset>
  <legend>Permissão de Cadastro de Aula Livre/Avulsa</legend>
  <div class="menu_interno"> 
  
  <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/contratado/include/form/PermissaoAula.php?idProfessor=$idProfessor"?>', '<?php echo CAMINHO_CAD."professor/contratado/include/resourceHTML/PermissaoAula.php?idProfessor=$idProfessor"?>', '#div_permissao_professor');" />
  
  </div>
  
  <div id="div_lista_permissao" class="lista">
    <table id="tb_lista_permissao" class="registros">
      <thead>
        <tr>
          <th>Nome do professor</th>
          <th>Nome do Grupo</th>
          <th>Permissão</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $permissao->selectPermTr(CAMINHO_CAD . "professor/contratado/include/", CAMINHO_CAD . "professor/contratado/include/resourceHTML/PermissaoAula.php?idProfessor=" . $idProfessor, "#div_permissao_professor", " AND p.professor_idProfessor = " . $idProfessor); ?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome do professor</th>
          <th>Nome do Grupo</th>
          <th>Permissão</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_permissao');</script> 
