<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$tipo = $_POST['tipoRel'];


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
          /*     AND PAG.inativo = 0*/";	
}

//$where = "where";
$mes = (int)$_REQUEST['mes'];
$ano = $_REQUEST['ano'];
if($mes && $ano) $where .= " AND D.ano = ".$ano." AND D.mes = ".$mes;


$clientePj_idClientePj = implode(",",$_REQUEST['clientePj_idClientePj']);
//if($clientePj_idClientePj != "-"){
if($clientePj_idClientePj) $where .= " AND CPJ.idClientePj in (".$clientePj_idClientePj.")";
//}

$idGrupo = $_REQUEST['grupo_idGrupo'];
if($idGrupo != "-"){
if($idGrupo) $where .= " AND G.idGrupo =".$idGrupo;	
}

$IdGerente = implode(",", $_POST['idGerente']);
if($IdGerente != "-"){
if($IdGerente!= "") $where .= " AND GER.gerente_idGerente in (".$IdGerente.")"; 
}
//echo $where;
?>
