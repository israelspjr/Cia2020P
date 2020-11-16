<?php
class ModalidadeIdioma extends Database {
	// class attributes
	var $idModalidadeIdioma;
	var $modalidadeIdModalidade;
	var $idiomaIdIdioma;
	var $valorHoraPadrao;
	var $inativo;
	var $obs;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idModalidadeIdioma = "NULL";
		$this -> modalidadeIdModalidade = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> valorHoraPadrao = "NULL";
		$this -> inativo = "NULL";
		$this -> obs = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdModalidadeIdioma($value) {
		$this -> idModalidadeIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setModalidadeIdModalidade($value) {
		$this -> modalidadeIdModalidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValorHoraPadrao($value) {
		$this -> valorHoraPadrao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addModalidadeIdioma() Function
	 */
	function addModalidadeIdioma() {
		$sql = "INSERT INTO modalidadeIdioma (modalidade_idModalidade, idioma_idIdioma, valorHoraPadrao, inativo, obs, excluido) VALUES ($this->modalidadeIdModalidade, $this->idiomaIdIdioma, $this->valorHoraPadrao, $this->inativo, $this->obs, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteModalidadeIdioma() Function
	 */
	function deleteModalidadeIdioma() {
		$sql = "DELETE FROM modalidadeIdioma WHERE idModalidadeIdioma = $this->idModalidadeIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldModalidadeIdioma() Function
	 */
	function updateFieldModalidadeIdioma($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE modalidadeIdioma SET " . $field . " = " . $value . " WHERE idModalidadeIdioma = $this->idModalidadeIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateModalidadeIdioma() Function
	 */
	function updateModalidadeIdioma() {
		$sql = "UPDATE modalidadeIdioma SET modalidade_idModalidade = $this->modalidadeIdModalidade, idioma_idIdioma = $this->idiomaIdIdioma, valorHoraPadrao = $this->valorHoraPadrao, inativo = $this->inativo, obs = $this->obs WHERE idModalidadeIdioma = $this->idModalidadeIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectModalidadeIdioma() Function
	 */
	function selectModalidadeIdioma($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idModalidadeIdioma, modalidade_idModalidade, idioma_idIdioma, valorHoraPadrao, inativo, obs, excluido FROM modalidadeIdioma " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectModalidadeIdiomaTr() Function
	 */
	function selectModalidadeIdiomaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE mi.idModalidadeIdioma, mi.modalidade_idModalidade, mi.idioma_idIdioma, mi.valorHoraPadrao, mi.inativo, mi.obs, mi.excluido, m.nome as nomeModalidade, i.idioma nomeIdioma FROM modalidadeIdioma mi  INNER JOIN idioma i ON mi.idioma_idIdioma = i.idIdioma INNER JOIN modalidade m ON m.idModalidade = mi.modalidade_idModalidade " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idModalidadeIdioma = $valor['idModalidadeIdioma'];
				$modalidade_idModalidade = $valor['nomeModalidade'];
				$idioma_idIdioma = $valor['nomeIdioma'];
				$valorHoraPadrao = $valor['valorHoraPadrao'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$obs = $valor['obs'];

				$html .= "<td>" . $idModalidadeIdioma . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idModalidadeIdioma'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $modalidade_idModalidade . "</td>";
				$html .= "<td>" . $idioma_idIdioma . "</td>";
				$html .= "<td>" . $valorHoraPadrao . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				//$html .= "<td>".$obs."</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idModalidadeIdioma'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectModalidadeIdiomaSelect() Function
	 */
	function selectModalidadeIdiomaSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idModalidadeIdioma, modalidade_idModalidade, idioma_idIdioma, valorHoraPadrao, inativo, obs, excluido FROM modalidadeIdioma " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idModalidadeIdioma\" name=\"idModalidadeIdioma\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idModalidadeIdioma'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idModalidadeIdioma'] . "\">" . ($valor['idModalidadeIdioma']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>