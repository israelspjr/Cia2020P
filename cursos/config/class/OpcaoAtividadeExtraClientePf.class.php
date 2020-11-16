<?php
class OpcaoAtividadeExtraClientePf extends Database {
	// class attributes
	var $idopcaoAtividadeExtraClientePf;
	var $atividadeExtraIdAtividadeExtra;
	var $clientePfIdClientePf;
    var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idopcaoAtividadeExtraClientePf = "NULL";
		$this -> atividadeExtraIdAtividadeExtra = "NULL";
		$this -> clientePfIdClientePf = "NULL";
        $this -> obs = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setidopcaoAtividadeExtraClientePf($value) {
		$this -> idopcaoAtividadeExtraClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAtividadeExtraIdAtividadeExtra($value) {
		$this -> atividadeExtraIdAtividadeExtra = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}
    
    function setObs($value) {
        $this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
    } 
	/**
	 * addopcaoAtividadeExtraClientePf() Function
	 */
	function addopcaoAtividadeExtraClientePf() {
		$sql = "INSERT INTO opcaoAtividadeExtraClientePf (atividadeExtra_idAtividadeExtra, clientePf_idClientePf, obs) VALUES ($this->atividadeExtraIdAtividadeExtra, $this->clientePfIdClientePf, $this->obs)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteopcaoAtividadeExtraClientePf() Function
	 */
	function deleteopcaoAtividadeExtraClientePf($or = " 1 = 2") {
		$sql = "DELETE FROM opcaoAtividadeExtraClientePf WHERE idopcaoAtividadeExtraClientePf = $this->idopcaoAtividadeExtraClientePf OR (" . $or . ")";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldopcaoAtividadeExtraClientePf() Function
	 */
	function updateFieldopcaoAtividadeExtraClientePf($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE opcaoAtividadeExtraClientePf SET " . $field . " = " . $value . " WHERE idopcaoAtividadeExtraClientePf = $this->idopcaoAtividadeExtraClientePf";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateopcaoAtividadeExtraClientePf() Function
	 */
	function updateopcaoAtividadeExtraClientePf() {
		$sql = "UPDATE opcaoAtividadeExtraClientePf SET atividadeExtra_idAtividadeExtra = $this->atividadeExtraIdAtividadeExtra, clientePf_idClientePf = $this->clientePfIdClientePf, obs=$this->obs WHERE idopcaoAtividadeExtraClientePf = $this->idopcaoAtividadeExtraClientePf";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectopcaoAtividadeExtraClientePf() Function
	 */
	function selectopcaoAtividadeExtraClientePf($where = "") {
		$sql = "SELECT SQL_CACHE idopcaoAtividadeExtraClientePf, atividadeExtra_idAtividadeExtra, clientePf_idClientePf, obs FROM opcaoAtividadeExtraClientePf " . $where;
		return $this -> executeQuery($sql);
	}

}
?>