<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$ClientePj = new ClientePj();

$img = new Image();

$arrayRetorno = array();

$idClientePj = $_SESSION['idClientePj_SS'];

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
					
					
                    //mysql_query("INSERT INTO fotos (foto) VALUES (".$nome_atual.")");
                    echo "<img src='".CAMINHO_UP."imagem/foto/clientePj/miniatura-".$nome_atual."' id='previsualizar'>
					<input type=\"hidden\" name=\"foto_oculta\" value=\"".$nome_atual."\">"; //imprime a foto na tela
					
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

}else{
	
/*	$verificando = $ClientePj->selectClientePj("WHERE cnpj='".$_POST['cnpj']."' AND idClientePj <> ".$idClientePj);
	
	if(count($verificando) > 0){
		$arrayRetorno['mensagem'] = "Cadastro não efetuado, documento já cadastrado.";
		echo json_encode($arrayRetorno);
		exit;
	}*/
	
	$ClientePj->setIdClientePj($idClientePj);
	
	if($_POST['isentoIE'] == "1") $_POST['inscricaoEstadual'] = "ISENTO";
	
	$ClientePj->updateFieldClientePj("nomeFantasia", $_POST['nomeFantasia']);
	$ClientePj->updateFieldClientePj("cnpj", $_POST['cnpj']);
	$ClientePj->updateFieldClientePj("inscricaoEstadual", $_POST['inscricaoEstadual']);
	$ClientePj->updateFieldClientePj("logo", $_POST['foto_oculta']);
	$ClientePj->updateFieldClientePj("senhaAcesso", $_POST['senhaAcesso']);
			
	$arrayRetorno["mensagem"] = "Cadastro atualizado com sucesso";
}

echo json_encode($arrayRetorno);

?>