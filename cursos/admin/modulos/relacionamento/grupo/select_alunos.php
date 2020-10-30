<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$status = $_POST["status"];
$grupo_pj = new GrupoClientePj();
$grupo = new Grupo();
$ClientePf = new ClientePf();
$clientePj = $_POST["clientePj"];
$clientePf = isset($_POST["clientePf"])? $_POST["clientePf"] : 0;

/*switch ($status) {
    case 0:
          $where = " WHERE inativo = 0 ";
        break;
  
  case 1:
      $where = " WHERE inativo = 1 ";
    break;
    
    default:
          $where = " WHERE 1 = 1 ";
        break;
}*/
if(is_numeric($clientePj)){
  $gp = $ClientePf->selectAlunosEmpresa(" = ".$clientePj, $clientePf);
/*  for($i=0;$i<count($gp);$i++):
    $idGrupo[$i] = $gp[$i]['grupo_idGrupo'];
  endfor;
  $idGrupos = implode(",", $idGrupo);
 $where .= "AND idGrupo IN(".$idGrupos.")";
}
$where .= " order by nome ASC";
$resp = $grupo->selectGrupo($where);
for($i=0;$i<count($resp);$i++):
 $html .=  "<option value='".$resp[$i]['idGrupo']."'>".Uteis::resumir($resp[$i]['nome'])."</option>";
endfor;*/
$html .= $gp;
}
echo $html;