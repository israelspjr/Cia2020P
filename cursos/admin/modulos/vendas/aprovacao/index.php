<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Aprovacao.class.php");

$Aprovacao = new Aprovacao();

if( isset($_REQUEST["tr"]) ){
	
	$arrayRetorno = array();
	
	$idProposta = $_REQUEST["idProposta"];
	$ordem = $_REQUEST["ordem"];
	
	$saida = $Aprovacao->selectAprovacaoTr(" AND idProposta = $idProposta", $ordem);
	
	$arrayRetorno["updateTr"] = $saida;
	$arrayRetorno["tabela"] = "#tb_lista_Aprovacao";
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
}

?>

<fieldset>
  <legend>Gerenciamento de aprovações</legend>
</fieldset>
<div class="lista">
  <table id="tb_lista_Aprovacao" class="registros">
    <thead>
      <tr>
        <th></th>
        <th>Proposta</th>
        <th>Representante</th>
        <th>Novo Plano de ação</th>        
        <th>Visitas</th>
        <th>Planos de ação</th>
        <th>Aprovação</th>
      </tr>
    </thead>
    <tbody>
      <?php echo $Aprovacao->selectAprovacaoTr();?>
    </tbody>
    <tfoot>
     <tr>
        <th></th>
        <th>Proposta</th>
        <th>Representante</th>
        <th>Novo Plano de ação</th>
        <th>Visitas</th>
        <th>Planos de ação</th>
        <th>Aprovação</th>
      </tr>
    </tfoot>
  </table>
</div>
<script>	
	eventDestacar(2);
	tabelaDataTable('tb_lista_Aprovacao', 'ordenaColuna');
</script> 
