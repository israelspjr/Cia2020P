<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Funcionario = new Funcionario();
$array = array(
                array('db' => 'Nome','dt' => 0),
                array('db' => 'Cargo','dt' => 1),
                array('db' => 'Ativo','dt' => 2),
                array('db' => 'Excluir','dt' => 3)              
    );  

//FILTROS
$status =  $_POST['status'];
if( $status != '' ) {
	$where .= " AND inativo = $status";
} else {
	$where .= " AND inativo = 0";
}
?>
<div class="menu_interno">
    <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."funcionario/cadastro.php";?>', '<?php echo CAMINHO_CAD."funcionario/filtros.php";?>', '#centro');" /> </div>
</div>
 <div id="lista_funcionario" class="lista">
    <table id="tb_lista_funcionario" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Cargo</th>
          <th>Ativo</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Funcionario->selectFuncionarioTr($where, $array);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Cargo</th>
          <th>Ativo</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>  
<script>
	tabelaDataTable('tb_lista_funcionario');
</script> 
