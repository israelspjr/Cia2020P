<?php
class PreClientePf extends Database {
	// class attributes
	var $idPreClientePf;
	var $nome;
    var $email;
	var $dataCadastro;
	var $jaRealizado;
	var $funcionarioIdFuncionario;
	var $clientePjIdClientePj;

	// constructor
	function __construct() {
		parent::__construct();
		
		$this -> idPreClientePf = "NULL";
		$this -> nome = "NULL";
        $this -> email = "NULL";
    	$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> jaRealizado = "0";
		$this -> funcionarioIdFuncionario = "0";
		$this -> clientePjIdClientePj = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPreClientePf($value) {
		$this -> idPreClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	
	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}
  
  function setEmail($value) {
    $this -> email = ($value) ? $this -> gravarBD($value) : "NULL";
  }

	function setJaRealizado($value) {
		$this -> jaRealizado = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setFuncionarioIdFuncionario($value) {
		$this -> funcionarioIdFuncionario = ($value) ? $this -> gravarBD($value) : "0";
	}	
	
	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addClientepf() Function
	 */
	function addPreClientePf() {

		$sql = "INSERT INTO preClientePf (nome, email, dataCadastro, jaRealizado, funcionario_idFuncionario, clientePj_idClientePj) VALUES ($this->nome, $this->email, $this->dataCadastro, $this->jaRealizado, $this->funcionarioIdFuncionario, $this->clientePjIdClientePj)";
//		echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteClientepf() Function
	 */
	function deletePreClientepf() {
		$sql = "DELETE FROM preClientePf WHERE idPreClientePf = $this->idPreClientePf";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldClientepf() Function
	 */
	function updateFieldPreClientepf($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE preClientePf SET " . $field . " = " . $value . " WHERE idPreClientePf = $this->idPreClientePf";
		//echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateClientepf() Function
	 */
	function updateClientepf() {
		$sql = "UPDATE preClientePf SET nome = $this->nome , email = $this->email, jaRealizado = $this->jaRealizado, funcionario_idFuncionario = $this->funcionarioIdFuncionario, clientePj_idClientePj = $this->clientePjIdClientePj WHERE idPreClientePf = $this->idPreClientePf";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectClientepf() Function
	 */
	function selectPreClientepf($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPreClientePf, nome, email, dataCadastro, jaRealizado, funcionario_idFuncionario, clientePj_idClientePj FROM preClientePf " . $where;
		return $this -> executeQuery($sql);
	}
	
	function selectPreClientepfTr($where) {
		
		$Funcionario = new Funcionario();
		$ClientePj = new ClientePj();
		
		$sql = "SELECT SQL_CACHE idPreClientePf, nome, email, dataCadastro, jaRealizado, funcionario_idFuncionario, clientePj_idClientePj FROM preClientePf " . $where;
		$result = $this -> query($sql);
		
		$caminhoAtualizar = CAMINHO_CAD . "clientePf/include/resourceHTML/listaPreCadastro.php";
		
		
	
//		echo $sql;
		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
				$delete = "<center><img src=\"" . CAMINHO_IMG . "excluir.png\" 
				onclick=\"deletaRegistro('" . CAMINHO_CAD . "clientePf/include/acao/preClientePf.php', '" . $valor['idPreClientePf'] . "', '".$caminhoAtualizar."', 'tr')\" /></center>";
				
				$onclick =  "onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "clientePf/include/resourceHTML/preCadastro.php?id=" . $valor['idPreClientePf'] . "', '', 'tr')\"";
				
				$html .= "<tr>";
				
				$html .= "<td $onclick> ".$valor['nome'] ."</td>";
				
				$html .= "<td> ".$valor['email'] ."</td>";
				
				$nomeF = $Funcionario->getNome($valor['funcionario_idFuncionario']);
				
				$html .= "<td> ".$nomeF."</td>";
				
				$html .= "<td> ".Uteis::exibirData($valor['dataCadastro'])."</td>";
				
				$html .= "<td> ".Uteis::exibirStatus($valor['jaRealizado'])."</td>";
				
				$nomeE = $ClientePj->getNome($valor['clientePj_idClientePj']);
				
				$html .= "<td> ".$nomeE."</td>";
				
				
				$html .= "<td> ".$delete."</td>";
				
				$html .= "</tr>";
				
			}
			
		}
	return $html;
	}
	
	
	

}
?>
