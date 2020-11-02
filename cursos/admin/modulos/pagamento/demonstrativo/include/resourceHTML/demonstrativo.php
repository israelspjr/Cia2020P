<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();

$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];
$tipo = 1; //$_REQUEST['tipo'];
$terceiro = $_REQUEST['terceiro'];
if ($terceiro == '') {
	$terceiro = 0;
}

$zerado = $_REQUEST['zerado'];
if ($zerado == '') {
	$zerado = 0;
}

$idProfessor = $_REQUEST['idProfessor'];

$caminhoAtualizar = CAMINHO_PAG."demonstrativo/include/resourceHTML/demonstrativo.php?mes=".$mes."&ano=".$ano."&tipo=".$tipo."&terceiro=".$terceiro;

if( isset($_REQUEST["tr"]) ){
	
	$arrayRetorno = array();
	
//	$idPlanoAcaoGrupo = $_REQUEST["idPlanoAcaoGrupo"];
	$ordem = $_REQUEST["ordem"];
//	echo $ordem;
	$idProfessor = $_REQUEST['idProfessor'];
	$caminhoAtualizar = CAMINHO_PAG."demonstrativo/include/resourceHTML/demonstrativo.php?mes=".$mes."&ano=".$ano."&tipo=".$tipo."&terceiro=".$terceiro."&ordem=".$ordem;

	$saida = $Professor->selectProfessorDemonstrativoTr($mes, $ano, "$caminhoAtualizar", "#lista_Demonstrativo", 1, $terceiro, $idProfessor, true, $zerado);
//	Uteis::pr($saida);
	
//	$saida = $BuscaProfessor->selectBuscaProfessorTrGrupo(" AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND B.tipoBusca_idTipoBusca = 5 ", $caminhoAtualizar, $ordem);
	
	$arrayRetorno["updateTr"] = $saida;
	$arrayRetorno["tabela"] = "#tb_lista_Demonstrativo";
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
}


?>

<table id="tb_lista_Demonstrativo" class="registros">
  <thead>
    <tr>
      <th>Professor</th>
      <th>Demonstrativo</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
  <?php
  	
	echo $Professor->selectProfessorDemonstrativoTr($mes, $ano, "$caminhoAtualizar", "#lista_Demonstrativo", 1, $terceiro, $idProfessor, false, $zerado);
  ?>
  </tbody>
  <tfoot>
    <tr>
      <th>Professor</th>
      <th>Demonstrativo</th>
      <th>Total</th>
    </tr>
  </tfoot>
</table>

<script>tabelaDataTable('tb_lista_Demonstrativo');</script> 