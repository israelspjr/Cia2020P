<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Professor = new Professor();
$EnderecoVirtual = new EnderecoVirtual();
$Telefone = new Telefone();
$IdiomaProfessor = new IdiomaProfessor();

//$img = new Image();

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
             
            if($tamanho < 5120){ //se imagem for até 5MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['foto']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
								if(move_uploaded_file($tmp, $pasta.$nome_atual)){
									
									//Redimensiona novamente a imagem, mantendo a original.
							//		$imgPointer = $img->prepareImage($pasta.$nome_atual);
							//		$img->prepareResize($imgPointer, 100, 150);
							//		$img->createThumbNail($imgPointer, $pasta."miniatura-".$nome_atual);
					
                  echo "<img src='".CAMINHO_UP."imagem/foto/professor/".$nome_atual."' /><input type=\"hidden\" name=\"foto_oculta\" value=\"".$nome_atual."\">";
					
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

}else{
	
	if ($_SESSION['idProfessor_SS'] == -1) {
		
	$verificando = $Professor->selectProfessor("WHERE documentoUnico = '".$_POST['documentoUnico']."' AND idProfessor <> ".$idProfessor);
	
	if(count($verificando) > 0){
		$arrayRetorno['mensagem'] = "Cadastro não efetuado, documento já cadastrado.";
		echo json_encode($arrayRetorno);
		exit;
	}
	
	if( strlen($_POST['documentoUnico']) == 11 ) {
		echo "teste";
		$doc = Uteis::formatar_CPF_CNPJ($_POST['documentoUnico']);
	} else {
		$doc = $_POST['documentoUnico'];
	}
	
	$inativo = ($_POST['inativo'] == "1") ? "1" : "0";
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
			
		$nome = $_POST['nomeExibicao'];	
//	$Professor->setIdProfessor($idProfessor);	
	$Professor->setFoto($_POST['foto_oculta']);
	$Professor->setCurriculum($_POST['file_oculto']);
	$Professor->setNome($nome);
	$Professor->setNomeExibicao($nome);
	$Professor->setSexo($_POST['sexo']);
	$Professor->setDataNascimento($_POST['dataNascimento']);
	$Professor->setEstadoCivilIdEstadoCivil($_POST['estadoCivil_idEstadoCivil']);		
	$Professor->setPaisIdPais($_POST['pais_idPais']);			
	$Professor->setRg($_POST['rg']);		
	$Professor->setTipoDocumentoUnicoIdTipoDocumentoUnico($_POST['tipoDocumentoUnico_idTipoDocumentoUnico']);
	$Professor->setDocumentoUnico($doc);		
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
	$Professor->setCandidato(1); //$_POST['candidato']);
	$Professor->setId_migracao($_POST['idFinanceiro']);
	$Professor->setIndicadoPor($_POST['idComoConheceu']);
	$Professor->setCidadeOrigem($_POST['cidadeOrigem']);
	$Professor->setNaoReceberEmail($naoreceberemail);
	$Professor->setSkype($skype);
//	$Professor->setDeixandoGrupo($deixandoGrupo);
	$Professor->setChatClub($chatClub);
	$Professor->setTerceiro($terceiro);
	$Professor->setTipoVeto($_POST['tipoVeto']);
	$Professor->setRgC($_POST['rgC_oculto']);
	$Professor->setComprovante($_POST['comprovante_oculto']);

	
		$idProfessor = $Professor->addProfessor();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		
		//Adicionar Email
		
	$EnderecoVirtual->setProfessorIdProfessor($idProfessor);
	$EnderecoVirtual->settipoEnderecoVirtual_idTipoEnderecoVirtual(1);
	$EnderecoVirtual->setValor($_POST['email']);
	$EnderecoVirtual->setEprinc(1);
	$idEnderecoVirtual = $EnderecoVirtual->addEnderecoVirtual();
	
		//Adicionar Telefone
		
	$Telefone->setProfessorIdProfessor($idProfessor);	
	$Telefone->setDdd($_POST['ddd']);	
	$Telefone->setNumero($_POST['telefone']);

	$idTelefone = $Telefone->addTelefone();		
	
	//Adicionar Idioma
	
		$inativo = 0; //( $_POST['inativo'] == "1" ? 1 : 0);
	
		$IdiomaProfessor->setProfessorIdProfessor($idProfessor);
		$IdiomaProfessor->setIdiomaIdIdioma($_POST['idIdioma']);
	//	$IdiomaProfessor->setNivelLinguisticoIdNivelLinguistico($_POST['idNivelLinguistico']);
		$IdiomaProfessor->setSotaqueIdiomaProfessorIdSotaqueIdiomaProfessor($_POST['idSotaqueIdiomaProfessor']);
	//	$IdiomaProfessor->setDataContratacao( Uteis::gravarData($_POST['dataContratacao']));
		$IdiomaProfessor->setInativo($inativo);
	//	$IdiomaProfessor->setObs($_POST['obs']);
		
		$idIdiomaProfessor = $IdiomaProfessor->addIdiomaProfessor();											
	
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		
		$_SESSION['logado'] = true;
		$_SESSION['idProfessor_SS'] = $idProfessor;
		$_SESSION['nome_SS'] = $nome;
        $_SESSION['usuario'] = "professor";
        $_SESSION['idUsuario'] = $idProfessor;
				 
 //       $arrayRetorno['pagina'] = '/cursos/mobile/professor/index.html';
  		$arrayRetorno['ondeAtualizar'] = "#centro";
				
	

		
	} else {
		
	$Professor->setIdProfessor($idProfessor);
		
	$Professor->updateFieldProfessor("foto", $_POST['foto_oculta']);
	$Professor->updateFieldProfessor("curriculum", $_POST['file_oculto']);	
	$Professor->updateFieldProfessor("nomeExibicao", $_POST['nomeExibicao']);
	$Professor->updateFieldProfessor("sexo", $_POST['sexo']);
	$Professor->updateFieldProfessor("dataNascimento", $_POST['dataNascimento']) ;
	$Professor->updateFieldProfessor("estadoCivil_idEstadoCivil", $_POST['estadoCivil_idEstadoCivil']);
	$Professor->updateFieldProfessor("pais_idPais", $_POST['pais_idPais']);
	$Professor->updateFieldProfessor("rg", $_POST['rg']);
	$Professor->updateFieldProfessor("tipoDocumentoUnico_idTipoDocumentoUnico", $_POST['tipoDocumentoUnico_idTipoDocumentoUnico']);
	$Professor->updateFieldProfessor("documentoUnico", $_POST['documentoUnico']);
    $senha = EncryptSenha::B64_Encode($_POST['senhaAcesso']);
	$Professor->updateFieldProfessor("senha", $senha);
	$Professor->updateFieldProfessor("ccm", $_POST['ccm']);
	$Professor->updateFieldProfessor("inss", $_POST['inss']);
    $Professor->updateFieldProfessor("presencial", $_POST['presencial']);
    $Professor->updateFieldProfessor("online", $_POST['online']);
	$Professor->updateFieldProfessor("indicadoPor", $_POST['idComoConheceu']);
	
 //   $arrayRetorno['pagina'] = '/cursos/mobile/professor/index.html';
 	$arrayRetorno['ondeAtualizar'] = "#centro";
	$arrayRetorno['mensagem'] = "Cadastro atualizado com sucesso";
	}
	
}

echo json_encode($arrayRetorno);

?>