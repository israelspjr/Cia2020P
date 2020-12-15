<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DisparoEmail = new DisparoEmail();
$EnderecoVirtual = new EnderecoVirtual();
$IntegrantePlanoAcao = new IntegrantePlanoAcao();
$ClientePf = new ClientePf();
$Contato = new ContatoAdicional();
$PlanoAcao = new PlanoAcao();
$Configuracoes = new Configuracoes();

$idPlanoAcao = $_REQUEST['idPlanoAcao'];
$PlanoAcao->setIdPlanoAcao($idPlanoAcao);

$conteudo = $_POST['conteudoEmailAdd'];

$config = $Configuracoes->selectConfig();
	
$style = '<script>	
.folha{
	font-family:Arial, Helvetica, sans-serif;
	-webkit-print-color-adjust: exact; /*IMPRIMIR COM CORES NO CHROME*/
	padding:1em;
	border: thin solid #cccccc; 
	width: 800px;
	margin: auto;
	margin-top:5px;
}

.folha p{
	border-bottom: #E9E9E9 thin solid;
}

.folha .titulo{
	background-color: rgb(226, 226, 226);
	text-align: center;
	padding: 2px;
	text-transform: uppercase;
	font-weight: bold;
}

.folha .subTitulo{
	background-color: #D2E6FF;
	padding: 1px;
	font-weight: bold;
}

.folha .importante{
	background-color: #FFCBCB;
	padding: 1px;	
	display: table;
}	
</script>';
	
$assunto = "Plano de Ação:". $idPlanoAcao;  //";$_POST['assunto'];
$cc = $_POST['copia'];
$bcc = $_POST['copiaOculta'];
$arquivo = "";//sem arquivo por enqunto

$copia = array();
$bcopia = array();

for($i=0;$i<count($cc);$i++){
$copia[] = array('nome' => $cc[$i], 'email'=> $cc[$i]);
}

for($i=0;$i<count($bcc);$i++){
$bcopia[] = array('nome' => $cc[$i], 'email' => $cc[$i]);
}

$DisparoEmail->setPlanoAcaoIdPlanoAcao($idPlanoAcao);
$DisparoEmail->setCopia(implode(',', $cc));
$DisparoEmail->setCopiaOculta(implode(',', $bcc));
$DisparoEmail->setAssunto($assunto);
$DisparoEmail->setAnexo($arquivo);
		
$temEmailSelecionado = false;
	
if( $_POST['check_disparoEmail_integrantePlanoAcao']) {
	
	$temEmailSelecionado = true;
	
	foreach($_POST['check_disparoEmail_integrantePlanoAcao'] as $id){
		
		//CARREGA LINK    
        $valorIntegrantePlanoAcao = $IntegrantePlanoAcao->selectIntegrantePlanoAcao(" WHERE idIntegrantePlanoAcao = ".$id);
        $linkVisualizacao = $valorIntegrantePlanoAcao[0]['linkVisualizacao'];
        $idClientePf = $valorIntegrantePlanoAcao[0]['clientePf_idClientePf'];
		$conteudo2 = "<a href='https://".$config[0]['site']."/cursos/planoAcao/index.php?".$linkVisualizacao."\"' target=\"_blank\"'>Visualizar no navegador</a>";
		$conteudo3 ='<div style="width:70%;text-align:center;margin-right:auto;margin-left:auto;font-size:16px;font-weight:bold;">"Declaro que li e estou de acordo com todas as informações e regras contidas neste Plano de Ação": ';
		$conteudo3 .= '<a href="https://'.$config[0]['site'].'/cursos/planoAcao/aceito.php?idPlanoAcao='.$idPlanoAcao.'&area=3&integrante='.$id.'><button class=\"button blue\">Aceito </button></a><br></div>';
		
        $conteudo_final = $PlanoAcao->ImprimePlanoAcao(3, $id); //file_get_contents("https://".CAMINHO_VER_PA."index.php?".$linkVisualizacao);       
        $conteudoLink =  $style. "<br>".$conteudo2.$conteudo3."<br />".$conteudo. "<br />".$conteudo_final.$conteudo3;   
		$conteudoLink2 =  $conteudo2.$conteudo3."<br />".$conteudo. "<br />".$conteudo_final.$conteudo3;  
        
   //     $assunto = "Plano de ação número ".$idPlanoAcao;
        $email = $ClientePf->getEmail($idClientePf);
        $nome = $ClientePf->getNome($idClientePf);
                
     //   $paraQuem = array();
        $paraQuem = array("nome" => $nome, "email" => $email);                                        
        
        //GRAVA DISPARO             
        $DisparoEmail->setDestino($email);      
     //   $DisparoEmail->setConteudoEmail($conteudoLink2);                                 
        $DisparoEmail->addDisparoEmail();               
        $ver = Uteis::enviarEmail($assunto, $conteudoLink, $paraQuem, "", $copia, $bcopia);
	
	}
}

