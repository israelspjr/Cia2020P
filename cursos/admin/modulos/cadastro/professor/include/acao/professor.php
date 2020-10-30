<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();

$img = new Image();

$arrayRetorno = array();

$idProfessor = $_REQUEST['id'];

if($_POST['acao']=="foto"){
	/* formatos de imagem permitidos */
    $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
    $pasta = CAMINHO_UP_ROOT."imagem/foto/professor/";
	
    if(isset($_POST)){
        $nome_imagem    = $_FILES['foto']['name'];
        $tamanho_imagem = $_FILES['foto']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
             
            if($tamanho < 5120){ //se imagem for até 1MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['foto']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
				if(move_uploaded_file($tmp, $pasta.$nome_atual)){
                   					
					//Redimensiona novamente a imagem, mantendo a original.
					$imgPointer = $img->prepareImage($pasta.$nome_atual);
					$img->prepareResize($imgPointer, 250, 200);
					$img->createThumbNail($imgPointer, $pasta."miniatura-".$nome_atual);
					
                    echo "<img src='".CAMINHO_UP."imagem/foto/professor/miniatura-".$nome_atual."' /><input type=\"hidden\" name=\"foto_oculta\" value=\"".$nome_atual."\">"; //imprime a foto na tela
					
                }else{
                    echo "Falha ao enviar";					
                }
            }else{
                echo "A imagem deve ser de no máximo 5MB";
            }
        }else{
            echo "Somente são aceitos arquivos do tipo Imagem";
        }
    }else{
        echo "Selecione uma imagem";
        
    }
	exit;
		
}elseif($_POST['acao']=="file"){
	/* formatos de imagem permitidos */
    $permitidos = array(".pdf",".doc",".docx");
    $pasta = CAMINHO_UP_ROOT."arquivo/curriculo/professor/";
	
    if(isset($_POST)){
        $nome_file    = $_FILES['file']['name'];
        $tamanho_file = $_FILES['file']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_file,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_file / 5120);
             
            if($tamanho < 1024){ //se imagem for até 1MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['file']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
				if(move_uploaded_file($tmp, $pasta.$nome_atual)){
                    
                    echo "<a target=\"_blank\" href='".CAMINHO_UP."arquivo/curriculo/professor/".$nome_atual."' />Curriculo carregado</a><input type=\"hidden\" name=\"file_oculto\" value=\"".$nome_atual."\">"; //imprime a foto na tela
					
                }else{
                    echo "Falha ao enviar";					
                }
            }else{
                echo "O arquivo deve ser de no máximo 5MB";
            }
        }else{
            echo "Somente são aceitos arquivos do tipo PDF E DOC";
        }
    }else{
        echo "Selecione um arquivo";
       
    }
	 exit;

}elseif($_POST['acao']=="rg"){
	/* formatos de imagem permitidos */
    $permitidos = array(".pdf",".doc",".docx", ".bmp", ".jpg", ".png");
    $pasta = CAMINHO_UP_ROOT."arquivo/curriculo/professor/";
	
    if(isset($_POST)){
        $nome_file    = $_FILES['file']['name'];
        $tamanho_file = $_FILES['file']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_file,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_file / 5120);
             
            if($tamanho < 1024){ //se imagem for até 1MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['file']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
				if(move_uploaded_file($tmp, $pasta.$nome_atual)){
                    
                    echo "<a target=\"_blank\" href='".CAMINHO_UP."arquivo/curriculo/professor/".$nome_atual."' />RG / CPF/ RNE carregado com sucesso!</a><input type=\"hidden\" name=\"rgC_oculto\" value=\"".$nome_atual."\">"; //imprime a foto na tela
					
                }else{
                    echo "Falha ao enviar";					
                }
            }else{
                echo "O arquivo deve ser de no máximo 5MB";
            }
        }else{
            echo "Somente são aceitos arquivos do tipo PDF E DOC";
        }
    }else{
        echo "Selecione um arquivo";
       
    }
	 exit;

}elseif($_POST['acao']=="comprovante"){
	/* formatos de imagem permitidos */
    $permitidos = array(".pdf",".doc",".docx", ".bmp", ".jpg", ".png");
    $pasta = CAMINHO_UP_ROOT."arquivo/curriculo/professor/";
	
    if(isset($_POST)){
        $nome_file    = $_FILES['file']['name'];
        $tamanho_file = $_FILES['file']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_file,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_file / 5120);
             
            if($tamanho < 1024){ //se imagem for até 1MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['file']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
				if(move_uploaded_file($tmp, $pasta.$nome_atual)){
                    
                    echo "<a target=\"_blank\" href='".CAMINHO_UP."arquivo/curriculo/professor/".$nome_atual."' />Comprovante carregado</a><input type=\"hidden\" name=\"comprovante_oculto\" value=\"".$nome_atual."\">"; //imprime a foto na tela
					
                }else{
                    echo "Falha ao enviar";					
                }
            }else{
                echo "O arquivo deve ser de no máximo 5MB";
            }
        }else{
            echo "Somente são aceitos arquivos do tipo PDF E DOC";
        }
    }else{
        echo "Selecione um arquivo";
       
    }
	 exit;

}elseif($_POST['acao']=="deletar"){
	
	$Professor->setIdProfessor($idProfessor);
	$Professor->updateFieldProfessor("excluido", "1");	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	echo $idProfessor;
	if($idProfessor!= "" ){
		$verificando = $Professor->selectProfessor("WHERE documentoUnico='".$_POST['documentoUnico']."' AND idProfessor <> ".$idProfessor);
	}else{
		$verificando = $Professor->selectProfessor("WHERE documentoUnico='".$_POST['documentoUnico']."'");
	}
	Uteis::pr(count($verificando));
	
	if(count($verificando) > 0){
		$arrayRetorno['mensagem'] = "Cadastro não efetuado, documento já cadastrado.";
		echo json_encode($arrayRetorno);
		exit;
	}
	
	$inativo = ($_POST['inativo'] == "1") ? "1" : "0";
	$encontro = ($_POST['encontro'] == "1") ? "1" : "0";
	$otimaPerformance = ($_POST['otimaPerformance'] == "1") ? "1" : "0";
	$altaPerformance = ($_POST['altaPerformance'] == "1") ? "1" : "0";
	$vetado = ($_POST['vetado'] == "1") ? "1" : "0";
	$indisponivel = ($_POST['indisponivel'] == "1") ? "1" : "0";
	$presencial = ($_POST['presencial'] == "1") ? "1" : "0";
	$online = ($_POST['online'] == "1") ? "1" : "0";
	$naoreceberemail = ($_POST['naoReceberEmail'] == "1") ? "1" : "0";
	$skype = ($_POST['skype'] == "1") ? "1" : "0";
	$deixandoGrupo = ($_POST['deixandoGrupo'] == "1") ? "1" : "0";
	$chatClub = ($_POST['chatClub'] == "1") ? "1" : "0";
	$terceiro = ($_POST['terceiro'] == "1") ? "1" : "0";
	$contratado = ($_POST['contratado'] == "1") ? "1" : "0";
	$tambemAluno = ($_POST['tambemAluno'] == "1") ? "1" : "0";
	$usoImagem = ($_POST['usoImagem'] == "1") ? "1" : "0";
	$clientePj_idClientePj = $_POST['clientePj_idClientePj'];
	
	
	if ($contratado == 1) {
		$candidato = 0;
	} else {
		$candidato = ($_POST['candidato'] == "1") ? "1" : "0";
	}
	
	$Professor->setEncontro($encontro);
	$Professor->setIdProfessor($idProfessor);	
	$Professor->setFoto($_POST['foto_oculta']);
	$Professor->setCurriculum($_POST['file_oculto']);
	$Professor->setNome($_POST['nome']);
	$Professor->setNomeExibicao($_POST['nomeExibicao']);
	$Professor->setSexo($_POST['sexo']);
	$Professor->setDataNascimento(Uteis::gravarData($_POST['dataNascimento']));
	$Professor->setDataCapacitacao(Uteis::gravarData($_POST['dataCapacitacao']));
	$Professor->setDataSegundo(Uteis::gravarData($_POST['dataSegundo']));
	$Professor->setEstadoCivilIdEstadoCivil($_POST['estadoCivil_idEstadoCivil']);		
	$Professor->setPaisIdPais($_POST['pais_idPais']);			
	$Professor->setRg($_POST['rg']);		
	$Professor->setTipoDocumentoUnicoIdTipoDocumentoUnico($_POST['tipoDocumentoUnico_idTipoDocumentoUnico']);
	$Professor->setDocumentoUnico($_POST['documentoUnico']);		
	$Professor->setSenha($_POST['senhaAcesso']);		
	$Professor->setObs($_POST['obs']);
	$Professor->setCcm($_POST['ccm']);									
	$Professor->setInss($_POST['inss']);
	$Professor->setDataContratacao(Uteis::gravarData($_POST['dataContratacao']));		
	$Professor->setInativo($_POST['inativo']);
	$Professor->setOtimaPerformance($_POST['otimaPerformance']);
	$Professor->setAltaPerformance($_POST['altaPerformance']);
	$Professor->setVetado($_POST['vetado']);
	$Professor->setIndisponivel($_POST['indisponivel']);
    $Professor->setPresencial($presencial);
    $Professor->setTradutor($_POST['tradutor']);
    $Professor->setConsultor($_POST['consultor']);
    $Professor->setOnline($online);
	$Professor->setCandidato($candidato);
	$Professor->setId_migracao($_POST['idFinanceiro']);
	$Professor->setIndicadoPor($_POST['idComoConheceu']);
	$Professor->setCidadeOrigem($_POST['cidadeOrigem']);
	$Professor->setNaoReceberEmail($naoreceberemail);
	$Professor->setSkype($skype);
	$Professor->setDeixandoGrupo($deixandoGrupo);
	$Professor->setChatClub($chatClub);
	$Professor->setTerceiro($terceiro);
	$Professor->setTipoVeto($_POST['tipoVeto']);
	$Professor->setExpSkype($_POST['expSkype']);
	$Professor->setSobre($_POST['sobre']);
	$Professor->setTambemAluno($_POST['tambemAluno']);
	$Professor->setClientePjIdClientePj($clientePj_idClientePj);
	$Professor->setRgC($_POST['rgC_oculto']);
	$Professor->setComprovante($_POST['comprovante_oculto']);

	//print_r($_POST);
	//exit;
	if($idProfessor != "" && $idProfessor > 0 ){
		$Professor->updateProfessor();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		$arrayRetorno['atualizarNivelAtual'] = false;
		$arrayRetorno['pagina'] = '';
	}else{
		$idProfessor = $Professor->addProfessor();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['atualizarNivelAtual'] = true;

		if($_POST['candidato']==1){
			$arrayRetorno['pagina'] = CAMINHO_CAD."professor/candidato/cadastro.php?id=".$idProfessor;
		}else{
			$arrayRetorno['pagina'] = CAMINHO_CAD."professor/contratado/cadastro.php?id=".$idProfessor;
		}
	}
}

echo json_encode($arrayRetorno);

?>