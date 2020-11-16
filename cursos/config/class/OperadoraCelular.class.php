<?php
class Operadoracelular extends Database {
	// class attributes
	var $idOperadoraCelular;
	var $nome;
	var $inativo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idOperadoraCelular = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdOperadoraCelular($value) {
		$this -> idOperadoraCelular = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addOperadoracelular() Function
	 */
	function addOperadoracelular() {
		$sql = "INSERT INTO operadoraCelular (nome, inativo) VALUES ($this->nome, $this->inativo)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteOperadoracelular() Function
	 */
	function deleteOperadoracelular() {
		$sql = "DELETE FROM operadoraCelular WHERE idOperadoraCelular = $this->idOperadoraCelular";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldOperadoracelular() Function
	 */
	function updateFieldOperadoracelular($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE operadoraCelular SET " . $field . " = " . $value . " WHERE idOperadoraCelular = $this->idOperadoraCelular";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateOperadoracelular() Function
	 */
	function updateOperadoracelular() {
		$sql = "UPDATE operadoraCelular SET nome = $this->nome, inativo = $this->inativo WHERE idOperadoraCelular = $this->idOperadoraCelular";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectOperadoraCelularTr() Function
	 */
	function selectOperadoraCelularTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idOperadoraCelular, nome, inativo, excluido FROM operadoraCelular " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idOperadoraCelular = $valor['idOperadoraCelular'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idOperadoraCelular . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idOperadoraCelular'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idOperadoraCelular'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectOperadoracelular() Function
	 */
	function selectOperadoracelular($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idOperadoraCelular, nome, inativo FROM operadoracelular " . $where;
		return $this -> executeQuery($sql);
	}

	function selectOperadoracelularSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idOperadoraCelular, nome FROM operadoraCelular WHERE inativo = 0 ORDER BY nome";
		$result = $this -> query($sql);
		$html = "<select id=\"idOperadoraCelular\" name=\"idOperadoraCelular\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idOperadoraCelular'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idOperadoraCelular'] . "\">" . ($valor['nome']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>