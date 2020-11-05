<?php
class NaoFazAulaNestaSemanaProposta extends Database {
	// class attributes
	var $idNaoFazAulaNestaSemanaProposta;
	var $itemValorSimuladoPropostaIdItemValorSimuladoProposta;
	var $semana;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idNaoFazAulaNestaSemanaProposta = "NULL";
		$this -> itemValorSimuladoPropostaIdItemValorSimuladoProposta = "NULL";
		$this -> semana = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdNaoFazAulaNestaSemanaProposta($value) {
		$this -> idNaoFazAulaNestaSemanaProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setItemValorSimuladoPropostaIdItemValorSimuladoProposta($value) {
		$this -> itemValorSimuladoPropostaIdItemValorSimuladoProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setSemana($value) {
		$this -> semana = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addNaoFazAulaNestaSemanaProposta() Function
	 */
	function addNaoFazAulaNestaSemanaProposta() {
		$sql = "INSERT INTO naoFazAulaNestaSemanaProposta (itemValorSimuladoProposta_idItemValorSimuladoProposta, semana) VALUES ($this->itemValorSimuladoPropostaIdItemValorSimuladoProposta, $this->semana)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteNaoFazAulaNestaSemanaProposta() Function
	 */
	function deleteNaoFazAulaNestaSemanaProposta($and = "") {
		$sql = "DELETE FROM naoFazAulaNestaSemanaProposta WHERE idNaoFazAulaNestaSemanaProposta = $this->idNaoFazAulaNestaSemanaProposta " . $and;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldNaoFazAulaNestaSemanaProposta() Function
	 */
	function updateFieldNaoFazAulaNestaSemanaProposta($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE naoFazAulaNestaSemanaProposta SET " . $field . " = " . $value . " WHERE idNaoFazAulaNestaSemanaProposta = $this->idNaoFazAulaNestaSemanaProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateNaoFazAulaNestaSemanaProposta() Function
	 */
	function updateNaoFazAulaNestaSemanaProposta() {
		$sql = "UPDATE naoFazAulaNestaSemanaProposta SET itemValorSimuladoProposta_idItemValorSimuladoProposta = $this->itemValorSimuladoPropostaIdItemValorSimuladoProposta, semana = $this->semana WHERE idNaoFazAulaNestaSemanaProposta = $this->idNaoFazAulaNestaSemanaProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectNaoFazAulaNestaSemanaProposta() Function
	 */
	function selectNaoFazAulaNestaSemanaProposta($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idNaoFazAulaNestaSemanaProposta, itemValorSimuladoProposta_idItemValorSimuladoProposta, semana FROM naoFazAulaNestaSemanaProposta " . $where;
		return $this -> executeQuery($sql);
	}

}
?>