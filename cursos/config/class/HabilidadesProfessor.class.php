<?php
class HabilidadesProfessor extends Database {
	// class attributes
	var $idHabilidadesProfessor;
	var $idhabilidade;
	var $idProfessor;
	var $obs;
	var $anos;
	var $escolas;
	var $resposta;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idHabilidadesProfessor = "NULL";
		$this -> idHabilidade = "NULL";
		$this -> idProfessor = "0";
		$this -> obs = "NULL";
		$this -> anos = "NULL";
		$this -> escolas = "NULL";
		$this -> resposta = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdHabilidadesProfessor($value) {
		$this -> idHabilidadesProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdHabilidade($value) {
		$this -> idHabilidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdProfessor($value) {
		$this -> idProfessor = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setAnos($value) {
		$this -> anos = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setEscolas($value) {
		$this -> escolas = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setResposta($value) {
		$this -> resposta = ($value) ? $this -> gravarBD($value) : "0";
	}


	/**
	 * addTelefone() Function
	 */
	function addHabilidadesProfessor() {
		$sql = "INSERT INTO habilidadesProfessor (idHabilidade, idProfessor, obs, anos, escolas, resposta) VALUES ($this->idHabilidade, $this->idProfessor, $this->obs, $this->anos, $this->escolas, $this->resposta)";
//		echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTelefone() Function
	 */
	function deleteHabilidadesProfessor($or = " 1 = 2 ") {
		$sql = "DELETE FROM habilidadesProfessor WHERE idHabilidadesProfessor = $this->idHabilidadesProfessor OR (" . $or . ")";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTelefone() Function
	 */
	function updateFieldHabilidadesProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE habilidadesProfessor SET " . $field . " = " . $value . " WHERE idHabilidadesProfessor = $this->idHabilidadeProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTelefone() Function
	 */
	function updateHabilidadesProfessor() {
		$sql = "UPDATE habilidadesProfessor SET idHabilidade = $this->idHabilidade, idProfessor = $this->idProfessor, obs = $this->obs, anos = $this->anos, escolas = $this->escolas, resposta = $this->resposta WHERE idHabilidadesProfessor = $this->idHabilidadesProfessor";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTelefone() Function
	 */
	function selectHabilidadesProfessor($where = "") {
		$sql = "SELECT SQL_CACHE idHabilidadesProfessor, idHabilidade, idProfessor, obs, anos, escolas, resposta FROM habilidadesProfessor " . $where;
//		echo $sql;
		return $this -> executeQuery($sql);
	}

}
?>