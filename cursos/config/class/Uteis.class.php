<?php
error_reporting(E_ALL);
class Uteis {

  function __construct() {
  }

  function __destruct() {
  }

  //EMAIL PARA FUNCIONARIO RESPONSAVEL DO SETOR
  static function aviso_porSetor($idSetor = "") {
        
    //3 = FINANCEIRO
    //4 = PSA

    $paraQuem = array();

    if ($idSetor != "" && is_numeric($idSetor)) {

      //$Aviso = new Aviso();
      $Funcionario = new Funcionario();
      $FuncionarioSetor = new FuncionarioSetor();

      $rs = $FuncionarioSetor -> selectFuncionarioSetor(" WHERE setor_idSetor = $idSetor");
      foreach ($rs as $valor) {

        $nome = $Funcionario -> getNome($valor['funcionario_idFuncionario']);
        $email = $Funcionario -> getEmail($valor['funcionario_idFuncionario']);
        $paraQuem[] = array("nome" => $nome, "email" => $email);

      }
    }

    return $paraQuem;
  }

  //ENVIAR E-MAIL
  static function enviarEmail($assunto = "", $mensagem = "", $paraQuem = array(), $arquivos = array(), $copia = array(), $bcopia = array(), $emailMkt, $from = '', $reply = '') {
	
	require_once 'mailer/class.phpmailer.php';
	require_once 'mailer/class.smtp.php';
	  
	$Configuracoes = new Configuracoes();
	$config = $Configuracoes->selectConfig();
	
	date_default_timezone_set('Etc/UTC');
	
    $mailer = new PHPMailer();
//    if($assunto !="ERRO SISTEMA" && $assunto!="Recuperação de senha"){
   //     $adm[] = array('nome'=>'Contato Companhia de Idiomas','email'=>$_SESSION['email']);
    //    array_push($copia,$adm);  
 //    }
	 
	 if ($reply == '') {
		define("FROM", utf8_decode($config[0]['emailEnvio'])) ;
	 } else {
		 define("FROM", $reply);
		 
	 }
      
//    $mailer -> isSendmail(); 
	$mailer->isSMTP();
    $mailer -> SMTPDebug = 3;
    $mailer -> SMTPSecure = 'ssl';
    $mailer -> SMTPAuth = true;
	$mailer -> isHTML(true);
	if ($from == '') {
		$mailer->setFrom(FROM, $config[0]['emailEnvio']);
		$mailer -> Username = $config[0]['emailEnvio'];
	} else {
		$mailer->setFrom(FROM, $from);
		$mailer -> Username = USERNAME;
	}
    
    $mailer -> Port = $config[0]['porta'];
    $mailer -> Host = $config[0]['smtp'];
    $mailer -> Password = $config[0]['senhaEmail'];
	if ($reply == '') {
		$mailer -> AddReplyTo(FROM, $config[0]['nomeEmpresa']."-Não responder diretamente a esse email!");
	} else {
		$mailer -> AddReplyTo(FROM, $reply);
	}

//	Uteis::pr($copia); //[0][0]['email']);
	
    if ($copia['email'] != '') {             
  		$email = $copia['email'];
		$nome = $copia['nome'];
		$mailer -> AddCC($email, $nome); 
    } elseif ($copia[0]['email'] != '') {             
  		$email = $copia[0]['email'];
		$nome = $copia[0]['nome'];
		$mailer -> AddCC($email, $nome); 
    } elseif ($copia[0][0]['email'] != '') {             
  		$email = $copia[0][0]['email'];
		$nome = $copia[0][0]['nome'];
		$mailer -> AddCC($email, $nome); 
    }

    if ($bcopia) {
		$email = $bcopia['email'];
		$nome = $bcopia['nome'];
		         
         $mailer -> AddBCC($email,$nome);   
    }

    if ($arquivos) {
      foreach ($arquivos as $valor) {
        if ($valor != "")
          $mailer -> AddAttachment($valor);
        //anexa o arquivo
      }
    }   
     
   // $mailer -> AddCC($_SESSION['email']);
  
    if ($paraQuem) {    
		
		$email = $paraQuem['email'];
		$nome =  utf8_decode($paraQuem['nome']);
	
	$mailer -> AddAddress($email, $nome);  	
     
    }

    $mailer -> Subject = utf8_decode($assunto);
	if ($emailMkt != 1) {
	    $mailer -> Body = utf8_decode(self::montarEmail($mensagem, $assunto));
	} else {
		$mailer -> Body = utf8_decode($mensagem);
	}
	Uteis::pr($mailer);
    $enviado = $mailer -> Send();
	
 //exit;
   if(!$enviado){
           return $mailer->ErrorInfo;
        } else {
 //           $mailer->ClearAllRecipients();
 //           $mailer->ClearAttachments();
            return true;
        }
    

  }

