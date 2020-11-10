<?php
class Database {

	// class attributes
	var $connect;

	// constructor
	function __construct() {
	//	$this -> connect(DATABASE_DB);        
		
	}

	// constructor
	function __destruct() {
		//if( $this->connect ) mysql_close($this->connect);
	}
	
	function connect($database = false) {
		$this -> connect = mysqli_connect(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS);
		
		if (!$this -> connect){
            $mensagemErro = mysqli_errno($this -> connect) . ": " . mysqli_error($this -> connect);
      //      $Log->Log("Erro ao conctar db", 1, $mensagemErro, array('usuario'=>$_SESSION['usuario'],$_SESSION['idUsuario']));
        }
		
		if ($this -> connect){
            $mensagemErro = mysqli_errno($this -> connect) . ": " . mysqli_error($this -> connect);
      //      $Log->Log("Erro ao conctar db", 1, $mensagemErro, array('usuario'=>$_SESSION['usuario'],$_SESSION['idUsuario']));
        }
	//echo "teste";
//	    $Log = new Log();

//		return mysqli_connect(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS, DATABASE_DB);
	//	Uteis::pr($this->connect);

//		if (!$this -> connect){
  //          $mensagemErro = mysqli_errno($this -> connect) . ": " . mysqli_error($this -> connect);
      //      $Log->Log("Erro ao conctar db", 1, $mensagemErro, array('usuario'=>$_SESSION['usuario'],$_SESSION['idUsuario']));
    //    }

	//	if ($database) {
	//		$this -> selectDb($database);
    //        mysql_set_charset('utf8');
	//	}

	}

	function fetchArray($result) {
		if (!$result) {
			return false;
		} else {
		//	$array = array_map("stripslashes", mysqli_fetch_array($result, MYSQL_ASSOC));
		$array = mysqli_fetch_array($result, MYSQLI_ASSOC);
//		var_dump($array);
			return $array;
		}
	}

	function query($sql, $log = true) {
		
	     $link = mysqli_connect(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS, DATABASE_DB);	

	//echo $sql;
	//   $Log = new Log();
	    mysqli_set_charset( $link, 'utf8');
	      
		if (!($query = mysqli_query($link, $sql))){        
		  $mensagemErro = $sql;
		  $acao = "Erro Ao executar acao: ".mysqli_errno($link) . ": " . mysqli_error($link);
		  
//		  echo $acao;
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
			return 3; //mysqli_num_rows($result);
		}
	}

	function executeQuery($sql) {
		$result = $this -> query($sql);
		$array = "";
	//	if (mysqli_num_rows > 0) {
		for ($i=0;$i<mysqli_num_rows($result);$i++) {
			foreach($result as $key => $row)
				{
					$array[$key] = $row;
				}
			}
	//	}

/*		for ($i = 0; $i < $this -> count($result); $i++) {
			echo $i;
			$array[$i] = $this -> fetchArray($result);
		}*/
		mysqli_free_result($result);
       	return $array;
	}

	function gravarBD($texto) {

		$res =  trim($texto);
   //     echo $res;
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
