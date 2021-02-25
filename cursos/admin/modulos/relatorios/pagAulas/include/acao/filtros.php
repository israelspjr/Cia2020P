<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
		
$mes = $_POST['mes'];
$ano = $_POST['ano'];

$mes1 = $_POST['mes1'];
$ano1 = $_POST['ano1'];

$compara = ( $_POST['compara'] == "1" ? 1 : 0);

// Não / Mostrando grupos CLT
$grupoClt = $_REQUEST['gclt'];
if ($grupoClt != '-') {

	if ($grupoClt == 1) {
			$where .= " 
     		INNER JOIN valorHoraGrupo AS VHG on VHG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
          	WHERE VHG.valorHora IS NULL
                AND VHG.naoPagarProfessor = 0
                AND VHG.valorHoraProfessor = 0
                AND VHG.dataFim IS NULL
                AND PAG.inativo = 0";	
		} else {
			$where .= " 
     		INNER JOIN valorHoraGrupo AS VHG on VHG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
          	WHERE VHG.valorHora IS NOT NULL
            /*   AND PAG.inativo = 0*/";	
			
		}	
	
} else {
		$where .= " 
     		INNER JOIN valorHoraGrupo AS VHG on VHG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
          	WHERE VHG.valorHora IS NOT NULL
            /*  AND PAG.inativo = 0*/";	
}



if($mes1 && $ano1) { 
//$periodo2 .= " AND  ((D.mes = $mes1 AND D.ano = $ano1) OR (D.mes = $mes AND D.ano = $ano))"; 
}


if($mes && $ano) { 
//$periodo1 .= " AND (D.mes = $mes AND D.ano = $ano) "; 
}

$idProfessor = implode(",",$_POST['idProfessor']);
if($idProfessor) $where .= " AND D.professor_idProfessor IN(".$idProfessor.")";	

$status = $_POST['statusG'];
if ($status != '') {
	if ($status != '-') {
	
	$where .= " AND G.inativo = ".$status;
		
	}
}


$idGerente = implode(",",$_POST['idGerente']);
if ($idGerente != '-') {
if($idGerente) $where .= " AND GT.gerente_idGerente IN(".$idGerente.") AND GT.dataExclusao is null";	
}

$idClientePj = implode(",", $_POST['clientePj_idClientePj']);
if ($idClientePj) {
	$where .= " AND GT.clientePj_idClientePj in (".$idClientePj.")";
}

$idGrupo = implode(",", $_POST['grupo_idGrupo']);
if ($idGrupo  != '') {
	if ($idGrupo  != '-') {
	
	$where .= " AND G.idGrupo in (".$idGrupo.")" ;
		
	}
}

if ($compara == 1) {
$where = $where . $periodo2;	
	
	
} else {

//$where2 = $where . $periodo2;
$where = $where . $periodo1;
}



//echo $where."<hr>";
//echo $where2;

?>
