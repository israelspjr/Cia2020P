<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
$status = $_POST["status"];
$grupo_pj = new GrupoClientePj();
$grupo = new Grupo();
$gerenteTem = new GerenteTem();
$clientePj = $_POST["clientePj"];
$gerente = $_POST['gerente'];
$quantidade = $_POST['quantidade'];
if ($quantidade != 1) {
switch ($status) {
    case 0:
          $where = " WHERE inativo = 0 ";
        break;
  
  case 1:
      $where = " WHERE inativo = 1 ";
    break;
    
    default:
          $where = " WHERE 1 = 1 ";
        break;
}
} else {
	      $where = " WHERE 1 = 1 ";
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
 $where .= "AND idGrupo IN(".$idGrupos.")";
  }
	}
}
//echo $where;
if ($quantidade != 1) {
$where .= " order by nome ASC";
} else {
	$where .= " ORDER BY inativo";
}
$resp = $grupo->selectGrupo($where);
$inativo = 0;
$ativo = 0;
for($i=0;$i<count($resp);$i++):
 $html .=  "<option value='".$resp[$i]['idGrupo']."'>".Uteis::resumir($resp[$i]['nome'])."</option>";
 if ($resp[$i]['inativo'] == 1) {
	$inativo++; 
 } else {
	$ativo++; 
 }
endfor;
if($quantidade != 1) {
echo $html;
} else {
	echo $ativo.",".$inativo;

}