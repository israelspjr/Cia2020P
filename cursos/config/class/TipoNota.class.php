<?php
class TipoNota extends Database {
	// class attributes
	var $idTipoNota;
	var $nome;
	var $descricao;
	var $inativo;
	var $excluido;
	var $descritiva;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoNota = "NULL";
		$this -> nome = "NULL";
		$this -> descricao = "NULL";
		$this -> inativo = "0";
		$this -> excluido = "0";
		$this -> descritiva ="0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoNota($value) {
		$this -> idTipoNota = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDescricao($value) {
		$this -> descricao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
	function setDescritiva($value){
		$this -> descritiva = ($value) ? $this ->gravarBD($value) : "0";
	}

	/**
	 * addTipoNota() Function
	 */
	function addTipoNota() {
		$sql = "INSERT INTO tipoNota (nome, descricao, inativo, excluido, descritiva) VALUES ($this->nome, $this->descricao, $this->inativo, $this->excluido, $this->descritiva)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteTipoNota() Function
	 */
	function deleteTipoNota() {
		$sql = "DELETE FROM tipoNota WHERE idTipoNota = $this->idTipoNota";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipoNota() Function
	 */
	function updateFieldTipoNota($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipoNota SET " . $field . " = " . $value . " WHERE idTipoNota = $this->idTipoNota";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipoNota() Function
	 */
	function updateTipoNota() {
		$sql = "UPDATE tipoNota SET nome = $this->nome, descricao = $this->descricao, inativo = $this->inativo, descritiva = $this->descritiva WHERE idTipoNota = $this->idTipoNota";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipoNota() Function
	 */
	function selectTipoNota($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoNota, nome, descricao, inativo, excluido, descritiva FROM tipoNota " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectTipoNotaTr() Function
	 */
	function selectTipoNotaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idTipoNota, nome, descricao, inativo, excluido, descritiva FROM tipoNota " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idTipoNota = $valor['idTipoNota'];
				$nome = $valor['nome'];
				$descricao = $valor['descricao'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				$descritiva = Uteis::exibirStatus($valor['descritiva']);
				//

				$html .= "<td>" . $idTipoNota . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idTipoNota'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				$html .= "<td>" . $descricao . "</td>";
				$html .= "<td align='center'>" . $inativo . "</td>";
				$html .= "<td align='center'>" . $descritiva . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idTipoNota'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectTipoNotaSelect() Function
	 */
	function selectTipoNotaSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idTipoNota, nome, descricao, inativo, excluido, descritiva FROM tipoNota " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idTipoNota\" name=\"idTipoNota\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoNota'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoNota'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>