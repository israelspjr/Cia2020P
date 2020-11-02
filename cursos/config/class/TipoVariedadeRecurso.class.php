<?php
class TipoVariedadeRecurso extends Database {
	// class attributes
	var $idTipoVariedadeRecurso;
	var $tipo;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoVariedadeRecurso = "NULL";
		$this -> tipo = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoVariedadeRecurso($value) {
		$this -> idTipoVariedadeRecurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addTipoVariedadeRecurso() Function
	 */
	function addTipoVariedadeRecurso() {
		$sql = "INSERT INTO tipoVariedadeRecurso (tipo, inativo, excluido) VALUES ($this->tipo, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteTipoVariedadeRecurso() Function
	 */
	function deleteTipoVariedadeRecurso() {
		$sql = "DELETE FROM tipoVariedadeRecurso WHERE idTipoVariedadeRecurso = $this->idTipoVariedadeRecurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipoVariedadeRecurso() Function
	 */
	function updateFieldTipoVariedadeRecurso($field, $value) {
		$value = ($value != "NULL") ? "'" . $this -> gravarBD($value) . "'" : $this -> gravarBD($value);
		$sql = "UPDATE tipoVariedadeRecurso SET " . $field . " = " . $value . " WHERE idTipoVariedadeRecurso = $this->idTipoVariedadeRecurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipoVariedadeRecurso() Function
	 */
	function updateTipoVariedadeRecurso() {
		$sql = "UPDATE tipoVariedadeRecurso SET tipo = $this->tipo, inativo = $this->inativo WHERE idTipoVariedadeRecurso = $this->idTipoVariedadeRecurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipoVariedadeRecurso() Function
	 */
	function selectTipoVariedadeRecurso($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoVariedadeRecurso, tipo, inativo, excluido FROM tipoVariedadeRecurso " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectTipoVariedadeRecursoTr() Function
	 */
	function selectTipoVariedadeRecursoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idTipoVariedadeRecurso, tipo, inativo, excluido FROM tipoVariedadeRecurso " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idTipoVariedadeRecurso = $valor['idTipoVariedadeRecurso'];
				$tipo = $valor['tipo'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);

				$html .= "<td>" . $idTipoVariedadeRecurso . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this,'".$caminhoAbrir."?id=" . $valor['idTipoVariedadeRecurso'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '" . $ondeAtualiza . "')\" >" . $tipo . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idTipoVariedadeRecurso'] . ", '" . $caminhoAtualizar . "', '" . $ondeAtualiza . "')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectTipoVariedadeRecursoSelect() Function
	 */
	function selectTipoVariedadeRecursoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idTipoVariedadeRecurso, tipo, inativo FROM tipoVariedadeRecurso " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idTipoVariedadeRecurso\" name=\"idTipoVariedadeRecurso\"  class=\"" . $classes . "\" >";
		$html = $html . "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoVariedadeRecurso'] ? "selected=\"selected\"" : "";
			$html = $html . "<option " . $selecionado . " value=\"" . $valor['idTipoVariedadeRecurso'] . "\">" . ($valor['tipo']) . "</option>";
		}

		$html = $html . "</select>";
		return $html;
	}

}
?>