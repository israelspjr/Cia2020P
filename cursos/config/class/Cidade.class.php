<?php
class Cidade extends Database {
	// class attributes
	var $idCidade;
	var $ufIdUf;
    var $cidade;
    var $inativo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idCidade = "NULL";
		$this -> ufIdUf = "NULL";
        $this -> cidade = "NULL";
        $this -> inativo = 0;
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdCidade($value) {
		$this -> idCidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setUfIdUf($value) {
		$this -> ufIdUf = ($value) ? $this -> gravarBD($value) : "NULL";
	}
  
    function setCidade($value) {
    	$this -> cidade = ($value) ? $this -> gravarBD($value) : "NULL";
    }
	
  	function setInativo($value) {
    	$this -> inativo = ($value) ? $this -> gravarBD($value) : 0;
    }

	/**
	 * addCidade() Function
	 */
	function addCidade() {
		$sql = "INSERT INTO cidade (idCidade, uf_idUf, cidade, inativo) VALUES ($this->idCidade, $this->ufIdUf, $this->cidade, $this->inativo)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteCidade() Function
	 */
	function deleteCidade() {
		$sql = "DELETE FROM cidade WHERE idCidade = $this->idCidade";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldCidade() Function
	 */
	function updateFieldCidade($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE cidade SET " . $field . " = " . $value . " WHERE idCidade = $this->idCidade";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateCidade() Function
	 */
	function updateCidade() {
		$sql = "UPDATE cidade SET uf_idUf = $this->ufIdUf WHERE idCidade = $this->idCidade";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectCidade() Function
	 */
	function selectCidade($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idCidade, uf_idUf FROM cidade " . $where;
		return $this -> executeQuery($sql);
	}

	function selectCidadeSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idCidade, cidade, Uf_idUf FROM cidade WHERE inativo = 0 ORDER BY cidade ";
		$result = $this -> query($sql);
		$html = "<select id=\"idCidade\" name=\"idCidade\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idCidade'] ? "selected=\"selected\"" : "";
			$html .= "<option iduf=\"" . $valor['Uf_idUf'] . "\" " . $selecionado . " value=\"" . $valor['idCidade'] . "\">" . ($valor['cidade']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function selectCidadePorEstadoSelect($classes = "", $idAtual = 0, $idUf = 0) {
		$sql = "SELECT SQL_CACHE idCidade, cidade, Uf_idUf FROM cidade WHERE inativo = 0 AND Uf_idUf = '" . $idUf . "' ORDER BY cidade ";
		$result = $this -> query($sql);
		$html = "<select id=\"idCidade\" name=\"idCidade\"  class=\"" . $classes . "\" onchange=\"atualizaZonaPorCidade(this.value)\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idCidade'] ? "selected=\"selected\"" : "";
			$html .= "<option iduf=\"" . $valor['Uf_idUf'] . "\" " . $selecionado . " value=\"" . $valor['idCidade'] . "\">" . ($valor['cidade']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>