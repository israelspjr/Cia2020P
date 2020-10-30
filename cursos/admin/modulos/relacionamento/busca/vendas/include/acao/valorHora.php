<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idBuscaProfessor = $_REQUEST['idBuscaProfessor'];
$idProfessor = $_REQUEST['idProfessor'];
//$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$valorHora = $_REQUEST['valorHora'];
//$aceito = $_REQUEST['aceito'];

//echo $aceito;
//echo $motivo;

$OpcaoBuscaProfessorSelecionada = new OpcaoBuscaProfessorSelecionada();

$op = $OpcaoBuscaProfessorSelecionada->selectOpcaoBuscaProfessorSelecionada("WHERE buscaProfessor_idBuscaProfessor=".$idBuscaProfessor." AND professor_idProfessor = ".$idProfessor);

$idOpcao = $op[0]['idOpcaoBuscaProfessorSelecionada'];

$OpcaoBuscaProfessorSelecionada->setIdOpcaoBuscaProfessorSelecionada($idOpcao);
$OpcaoBuscaProfessorSelecionada->updateFieldOpcaoBuscaProfessorSelecionada("valorHora", $valorHora);


//$OpcaoBuscaProfessorSelecionada->setAceito($aceito);
//$OpcaoBuscaProfessorSelecionada->setProfessorIdProfessor($idProfessor);
//$OpcaoBuscaProfessorSelecionada->setMotivo($motivo);
//$OpcaoBuscaProfessorSelecionada->setBuscaProfessorIdBuscaProfessor($idBuscaProfessor);

/*if ($aceito == 2) {
	$idOpcaoBuscaProfessorSelecionada = $OpcaoBuscaProfessorSelecionada->upAceito();
	
	} else {
	$idOpcaoBuscaProfessorSelecionada = $OpcaoBuscaProfessorSelecionada->upRejeito();
}
*/
$arrayRetorno['mensagem'] = "Novo valor hora adicionado para esta aula."; 
$arrayRetorno['fecharNivel'] = true;

echo json_encode($arrayRetorno);

?>