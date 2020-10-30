<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Contrato = new Contrato();

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
	$arrayRetorno['mensagem'] = MSG_CADDEL;;
	
	
	$idContrato = $_REQUEST['id'];
	$Contrato->setIdContrato($idContrato);
	$Contrato->deleteContrato();

	echo json_encode($arrayRetorno);
	
}elseif($_POST['acao']=="file"){
	/* formatos de imagem permitidos */
    $permitidos = array(".pdf",".doc",".docx", ".jpg");
    $pasta = CAMINHO_UP_ROOT."arquivo/contrato/clientePj/";
	
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
                    
                    echo "<a target=\"_blank\" href='".CAMINHO_UP."arquivo/contrato/clientePj/".$nome_atual."' />Contrato carregado</a><input type=\"hidden\" name=\"file_oculto\" value=\"".$nome_atual."\">"; //imprime a foto na tela
					
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
	
	$idContrato = $_REQUEST['id'];
	$idClientePF = $_REQUEST['idClientePf'];
	$idClientePJ = $_REQUEST['idClientePj'];
	$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
	$idProfessor = $_REQUEST['idProfessor'];
	$file_oculto = $_REQUEST['file_oculto'];

	$Contrato->setIdContrato($idContrato);
	$Contrato->setProfessorIdProfessor($idProfessor);
	$Contrato->setClientePfIdClientePf($idClientePF);
	$Contrato->setClientePjIdClientePj($idClientePJ);
	$Contrato->setPlanoAcaoGrupoIdPranoAcaoGrupo($idPlanoAcaoGrupo);
	$Contrato->setContrato($file_oculto);
	$Contrato->setObs($_POST['obs']);
	$Contrato->setPlanoAcaoIdPlanoAcao($_REQUEST['idPlanoAcao']);
		
	if($idContrato != "" && $idContrato > 0 ){
		$Contrato->updateContrato();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		$arrayRetorno['fecharNivel'] = true;
	}else{
		$idContrato = $Contrato->addContrato();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['fecharNivel'] = true;
	}
	
	echo json_encode($arrayRetorno);
}



?>