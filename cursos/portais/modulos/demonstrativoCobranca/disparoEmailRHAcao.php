<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$DisparoEmail = new DisparoEmail();
$ClientePf = new ClientePf();
$Contato = new ContatoAdicional();
$Aviso = new Aviso();	

   
$idClientePj = $_POST['idClientePj'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];
//$grupos = explode(',',$_POST['grupos']);


$conteudo = $_POST['conteudoEmailAdd'];

$cc = $_POST['copia'];
$bcc = $_POST['copiaOculta'];	
$assunto = $_POST['assunto'];
$arquivo = "";
$DisparoEmail->setCopia(implode(",",$cc));
$DisparoEmail->setCopiaOculta(implode(",",$bcc));
$copia = array();
$bcopia = array();

for($i=0;$i<count($cc);$i++){
$copia[] = array('nome' => $cc[$i], 'email'=> $cc[$i]);
}


for($i=0;$i<count($bcc);$i++){
$bcopia[] = array('nome' => $bcc[$i], 'email' => $bcc[$i]);
}

$arquivo = "";//sem arquivo por enqunto

$DisparoEmail->setClientePJ_idClientePj($idClientePj);
$DisparoEmail->setCopia($cc);
$DisparoEmail->setAssunto($assunto);
$DisparoEmail->setAnexo($arquivo);

$planoAcaoGrupo = new PlanoAcaoGrupo();
$GrupoClientePj =  new GrupoClientePj();
$g = new Grupo();

$valor = $GrupoClientePj->selectGrupoClientePj(" INNER JOIN
    grupo as G on G.idGrupo = GPJ.grupo_idGrupo
    where clientePj_idClientePj = " . $idClientePj . "
    AND G.inativo = 0");

    $dataReferencia = $ano."-".$mes."-01";
    $dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));
//	echo $dataReferenciaFinal;

 foreach ($valor as $valorG) {
	 
	  $idGrupo = $valorG['grupo_idGrupo']; 
	  
	  $sql2 = "SELECT  max(PAG.idPlanoAcaoGrupo) as idPlanoAcaoGrupo
							FROM
    					planoAcao AS P
        					INNER JOIN
    					planoAcaoGrupo PAG ON P.idPlanoAcao = PAG.planoAcao_idPlanoAcao
    						AND PAG.dataInicioEstagio <= '".$dataReferenciaFinal."'
        					INNER JOIN
    					grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
							WHERE
						G.idGrupo = ".$idGrupo;
						
	//					echo $sql2;
						
						$result2= Uteis::executarQuery($sql2);
				
		//		echo $sql2;
//				Uteis::pr($result2);
				

                $idPlanoAcaoGrupo = $result2[0]['idPlanoAcaoGrupo'];  
				
//	$gnome = $g->selectGrupo("WHERE idGrupo = ".$grupos[$i]);
    $demonstrativo .= file_get_contents("https://".CAMINHO_VER_DM."demonstratioEmail.php?p=".Uteis::base64_url_encode($idPlanoAcaoGrupo)."&m=".Uteis::base64_url_encode($mes)."&a=".Uteis::base64_url_encode($ano));
   $demonstrativo .= "<hr>";
   // $nomeG[$grupos[$i]] = $gnome[0]['nome'];
	 
//	$i++; 
 }


$temEmailSelecionado = false;

if( $_POST['check_disparoEmail_contatoAdd']) {
    
    $temEmailSelecionado = true;
    
    foreach($_POST['check_disparoEmail_contatoAdd'] as $idContatoAdicional){
        
        //CARREGA LINK  
        $email = $Contato->getEmail($idContatoAdicional);
        $nome = $Contato->getNome($idContatoAdicional);
        
     //   $paraQuem = array();
        $paraQuem = array("nome" => $nome, "email" => $email);
	//	$paraQuem1 = array("nome" => "Envio", "email" => "envio@companhiadeidiomas.com.br");
        
   /*     for($i=0;$i<count($grupos);$i++):
         $conteudo = $conteudo."<hr>Grupo:".$nomeG[$grupos[$i]];
         $conteudo =   $conteudo.$demonstrativo[$grupos[$i]]; 
        endfor;
     */   
      $conteudo_final = $demonstrativo;
        
        //GRAVA DISPARO             
        $DisparoEmail->setDestino( implode(",", $emails) );     
        $DisparoEmail->setConteudoEmail($conteudo_final);                                   
        $DisparoEmail->addDisparoEmail();                       
        
        Uteis::enviarEmail($assunto, $conteudo_final, $paraQuem, $arquivo, $copia, $bcopia); 
	//	Uteis::enviarEmail($assunto, $conteudo_final, $paraQuem1, $arquivo, $copia, $bcopia);   
		
		// Envia as cópias
		foreach ($copia as $copiaE) {
			 $paraQuem = array("nome" => $copiaE['nome'], "email" => $copiaE['email']);
			 
			  Uteis::enviarEmail($assunto, $conteudo_final, $paraQuem, $arquivo, $copia, $bcopia);
		}
    
	
		foreach ($bcopia as $bcopiaE) {
			 $paraQuem = array("nome" => $bcopiaE['nome'], "email" => $bcopiaE['email']);
			 
			  Uteis::enviarEmail($assunto, $conteudo_final, $paraQuem, $arquivo, $copia, $bcopia);
		}
    
    }

}

if(!$temEmailSelecionado){	
	$arrayRetorno['mensagem'] = "Nenhum e-mail foi selecionado.";
}else{
    $paraQuem = Uteis::aviso_porSetor("3");
    $msg = $conteudo_final;
    Uteis::enviarEmail("Demonstrativo Enviado", $msg, $paraQuem, "");
	$arrayRetorno['mensagem'] = "E-mail(os) enviado(s) com sucesso<br />";
//	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);	

?>