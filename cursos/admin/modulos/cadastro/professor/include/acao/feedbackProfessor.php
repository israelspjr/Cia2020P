<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FeedbackProfessor = new FeedbackProfessor();

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
	$arrayRetorno['mensagem'] = "Feedback professor deletado com sucesso";
	
	
	$idFeedbackProfessor = $_REQUEST['id'];
	$FeedbackProfessor->setIdFeedbackProfessor($idFeedbackProfessor);
	$FeedbackProfessor->deleteFeedbackProfessor();
	
}elseif($_POST['acao']=="file"){

	/* formatos de imagem permitidos */
    $permitidos = array(".doc",".docx",".pdf");
    $pasta = CAMINHO_UP_ROOT."arquivo/feedbackprofessor/";
	
    if(isset($_POST)){
        $nome_imagem    = $_FILES['file']['name'];
        $tamanho_imagem = $_FILES['file']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
             
            if($tamanho < 1024){ //se imagem for até 1MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['file']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
				if(move_uploaded_file($tmp, $pasta.$nome_atual)){
                   
                    echo "Arquivo Carregado!<input type=\"hidden\" name=\"file_oculto_feed\" id=\"file_oculto\" value=\"".$nome_atual."\">"; //imprime a foto na tela
					
                }else{
                    echo "Falha ao enviar";					
                }
            }else{
                echo "O contrato deve ter no máximo 2MB";
            }
        }else{
            echo "Somente são aceitos arquivos do tipo PDF, DOCX, DOC - ".$nome_imagem;
        }
    }else{
        echo "Selecione um arquivo";
        
    }
	exit;
	
}else{
	
	$idFeedbackProfessor = $_REQUEST['id'];
	$idProfessor = $_REQUEST['idProfessor'];
	
	$FeedbackProfessor->setIdFeedbackProfessor($idFeedbackProfessor);
	$FeedbackProfessor->setProfessorIdProfessor($idProfessor);
	$FeedbackProfessor->setAnexo($_POST['file_oculto_feed']);
	$FeedbackProfessor->setObs($_POST['obs']);
	$FeedbackProfessor->setDataAvaliada(Uteis::gravarData($_POST['dataAvaliada']));
	$FeedbackProfessor->setGrupoIdGrupo($_POST['idGrupo']);
	$FeedbackProfessor->setStatus($_POST['status']);
	$FeedbackProfessor->setStatus2($_POST['idNotasTipoNota']);
	$FeedbackProfessor->setQuemAssistiu($_POST['quemAssistiu']);
	$FeedbackProfessor->setPergunta1($_POST['pergunta1']);
	$FeedbackProfessor->setPergunta2($_POST['pergunta2']);
	$FeedbackProfessor->setPergunta3($_POST['pergunta3']);
	$FeedbackProfessor->setPergunta4($_POST['pergunta4']);			
	$FeedbackProfessor->setPergunta5($_POST['pergunta5']);
	$FeedbackProfessor->setPergunta6($_POST['pergunta6']);
	$FeedbackProfessor->setPergunta7($_POST['pergunta7']);
	$FeedbackProfessor->setPergunta8($_POST['pergunta8']);			
	$FeedbackProfessor->setPergunta9($_POST['pergunta9']);			
	$FeedbackProfessor->setPergunta10($_POST['pergunta10']);
	$FeedbackProfessor->setPergunta11($_POST['pergunta11']);
	$FeedbackProfessor->setPergunta12($_POST['pergunta12']);
	$FeedbackProfessor->setPergunta13($_POST['pergunta13']);			

	
	if($idFeedbackProfessor != "" && $idFeedbackProfessor > 0 ){
		$FeedbackProfessor->updateFeedbackProfessor();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		$arrayRetorno['fecharNivel'] = true;
	}else{
		$FeedbackProfessor = $FeedbackProfessor->addFeedbackProfessor();
		$arrayRetorno['mensagem'] = "Feedback professor efetuado com sucesso";
		$arrayRetorno['fecharNivel'] = true;
	}	
	
}

echo json_encode($arrayRetorno);

?>