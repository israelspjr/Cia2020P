<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcaoMedicaoResultado = new PlanoAcaoMedicaoResultado();


$idPlanoAcaoMedicaoResultado = $_REQUEST['id'];
$PlanoAcaoMedicaoResultado->setIdPlanoAcaoMedicaoResultado($idPlanoAcaoMedicaoResultado);

$arrayRetorno = array();

if($_REQUEST['acao'] == 'atualizarQuantidade'){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MedicaoResultadoINF.class.php"); 
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RelacionamentoINF.class.php"); 
	
	$MedicaoResultadoINF = new MedicaoResultadoINF(); 
	$RelacionamentoINF = new RelacionamentoINF(); 

	$idIdioma = $_REQUEST['idIdioma'];
	$idNivelEstudo = $_REQUEST['idNivelEstudo'];
	$idFocoCurso = $_REQUEST['idFocoCurso'];
	
	$where = " WHERE idioma_idIdioma IN ( $idIdioma ) AND nivelEstudo_IdNivelEstudo IN ( $idNivelEstudo ) AND focoCurso_idFocoCurso IN ( $idFocoCurso)";
	$idRelacionamentoINF = $RelacionamentoINF->selectRelacionamentoINF($where);	
	
	$idMedicaoResultado = $_REQUEST['idMedicaoResultado'] ? $_REQUEST['idMedicaoResultado'] : "0";
	
	$where = " WHERE relacionamentoINF_idRelacionamentoINF = ".$idRelacionamentoINF[0]['idRelacionamentoINF']. " AND medicaoResultado_idMedicaoResultado = ".$idMedicaoResultado;
	
	$qtdMedicaoResultadoINF = $MedicaoResultadoINF->selectMedicaoResultadoINF($where);
	echo $qtdMedicaoResultadoINF[0]['qtd'];
	
}else{
	
	if($_REQUEST['acao'] == 'deletar'){
	
		$PlanoAcaoMedicaoResultado->setIdPlanoAcaoMedicaoResultado($idPlanoAcaoMedicaoResultado);
		$PlanoAcaoMedicaoResultado->deletePlanoAcaoMedicaoResultado();
		$arrayRetorno['mensagem'] = MSG_CADDEL;
		
	}else{
	
		$PlanoAcaoMedicaoResultado->setPlanoAcaoIdPlanoAcao($_POST['planoAcao_idPlanoAcao']);
		$PlanoAcaoMedicaoResultado->setMedicaoResultadoIdMedicaoResultado($_POST['idMedicaoResultado']);	
		$PlanoAcaoMedicaoResultado->setQuantidade($_POST['quantidade']);	
		
		if($_POST['quantidade']<=0){
			
			$arrayRetorno['mensagem'] = "Quantidade deve ser maior que 0";
			
		}else{
		
			if($idPlanoAcaoMedicaoResultado != "" && $idPlanoAcaoMedicaoResultado > 0 ){
			
				$PlanoAcaoMedicaoResultado->updatePlanoAcaoMedicaoResultado();
				$arrayRetorno['mensagem'] = MSG_CADATU;
						
			}else{
						
				$idPlanoAcaoMedicaoResultado = $PlanoAcaoMedicaoResultado->addPlanoAcaoMedicaoResultado();
				$arrayRetorno['mensagem'] = MSG_CADNEW;
								
			}
				
			$arrayRetorno['fecharNivel'] = true;		
		}
	}
	
	echo json_encode($arrayRetorno);
}
?>