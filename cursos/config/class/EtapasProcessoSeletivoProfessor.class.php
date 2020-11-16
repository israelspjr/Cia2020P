<?php
class EtapasProcessoSeletivoProfessor extends Database {
	// class attributes
	var $idEtapasProcessoSeletivoProfessor;
	var $nome;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idEtapasProcessoSeletivoProfessor = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdEtapasProcessoSeletivoProfessor($value) {
		$this -> idEtapasProcessoSeletivoProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addEtapasProcessoSeletivoProfessor() Function
	 */
	function addEtapasProcessoSeletivoProfessor() {
		$sql = "INSERT INTO etapasProcessoSeletivoProfessor (nome, inativo, excluido) VALUES ($this->nome, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteEtapasProcessoSeletivoProfessor() Function
	 */
	function deleteEtapasProcessoSeletivoProfessor() {
		$sql = "DELETE FROM etapasProcessoSeletivoProfessor WHERE idEtapasProcessoSeletivoProfessor = $this->idEtapasProcessoSeletivoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldEtapasProcessoSeletivoProfessor() Function
	 */
	function updateFieldEtapasProcessoSeletivoProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE etapasProcessoSeletivoProfessor SET " . $field . " = " . $value . " WHERE idEtapasProcessoSeletivoProfessor = $this->idEtapasProcessoSeletivoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateEtapasProcessoSeletivoProfessor() Function
	 */
	function updateEtapasProcessoSeletivoProfessor() {
		$sql = "UPDATE etapasProcessoSeletivoProfessor SET nome = $this->nome, inativo = $this->inativo WHERE idEtapasProcessoSeletivoProfessor = $this->idEtapasProcessoSeletivoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectEtapasProcessoSeletivoProfessor() Function
	 */
	function selectEtapasProcessoSeletivoProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idEtapasProcessoSeletivoProfessor, nome, inativo, excluido FROM etapasProcessoSeletivoProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectEtapasProcessoSeletivoProfessorTr() Function
	 */
	function selectEtapasProcessoSeletivoProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idEtapasProcessoSeletivoProfessor, nome, inativo, excluido FROM etapasProcessoSeletivoProfessor " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idEtapasProcessoSeletivoProfessor = $valor['idEtapasProcessoSeletivoProfessor'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idEtapasProcessoSeletivoProfessor . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idEtapasProcessoSeletivoProfessor'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idEtapasProcessoSeletivoProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectEtapasProcessoSeletivoProfessorSelect() Function
	 */
	function selectEtapasProcessoSeletivoProfessorSelect($where = "", $classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idEtapasProcessoSeletivoProfessor, nome, inativo FROM etapasProcessoSeletivoProfessor " . $where . " ORDER BY nome";
		$result = $this -> query($sql);
		$html = "<select id=\"idEtapasProcessoSeletivoProfessor\" name=\"idEtapasProcessoSeletivoProfessor\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idEtapasProcessoSeletivoProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idEtapasProcessoSeletivoProfessor'] . "\">" . $valor['nome'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>