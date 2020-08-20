<?php
class Database {

	// class attributes
	var $connect;

	// constructor
	function __construct() {
		$this -> connect(DATABASE_DB);        
	}

	// constructor
	function __destruct() {
		//if( $this->connect ) mysql_close($this->connect);
	}

	// class methods
	function connect($database = false) {
	//    $Log = new Log();

		//$this -> connect = mysqli_connect(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS, DATABASE_DB);
		$link = mysqli_connect(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS, DATABASE_DB);
		echo "<pre>";
		var_dump($link);
		
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if (!mysqli_query($link, "SET a=1")) {
    printf("Errorcode: %d\n", mysqli_errno($link));
}

if (!mysqli_query($link, "SET a=1")) {
    print_r(mysqli_error_list($link));
}
		if (!$this -> connect){
            $mensagemErro = mysqli_errno($this -> connect) . ": " . mysqli_error($this -> connect);
      //      $Log->Log("Erro ao conctar db", 1, $mensagemErro, array('usuario'=>$_SESSION['usuario'],$_SESSION['idUsuario']));
        }

	//	if ($database) {
	//		$this -> selectDb($database);
    //        mysql_set_charset('utf8');
	//	}

	}

/*	function selectDb($database) {
	  //  $Log = new Log();
		if (!mysql_select_db($database, $this -> connect)){
		    $mensagemErro = mysql_errno($this -> connect) . ": " . mysql_error($this -> connect);			
       //     $Log->Log("Erro ao selecionar db", 1, $mensagemErro, array('usuario'=>$_SESSION['usuario'],$_SESSION['idUsuario']));
        }
	}*/

	function fetchArray($result) {
		if (!$result) {
			return false;
		} else {
			$array = array_map("stripslashes", mysqli_fetch_array($result, MYSQL_ASSOC));
			return $array;
		}
	}

	function query($sql, $log = true) {

	//echo $sql;
	//   $Log = new Log();
	    
	      
		if (!($query = mysqli_query($sql))){        
		  $mensagemErro = $sql;
		  $acao = "Erro Ao executar acao: ".mysqli_errno($this -> connect) . ": " . mysqli_error($this -> connect);
		  
		  echo $acao;
	//	  $Log->Log($acao, 1, $mensagemErro, array('usuario'=>$_SESSION['usuario'], $_SESSION['idUsuario'])); 
        }
     
		return $query;

	}

	function mostraErr($sql = "", $soEmail = false) {

		$mensagemErro = "<br />$sql<br />" . mysqli_errno($this -> connect) . ": " . mysqli_error($this -> connect);
		$emails =  array(0 => array("email" => EMAIL_ADM, "nome" => "Administrador"));
		Uteis::enviarEmail("ERRO SISTEMA", $mensagemErro, $emails);
		
		
		if (!$soEmail) {
			if ( EMPRESA ) {
				//echo json_encode(array("mensagem" => "Erro: Nao foi possivel completar, comunique o responsavel. Nao repita a acao enquanto o erro nao for corrigido"));
				echo "Erro: " . $mensagemErro;
			} else {				
				echo "Erro: ".$mensagemErro;
			}
			exit ;
		}

	}

	function numRows($result) {
		if (!$result) {
			return false;
		} else {
			return mysqli_num_rows($result);
		}
	}

	function executeQuery($sql) {
		$result = $this -> query($sql);
		for ($i = 0; $i < $this -> numRows($result); $i++) {
			$array[$i] = $this -> fetchArray($result);
		}
		mysqli_free_result($result);
       	return $array;
	}

	function gravarBD($texto) {

		$res = mysqli_escape_string(trim($texto));
        //echo $res;
		//mysql_real_escape_string

		if( is_numeric($res) ) {
			return $res;
		}elseif( is_null($res) || $res === '' ) {
			return "NULL";
		} else {
			return "'" . $res . "'";
		}

	}
    
    function logQuery($sql){
        $query = mysqli_query($sql);
    }

}
?>
