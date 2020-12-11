<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Proposta = new Proposta();

//ATUALIZAR APENAS UMA LINHA
if( isset($_REQUEST["tr"]) ){
	
	$arrayRetorno = array();
	
	$idProposta = $_REQUEST["idProposta"];
	$ordem = $_REQUEST["ordem"];
	
	$saida = $Proposta->selectPropostaTr(" AND idProposta = $idProposta", true);
	
	$arrayRetorno["updateTr"] = $saida;
	$arrayRetorno["tabela"] = "#tb_lista_Proposta";
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
}

 //FILTROS
//$where = "WHERE 1=1 ";
$idProposta = $_POST['idProposta'];
if($idProposta!="")
$where .= " AND idProposta = ".$idProposta;

$dataCadastro = $_POST['dataCadastro'];
$dataCadastro2 = $_POST['dataCadastro2'];
if($dataCadastro && $dataCadastro2) $where .= " AND DATE(PP.dataCadastro) BETWEEN '".Uteis::gravarData($dataCadastro)."' AND '".Uteis::gravarData($dataCadastro2)."' ";

$dataAprovacao = $_POST['dataAprovacao'];
$dataAprovacao2 = $_POST['dataAprovacao2'];
if($dataAprovacao && $dataAprovacao2) $where .= " AND DATE(PP.dataAprovacao) BETWEEN '".Uteis::gravarData($dataAprovacao)."' AND '".Uteis::gravarData($dataAprovacao2)."' ";	

$idIdioma = implode(",",$_POST['idIdioma']);
if($idIdioma) $where .= " AND I.idIdioma IN(".$idIdioma.")";	

$clientePj_idClientePj = $_POST['clientePj_idClientePj'];
if($clientePj_idClientePj) $where .= " AND PJ.idClientePj = ".$clientePj_idClientePj;	

$idGestor = implode(",",$_POST['idGestor']);
if($idGestor) $where .= " AND G.idGestor IN(".$idGestor.")";	

$idStatusAprovacao = implode(",",$_POST['idStatusAprovacao']);
if($idStatusAprovacao) $where .= " AND PP.statusAprovacao_idStatusAprovacao IN(".$idStatusAprovacao.")";		

//echo $where;
?>

<div class="lista">
  <table id="tb_lista_Proposta" class="registros">
    <thead>
      <tr>
          <th></th>
        <th>Id Proposta</th>
        <th>PJ</th>
        <th>Idioma</th>
        <th>Integrantes</th>
        <th>Gestor</th>
        <th>Data de abertura</th>
        <th>Data de aprovação</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php echo $Proposta->selectPropostaTr($where);?>
    </tbody>
    <tfoot>
      <tr>
         <th></th>
        <th>Id Proposta</th>
        <th>PJ</th>
        <th>Idioma</th>
        <th>Integrantes</th>
        <th>Gestor</th>
        <th>Data de abertura</th>
        <th>Data de aprovação</th>
        <th>Status</th>
        <th></th>
      </tr>
    </tfoot>
  </table>
</div>

<script>
tabelaDataTable('tb_lista_Proposta', 'ordenaColuna');
eventDestacar(1);
</script> 
