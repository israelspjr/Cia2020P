<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$TemaRedacao = new TemaRedacao();
	
	$idTemaRedacao = $_REQUEST['id'];	
	
//	$Questao = new Questao();	
//	$img = new Image();	
	$TemaRedacao->setIdTemaRedacao($idTemaRedacao);
	
	if($_POST['acao'] == 'deletar'){
		
	//	$valorQuestao = $Questao->selectQuestao(" WHERE idTemaRedacao = ".$idTemaRedacao);
		$TemaRedacao->deleteTemaRedacao();
		$arrayRetorno['mensagem'] = MSG_CADDEL;
				
	} //elseif($_POST['acao']=="foto"){
	/* formatos de imagem permitidos */
    /*$permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
    $pasta = CAMINHO_UP_ROOT."imagem/questoes/";
	
    if(isset($_POST)){
        $nome_imagem    = $_FILES['foto']['name'];
        $tamanho_imagem = $_FILES['foto']['size'];
         
        /* pega a extensão do arquivo */
    //    $ext = strtolower(strrchr($nome_imagem,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
      //  if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
        //    $tamanho = round($tamanho_imagem / 1024);
             
        //    if($tamanho < 10024){ //se imagem for até 10MB envia
          /*      $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['foto']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
			//					if(move_uploaded_file($tmp, $pasta.$nome_atual)){
								
									//Redimensiona novamente a imagem, mantendo a original.
				/*					$imgPointer = $img->prepareImage($pasta.$nome_atual);
									$img->prepareResize($imgPointer, 300, 350);
									$img->createThumbNail($imgPointer, $pasta."miniatura-".$nome_atual);
									
									$arrayRetorno['elementoAtualizar'][0] = $_POST['destino'];
									
									$arrayRetorno['valor2'][0] = "<img src='".CAMINHO_UP."imagem/questoes/miniatura-".$nome_atual."' />
									<input type=\"hidden\" name=\"foto_oculta\" value=\"".$nome_atual."\">"; 
									
									$arrayRetorno['mensagem'] = "Carregado com sucesso.";
								
                }else{
                    $arrayRetorno['mensagem'] = "Falha ao enviar";					
                }
            }else{
                $arrayRetorno['mensagem'] = "A imagem deve ser de no máximo 10MB";
            }
        }else{
            $arrayRetorno['mensagem'] = "Somente são aceitos arquivos do tipo Imagem";
        }
    }else{
        $arrayRetorno['mensagem'] = "Selecione uma imagem";
    }
	

} elseif($_POST['acao']=="audio"){
	/* formatos de imagem permitidos */
 /*   $permitidos = array(".mp3");
    $pasta = CAMINHO_UP_ROOT."imagem/questoes/";
	
    if(isset($_POST)){
        $nome_imagem    = $_FILES['audio']['name'];
        $tamanho_imagem = $_FILES['audio']['size'];
         
        /* pega a extensão do arquivo */
   //     $ext = strtolower(strrchr($nome_imagem,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
  //      if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
    //        $tamanho = round($tamanho_imagem / 1024);
             
    /*        if($tamanho < 10024){ //se imagem for até 10MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['audio']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
		//						if(move_uploaded_file($tmp, $pasta.$nome_atual)){
								
									//Redimensiona novamente a imagem, mantendo a original.
						//			$imgPointer = $img->prepareImage($pasta.$nome_atual);
						//			$img->prepareResize($imgPointer, 300, 350);
						//			$img->createThumbNail($imgPointer, $pasta."miniatura-".$nome_atual);
									
	/*								$arrayRetorno['elementoAtualizar'][0] = $_POST['destinoM'];
									
									$arrayRetorno['valor2'][0] = "<video controls autoplay name=\"media\"<source src='".CAMINHO_UP."imagem/questoes/".$nome_atual."' type=\"audio/mpeg\"/></video>
									<input type=\"hidden\" name=\"audio_oculta\" value=\"".$nome_atual."\">"; 
									
									$arrayRetorno['mensagem'] = "Carregado com sucesso.";
								
                }else{
                    $arrayRetorno['mensagem'] = "Falha ao enviar";					
                }
            }else{
                $arrayRetorno['mensagem'] = "A imagem deve ser de no máximo 10MB";
            }
        }else{
            $arrayRetorno['mensagem'] = "Somente são aceitos arquivos do tipo audio mp3";
        }
    }else{
        $arrayRetorno['mensagem'] = "Selecione um áudio mp3";
    }
	
*/
//} 
else{			
	
	$idNivel = $_POST['IdNivelEstudo'];
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);


	//	$Questao->setDescricao($_POST['descricao']);	
		$TemaRedacao->setInativo($inativo);
		$TemaRedacao->setTitulo($_POST['titulo']);
		$TemaRedacao->setTema($_POST['enunciado']);
		$TemaRedacao->setIdiomaIdIdioma($_POST['idIdioma']);
		$TemaRedacao->setNivelEstudoIdNivelEstudo($idNivel);
		
		if($idTemaRedacao != "" && $idTemaRedacao > 0 ){
			$TemaRedacao->updateTemaRedacao();
			$arrayRetorno['mensagem'] = MSG_CADATU;			
		}else{
			$idTemaRedacao = $TemaRedacao->addTemaRedacao();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;
		}				
		$arrayRetorno['atualizarNivelAtual'] = true;
  		$arrayRetorno['pagina'] = CAMINHO_CAD."temaRedacao/formulario.php?id=".$idTemaRedacao;
  		
	}
			
	echo json_encode($arrayRetorno);
?>