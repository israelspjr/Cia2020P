<?php
class DescricaoTelefone extends Database {
	// class attributes
	var $idDescricaoTelefone;
	var $nome;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDescricaoTelefone = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDescricaoTelefone($value) {
		$this -> idDescricaoTelefone = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addDescricaoTelefone() Function
	 */
	function addDescricaoTelefone() {
		$sql = "INSERT INTO descricaoTelefone (nome, inativo, excluido) VALUES ($this->nome, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteDescricaoTelefone() Function
	 */
	function deleteDescricaoTelefone() {
		$sql = "DELETE FROM descricaoTelefone WHERE idDescricaoTelefone = $this->idDescricaoTelefone";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDescricaoTelefone() Function
	 */
	function updateFieldDescricaoTelefone($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE descricaoTelefone SET " . $field . " = " . $value . " WHERE idDescricaoTelefone = $this->idDescricaoTelefone";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDescricaoTelefone() Function
	 */
	function updateDescricaoTelefone() {
		$sql = "UPDATE descricaoTelefone SET nome = $this->nome, inativo = $this->inativo WHERE idDescricaoTelefone = $this->idDescricaoTelefone";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDescricaoTelefone() Function
	 */
	function selectDescricaoTelefone($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDescricaoTelefone, nome, inativo, excluido FROM descricaoTelefone " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectDescricaoTelefoneTr() Function
	 */
	function selectDescricaoTelefoneTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idDescricaoTelefone, nome, inativo, excluido FROM descricaoTelefone " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idDescricaoTelefone = $valor['idDescricaoTelefone'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idDescricaoTelefone . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idDescricaoTelefone'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idDescricaoTelefone'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectDescricaoTelefoneSelect() Function
	 */
	function selectDescricaoTelefoneSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDescricaoTelefone, nome, inativo, excluido FROM descricaoTelefone " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDescricaoTelefone\" name=\"idDescricaoTelefone\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDescricaoTelefone'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDescricaoTelefone'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>