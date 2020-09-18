<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$ClientePf = new ClientePf();
$Endereco = new Endereco();
$EnderecoVirutal = new EnderecoVirtual();
$Telefone = new Telefone();
$PreClientePf = new PreClientePf();
$DisparoEmail = new DisparoEmail();
$Funcionario = new Funcionario();
$Configuracoes = new Configuracoes();
	
$img = new Image();

$idClientePf = $_REQUEST['id'];
$idFuncionario = $_REQUEST['idFuncionario'];
$config = $Configuracoes->selectConfig();

$arrayRetorno = array();

if($_POST['acao']=="foto"){
	
	/* formatos de imagem permitidos */
    $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
    $pasta = CAMINHO_UP_ROOT."imagem/foto/clientePf/";
	
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
					$imgPointer = $img->prepareImage($pasta.$nome_atual);
					$img->prepareResize($imgPointer, 100, 150);
					$img->createThumbNail($imgPointer, $pasta."miniatura-".$nome_atual);
										
                    echo "<img src='".CAMINHO_UP."imagem/foto/clientePf/miniatura-".$nome_atual."' />
					<input type=\"hidden\" name=\"foto_oculta\" value=\"".$nome_atual."\">"; 
					
                }else{
                    echo "Falha ao enviar";					
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

}elseif($_POST['acao']=="file"){
	/* formatos de imagem permitidos */
    $permitidos = array(".pdf",".doc",".docx",".jpg",".png");
    $pasta = CAMINHO_UP_ROOT."imagem/foto/clientePf/";
	
    if(isset($_POST)){
        $nome_file    = $_FILES['file']['name'];
        $tamanho_file = $_FILES['file']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_file,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_file / 5120);
             
            if($tamanho < 10024){ //se imagem for até 10MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['file']['tmp_name']; //caminho temporário da imagem
                 
                /* se enviar a foto, insere o nome da foto no banco de dados */
				if(move_uploaded_file($tmp, $pasta.$nome_atual)){
                    
                    echo "<a target=\"_blank\" href='".CAMINHO_UP."imagem/foto/clientePf/".$nome_atual."' />Política carregado</a><input type=\"hidden\" name=\"file_oculto\" value=\"".$nome_atual."\">"; //imprime a foto na tela
					
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
		//
}else{
	
	$where = " WHERE documentoUnico = '".$_POST['documentoUnico']."' AND excluido = 0 AND idClientePf NOT IN(".$idClientePf.")";
	$verificando = $ClientePf->selectClientePf($where);
	
	if($verificando){
		$arrayRetorno['mensagem'] = "Cadastro não efetuado, documento já cadastrado.";
//		header('Location:/cursos/aluno/index.php');
		echo json_encode($arrayRetorno);
		exit;
	}
	
  if (($_SESSION['idClientePf_SS'] != 4) || ($idClientePf != 4)) {
	
	$ClientePf->setIdClientePf($idClientePf);
	
	$ClientePf->updateFieldClientepf("nomeExibicao", $_POST['nomeExibicao']);
	$ClientePf->updateFieldClientepf("foto", $_POST['foto_oculta']);
	$ClientePf->updateFieldClientepf("sexo", $_POST['sexo']);
	$ClientePf->updateFieldClientepf("dataNascimento", /*Uteis::gravarData(*/$_POST['dataNascimento']) /*)*/;
	$ClientePf->updateFieldClientepf("estadoCivil_idEstadoCivil", $_POST['estadoCivil_idEstadoCivil']);
	$ClientePf->updateFieldClientepf("pais_idPais", $_POST['pais_idPais']);
	$ClientePf->updateFieldClientepf("cargo", $_POST['cargo']);
	$ClientePf->updateFieldClientepf("rg", $_POST['rg']);
	$ClientePf->updateFieldClientepf("tipoDocumentoUnico_idTipoDocumentoUnico", $_POST['tipoDocumentoUnico_idTipoDocumentoUnico']);
	$ClientePf->updateFieldClientepf("documentoUnico", $_POST['documentoUnico']);
	$ClientePf->updateFieldClientepf("senhaAcesso", EncryptSenha::B64_Encode($_POST['senhaAcesso']));
	$ClientePf->updateFieldClientePf("rf", $_POST['rf']);
	$ClientePf->updateFieldClientePf("cc",$_POST['cc']);
	$ClientePf->updateFieldClientepf("politicaA", $_POST['politicaA']);
	$ClientePf->updateFieldClientepf("conheceu", $_POST['idComoConheceu']);
	if ($_POST['politicaA'] == 1) {
	$date = date('Y-m-d'); 
	$ClientePf->updateFieldClientePf("dataPolitica", $date);
	}

	$arrayRetorno['mensagem'] = MSG_CADATU;
	
  } else {
	  
	$ClientePf->setRg($_POST['rg']);
	$ClientePf->setNome($_POST['nomeExibicao']);
	$ClientePf->setNomeExibicao($_POST['nomeExibicao']);
	$ClientePf->setDataNascimento(/*Uteis::gravarData(*/$_POST['dataNascimento']/*)*/);
	$ClientePf->setSexo($_POST['sexo']);
	$ClientePf->setEstadoCivilIdEstadoCivil($_POST['estadoCivil_idEstadoCivil']);
	$ClientePf->setTipoClienteIdTipoCliente(3);
	$ClientePf->setPaisIdPais($_POST['pais_idPais']);
	$ClientePf->setCargo($_POST['cargo']);
	$ClientePf->setTipoDocumentoUnicoIdTipoDocumentoUnico($_POST['tipoDocumentoUnico_idTipoDocumentoUnico']);
	$ClientePf->setDocumentoUnico($_POST['documentoUnico']);
	$ClientePf->setSenhaAcesso($_POST['senhaAcesso']);
	$ClientePf->setClientePjIdClientePj($_POST['clientePj_idClientePj']);
	$ClientePf->setRf($_POST['rf']);
	$ClientePf->setCc($_POST['cc']);
	$ClientePf->setPolitica($_POST['foto_politica']);
	$ClientePf->setPoliticaA($_POST['politicaA']);
	$ClientePf->setConheceu($_POST['idComoConheceu']);
	if ($_POST['politicaA'] == 1) {
	$date = date('Y-m-d'); 
	$ClientePf->setdataPolitica($date);
	}

	$idClientePf = $ClientePf->addClientepf();
// Adicionando no RdStation
?>	
	<script type='text/javascript'>
	function rdStation() {

var nome = <?php echo $_POST['nomeExibicao'];?> 
var email = <?php echo $_POST['emailPf'];?>
var tel = <?php echo $_POST['telefone'];?>
var site = 'Novo Aluno';
//console.log(nome);
//	console.log(email);
//	console.log(tel);
		$.ajax({
  method: "POST",
  url: "https://"+<?php echo $config[0]['site']?>+"/integraRD.php",
  data: { nome: nome, email:email, tel:tel, fonte:site }
})
  .done(function( msg ) {
   console.log( "Data Saved: " + msg );
  });
	}
 rsStation();
 </script> 
<?php		
	//Adicionado Endereço
	
	$Endereco->setClientePfIdClientePf($idClientePf);
	$Endereco->setPaisIdPais($_POST['pais_idPais']);
	$Endereco->setPrincipal(1);
	$Endereco->setRua($_POST['endereco']);
	
	$Endereco->AddEndereco();
	
	
	//Adicionando Email
	
	$EnderecoVirutal->setClientePfIdClientePf($idClientePf);
	$EnderecoVirutal->settipoEnderecoVirtual_idTipoEnderecoVirtual(1);
	$EnderecoVirutal->setEprinc(0);
	$EnderecoVirutal->setValor($_POST['emailPf']);
	
	$EnderecoVirutal->AddEnderecoVirtual();
	
	$EnderecoVirutal->setClientePfIdClientePf($idClientePf);
	$EnderecoVirutal->settipoEnderecoVirtual_idTipoEnderecoVirtual(1);
	$EnderecoVirutal->setEprinc(1);
	$EnderecoVirutal->setValor($_POST['emailPj']);
		
	$EnderecoVirutal->AddEnderecoVirtual();	
	
	if ($_POST['skype']) {
	$EnderecoVirutal->setClientePfIdClientePf($idClientePf);
	$EnderecoVirutal->settipoEnderecoVirtual_idTipoEnderecoVirtual(9);
	$EnderecoVirutal->setEprinc(0);
	$EnderecoVirutal->setValor($_POST['skype']);
		
	$EnderecoVirutal->AddEnderecoVirtual();	
	}
	
	//Adicionando Telefone
	
	$Telefone->setClientePfIdClientePf($idClientePf);
	$Telefone->setNumero($_POST['telefone']);
	$Telefone->setDescricaoTelefoneIdDescricaoTelefone(1);
	$Telefone->addTelefone();
	
	if ($_POST['telefonePj']) {
	$Telefone->setClientePfIdClientePf($idClientePf);
	$Telefone->setNumero($_POST['telefonePj']);
	$Telefone->setDescricaoTelefoneIdDescricaoTelefone(2);
	$Telefone->addTelefone();
	}

	if ($_POST['telefonePf']) {
	$Telefone->setClientePfIdClientePf($idClientePf);
	$Telefone->setNumero($_POST['telefonePf']);
	$Telefone->setDescricaoTelefoneIdDescricaoTelefone(3);
	$Telefone->addTelefone();
	}
	
	
	//Setando 1 para cliente que completou cadastro
	
	$PreClientePf->setIdPreClientePf($_POST['idPreClientePf']);
	$PreClientePf->updateFieldPreClientepf("jaRealizado",1);
	
	//Avisando o Funcionário responsavel

	$emailF = $Funcionario->getEmail($idFuncionario);
	$nomeF = $Funcionario->getNome($idFuncionario);

	$assunto = "Aluno terminou a primeira parte do cadastro";
	
	$conteudo = "Nome: ".$_POST['nomeExibicao']."<br> Email: ".$_POST['emailPf'];
	$NomeAluno = $_POST['nomeExibicao'];
	$emailAluno = $_POST['emailPj'];

		$paraQuem2 = array("israel"=> "Companhia de idiomas", "email" => "envio@companhiadeidiomas.com.br");
		$paraQuem3 = array("nome" => $nomeF, "email" => $emailF);
	
		$rs = Uteis::enviarEmail($assunto, $conteudo, $paraQuem3, "");//, $cc, $bcc);	
		$rs2 = Uteis::enviarEmail($assunto, $conteudo, $paraQuem2, "");//, $cc, $bcc);	


		//Avisando o Aluno
	$conteudo = "Para acessar o portal do aluno, utilize o link abaixo: <p> <a href=\"https://".$config[0]['site']."/portais/aluno/login.php?app=1\">".$config[0]['site']."/portais/aluno/login.php?app=1</a></p>";
		
        $paraQuem4 = array("nome" => $NomeAluno, "email" => $emailAluno);

		$rs3 = Uteis::enviarEmail($assunto, $conteudo, $paraQuem4, "");//, $cc, $bcc);	

		 $_SESSION['idClientePf_SS'] = $idClientePf;
		 $_SESSION['idUsuario'] = $idClientePf;
		 $_SESSION['idUnico'] = $result['idClientePf'];
		 $_SESSION['appN'] = 1;
		$arrayRetorno['mensagem'] = "Obrigado por terminar a primeira parte do cadastro, clique no link abaixo ou no menu ao lado para continuar o seu cadastro";
		echo '<meta http-equiv="refresh" content="0;url=/cursos/portais/index.php">';
//		header('Location:/cursos/mobile/aluno/index.php');
  }
}

echo json_encode($arrayRetorno);

?>