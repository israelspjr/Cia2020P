<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ItemCalendarioProva = new ItemCalendarioProva();
$IntegranteGrupo = new IntegranteGrupo();
$ItenProva = new ItenProva();
$grupo = new Grupo();
$GerenteTem = new GerenteTem();
$Gerente = new Funcionario();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$professor = new Professor();
$CalendarioProva = new CalendarioProva();

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
	//$arrayRetorno['mensagem'] = "Item CalendarioProva deletado com sucesso";
//	$id = $_REQUEST['id'];
//	$ItemCalendarioProva->setIdItemCalendarioProva($id);
//	$ItemCalendarioProva->deleteContrato();

}elseif($_GET['acao']=="email"){
    $data =  $_GET['data'];
    $idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];
    $idProfessor = $_GET['idProfessor'];

    $nomeGrupo =  $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);
    $professor = $professor->getNome($idProfessor);
    $idGerente = $GerenteTem->selectGerenteTem_porGrupo($idPlanoAcaoGrupo);
    $email = $Gerente->getEmail($idGerente);
    $nome = $Gerente->getNome($idGerente);
    // Gera html
    $html =  "<br><br>O professor(a) <b>$professor</b> lançou todas as notas do grupo <b>$nomeGrupo</b> do mês <b>$data</b>.";

    $assunto = "Notas Lançadas";

    $Copia = array("nome" => 'Companhia de Idiomas', "email" => 'envio@companhiadeidiomas.com.br');
    $paraQuem = array("nome" => $nome, "email" => $email);
 //   $paraQuem1 = array("nome" => 'Kelly', "email" => 'kelly@companhiadeidiomas.com.br');

    Uteis::enviarEmail($assunto, $html, $paraQuem, "", $Copia, "");
//	Uteis::enviarEmail($assunto, $html, $paraQuem1, "", "", "");

}elseif($_POST['acao']=="upload"){
	
	/* formatos de imagem permitidos */
    $permitidos = array(".doc",".docx",".pdf",".jpeg",".jpg",".png",".gif");
    $pasta = CAMINHO_UP_ROOT."anexonota/";
	
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
								
								$arrayRetorno['elementoAtualizar'][0] = $_POST['destino'];
								$arrayRetorno['valor2'][0] = "
								<a href=\"".CAMINHO_UP."/anexonota/".$nome_atual."\" target=\"_blank\" >
								<img src=\"".CAMINHO_IMG."contrato.png\" title=\"Visualizar\" /></a>
								
								<input name=\"anexo\" type=\"hidden\" value=\"".$nome_atual."\" />"; //imprime na tela					
								
								$arrayRetorno['mensagem'] = "Carregado com sucesso.";
					
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

}else{
	$nota = $_REQUEST['nota'];
	$idItemCalendarioProva = $_REQUEST['idItemCalendarioProva'];
	$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
	$idCalendarioProva = $_REQUEST['idCalendarioProva'];
	$idItenProva = $_REQUEST['idItenProva'];
	$data = Uteis::gravarData($_REQUEST['data']);
	
	$valorProva = $CalendarioProva->selectCalendarioProva(" WHERE idCalendarioProva = ".$idCalendarioProva);
	
	$dataAplicada = $valorProva[0]['dataAplicacao'];
	
	if ($dataAplicada == '') {
		$CalendarioProva->setIdCalendarioProva($idCalendarioProva);
		$CalendarioProva->updateFieldCalendarioProva("dataAplicacao", $data);
	}
	
	
	$obs = ( $_POST['obs'] == "1" ? 1 : 0);
	

	if ((!empty($nota)) || ($nota != '')) {
		if ($nota == 0) {
		$nota = "0,0";	
	} else {
		$nota = Uteis::gravarMoeda($nota);
		}
	}
  
	
	$anexo = $_REQUEST['anexo'];
	$idProfessor = $_REQUEST['idProfessor'];
	
	$obsMsg = "<br /><small>".$IntegranteGrupo->getNomePF($idIntegranteGrupo)." - ".$ItenProva->getNome($idItenProva)."</small>";
	
	
	if(isset($_REQUEST['nota'])){
	    	    
        $ItemCalendarioProva->setIdItemCalendarioProva($idItemCalendarioProva);
        $ItemCalendarioProva->setCalendarioProvaIdCalendarioProva($idCalendarioProva);
        $ItemCalendarioProva->setItenProvaIdItenProva($idItenProva);
        $ItemCalendarioProva->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
        $ItemCalendarioProva->setNota($nota);
        $ItemCalendarioProva->setData($data);
        $ItemCalendarioProva->setAnexo($anexo);
        $ItemCalendarioProva->setProfessorIdProfessor($idProfessor);
    	$ItemCalendarioProva->setObs($obs);
	
        if($idItemCalendarioProva != "" && $idItemCalendarioProva > 0 ){            
            $ItemCalendarioProva->updateItemCalendarioProva();            
        }else{            
            $idItemCalendarioProva = $ItemCalendarioProva->addItemCalendarioProva();                        
            $arrayRetorno['campoAtualizar'][0]="#idItemCalendarioProva".$idItenProva."_".$idIntegranteGrupo;
            $arrayRetorno['valor'][0] = $idItemCalendarioProva ;
        }   
        
        $arrayRetorno['mensagem'] = "Nota gravada com sucesso";
	    
	}else{
	
	if(!(is_numeric($nota))){
		
		$arrayRetorno['mensagem'] = "Por favor digite uma nota em forma de numeros";
		
	}elseif($nota < 0 || $nota > 10){
		
		$arrayRetorno['mensagem'] = "A nota tem que estar entre 0 e 10";
		
	}else{
		
		$ItemCalendarioProva->setIdItemCalendarioProva($idItemCalendarioProva);
		$ItemCalendarioProva->setCalendarioProvaIdCalendarioProva($idCalendarioProva);
		$ItemCalendarioProva->setItenProvaIdItenProva($idItenProva);
		$ItemCalendarioProva->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
		$ItemCalendarioProva->setNota($nota);
        $ItemCalendarioProva->setData($data);
		$ItemCalendarioProva->setAnexo($anexo);
		$ItemCalendarioProva->setProfessorIdProfessor($idProfessor);
		$ItemCalendarioProva->setObs($obs);
	
		if($idItemCalendarioProva != "" && $idItemCalendarioProva > 0 ){
			
			$ItemCalendarioProva->updateItemCalendarioProva();
			
		}else{
			
			$idItemCalendarioProva = $ItemCalendarioProva->addItemCalendarioProva();						
			$arrayRetorno['campoAtualizar'][0]="#idItemCalendarioProva".$idItenProva."_".$idIntegranteGrupo;
			$arrayRetorno['valor'][0] = $idItemCalendarioProva ;
		}	
		
		$arrayRetorno['mensagem'] = "Nota gravada com sucesso";
			
	}
}
		
	$arrayRetorno['mensagem'] .= $obsMsg;
	
}


echo json_encode($arrayRetorno);
