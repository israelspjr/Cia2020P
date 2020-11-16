<?php
class NaoFazAulaNestaSemanaPlanoAcao extends Database {
	// class attributes
	var $idNaoFazAulaNestaSemanaPlanoAcao;
	var $valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao;
	var $semana;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idNaoFazAulaNestaSemanaPlanoAcao = "NULL";
		$this -> valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao = "NULL";
		$this -> semana = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdNaoFazAulaNestaSemanaPlanoAcao($value) {
		$this -> idNaoFazAulaNestaSemanaPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao($value) {
		$this -> valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setSemana($value) {
		$this -> semana = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addNaoFazAulaNestaSemanaPlanoAcao() Function
	 */
	function addNaoFazAulaNestaSemanaPlanoAcao() {
		$sql = "INSERT INTO naoFazAulaNestaSemanaPlanoAcao (valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao, semana) VALUES ($this->valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao, $this->semana)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteNaoFazAulaNestaSemanaPlanoAcao() Function
	 */
	function deleteNaoFazAulaNestaSemanaPlanoAcao($and = "") {
		$sql = "DELETE FROM naoFazAulaNestaSemanaPlanoAcao WHERE idNaoFazAulaNestaSemanaPlanoAcao = $this->idNaoFazAulaNestaSemanaPlanoAcao " . $and;
		//echo $sql;
		//exit;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldNaoFazAulaNestaSemanaPlanoAcao() Function
	 */
	function updateFieldNaoFazAulaNestaSemanaPlanoAcao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE naoFazAulaNestaSemanaPlanoAcao SET " . $field . " = " . $value . " WHERE idNaoFazAulaNestaSemanaPlanoAcao = $this->idNaoFazAulaNestaSemanaPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateNaoFazAulaNestaSemanaPlanoAcao() Function
	 */
	function updateNaoFazAulaNestaSemanaPlanoAcao() {
		$sql = "UPDATE naoFazAulaNestaSemanaPlanoAcao SET valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = $this->valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao, semana = $this->semana WHERE idNaoFazAulaNestaSemanaPlanoAcao = $this->idNaoFazAulaNestaSemanaPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectNaoFazAulaNestaSemanaPlanoAcao() Function
	 */
	function selectNaoFazAulaNestaSemanaPlanoAcao($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idNaoFazAulaNestaSemanaPlanoAcao, valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao, semana FROM naoFazAulaNestaSemanaPlanoAcao " . $where;
		return $this -> executeQuery($sql);
	}

}
?>