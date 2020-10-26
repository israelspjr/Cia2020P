<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoRegras.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Regras.class.php");
		
$arrayRetorno = array();

$idPlanoAcao = $_REQUEST['id'];	

$PlanoAcaoRegras = new PlanoAcaoRegras();		
$Regras = new Regras();

//DELETE TODAS OPÇOES ANTES DE INSERIR NOVAMENTE
$PlanoAcaoRegras->deletePlanoAcaoRegras(" OR ( planoAcao_idPlanoAcao = ".$idPlanoAcao.")");

$valoresRegras = $Regras->selectRegras(" WHERE inativo = 0 ");

for ($row = 0; $row < count($valoresRegras,0); $row++){
	$idField = $valoresRegras[$row]['idRegras'];		
	$field = $_POST["check_Regras_".$idField];
		
	// INSERE AS OPÇOES MARCADAS		
	if($field==1){
		$PlanoAcaoRegras->setRegrasIdRegras($idField);
		$PlanoAcaoRegras->setPlanoAcaoIdPlanoAcao($idPlanoAcao);	
		
		$PlanoAcaoRegras->addPlanoAcaoRegras();		
	}
}


$arrayRetorno['mensagem'] = MSG_CADNEW;
$arrayRetorno['pagina'] = CAMINHO_VENDAS."planoAcao/include/form/planoAcaoRegras.php?id=".$idPlanoAcao;
$arrayRetorno['ondeAtualizar'] = "#div_lista_planoAcaoRegras";

echo json_encode($arrayRetorno);	

?>
