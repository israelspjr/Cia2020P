<?php
class RelacionamentoINF extends Database {
	// class attributes
	var $idRelacionamentoINF;
	var $idiomaIdIdioma;
	var $nivelEstudoIdNivelEstudo;
	var $focoCursoIdFocoCurso;
	var $cargaHoraria;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idRelacionamentoINF = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> nivelEstudoIdNivelEstudo = "NULL";
		$this -> focoCursoIdFocoCurso = "NULL";
		$this -> cargaHoraria = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdRelacionamentoINF($value) {
		$this -> idRelacionamentoINF = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNivelEstudoIdNivelEstudo($value) {
		$this -> nivelEstudoIdNivelEstudo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFocoCursoIdFocoCurso($value) {
		$this -> focoCursoIdFocoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCargaHoraria($value) {
		$this -> cargaHoraria = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addRelacionamentoINF() Function
	 */
	function addRelacionamentoINF() {
		$sql = "INSERT INTO relacionamentoINF (idioma_idIdioma, nivelEstudo_IdNivelEstudo, focoCurso_idFocoCurso, cargaHoraria, inativo, excluido) VALUES ($this->idiomaIdIdioma, $this->nivelEstudoIdNivelEstudo, $this->focoCursoIdFocoCurso, $this->cargaHoraria, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteRelacionamentoINF() Function
	 */
	function deleteRelacionamentoINF() {
		$sql = "DELETE FROM relacionamentoINF WHERE idRelacionamentoINF = $this->idRelacionamentoINF";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldRelacionamentoINF() Function
	 */
	function updateFieldRelacionamentoINF($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE relacionamentoINF SET " . $field . " = " . $value . " WHERE idRelacionamentoINF = $this->idRelacionamentoINF";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateRelacionamentoINF() Function
	 */
	function updateRelacionamentoINF() {
		$sql = "UPDATE relacionamentoINF SET idioma_idIdioma = $this->idiomaIdIdioma, nivelEstudo_IdNivelEstudo = $this->nivelEstudoIdNivelEstudo, focoCurso_idFocoCurso = $this->focoCursoIdFocoCurso, cargaHoraria = $this->cargaHoraria, inativo = $this->inativo WHERE idRelacionamentoINF = $this->idRelacionamentoINF";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectRelacionamentoINF() Function
	 */
	function selectRelacionamentoINF($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idRelacionamentoINF, idioma_idIdioma, nivelEstudo_IdNivelEstudo, focoCurso_idFocoCurso, cargaHoraria, inativo, excluido FROM relacionamentoINF " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectRelacionamentoINFTr() Function
	 */
	function selectRelacionamentoINFTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE r.idRelacionamentoINF, r.idioma_idIdioma, r.nivelEstudo_IdNivelEstudo, r.focoCurso_idFocoCurso, r.cargaHoraria, r.inativo, r.excluido, i.idioma nomeIdioma, f.foco nomeFocoCurso, n.nivel nomeNivelEstudo FROM relacionamentoINF r  INNER JOIN idioma i ON i.idIdioma = r.idioma_idIdioma INNER JOIN nivelEstudo n ON n.idNivelEstudo = r.nivelEstudo_idNivelEstudo INNER JOIN focoCurso f ON f.idFocoCurso = r.focoCurso_idFocoCurso " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idRelacionamentoINF = $valor['idRelacionamentoINF'];
				$idioma_idIdioma = $valor['nomeIdioma'];
				$nivelEstudo_IdNivelEstudo = $valor['nomeNivelEstudo'];
				$focoCurso_idFocoCurso = $valor['nomeFocoCurso'];
				$cargaHoraria = Uteis::exibirHoras($valor['cargaHoraria']);
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idRelacionamentoINF . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idRelacionamentoINF'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $idioma_idIdioma . "</td>";
				$html .= "<td>" . $nivelEstudo_IdNivelEstudo . "</td>";
				$html .= "<td>" . $focoCurso_idFocoCurso . "</td>";
				$html .= "<td>" . $cargaHoraria . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idRelacionamentoINF'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectRelacionamentoINFSelect() Function
	 */
	function selectRelacionamentoINFSelect($classes = "", $idAtual = 0, $where = "") {

		$sql = "SELECT SQL_CACHE idRelacionamentoINF, CONCAT(I.idioma, ' - ', N.nivel, ' - ', F.foco) AS tudo, cargaHoraria, R.inativo, R.excluido 
		FROM relacionamentoINF AS R
		INNER JOIN idioma AS I ON I.idIdioma = R.idioma_idIdioma 
		INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = R.nivelEstudo_IdNivelEstudo 
		INNER JOIN focoCurso AS F ON F.idFocoCurso = R.focoCurso_idFocoCurso 
		$where
		ORDER BY I.idioma, N.nivel, F.foco";
		$result = $this -> query($sql);

		$html = "<select id=\"idRelacionamentoINF\" name=\"idRelacionamentoINF\"  class=\"" . $classes . "\" >
		<option value=\"\">Selecione</option>";

		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idRelacionamentoINF'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idRelacionamentoINF'] . "\">" . ($valor['tudo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function getRelacionamentoINF($id) {

		$sql = "SELECT SQL_CACHE DISTINCT(R.idRelacionamentoINF), CONCAT(I.idioma, ' - ', N.nivel, ' - ', F.foco) AS tudo
		FROM relacionamentoINF AS R
		INNER JOIN idioma AS I ON I.idIdioma = R.idioma_idIdioma 
		INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = R.nivelEstudo_IdNivelEstudo 
		INNER JOIN focoCurso AS F ON F.idFocoCurso = R.focoCurso_idFocoCurso 
		WHERE R.idRelacionamentoINF = $id ORDER BY I.idioma, N.nivel, F.foco";
		//echo $sql;
		$result = mysqli_fetch_array($this -> query($sql));

		return $result['tudo'];
	}

}
?>