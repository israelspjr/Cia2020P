<?php
class EstadoCivil extends Database {
	// class attributes
	var $idEstadoCivil;
	var $valor;
	var $inativo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idEstadoCivil = "NULL";
		$this -> valor = "NULL";
		$this -> inativo = 0;

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdEstadoCivil($value) {
		$this -> idEstadoCivil = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : 0;
	}

	/**
	 * addEstadocivil() Function
	 */
	function addEstadocivil() {
		$sql = "INSERT INTO estadoCivil (valor, inativo) VALUES ($this->valor, $this->inativo)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	function addEstadocivil_M() {
    $sql = "INSERT INTO estadoCivil (idEstadoCivil, valor, inativo) VALUES ($this->idEstadoCivil, $this->valor, $this->inativo)";
    $result = $this -> query($sql, true);
    return mysqli_insert_id($this -> connect);
  }

	/**
	 * deleteEstadocivil() Function
	 */
	function deleteEstadocivil() {
		$sql = "DELETE FROM estadoCivil WHERE idEstadoCivil = $this->idEstadoCivil";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldEstadocivil() Function
	 */
	function updateFieldEstadocivil($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE estadoCivil SET " . $field . " = " . $value . " WHERE idEstadoCivil = $this->idEstadoCivil";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateEstadocivil() Function
	 */
	function updateEstadocivil() {
		$sql = "UPDATE estadoCivil SET valor = $this->valor, inativo = $this->inativo WHERE idEstadoCivil = $this->idEstadoCivil";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectEstadocivil() Function
	 */
	function selectEstadocivil($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idEstadoCivil, valor, inativo FROM estadoCivil " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectEstadocivilHtml() Function
	 */
	function selectEstadocivilSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idEstadoCivil, valor FROM estadoCivil  WHERE inativo = 0 ORDER BY valor";
		$result = $this -> query($sql);
		$html = "<select id=\"estadoCivil_idEstadoCivil\" name=\"estadoCivil_idEstadoCivil\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idEstadoCivil'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idEstadoCivil'] . "\">" . $valor['valor'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
    function getEstadoCivil($id){
        $sql = "SELECT SQL_CACHE valor FROM estadoCivil  WHERE inativo = 0 AND idEstadoCivil = ".$id;
        $result = $this -> executeQuery($sql);
        return $result[0]['valor'];
    }
}