<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$status = $_POST["status"];
$grupo_pj = new GrupoClientePj();
$grupo = new Grupo();
$gerenteTem = new GerenteTem();
$Professor = new Professor();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$clientePj = $_POST["clientePj"];
$gerente = $_POST['gerente'];

switch ($status) {
    case 0:
          $statusG = " WHERE inativo = 0 ";
        break;
  
  case 1:
      $statusG = " WHERE inativo = 1 ";
    break;
    
    case 2:
          $statusG = " WHERE 1 = 1 ";
        break;
}

if(is_numeric($clientePj)){
  $gp = $grupo_pj->selectGrupoClientePj(" WHERE clientePj_idClientePj = ".$clientePj);
  for($i=0;$i<count($gp);$i++):
    $idGrupo[$i] = $gp[$i]['grupo_idGrupo'];
  endfor;
  $idGrupos = implode(",", $idGrupo);
 $where .= $statusG. " AND idGrupo IN(".$idGrupos.")";
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
 $where .= $statusG." AND idGrupo IN(".$idGrupos.")";
  }
	}
}
//echo $where;
$where .=  " order by nome ASC";
$resp = $grupo->selectGrupo($where);
$arrayProf = array();
for($i=0;$i<count($resp);$i++) {
	
	$Pag = $PlanoAcaoGrupo->getPAG_total($resp[$i]['idGrupo']);
	$ids = "";
	foreach ($Pag as $valor) {
			$ids .= $valor['idPlanoAcaoGrupo'].",";	
	}
	$ids .= 0;

	$sql = " SELECT distinct(idProfessor), nome FROM professor WHERE
			 idProfessor IN(
			SELECT DISTINCT(AGP.professor_idProfessor)
			FROM aulaGrupoProfessor AS AGP
			LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa AND AF.excluido = 0
			LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
			INNER JOIN planoAcaoGrupo AS PAG ON
			PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo
			WHERE PAG.idPlanoAcaoGrupo in (".$ids. "))";
			
			//echo $sql;
			
			$rs = Uteis::executarQuery($sql);

	
	for($x=0;$x<count($rs);$x++) {
		$arrayProf[$rs[$x]['idProfessor']] = $rs[$x]['nome'];
//		
	}
	

}
foreach ($arrayProf as $key => &$val) {
	
	$html .= "<option value='".$key."'>".$val."</option>";
}

echo $html;
