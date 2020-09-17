<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
$arrayRetorno = array();

$Relatorio = new Relatorio();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$AcompanhamentoCurso = new AcompanhamentoCurso();

//$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];

$idGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo, true);

//Gerar Total com Debito e Credito
$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);

foreach($ids AS $valor) {
$valorX[] = $valor['idPlanoAcaoGrupo'];		
}

$valorx2 = implode(', ',$valorX);

$camposSelect = array("CONCAT(PA.mes, '/', PA.ano) AS periodo", "PR.nome AS nomeProfessor");

$idClientePf = $_SESSION['idClientePf_SS'];	

$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo in ( ".$valorx2.") order by idAcompanhamentoCurso";

$arrayRetorno['excel'] =$AcompanhamentoCurso->selectAcompanhamentoCursoTr_aluno($caminhoAbrir, $caminhoAtualizar, "", $where,1, $idClientePf, true);

echo json_encode($arrayRetorno);
?>
