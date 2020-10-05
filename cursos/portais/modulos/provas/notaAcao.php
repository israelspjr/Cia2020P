<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$ItemCalendarioProva = new ItemCalendarioProva();
$IntegranteGrupo = new IntegranteGrupo();
$ItenProva = new ItenProva();
$CalendarioProva = new CalendarioProva();

$arrayRetorno = array();

$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];

if($_POST['acao']=="deletar"){
	
/*	$arrayRetorno['mensagem'] = "Item CalendarioProva deletado com sucesso";
	
	
	$id = $_REQUEST['id'];
	$ItemCalendarioProva->setIdItemCalendarioProva($id);
	$ItemCalendarioProva->deleteContrato();*/


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

//    $Copia = array("nome" => 'Companhia de Idiomas', "email" => 'envio@companhiadeidiomas.com.br');
    $paraQuem = array("nome" => $nome, "email" => $email);
 //   $paraQuem1 = array("nome" => $nome, "email" => $email);

    Uteis::enviarEmail($assunto, $html, $paraQuem, "", $Copia, "");
 //   Uteis::enviarEmail($assunto, $html, $paraQuem1, "", "", "");
	

}elseif($_POST['acao']=="upload"){
	
	/* formatos de imagem permitidos */
    $permitidos = array(".doc",".docx",".pdf",".jpeg",".jpg",".png",".gif");
    $pasta = CAMINHO_UP_ROOT."anexonota/";
	
    if(isset($_POST)){
        
		$nome_imagem = $_FILES['file']['name'];
        $tamanho_imagem = $_FILES['file']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem, "."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
             
            if($tamanho < 102400){ //se imagem for até 10MB envia
                
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
                $arrayRetorno['mensagem'] = "Erro, arquivo muito grande (max. 100MB)";
            }
        }else{
            $arrayRetorno['mensagem'] = "Erro, arquivo não suportado, escolha outro arquivo.";
        }
    }else{
        $arrayRetorno['mensagem'] = "Selecione um arquivo";
    }

}else{
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
	
    $nota = $_REQUEST['nota'];
	if ((!empty($nota)) || ($nota != '')) {
		if ($nota == 0) {
		$nota = "0,0";	
	}
		$nota = Uteis::gravarMoeda($nota);
	}
     $data = Uteis::gravarData($_REQUEST['data']);
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
//	$arrayRetorno['ondeAtualizar'] = "#div_ff_geral";
//	$arrayRetorno['pagina'] = "modulos/ff/form/folhaFrequencia.php?idFolhaFrequencia=".$idFolhaFrequencia;	
//	$arrayRetorno['fecharNivel'] = true;

echo json_encode($arrayRetorno);

?>