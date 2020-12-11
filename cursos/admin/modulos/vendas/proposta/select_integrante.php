<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");
$ClientePf = new ClientePf();	
$proposta_idProposta = $_POST["idProposta"];
$and = "WHERE clientePj_idClientePj IN (SELECT clientePj_idClientePj FROM proposta WHERE idProposta =".$proposta_idProposta.") AND inativo = 0";			
$result = $ClientePf->selectClientepf($and);
for($i=0;$i<count($result);$i++):
 $html .=  "<option value='".$result[$i]['idClientePf']."'>".Uteis::resumir($result[$i]['nomeExibicao'])."</option>";
endfor;
echo $html;