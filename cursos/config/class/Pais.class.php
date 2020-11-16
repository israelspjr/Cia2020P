<?php
class Pais extends Database {
	// class attributes
	var $idPais;
	var $pais;
	var $nacionalidade;
	var $inativo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPais = "NULL";
		$this -> pais = "NULL";
		$this -> nacionalidade = "NULL";
		$this -> inativo = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPais($value) {
		$this -> idPais = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPais($value) {
		$this -> pais = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNacionalidade($value) {
		$this -> nacionalidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addPais() Function
	 */
	function addPais() {
		$sql = "INSERT INTO pais (pais, nacionalidade, inativo) VALUES ($this->pais, $this->nacionalidade, $this->inativo)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deletePais() Function
	 */
	function deletePais() {
		$sql = "DELETE FROM pais WHERE idPais = $this->idPais";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPais() Function
	 */
	function updateFieldPais($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE pais SET " . $field . " = " . $value . " WHERE idPais = $this->idPais";
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePais() Function
	 */
	function updatePais() {
		$sql = "UPDATE pais SET pais = $this->pais, nacionalidade = $this->nacionalidade, inativo = $this->inativo WHERE idPais = $this->idPais";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPais() Function
	 */
	function selectPais($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPais, pais, nacionalidade, inativo FROM pais " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectPaisSelect() Function
	 */
	function selectPaisSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idPais, pais FROM pais  WHERE inativo = 0 ORDER BY pais";
		$result = $this -> query($sql);
		$html = "<select id=\"pais_idPais\" name=\"pais_idPais\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idPais'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idPais'] . "\">" . ($valor['pais']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>