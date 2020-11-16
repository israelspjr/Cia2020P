<?php
class MeioLocomocaoProfessor extends Database {
	// class attributes
	var $idMeioLocomocaoProfessor;
	var $meioLocomocaoIdMeioLocomocao;
	var $professorIdProfessor;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idMeioLocomocaoProfessor = "NULL";
		$this -> meioLocomocaoIdMeioLocomocao = "NULL";
		$this -> professorIdProfessor = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdMeioLocomocaoProfessor($value) {
		$this -> idMeioLocomocaoProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMeioLocomocaoIdMeioLocomocao($value) {
		$this -> meioLocomocaoIdMeioLocomocao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addMeioLocomocaoProfessor() Function
	 */
	function addMeioLocomocaoProfessor() {
		$sql = "INSERT INTO meioLocomocaoProfessor (meioLocomocao_idMeioLocomocao, professor_idProfessor) VALUES ($this->meioLocomocaoIdMeioLocomocao, $this->professorIdProfessor)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteMeioLocomocaoProfessor() Function
	 */
	function deleteMeioLocomocaoProfessor($or = " 1 = 2 ") {
		$sql = "DELETE FROM meioLocomocaoProfessor WHERE idMeioLocomocaoProfessor = $this->idMeioLocomocaoProfessor OR (" . $or . ")";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldMeioLocomocaoProfessor() Function
	 */
	function updateFieldMeioLocomocaoProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE meioLocomocaoProfessor SET " . $field . " = " . $value . " WHERE idMeioLocomocaoProfessor = $this->idMeioLocomocaoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateMeioLocomocaoProfessor() Function
	 */
	function updateMeioLocomocaoProfessor() {
		$sql = "UPDATE meioLocomocaoProfessor SET meioLocomocao_idMeioLocomocao = $this->meioLocomocaoIdMeioLocomocao, professor_idProfessor = $this->professorIdProfessor WHERE idMeioLocomocaoProfessor = $this->idMeioLocomocaoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectMeioLocomocaoProfessor() Function
	 */
	function selectMeioLocomocaoProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idMeioLocomocaoProfessor, meioLocomocao_idMeioLocomocao, professor_idProfessor FROM meioLocomocaoProfessor " . $where;
		return $this -> executeQuery($sql);
	}

}
?>