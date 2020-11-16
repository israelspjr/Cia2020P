<?php
class Escola extends Database {
	// class attributes
	var $idEscola;
	var $nome;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idEscola = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdEscola($value) {
		$this -> idEscola = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addEscola() Function
	 */
	function addEscola() {
		$sql = "INSERT INTO escola (nome, inativo, excluido) VALUES ($this->nome, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteEscola() Function
	 */
	function deleteEscola() {
		$sql = "DELETE FROM escola WHERE idEscola = $this->idEscola";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldEscola() Function
	 */
	function updateFieldEscola($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE escola SET " . $field . " = " . $value . " WHERE idEscola = $this->idEscola";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateEscola() Function
	 */
	function updateEscola() {
		$sql = "UPDATE escola SET nome = $this->nome, inativo = $this->inativo WHERE idEscola = $this->idEscola";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectEscola() Function
	 */
	function selectEscola($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idEscola, nome, inativo, excluido FROM escola " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectEscolaTr() Function
	 */
	function selectEscolaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idEscola, nome, inativo, excluido FROM escola " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idEscola = $valor['idEscola'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idEscola . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idEscola'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idEscola'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectEscolaSelect() Function
	 */
	function selectEscolaSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idEscola, nome FROM escola  WHERE inativo = 0 ORDER BY nome";
		$result = $this -> query($sql);
		$html = "<select id=\"idEscola\" name=\"idEscola\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idEscola'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idEscola'] . "\">" . ($valor['nome']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function getNome($id) {
		$rs = $this->selectEscola(" WHERE idEscola = ".$id);
	 	return $rs[0]['nome'];
		
	}

}
?>