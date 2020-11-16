<?php
class DemonstrativoCobrancaAjudaCusto extends Database {

	// class attributes
	var $idDemonstrativoCobrancaAjudaCusto;
	var $demonstrativoCobrancaIdDemonstrativoCobranca;
	var $valor;
	var $porDia;
	var $descricao;
	
	function __construct() {
		parent::__construct();

		$this -> idDemonstrativoCobrancaAjudaCusto = "NULL";
		$this -> demonstrativoCobrancaIdDemonstrativoCobranca = "NULL";
		$this -> valor = "NULL";
		$this -> porDia = "0";
		$this -> descricao = "NULL";		

	}

	function __destruct() {
		parent::__destruct();
	}
	
	// class methods
	function setIdDemonstrativoCobrancaAjudaCusto($value) {
		$this -> idDemonstrativoCobrancaAjudaCusto = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDemonstrativoCobrancaIdDemonstrativoCobranca($value) {
		$this -> demonstrativoCobrancaIdDemonstrativoCobranca = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? "'" . $this -> gravarBD($value) . "'" : "NULL";
	}

	function setPorDia($value) {
		$this -> porDia = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDescricao($value) {
		$this -> descricao = ($value) ?  $this -> gravarBD($value) : "NULL";
	}

	function addDemonstrativoCobrancaAjudaCusto() {
		$sql = "INSERT INTO demonstrativoCobrancaAjudaCusto (demonstrativoCobranca_idDemonstrativoCobranca, valor, porDia, descricao) VALUES ($this->demonstrativoCobrancaIdDemonstrativoCobranca, $this->valor, $this->porDia, $this->descricao)";
		$result = $this -> query($sql, true);
		return $this-> connect;
	}

	function deleteDemonstrativoCobrancaAjudaCusto($or = "") {
		$sql = "DELETE FROM demonstrativoCobrancaAjudaCusto WHERE idDemonstrativoCobrancaAjudaCusto = $this->idDemonstrativoCobrancaAjudaCusto " . $or;
		$result = $this -> query($sql, true);
	}

	function updateFieldDemonstrativoCobrancaAjudaCusto($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $this -> gravarBD($value);
		$sql = "UPDATE demonstrativoCobrancaAjudaCusto SET " . $field . " = " . $value . " WHERE idDemonstrativoCobrancaAjudaCusto = $this->idDemonstrativoCobrancaAjudaCusto";
		$result = $this -> query($sql, true);
	}
	
	function updateDemonstrativoCobrancaAjudaCusto() {
		$sql = "UPDATE demonstrativoCobrancaAjudaCusto SET demonstrativoCobranca_idDemonstrativoCobranca = $this->demonstrativoCobrancaIdDemonstrativoCobranca, valor = $this->valor, porDia = $this->porDia, descricao = $this->descricao,  WHERE idDemonstrativoCobrancaAjudaCusto = $this->idDemonstrativoCobrancaAjudaCusto";
		$result = $this -> query($sql, true);
	}
	
	function selectDemonstrativoCobrancaAjudaCusto($where = "WHERE 1") {
		$sql = "SELECT idDemonstrativoCobrancaAjudaCusto, demonstrativoCobranca_idDemonstrativoCobranca, valor, porDia, descricao, dataCadastro FROM demonstrativoCobrancaAjudaCusto " . $where;
		return $this -> executeQuery($sql);
	}	
}
?>