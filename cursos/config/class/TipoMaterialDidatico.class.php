<?php
class TipoMaterialDidatico extends Database {
	// class attributes
	var $idTipoMaterialDidatico;
	var $tipo;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoMaterialDidatico = "NULL";
		$this -> tipo = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoMaterialDidatico($value) {
		$this -> idTipoMaterialDidatico = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addTipoMaterialDidatico() Function
	 */
	function addTipoMaterialDidatico() {
		$sql = "INSERT INTO tipoMaterialDidatico (tipo, inativo, excluido) VALUES ($this->tipo, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTipoMaterialDidatico() Function
	 */
	function deleteTipoMaterialDidatico() {
		$sql = "DELETE FROM tipoMaterialDidatico WHERE idTipoMaterialDidatico = $this->idTipoMaterialDidatico";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipoMaterialDidatico() Function
	 */
	function updateFieldTipoMaterialDidatico($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipoMaterialDidatico SET " . $field . " = " . $value . " WHERE idTipoMaterialDidatico = $this->idTipoMaterialDidatico";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipoMaterialDidatico() Function
	 */
	function updateTipoMaterialDidatico() {
		$sql = "UPDATE tipoMaterialDidatico SET tipo = $this->tipo, inativo = $this->inativo WHERE idTipoMaterialDidatico = $this->idTipoMaterialDidatico";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipoMaterialDidatico() Function
	 */
	function selectTipoMaterialDidatico($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoMaterialDidatico, tipo, inativo, excluido FROM tipoMaterialDidatico " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectTipoMaterialDidaticoTr() Function
	 */
	function selectTipoMaterialDidaticoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idTipoMaterialDidatico, tipo, inativo, excluido FROM tipoMaterialDidatico " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idTipoMaterialDidatico = $valor['idTipoMaterialDidatico'];
				$tipo = $valor['tipo'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idTipoMaterialDidatico . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idTipoMaterialDidatico'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $tipo . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idTipoMaterialDidatico'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectTipoMaterialDidaticoSelect() Function
	 */
	function selectTipoMaterialDidaticoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idTipoMaterialDidatico, tipo, inativo, excluido FROM tipoMaterialDidatico " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idTipoMaterialDidatico\" name=\"idTipoMaterialDidatico\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoMaterialDidatico'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoMaterialDidatico'] . "\">" . ($valor['tipo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>