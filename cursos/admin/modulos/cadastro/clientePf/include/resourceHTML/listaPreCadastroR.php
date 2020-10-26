<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PreClientePf = new PreClientePf();

$idFuncionario = $_REQUEST['idFuncionario'];
$idClientePj = $_REQUEST['clientePj_idClientePj'];
$naoR = $_REQUEST['naoR'];

$where = " WHERE 1";

if ($idFuncionario != '') {
	if ($idFuncionario != "-") {
		$where .= " AND funcionario_idFuncionario = ".$idFuncionario;
	}
}

if ($idClientePj != '') {
	if ($idClientePj != "-") {
		$where .= " AND clientePj_idClientePj = ".$idClientePj;
	}
}

if ($naoR != '') {
	if ($naoR != 2) {
		$where .= " AND jaRealizado = ".$naoR;
	}
}


?>

<fieldset>
<legend>Lista de pré cadastros</legend>
  <div class="menu_interno"> <!--<img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova mensagem" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."aviso/include/form/aviso.php?$param"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $onde?>')" /> --></div>
  <div class="lista">
    <table id="tb_lista_pre2" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>Funcionário responsável</th>
          <th>Data Cadastro</th>
          <th>Já realizado</th>
          <th>Empresa</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $PreClientePf->selectPreClientePfTr($where);?>
      </tbody>
      <tfoot>
       <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>Funcionário responsável</th>
          <th>Data Cadastro</th>
          <th>Já realizado</th>
          <th>Empresa</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
  
</fieldset>
</div>
</div>
</div>
<!--</div>-->
<script> 
tabelaDataTable('tb_lista_pre2');

</script> 
