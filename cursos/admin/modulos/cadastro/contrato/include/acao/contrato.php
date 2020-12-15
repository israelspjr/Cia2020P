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
    $permitidos = array(".doc",".docx",".pdf", ".jpg");
    
    if($_REQUEST['idClientePf']!="")
        $pasta = CAMINHO_UP_ROOT."arquivo/contrato/clientePf/";
    
    if($_REQUEST['idClientePj']!="")
        $pasta = CAMINHO_UP_ROOT."arquivo/contrato/clientePj/";
    
    if($_REQUEST['idProfessor']!="")
        $pasta = CAMINHO_UP_ROOT."arquivo/contrato/professor/";
    
    if($_REQUEST['idGrupo']!="")
        $pasta = CAMINHO_UP_ROOT."arquivo/contrato/grupo/";
    
    if($_REQUEST['idFuncionario']!="")
        $pasta = CAMINHO_UP_ROOT."arquivo/contrato/funcionario/";
    
    if(isset($_POST)){
        $nome_imagem    = $_FILES['file']['name'];
        $tamanho_imagem = $_FILES['file']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
             
            if($tamanho < 10120){ //se imagem for até 10MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['file']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
				if(move_uploaded_file($tmp, $pasta.$nome_atual)){
                    
                    echo "<p><input type=\"text\" name=\"file_oculto_contrato\" id=\"file_oculto_contrato\" value=\"".$nome_atual."\" class\"required\" readonly=\"readonly\" ></p>"; //imprime a foto na tela
					
                }else{
                    echo "Falha ao enviar";					
                }
            }else{
                echo "O contrato deve ter no máximo 10MB";
            }
        }else{
            echo "Somente são aceitos arquivos do tipo PDF, DOCX, DOC";
        }
    }else{
        echo "Selecione um arquivo";
        exit;
    }
}else{
	
	$idContrato = $_REQUEST['id'];
	$idClientePF = $_REQUEST['idClientePf'];
	$idClientePJ = $_REQUEST['idClientePj'];
	$idGrupo = $_REQUEST['idGrupo'];
	$idProfessor = $_REQUEST['idProfessor'];
    $idFuncionario = $_REQUEST['idFuncionario'];
	$naoMostrar = $_POST['naoMostrar'] ? $_POST['naoMostrar'] : 0;

	$Contrato->setIdContrato($idContrato);
	$Contrato->setProfessorIdProfessor($idProfessor);
	$Contrato->setClientePfIdClientePf($idClientePF);
	$Contrato->setClientePjIdClientePj($idClientePJ);
	$Contrato->setGrupoIdGrupo($idGrupo);
	$Contrato->setContrato($_POST['file_oculto_contrato']);
	$Contrato->setObs($_POST['obs']);
	$Contrato->setNaoMostrar($_POST['naoMostrar']);
		
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