o<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

//$Candidato_precadastro = new Candidato_precadastro();

$arrayRetorno = array();
$EmailsMkt = new EmailsMkt();
$Segmento = new Segmento();
$Funcionario = new Funcionario();

$NovoCadastro = $_REQUEST['pre_cadastro'];

function validaEmail($mail){
	if(preg_match("/^([[:alnum:]_.-]){2,}@([[:lower:][:digit:]_.-]{3,})(.[[:lower:]]{2,3})(.[[:lower:]]{2})?$/", $mail)) {
		return true;
	}else{
		return false;
	}
}

if ($_REQUEST['acao'] == 'cadastrar') {


  $pasta = "candidato_csv";
  $upload = Uteis::uploadFile($_FILES, "csvFile", array(".csv"), $pasta);

  if ( !$upload[0] ) {
    $arrayRetorno['mensagem'] = $upload[1];
  
  } else {
	  
/*	 function validaemail($email){
	//verifica se e-mail esta no formato correto de escrita
	if (!ereg('^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})',$email)){
		$mensagem='E-mail Inv&aacute;lido!';
		return $mensagem;
    }
 /*   else{
		//Valida o dominio
		$dominio=explode('@',$email);
		if(!checkdnsrr($dominio[1],'A')){
			$mensagem='E-mail Inv&aacute;lido!';
			return $mensagem;
		}*/
	//	else{return true;} // Retorno true para indicar que o e-mail é valido
//		}
//	 }
    
   date_default_timezone_set('America/Sao_Paulo');
	  
	
    $cont = 0;
	$emailInvalido = 0;
	$emailInserido = 0;
	$emailRepetido = 0;
//    $nomeArquivo = CAM_UP_ROOT . $pasta . "/" . $upload[1];
	$nomeArquivo = $pasta = CAMINHO_UP_ROOT."arquivo/contrato/emails/". $upload[1];
    $arquivo = fopen($nomeArquivo, "r");
	$emailI = "";
     
    while (($linha = fgetcsv($arquivo, 1000, ";")) !== FALSE) {
      $emailT = ltrim($linha[0]);
	  $email = strtolower($emailT);
	  
	  if ($email != '') {
		  
		  $pos      = strripos($email, "@");
		  
		  
		  if ($pos == true) {
			  
			  $rs =  validaEmail($email);

				if ($rs == false) {
			  
//			  if (!ereg('^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})',$email)){
				$emailInvalido++;  
				$emailI .= $email."<br>";
	
			  } else {
		  
	//	  $rs = validaEmail($email);
  
//		  if ($rs == true) {
		  
		  
	    $EmailsMkt->setNome($nome);
		$EmailsMkt->setValor($email);
		$EmailsMkt->setClientePjIdClientePj($_POST['clientePj']);	
		$EmailsMkt->setInativo($_POST['inativo']);
		$EmailsMkt->setSegmentoIdSegmento($_POST['segmento']);	
		
		$idEmailsMkt = $EmailsMkt->addEmailsMkt();
	//	echo $idEmailsMkt;
		if ($idEmailsMkt == 0) {
			$emailRepetido++;
		} else {
			$emailInserido++;
		}
			  }
	
	  		} else {
			$emailInvalido++;	
				
			}
	  	}
				
			$arrayRetorno['mensagem'] = MSG_CADNEW ."  ".$nome;

	}
	
  }
  
  			$assunto = "Resultado da importação de emails no sistema Cursos!";
			
			$msg .= "<p> Email(s) inserido(s): ". $emailInserido."</p><hr>";
			$msg .= "<p> Email(s) repetido(s): ". $emailRepetido."<br>".$emailR."</p><hr>";
			$msg .= "<p> Email(s) inválido(s): ". $emailInvalido."<br>".$emailI."</p>";
			$msg .= "<p> Segmento escolhido: ".$nomeSegmento."</p>";
			$total = $emailInserido + $emailRepetido;
			$total += $emailInvalido;
			$msg .= "<p>Total: ".$total."</p>";
			
//			echo $assunto;
//			echo $msg;

			$id = $_SESSION['idFuncionario_SS'];
			$emailG = $Funcionario->getEmail($id); 
    		$nome = $_SESSION['nome_SS'];
			
			$paraQuem1 = array("email" => $emailG, "nome" => $nome);
		    $rs1 = Uteis::enviarEmail($assunto, $msg, $paraQuem1);
			
			$arrayRetorno['fecharNivel'] = true;
	
	echo json_encode($arrayRetorno);
  } else {
	  
	$texto =  trim($_REQUEST['texto']);
	$idSegmento = $_REQUEST['id'];
	
	$textAr = explode("\n", $texto);
	$textAr = array_filter($textAr, 'trim');
	$emailI = "";
	foreach ($textAr as $email) {
	 if ($email != '') {
		  
		  $pos      = strripos($email, "@");
		  
		  
		  if ($pos == true) {
			  
$rs =  validaEmail($email);

if ($rs == false) {
			  
	//		  if (!ereg('^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})',$email)){
				$emailInvalido++;  
				$emailI .= $email."<br>";
	
			  } else {
		  
	//	  $rs = validaEmail($email);
  
//		  if ($rs == true) {
		  
		  
	    $EmailsMkt->setNome($nome);
		$EmailsMkt->setValor($email);
		$EmailsMkt->setClientePjIdClientePj($_POST['clientePj']);	
		$EmailsMkt->setInativo($_POST['inativo']);
		$EmailsMkt->setSegmentoIdSegmento($idSegmento);	
		
		$idEmailsMkt = $EmailsMkt->addEmailsMkt();
	//	echo $idEmailsMkt;
		if ($idEmailsMkt == 0) {
			$emailRepetido++;
		} else {
			$emailInserido++;
		}
			  }
	
	  		} else {
			$emailInvalido++;	
				
			}
	  	}
				
			$arrayRetorno['mensagem'] = MSG_CADNEW ."  ".$nome;

	}
	
  
  
  			$assunto = "Resultado da importação de emails no sistema Cursos!";
			
			$msg .= "<p> Email(s) inserido(s): ". $emailInserido."</p><hr>";
			$msg .= "<p> Email(s) repetido(s): ". $emailRepetido."<br>".$emailR."</p><hr>";
			$msg .= "<p> Email(s) inválido(s): ". $emailInvalido."<br>".$emailI."</p>";
			$msg .= "<p> Segmento escolhido: ".$Segmento->getNome($idSegmento)."</p>";
			$total = $emailInserido + $emailRepetido;
			$total += $emailInvalido;
			$msg .= "<p>Total: ".$total."</p>";
			
//			echo $assunto;
			echo "<div class=\"linha-inteira\">".$msg."</div>";
			
			$id = $_SESSION['idFuncionario_SS'];
			$emailG = $Funcionario->getEmail($id); 
			$nome = $_SESSION['nome_SS'];
			
			$paraQuem1 = array("email" => $emailG, "nome" => $nome);
		    $rs1 = Uteis::enviarEmail($assunto, $msg, $paraQuem1);
 // 	$arrayRetorno['fecharNivel'] = true;
	
//	echo json_encode($arrayRetorno);			

  }