<?php
class PeriodoAcompanhamentoCurso extends Database {
	// class attributes
	var $idPeriodoAcompanhamentoCurso;
	var $mes;
	var $ano;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPeriodoAcompanhamentoCurso = "NULL";
		$this -> mes = "NULL";
		$this -> ano = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPeriodoAcompanhamentoCurso($value) {
		$this -> idPeriodoAcompanhamentoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMes($value) {
		$this -> mes = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAno($value) {
		$this -> ano = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addPeriodoAcompanhamentoCurso() Function
	 */
	function addPeriodoAcompanhamentoCurso() {
		$sql = "INSERT INTO periodoAcompanhamentoCurso (mes, ano, excluido) VALUES ($this->mes, $this->ano, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deletePeriodoAcompanhamentoCurso() Function
	 */
	function deletePeriodoAcompanhamentoCurso() {
		$sql = "DELETE FROM periodoAcompanhamentoCurso WHERE idPeriodoAcompanhamentoCurso = $this->idPeriodoAcompanhamentoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPeriodoAcompanhamentoCurso() Function
	 */
	function updateFieldPeriodoAcompanhamentoCurso($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE periodoAcompanhamentoCurso SET " . $field . " = " . $value . " WHERE idPeriodoAcompanhamentoCurso = $this->idPeriodoAcompanhamentoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePeriodoAcompanhamentoCurso() Function
	 */
	function updatePeriodoAcompanhamentoCurso() {
		$sql = "UPDATE periodoAcompanhamentoCurso SET mes = $this->mes, ano = $this->ano WHERE idPeriodoAcompanhamentoCurso = $this->idPeriodoAcompanhamentoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPeriodoAcompanhamentoCurso() Function
	 */
	function selectPeriodoAcompanhamentoCurso($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPeriodoAcompanhamentoCurso, mes, ano, excluido FROM periodoAcompanhamentoCurso " . $where;
	//	echo "<hr>".$sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectPeriodoAcompanhamentoCursoTr() Function
	 */
	function selectPeriodoAcompanhamentoCursoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idPeriodoAcompanhamentoCurso, mes, ano, excluido FROM periodoAcompanhamentoCurso " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idPeriodoAcompanhamentoCurso = $valor['idPeriodoAcompanhamentoCurso'];
				$mes = Uteis::retornaNomeMes($valor['mes']);
				$ano = $valor['ano'];

				//$html .= "<td>".$idPeriodoAcompanhamentoCurso."</td>";
				$html .= "<td>" . $ano . $valor['mes'] . "</td>";

				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idPeriodoAcompanhamentoCurso'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $mes . "</td>";
				$html .= "<td>" . $ano . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idPeriodoAcompanhamentoCurso'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectPeriodoAcompanhamentoCursoSelect() Function
	 */
	function selectPeriodoAcompanhamentoCursoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idPeriodoAcompanhamentoCurso, mes, ano, excluido FROM periodoAcompanhamentoCurso " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idPeriodoAcompanhamentoCurso\" name=\"idPeriodoAcompanhamentoCurso\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idPeriodoAcompanhamentoCurso'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idPeriodoAcompanhamentoCurso'] . "\">" . ($valor['idPeriodoAcompanhamentoCurso']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>
