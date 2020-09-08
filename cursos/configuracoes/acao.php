<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/padrao.php");

$Configuracoes = new Configuracoes();
	
//$img = new Image();

$idClientePf = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="foto"){
	/* formatos de imagem permitidos */
    $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
    $pasta = CAMINHO_UP_ROOT."imagem/empresa/";
	
    if(isset($_POST)){
        $nome_imagem    = $_FILES['foto']['name'];
        $tamanho_imagem = $_FILES['foto']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
             
            if($tamanho < 1024){ //se imagem for até 1MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['foto']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
								if(move_uploaded_file($tmp, $pasta.$nome_atual)){
								
									//Redimensiona novamente a imagem, mantendo a original.
							//		$imgPointer = $img->prepareImage($pasta.$nome_atual);
							//		$img->prepareResize($imgPointer, 100, 150);
							//		$img->createThumbNail($imgPointer, $pasta."miniatura-".$nome_atual);
									
									$arrayRetorno['elementoAtualizar'][0] = $_POST['destino'];
									
									$arrayRetorno['valor2'][0] = "<img src='".CAMINHO_UP."imagem/empresa/".$nome_atual."' />
									<input type=\"hidden\" name=\"foto_oculta\" value=\"".$nome_atual."\">"; 
									
									$arrayRetorno['mensagem'] = "Carregado com sucesso.";
								
                }else{
                    $arrayRetorno['mensagem'] = "Falha ao enviar";					
                }
            }else{
                $arrayRetorno['mensagem'] = "A imagem deve ser de no máximo 2MB";
            }
        }else{
            $arrayRetorno['mensagem'] = "Somente são aceitos arquivos do tipo Imagem";
        }
    }else{
        $arrayRetorno['mensagem'] = "Selecione uma imagem";
    }
	

}elseif($_POST['acao']=="marca"){
	/* formatos de imagem permitidos */
    $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
    $pasta = CAMINHO_UP_ROOT."imagem/empresa/";
	
    if(isset($_POST)){
        $nome_imagem    = $_FILES['foto']['name'];
        $tamanho_imagem = $_FILES['foto']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
             
            if($tamanho < 1024){ //se imagem for até 1MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['foto']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
								if(move_uploaded_file($tmp, $pasta.$nome_atual)){
								
									//Redimensiona novamente a imagem, mantendo a original.
									$imgPointer = $img->prepareImage($pasta.$nome_atual);
									$img->prepareResize($imgPointer, 100, 150);
									$img->createThumbNail($imgPointer, $pasta."miniatura-".$nome_atual);
									
									$arrayRetorno['elementoAtualizar'][0] = $_POST['destino'];
									
									$arrayRetorno['valor2'][0] = "<img src='".CAMINHO_UP."imagem/empresa/".$nome_atual."' />
									<input type=\"hidden\" name=\"foto_oculta\" value=\"".$nome_atual."\">"; 
									
									$arrayRetorno['mensagem'] = "Carregado com sucesso.";
								
                }else{
                    $arrayRetorno['mensagem'] = "Falha ao enviar";					
                }
            }else{
                $arrayRetorno['mensagem'] = "A imagem deve ser de no máximo 2MB";
            }
        }else{
            $arrayRetorno['mensagem'] = "Somente são aceitos arquivos do tipo Imagem";
        }
    }else{
        $arrayRetorno['mensagem'] = "Selecione uma imagem";
    }
	

}elseif($_POST['acao']=="fav"){
	/* formatos de imagem permitidos */
    $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
    $pasta = CAMINHO_UP_ROOT."imagem/empresa/";
	
    if(isset($_POST)){
        $nome_imagem    = $_FILES['foto']['name'];
        $tamanho_imagem = $_FILES['foto']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
             
            if($tamanho < 1024){ //se imagem for até 1MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['foto']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
								if(move_uploaded_file($tmp, $pasta.$nome_atual)){
								
									//Redimensiona novamente a imagem, mantendo a original.
									$imgPointer = $img->prepareImage($pasta.$nome_atual);
									$img->prepareResize($imgPointer, 100, 150);
									$img->createThumbNail($imgPointer, $pasta."miniatura-".$nome_atual);
									
									$arrayRetorno['elementoAtualizar'][0] = $_POST['destino'];
									
									$arrayRetorno['valor2'][0] = "<img src='".CAMINHO_UP."imagem/empresa/".$nome_atual."' />
									<input type=\"hidden\" name=\"foto_oculta\" value=\"".$nome_atual."\">"; 
									
									$arrayRetorno['mensagem'] = "Carregado com sucesso.";
								
                }else{
                    $arrayRetorno['mensagem'] = "Falha ao enviar";					
                }
            }else{
                $arrayRetorno['mensagem'] = "A imagem deve ser de no máximo 2MB";
            }
        }else{
            $arrayRetorno['mensagem'] = "Somente são aceitos arquivos do tipo Imagem";
        }
    }else{
        $arrayRetorno['mensagem'] = "Selecione uma imagem";
    }
	

} elseif($_POST['acao']=="rodape"){
	/* formatos de imagem permitidos */
    $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
    $pasta = CAMINHO_UP_ROOT."imagem/empresa/";
	
    if(isset($_POST)){
        $nome_imagem    = $_FILES['foto']['name'];
        $tamanho_imagem = $_FILES['foto']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
             
            if($tamanho < 1024){ //se imagem for até 1MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['foto']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
								if(move_uploaded_file($tmp, $pasta.$nome_atual)){
								
									//Redimensiona novamente a imagem, mantendo a original.
									$imgPointer = $img->prepareImage($pasta.$nome_atual);
									$img->prepareResize($imgPointer, 100, 150);
									$img->createThumbNail($imgPointer, $pasta."miniatura-".$nome_atual);
									
									$arrayRetorno['elementoAtualizar'][0] = $_POST['destino'];
									
									$arrayRetorno['valor2'][0] = "<img src='".CAMINHO_UP."imagem/empresa/".$nome_atual."' />
									<input type=\"hidden\" name=\"foto_oculta\" value=\"".$nome_atual."\">"; 
									
									$arrayRetorno['mensagem'] = "Carregado com sucesso.";
								
                }else{
                    $arrayRetorno['mensagem'] = "Falha ao enviar";					
                }
            }else{
                $arrayRetorno['mensagem'] = "A imagem deve ser de no máximo 2MB";
            }
        }else{
            $arrayRetorno['mensagem'] = "Somente são aceitos arquivos do tipo Imagem";
        }
    }else{
        $arrayRetorno['mensagem'] = "Selecione uma imagem";
    }
	

} elseif($_POST['acao']=="cabecalho"){
	/* formatos de imagem permitidos */
    $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
    $pasta = CAMINHO_UP_ROOT."imagem/empresa";
	
    if(isset($_POST)){
        $nome_imagem    = $_FILES['foto']['name'];
        $tamanho_imagem = $_FILES['foto']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
             
            if($tamanho < 1024){ //se imagem for até 1MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['foto']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
								if(move_uploaded_file($tmp, $pasta.$nome_atual)){
								
									//Redimensiona novamente a imagem, mantendo a original.
									$imgPointer = $img->prepareImage($pasta.$nome_atual);
									$img->prepareResize($imgPointer, 100, 150);
									$img->createThumbNail($imgPointer, $pasta."miniatura-".$nome_atual);
									
									$arrayRetorno['elementoAtualizar'][0] = $_POST['destino'];
									
									$arrayRetorno['valor2'][0] = "<img src='".CAMINHO_UP."imagem/empresa/".$nome_atual."' />
									<input type=\"hidden\" name=\"foto_oculta\" value=\"".$nome_atual."\">"; 
									
									$arrayRetorno['mensagem'] = "Carregado com sucesso.";
								
                }else{
                    $arrayRetorno['mensagem'] = "Falha ao enviar";					
                }
            }else{
                $arrayRetorno['mensagem'] = "A imagem deve ser de no máximo 2MB";
            }
        }else{
            $arrayRetorno['mensagem'] = "Somente são aceitos arquivos do tipo Imagem";
        }
    }else{
        $arrayRetorno['mensagem'] = "Selecione uma imagem";
    }
	

}else {
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	$excluido = ( $_POST['excluido'] == "1" ? 1 : 0);
	if ($inativo == 1) {
		$dataInativar = ($_POST['dataInativar']);
		$dataRetorno = $_POST['dRetorno'];
	//	$motivo = $_POST['motivo'];
		$area = $_POST['area'];
	}
	$naoReceberEmail = ( $_POST['naoReceberEmail'] == "1" ? 1 : 0);
	$inativaPsa = ( $_POST['inativaPsa'] == "1" ? 1 : 0);
	$alunoIndica = ( $_POST['alunoIndica'] == "1" ? 1 : 0);
	$influencia = ( $_POST['temInfluencia'] == "1" ? 1 : 0);
	$poder = ( $_POST['cargoPoder'] == "1" ? 1 : 0);
	
	$categoria = implode(",",$_POST['categoria']);
//	Uteis::pr($categoria);
	
    $proposta = $_POST['idProposta'];
	$idIntengranteGrupo = $_REQUEST['idIntengranteGrupo'];
//	echo $idIntengranteGrupo;
	
	if($idClientePf != "" && $idClientePf > 0 ){
		
	} else {
	
	$where = " WHERE documentoUnico = '".$_POST['documentoUnico']."' ";	
	if($idClientePf) $where .= " AND idClientePf NOT IN(".$idClientePf.")";
	$verificando = $ClientePf->selectClientePf($where);
	
	if($verificando){
		$arrayRetorno['mensagem'] = "Cadastro não efetuado, documento já cadastrado.";
		echo json_encode($arrayRetorno);
		exit;
		}
	
	}
	
	$ClientePf->setCategoria($categoria);
	$ClientePf->setAlunoIndica($alunoIndica);
	$ClientePf->setIdClientePf($idClientePf);
	$ClientePf->setTipoClienteIdTipoCliente($_POST['tipoCliente_idTipoCliente']);
	$ClientePf->setNaoReceberEmail($naoReceberEmail);
	$ClientePf->setInativo($inativo );
	$ClientePf->setExcluido($excluido);
	$ClientePf->setDataInativar(Uteis::gravarData($dataInativar));
	$ClientePf->setDataRetorno(Uteis::gravarData($dataRetorno));
	$ClientePf->setMotivo($_POST['motivo']);
	$ClientePf->setArea($area);
	$ClientePf->setRg($_POST['rg']);
	$ClientePf->setFoto($_POST['foto_oculta']);
	$ClientePf->setNome($_POST['nome']);
	$ClientePf->setNomeExibicao($_POST['nomeExibicao']);
	$ClientePf->setDataNascimento(Uteis::gravarData($_POST['dataNascimento']));
	$ClientePf->setSexo($_POST['sexo']);
	$ClientePf->setEstadoCivilIdEstadoCivil($_POST['estadoCivil_idEstadoCivil']);
	$ClientePf->setTipoClienteIdTipoCliente($_POST['TipoCliente_idTipoCliente']);
	$ClientePf->setPaisIdPais($_POST['pais_idPais']);
	$ClientePf->setCargo($_POST['cargo']);
	$ClientePf->setClientePjIdClientePj($_POST['clientePj_idClientePj']);
	$ClientePf->setTipoDocumentoUnicoIdTipoDocumentoUnico($_POST['tipoDocumentoUnico_idTipoDocumentoUnico']);
	$ClientePf->setDocumentoUnico($_POST['documentoUnico']);
	$ClientePf->setSenhaAcesso($_POST['senhaAcesso']);
	$ClientePf->setObs($_POST['obs']);
	$ClientePf->setInativaPsa($inativaPsa);
	$ClientePf->setRf($_POST['rf']);
	$ClientePf->setSubEmpresa($_POST['subEmpresa']);
	$ClientePf->setCc($_POST['cc']);
	$ClientePf->setPolitica($_POST['file_oculto']);
	$ClientePf->setPoliticaA($_POST['politicaA']);
	$ClientePf->setConheceu($_POST['idComoConheceu']);
	$ClientePf->setInfluencia($influencia);
	$ClientePf->setPoder($poder);
	$ClientePf->setId_migracao($_POST['idFinanceiro']);
	$ClientePf->setClientePjIdClientePj2($_POST['clientePj_idClientePj2']);
	
	if ($_POST['politicaA'] == 1) {
	$date = date('Y-m-d'); 
	$ClientePf->setdataPolitica($date);
	}
	if($idClientePf != "" && $idClientePf > 0 ){
		$ClientePf->updateClientepf();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		
	  $idClientePf = $ClientePf->addClientepf();
	
	if ($idIntengranteGrupo > 0) {
		
		$IntengranteGrupo->setIdIntegranteGrupo($idIntengranteGrupo);
		$IntengranteGrupo->updateFieldIntegranteGrupo("clientePf_idClientePf", $idClientePf);
	}
	  
	
	  
	  
	  
	  if($proposta==""){		
  		$arrayRetorno['mensagem'] = MSG_CADNEW;
  		$arrayRetorno['atualizarNivelAtual'] = true;
  		$arrayRetorno['pagina'] = CAMINHO_CAD."clientePf/cadastro.php?id=".$idClientePf;
    }else{
        
      $arrayRetorno['mensagem'] = MSG_CADNEW;
      $arrayRetorno['fecharNivel'] = true; 
      $arrayRetorno['atualizarNivelAtual'] = true;                 
      $arrayRetorno['pagina'] = CAMINHO_VENDAS."proposta/include/acao/integranteProposta.php?idProposta=".$proposta."&idClientePf=".$idClientePf;
      
  }
	}
}

  $where2 = " WHERE clientePf_idClientePf = ".$idClientePf." AND ePrinc = 1";
	$valor = $EnderecoVirtual->selectEnderecoVirtual($where2);
	if ($valor == '') {
		$arrayRetorno['mensagem'] = "Cadastro não atualizado / Criado, não existe um email principal cadastrado.";
		echo json_encode($arrayRetorno);
		exit;
		} else {
		

echo json_encode($arrayRetorno);

		}

?>