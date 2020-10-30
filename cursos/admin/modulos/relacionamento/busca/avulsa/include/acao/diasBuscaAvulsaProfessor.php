<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DiasBuscaAvulsaProfessor = new DiasBuscaAvulsaProfessor();

$idProfessor= $_REQUEST['idProfessor'];
$idBuscaAvulsa= $_REQUEST['idBuscaAvulsa'];
$idDiasBuscaAvulsa= $_REQUEST['idDiasBuscaAvulsa'];
$idIdioma= $_REQUEST['idIdioma'];

$arrayRetorno = array();

if($idDiasBuscaAvulsa != "" && $idProfessor != ''){
		
	$DiasBuscaAvulsaProfessor->setDiasBuscaAvulsaIdDiasBuscaAvulsa($idDiasBuscaAvulsa);
	$DiasBuscaAvulsaProfessor->setProfessorIdProfessor($idProfessor);
	$DiasBuscaAvulsaProfessor->addDiasBuscaAvulsaProfessor();
	
	$arrayRetorno['mensagem'] = "Professor selecionado com sucesso..";
	
	//$arrayRetorno['ondeAtualizar']  = "#buscaProfessor";
	//$arrayRetorno['pagina']  = CAMINHO_REL."busca/avulsa/include/resourceHTML/retornoProfessor.php?idBuscaAvulsa=".$idBuscaAvulsa."&idDiasBuscaAvulsa=".$idDiasBuscaAvulsa."&idIdioma=".$idIdioma;
	$arrayRetorno['mudarAba'] = "#btBuscaAvulsa";
	
} 

echo json_encode($arrayRetorno);

?>