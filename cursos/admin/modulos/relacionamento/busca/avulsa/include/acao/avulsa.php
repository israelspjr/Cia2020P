<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$BuscaAvulsa = new BuscaAvulsa();

$arrayRetorno = array();

if ($_REQUEST['idBuscaAvulsa'] > 0 ) {
	
$idBuscaAvulsa = $_REQUEST['idBuscaAvulsa'];

} else {
	
	$idBuscaAvulsa = $_REQUEST['id'];
}
//echo $idBuscaAvulsa;
$BuscaAvulsa->setIdBuscaAvulsa($idBuscaAvulsa);

if($_POST['acao']=="deletar"){
    
	
    $BuscaAvulsa->updateFieldBuscaAvulsa("excluida", 1);
    $arrayRetorno['mensagem'] = "Busca deletada com sucesso";
	
}else{

    $idClientePf = ($_POST['idClientePf']<>'')? $_POST['idClientePf'] : 0;
	$BuscaAvulsa->setObs($_POST['obs']);
	$BuscaAvulsa->setUrgente($_POST['urgente']);	
	$BuscaAvulsa->setPortalP($_POST['portalP']);
	$BuscaAvulsa->setDataApartir(Uteis::gravarData($_POST['dataApartir']));
    $BuscaAvulsa->setClientePjIdClientePj($_POST['clientePj_idClientePj']);
    $BuscaAvulsa->setAlunoObs($_POST['alunoobs']);
	$BuscaAvulsa->setIdiomaIdIdioma($_POST['idIdioma']);	
	$BuscaAvulsa->setEnderecoIdEndereco($_POST['idEndereco']);
	$BuscaAvulsa->setGrupoIdGrupo($_REQUEST['idGrupo']);
	$BuscaAvulsa->setGerenteIdGerente($_POST['idGerente']);
	$BuscaAvulsa->setValorHoraAluno($_POST['valorHoraAluno']);

	if( $idBuscaAvulsa > 0){
		$BuscaAvulsa->updateBuscaAvulsa();			
		$arrayRetorno['mensagem'] = "Busca avulsa atualizada com sucesso.";
		
	}else{
		
		$idBuscaAvulsa = $BuscaAvulsa->addBuscaAvulsa();		
		$arrayRetorno['mensagem'] = "Busca avulsa inserida com sucesso.
		<br /><small>Defina um endereço</small>";
	}
	
	$arrayRetorno['atualizarNivelAtual'] = true;
	$arrayRetorno['pagina'] =  CAMINHO_REL."busca/avulsa/include/form/avulsa.php?id=$idBuscaAvulsa";
}

echo json_encode($arrayRetorno);

?>