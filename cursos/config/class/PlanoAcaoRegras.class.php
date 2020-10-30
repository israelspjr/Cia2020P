<?php
class PlanoAcaoRegras extends Database {
	// class attributes
	var $idPlanoAcaoRegras;
	var $planoAcaoIdPlanoAcao;
	var $regrasIdRegras;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPlanoAcaoRegras = "NULL";
		$this -> planoAcaoIdPlanoAcao = "NULL";
		$this -> regrasIdRegras = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPlanoAcaoRegras($value) {
		$this -> idPlanoAcaoRegras = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoIdPlanoAcao($value) {
		$this -> planoAcaoIdPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setRegrasIdRegras($value) {
		$this -> regrasIdRegras = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addPlanoAcaoRegras() Function
	 */
	function addPlanoAcaoRegras() {
		$sql = "INSERT INTO planoAcaoRegras (planoAcao_idPlanoAcao, regras_idRegras, dataCadastro) VALUES ($this->planoAcaoIdPlanoAcao, $this->regrasIdRegras, $this->dataCadastro)";
//		echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deletePlanoAcaoRegras() Function
	 */
	function deletePlanoAcaoRegras($and = "") {
		$sql = "DELETE FROM planoAcaoRegras WHERE idPlanoAcaoRegras = $this->idPlanoAcaoRegras " . $and;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPlanoAcaoRegras() Function
	 */
	function updateFieldPlanoAcaoRegras($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE planoAcaoRegras SET " . $field . " = " . $value . " WHERE idPlanoAcaoRegras = $this->idPlanoAcaoRegras";
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePlanoAcaoRegras() Function
	 */
	function updatePlanoAcaoRegras() {
		//, dataCadastro = $this->dataCadastro
		$sql = "UPDATE planoAcaoRegras SET planoAcao_idPlanoAcao = $this->planoAcaoIdPlanoAcao, regras_idRegras = $this->regrasIdRegras WHERE idPlanoAcaoRegras = $this->idPlanoAcaoRegras";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPlanoAcaoRegras() Function
	 */
	function selectPlanoAcaoRegras($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPlanoAcaoRegras, planoAcao_idPlanoAcao, regras_idRegras, dataCadastro FROM planoAcaoRegras " . $where;
//		echo $sql;
		return $this -> executeQuery($sql);
	}

}
?>