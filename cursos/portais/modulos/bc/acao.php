<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
	$idArquivos = $_REQUEST['id'];	
	
	$Comunica = new Comunica();		
	$Professor = new Professor();
	$Comunica->setIdArquivos($idArquivos);
	
	$Configuracoes = new Configuracoes();
	$config = $Configuracoes->selectConfig();
	
	$idProfessor = $_SESSION['idUsuario'];
	$nome = $Professor->getNome($idProfessor);
	
	if($_POST['acao'] == 'deletar'){
		
//		$valorArquivos = $Comunica->selectHabilidades(" WHERE idHabilidades = ".$idHabilidades);
//		$Comunica->deleteArquivos();
//		$arrayRetorno['mensagem'] = MSG_CADDEL;
				
	}else{			

	//	$Habilidades->setIdHabilidades($idHabilidades);
		$Comunica->setNomeArquivo($_POST['descricao']);
		$Comunica->setInativo(1); //$_POST['inativo']);	
		$Comunica->setLink($_POST['link']);
		$Comunica->setBc(1);
		$Comunica->setProfessor(1);
		$Comunica->setIdiomaIdIdioma($_POST['idIdioma']);	
		
		
		if($idArquivos != "" && $idArquivos > 0 ){
			$Comunica->updateArquivos();
			$arrayRetorno['mensagem'] = MSG_CADATU;	
//			$arrayRetorno['campoAtualizar'][0]="#idItemCalendarioProva".$idItenProva."_".$idIntegranteGrupo;		
		}else{
			$idArquivos = $Comunica->addArquivos();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;
		}				
			$msg .= "<div>Conteúdo: ".$_POST['descricao']."<br>Link: <a href=\"".$_POST['link']."\" target=\"_blank\">Clique aqui</a></div>";
		
		$assunto = "Atenção professor(a) $nome inseriu novo conteúdo no banco de conhecimento - Portal do professor";
		
					 $paraQuem = array("nome" => "Janaina", "email" => $config[0]['emailAten'] );
                     $rs = Uteis::enviarEmail($assunto, $msg, $paraQuem);
 	
		$arrayRetorno['fecharNivel'] = true;		
	}
			
	echo json_encode($arrayRetorno);
?>