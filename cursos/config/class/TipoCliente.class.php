<?php
class TipoCliente extends Database {
	// class attributes
	var $idTipoCliente;
	var $nome;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoCliente = "NULL";
		$this -> nome = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoCliente($value) {
		$this -> idTipoCliente = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	// class methods
	function setNomeTipoCliente($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addTipocliente() Function
	 */
	function addTipocliente() {
		$sql = "INSERT INTO tipocliente () VALUES ()";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteTipocliente() Function
	 */
	function deleteTipocliente() {
		$sql = "DELETE FROM tipocliente WHERE idTipoCliente = $this->idTipoCliente";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipocliente() Function
	 */
	function updateFieldTipocliente($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipocliente SET " . $field . " = " . $value . " WHERE idTipoCliente = $this->idTipoCliente";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipocliente() Function
	 */
	function updateTipocliente() {
		$sql = "UPDATE tipocliente SET  WHERE idTipoCliente = $this->idTipoCliente";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipocliente() Function
	 */
	function selectTipocliente($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoCliente FROM tipocliente " . $where;
		return $this -> executeQuery($sql);
	}

	function selectTipoClienteSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT idTipoCliente, tipo FROM tipoCliente ORDER BY tipo";
		$result = $this -> query($sql);
		$html = "<select id=\"TipoCliente_idTipoCliente\" name=\"TipoCliente_idTipoCliente\"  class=\"" . $classes . "\" >";
		$s = $idAtual == 0 ? "selected=\"selected\"" : "";
		$html .= "<option value=\"\" $s >Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoCliente'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoCliente'] . "\">" . $valor['tipo'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function selectTipoClienteSelectMult($classes = "", $idAtual = 0) {
		
		$sql = "SELECT idTipoCliente, tipo FROM tipoCliente ORDER BY tipo";
		$result = $this -> query($sql);
		$s = $idAtual == 0 ? "selected=\"selected\"" : "";
        
		$html = "<select id=\"TipoCliente_idTipoCliente\" name=\"TipoCliente_idTipoCliente[]\" multiple=\"multiple\" class=\"" . $classes . "\" >
		<option value=\"\" $s>Todos</option>";
		
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoCliente'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoCliente'] . "\">" . $valor['tipo'] . "</option>";
		}
		
		$html .= "</select>";
		return $html;
	}

}
?>