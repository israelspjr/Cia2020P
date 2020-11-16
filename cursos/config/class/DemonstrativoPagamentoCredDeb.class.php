<?php
class DemonstrativoPagamentoCredDeb extends Database {
	// class attributes
	var $idDemonstrativoPagamentoCredDeb;
	var $demonstrativoPagamentoIdDemonstrativoPagamento;
	var $tipo;
	var $valor;
	var $obs;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDemonstrativoPagamentoCredDeb = "NULL";
		$this -> demonstrativoPagamentoIdDemonstrativoPagamento = "NULL";
		$this -> tipo = "NULL";
		$this -> valor = "NULL";
		$this -> obs = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDemonstrativoPagamentoCredDeb($value) {
		$this -> idDemonstrativoPagamentoCredDeb = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDemonstrativoPagamentoIdDemonstrativoPagamento($value) {
		$this -> demonstrativoPagamentoIdDemonstrativoPagamento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addDemonstrativoPagamentoCredDeb() Function
	 */
	function addDemonstrativoPagamentoCredDeb() {
		$sql = "INSERT INTO demonstrativoPagamentoCredDeb (demonstrativoPagamento_idDemonstrativoPagamento, tipo, valor, obs, dataCadastro) VALUES ($this->demonstrativoPagamentoIdDemonstrativoPagamento, $this->tipo, $this->valor, $this->obs, $this->dataCadastro)";
		//echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteDemonstrativoPagamentoCredDeb() Function
	 */
	function deleteDemonstrativoPagamentoCredDeb($or = "") {
		$sql = "DELETE FROM demonstrativoPagamentoCredDeb WHERE idDemonstrativoPagamentoCredDeb = $this->idDemonstrativoPagamentoCredDeb " . $or;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDemonstrativoPagamentoCredDeb() Function
	 */
	function updateFieldDemonstrativoPagamentoCredDeb($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE demonstrativoPagamentoCredDeb SET " . $field . " = " . $value . " WHERE idDemonstrativoPagamentoCredDeb = $this->idDemonstrativoPagamentoCredDeb";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDemonstrativoPagamentoCredDeb() Function
	 */
	function updateDemonstrativoPagamentoCredDeb() {
		$sql = "UPDATE demonstrativoPagamentoCredDeb SET demonstrativoPagamento_idDemonstrativoPagamento = $this->demonstrativoPagamentoIdDemonstrativoPagamento, tipo = $this->tipo, valor = $this->valor, obs = $this->obs,  WHERE idDemonstrativoPagamentoCredDeb = $this->idDemonstrativoPagamentoCredDeb";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDemonstrativoPagamentoCredDeb() Function
	 */
	function selectDemonstrativoPagamentoCredDeb($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamentoCredDeb, demonstrativoPagamento_idDemonstrativoPagamento, tipo, valor, obs, dataCadastro FROM demonstrativoPagamentoCredDeb " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectDemonstrativoPagamentoCredDebTr() Function
	 */
	function selectDemonstrativoPagamentoCredDebTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamentoCredDeb, demonstrativoPagamento_idDemonstrativoPagamento, tipo, valor, obs, dataCadastro FROM demonstrativoPagamentoCredDeb " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idDemonstrativoPagamentoCredDeb'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idDemonstrativoPagamentoCredDeb'] . "</td>";
				$html .= "<td>" . $valor['demonstrativoPagamento_idDemonstrativoPagamento'] . "</td>";
				$html .= "<td>" . $valor['tipo'] . "</td>";
				$html .= "<td>" . $valor['valor'] . "</td>";
				$html .= "<td>" . $valor['obs'] . "</td>";
				$html .= "<td>" . $valor['dataCadastro'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/DemonstrativoPagamentoCredDeb.php', " . $valor['idDemonstrativoPagamentoCredDeb'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectDemonstrativoPagamentoCredDebSelect() Function
	 */
	function selectDemonstrativoPagamentoCredDebSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamentoCredDeb, demonstrativoPagamento_idDemonstrativoPagamento, tipo, valor, obs, dataCadastro FROM demonstrativoPagamentoCredDeb " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDemonstrativoPagamentoCredDeb\" name=\"idDemonstrativoPagamentoCredDeb\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDemonstrativoPagamentoCredDeb'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDemonstrativoPagamentoCredDeb'] . "\">" . ($valor['idDemonstrativoPagamentoCredDeb']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>