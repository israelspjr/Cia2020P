<?php
class FocoCursoIdioma extends Database {
	// class attributes
	var $idFocoCursoIdioma;
	var $focoCursoIdFocoCurso;
	var $idiomaIdIdioma;
	var $inativo;
	var $dataCadastro;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idFocoCursoIdioma = "NULL";
		$this -> focoCursoIdFocoCurso = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> inativo = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdFocoCursoIdioma($value) {
		$this -> idFocoCursoIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFocoCursoIdFocoCurso($value) {
		$this -> focoCursoIdFocoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
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

	/**
	 * addFocoCursoIdioma() Function
	 */
	function addFocoCursoIdioma() {
		$sql = "INSERT INTO focoCursoIdioma (focoCurso_idFocoCurso, idioma_idIdioma, inativo, dataCadastro, excluido) VALUES ($this->focoCursoIdFocoCurso, $this->idiomaIdIdioma, $this->inativo, '" . date('Y-m-y H:i:s') . "', $this->excluido)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteFocoCursoIdioma() Function
	 */
	function deleteFocoCursoIdioma() {
		$sql = "DELETE FROM focoCursoIdioma WHERE idFocoCursoIdioma = $this->idFocoCursoIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldFocoCursoIdioma() Function
	 */
	function updateFieldFocoCursoIdioma($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE focoCursoIdioma SET " . $field . " = " . $value . " WHERE idFocoCursoIdioma = $this->idFocoCursoIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFocoCursoIdioma() Function
	 */
	function updateFocoCursoIdioma() {
		$sql = "UPDATE focoCursoIdioma SET focoCurso_idFocoCurso = $this->focoCursoIdFocoCurso, idioma_idIdioma = $this->idiomaIdIdioma, inativo = $this->inativo WHERE idFocoCursoIdioma = $this->idFocoCursoIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectFocoCursoIdioma() Function
	 */
	function selectFocoCursoIdioma($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idFocoCursoIdioma, focoCurso_idFocoCurso, idioma_idIdioma, inativo, dataCadastro, excluido FROM focoCursoIdioma " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectFocoCursoIdiomaTr() Function
	 */
	function selectFocoCursoIdiomaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE f.idFocoCursoIdioma, f.focoCurso_idFocoCurso, f.idioma_idIdioma, f.inativo, f.dataCadastro, f.excluido, ff.foco as nomeFocoCurso, i.idioma as nomeIdioma  FROM focoCursoIdioma f INNER JOIN idioma i ON f.idioma_idIdioma = i.idIdioma INNER JOIN focoCurso ff ON f.focoCurso_idFocoCurso = ff.idFocoCurso" . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idFocoCursoIdioma = $valor['idFocoCursoIdioma'];
				$focoCurso_idFocoCurso = $valor['focoCurso_idFocoCurso'];
				$idioma_idIdioma = $valor['idioma_idIdioma'];
				$nomeFocoCurso = $valor['nomeFocoCurso'];
				$nomeIdioma = $valor['nomeIdioma'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//
				$dataCadastro = $valor['dataCadastro'];

				$html .= "<td>" . $idFocoCursoIdioma . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idFocoCursoIdioma'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nomeFocoCurso . "</td>";
				$html .= "<td>" . $nomeIdioma . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				//$html .= "<td>".$dataCadastro."</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idFocoCursoIdioma'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectFocoCursoIdiomaSelect() Function
	 */
	function selectFocoCursoIdiomaSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idFocoCursoIdioma, focoCurso_idFocoCurso, idioma_idIdioma, inativo, dataCadastro, excluido FROM focoCursoIdioma " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idFocoCursoIdioma\" name=\"idFocoCursoIdioma\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idFocoCursoIdioma'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idFocoCursoIdioma'] . "\">" . ($valor['idFocoCursoIdioma']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}
	
	function selectFocoCursoIdiomaSelect2($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE FCI.idFocoCursoIdioma, FCI.focoCurso_idFocoCurso, FCI.idioma_idIdioma, FCI.inativo, FCI.dataCadastro, FCI.excluido, FI.foco FROM focoCursoIdioma as FCI 
		INNER JOIN 
    focoCurso AS FI ON FCI.focoCurso_idFocoCurso = FI.idFocoCurso" . $where;
//		echo $sql;
		$result = $this -> query($sql);
		$html = "<select id=\"idFocoCursoIdioma\" name=\"idFocoCursoIdioma\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['focoCurso_idFocoCurso'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['focoCurso_idFocoCurso'] . "\">" . ($valor['foco']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>