  //CORPO PADRÃO DOS E-MAILS ENVIADOS
  static function montarEmail($mensagem = "", $assunto = "") {
	  
	$Configuracoes = new Configuracoes();
	$config = $Configuracoes->selectConfig();

    $mensagem_final = "
		<html>
			<head>
				<title></title>				
			</head>
			<style>			
				body{
					font-family:Verdana, Geneva, sans-serif;
					background-color:#FFFFFF;
					padding: 10px 10px 10px 10px ;
					margin:0 auto;
				}
				
				p{
					padding:3px 3px;
					color:#333;
					text-align:justify;
					font-size:12px;
				}
				
				a{
					text-decoration:none;
					cursor:pointer;
				}
				
				.principal {	
					width:650px;
					background-color:#DDDDDD;
					margin:0 auto;
					border:0;
				}
				
				.banner {
					width:100%;
					text-align:right;
					font-size:10px;
					background-color:#FFFFFF;
				}
							
				.box{
					width:100%;
				}
				
				.noticia {
					width:100%;
					font-size:12px;
					background-color:#FFFFFF;
				}
				
				.titulo {
					font-size:14px;
					font-weight:bold;
					text-transform:uppercase;
					text-align:left;
				}
				
				.rodape {
					width:100%;
					font-size:10px;
					text-align:center;
					background-color:#FFFFFF;
					color:#FFFFFF;
				}
			</style>
			<body style=\"border:0\">
				<table cellpadding=\"0\" cellspacing=\"2\" align=\"center\" class=\"principal\">
					<tbody>
						<tr>
							<td>
							<table class=\"banner\">
								<tbody>
									<tr>
										<td style=\"text-align: center\"> 
											<img src=\"" . CAMINHO_IMG ."/".$config[0]['cabecalho']."\" width=\"400\"/>
										</td>
									</tr>
								</tbody>
							</table></td>
						</tr>
						<tr>
							<td class=\"noticia\">
							<table cellspacing=\"0\" class=\"box\" style=\"margin-top: 0px\">
								<tbody>
									<tr class=\"titulo\">
		
										<td class=\"fcinza\"> $assunto</td>
									</tr>
							</TABLE></td>
						</tr>
						<tr>
							<td class=\"noticia\">
							$mensagem
							</td>
						</tr>
						<tr>
							<td class=\"rodape\">												
							<img alt=\"Companhia de Idiomas\" border=\"0\" src=\"" . CAMINHO_IMG ."/". $config[0]['rodape']."\" width=\"650\"/></a>
							</td>
						</tr>
					</tbody>
				</table>
			</body>
		</html>		
		";

    return $mensagem_final;

  }

  //DATAS NO FORMATO AAAA-MM-DD
  static function gravarData($data) {
    if ($data != "") {
      $data2 = explode("/", $data);
      return $data2[2] . "-" . $data2[1] . "-" . $data2[0];
    }
  }

  //DATAS NO FORMATO DD/MM/AAAA
  static function exibirData($data) {
    if ($data != "") {
      $data2 = explode(" ", $data . " ");
      $data = explode("-", $data2[0]);
      return $data[2] . "/" . $data[1] . "/" . $data[0];
    }
  }

