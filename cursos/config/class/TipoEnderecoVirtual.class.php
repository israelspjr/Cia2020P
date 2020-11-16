<?php
class TipoEnderecoVirtual extends Database {
	// class attributes
	var $idTipoEnderecoVirtual;
	var $tipo;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoEnderecoVirtual = "NULL";
		$this -> tipo = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoEnderecoVirtual($value) {
		$this -> idTipoEnderecoVirtual = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addTipoEnderecoVirtual() Function
	 */
	function addTipoEnderecoVirtual() {
		$sql = "INSERT INTO tipoEnderecoVirtual (tipo, inativo, excluido) VALUES ($this->tipo, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTipoEnderecoVirtual() Function
	 */
	function deleteTipoEnderecoVirtual() {
		$sql = "DELETE FROM tipoEnderecoVirtual WHERE idTipoEnderecoVirtual = $this->idTipoEnderecoVirtual";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipoEnderecoVirtual() Function
	 */
	function updateFieldTipoEnderecoVirtual($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipoEnderecoVirtual SET " . $field . " = " . $value . " WHERE idTipoEnderecoVirtual = $this->idTipoEnderecoVirtual";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipoEnderecoVirtual() Function
	 */
	function updateTipoEnderecoVirtual() {
		$sql = "UPDATE tipoEnderecoVirtual SET tipo = $this->tipo, inativo = $this->inativo WHERE idTipoEnderecoVirtual = $this->idTipoEnderecoVirtual";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipoEnderecoVirtual() Function
	 */
	function selectTipoEnderecoVirtual($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoEnderecoVirtual, tipo, inativo, excluido FROM tipoEnderecoVirtual " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectTipoEnderecoVirtualTr() Function
	 */
	function selectTipoEnderecoVirtualTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idTipoEnderecoVirtual, tipo, inativo, excluido FROM tipoEnderecoVirtual " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idTipoEnderecoVirtual = $valor['idTipoEnderecoVirtual'];
				$tipo = $valor['tipo'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idTipoEnderecoVirtual . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idTipoEnderecoVirtual'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $tipo . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idTipoEnderecoVirtual'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectTipoEnderecoVirtualSelect() Function
	 */
	function selectTipoenderecovirtualSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idTipoenderecovirtual, tipo FROM tipoEnderecoVirtual  WHERE inativo = 0 ORDER BY tipo";
		$result = $this -> query($sql);
		$html = "<select id=\"idTipo\" name=\"idTipo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoenderecovirtual'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoenderecovirtual'] . "\">" . ($valor['tipo']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>