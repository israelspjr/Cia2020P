<?php
class TipoVisita extends Database {
	// class attributes
	var $idTipoVisita;
	var $tipo;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoVisita = "NULL";
		$this -> tipo = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoVisita($value) {
		$this -> idTipoVisita = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addTipoVisita() Function
	 */
	function addTipoVisita() {
		$sql = "INSERT INTO tipoVisita (tipo, inativo, excluido) VALUES ($this->tipo, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteTipoVisita() Function
	 */
	function deleteTipoVisita() {
		$sql = "DELETE FROM tipoVisita WHERE idTipoVisita = $this->idTipoVisita";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipoVisita() Function
	 */
	function updateFieldTipoVisita($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipoVisita SET " . $field . " = " . $value . " WHERE idTipoVisita = $this->idTipoVisita";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipoVisita() Function
	 */
	function updateTipoVisita() {
		$sql = "UPDATE tipoVisita SET tipo = $this->tipo, inativo = $this->inativo WHERE idTipoVisita = $this->idTipoVisita";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipoVisita() Function
	 */
	function selectTipoVisita($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoVisita, tipo, inativo, excluido FROM tipoVisita " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectTipoVisitaTr() Function
	 */
	function selectTipoVisitaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idTipoVisita, tipo, inativo, excluido FROM tipoVisita " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idTipoVisita = $valor['idTipoVisita'];
				$tipo = $valor['tipo'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idTipoVisita . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idTipoVisita'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $tipo . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idTipoVisita'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectTipoVisitaSelect() Function
	 */
	function selectTipoVisitaSelect($classes = "", $idAtual = 0, $and) {
		$sql = "SELECT SQL_CACHE idTipoVisita, tipo FROM tipoVisita  WHERE inativo = 0 " . $and . " ORDER BY tipo";
		$result = $this -> query($sql);
		$html = "<select id=\"idTipoVisita\" name=\"idTipoVisita\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoVisita'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoVisita'] . "\">" . ($valor['tipo']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>