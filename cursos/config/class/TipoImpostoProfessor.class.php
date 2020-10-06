<?php
class TipoImpostoProfessor extends Database {
	// class attributes
	var $idTipoImpostoProfessor;
	var $nome;
	var $sigla;
	var $inativo;	
	var $excluido;	
	var $tipoImpostoProfessorIdTipoImpostoProfessor;
	
	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoImpostoProfessor = "NULL";
		$this -> nome = "NULL";
		$this -> sigla = "NULL";
		$this -> inativo = "0";
		$this -> tipoImpostoProfessorIdTipoImpostoProfessor = "NULL";		
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoImpostoProfessor($value) {
		$this -> idTipoImpostoProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setSigla($value) {
		$this -> sigla = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setTipoImpostoProfessorIdTipoImpostoProfessor($value) {
		$this -> tipoImpostoProfessorIdTipoImpostoProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function addTipoImpostoProfessor() {
		$sql = "INSERT INTO tipoImpostoProfessor (nome, sigla, inativo, excluido, tipoImpostoProfessor_idTipoImpostoProfessor) 
		VALUES ($this->nome, $this->sigla, $this->inativo, $this->excluido, $this->tipoImpostoProfessorIdTipoImpostoProfessor)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	function deleteTipoImpostoProfessor() {
		$sql = "DELETE FROM tipoImpostoProfessor WHERE idTipoImpostoProfessor = $this->idTipoImpostoProfessor";
		$result = $this -> query($sql, true);
	}

	function updateFieldTipoImpostoProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipoImpostoProfessor SET " . $field . " = " . $value . " WHERE idTipoImpostoProfessor = $this->idTipoImpostoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipoImpostoProfessor() Function
	 */
	function updateTipoImpostoProfessor() {
		$sql = "UPDATE tipoImpostoProfessor SET nome = $this->nome, sigla = $this->sigla, inativo = $this->inativo, tipoImpostoProfessor_idTipoImpostoProfessor = $this->tipoImpostoProfessorIdTipoImpostoProfessor 
		WHERE idTipoImpostoProfessor = $this->idTipoImpostoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipoImpostoProfessor() Function
	 */
	function selectTipoImpostoProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoImpostoProfessor, nome, sigla, inativo, dataCadastro, excluido, tipoImpostoProfessor_idTipoImpostoProfessor FROM tipoImpostoProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	function selectTipoImpostoProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $caminhoModulo = "") {

		$sql = "SELECT SQL_CACHE idTipoImpostoProfessor, nome, sigla, inativo, tipoImpostoProfessor_idTipoImpostoProfessor 
		FROM tipoImpostoProfessor " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idTipoImpostoProfessor = $valor['idTipoImpostoProfessor'];
				$nome = $valor['nome'];
				$sigla = $valor['sigla'];				
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				
				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idTipoImpostoProfessor'] . "', '" . $caminhoAtualizar . "', '$ondeAtualiza')\" ";

				$html .= "<tr>";
				$html .= "<td $onclick>" . $nome . "</td>";
				$html .= "<td $onclick>" . $sigla . "</td>";				
				$html .= "<td $onclick>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idTipoImpostoProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>";
				$html .= "</tr>";

			}
		}
		return $html;
	}

	function selectTipoImpostoProfessorSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idTipoImpostoProfessor, nome, sigla, inativo, dataCadastro, excluido 
		FROM tipoImpostoProfessor WHERE excluido = 0 " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idTipoImpostoProfessor\" name=\"idTipoImpostoProfessor\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoImpostoProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoImpostoProfessor'] . "\">" . ($valor['sigla']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>