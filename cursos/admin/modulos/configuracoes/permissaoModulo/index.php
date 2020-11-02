<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Funcionario.class.php");

$Funcionario = new Funcionario();
//FILTROS
$status =  $_POST['status'];
if( $status != '' ) $where .= "AND inativo = $status";
?>
  <div id="lista_funcionario" class="lista">
    <table id="tb_lista_funcionario" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Cargo</th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Funcionario->selectFuncionarioTr_permissao($where);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Cargo</th>
        </tr>
      </tfoot>
    </table>
  </div>
<script>
	tabelaDataTable('tb_lista_funcionario');
</script> 