  //DATA/HORA NO FORMATO AAAA-MM-DD HH:MM:SS
  static function gravarDataHora($datatime) {
    if ($datatime != "") {
      $res = explode(" ", $datatime);
      $hora = $res[1];
      $data = explode("/", $res[0]);
      $data_r = $data[2] . "-" . $data[1] . "-" . $data[0];
      return $data_r . " " . $hora;
    }
  }

  //DATA/HORA NO FORMATO DD/MM/AAAA ÁS HH:MM:SS
  static function exibirDataHora($value) {
    $val = explode(" ", $value);
    return self::exibirData($val[0]) . " às " . self::exibirHoras(self::gravarHoras($val[1]));
  }

  //IMPRIME CÓDIGO JS PARA ALERT OU ALERTA PERSONALIZADO
  static function alertJava($msg, $js = false) {
    if ($js == true) {
      echo "<script type=\"text/javascript\">alert('" . $msg . "')</script>";
    } else {
      echo "<script type=\"text/javascript\">alerta('" . $msg . "')</script>";
    }
  }

  //EXECUTAR UMA QUERY NO BANCO
  static function executarQuery($sql) {
  // echo $sql;
    $Database = new Database();
    return $Database -> executeQuery($sql);
  }

//IMPRIME CÓDIGO JS
  static function executarJava($codigo) {
    echo "<script type=\"text/javascript\">".$codigo."</script>";  
  }
  
  //HORAS EM INT (converte para minutos)
  static function gravarHoras($horas) {
    $horas = explode(":", $horas);
    return $horas[0] * 60 + $horas[1];
  }

  //USADO INTERNAMENTE PARA CALULAR UM INT EM HORAS (array com [0]horas e [1]minutos)
  private static function montarHoras($value, $mostrarVazio = false) {
    if ($value == '' || is_null($value)) {
      if ($mostrarVazio == true) {
        $resArray = "";
      } else {
        $resArray[0] = "00";
        $resArray[1] = "00";
      }
    } else {
      $hora = intval($value / 60);
      $min = $value % 60;
      $resArray[0] = str_pad($hora, 2, '0', STR_PAD_LEFT);
      $resArray[1] = str_pad($min, 2, '0', STR_PAD_LEFT);
    }
    return $resArray;
  }

  //HORAS NO FORMATO hh:mm
  static function exibirHoras($value, $mostrarVazio = false) {
    $horas = self::montarHoras($value, $mostrarVazio);
    $res = $horas ? $horas[0] . ":" . $horas[1] . "" : "";
    return $res;
  }

  //HORAS NO FORMATO hh:mm (para input text)
  static function exibirHorasInput($value) {
    $horas = self::montarHoras($value, true);
    $res = $horas ? $horas[0] . ":" . $horas[1] . "" : "";
    return $res;
  }

  //SEM VIRGULA E COM '.' COMO SEPARADOR DECIMAL
  static function gravarMoeda($val) {
    $val = str_replace(',', '.', $val);
    return $val;
  }

  //SUBSTITUI PONTO POR VIRGULA
  static function exibirMoeda($val) {
    return str_replace('.', ',', $val);
  }

  //FORMATAR COMO MOEDA (duas casas depois da virgula)
  static function formatarMoeda($value, $retornaVazio = false) {
    if ($value != '') {
      return trim(self::exibirMoeda(number_format($value, 2, '.', '')));
    } else {
      if (!$retornaVazio) {
        return "0,00";
      } else {
        return "";
      }
    }
  }

  //CONFERE COM EXXPRESSÃO REGULAR SE O VALOR É NÚMERICO (aceita ponto a cada tres numeros, e vigula como separador decimal)
  static function eNumerico($val) {
    if (preg_match("/^(-){0,1}([0-9]+)([.][0-9]){0,1}([0-9]*)$/", $val)) {
      return 1;
    } else {
      return 0;
    }
  }

