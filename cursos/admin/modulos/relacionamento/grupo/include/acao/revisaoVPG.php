<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RevisaoVPG.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$RevisaoVPG = new RevisaoVPG();

$arrayRetorno = array();



if($_POST['acao']=="deletar"){
    
    $arrayRetorno['mensagem'] = MSG_CADDEL;;
    
    
    $idRevisaoVPG = $_REQUEST['id'];
    $RevisaoVPG->setIdRevisaoVPG($idRevisaoVPG);
    $RevisaoVPG->deleteRevisaoVPG();

    echo json_encode($arrayRetorno);
    
}elseif($_POST['acao']=="file"){
	/* formatos de imagem permitidos */
    $permitidos = array(".doc",".docx",".pdf");
    $pasta = CAMINHO_UP_ROOT."arquivo/revisaovpg/";
	
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
                    //mysql_query("INSERT INTO fotos (foto) VALUES (".$nome_atual.")");
                    echo "<p><input type=\"text\" name=\"file_oculto_anexo\" id=\"file_oculto_anexo\" value=\"".$nome_atual."\" class\"required\" readonly=\"readonly\" ></p>"; //imprime a foto na tela
					
                }else{
                    echo "Falha ao enviar";					
                }
            }else{
                echo "O contrato deve ter no máximo 2MB";
            }
        }else{
            echo "Somente são aceitos arquivos do tipo PDF, DOCX, DOC";
        }
    }else{
        echo "Selecione um arquivo";
        exit;
    }
}else{
    
    $idRevisaoVPG = $_REQUEST['id'];

    $RevisaoVPG->setIdRevisaoVPG($idRevisaoVPG);
	$RevisaoVPG->setAcompanhamentoCursoIdAcompanhamentoCurso($_POST['idAcompanhamentoCurso']);
	$RevisaoVPG->setAnexo($_POST['file_oculto_anexo']);
	$RevisaoVPG->setData(Uteis::gravarData($_POST['data']));
	$RevisaoVPG->setObs($_POST['obs']);
	
if($idRevisaoVPG != "" && $idRevisaoVPG > 0 ){
        $RevisaoVPG->updateRevisaoVPG();
        $arrayRetorno['mensagem'] = MSG_CADATU;
        $arrayRetorno['fecharNivel'] = true;
    }else{
        $idRevisaoVPG = $RevisaoVPG->addRevisaoVPG();
        $arrayRetorno['mensagem'] = MSG_CADNEW;
        $arrayRetorno['fecharNivel'] = true;
    }
    
    echo json_encode($arrayRetorno);
}
?>