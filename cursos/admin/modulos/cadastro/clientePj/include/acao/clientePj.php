<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ClientePj = new ClientePj();

$img = new Image();

$arrayRetorno = array();

$idClientePj = $_REQUEST['id'];

if($_POST['acao']=="foto"){

	/* formatos de imagem permitidos */
	$permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
	$pasta = CAMINHO_UP_ROOT."imagem/foto/clientePj/";
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
                if(move_uploaded_file($tmp,$pasta.$nome_atual)){
					//Redimensiona novamente a imagem, mantendo a original.
					$imgPointer = $img->prepareImage($pasta.$nome_atual);
					$img->prepareResize($imgPointer, 100, 150);
					$img->createThumbNail($imgPointer, $pasta."miniatura-".$nome_atual);
					
                    echo "<img src='".CAMINHO_UP."imagem/foto/clientePj/miniatura-".$nome_atual."' id='previsualizar'><input type=\"hidden\" name=\"foto_oculta\" value=\"".$nome_atual."\">"; //imprime a foto na tela
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

}elseif($_POST['acao']=="deletar"){
	
	$ClientePj->setIdClientePj($idClientePj);
	 $ClientePj->updateFieldClientePj("excluido", "1");	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
	
}else{
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	$faltaJustificadaPresenca = ( $_POST['faltaJustificadaPresenca'] == "1" ? 1 : 0);
	$_POST['inscricaoEstadual'] = ( $_POST['isentoIE'] == "1" ? "ISENTO" : $_POST['inscricaoEstadual']);
	
	if($idClientePj!= "" ){
		$verificando = $ClientePj->selectClientePj("WHERE cnpj = '".$_POST['cnpj']."' AND idClientePj <> ".$idClientePj);
	}else{
		$verificando = $ClientePj->selectClientePj("WHERE cnpj='".$_POST['cnpj']."'");
	}
	if($verificando > 0){
		$arrayRetorno['mensagem'] = "Cadastro não efetuado, documento já cadastrado.";
		echo json_encode($arrayRetorno);
		exit;
	}
	$ClientePj->setIntGrupo($_POST['intGrupo']);
	$ClientePj->setIdClientePj($idClientePj);
	$ClientePj->setTipoClienteIdTipoCliente($_POST['TipoCliente_idTipoCliente']);
	$ClientePj->setRazaoSocial($_POST['razaoSocial']);
	$ClientePj->setNomeFantasia($_POST['nomeFantasia']);
	$ClientePj->setCnpj($_POST['cnpj']);
	$ClientePj->setInscricaoEstadual($_POST['inscricaoEstadual']);
	$ClientePj->setLogo($_POST['foto_oculta']);
	$ClientePj->setSenhaAcesso($_POST['senhaAcesso']);
	$ClientePj->setInativo($inativo);
	$ClientePj->setFrequenciaMinimaExigida($_POST['frequenciaMinimaExigida']);
	$ClientePj->setFaltaJustificadaPresenca($faltaJustificadaPresenca);
	$ClientePj->setObs($_POST['obs']);
	$ClientePj->setDataContratacao(Uteis::gravarData($_POST['dataContratacao']));
	$ClientePj->setClientePjIdClientePj($_POST['clientePj_idClientePj']);	
	$ClientePj->setEmpresaIndica($_POST['empresaIndica']);
	$ClientePj->setPotencial($_POST['potencial']);
	$ClientePj->setConheceu($_POST['idComoConheceu']);		
			
	if($idClientePj != "" && $idClientePj > 0 ){
		$ClientePj->updateClientepj();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idClientePj = $ClientePj->addClientepj();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['atualizarNivelAtual'] = true;   
		$arrayRetorno['pagina'] = CAMINHO_CAD."clientePj/cadastro.php?id=".$idClientePj;
  
   }	
}

echo json_encode($arrayRetorno);

?>