  //RETORNA ARRAY COM O SEGUNDO NÍVEL DE UM ARRAY BIDIMENSIONAL (chave associativa).
  //Normalmente usada para gerar array com apenas o valor de um campo do resource do bd.
  static function arrayCampoEspecifico($bigArray, $indice) {
    for ($row = 0; $row < count($bigArray, 0); $row++) {
      $larray[$row] = $bigArray[$row][$indice];
    }
    return $larray;
  }

  //INT PARA DIA DE SEMANA POR EXTENSO (de 1 - domingo a 7 -> sabado)
  static function exibirDiaSemana($diasemana) {
    switch ($diasemana) {
      case 1 :
        $diasemana = "Domingo";
        break;
      case 2 :
        $diasemana = "Segunda-Feira";
        break;
      case 3 :
        $diasemana = "Terça-Feira";
        break;
      case 4 :
        $diasemana = "Quarta-Feira";
        break;
      case 5 :
        $diasemana = "Quinta-Feira";
        break;
      case 6 :
        $diasemana = "Sexta-Feira";
        break;
      case 7 :
        $diasemana = "Sábado";
        break;
    }

    return $diasemana;
  }

  //CALCULA A DIFERENCA ENTRE DUAS DATAS (só em meses)
  static function diferencaEntreDatas($dataIni, $dataFim) {
    $diasNoMes = date("d", strtotime($dataIni)) - 1;
    $dataIni = date("Y-m-d", strtotime("-$diasNoMes days", strtotime($dataIni)));

    $diasNoMes = date("d", strtotime($dataFim)) - 1;
    $dataFim = date("Y-m-d", strtotime("-$diasNoMes days", strtotime($dataFim)));

    $m = 2592000;
    //mes em segundos
    $res = round((strtotime($dataFim) - strtotime($dataIni)) / $m);

    return $res;
  }

  //INT PARA DIA DE MESES POR EXTENSO (de 1 - janeiro a 12 -> dezembro)
  static function retornaNomeMes($mes) {
    switch ($mes) {
      case 1 :
        $nomeMes = "Janeiro";
        break;
      case 2 :
        $nomeMes = "Fevereiro";
        break;
      case 3 :
        $nomeMes = "Março";
        break;
      case 4 :
        $nomeMes = "Abril";
        break;
      case 5 :
        $nomeMes = "Maio";
        break;
      case 6 :
        $nomeMes = "Junho";
        break;
      case 7 :
        $nomeMes = "Julho";
        break;
      case 8 :
        $nomeMes = "Agosto";
        break;
      case 9 :
        $nomeMes = "Setembro";
        break;
      case 10 :
        $nomeMes = "Outubro";
        break;
      case 11 :
        $nomeMes = "Novembro";
        break;
      case 12 :
        $nomeMes = "Dezembro";
        break;
    }
    return $nomeMes;
  }

  //TOTAL DE DIAS EXISTENTES EM UM MES/ANO
  static function totalDiasMes($m, $a) {
    //echo "$a-$m";
    return date("t", strtotime($a . "-" . $m . "-01"));
  }

  //STATUS DO CADASTRO (ativo ou inativo)
  static function exibirStatus($bool, $mostraImg = true) {
    if ($mostraImg)
      return "<img src=\"" . CAMINHO_IMG . ($bool ? "ativo" : "inativo") . ".png\" >";
    else
      return ($bool ? "Sim" : "Não");
  }
  //Status Candidato
  static function exibirStatusA($bool) {
    if ($bool == 0) {
      return "<img src=\"" . CAMINHO_IMG . "inativo" . ".png\" >";
	} elseif ($bool == 1) {
	     return "<img src=\"" . CAMINHO_IMG .  "ativo" . ".png\" >";	
	} else {
		   return "<img src=\"" . CAMINHO_IMG . "rejeitou" . ".png\" >";
	}
     
  }
  	
