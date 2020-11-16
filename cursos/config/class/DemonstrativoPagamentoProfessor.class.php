<?php
class DemonstrativoPagamentoProfessor extends Database {
	// class attributes
	var $idDemonstrativoPagamentoProfessor;
	var $professorIdProfessor;
	var $mes;
	var $ano;
	var $html;
	var $debitos;
	var $creditos;
	var $aulas;
	var $impostos;
	var $total;
	var $dataGerado;
	var $tipoPagamentoIdTipoPagamento;
	var $dataPagamento;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDemonstrativoPagamentoProfessor = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> mes = "NULL";
		$this -> ano = "NULL";
		$this -> html = "NULL";
		$this -> debitos = "NULL";
		$this -> creditos = "NULL";
		$this -> aulas = "NULL";
		$this -> impostos = "NULL";
		$this -> total = "NULL";
		$this -> dataGerado = "NULL";
		$this -> tipoPagamentoIdTipoPagamento = "NULL";
		$this -> dataPagamento = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDemonstrativoPagamentoProfessor($value) {
		$this -> idDemonstrativoPagamentoProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMes($value) {
		$this -> mes = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAno($value) {
		$this -> ano = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHtml($value) {
		$this -> html = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDebitos($value) {
		$this -> debitos = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCreditos($value) {
		$this -> creditos = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAulas($value) {
		$this -> aulas = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setImpostos($value) {
		$this -> impostos = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTotal($value) {
		$this -> total = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataGerado($value) {
		$this -> dataGerado = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoPagamentoIdTipoPagamento($value) {
		$this -> tipoPagamentoIdTipoPagamento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataPagamento($value) {
		$this -> dataPagamento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addDemonstrativoPagamentoProfessor() Function
	 */
	function addDemonstrativoPagamentoProfessor() {
		$sql = "INSERT INTO demonstrativoPagamentoProfessor (professor_idProfessor, mes, ano, html, debitos, creditos, aulas, impostos, total, dataGerado, tipoPagamento_idTipoPagamento, dataPagamento) VALUES ($this->professorIdProfessor, $this->mes, $this->ano, $this->html, $this->debitos, $this->creditos, $this->aulas, $this->impostos, $this->total, $this->dataGerado, $this->tipoPagamentoIdTipoPagamento, $this->dataPagamento)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteDemonstrativoPagamentoProfessor() Function
	 */
	function deleteDemonstrativoPagamentoProfessor() {
		$sql = "DELETE FROM demonstrativoPagamentoProfessor WHERE idDemonstrativoPagamentoProfessor = $this->idDemonstrativoPagamentoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDemonstrativoPagamentoProfessor() Function
	 */
	function updateFieldDemonstrativoPagamentoProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE demonstrativoPagamentoProfessor SET " . $field . " = " . $value . " WHERE idDemonstrativoPagamentoProfessor = $this->idDemonstrativoPagamentoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDemonstrativoPagamentoProfessor() Function
	 */
	function updateDemonstrativoPagamentoProfessor() {
		$sql = "UPDATE demonstrativoPagamentoProfessor SET professor_idProfessor = $this->professorIdProfessor, mes = $this->mes, ano = $this->ano, html = $this->html, debitos = $this->debitos, creditos = $this->creditos, aulas = $this->aulas, impostos = $this->impostos, total = $this->total, dataGerado = $this->dataGerado, tipoPagamento_idTipoPagamento = $this->tipoPagamentoIdTipoPagamento, dataPagamento = $this->dataPagamento WHERE idDemonstrativoPagamentoProfessor = $this->idDemonstrativoPagamentoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDemonstrativoPagamentoProfessor() Function
	 */
	function selectDemonstrativoPagamentoProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamentoProfessor, professor_idProfessor, mes, ano, html, debitos, creditos, aulas, impostos, total, dataGerado, tipoPagamento_idTipoPagamento, dataPagamento FROM demonstrativoPagamentoProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectDemonstrativoPagamentoProfessorTr() Function
	 */
	function selectDemonstrativoPagamentoProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamentoProfessor, professor_idProfessor, mes, ano, html, debitos, creditos, aulas, impostos, total, dataGerado, tipoPagamento_idTipoPagamento, dataPagamento FROM demonstrativoPagamentoProfessor " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idDemonstrativoPagamentoProfessor'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idDemonstrativoPagamentoProfessor'] . "</td>";
				$html .= "<td>" . $valor['professor_idProfessor'] . "</td>";
				$html .= "<td>" . $valor['mes'] . "</td>";
				$html .= "<td>" . $valor['ano'] . "</td>";
				$html .= "<td>" . $valor['html'] . "</td>";
				$html .= "<td>" . $valor['debitos'] . "</td>";
				$html .= "<td>" . $valor['creditos'] . "</td>";
				$html .= "<td>" . $valor['aulas'] . "</td>";
				$html .= "<td>" . $valor['impostos'] . "</td>";
				$html .= "<td>" . $valor['total'] . "</td>";
				$html .= "<td>" . $valor['dataGerado'] . "</td>";
				$html .= "<td>" . $valor['tipoPagamento_idTipoPagamento'] . "</td>";
				$html .= "<td>" . $valor['dataPagamento'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/DemonstrativoPagamentoProfessor.php', " . $valor['idDemonstrativoPagamentoProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectDemonstrativoPagamentoProfessorSelect() Function
	 */
	function selectDemonstrativoPagamentoProfessorSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamentoProfessor, professor_idProfessor, mes, ano, html, debitos, creditos, aulas, impostos, total, dataGerado, tipoPagamento_idTipoPagamento, dataPagamento FROM demonstrativoPagamentoProfessor " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDemonstrativoPagamentoProfessor\" name=\"idDemonstrativoPagamentoProfessor\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDemonstrativoPagamentoProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDemonstrativoPagamentoProfessor'] . "\">" . ($valor['idDemonstrativoPagamentoProfessor']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>

