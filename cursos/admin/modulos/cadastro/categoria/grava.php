<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$idCategoria = $_REQUEST['id'];	
	
	$Categoria = new Categoria();	
//	$img = new Image();	
	$Categoria->setIdCategoria($idCategoria);
	
	if($_POST['acao'] == 'deletar'){
		
	//	$valorCategoria = $Categoria->selectCategoria(" WHERE idCategoria = ".$idCategoria);
		$Categoria->deleteCategoria();
		$arrayRetorno['mensagem'] = MSG_CADDEL;
				
	} 
 else{			
 
 $inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
// $correta = ( $_POST['correta'] == "1" ? 1 : 0);

	
		$Categoria->setValor($_POST['valor']);	
		$Categoria->setInativo($inativo);
		
		if($idCategoria != "" && $idCategoria > 0 ){
			$Categoria->updateCategoria();
			$arrayRetorno['mensagem'] = MSG_CADATU;			
		}else{
			$idCategoria = $Categoria->addCategoria();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;
		}				
		$arrayRetorno['fecharNivel'] = true;		
	}
			
	echo json_encode($arrayRetorno);
?>