<?php
class TipoAtividadeExtraProfessor extends Database {
	// class attributes
	var $idTipoAtividadeExtraProfessor;
	var $nome;
	var $inativo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoAtividadeExtraProfessor = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoAtividadeExtraProfessor($value) {
		$this -> idTipoAtividadeExtraProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addTipoatividadeextraprofessor() Function
	 */
	function addTipoatividadeextraprofessor() {
		$sql = "INSERT INTO tipoAtividadeExtraProfessor (nome, inativo) VALUES ($this->nome, $this->inativo)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteTipoatividadeextraprofessor() Function
	 */
	function deleteTipoatividadeextraprofessor() {
		$sql = "DELETE FROM tipoAtividadeExtraProfessor WHERE idTipoAtividadeExtraProfessor = $this->idTipoAtividadeExtraProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipoatividadeextraprofessor() Function
	 */
	function updateFieldTipoatividadeextraprofessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipoAtividadeExtraProfessor SET " . $field . " = " . $value . " WHERE idTipoAtividadeExtraProfessor = $this->idTipoAtividadeExtraProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipoatividadeextraprofessor() Function
	 */
	function updateTipoatividadeextraprofessor() {
		$sql = "UPDATE tipoAtividadeExtraProfessor SET nome = $this->nome, inativo = $this->inativo WHERE idTipoAtividadeExtraProfessor = $this->idTipoAtividadeExtraProfessor";
		$result = $this -> query($sql, true);
	}

	function selectTipoAtividadeExtraProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {

		$sql = "SELECT SQL_CACHE idTipoAtividadeExtraProfessor, nome, inativo 
		FROM tipoAtividadeExtraProfessor " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idTipoAtividadeExtraProfessor = $valor['idTipoAtividadeExtraProfessor'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $idTipoAtividadeExtraProfessor . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" ";

				$html .= "<tr>
				
				<td $onclick >" . $nome . "</td>
				
				<td $onclick >" . $inativo . "</td>
				
				<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $idTipoAtividadeExtraProfessor . ", '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";
			}
		}
		return $html;
	}

	function selectTipoAtividadeExtraProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoAtividadeExtraProfessor, nome, inativo FROM tipoAtividadeExtraProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	function selectTipoatividadeextraprofessorField($id, $origem = "") {

		$sql = "SELECT SQL_CACHE idTipoAtividadeExtraProfessor, nome FROM tipoAtividadeExtraProfessor WHERE inativo = 0 AND excluido = 0 ";
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			$AtividadeExtraProfessor = new AtividadeExtraProfessor();
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<div class=\"linha-inteira\" style=\"margin-top:2em\" id=\"tipoatividadeextraprofessor_" . $valor['idTipoAtividadeExtraProfessor'] . "\"><strong>" . $valor['nome'] . "</strong></div>";
				$AtividadeExtraProfessor -> setTipoAtividadeExtraProfessorIdTipoAtividadeExtraProfessor($valor['idTipoAtividadeExtraProfessor']);
				$html .= "<div class=\"linha-inteira\" >" . $AtividadeExtraProfessor -> selectAtividadeextraprofessorCheckbox($id, $origem) . "</div>";
			}
		}
		return $html;
	}

	function selectTipoAtividadeExtraProfessorSelect($classes = "", $idAtual = 0, $where = "") {

		$sql = "SELECT SQL_CACHE idTipoAtividadeExtraProfessor, nome FROM tipoAtividadeExtraProfessor " . $where;
		$result = $this -> query($sql);

		$html = "<select id=\"idTipoAtividadeExtraProfessor\" name=\"idTipoAtividadeExtraProfessor\"  class=\"" . $classes . "\" >
		<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoAtividadeExtraProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoAtividadeExtraProfessor'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>