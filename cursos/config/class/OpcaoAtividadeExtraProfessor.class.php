<?php
class OpcaoAtividadeExtraProfessor extends Database {
	// class attributes
	var $idOpcaoAtividadeExtraProfessor;
	var $atividadeExtraProfessorIdAtividadeExtraProfessor;
	var $professorIdProfessor;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idOpcaoAtividadeExtraProfessor = "NULL";
		$this -> atividadeExtraProfessorIdAtividadeExtraProfessor = "NULL";
		$this -> professorIdProfessor = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdOpcaoAtividadeExtraProfessor($value) {
		$this -> idOpcaoAtividadeExtraProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAtividadeExtraProfessorIdAtividadeExtraProfessor($value) {
		$this -> atividadeExtraProfessorIdAtividadeExtraProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addOpcaoAtividadeExtraProfessor() Function
	 */
	function addOpcaoAtividadeExtraProfessor() {
		$sql = "INSERT INTO opcaoAtividadeExtraProfessor (atividadeExtraProfessor_idAtividadeExtraProfessor, professor_idProfessor) VALUES ($this->atividadeExtraProfessorIdAtividadeExtraProfessor, $this->professorIdProfessor)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteOpcaoAtividadeExtraProfessor() Function
	 */
	function deleteOpcaoAtividadeExtraProfessor($or = " 1 = 2 ") {
		$sql = "DELETE FROM opcaoAtividadeExtraProfessor WHERE idOpcaoAtividadeExtraProfessor = $this->idOpcaoAtividadeExtraProfessor OR (" . $or . ") ";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldOpcaoAtividadeExtraProfessor() Function
	 */
	function updateFieldOpcaoAtividadeExtraProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE opcaoAtividadeExtraProfessor SET " . $field . " = " . $value . " WHERE idOpcaoAtividadeExtraProfessor = $this->idOpcaoAtividadeExtraProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateOpcaoAtividadeExtraProfessor() Function
	 */
	function updateOpcaoAtividadeExtraProfessor() {
		$sql = "UPDATE opcaoAtividadeExtraProfessor SET atividadeExtraProfessor_idAtividadeExtraProfessor = $this->atividadeExtraProfessorIdAtividadeExtraProfessor, professor_idProfessor = $this->professorIdProfessor WHERE idOpcaoAtividadeExtraProfessor = $this->idOpcaoAtividadeExtraProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectOpcaoAtividadeExtraProfessor() Function
	 */
	function selectOpcaoAtividadeExtraProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idOpcaoAtividadeExtraProfessor, atividadeExtraProfessor_idAtividadeExtraProfessor, professor_idProfessor FROM opcaoAtividadeExtraProfessor " . $where;
		return $this -> executeQuery($sql);
	}

}
?>