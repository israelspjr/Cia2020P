<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Funcionario = new Funcionario();

$img = new Image();

$arrayRetorno = array();

$idFuncionario = $_REQUEST['id'];

if($_POST['acao']=="foto"){
	/* formatos de imagem permitidos */
    $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
    $pasta = CAMINHO_UP_ROOT."imagem/foto/funcionario/";
	
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
					
                   
                    echo "<img src='".CAMINHO_UP."imagem/foto/funcionario/miniatura-".$nome_atual."' />
					<input type=\"hidden\" name=\"foto_oculta\" value=\"".$nome_atual."\">"; //imprime a foto na tela
					
                }else{
                    echo "Falha ao enviar-".$pasta.$nome_atual." - ".$tmp;					
                }
            }else{
                echo "A imagem deve ser de no máximo 2MB";
            }
        }else{
            echo "Somente são aceitos arquivos do tipo Imagem";
        }
    }else{
        echo "Selecione uma imagem";       
    }
	
	exit;
	
}elseif($_POST['acao']=="deletar"){
		
	$Funcionario->setIdFuncionario($idFuncionario);
	$Funcionario->updateFieldFuncionario("excluido", "1");	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);

	if($idFuncionario!= "" ){
		$verificando = $Funcionario->selectFuncionario("WHERE documentoUnico='".$_POST['documentoUnico']."' AND idFuncionario <> ".$idFuncionario);
	}else{
		$verificando = $Funcionario->selectFuncionario("WHERE documentoUnico='".$_POST['documentoUnico']."'");
	}
	if(count($verificando) > 0){
		$arrayRetorno['mensagem'] = "Cadastro não efetuado, documento já cadastrado.";
		echo json_encode($arrayRetorno);
		exit;
	}
	
	$Funcionario->setIdFuncionario($idFuncionario);		
	$Funcionario->setEstadoCivilIdEstadoCivil($_POST['estadoCivil_idEstadoCivil']);
	$Funcionario->setPaisIdPais($_POST['pais_idPais']);
	$Funcionario->setNome($_POST['nome']);
	$Funcionario->setNomeExibicao($_POST['nomeExibicao']);
	$Funcionario->setSexo($_POST['sexo']);
	$Funcionario->setDataNascimento(Uteis::gravarData($_POST['dataNascimento']));
	$Funcionario->setRg($_POST['rg']);
	$Funcionario->setTipoDocumentoUnicoIdTipoDocumentoUnico($_POST['tipoDocumentoUnico_idTipoDocumentoUnico']);
	$Funcionario->setDocumentoUnico($_POST['documentoUnico']);
	$Funcionario->setSenhaAcesso($_POST['senhaAcesso']);
	$Funcionario->setObs($_POST['obs']);
	$Funcionario->setInativo($_POST['inativo']);
	$Funcionario->setFoto($_POST['foto_oculta']);
	$Funcionario->setCargo($_POST['cargo']);
	$Funcionario->setAdmicao(Uteis::gravarData($_POST['admicao']));
	$Funcionario->setDemicao(Uteis::gravarData($_POST['demicao']));
	$Funcionario->setHorasTrabalho(Uteis::gravarHoras($_POST['horasTrabalho']));
	//print_r($_POST);
	//exit;
	if($idFuncionario != "" && $idFuncionario > 0 ){
		$Funcionario->updateFuncionario();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		$arrayRetorno['atualizarNivelAtual'] = false;
		$arrayRetorno['pagina'] = '';
	}else{
		$idFuncionario = $Funcionario->addFuncionario();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['atualizarNivelAtual'] = true;
		$arrayRetorno['pagina'] = CAMINHO_CAD."funcionario/cadastro.php?id=".$idFuncionario;
	}
	
}

echo json_encode($arrayRetorno);

?>