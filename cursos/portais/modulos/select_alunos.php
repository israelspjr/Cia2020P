<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
$status = $_POST["status"];
$grupo_pj = new GrupoClientePj();
$grupo = new Grupo();
$ClientePf = new ClientePf();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$IntegranteGrupo = new IntegranteGrupo();
$idGrupo = $_POST["idGrupo"];
$clientePj = $_POST["clientePj"];

if(is_numeric($clientePj)){
	$result = $ClientePf->selectClientePf(" WHERE clientePj_idClientePj = ".$clientePj." AND excluido = 0");
}
foreach ($result as $valor) {
	if ($valor['inativo'] == 0) {
		$ativo++;
	} else {
		$inativo++;	
	}
}
echo $ativo.",".$inativo;