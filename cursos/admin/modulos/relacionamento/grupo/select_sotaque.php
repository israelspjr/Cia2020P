<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$idIdioma = $_POST["ididioma"];
$SotaqueIdiomaProfessor = new SotaqueIdiomaProfessor();




//$grupo_pj = new GrupoClientePj();
//$grupo = new Grupo();
//$clientePj = $_POST["clientePj"];
//switch ($status) {
 //   case 0:
 //         $where = "WHERE inativo = 0 ";
//        break;
/*  
  case 1:
      $where = "WHERE inativo = 1 ";
    break;
    
    default:
          $where = "WHERE 1 = 1 ";
        break;
}
if(is_numeric($clientePj)){
  $gp = $grupo_pj->selectGrupoClientePj("WHERE clientePj_idClientePj = ".$clientePj);
  for($i=0;$i<count($gp);$i++):
    $idGrupo[$i] = $gp[$i]['grupo_idGrupo'];
  endfor;
  $idGrupos = implode(",", $idGrupo);
 $where .= "AND idGrupo IN(".$idGrupos.")";
}
*/
$where .= " WHERE idioma_idIdioma = ".$idIdioma;
$resp = $SotaqueIdiomaProfessor->selectSotaqueIdiomaProfessor($where);
for($i=0;$i<count($resp);$i++):
 $html .=  "<option value='".$resp[$i]['idSotaqueIdiomaProfessor']."'>".Uteis::resumir($resp[$i]['valor'])."</option>";
endfor;



echo $html;