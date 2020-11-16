<?php
class NivelEstudoIdioma extends Database {
	// class attributes
	var $idNivelEstudoIdioma;
	var $nivelIdNivel;
	var $idiomaIdIdioma;
	var $inativo;
	var $excluido;
	var $provaOral;	
	var $provaOn;	

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idNivelEstudoIdioma = "NULL";
		$this -> nivelIdNivel = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";
		$this -> provaOral = "0";
		$this -> provaOn = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdNivelEstudoIdioma($value) {
		$this -> idNivelEstudoIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNivelIdNivel($value) {
		$this -> nivelIdNivel = ($value) ? $this -> gravarBD($value) : "NULL";
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

	function setProvaOral($value) {
		$this -> provaOral = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setProvaOn($value) {
		$this -> provaOn = ($value) ? $this -> gravarBD($value) : "0";
	}


	/**
	 * addNivelEstudoIdioma() Function
	 */
	function addNivelEstudoIdioma() {
		$sql = "INSERT INTO nivelEstudoIdioma (nivel_IdNivel, idioma_idIdioma, inativo, excluido, provaOral, provaOn) VALUES ($this->nivelIdNivel, $this->idiomaIdIdioma, $this->inativo, $this->excluido, $this->provaOral, $this->provaOn)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteNivelEstudoIdioma() Function
	 */
	function deleteNivelEstudoIdioma() {
		$sql = "DELETE FROM nivelEstudoIdioma WHERE idNivelEstudoIdioma = $this->idNivelEstudoIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldNivelEstudoIdioma() Function
	 */
	function updateFieldNivelEstudoIdioma($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE nivelEstudoIdioma SET " . $field . " = " . $value . " WHERE idNivelEstudoIdioma = $this->idNivelEstudoIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateNivelEstudoIdioma() Function
	 */
	function updateNivelEstudoIdioma() {
		$sql = "UPDATE nivelEstudoIdioma SET nivel_IdNivel = $this->nivelIdNivel, idioma_idIdioma = $this->idiomaIdIdioma, inativo = $this->inativo, provaOral = $this->provaOral, provaOn = $this->provaOn WHERE idNivelEstudoIdioma = $this->idNivelEstudoIdioma ";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectNivelEstudoIdioma() Function
	 */
	function selectNivelEstudoIdioma($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idNivelEstudoIdioma, nivel_IdNivel, idioma_idIdioma, inativo, excluido, provaOral, provaOn FROM nivelEstudoIdioma " . $where;
		//echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectNivelEstudoIdiomaTr() Function
	 */
	function selectNivelEstudoIdiomaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE n.idNivelEstudoIdioma, n.nivel_IdNivel, n.idioma_idIdioma, n.inativo, n.excluido, n.provaOral,  n.provaOn,i.idioma nomeIdioma, ni.nivel nomeNivel FROM nivelEstudoIdioma n INNER JOIN idioma i ON i.idIdioma = n.idioma_idIdioma INNER JOIN nivelEstudo ni ON ni.idNivelEstudo = n.nivel_idNivel " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idNivelEstudoIdioma = $valor['idNivelEstudoIdioma'];
				$nivel_IdNivel = $valor['nomeNivel'];
				$idioma_idIdioma = $valor['nomeIdioma'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				$provaOral = Uteis::exibirStatus($valor['provaOral']);
				$provaOn = Uteis::exibirStatus($valor['provaOn']);
				//

				$html .= "<td>" . $idNivelEstudoIdioma . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idNivelEstudoIdioma'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nivel_IdNivel . "</td>";
				$html .= "<td>" . $idioma_idIdioma . "</td>";
				$html .= "<td>" . $provaOral . "</td>";
				$html .= "<td>" . $provaOn . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idNivelEstudoIdioma'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectNivelEstudoIdiomaSelect() Function
	 */
	function selectNivelEstudoIdiomaSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idNivelEstudoIdioma, nivel_IdNivel, idioma_idIdioma, inativo, excluido FROM nivelEstudoIdioma " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idNivelEstudoIdioma\" name=\"idNivelEstudoIdioma\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idNivelEstudoIdioma'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idNivelEstudoIdioma'] . "\">" . ($valor['idNivelEstudoIdioma']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>