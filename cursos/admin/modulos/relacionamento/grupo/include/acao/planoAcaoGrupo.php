<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$IntegranteGrupo = new IntegranteGrupo();
$PlanoAcao  = new PlanoAcao();
$Grupo = new Grupo();
$ClientePf = new ClientePf();

$arrayRetorno = array();

$dataInativado = $_REQUEST['inativado'];
$dataRetorno = $_REQUEST['dretorno'];
$motivo = $_REQUEST['motivo'];
$naoBancoHoras = $_REQUEST['naoBancoHoras'];
$dataInativacao = $_REQUEST['dataInativacao'];
//echo $dataInativacao;
$inativoAlunos = $_REQUEST['inativoAlunos'];
$dataInativacaoA = $_REQUEST['dataInativacaoA'];

$idClientePf = $_REQUEST['check_disparoEmail_integranteGrupo'];
//$tipoContrato = $_REQUEST['tipoContrato'];

if ($_POST['acao'] == "deletar") {

} elseif($_POST['acao'] == "liberarPA") {
	
	$idPlanoAcao = $_REQUEST['idPlanoAcao'];
	
//	$idPlanoAcao = $PlanoAcaoGrupo->getIdPlanoAcao($idPlanoAcaoGrupo);
	$PlanoAcao->setIdPlanoAcao($idPlanoAcao);
	$PlanoAcao->updateFieldPlanoAcao("statusAprovacao_idStatusAprovacao", 1);
	echo "<strong>Plano de Ação Liberado</strong>";

//	$arrayRetorno['mensagem'] = MSG_CADATU;
//	echo json_encode($arrayRetorno);
	
} else {
    

    $categorias = implode(",", $_POST['categoria']);
/*   for($i = 0;$i<count($categorias);$i++){
        if($i==0)
          $categoria = $categorias[$i];
        else*/
   //       $categoria = implode(",". $categorias[$i]);
		  
//		  echo $categorias;
  //  }
    
	$idPlanoAcaoGrupo = $_REQUEST['id'];

	$PlanoAcaoGrupo -> setIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$PlanoAcaoGrupo -> setDataPrevisaoTerminoEstagio(Uteis::gravarData($_POST['dataPrevisaoTerminoEstagio']));
	$PlanoAcaoGrupo -> setCategoria($categorias);
	$PlanoAcaoGrupo -> setDataInicioEstagio( Uteis::gravarData($_POST['dataInicioEstagio']));
    $PlanoAcaoGrupo -> setInativo($_POST['inativo']);
	$PlanoAcaoGrupo -> updatePlanoAcaoGrupo();

	$Grupo -> setIdGrupo($_POST['grupo_idGrupo']);
	$Grupo -> updateFieldGrupo("nome", $_POST['nomeGrupo']);
	$Grupo -> updateFieldGrupo("inativo", $_POST['inativoGrupo']);
	$Grupo -> updateFieldGrupo("naoBancoHoras", $naoBancoHoras);
	$Grupo -> updateFieldGrupo("dataInativado", Uteis::gravarData($dataInativacao));
	
	//PlanoAcao Tipo Contrato
	$idPlanoAcao = $PlanoAcaoGrupo->getIdPlanoAcao($idPlanoAcaoGrupo);
	$PlanoAcao->setIdPlanoAcao($idPlanoAcao);
//	$PlanoAcao->updateFieldPlanoAcao("tipoContrato", $tipoContrato);
	
	if ($inativoAlunos == 1) {
		foreach ($idClientePf AS $value) {
			$ClientePf->setIdClientePf($value);
			$ClientePf->updateFieldClientePf("inativo",1);
			$ClientePf->updateFieldClientePf("dataInativar",Uteis::gravarData($dataInativacaoA));
			$ClientePf->updateFieldClientePf("motivo",$motivo);
			$ClientePf->updateFieldClientePf("dataRetorno",Uteis::gravarData($dataRetorno));
			
			
//			echo $value;
			
		}
		
/*	foreach ($idIntegranteGrupo AS $indice => $value) {
		
		$IntegranteGrupo->setIdIntegranteGrupo($value);
//		$IntegranteGrupo->updateFieldIntegranteGrupo($idPlanoAcaoGrupo);
		$IntegranteGrupo->updateFieldIntegranteGrupo("dataSaida",Uteis::gravarData($dataInativacaoA));
		$IntegranteGrupo->updateFieldIntegranteGrupo("dataRetorno", Uteis::gravarData($dataRetorno));
		$IntegranteGrupo->updateFieldIntegranteGrupo("obs",$motivo);
//		$IntegranteGrupo->updateIntegranteGrupo();
		
		}*/
	}
	$arrayRetorno['mensagem'] = MSG_CADATU;
	$arrayRetorno['fecharNivel'] = true;

	echo json_encode($arrayRetorno);
}
?>