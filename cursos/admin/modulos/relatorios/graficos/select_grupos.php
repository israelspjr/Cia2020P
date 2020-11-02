<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$grupo_pj = new GrupoClientePj();
$grupo = new Grupo();
$clientePj = $_POST["clientePj"];
$clientePj = implode(",", $clientePj);
$where = "WHERE inativo = 0 ";
        
if(isset($clientePj)){
  $gp = $grupo_pj->selectGrupoClientePj("WHERE clientePj_idClientePj in(".$clientePj.")");
  for($i=0;$i<count($gp);$i++):
    $idGrupo[$i] = $gp[$i]['grupo_idGrupo'];
  endfor;
  $idGrupo = implode(",", $idGrupo);
  $where .= "AND idGrupo IN(".$idGrupo.") order by nome ASC";
}
$cliente = new ClientePj(); 
$resp = $grupo->selectGrupo($where);
for($i=0;$i<count($resp);$i++):
 $html .=  "<option value='".$resp[$i]['idGrupo']."'>".Uteis::resumir($resp[$i]['nome'])."</option>";
endfor;
echo $html;