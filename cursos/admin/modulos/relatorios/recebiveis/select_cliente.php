<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$status = $_POST["status"];
$cliente = new ClientePj(); 
$gerenteTem = new GerenteTem();
$gerente = $_POST["gerente"];
switch ($status) {
	case 0:
		  $where = "WHERE inativo = 0 ";
		break;
  
  case 1:
      $where = "WHERE inativo = 1 ";
    break;
	
	default:
		  $where = "WHERE 1 = 1 ";
		break;
}
if(is_numeric($gerente)){
    $gT = $gerenteTem->selectGerenteTem("WHERE dataExclusao is NULL AND grupo_idGrupo is null AND gerente_idGerente = ".$gerente);  
  for($i=0;$i<count($gT);$i++):
    $idcliente[$i] = $gT[$i]['clientePj_idClientePj'];
  endfor;
  $idclientes = implode(",", $idcliente);
  $where .= "AND idClientePj IN(".$idclientes.")";
}
$cliente = new ClientePj();
$where .= " order by razaoSocial ASC";  
$resp = $cliente->selectClientePj($where);
for($i=0;$i<count($resp);$i++):
 $html .=  "<option value='".$resp[$i]['idClientePj']."'>".Uteis::resumir($resp[$i]['razaoSocial'])."</option>";
endfor;
echo $html;