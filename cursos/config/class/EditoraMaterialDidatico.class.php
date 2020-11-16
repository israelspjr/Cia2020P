<?php
class EditoraMaterialDidatico extends Database {
	// class attributes
	var $idEditoraMaterialDidatico;
	var $editora;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idEditoraMaterialDidatico = "NULL";
		$this -> editora = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdEditoraMaterialDidatico($value) {
		$this -> idEditoraMaterialDidatico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEditora($value) {
		$this -> editora = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addEditoraMaterialDidatico() Function
	 */
	function addEditoraMaterialDidatico() {
		$sql = "INSERT INTO editoraMaterialDidatico (editora, inativo, excluido) VALUES ($this->editora, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteEditoraMaterialDidatico() Function
	 */
	function deleteEditoraMaterialDidatico() {
		$sql = "DELETE FROM editoraMaterialDidatico WHERE idEditoraMaterialDidatico = $this->idEditoraMaterialDidatico";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldEditoraMaterialDidatico() Function
	 */
	function updateFieldEditoraMaterialDidatico($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE editoraMaterialDidatico SET " . $field . " = " . $value . " WHERE idEditoraMaterialDidatico = $this->idEditoraMaterialDidatico";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateEditoraMaterialDidatico() Function
	 */
	function updateEditoraMaterialDidatico() {
		$sql = "UPDATE editoraMaterialDidatico SET editora = $this->editora, inativo = $this->inativo WHERE idEditoraMaterialDidatico = $this->idEditoraMaterialDidatico";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectEditoraMaterialDidatico() Function
	 */
	function selectEditoraMaterialDidatico($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idEditoraMaterialDidatico, editora, inativo, excluido FROM editoraMaterialDidatico " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectEditoraMaterialDidaticoTr() Function
	 */
	function selectEditoraMaterialDidaticoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idEditoraMaterialDidatico, editora, inativo, excluido FROM editoraMaterialDidatico " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idEditoraMaterialDidatico = $valor['idEditoraMaterialDidatico'];
				$editora = $valor['editora'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idEditoraMaterialDidatico . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idEditoraMaterialDidatico'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $editora . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idEditoraMaterialDidatico'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectEditoraMaterialDidaticoSelect() Function
	 */
	function selectEditoraMaterialDidaticoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idEditoraMaterialDidatico, editora, inativo, excluido FROM editoraMaterialDidatico " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idEditoraMaterialDidatico\" name=\"idEditoraMaterialDidatico\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idEditoraMaterialDidatico'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idEditoraMaterialDidatico'] . "\">" . ($valor['editora']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>