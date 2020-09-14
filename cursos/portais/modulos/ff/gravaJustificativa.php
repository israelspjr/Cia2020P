<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$DiaAulaFFIndividual = new DiaAulaFFIndividual();
$TextoEmailPadrao = new TextoEmailPadrao();
$GerenteTem = new GerenteTem();
$Funcionario = new Funcionario();
if($_POST['acao']=="justificaFalta"){

    $idDiaAulaFFIndividual = $_POST['idDiaAulaFFIndividual'];
    $justificaFalta = trim($_POST['justificaFalta']);

    if($justificaFalta){

        $DiaAulaFFIndividual->setIdDiaAulaFFIndividual($idDiaAulaFFIndividual);
        $DiaAulaFFIndividual->updateFieldDiaAulaFFIndividual("faltaJustificada",1);
        $DiaAulaFFIndividual->updateFieldDiaAulaFFIndividual("obsFaltaJustificada", $justificaFalta);

        // ENVIA JUSTIFICATIVA AO COORDENADOR
        $assunto = "Justificativa de Falta";
        $msg_base = "<p>Período: ".trim($_POST['periodo'])."</p>
            <p>Grupo: ".trim($_POST['nomeGrupo'])."</p>
            <p>Professor: ".trim($_POST['nomeProfessor'])."</p>
            <p>Aluno: ".trim($_POST['nomeAluno'])."</p>
            <p>Justificativa: <br><strong> $justificaFalta </strong></br></p>";

        //COMUNICA O GERENTE SOBRE A FINALIZAÇÃO DA FF
        $idPlanoAcaoGrupo = (int) $_POST['idPlanoAcaoGrupo'];
        $idFuncionario_gerente = $GerenteTem->selectGerenteTem_porGrupo($idPlanoAcaoGrupo);
        if ($idFuncionario_gerente) {
            //EMAIL
            $GerenteTem->setIdGgerenteTem($idFuncionario_gerente);
            $nome = $Funcionario->getNome($idFuncionario_gerente);
            $email = $Funcionario->getEmail($idFuncionario_gerente);
            $msg = $msg_base.$TextoEmailPadrao->getTexto("15");
            $paraQuem = array("nome" => $nome, "email" => $email);
            $paraQuem2 = array("nome" => $nome, "email" => 'envio@companhiadeidiomas.com.br');

            $rs = Uteis::enviarEmail($assunto, $msg, $paraQuem, "");
			$rs = Uteis::enviarEmail($assunto, $msg, $paraQuem2, "");
        }

        $arrayRetorno['elementoAtualizar'][0] = "#obscampo".$idDiaAulaFFIndividual;
        $arrayRetorno['valor2'][0] = "<br />".$justificaFalta;
        $arrayRetorno['mensagem'] = "Justificativa gravada com sucesso.";
    }else{
        $arrayRetorno['mensagem'] = "Digite uma justificativa";
    }
} elseif($_POST['acao']=="file"){
	
	/* formatos de imagem permitidos */
    $permitidos = array(".doc",".docx",".pdf",".jpeg",".jpg",".png",".gif");
    $pasta = CAMINHO_UP_ROOT."atestados/";
	
    if(isset($_POST)){
  //      Uteis::pr($_FILES);
		$nome_imagem = $_FILES['file']['name'];
        $tamanho_imagem = $_FILES['file']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem, "."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
             
            if($tamanho < 15120){ //se imagem for até 15MB envia
                
			  $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem				
              $tmp = $_FILES['file']['tmp_name']; //caminho temporário da imagem
                 
              /* se enviar a foto, insere o nome da foto no banco de dados */
							if( move_uploaded_file($tmp, $pasta.$nome_atual) ){
								
								$idDiaAulaFFIndividual = $_POST['atestadoDia'];
			
		$DiaAulaFFIndividual->setIdDiaAulaFFIndividual($idDiaAulaFFIndividual);
		
		$DiaAulaFFIndividual->updateFieldDiaAulaFFIndividual("faltaJustificada",1);		
		$DiaAulaFFIndividual->updateFieldDiaAulaFFIndividual("obs", $nome_atual);
								
		echo "		<a href=\"".CAMINHO_UP."/atestados/".$nome_atual."\" target=\"_blank\" ><img src=\"".CAMINHO_IMG."contrato.png\" title=\"Visualizar\" /></a>";
								$arrayRetorno['mensagem'] = "Sucesso.";
					
							}else{
									$arrayRetorno['mensagem'] = "Erro ao enviar o arquivo";
							}
            }else{
            	$arrayRetorno['mensagem'] = "Erro, arquivo muito grande (max. 15MB)";
            }
        }else{
        	$arrayRetorno['mensagem'] = "Erro, arquivo não suportado, escolha outro arquivo.";
        }
    }else{
    	$arrayRetorno['mensagem'] = "Selecione um arquivo";
    }

}
echo json_encode($arrayRetorno);