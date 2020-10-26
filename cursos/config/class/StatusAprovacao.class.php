<?php
class StatusAprovacao extends Database {
	// class attributes
	var $idStatusAprovacao;
	var $status;
	var $inativo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idStatusAprovacao = "NULL";
		$this -> status = "NULL";
		$this -> inativo = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdStatusAprovacao($value) {
		$this -> idStatusAprovacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setStatus($value) {
		$this -> status = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addStatusAprovacao() Function
	 */
	function addStatusAprovacao() {
		$sql = "INSERT INTO statusAprovacao (status, inativo) VALUES ($this->status, $this->inativo)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteStatusAprovacao() Function
	 */
	function deleteStatusAprovacao() {
		$sql = "DELETE FROM statusAprovacao WHERE idStatusAprovacao = $this->idStatusAprovacao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldStatusAprovacao() Function
	 */
	function updateFieldStatusAprovacao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE statusAprovacao SET " . $field . " = " . $value . " WHERE idStatusAprovacao = $this->idStatusAprovacao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateStatusAprovacao() Function
	 */
	function updateStatusAprovacao() {
		$sql = "UPDATE statusAprovacao SET status = $this->status, inativo = $this->inativo WHERE idStatusAprovacao = $this->idStatusAprovacao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectStatusAprovacao() Function
	 */
	function selectStatusAprovacao($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idStatusAprovacao, status, inativo FROM statusAprovacao " . $where;
		return $this -> executeQuery($sql);
	}

	function selectStatusAprovacaoSelectMult($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idStatusAprovacao, status, inativo FROM statusAprovacao " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idStatusAprovacao\" name=\"idStatusAprovacao[]\" multiple=\"multiple\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Todos</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idStatusAprovacao'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idStatusAprovacao'] . "\">" . ($valor['status']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>