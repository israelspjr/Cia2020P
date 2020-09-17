<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
require_once("OmieAppAuth.php"); 
require('LancamentoContaReceberSoapClient.php');

$ClientePf = new ClientePf();
$documento = $ClientePf->getDocumentoUnico($_SESSION['idClientePf_SS']);

if ($documento != '') {
try { 
  $sc = new LancamentoContaReceberSoapClient(); 
 
  $chave = array(
//  array(  
  "pagina" => 1,  
  "registros_por_pagina" => 100,  
  "apenas_importado_api" => "N",
  "filtrar_por_cpf_cnpj" => "$documento"  
//	)
  );
          
  $ret = $sc->ListarContasReceber($chave); 
    
  $array1 = json_decode(json_encode($ret), true);
   
  if ($array1['total_de_registros'] == 0) {
	$texto = "Nenhum boleto encontrado!";  
  } else {
	$texto = "";  
  }
  
  foreach ($array1 as $valor) {
	  for($x=0;$x<count($valor);$x++) {
		  if ($valor[$x]['data_vencimento'] != '') {
		 	 if ($valor[$x]['status_titulo'] != 'RECEBIDO') {
		  echo "<br><div><p>".$valor[$x]['data_vencimento']."- Status: <span style=\"color:red\">".$valor[$x]['status_titulo']."- Valor: R$ ".Uteis::formatarMoeda($valor[$x]['valor_documento'])."</span><br>Código de barras:<br><span style=\"font-size:20px;font-weight:bold;\">".$valor[$x]['codigo_barras_ficha_compensacao']."</p></div>";
			  } else {
		echo "<div>".$valor[$x]['data_vencimento']."- Status: <span style=\"color:green\">".$valor[$x]['status_titulo']." - Valor: R$ ".Uteis::formatarMoeda($valor[$x]['valor_documento'])."</span></div>";	  
			  }
		  }
	//	Uteis::pr($valor[$x]);  
		  
	  }
//	var_dump($valor);  
	  
  }
 
} catch (SoapFault $e) { 
  print "Ocorreu um erro no processamento: " . $e->faultstring . "\n"; 
  @print_r($e->detail); 
} 
}

echo $texto;