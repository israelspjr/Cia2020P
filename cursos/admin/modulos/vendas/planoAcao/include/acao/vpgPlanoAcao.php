<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/VpgPlanoAcao.class.php");

$VpgPlanoAcao = new VpgPlanoAcao();
$acao = $_REQUEST['acao'];
$idVpgPlanoAcao = $_REQUEST['id'];
$integrante = $_REQUEST['integrantePlanoAcao_idIntegrantePlanoAcao'];

if($_REQUEST['tipo_V']){
//$integrante = $_REQUEST['integrantePlanoAcao_idIntegrantePlanoAcao_V'];
$tipo = $_REQUEST['tipo_V'];
$valor = $_REQUEST['valor_V'];
$acao = $_REQUEST['acao_V'];
}
if($_REQUEST['tipo_P']){
//$idVpgPlanoAcao = $_REQUEST['id_P'];
//$integrante = $_REQUEST['integrantePlanoAcao_idIntegrantePlanoAcao_P'];
$tipo = $_REQUEST['tipo_P'];
$valor = $_REQUEST['valor_P'];
$acao = $_REQUEST['acao_P'];	
}
if($_REQUEST['tipo_G']){
//$idVpgPlanoAcao = $_REQUEST['id_G'];
//$integrante = $_REQUEST['integrantePlanoAcao_idIntegrantePlanoAcao_G'];
$tipo = $_REQUEST['tipo_G'];
$valor = $_REQUEST['valor_G'];
$acao = $_REQUEST['acao_G'];	
}

if($acao == 'deletar'){
	$idVpgPlanoAcao = $_REQUEST['id'];
	
	$VpgPlanoAcao->setIdVpgPlanoAcao($idVpgPlanoAcao);	
	$VpgPlanoAcao->deleteVpgPlanoAcao();
	$arrayRetorno['mensagem'] = "Excluído com sucesso";
	
}elseif($acao == 'editar'){
    
	$VpgPlanoAcao->setIdVpgPlanoAcao($idVpgPlanoAcao);
    $VpgPlanoAcao->setIntegrantePlanoAcaoIdIntegrantePlanoAcao($integrante);
    $VpgPlanoAcao->setValor($valor);
    $VpgPlanoAcao->setTipo($tipo);
    
    $VpgPlanoAcao->updateVpgPlanoAcao();
    
    $arrayRetorno['ondeAtualizar'] = '#listaVpg_'.$tipo;
//	$arrayRetorno['pagina'] = CAMINHO_VENDAS."planoAcao/include/resourceHTML/vpgPlanoAcao.php";//?tipo=".$tipo."&idIntegrantePlanoAcao=".$integrante;
	
	//ZERA TEXT DO FORM ONDE O VALOR FOI ISERIDO
	$arrayRetorno['valor'][0] = "";
	$arrayRetorno['campoAtualizar'][0] = "#form_".$tipo." #valor_".$tipo;
	$arrayRetorno['fecharNivel'] = true;
	
}else{
	
	 $linhas = split("\n", $valor);
  foreach($linhas as $linha)
  {
 
	$VpgPlanoAcao->setIntegrantePlanoAcaoIdIntegrantePlanoAcao($integrante);
	$VpgPlanoAcao->setValor($linha);
	$VpgPlanoAcao->setTipo($tipo);
	
	$VpgPlanoAcao->addVpgPlanoAcao();
	
  }
	 
    $arrayRetorno['ondeAtualizar'] = '#listaVpg_'.$tipo;
	$arrayRetorno['pagina'] = CAMINHO_VENDAS."planoAcao/include/resourceHTML/vpgPlanoAcao.php?tipo=".$tipo."&idIntegrantePlanoAcao=".$integrante;
	
	//ZERA TEXT DO FORM ONDE O VALOR FOI ISERIDO
	$arrayRetorno['valor'][0] = "";
	$arrayRetorno['campoAtualizar'][0] = "#form_".$tipo." #valor_".$tipo;	
}

echo json_encode($arrayRetorno);

?>