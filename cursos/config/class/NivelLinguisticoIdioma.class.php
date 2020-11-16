<?php
class NivelLinguisticoIdioma extends Database {
	// class attributes
	var $idNivelLinguisticoIdioma;
	var $nivelLinguisticoIdNivelLinguistico;
	var $idiomaIdIdioma;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idNivelLinguisticoIdioma = "NULL";
		$this -> nivelLinguisticoIdNivelLinguistico = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdNivelLinguisticoIdioma($value) {
		$this -> idNivelLinguisticoIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNivelLinguisticoIdNivelLinguistico($value) {
		$this -> nivelLinguisticoIdNivelLinguistico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addNivelLinguisticoIdioma() Function
	 */
	function addNivelLinguisticoIdioma() {
		$sql = "INSERT INTO nivelLinguisticoIdioma (nivelLinguistico_idNivelLinguistico, idioma_idIdioma, inativo, excluido) VALUES ($this->nivelLinguisticoIdNivelLinguistico, $this->idiomaIdIdioma, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteNivelLinguisticoIdioma() Function
	 */
	function deleteNivelLinguisticoIdioma() {
		$sql = "DELETE FROM nivelLinguisticoIdioma WHERE idNivelLinguisticoIdioma = $this->idNivelLinguisticoIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldNivelLinguisticoIdioma() Function
	 */
	function updateFieldNivelLinguisticoIdioma($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE nivelLinguisticoIdioma SET " . $field . " = " . $value . " WHERE idNivelLinguisticoIdioma = $this->idNivelLinguisticoIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateNivelLinguisticoIdioma() Function
	 */
	function updateNivelLinguisticoIdioma() {
		$sql = "UPDATE nivelLinguisticoIdioma SET nivelLinguistico_idNivelLinguistico = $this->nivelLinguisticoIdNivelLinguistico, idioma_idIdioma = $this->idiomaIdIdioma, inativo = $this->inativo WHERE idNivelLinguisticoIdioma = $this->idNivelLinguisticoIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectNivelLinguisticoIdioma() Function
	 */
	function selectNivelLinguisticoIdioma($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idNivelLinguisticoIdioma, nivelLinguistico_idNivelLinguistico, idioma_idIdioma, inativo, excluido FROM nivelLinguisticoIdioma " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectNivelLinguisticoIdiomaTr() Function
	 */
	function selectNivelLinguisticoIdiomaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE n.idNivelLinguisticoIdioma, n.nivelLinguistico_idNivelLinguistico, n.idioma_idIdioma, n.inativo, n.excluido, i.idioma nomeIdioma, nl.nivel nomeNivelLinguistico FROM nivelLinguisticoIdioma n INNER JOIN nivelLinguistico nl ON nl.idNivelLinguistico = n.nivelLinguistico_idNivelLinguistico INNER JOIN idioma i ON i.idIdioma = n.idioma_idIdioma " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idNivelLinguisticoIdioma = $valor['idNivelLinguisticoIdioma'];
				$nivelLinguistico_idNivelLinguistico = $valor['nomeNivelLinguistico'];
				$idioma_idIdioma = $valor['nomeIdioma'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idNivelLinguisticoIdioma . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idNivelLinguisticoIdioma'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nivelLinguistico_idNivelLinguistico . "</td>";
				$html .= "<td>" . $idioma_idIdioma . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idNivelLinguisticoIdioma'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectNivelLinguisticoIdiomaSelect() Function
	 */
	function selectNivelLinguisticoIdiomaSelect($classes = "", $idAtual = 0, $and = " 1=1 ") {
		$sql = "SELECT SQL_CACHE  n1.idNivelLinguisticoIdioma, n1.nivelLinguistico_idNivelLinguistico, n1.idioma_idIdioma, n1.inativo, n2.nivel, n2.idNivelLinguistico FROM nivelLinguisticoIdioma n1 INNER JOIN nivelLinguistico n2 ON n1.nivelLinguistico_idNivelLinguistico = n2.idNivelLinguistico WHERE n1.inativo = 0 AND (" . $and . ")";
		//echo $sql;
		//exit;
		$result = $this -> query($sql);
		$html = "<select id=\"idNivelLinguistico\" name=\"idNivelLinguistico\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idNivelLinguistico'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idNivelLinguistico'] . "\">" . $valor['nivel'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function selectNivelLinguisticoIdiomaSelectMulti($classes = "", $idAtual = 0, $and = " 1=1 ") {
		$sql = "SELECT SQL_CACHE  n1.idNivelLinguisticoIdioma, n1.nivelLinguistico_idNivelLinguistico, n1.idioma_idIdioma, n1.inativo, n2.nivel, n2.idNivelLinguistico FROM nivelLinguisticoIdioma n1 INNER JOIN nivelLinguistico n2 ON n1.nivelLinguistico_idNivelLinguistico = n2.idNivelLinguistico WHERE n1.inativo = 0 AND (" . $and . ")";
		//echo $sql;
		//exit;
		$result = $this -> query($sql);
		$html = "<select id=\"idNivelLinguistico\" name=\"idNivelLinguistico[]\"  class=\"" . $classes . "\"  multiple=\"multiple\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idNivelLinguistico'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idNivelLinguistico'] . "\">" . $valor['nivel'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>