<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EtapaValidacaoBusca.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada.class.php");

$EtapaValidacaoBusca = new EtapaValidacaoBusca();
$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada = new EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada();

$arrayRetorno = array();

$idBuscaProfessor = $_REQUEST['idBuscaProfessor'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$idOpcaoBuscaProfessorSelecionada = $_REQUEST['idOpcaoBuscaProfessorSelecionada'];
$idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada = $_REQUEST['idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada'];

$caminhoAtualizar = $_REQUEST['caminhoAtualizar'];
$tipo = $_REQUEST['tipo'];
$dataApartir = $_REQUEST['dataApartir'];
 
$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada->setIdEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada($idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada);
$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada->updateFieldEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada("concluida", $_REQUEST['status']);

$arrayRetorno['mensagem'] = "Etapa alterada com sucesso";	

$arrayRetorno['elementoAtualizar'][0] = "#etapas_busca_".$idBuscaProfessor;

$html = $EtapaValidacaoBusca->selectEtapaValidacaoBusca_etapas($idOpcaoBuscaProfessorSelecionada, $idBuscaProfessor, $idPlanoAcaoGrupo, $caminhoAtualizar, $tipo, $dataApartir);;
$arrayRetorno['valor2'][0] = $html;
	
echo json_encode($arrayRetorno);

?>