  //STATUS DE APROVAÇÃO
  static function exibirStatusAprovacao($status, $mostraImg = true) {

    $res = "";

    if ($status == "1")
      $legenda = "Em aberto";
    elseif ($status == "2")
      $legenda = "Aprovado";
    elseif ($status == "3")
      $legenda = "Reprovado";

    if ($mostraImg) {

      if ($status == "1")
        $res = "pendente.png";
      elseif ($status == "2")
        $res = "ativo.png";
      elseif ($status == "3")
        $res = "inativo.png";

      return $res ? "<img src=\"" . CAMINHO_IMG . $res . "\" title=\"$legenda\" >" : "";

    } else {

      return $legenda;

    }

  }

  //RESUMIR UMA STRING
  static function resumir($string, $chars = 40) {
    if (strlen($string) > $chars) {
      return substr($string, 0, $chars) . "...";
    } else {
      return $string;
    }
  }

  //MOSTRAR O SEXO
  static function exibirSexo($sexo) {
    return ($sexo == "F" ? "Feminino" : "Masculino");
  }

  //CRIPTOGRAFIA
  static function base64_url_encode($input) {
    return strtr(base64_encode($input), '+/=', '-_,');
  }

  //DESFAZ CRIPTOGRAFIA
  static function base64_url_decode($input) {
    return base64_decode(strtr($input, '-_,', '+/='));
  }

  //VERIFICA SE A DATA É VALIDA
  static function verificarData($data) {
    if (date('Y-m-d', strtotime($data)) == $data) {
      $bool = 1;
    } else {
      $bool = 0;
    }
    return $bool;
  }

  //VERIFICA QUAL A SEMANA NO MES (de 1 a 5)
  static function verificarNumSemana($dataIni, $diaDaSemanaAtual, $diaDaSemana_InicioMes) {
    if ($dataIni) {
      $data = $dataIni;
      $mesInicial = date("m", strtotime($data));
      $inicio = ($diaDaSemanaAtual < $diaDaSemana_InicioMes) ? 0 : 1;
      for ($s = $inicio; $s <= 5; $s++) {
        $data = date("Y-m-d", strtotime("-7 days", strtotime($data)));
        if (date("m", strtotime($data)) != $mesInicial) {
          //$semanaAtual = "<br>$dataIni # ".$s;
          $semanaAtual = $s;
          break;
        }
      }
      return $semanaAtual;
    }
  }

  static function pr($arr, $exit = 0) {
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    if ($exit)
      exit ;
  }

  /////////// TEMPORARIO ATÉ IMPORTAÇÃO FINALIZAR

  static function aplicarMascara($val, $mascara = "") {

    $indice = 0;
    $res = "";

    for ($i = 0; $i < strlen($mascara); $i++) {
      if ($mascara[$i] == '#') {
        $res .= $val[$indice++];
      } else {
        $res .= $mascara[$i];
      }
    }

    return $res;

  }

  static function converteEC($i) {
    switch ($i) {
      case 1 :
        //solteiro
        return 1;
        break;
      case 2 :
        //casado
        return 2;
        break;
      case 3 :
        //viuvo
        return 3;
        break;
      case 4 :
        //desquitado
        return 4;
        break;
      case 9 :
        //divorciado
        return 5;
        break;
    }
    return 1;
  }
 static function converteFC($i) {
    switch ($i) {
      case 4 :
        //Negocios
        return 5;
        break;
      case 5 :
        //Geral
        return 2;
        break;
      case 6 :
        //especifico
        return 1;
        break;
      case 7 :
        //Geral 1
        return 3;
        break;
      case 8 :
        //Geral 2
        return 4;
        break;
    }
    return 2;
  }
  static function verEmail($value = '') {
    $exp = "/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/";
    return preg_match($exp, $value);
  }

  static function convertePeriodo($p) {
    switch ($p) {
      case 1 :
        //ini manhã
        return array(360, 540);
        break;
      case 2 :
        //fim manhã
        return array(540, 720);
        break;
      case 3 :
        //almoço
        return array(720, 840);
        break;
      case 4 :
        //ini tarde
        return array(840, 1020);
        break;
      case 5 :
        //fin tarde
        return array(1020, 1140);
        break;
      case 6 :
        //noite
        return array(1140, 1320);
        break;
    }
  }

