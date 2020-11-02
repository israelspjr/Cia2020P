<?php
//A pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Chamados = new Chamados();
$Setor = new Setor();
$Funcionario = new Funcionario();
$FuncionarioSetor = new FuncionarioSetor();

   $idChamados = $_REQUEST['id'];
   $obs = $_POST['obs'];
//   echo $obs;
   $idSetor = $_POST['idSetor'];
   $idSetorC = $_REQUEST['idSetorC'];
   

$arrayRetorno = array();

	$idFuncionario = $_POST['idFuncionario'];
	$valorEmail = $Funcionario->getEmail($idFuncionario);
	$nome = $Funcionario->getNome($idFuncionario);
	$assunto = "Chamado nº".$idChamados." foi concluído!";
	
	
	$mensagem = "O técnico mudou o status deste chamado para";
	
	
	$mensagem3 .= "<br>Descrição da solicitação:<p>".$obs."</br>";
    
 
	$tipoUrgencia = $_POST['tipoUrgencia'];
	$dataSolucao = Uteis::gravarData($_POST['dataSolucao']);
//	$dataSolicitacao = Uteis::gravarData($_POST['dataSolicitacao']);
	$testado = $_POST['testado'];
	$finalizado = $_POST['finalizado'];
	$descartado = $_POST['descartado'];
	$sistema = $_POST['sistema'];
	
	$Chamados->setFuncionario_idFuncionario($idFuncionario);
	$Chamados->setSolicitacao($obs);
	$Chamados->setTipoUrgencia($tipoUrgencia);
	$Chamados->setSetorIdSetor($idSetorC);
	$Chamados->setDataSolucao($dataSolucao);
//	$Chamados->setDataSolicitacao($dataSolicitacao);
	$Chamados->setTestado($testado);
	$Chamados->setFinalizado($finalizado);
	$Chamados->setSistema($sistema);
	$Chamados->setDescartado($descartado);

	if($idChamados != "" && $idChamados > 0 ){
		$Chamados->setIdChamados($idChamados);
		$Chamados->updateChamados();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		
		if ($testado == 1) {
		
	//	Uteis::pr($paraQuem);
	
			$mensagem1 = " Testado ";
		} 
		
		if ($finalizado == 1) {
			
			$mensagem1 = " Finalizado ";
			
		}
		
		if ($descartado == 1) {
			
			$mensagem1 = " descartado ";
			$mensagem .= $mensagem1. " melhoria / bug não feito!";	
		} else {
			
			$mensagem .= $mensagem1 . " confirme a sua requisição e/ ou funcionamento <br>da melhoria / correção <br>".$mensagem3;
		}
	
			
// Avisar setor
		if ($idSetor != '') {
			foreach($idSetor as $valor2) {
			
				if ($valor2 == 'all') {
				
					$todosF = $Funcionario->selectFuncionario(" WHERE inativo = 0");
					foreach($todosF as $valor) {
						$valorEmail = $Funcionario->getEmail($valor['idFuncionario']);
						$nome = $Funcionario->getNome($valor['idFuncionario']);
						
						$paraQuem = array("nome" => $nome, "email" => $valorEmail);	
						$rs = Uteis::enviarEmail($assunto, $mensagem, $paraQuem, "");
				
					} 
				
				} else {
					
						$todosF = $FuncionarioSetor->selectFuncionarioSetor(" WHERE setor_idSetor = ".$valor2);
							foreach($todosF as $valor) {
						//		echo $valor;
								$valorEmail = $Funcionario->getEmail($valor['funcionario_idFuncionario']);
								$nome = $Funcionario->getNome($valor['funcionario_idFuncionario']);
						
								$paraQuem = array("nome" => $nome, "email" => $valorEmail);	
								$rs = Uteis::enviarEmail($assunto, $mensagem, $paraQuem, "");
						}
					}
						
			}
		} else {
	$paraQuem = array("nome" => $nome, "email" => $valorEmail);	
	$paraQuem2 = array("nome" => "Israel Junior", "email" => "israel@companhiadeidiomas.com.br");
	
	
		$rs = Uteis::enviarEmail($assunto, $mensagem, $paraQuem, "");
		
		$rs2 = Uteis::enviarEmail($assunto, $mensagem, $paraQuem2, "");
	
			
		}
		
	
		$arrayRetorno['fecharNivel'] = true;
	}else{
		$Chamados->addChamados();
		$assunto = "Novo chamado registrado no sistema ".$idChamados;
		
		$rs = Uteis::enviarEmail($assunto, $mensagem3, $paraQuem, "");
		$rs2 = Uteis::enviarEmail($assunto, $mensagem3, $paraQuem2, "");
		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['fecharNivel'] = true;
	}

echo json_encode($arrayRetorno);
?>