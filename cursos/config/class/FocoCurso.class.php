<?php
class FocoCurso extends Database {
	// class attributes
	var $idFocoCurso;
	var $foco;
	var $obs;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idFocoCurso = "NULL";
		$this -> foco = "NULL";
		$this -> obs = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdFocoCurso($value) {
		$this -> idFocoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFoco($value) {
		$this -> foco = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addFocoCurso() Function
	 */
	function addFocoCurso() {
		$sql = "INSERT INTO focoCurso (foco, obs, inativo, excluido) VALUES ($this->foco, $this->obs, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteFocoCurso() Function
	 */
	function deleteFocoCurso() {
		$sql = "DELETE FROM focoCurso WHERE idFocoCurso = $this->idFocoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldFocoCurso() Function
	 */
	function updateFieldFocoCurso($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE focoCurso SET " . $field . " = " . $value . " WHERE idFocoCurso = $this->idFocoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFocoCurso() Function
	 */
	function updateFocoCurso() {
		$sql = "UPDATE focoCurso SET foco = $this->foco, obs = $this->obs, inativo = $this->inativo WHERE idFocoCurso = $this->idFocoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectFocoCurso() Function
	 */
	function selectFocoCurso($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idFocoCurso, foco, obs, inativo, excluido FROM focoCurso " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectFocoCursoTr() Function
	 */
	function selectFocoCursoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idFocoCurso, foco, obs, inativo, excluido FROM focoCurso " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idFocoCurso = $valor['idFocoCurso'];
				$foco = $valor['foco'];
				$obs = $valor['obs'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idFocoCurso . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idFocoCurso'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $foco . "</td>";
				//					$html .= "<td>".$obs."</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idFocoCurso'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectFocoCursoSelect() Function
	 */
	function selectFocoCursoSelect($classes = "", $idAtual = 0, $addQuery = "") {
		$sql = "SELECT SQL_CACHE F.idFocoCurso, F.foco FROM focoCurso AS F " . $addQuery . " WHERE F.inativo = 0 AND F.excluido = 0 ORDER BY F.foco";
		//echo $sql;
		$result = $this -> query($sql);

		$html = "<select id=\"idFocoCurso\" name=\"idFocoCurso\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";

		while ($valor = mysqli_fetch_array($result)) {
			//echo "//";
			$selecionado = $idAtual == $valor['idFocoCurso'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idFocoCurso'] . "\">" . $valor['foco'] . "</option>";
		}

		$html .= "</select>";

		return $html;
	}

	function selectFocoCursoSelectMult($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE F.idFocoCurso, F.foco FROM focoCurso AS F $where ORDER BY F.foco";
		//echo $sql;
		$result = $this -> query($sql);

		$html = "<select id=\"idFocoCurso\" name=\"idFocoCurso[]\" multiple=\"multiple\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Todos</option>";

		while ($valor = mysqli_fetch_array($result)) {
			//echo "//";
			$selecionado = $idAtual == $valor['idFocoCurso'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idFocoCurso'] . "\">" . $valor['foco'] . "</option>";
		}

		$html .= "</select>";

		return $html;
	}
	
	function getNome($id) {
		$rs = self::selectFocoCurso(" WHERE idFocoCurso = ".$id);
			return $rs[0]['foco'];
	}

}
?>