  static function converteImposto($i) {
    switch ($i) {
      case 1 :
        //ISS
        return 3;
        break;
      case 2 :
        //INSS
        return 1;
        break;
      case 4 :
        //IR
        return 2;
        break;
    }
  }

static function converteSexo($i) {
    switch ($i) {
      case 'F':
        //ISS
        return 3;
        break;
      case 'M':
        return 2;
        break;
    }
  }
static function Sotaque($i) {
    switch ($i) {
      case 3:
      //  Inlges Americano
      return 1;
      
        break;

      case 4:
      // Ingles Britanico
      return 2;
      
        break;
        
        case 5:
      //  Ingles Canadense
      return 3;
      
        break;
        
        case 6:
      //  Ingles Australiano
      return 4;
        break;
        
        case 7:
      //  Francês - França
      return 5;
      
        break;
        
        case 8:
      //  Neutro
      return NULL;
        break;
        
        case 9:
      //  Espanhol AL
      return 7;
      
        break;
        
        case 10:
      //  Espanhol - Espanha
      return 6;      
        break;
        
        
        case 11:
      // Inglês Africano  
      return 8;
      
        break;
        
        case 12:
      // Chines - Madarim 
      return 9;
      
        break;
        
        case 13:
      //  Chines - Cantones
      return 10;
      
        break;
        
        case 14:
      //  Chines - Sishuanes
      return 11; 
           
        break;
        
        case 15:
      //  Chines - Hakka
      return 12;
      
        break;
        
        case 16:
      //  Frances - Canadense
      return 13;
      
        break;
        
        case 17:
      //  Frances - Africano
      return 14;
      
        break;
    }
  }
static function StatusProfessor($bool, $tipo) {
    if ($bool)
      return "<img style=\"width: 18px; height: 20px\" src=\"" . CAMINHO_IMG . ($tipo) . ".png\" >";
}


static function topo() {

return "<style>body{
					font-family:Verdana, Geneva, sans-serif;
					background-color:#FFFFFF;
					padding: 10px 10px 10px 10px ;
					margin:0 auto;
				}				
				p{
					padding:3px 3px;
					color:#333;
					text-align:justify;
					font-size:12px;
				}				
				a{
					text-decoration:none;
					cursor:pointer;
				}						
				.box{
					width:100%;
				}			
				.noticia {
					width:100%;
					font-size:12px;
					background-color:#FFFFFF;
				}				
				.titulo {
					font-size:14px;
					font-weight:bold;
					text-transform:uppercase;
					text-align:left;
				}				
				.rodape {
					width:100%;
					font-size:10px;
					text-align:center;
					background-color:#FFFFFF;
					color:#FFFFFF;
				}
			</style>
					<table cellpadding=\"0\" cellspacing=\"2\" align=\"center\" class=\"principal\">
					<tbody>
						<tr>
							<td>
							<table class=\"banner\">
								<tbody>
									<tr>
										<td style=\"text-align: center\"> 
											<img src=\"" . CAMINHO_IMG . "/".$config[0]['cabecalho']." width=\"400\" />
										</td>
									</tr>
								</tbody>
							</table></td>
						</tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr></tbody></table>";
}

	static function criarCode() {
	
		$universo = array(
"1","2","3","4","5","6","7","8","9","A","B","C","D","E","F","G","H","I","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z");

		shuffle($universo);

		$rand_keys = array_rand($universo, 16);
	
		$html = "";
 		$html .= $universo[$rand_keys[0]];
		$html .= $universo[$rand_keys[1]];
		$html .= $universo[$rand_keys[2]];
		$html .= $universo[$rand_keys[3]];
		$html .= $universo[$rand_keys[4]];

	return $html;
  
  }
  
  static function msleep($time)
{
    usleep($time * 1000000);
}

}
?>