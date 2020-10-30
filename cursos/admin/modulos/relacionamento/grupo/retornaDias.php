<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$mes = $_POST['mes'];
$ano = $_POST['ano'];
$dia = $_POST['dia'];
$diasNoMes = Uteis::totalDiasMes($mes, $ano);
for($dias=1; $dias <= $diasNoMes; $dias++):
if($dia!="" && $dia==$dias){
    $val = "SELECTED"; 
}else{
   $val = ""; 
} 
 
$d = str_pad($dias, 2, '0', STR_PAD_LEFT);
$html .= "<option value=\"".$d."\"  $val >".$dias."</option>";
endfor;

echo $html;