<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$status = $_POST["status"];
$grupo_pj = new GrupoClientePj();
$grupo = new Grupo();
$gerenteTem = new GerenteTem();
$clientePj = $_POST["clientePj"];
$gerente = $_POST['gerente'];
$grupoClt = $_POST['grupoClt'];

if ($grupoClt != '') {
	if ($grupoClt != '-') {
		
		if ($grupoClt == 1) {
			$where .= " 
			INNER JOIN planoAcaoGrupo AS PAG on PAG.grupo_idGrupo = G.idGrupo
     		INNER JOIN valorHoraGrupo AS VHG on VHG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
          	WHERE VHG.valorHora IS NULL
                AND VHG.naoPagarProfessor = 0
                AND VHG.valorHoraProfessor = 0
                AND VHG.dataFim IS NULL
                AND PAG.inativo = 0";	
		} else {
			$where .= " 
			INNER JOIN planoAcaoGrupo AS PAG on PAG.grupo_idGrupo = G.idGrupo
     		INNER JOIN valorHoraGrupo AS VHG on VHG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
          	WHERE VHG.valorHora IS NOT NULL
               AND PAG.inativo = 0";	
			
		}
		
	} else {
$where .= " WHERE 1";	
	
}
} else {
$where .= " WHERE 1";	
	
}
switch ($status) {
    case 0:
          $where .= " AND G.inativo = 0 ";
        break;
  
  case 1:
      $where .= " AND G.inativo = 1 ";
    break;
    /*
    default:
          $where = " WHERE 1 = 1 ";
        break;
		*/
}



if(is_numeric($clientePj)){
  $gp = $grupo_pj->selectGrupoClientePj(" WHERE clientePj_idClientePj = ".$clientePj);
  for($i=0;$i<count($gp);$i++):
    $idGrupo[$i] = $gp[$i]['grupo_idGrupo'];
  endfor;
  $idGrupos = implode(",", $idGrupo);
 $where .= "AND idGrupo IN(".$idGrupos.")";
} else {
	if (($gerente != '') || ($gerente != '-')) {
	$sql = "SELECT SQL_CACHE
    GT.idGgerenteTem,
    GT.gerente_idGerente,
    GT.clientePj_idClientePj,
    GT.grupo_idGrupo,
    GT.dataCadastro,
    GT.dataExclusao
FROM
    gerenteTem AS GT
    INNER JOIN clientePj as CPF on CPF.idClientePj = GT.clientePj_idClientePj
    WHERE GT.gerente_idGerente = ".$gerente." AND GT.dataExclusao is null AND GT.grupo_idGrupo is null AND CPF.inativo = 0";
	$gpPJ = Uteis::executarQuery($sql);
	for($a=0;$a<count($gpPJ);$a++):
		$idPj[$a] = $gpPJ[$a]['clientePj_idClientePj'];
	endfor;	
	$idClientes = implode(",", $idPj);
	 $gp = $grupo_pj->selectGrupoClientePj(" WHERE clientePj_idClientePj in (".$idClientes.")");
  for($i=0;$i<count($gp);$i++):
    $idGrupo[$i] = $gp[$i]['grupo_idGrupo'];
  endfor;
  $idGrupos = implode(",", $idGrupo);
  if (count($idGrupos) > 0) {
 $where .= "AND G.idGrupo IN(".$idGrupos.")";
  }
	}
}
echo $where;
$where .= " GROUP BY G.nome ORDER BY G.nome ASC ";
$resp = $grupo->selectGrupo($where, " AS G");
for($i=0;$i<count($resp);$i++):
 $html .=  "<option value='".$resp[$i]['idGrupo']."'>".Uteis::resumir($resp[$i]['nome'])."</option>";
endfor;
echo $html;