<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$idSubCategoria = $_REQUEST['id'];	
	
	$SubCategoria = new SubCategoria();	
//	$img = new Image();	
	$SubCategoria->setIdSubCategoria($idSubCategoria);
	
	if($_POST['acao'] == 'deletar'){
		
	//	$valorSubCategoria = $SubCategoria->selectSubCategoria(" WHERE idSubCategoria = ".$idSubCategoria);
		$SubCategoria->deleteSubCategoria();
		$arrayRetorno['mensagem'] = MSG_CADDEL;
				
	} 
 else{			
 
 $inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
// $correta = ( $_POST['correta'] == "1" ? 1 : 0);

	
		$SubCategoria->setValor($_POST['valor']);	
		$SubCategoria->setInativo($inativo);
		$SubCategoria->SetCategoriaIdCategoria($_POST['idCategoria']);
		
		if($idSubCategoria != "" && $idSubCategoria > 0 ){
			$SubCategoria->updateSubCategoria();
			$arrayRetorno['mensagem'] = MSG_CADATU;			
		}else{
			$idSubCategoria = $SubCategoria->addSubCategoria();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;
		}				
		$arrayRetorno['fecharNivel'] = true;		
	}
			
	echo json_encode($arrayRetorno);
?>