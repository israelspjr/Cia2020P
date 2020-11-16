<?php
class OpcaoAtividadeExtraProfessorClientePf extends Database {
	// class attributes
	var $idOpcaoAtividadeExtraProfessorClientePf;
	var $clientePfIdClientePf;
	var $atividadeExtraProfessorIdAtividadeExtraProfessor;
    var $obs;
	// constructor
	function __construct() {
		parent::__construct();
		$this -> idOpcaoAtividadeExtraProfessorClientePf = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> atividadeExtraProfessorIdAtividadeExtraProfessor = "NULL";
        $this -> obs = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdOpcaoAtividadeExtraProfessorClientePf($value) {
		$this -> idOpcaoAtividadeExtraProfessorClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAtividadeExtraProfessorIdAtividadeExtraProfessor($value) {
		$this -> atividadeExtraProfessorIdAtividadeExtraProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}
     function setObs($value) {
        $this -> obs = ($value) ? $this -> gravarBD($value) : "0";
    }    
	/**
	 * addOpcaoatividadeextraprofessorclientepf() Function
	 */
	function addOpcaoatividadeextraprofessorclientepf() {
		$sql = "INSERT INTO opcaoAtividadeExtraProfessorClientePf (clientePf_idClientePf, atividadeExtraProfessor_idAtividadeExtraProfessor, obs) VALUES ($this->clientePfIdClientePf, $this->atividadeExtraProfessorIdAtividadeExtraProfessor, $this->obs)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteOpcaoatividadeextraprofessorclientepf() Function
	 */
	function deleteOpcaoatividadeextraprofessorclientepf($or = " 1 = 2 ") {
		$sql = "DELETE FROM opcaoAtividadeExtraProfessorClientePf WHERE idOpcaoAtividadeExtraProfessorClientePf = $this->idOpcaoAtividadeExtraProfessorClientePf OR (" . $or . ")";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldOpcaoatividadeextraprofessorclientepf() Function
	 */
	function updateFieldOpcaoatividadeextraprofessorclientepf($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE opcaoAtividadeExtraProfessorClientePf SET " . $field . " = " . $value . " WHERE idOpcaoAtividadeExtraProfessorClientePf = $this->idOpcaoAtividadeExtraProfessorClientePf";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateOpcaoatividadeextraprofessorclientepf() Function
	 */
	function updateOpcaoatividadeextraprofessorclientepf() {
		$sql = "UPDATE opcaoAtividadeExtraProfessorClientePf SET clientePf_idClientePf = $this->clientePfIdClientePf, atividadeExtraProfessor_idAtividadeExtraProfessor = $this->atividadeExtraProfessorIdAtividadeExtraProfessor, obs=$this->obs WHERE idOpcaoAtividadeExtraProfessorClientePf = $this->idOpcaoAtividadeExtraProfessorClientePf";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectOpcaoatividadeextraprofessorclientepf() Function
	 */
	function selectOpcaoatividadeextraprofessorclientepf($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idOpcaoAtividadeExtraProfessorClientePf, clientePf_idClientePf, atividadeExtraProfessor_idAtividadeExtraProfessor, obs FROM opcaoAtividadeExtraProfessorClientePf " . $where;
		return $this -> executeQuery($sql);
	}

}
?>