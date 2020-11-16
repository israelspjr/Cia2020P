<?php
class DemonstrativoCobrancaProfessor extends Database {
	// class attributes
	var $idDemonstrativoCobrancaProfessor;
	var $demonstrativoCobrancaIdDemonstrativoCobranca;
	var $professorIdProfessor;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDemonstrativoCobrancaProfessor = "NULL";
		$this -> demonstrativoCobrancaIdDemonstrativoCobranca = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDemonstrativoCobrancaProfessor($value) {
		$this -> idDemonstrativoCobrancaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDemonstrativoCobrancaIdDemonstrativoCobranca($value) {
		$this -> demonstrativoCobrancaIdDemonstrativoCobranca = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addDemonstrativoCobrancaProfessor() Function
	 */
	function addDemonstrativoCobrancaProfessor() {
		$sql = "INSERT INTO demonstrativoCobrancaProfessor (demonstrativoCobranca_idDemonstrativoCobranca, professor_idProfessor, dataCadastro) VALUES ($this->demonstrativoCobrancaIdDemonstrativoCobranca, $this->professorIdProfessor, $this->dataCadastro)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteDemonstrativoCobrancaProfessor() Function
	 */
	function deleteDemonstrativoCobrancaProfessor($or = "") {
		$sql = "DELETE FROM demonstrativoCobrancaProfessor WHERE idDemonstrativoCobrancaProfessor = $this->idDemonstrativoCobrancaProfessor " . $or;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDemonstrativoCobrancaProfessor() Function
	 */
	function updateFieldDemonstrativoCobrancaProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE demonstrativoCobrancaProfessor SET " . $field . " = " . $value . " WHERE idDemonstrativoCobrancaProfessor = $this->idDemonstrativoCobrancaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDemonstrativoCobrancaProfessor() Function
	 */
	function updateDemonstrativoCobrancaProfessor() {
		$sql = "UPDATE demonstrativoCobrancaProfessor SET demonstrativoCobranca_idDemonstrativoCobranca = $this->demonstrativoCobrancaIdDemonstrativoCobranca, professor_idProfessor = $this->professorIdProfessor,  WHERE idDemonstrativoCobrancaProfessor = $this->idDemonstrativoCobrancaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDemonstrativoCobrancaProfessor() Function
	 */
	function selectDemonstrativoCobrancaProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDemonstrativoCobrancaProfessor, demonstrativoCobranca_idDemonstrativoCobranca, professor_idProfessor, dataCadastro FROM demonstrativoCobrancaProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectDemonstrativoCobrancaProfessorTr() Function
	 */
	function selectDemonstrativoCobrancaProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoCobrancaProfessor, demonstrativoCobranca_idDemonstrativoCobranca, professor_idProfessor, dataCadastro FROM demonstrativoCobrancaProfessor " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idDemonstrativoCobrancaProfessor'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idDemonstrativoCobrancaProfessor'] . "</td>";
				$html .= "<td>" . $valor['demonstrativoCobranca_idDemonstrativoCobranca'] . "</td>";
				$html .= "<td>" . $valor['professor_idProfessor'] . "</td>";
				$html .= "<td>" . $valor['dataCadastro'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/DemonstrativoCobrancaProfessor.php', " . $valor['idDemonstrativoCobrancaProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectDemonstrativoCobrancaProfessorSelect() Function
	 */
	function selectDemonstrativoCobrancaProfessorSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoCobrancaProfessor, demonstrativoCobranca_idDemonstrativoCobranca, professor_idProfessor, dataCadastro FROM demonstrativoCobrancaProfessor " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDemonstrativoCobrancaProfessor\" name=\"idDemonstrativoCobrancaProfessor\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDemonstrativoCobrancaProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDemonstrativoCobrancaProfessor'] . "\">" . ($valor['idDemonstrativoCobrancaProfessor']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>