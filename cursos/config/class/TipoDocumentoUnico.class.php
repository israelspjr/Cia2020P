<?php
class TipoDocumentoUnico extends Database {
	// class attributes
	var $idTipoDocumentoUnico;
	var $valor;
	var $inativo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoDocumentoUnico = "NULL";
		$this -> valor = "NULL";
		$this -> inativo = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoDocumentoUnico($value) {
		$this -> idTipoDocumentoUnico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addTipodocumentounico() Function
	 */
	function addTipodocumentounico() {
		$sql = "INSERT INTO tipodocumentounico (valor, inativo) VALUES ($this->valor, $this->inativo)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTipodocumentounico() Function
	 */
	function deleteTipodocumentounico() {
		$sql = "DELETE FROM tipodocumentounico WHERE idTipoDocumentoUnico = $this->idTipoDocumentoUnico";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipodocumentounico() Function
	 */
	function updateFieldTipodocumentounico($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipodocumentounico SET " . $field . " = " . $value . " WHERE idTipoDocumentoUnico = $this->idTipoDocumentoUnico";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipodocumentounico() Function
	 */
	function updateTipodocumentounico() {
		$sql = "UPDATE tipodocumentounico SET valor = $this->valor, inativo = $this->inativo WHERE idTipoDocumentoUnico = $this->idTipoDocumentoUnico";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipodocumentounico() Function
	 */
	function selectTipodocumentounico($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoDocumentoUnico, valor, inativo FROM tipodocumentounico " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectTipoDocumentoUnicoSelect() Function
	 */
	function selectTipoDocumentoUnicoSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idTipoDocumentoUnico, valor, class FROM tipoDocumentoUnico 
		WHERE inativo = 0 ORDER BY ordem ";
		$result = $this -> query($sql);

		$html = "<select id=\"tipoDocumentoUnico_idTipoDocumentoUnico\" name=\"tipoDocumentoUnico_idTipoDocumentoUnico\" class=\"" . $classes . "\" >
			<option value=\"\">Selecione</option>";

		while ($valor = mysqli_fetch_array($result)) {

			$selecionado = $idAtual == $valor['idTipoDocumentoUnico'] ? "selected=\"selected\"" : "";

			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoDocumentoUnico'] . "\" item=\"" . $valor['class'] . "\">" . $valor['valor'] . "</option>";

		}

		$html .= "</select>";
		return $html;
	}

}
?>