<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ClientePf = new ClientePf();

if( isset($_REQUEST["tr"]) ){
	
	$arrayRetorno = array();
	$idClientePf = $_REQUEST["idClientePf"];    
	$ordem = $_REQUEST["ordem"];	
	$saida = $ClientePf->selectClientepfTr(" AND idClientePf = $idClientePf", true, "");
	$arrayRetorno["updateTr"] = $saida;  
	$arrayRetorno["tabela"] = "#tb_lista_clientepf";
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
}
//FILTROS
$where = "";

$status = $_POST['status'];

if( $status != '' ) {
	if ($status != '-') {
	if ($status == 2) {
		$where .= " AND PF.excluido = 1";
	} else {
		$where .= " AND PF.excluido = 0 AND PF.inativo =".$status;
		}
	}
}


//$grupo1 = implode(",", $_POST['grupo1']);


$tipoCliente_idTipoCliente = implode(",",$_POST['TipoCliente_idTipoCliente']);
if( $tipoCliente_idTipoCliente ) $where .= " AND PF.tipoCliente_idTipoCliente IN(".$tipoCliente_idTipoCliente.")";

$nome = $_POST['nome'];
if( $nome != '' ):
   $where .= " AND PF.nome like '%".$nome."%'";
endif;    


$IdClientePj = $_POST['clientePj_idClientePj'];
if($IdClientePj != "-"){
if($IdClientePj!= "") $where .= " AND PF.clientePj_idClientePj = ".$IdClientePj; 
}


$grupo_idGrupo = $_POST['grupo_idGrupo'];
if($grupo_idGrupo != "-"){
if($grupo_idGrupo!= "") $idGrupo = $grupo_idGrupo; 
}


$pendentes = $_POST['pendentes'];
if ($pendentes == 'on') {
	$pendentes = 1;
}

$naoReceber = $_POST['naoReceberEmail'] ? $_POST['naoReceberEmail'] : 0;
if ($naoReceber == 1) {
$where .= " AND PF.naoReceberEmail = 0";	
	
}


?>
	<button class="button gray" onclick="postForm('', '<?php  echo CAMINHO_CAD."clientePf/include/acao/clientePfPdf.php?where=".$where."&grupo1=".$grupo1."&pendentes=".$pendentes."" ?>')">Exportar relatório</button></a>
  
  
<div id="lista_clientepf" class="lista">
  <table id="tb_lista_clientepf" class="registros">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Grupo</th>
        <th>Empresa</th>
        <th>Status</th>
        <th>Nivel Atual</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php echo $ClientePf->selectClientepfTr($where, false, $idGrupo,$pendentes);?>
    </tbody>
    <tfoot>
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Grupo</th>
        <th>Empresa</th>
        <th>Status</th>
        <th>Nivel Atual</th>
        <th></th>
      </tr>
    </tfoot>
  </table>
</div>

<script>
tabelaDataTable('tb_lista_clientepf','simples');
eventDestacar(1);
</script> 
