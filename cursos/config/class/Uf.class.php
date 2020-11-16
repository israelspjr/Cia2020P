<?php
class Uf extends Database {
	// class attributes
	var $idUf;
	var $uf;
    var $ufNome;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idUf = "NULL";
		$this -> uf = "NULL";
        $this -> ufNome = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdUf($value) {
		$this -> idUf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setUf($value) {
		$this -> uf = ($value) ? $this -> gravarBD($value) : "NULL";
	}
  function setUfNome($value) {
    $this -> ufNome = ($value) ? $this -> gravarBD($value) : "NULL";    
  }
	/**
	 * addUf() Function
	 */
	function addUf() {
		$sql = "INSERT INTO uf (idUF, uf, nome) VALUES ($this->idUf, $this->uf, $this->ufNome)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteUf() Function
	 */
	function deleteUf() {
		$sql = "DELETE FROM uf WHERE idUf = $this->idUf";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldUf() Function
	 */
	function updateFieldUf($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE uf SET " . $field . " = " . $value . " WHERE idUf = $this->idUf";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateUf() Function
	 */
	function updateUf() {
		$sql = "UPDATE uf SET uf = $this->uf WHERE idUf = $this->idUf";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectUf() Function
	 */
	function selectUf($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idUf, uf FROM uf " . $where;
		return $this -> executeQuery($sql);
	}

	function selectUfSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idUf, nome FROM uf ORDER BY nome";
		$result = $this -> query($sql);
		$html = "<select id=\"idUf\" name=\"idUf\"  class=\"" . $classes . "\" onchange=\"atualizaCidade(this.value)\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idUf'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idUf'] . "\">" . ($valor['nome']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function selectUfPorCidade($idCidade) {
		$sql = "SELECT SQL_CACHE idUf FROM uf ";
		$sql .= " INNER JOIN cidade AS c ON c.uf_idUf = uf.idUf ";
		$sql .= " WHERE c.idCidade = " . $idCidade;
		$result = $this -> query($sql);
		if ($valor = mysqli_fetch_array($result)) {
			return $valor['idUf'];
		} else {
			return 0;
		}
	}

}
?>