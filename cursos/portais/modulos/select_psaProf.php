<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
$grupo_pj = new GrupoClientePj();
$grupo = new Grupo();
$gerenteTem = new GerenteTem();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$Relatorio = new Relatorio();
//$clientePj = $_POST["clientePj"];
//$gerente = $_POST['gerente'];
$quantidade = $_POST['quantidade'];
$opcao = $_POST['x'];
//echo $opcao;
$status = $_POST["status"];
$idProfessor = $_POST['idProfessor'];
//$where = " WHERE inativo = 0 ";
if(is_numeric($idProfessor)){
	
//	if ($clientePj != '') {
//		$gerente .= " AND GCNPJ.clientePj_idClientePj =" .$clientePj;
//	} 	
	$dataAtual = date("Y-m-d");
	$where .= " AND DATE(PIG.dataReferencia) BETWEEN '2018-09-01' AND '".$dataAtual."' ";
//	echo $where;
	$result_total =  $Relatorio->relatorioPsaConsolidado($gerente, $where, $idProfessor);
//	Uteis::pr($result_total);
//	$result = array();
	foreach($result_total as $pergunta => $val) {
		
		if ($pergunta == $opcao) {
	
	foreach($val as $conceito => $respostas2) {
		
		if ($respostas2 > 0) {
		
	if ($conceito == 10) {
			$resultado[10] = $respostas2;
		} elseif ($conceito == 9) {
			$resultado[9] = $respostas2;
		} elseif ($conceito == 8) {
			$resultado[8] = $respostas2;
		} elseif ($conceito == 7) {
			$resultado[7] = $respostas2;
		} elseif ($conceito == 6) {
			$resultado[6] = $respostas2;
		} elseif ($conceito == 5) {
			$resultado[5] = $respostas2;
		} elseif ($conceito == 4) {
			$resultado[4] = $respostas2;
		} elseif ($conceito == 3) {
			$resultado[3] = $respostas2;
		} elseif ($conceito == 2) {
			$resultado[2] = $respostas2;
		} elseif ($conceito == 1) {
			$resultado[1] = $respostas2;
		} elseif ($conceito == 0) {
	//		$resultado[0] = $respostas2;
		}	
				}
			}
		}
	}

}
$html = "";
//Uteis::pr($resultado);
foreach ($resultado as $key => $value) {

//	if ($key != 'total') {
	$html .= $key.":".$value;
	$html .= ",";
//	}
	
}

echo $html;