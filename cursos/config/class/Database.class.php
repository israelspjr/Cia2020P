<?php
error_reporting(E_ALL);
class Database {

	// class attributes
	var $connect;

	// constructor
	function __construct() {
		mysqli_close($this->connect);
		$this -> connect();        
	}

	// constructor
	function __destruct() {
		//if( $this->connect ) mysql_close($this->connect);
	}
	
	function connect($database = false) {
				$this -> connect = mysqli_connect(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS, DATABASE_DB);
	
		if (mysqli_connect_errno()) {
    		printf("Connect failed: %s\n", mysqli_connect_error());
    		//exit();
		}
		
	}

	function fetchArray($result) {
		if (!$result) {
			return false;
		} else {
     		$array = mysqli_fetch_array($result, MYSQLI_ASSOC);
			return $array;
		}
	}

	function query($sql, $log = true) {
	    mysqli_set_charset( $this->connect, 'utf8');
	      
		if (!($query = mysqli_query($this->connect, $sql))){        
		  $mensagemErro = $sql;
		  $acao = "Erro Ao executar acao: ".mysqli_errno($this->connect) . ": " . mysqli_error($this->connect);
	
	        }
     
		return $query;
		mysqli_close($this->connect);

	}

	function mostraErr($sql = "", $soEmail = false) {

		$mensagemErro = "<br />$sql<br />" . mysqli_errno($this -> connect) . ": " . mysqli_error($this -> connect);
		$emails =  array(0 => array("email" => EMAIL_ADM, "nome" => "Administrador"));
		Uteis::enviarEmail("ERRO SISTEMA", $mensagemErro, $emails);
				
		if (!$soEmail) {
			if ( EMPRESA ) {
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
		for ($i=0;$i<mysqli_num_rows($result);$i++) {
			foreach($result as $key => $row)
				{
					$array[$key] = $row;
				}
			}
		mysqli_free_result($result);
	//	mysqli_close($this->connect);
       	return $array;
	}

	function gravarBD($texto) {

		$res =  trim($texto);
 
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
