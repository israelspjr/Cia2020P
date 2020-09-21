<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Relatorio = new Relatorio();

$clientePj = $_POST["clientePj"];
$gerente = $_POST['gerente'];
$quantidade = $_POST['quantidade'];
$opcao = $_POST['x'];
$status = $_POST["status"];
$idProfessor = $_POST['idProfessor'];
//echo $idProfessor;
//Uteis::pr($_POST);
//$where = " WHERE inativo = 0 ";
if((is_numeric($clientePj)) || (is_numeric($idProfessor))){
	
	if ($clientePj != '') {
		$gerente .= " AND GCNPJ.clientePj_idClientePj =" .$clientePj;
	} 	
	$dataAtual = date("Y-m-d");
	$where .= " AND DATE(PIG.dataReferencia) BETWEEN '2018-09-01' AND '".$dataAtual."' ";
//	echo $where;
	$result_total =  $Relatorio->relatorioPsaConsolidado($gerente, $where, $idProfessor);

	foreach($result_total as $pergunta => $val) {
		
		if ($pergunta == $opcao) {
	
	foreach($val as $conceito => $respostas2) {
		
		if (is_array($respostas2)) {
		$resultado = $respostas2;
				}
			}
		}
	}

}
$html = "";
foreach ($resultado as $key => $value) {

	if ($key != 'total') {
	$html .= $key.":".$value;
	$html .= ",";
	}
	
}

echo $html;