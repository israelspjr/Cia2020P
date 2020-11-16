<?php
class TipoBaixaPagamento extends Database {
	// class attributes
	var $idTipoBaixaPagamento;
	var $nome;
	var $inativo;
	var $dataCadastro;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoBaixaPagamento = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "0";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoBaixaPagamento($value) {
		$this -> idTipoBaixaPagamento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
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
	
	function getNome($id) {
		$rs = $this -> selectTipoBaixaPagamento(" WHERE idTipoBaixaPagamento = $id");
		return $rs[0]['nome'];
	}

	/**
	 * addTipoBaixaPagamento() Function
	 */
	function addTipoBaixaPagamento() {
		$sql = "INSERT INTO tipoBaixaPagamento (nome, inativo, dataCadastro, excluido) VALUES ($this->nome, $this->inativo, '" . date('Y-m-y H:i:s') . "', $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTipoBaixaPagamento() Function
	 */
	function deleteTipoBaixaPagamento() {
		$sql = "DELETE FROM tipoBaixaPagamento WHERE idTipoBaixaPagamento = $this->idTipoBaixaPagamento";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipoBaixaPagamento() Function
	 */
	function updateFieldTipoBaixaPagamento($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipoBaixaPagamento SET " . $field . " = " . $value . " WHERE idTipoBaixaPagamento = $this->idTipoBaixaPagamento";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipoBaixaPagamento() Function
	 */
	function updateTipoBaixaPagamento() {
		$sql = "UPDATE tipoBaixaPagamento SET nome = $this->nome, inativo = $this->inativo WHERE idTipoBaixaPagamento = $this->idTipoBaixaPagamento";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipoBaixaPagamento() Function
	 */
	function selectTipoBaixaPagamento($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoBaixaPagamento, nome, inativo, dataCadastro, excluido FROM tipoBaixaPagamento " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectTipoBaixaPagamentoTr() Function
	 */
	function selectTipoBaixaPagamentoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idTipoBaixaPagamento, nome, inativo, dataCadastro, excluido FROM tipoBaixaPagamento " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idTipoBaixaPagamento = $valor['idTipoBaixaPagamento'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//
				$dataCadastro = $valor['dataCadastro'];

				$html .= "<td>" . $idTipoBaixaPagamento . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idTipoBaixaPagamento'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				//$html .= "<td>".$dataCadastro."</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idTipoBaixaPagamento'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectTipoBaixaPagamentoSelect() Function
	 */
	function selectTipoBaixaPagamentoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idTipoBaixaPagamento, nome, inativo, dataCadastro FROM tipoBaixaPagamento " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idTipoBaixaPagamento\" name=\"idTipoBaixaPagamento\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoBaixaPagamento'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoBaixaPagamento'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectTipoBaixaPagamentoSelectMult($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idTipoBaixaPagamento, nome, inativo, dataCadastro FROM tipoBaixaPagamento " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idTipoBaixaPagamento\" name=\"idTipoBaixaPagamento[]\" multiple=\"multiple\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Todos</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoBaixaPagamento'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoBaixaPagamento'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>