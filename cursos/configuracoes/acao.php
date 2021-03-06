<?php require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/padrao.php");

$Configuracoes = new Configuracoes();

$Configuracoes->setIdConfig(1);
	
$arrayRetorno = array();

if($_POST['acao']=="cadastrar"){
	
	$seguranca = $_POST['seguranca'];
	if ($seguranca != '-') {
		if ($seguranca != '') {
			$tipo = $seguranca;		
		}
	}
	
	 $Configuracoes->updateConfigField("nomeEmpresa", $_POST['nomeEmpresa']);
	 $Configuracoes->updateConfigField("logo",$_POST['foto_oculta']);
	 $Configuracoes->updateConfigField("marca",$_POST['marca_oculta']);
     $Configuracoes->updateConfigField("email",$_POST['email']);
	 $Configuracoes->updateConfigField("site",$_POST['site']);
	 $Configuracoes->updateConfigField("siteEmp",$_POST['siteEmp']);
	 $Configuracoes->updateConfigField("rodape",$_POST['rodape_oculta']);
	 $Configuracoes->updateConfigField("cabecalho",$_POST['cabecalho_oculta']);
	 $Configuracoes->updateConfigField("favIcon",$_POST['fav_oculta']);
	 $Configuracoes->updateConfigField("smtp",$_POST['smtp']);
	 $Configuracoes->updateConfigField("seguranca",$tipo);
	 $Configuracoes->updateConfigField("porta",$_POST['portaSmtp']);
	 $Configuracoes->updateConfigField("emailEnvio",$_POST['emailEnvio']);
	 $Configuracoes->updateConfigField("senhaEmail",$_POST['emailSenha']);
	 $Configuracoes->updateConfigField("whatsApp", $_POST['zap']);
	 $Configuracoes->updateConfigField("emailAten", $_POST['emailAten']);
	 $Configuracoes->updateConfigField("cor", $_POST['cor']);
 	 $Configuracoes->updateConfigField("dataExpira", $_POST['dataExpira']);
	 $Configuracoes->updateConfigField("emailFinancas",$_POST['emailFinancas']);
	 $Configuracoes->updateConfigField("emailGeral",$_POST['emailGeral']);
	 
	 $arrayRetorno['mensagem'] = "Atualizado com sucesso!";
	

} elseif($_POST['acao']=="foto"){
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
             
            if($tamanho < 10024){ //se imagem for até 10MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['foto']['tmp_name']; //caminho temporário da imagem
				
                /* se enviar a foto, insere o nome da foto no banco de dados */
								if(move_uploaded_file($tmp, $pasta.$nome_atual)){
								
									//Redimensiona novamente a imagem, mantendo a original.
							//		$imgPointer = $img->prepareImage($pasta.$nome_atual);
							//		$img->prepareResize($imgPointer, 100, 150);
							//		$img->createThumbNail($imgPointer, $pasta."miniatura-".$nome_atual);
									
									$arrayRetorno['elementoAtualizar'][0] = $_POST['destino'];
									
									$arrayRetorno['valor2'][0] = "<img src='".CAMINHO_UP."imagem/empresa/".$nome_atual."' width=\"165px\"/>
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
} elseif($_POST['acao']=="marca"){
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
									
									$arrayRetorno['valor2'][0] = "<img src='".CAMINHO_UP."imagem/empresa/".$nome_atual."' width=\"250px\"/>
									<input type=\"hidden\" name=\"marca_oculta\" value=\"".$nome_atual."\">"; 
									
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
} elseif($_POST['acao']=="fav"){
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
									
									$arrayRetorno['valor2'][0] = "<img src='".CAMINHO_UP."imagem/empresa/".$nome_atual."' width=\"50px\"/>
									<input type=\"hidden\" name=\"fav_oculta\" value=\"".$nome_atual."\">"; 
									
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
							//		$imgPointer = $img->prepareImage($pasta.$nome_atual);
							//		$img->prepareResize($imgPointer, 100, 150);
							//		$img->createThumbNail($imgPointer, $pasta."miniatura-".$nome_atual);
									
									$arrayRetorno['elementoAtualizar'][0] = $_POST['destino'];
									
									$arrayRetorno['valor2'][0] = "<img src='".CAMINHO_UP."imagem/empresa/".$nome_atual."' width=\"400px\"/>
									<input type=\"hidden\" name=\"rodape_oculta\" value=\"".$nome_atual."\">"; 
									
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
}  elseif($_POST['acao']=="cabecalho"){
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
									
									$arrayRetorno['valor2'][0] = "<img src='".CAMINHO_UP."imagem/empresa/".$nome_atual."' width=\"400px\"/>
									<input type=\"hidden\" name=\"cabecalho_oculta\" value=\"".$nome_atual."\">"; 
									
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
} 

echo json_encode($arrayRetorno);
?>