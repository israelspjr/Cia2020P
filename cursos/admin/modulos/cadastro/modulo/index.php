<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//error_reporting(E_ALL);
$Modulo = new Modulo();
//FILTROS
//$status =  $_POST['status'];
//if( $status != '' ) $where .= "AND inativo = 0 ";
$caminhoAbrir = CAMINHO_CAD."modulo/formulario.php";
$ondeAtualiza = "#centro";
$caminhoAtualizar = CAMINHO_CAD."modulo/index.php";

?>
<div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Novo Módulo" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."modulo/formulario.php".$param?>', '<?php echo CAMINHO_CAD."modulo/index.php"?>', '#centro')" /> </div>
  <div id="lista_funcionario" class="lista">
    <table id="tb_lista_funcionario" class="registros">
      <thead>
        <tr>
        <th>ID</th>
          <th>Módulo-pai</th>
          <th>Nome</th>
          <th>Link</th>
          <th>Ordem</th>
          <th>Admin</th>
          <th>Aluno</th>
          <th>Pré-Aluno</th>
          <th>Professor</th>
          <th>Candidato</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Modulo->selectModuloTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "");?>
      </tbody>
      <tfoot>
        <tr>
          <th>ID</th>
          <th>Módulo-pai</th>
          <th>Nome</th>
          <th>Link</th>
          <th>Ordem</th>
          <th>Admin</th>
          <th>Aluno</th>
          <th>Pré-Aluno</th>
          <th>Professor</th>
          <th>Candidato</th>
          <th>Status</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
<script>
	tabelaDataTable('tb_lista_funcionario');
</script> 
