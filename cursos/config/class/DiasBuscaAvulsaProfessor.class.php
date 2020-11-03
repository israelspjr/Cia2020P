<?php
class DiasBuscaAvulsaProfessor extends Database {
	// class attributes
	var $idDiasBuscaAvulsaProfessor;
	var $diasBuscaAvulsaIdDiasBuscaAvulsa;
	var $professorIdProfessor;
	var $escolhido;
	var $obs;
	var $valorHora;
	var $ordem;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDiasBuscaAvulsaProfessor = "NULL";
		$this -> diasBuscaAvulsaIdDiasBuscaAvulsa = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> escolhido = "0";
		$this -> obs = "NULL";
		$this -> valorHora = "NULL";
		$this -> ordem = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDiasBuscaAvulsaProfessor($value) {
		$this -> idDiasBuscaAvulsaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDiasBuscaAvulsaIdDiasBuscaAvulsa($value) {
		$this -> diasBuscaAvulsaIdDiasBuscaAvulsa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEscolhido($value) {
		$this -> escolhido = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setValorHora($value) {
		$this -> valorHora = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setOrdem($value) {
		$this -> ordem = ($value) ? $this -> gravarBD($value) : "0";
	}


	/**
	 * addDiasBuscaAvulsaProfessor() Function
	 */
	function addDiasBuscaAvulsaProfessor() {
		$sql = "INSERT INTO diasBuscaAvulsaProfessor (diasBuscaAvulsa_idDiasBuscaAvulsa, professor_idProfessor, escolhido, obs, valorHora, ordem) VALUES ($this->diasBuscaAvulsaIdDiasBuscaAvulsa, $this->professorIdProfessor, $this->escolhido, $this->obs, $this->valorHora, $this->ordem)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteDiasBuscaAvulsaProfessor() Function
	 */
	function deleteDiasBuscaAvulsaProfessor() {
		$sql = "DELETE FROM diasBuscaAvulsaProfessor WHERE idDiasBuscaAvulsaProfessor = $this->idDiasBuscaAvulsaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDiasBuscaAvulsaProfessor() Function
	 */
	function updateFieldDiasBuscaAvulsaProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE diasBuscaAvulsaProfessor SET " . $field . " = " . $value . " WHERE idDiasBuscaAvulsaProfessor = $this->idDiasBuscaAvulsaProfessor";
		$result = $this -> query($sql, true);
		//echo $sql;
	}

	/**
	 * updateDiasBuscaAvulsaProfessor() Function
	 */
	function updateDiasBuscaAvulsaProfessor() {
		$sql = "UPDATE diasBuscaAvulsaProfessor SET diasBuscaAvulsa_idDiasBuscaAvulsa = $this->diasBuscaAvulsaIdDiasBuscaAvulsa, professor_idProfessor = $this->professorIdProfessor, escolhido = $this->escolhido, obs = $this->obs, valorHora = $this->valorHora, ordem = $this->ordem WHERE idDiasBuscaAvulsaProfessor = $this->idDiasBuscaAvulsaProfessor";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDiasBuscaAvulsaProfessor() Function
	 */
	function selectDiasBuscaAvulsaProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDiasBuscaAvulsaProfessor, diasBuscaAvulsa_idDiasBuscaAvulsa, professor_idProfessor, escolhido, obs, valorHora, ordem FROM diasBuscaAvulsaProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectDiasBuscaAvulsaProfessorTr() Function
	 */
	function selectDiasBuscaAvulsaProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idDiasBuscaAvulsaProfessor, diasBuscaAvulsa_idDiasBuscaAvulsa, professor_idProfessor, escolhido FROM diasBuscaAvulsaProfessor " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idDiasBuscaAvulsaProfessor = $valor['idDiasBuscaAvulsaProfessor'];
				$diasBuscaAvulsa_idDiasBuscaAvulsa = $valor['diasBuscaAvulsa_idDiasBuscaAvulsa'];
				$professor_idProfessor = $valor['professor_idProfessor'];
				$escolhido = $valor['escolhido'];

				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idDiasBuscaAvulsaProfessor'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $idDiasBuscaAvulsaProfessor . "</td>";
				$html .= "<td>" . $diasBuscaAvulsa_idDiasBuscaAvulsa . "</td>";
				$html .= "<td>" . $professor_idProfessor . "</td>";
				$html .= "<td>" . $escolhido . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idDiasBuscaAvulsaProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectDiasBuscaAvulsaProfessorSelect() Function
	 */
	function selectDiasBuscaAvulsaProfessorSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDiasBuscaAvulsaProfessor, diasBuscaAvulsa_idDiasBuscaAvulsa, professor_idProfessor, escolhido FROM diasBuscaAvulsaProfessor " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDiasBuscaAvulsaProfessor\" name=\"idDiasBuscaAvulsaProfessor\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDiasBuscaAvulsaProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDiasBuscaAvulsaProfessor'] . "\">" . ($valor['idDiasBuscaAvulsaProfessor']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>