<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$status = $_POST["status"];
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$AulaGrupoProfessor = new AulaGrupoProfessor();
$grupo_pj = new GrupoClientePj();

if ($_POST["clientePj"]=="-") {

	$clientePj = "";
} else {

	$clientePj = $_POST["clientePj"];
}

if ($_POST["grupo"]=="-") {
	
	$grupo = "";
} else {
	
	$grupo = $_POST["grupo"];
}


/*switch ($status) {
    case 0:*/
          $where = "WHERE inativo = 0 ";
 /*       break;
  
  case 1:
      $where = "WHERE inativo = 1 ";
    break;
    
    default:
          $where = "WHERE 1 = 1 ";
        break;
}*/
$PAG = array();
if($clientePj!="" && $grupo==""){
  $gp = $grupo_pj->selectGrupoClientePj("WHERE clientePj_idClientePj = ".$clientePj);
  for($i=0;$i<count($gp);$i++):
    $idGrupo[$i] = $gp[$i]['grupo_idGrupo'];
  endfor;
  $idGrupos = implode(",", $idGrupo);
  $pa = $PlanoAcaoGrupo->selectPlanoAcaoGrupo("WHERE grupo_idGrupo in  (".$idGrupos.")"); 
  
  for($j=0;$j<count($pa);$j++):
    $PAG[$j] = $pa[$j]['idPlanoAcaoGrupo'];
  endfor; 
//Uteis::pr($PAG);echo "- 1";
}elseif($grupo!=""){
    $pa = $PlanoAcaoGrupo->selectPlanoAcaoGrupo("WHERE grupo_idGrupo in (".$grupo.")");  
  for($j=0;$j<count($pa);$j++):
    $PAG[$j] = $pa[$j]['idPlanoAcaoGrupo'];
  endfor; 
  
}else{
    $pa = $PlanoAcaoGrupo->selectPlanoAcaoGrupo("WHERE 1");  
    for($j=0;$j<count($pa);$j++):
        $PAG[$j] = $pa[$j]['idPlanoAcaoGrupo']; 
    endfor;
}
$pas = implode(",", $PAG);

$sql ="SELECT DISTINCT(P.idProfessor), P.nome AS nome FROM professor AS P
    INNER JOIN aulaGrupoProfessor AS AGP ON P.idProfessor = AGP.professor_idProfessor
    LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
    LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
    INNER JOIN planoAcaoGrupo AS PAG ON (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
    WHERE PAG.idPlanoAcaoGrupo in ($pas) order by nome ASC";
//	Uteis::pr($sql);
$rs = Uteis::executarQuery($sql);

foreach($rs as $valor):
    $html .=  "<option value='".$valor['idProfessor']."'>".$valor['nome']."</option>";
endforeach;

echo $html;