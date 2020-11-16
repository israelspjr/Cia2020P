<?php
class ExpectativaInicio extends Database {
	// class attributes
	var $idExpectativaInicio;
	var $expectativa;
	var $inativo;
	var $dataCadastro;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idExpectativaInicio = "NULL";
		$this -> expectativa = "NULL";
		$this -> inativo = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdExpectativaInicio($value) {
		$this -> idExpectativaInicio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExpectativa($value) {
		$this -> expectativa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addExpectativaInicio() Function
	 */
	function addExpectativaInicio() {
		$sql = "INSERT INTO expectativaInicio (expectativa, inativo, dataCadastro, excluido) VALUES ($this->expectativa, $this->inativo, '" . date('Y-m-y H:i:s') . "', $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteExpectativaInicio() Function
	 */
	function deleteExpectativaInicio() {
		$sql = "DELETE FROM expectativaInicio WHERE idExpectativaInicio = $this->idExpectativaInicio";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldExpectativaInicio() Function
	 */
	function updateFieldExpectativaInicio($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE expectativaInicio SET " . $field . " = " . $value . " WHERE idExpectativaInicio = $this->idExpectativaInicio";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateExpectativaInicio() Function
	 */
	function updateExpectativaInicio() {
		$sql = "UPDATE expectativaInicio SET expectativa = $this->expectativa, inativo = $this->inativo WHERE idExpectativaInicio = $this->idExpectativaInicio";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectExpectativaInicio() Function
	 */
	function selectExpectativaInicio($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idExpectativaInicio, expectativa, inativo, dataCadastro, excluido FROM expectativaInicio " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectExpectativaInicioTr() Function
	 */
	function selectExpectativaInicioTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idExpectativaInicio, expectativa, inativo, dataCadastro, excluido FROM expectativaInicio " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idExpectativaInicio = $valor['idExpectativaInicio'];
				$expectativa = $valor['expectativa'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//
				$dataCadastro = $valor['dataCadastro'];

				$html .= "<td>" . $idExpectativaInicio . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idExpectativaInicio'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $expectativa . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				//$html .= "<td>".$dataCadastro."</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idExpectativaInicio'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectExpectativaInicioSelect() Function
	 */
	function selectExpectativaInicioSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idExpectativaInicio, expectativa FROM expectativaInicio WHERE inativo = 0 ORDER BY expectativa";
		$result = $this -> query($sql);
		$html = "<select id=\"idExpectativaInicio\" name=\"idExpectativaInicio\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idExpectativaInicio'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idExpectativaInicio'] . "\">" . $valor['expectativa'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>