<?php
class Idioma extends Database {
	// class attributes
	var $idIdioma;
	var $idioma;
	var $icon;
	var $inativo;
	var $disponivelAula;
	var $dataCadastro;
	var $linkTeste;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idIdioma = "NULL";
		$this -> idioma = "NULL";
		$this -> icon = "NULL";
		$this -> inativo = 0;
		$this -> disponivelAula = 0;
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> linkTeste = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdIdioma($value) {
		$this -> idIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdioma($value) {
		$this -> idioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIcon($value) {
		$this -> icon = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : 0;
	}

	function setDisponivelAula($value) {
		$this -> disponivelAula = ($value) ? $this -> gravarBD($value) : 0;
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}
	
	function setLinkTeste($value) {
		$this -> linkTeste = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addIdioma() Function
	 */
	function addIdioma() {
		$sql = "INSERT INTO idioma (idioma, icon, inativo, disponivelAula, dataCadastro, linkTeste) VALUES ($this->idioma, $this->icon, $this->inativo, $this->disponivelAula, $this->dataCadastro, $this->linkTeste)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}
	
	function addIdioma_M() {
    	$sql = "INSERT INTO idioma (idIdioma, idioma, icon, inativo, disponivelAula, dataCadastro, linkTeste) VALUES ($this->idIdioma, $this->idioma, $this->icon, $this->inativo, $this->disponivelAula, $this->dataCadastro, $this->linkTeste)";
    	$result = $this -> query($sql, true);
    	return $this -> connect;
  }

	/**
	 * deleteIdioma() Function
	 */
	function deleteIdioma() {
		$sql = "DELETE FROM idioma WHERE idIdioma = $this->idIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldIdioma() Function
	 */
	function updateFieldIdioma($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE idioma SET " . $field . " = " . $value . " WHERE idIdioma = $this->idIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateIdioma() Function
	 */
	function updateIdioma() {
		$sql = "UPDATE idioma SET idioma = $this->idioma, icon = $this->icon, inativo = $this->inativo, disponivelAula = $this->disponivelAula, linkTeste = $this->linkTeste  WHERE idIdioma = $this->idIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectIdioma() Function
	 */
	function selectIdioma($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idIdioma, idioma, icon, inativo, disponivelAula, dataCadastro, linkTeste FROM idioma " . $where;
		return $this -> executeQuery($sql);
	}

	function selectIdiomaSelect($classes = "", $idAtual = 0, $and = "") {
		$sql = "SELECT SQL_CACHE idIdioma, idioma FROM idioma  WHERE inativo = 0 AND excluido = 0 " . $and . " ORDER BY idioma";
		$result = $this -> query($sql);
		$html = "<select id=\"idIdioma\" name=\"idIdioma\"  class=\"" . $classes . "\" >";
        $s = $idAtual == 0 ? "selected=\"selected\"" : "";
		$html .= "<option value=\"\" $s>Todos</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idIdioma'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idIdioma'] . "\">" . $valor['idioma'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function selectIdiomaSelectMult($classes = "", $idAtual = 0, $and = "") {
		$sql = "SELECT SQL_CACHE idIdioma, idioma FROM idioma  WHERE inativo = 0 " . $and . " ORDER BY idioma";
		$result = $this -> query($sql);
		$html = "<select id=\"idIdioma\" name=\"idIdioma[]\"  class=\"" . $classes . "\" multiple=\"multiple\" >";
		$html .= "<option value=\"\" selected=\"selected\" >Todos</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idIdioma'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idIdioma'] . "\">" . $valor['idioma'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	/**
	 * selectIdiomaTr() Function
	 */
	function selectIdiomaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idIdioma, idioma, icon, inativo, disponivelAula, dataCadastro, excluido, linkTeste FROM idioma " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idIdioma = $valor['idIdioma'];
				$idioma = $valor['idioma'];
				$icon = $valor['icon'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//
				$disponivelAula = Uteis::exibirStatus($valor['disponivelAula']);
				$dataCadastro = $valor['dataCadastro'];
				$linkTeste = $valor['linkTeste'];

				$html .= "<td>" . $idIdioma . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idIdioma'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $idioma . "</td>";

				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td>" . $disponivelAula . "</td>";
				$html .= "<td>" . $linkTeste . "</td>";

				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idIdioma'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	function getNome($id) {
		$rs = $this -> selectIdioma(" WHERE idIdioma = $id");
		return $rs[0]['idioma'];
	}

}
?>