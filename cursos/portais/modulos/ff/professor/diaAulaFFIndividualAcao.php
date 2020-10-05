<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/professor.php");

$DiaAulaFF = new DiaAulaFF();
$DiaAulaFFIndividual = new DiaAulaFFIndividual();
$IntegranteGrupo = new IntegranteGrupo();

$arrayRetorno = array();

$nomeCampo = $_REQUEST['nomeCampo'];

$idDiaAulaFFIndividual = $_REQUEST['idDiaAulaFFIndividual_'.$nomeCampo];

$DiaAulaFFIndividual->setIdDiaAulaFFIndividual($idDiaAulaFFIndividual);

if($_POST['acao']=="deletar"){


}elseif($_POST['acao']=="justificaFalta"){
	
	$idDiaAulaFFIndividual = $_POST['idDiaAulaFFIndividual'];
	$justificaFalta = trim($_POST['justificaFalta']);
	
	if($justificaFalta){
		
		$DiaAulaFFIndividual->setIdDiaAulaFFIndividual($idDiaAulaFFIndividual);
		
		$DiaAulaFFIndividual->updateFieldDiaAulaFFIndividual("faltaJustificada",1);		
		$DiaAulaFFIndividual->updateFieldDiaAulaFFIndividual("obsFaltaJustificada", $justificaFalta);
		
		$arrayRetorno['elementoAtualizar'][0] = "#div_falta_".$nomeCampo;
		
		$arrayRetorno['valor2'][0] = "&nbsp;&nbsp;
		<img src=\"".CAMINHO_IMG."pa.png\" title=\"Falta justificada:\n".$justificaFalta."\" 
		onclick=\"justificaFalta('".$idDiaAulaFFIndividual."', '".$nomeCampo."', '".$justificaFalta."')\" />		
		&nbsp;&nbsp;<img src=\"".CAMINHO_IMG."excluir.png\" title=\"Excluir justificativa\" 
		onclick=\"excluiJustificativa('".$idDiaAulaFFIndividual."', '".$nomeCampo."')\" />";
				
		$arrayRetorno['mensagem'] = "Justificativa gravada com sucesso.";
		
	}else{
		$arrayRetorno['mensagem'] = "Digite uma justificativa";
	}

}elseif($_POST['acao']=="excluiJustificativa"){
	
	$idDiaAulaFFIndividual = $_POST['idDiaAulaFFIndividual'];
	$DiaAulaFFIndividual->setIdDiaAulaFFIndividual($idDiaAulaFFIndividual);
	$DiaAulaFFIndividual->updateFieldDiaAulaFFIndividual("faltaJustificada",0);
	$DiaAulaFFIndividual->updateFieldDiaAulaFFIndividual("obsFaltaJustificada","");
	$DiaAulaFFIndividual->updateFieldDiaAulaFFIndividual("obs","");
	
	$arrayRetorno['elementoAtualizar'][0] = "#div_falta_".$nomeCampo;
	$arrayRetorno['valor2'][0] = "&nbsp;&nbsp;<img src=\"".CAMINHO_IMG."pa.png\" title=\"Justificar falta\" 
	onclick=\"justificaFalta('".$idDiaAulaFFIndividual."', '".$nomeCampo."')\" />";
	
	$arrayRetorno['mensagem'] = "Justificativa excluida com sucesso.";
	
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
								
						//		$arrayRetorno['elementoAtualizar'][0] = "visualizarFile_".$idDiaAulaFFIndividual; // $_POST['destino'];
						//		$arrayRetorno['valor2'][0] = "
						echo "		<a href=\"".CAMINHO_UP."/atestados/".$nome_atual."\" target=\"_blank\" >
								<img src=\"".CAMINHO_IMG."contrato.png\" title=\"Visualizar\" /></a>";
								
//								<input name=\"anexo\" type=\"hidden\" value=\"".$nome_atual."\" />"; //imprime na tela		
									
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

} else{
	
	$idDiaAulaFF = $_POST['idDiaAulaFF_'.$nomeCampo];
	$idIntegranteGrupo = $_POST['idIntegranteGrupo_'.$nomeCampo];
	
	$nomeAluno = $IntegranteGrupo->getNomePF($idIntegranteGrupo, true);
	$diaAulaExibir = Uteis::exibirData($_POST['diaAulaExibir_'.$nomeCampo]);
	
	$horaRealizadaAluno = Uteis::gravarHoras($_POST['horaRealizadaAluno_'.$nomeCampo]);
	$horasTotal = $_POST['horasTotal_'.$nomeCampo];
	$difHoras =  $horasTotal - $horaRealizadaAluno;
	
	if($difHoras < 0){
		$arrayRetorno['mensagem'] = "Horas dadas não podem ser maiores que ".Uteis::exibirHoras($horasTotal);		
	}else{
		
		$DiaAulaFFIndividual->setDiaAulaFFIdDiaAulaFF($idDiaAulaFF);
		$DiaAulaFFIndividual->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
		$DiaAulaFFIndividual->setHoraRealizadaAluno($horaRealizadaAluno);
		
		if($idDiaAulaFFIndividual){			
		
			if($difHoras == 0){	
				$DiaAulaFFIndividual->updateFieldDiaAulaFFIndividual("faltaJustificada",0);
				$DiaAulaFFIndividual->updateFieldDiaAulaFFIndividual("obsFaltaJustificada","");
			}
					
			$DiaAulaFFIndividual->updateDiaAulaFFIndividual();
			
		}else{		
								
			$idDiaAulaFFIndividual = $DiaAulaFFIndividual->addDiaAulaFFIndividual();						
			$arrayRetorno['valor'][0] = $idDiaAulaFFIndividual;
			$arrayRetorno['campoAtualizar'][0] = "#idDiaAulaFFIndividual_".$nomeCampo;		
								
		}
			
		if($difHoras > 0){						
			$arrayRetorno['valor2'][0] = "&nbsp;&nbsp;
			<img src=\"".CAMINHO_IMG."pa.png\" title=\"Justificar falta\" 
			onclick=\"justificaFalta('".$idDiaAulaFFIndividual."', '".$nomeCampo."')\" />";		
		}else{		
			$arrayRetorno['valor2'][0] = "";
		}			
		
		$arrayRetorno['elementoAtualizar'][0] = "#div_falta_".$nomeCampo;
		
		$arrayRetorno['mensagem'] = "Horas gravadas com sucesso.";
	}
	
	$arrayRetorno['mensagem'] .= "<br /><small>($diaAulaExibir - $nomeAluno)</small>";
	
}

echo json_encode($arrayRetorno);

?>
