<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$ClientePj = new ClientePj();

if (isset($_REQUEST["tr"])) {

	$arrayRetorno = array();

	$idClientePj = $_REQUEST["idClientePj"];
	$ordem = $_REQUEST["ordem"];	
    $saida = $ClientePj -> selectClientepjTr(" AND idClientePj = $idClientePj", true);
	$arrayRetorno["updateTr"] = $saida;
	$arrayRetorno["tabela"] = "#tb_lista_clientePj";
	$arrayRetorno["ordem"] = $ordem;

	echo json_encode($arrayRetorno);
	exit ;
}
$where = "";
//FILTROS
$status = implode(",", $_POST['status']);
if( $status != '' ) $where .= " AND inativo IN (".$status.")";

$tipoCliente_idTipoCliente = implode(",",$_POST['TipoCliente_idTipoCliente']);
if( $tipoCliente_idTipoCliente ) $where .= " AND tipoCliente_idTipoCliente IN(".$tipoCliente_idTipoCliente.")";	

$razaoSocial = $_POST['razaoSocial'];
if( $razaoSocial != '' ) $where .= " AND razaoSocial like '%".$razaoSocial."%'";
?>

<div id="div_lista_clientePj" class="lista">
	<table id="tb_lista_clientePj" class="registros">
		<thead>
			<tr>
				<th>Razão social</th>
				<th>CNPJ</th>
				<th>Ativo</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php echo $ClientePj -> selectClientepjTr($where); ?>
		</tbody>
		<tfoot>
			<tr>
				<th>Razão social</th>
				<th>CNPJ</th>
				<th>Ativo</th>
				<th></th>
			</tr>
		</tfoot>
	</table>
</div>
<script>tabelaDataTable('tb_lista_clientePj');</script>
