<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DisparoEmail = new DisparoEmail();
$CampanhaEmail = new CampanhaEmail();
$Funcionario = new Funcionario();
$CampanhaLista = new CampanhaLista();
$EmailsMkt = new EmailsMkt();

$idCampanhaEmail = $_REQUEST['idCampanhaEmail'];

if($idCampanhaEmail!='' && $idCampanhaEmail>0){
	
	$valorCampanhaEmail = $CampanhaEmail->selectCampanhaEmail('WHERE idCampanhaEmail='.$idCampanhaEmail);
	$assunto = $valorCampanhaEmail[0]['assunto'];
	$conteudo_final = $valorCampanhaEmail[0]['texto'];
	$from = $valorCampanhaEmail[0]['nomeEnvio'];
	$emailEnvio = $valorCampanhaEmail[0]['emailEnvio'];
}

//Uteis::pr($valorCampanhaEmail);

if( $_REQUEST['acao'] == "disparar") {
	
		$listas = $CampanhaLista->selectCampanhaLista(" WHERE campanha_idCampanha = ".$idCampanhaEmail);
			
		for($x=0;$x<=count($listas);$x++) {
			
			$link = "";
			
			$valores = $EmailsMkt->selectEmailsMkt(" WHERE segmento_idSegmento = ".$listas[$x]['lista_idLista']." AND inativo = 0");
			
			foreach ($valores as $valor) {
				
				$link = "";
			
			$nome = $valor['valor'];
			$email = $valor['valor'];
			
			$link = "<div style=\"center;text-align:center;border-top:1px solid gray\"><p><a href=\"https://www.companhiadeidiomas.net/cursos/admin/modulos/relacionamento/campanhaEmail/sair.php?email=".$email."&idsegmento=".$listas[$x]['lista_idLista']."\">Clique aqui</a> para sair da lista</p></div>";
			
			$conteudo_final2 = $conteudo_final . $link;
			
		$paraQuem = array("nome" => $nome, "email" => $email);
				
		Uteis::msleep(.2);
		
		Uteis::enviarEmail($assunto, $conteudo_final2, $paraQuem, "", "", "", 1, $from, $emailEnvio); 
		
				//GRAVA DISPARO				
		$DisparoEmail->setDestino($email);		
		$DisparoEmail->setConteudoEmail($assunto);
		$DisparoEmail->setCampanhaEmailIdCampanhaEmail($idCampanhaEmail);									
		$DisparoEmail->addDisparoEmail();
			
			}
        		
		}
}
	

	$arrayRetorno['mensagem'] = "E-mail(os) enviado(s) com sucesso<br />";
	$arrayRetorno['fecharNivel'] = true;

	
echo json_encode($arrayRetorno);	

?>