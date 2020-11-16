<?php
class SotaqueIdiomaProfessor extends Database {
	// class attributes
	var $idSotaqueIdiomaProfessor;
	var $idiomaIdIdioma;
	var $valor;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idSotaqueIdiomaProfessor = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> valor = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdSotaqueIdiomaProfessor($value) {
		$this -> idSotaqueIdiomaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addSotaqueIdiomaProfessor() Function
	 */
	function addSotaqueIdiomaProfessor() {
		$sql = "INSERT INTO sotaqueIdiomaProfessor (idioma_idIdioma, valor, inativo, excluido) VALUES ($this->idiomaIdIdioma, $this->valor, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteSotaqueIdiomaProfessor() Function
	 */
	function deleteSotaqueIdiomaProfessor() {
		$sql = "DELETE FROM sotaqueIdiomaProfessor WHERE idSotaqueIdiomaProfessor = $this->idSotaqueIdiomaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldSotaqueIdiomaProfessor() Function
	 */
	function updateFieldSotaqueIdiomaProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE sotaqueIdiomaProfessor SET " . $field . " = " . $value . " WHERE idSotaqueIdiomaProfessor = $this->idSotaqueIdiomaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateSotaqueIdiomaProfessor() Function
	 */
	function updateSotaqueIdiomaProfessor() {
		$sql = "UPDATE sotaqueIdiomaProfessor SET idioma_idIdioma = $this->idiomaIdIdioma, valor = $this->valor, inativo = $this->inativo WHERE idSotaqueIdiomaProfessor = $this->idSotaqueIdiomaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectSotaqueIdiomaProfessor() Function
	 */
	function selectSotaqueIdiomaProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idSotaqueIdiomaProfessor, idioma_idIdioma, valor, inativo, excluido FROM sotaqueIdiomaProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectSotaqueIdiomaProfessorTr() Function
	 */
	function selectSotaqueIdiomaProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE s.idSotaqueIdiomaProfessor, s.idioma_idIdioma, s.valor, s.inativo, s.excluido, i.idioma nomeIdioma FROM sotaqueIdiomaProfessor s INNER JOIN idioma i ON i.idIdioma = s.idioma_idIdioma " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idSotaqueIdiomaProfessor = $valor['idSotaqueIdiomaProfessor'];
				$idioma_idIdioma = $valor['nomeIdioma'];
				$valor2 = $valor['valor'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idSotaqueIdiomaProfessor . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idSotaqueIdiomaProfessor'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $idioma_idIdioma . "</td>";
				$html .= "<td>" . $valor2 . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idSotaqueIdiomaProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectSotaqueIdiomaProfessorSelect() Function
	 */
	function selectSotaqueIdiomaProfessorSelect($classes = "", $idAtual = 0, $and = " 1=1 ") {
		$sql = "SELECT SQL_CACHE idSotaqueIdiomaProfessor, idioma_idIdioma, valor, inativo FROM sotaqueIdiomaProfessor ";
		$sql .= " WHERE inativo = 0 AND (" . $and . ") ORDER BY valor";
	//	 echo $sql;
        //exit;
		$result = $this -> query($sql);
		$html = "<select id=\"idSotaqueIdiomaProfessor\" name=\"idSotaqueIdiomaProfessor\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idSotaqueIdiomaProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idSotaqueIdiomaProfessor'] . "\">" . $valor['valor'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function getNome($id) {
		$rs = self::selectSotaqueIdiomaProfessor(" WHERE idSotaqueIdiomaProfessor = ".$id);
		return $rs[0]['valor'];	
	}

}
?>