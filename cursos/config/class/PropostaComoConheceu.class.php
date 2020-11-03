<?php
class PropostaComoConheceu extends Database {
	// class attributes
	var $idPropostaComoConheceu;
	var $propostaIdProposta;
	var $comoConheceuIdComoConheceu;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPropostaComoConheceu = "NULL";
		$this -> propostaIdProposta = "NULL";
		$this -> comoConheceuIdComoConheceu = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPropostaComoConheceu($value) {
		$this -> idPropostaComoConheceu = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPropostaIdProposta($value) {
		$this -> propostaIdProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setComoConheceuIdComoConheceu($value) {
		$this -> comoConheceuIdComoConheceu = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addPropostaComoConheceu() Function
	 */
	function addPropostaComoConheceu() {
		$sql = "INSERT INTO propostaComoConheceu (proposta_idProposta, comoConheceu_idComoConheceu) VALUES ($this->propostaIdProposta, $this->comoConheceuIdComoConheceu)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deletePropostaComoConheceu() Function
	 */
	function deletePropostaComoConheceu() {
		$sql = "DELETE FROM propostaComoConheceu WHERE idPropostaComoConheceu = $this->idPropostaComoConheceu";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPropostaComoConheceu() Function
	 */
	function updateFieldPropostaComoConheceu($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE propostaComoConheceu SET " . $field . " = " . $value . " WHERE idPropostaComoConheceu = $this->idPropostaComoConheceu";
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePropostaComoConheceu() Function
	 */
	function updatePropostaComoConheceu() {
		$sql = "UPDATE propostaComoConheceu SET proposta_idProposta = $this->propostaIdProposta, comoConheceu_idComoConheceu = $this->comoConheceuIdComoConheceu WHERE idPropostaComoConheceu = $this->idPropostaComoConheceu";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPropostaComoConheceu() Function
	 */
	function selectPropostaComoConheceu($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPropostaComoConheceu, proposta_idProposta, comoConheceu_idComoConheceu FROM propostaComoConheceu " . $where;
		return $this -> executeQuery($sql);
	}

}
?>