if( $_POST['check_disparoEmail_contatoAdd']) {
    
  $temEmailSelecionado = true;    
    foreach($_POST['check_disparoEmail_contatoAdd'] as $idContatoAdicional){
            
        //CARREGA LINK    
        $valorIntegrantePlanoAcao = $IntegrantePlanoAcao->selectIntegrantePlanoAcao(" WHERE idIntegrantePlanoAcao = ".$id);
        $linkVisualizacao = $valorIntegrantePlanoAcao[0]['linkVisualizacao'];
        $idClientePf = $valorIntegrantePlanoAcao[0]['clientePf_idClientePf'];    
		$conteudo2 = "<a href='https://".$config[0]['site']."/cursos/planoAcao/index.php?".$linkVisualizacao."\"' target=\"_blank\"'>Visualizar no navegador</a>";    
			$conteudo3 ='<div style="width:70%;text-align:center;margin-right:auto;margin-left:auto;font-size:16px;font-weight:bold;">"Declaro que li e estou de acordo com todas as informações e regras contidas neste Plano de Ação": <a href=\'https://'.$config[0]['site'].'/cursos/planoAcao/aceito.php?idPlanoAcao='.$idPlanoAcao.'&area=3&integrante='.$id.'><button class=\"button blue\">Aceito </button></a><br></div>';
		
        $conteudo_final = $PlanoAcao->ImprimePlanoAcao(3, $id); //file_get_contents("https://".CAMINHO_VER_PA."index.php?".$linkVisualizacao);       
        $conteudoLink =  $style. "<br>".$conteudo2.$conteudo3."<br />".$conteudo. "<br />".$conteudo_final.$conteudo3;   
	//	$conteudoLink2 =  $conteudo2.$conteudo3."<br />".$conteudo. "<br />".$conteudo_final.$conteudo3;  
                         
   //     $assunto = "Plano de ação número ".$idPlanoAcao;
        $email = $Contato->getEmail($idContatoAdicional);
        $nome = $Contato->getNome($idContatoAdicional);
                 
 //       $paraQuem = array();
        $paraQuem = array("nome" => $nome, "email" => $email);                                        
        
        //GRAVA DISPARO             
        $DisparoEmail->setDestino($email);      
   //     $DisparoEmail->setConteudoEmail($conteudoLink2);                                 
        $DisparoEmail->addDisparoEmail();               
        $ver = Uteis::enviarEmail($assunto, $conteudoLink, $paraQuem, "", $copia, $bcopia);        
    } 
}	
if(!$temEmailSelecionado){	
	$arrayRetorno['mensagem'] = "Nenhum e-mail foi selecionado.";
}else{
    if($ver==true){
	   $arrayRetorno['mensagem'] = "E-mail(os) enviado(s) com sucesso";
	   $arrayRetorno['fecharNivel'] = true;
    }else{
       $arrayRetorno['mensagem'] = $ver;
    }   
}

echo json_encode($arrayRetorno);	

?>