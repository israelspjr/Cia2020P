<?php
class MeioLocomocao extends Database {
	// class attributes
	var $idMeioLocomocao;
	var $nome;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idMeioLocomocao = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdMeioLocomocao($value) {
		$this -> idMeioLocomocao = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addMeioLocomocao() Function
	 */
	function addMeioLocomocao() {
		$sql = "INSERT INTO meioLocomocao (nome, inativo, excluido) VALUES ($this->nome, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteMeioLocomocao() Function
	 */
	function deleteMeioLocomocao() {
		$sql = "DELETE FROM meioLocomocao WHERE idMeioLocomocao = $this->idMeioLocomocao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldMeioLocomocao() Function
	 */
	function updateFieldMeioLocomocao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE meioLocomocao SET " . $field . " = " . $value . " WHERE idMeioLocomocao = $this->idMeioLocomocao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateMeioLocomocao() Function
	 */
	function updateMeioLocomocao() {
		$sql = "UPDATE meioLocomocao SET nome = $this->nome, inativo = $this->inativo WHERE idMeioLocomocao = $this->idMeioLocomocao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectMeioLocomocao() Function
	 */
	function selectMeioLocomocao($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idMeioLocomocao, nome, inativo, excluido FROM meioLocomocao " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectMeioLocomocaoTr() Function
	 */
	function selectMeioLocomocaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idMeioLocomocao, nome, inativo, excluido FROM meioLocomocao " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idMeioLocomocao = $valor['idMeioLocomocao'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idMeioLocomocao . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idMeioLocomocao'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idMeioLocomocao'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectMeioLocomocaoSelect() Function
	 */
	function selectMeioLocomocaoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idMeioLocomocao, nome, inativo, excluido FROM meioLocomocao " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idMeioLocomocao\" name=\"idMeioLocomocao\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idMeioLocomocao'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idMeioLocomocao'] . "\">" . ($valor['idMeioLocomocao']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectMeioLocomocaoCheckbox($idProfessor) {

		$sql = "SELECT SQL_CACHE idMeioLocomocao, nome FROM meioLocomocao WHERE inativo = 0";
		$result = $this -> query($sql);

		$MeioLocomocaoProfessor = new MeioLocomocaoProfessor();

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$where = " WHERE professor_idProfessor = " . $idProfessor . " AND meioLocomocao_idMeioLocomocao = " . $valor['idMeioLocomocao'];
				$checked = $MeioLocomocaoProfessor -> selectMeioLocomocaoProfessor($where) ? " checked=\"checked\" " : "";

				$html .= "<div style=\"float:left;width:25%;\">
				<label for=\"check_" . $valor['idMeioLocomocao'] . "\">" . $valor['nome'] . "</label>
				<input type=\"checkbox\" id=\"check_MeioLocomocao_" . $valor['idMeioLocomocao'] . "\" name=\"check_MeioLocomocao_" . $valor['idMeioLocomocao'] . "\" $checked value=\"1\" /> 
				</div>";
			}
		}
		return $html;
	}

}
?>