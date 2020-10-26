<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Contrato = new Contrato();
$Funcionario = new Funcionario();
$Aviso = new Aviso();

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
	$arrayRetorno['mensagem'] = MSG_CADDEL;;
	
	
	$idContrato = $_REQUEST['id'];
	$Contrato->setIdContrato($idContrato);
	$Contrato->deleteContrato();

	echo json_encode($arrayRetorno);
	
}elseif($_POST['acao']=="file"){
	/* formatos de imagem permitidos */
    $permitidos = array(".pdf",".doc",".docx", ".jpg", ".xls", ".xlsx");
    $pasta = CAMINHO_UP_ROOT."arquivo/contrato/funcionario/";
	
    if(isset($_POST)){
        $nome_file    = $_FILES['file']['name'];
        $tamanho_file = $_FILES['file']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_file,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_file / 1024);
             
            if($tamanho < 10024){ //se imagem for até 10MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['file']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
				if(move_uploaded_file($tmp, $pasta.$nome_atual)){
                    
                    echo "<a target=\"_blank\" href='".CAMINHO_UP."arquivo/contrato/funcionario/".$nome_atual."' />Contrato carregado</a><input type=\"hidden\" name=\"file_oculto\" value=\"".$nome_atual."\">"; //imprime a foto na tela
					
                }else{
                    echo "Falha ao enviar";					
                }
            }else{
                echo "O arquivo deve ser de no máximo 10MB";
            }
        }else{
            echo "Somente são aceitos arquivos do tipo PDF, DOC, DOCx e JPG";
        }
    }else{
        echo "Selecione um arquivo";
       
    }
	 exit;
    
	
}else{
//	Uteis::pr($_POST);
	$idContrato = $_REQUEST['id'];
	$idClientePF = $_REQUEST['idClientePf'];
	$idClientePJ = $_REQUEST['idClientePj'];
	$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
	$idProfessor = $_REQUEST['idProfessor'];
	$file_oculto = $_REQUEST['file_oculto'];
	$idPlanoAcao = $_REQUEST['idPlanoAcao'];
	$idFuncionario = $_REQUEST['idFuncionario'];
	
	$enviarEmail = ( $_POST['enviarEmail'] == "1" ? 1 : 0);
	
//	echo $idPlanoAcao;
	
	$Contrato->setIdContrato($idContrato);
	$Contrato->setProfessorIdProfessor($idProfessor);
	$Contrato->setClientePfIdClientePf($idClientePF);
	$Contrato->setClientePjIdClientePj($idClientePJ);
	$Contrato->setPlanoAcaoGrupoIdPranoAcaoGrupo($idPlanoAcaoGrupo);
	$Contrato->setContrato($file_oculto);
	$Contrato->setObs($_POST['obs']);
	$Contrato->setPlanoAcaoIdPlanoAcao($idPlanoAcao);
	$Contrato->SetFuncionarioIdFuncionario($idFuncionario);
	$assunto = $_POST['obs'];
	
	if ($enviarEmail == 1) {
	
	$nome = $Funcionario->getNome($idFuncionario);
	$email = $Funcionario->getEmail($idFuncionario);
	
	
	$msg = "Novo Documento disponivel no sistema Admin. Acesse a Aba documentos para visualizar.";
	$msg2 = "Ou clique neste";
	$msg2 .= "<button onclick=\"abrirNivelPagina(this, 'modulos/cadastro/funcionario/cadastro.php?id=".$idFuncionario."','','#centro')\">Link</button>";
	//.CAMINHO_CAD."funcionario/cadastro.php?id=".$idFuncionario."', "", "''")\">link</td> para acessar. ";
	
	$paraQuem1 = array("nome" => $nome, "email" => $email);
    $rs = Uteis::enviarEmail($assunto, $msg, $paraQuem1);
	
	}
	
	if($idContrato != "" && $idContrato > 0 ){
		$Contrato->updateContrato();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	//	$arrayRetorno['fecharNivel'] = true;
	}else{
		$idContrato = $Contrato->addContrato();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
//		$arrayRetorno['fecharNivel'] = true;
	}
	
	$Aviso->setIdAviso($idAviso);
	
	//QUEM ENVIA A MSG
	$Aviso->setFuncionarioIdFuncionarioEnviou($_SESSION['idFuncionario_SS']);
	
	//QUEM RECEBE A MSG
	$Aviso->setClientePfIdClientePf($idClientePf);
	$Aviso->setClientePjIdClientePj($idClientePj);
	$Aviso->setProfessorIdProfessor($idProfessor);
	$Aviso->setFuncionarioIdFuncionario($idFuncionario);
	
	//DADOS
	$msg = $msg . $msg2;
	$Aviso->setTituloAviso("Novo Aviso");
	$Aviso->setAviso($msg);
		
	$Aviso->addAviso();
	
	$arrayRetorno['mensagem'] = "Aviso enviado com sucesso";
	$arrayRetorno['fecharNivel'] = true;
	
	echo json_encode($arrayRetorno);
}



?>