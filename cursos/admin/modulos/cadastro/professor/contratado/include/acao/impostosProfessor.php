<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Professor.class.php");
	
	$Professor = new Professor();

$idProfessor = $_POST['professor_idProfessor'];	
$arrTipoImpostoProfessor=  $_POST['tipoImpostoProfessor'];	


$sql1 = "DELETE FROM professorTipoImposto WHERE professor_idProfessor=" . $idProfessor;
		$rs = Uteis::executarQuery($sql1);

 foreach ($arrTipoImpostoProfessor as $valor) {

$dataInicio = $_POST['dataInicio_'.$valor.''];


$dataFim = $_POST['dataFim_'.$valor.''];
//echo $dataFim;

if ($dataInicio > 0) {
$dataInicio = $dataInicio;
} else {
	$dataInicio = "NULL";
}

if ($dataFim > 0) {
$dataFim = $dataFim;
} else {
	$dataFim = "NULL";
}

$Professor->gravaImpostoProfessor($idProfessor, $valor, $dataInicio, $dataFim);

 }

$arrayRetorno['mensagem'] = "Impostos atualzados com sucesso";
echo json_encode($arrayRetorno);
?>