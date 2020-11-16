<?php
class Setor extends Database {

	// class attributes
	var $idSetor;
	var $nome;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idSetor = "NULL";
		$this -> nome = "NULL";
		$this -> excluido = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdSetor($value) {
		$this -> idSetor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	function addSetor() {
		$sql = "INSERT INTO setor (nome, excluido) VALUES ($this->nome, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	function deleteSetor() {
		$sql = "DELETE FROM setor WHERE idSetor = $this->idSetor";
		$result = $this -> query($sql, true);
	}

	function updateFieldSetor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $this -> gravarBD($value);
		$sql = "UPDATE setor SET " . $field . " = " . $value . " WHERE idSetor = $this->idSetor";
		$result = $this -> query($sql, true);
	}

	function updateSetor() {
		$sql = "UPDATE setor SET nome = $this->nome, excluido = $this->excluido 
		WHERE idSetor = $this->idSetor";
		$result = $this -> query($sql, true);
	}

	function selectSetor($where = "WHERE 1") {
		$sql = "SELECT idSetor, nome, excluido FROM setor " . $where;
		return $this -> executeQuery($sql);
	}

/*	function selectFuncionarioSetorTr($caminhoModulo, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT DISTINCT(idFuncionarioSetor), F.nome AS nomeFuncionario, S.nome AS nomeSetor 
		FROM funcionarioSetor AS FS 
		INNER JOIN funcionario AS F ON F.idFuncionario= FS.funcionario_idFuncionario
		INNER JOIN setor AS S ON S.idSetor = FS.setor_idSetor 
		" . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idFuncionarioSetor = $valor['idFuncionarioSetor'];

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoModulo . "formulario.php?id=$idFuncionarioSetor', '$caminhoAtualizar', '$ondeAtualiza')\"  ";

				$html .= "<tr>";

				$html .= "<td $onclick >" . $valor['nomeSetor'] . "</td>";

				$html .= "<td $onclick>" . $valor['nomeFuncionario'] . "</td>";

				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', '$idFuncionarioSetor', '$caminhoAtualizar', '$ondeAtualiza')\" >
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>";

				$html .= "</tr>";
			}
		}
		return $html;
	}

	function selectSetorSelect($classes = "", $idAtual = 0, $where = "") {

		$sql = "SELECT idSetor, nome, excluido FROM setor " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idSetor\" name=\"idSetor\"  class=\"" . $classes . "\" >";
		$html = $html . "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idSetor'] ? "selected=\"selected\"" : "";
			$html = $html . "<option " . $selecionado . " value=\"" . $valor['idSetor'] . "\">" . ($valor['idSetor']) . "</option>";
		}

		$html = $html . "</select>";
		return $html;
	}
*/
	function selectSetorSelect($idAtual = 0, $classes = "", $and = "") {

		$sql = "SELECT SQL_CACHE idSetor, nome FROM setor 
		WHERE excluido = 0 " . $and . " ORDER BY nome";
		$result = $this -> query($sql);

		$html = "<select id=\"idSetor\" name=\"idSetor\" class=\"" . $classes . "\" > 
		<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idSetor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idSetor'] . "\">" . ($valor['nome']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function selectSetorSelectC($idAtual = 0, $classes = "", $and = "") {

		$sql = "SELECT SQL_CACHE idSetor, nome FROM setor 
		WHERE excluido = 0 " . $and . " ORDER BY nome";
		$result = $this -> query($sql);

		$html = "<select id=\"idSetorC\" name=\"idSetorC\" class=\"" . $classes . "\" > 
		<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idSetor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idSetor'] . "\">" . ($valor['nome']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function selectSetorSelectMulti($idAtual = 0, $classes = "", $and = "") {

		$sql = "SELECT SQL_CACHE idSetor, nome FROM setor 
		WHERE excluido = 0 " . $and . " ORDER BY nome";
		$result = $this -> query($sql);

		$html = "<select id=\"idSetor[]\" multiple name=\"idSetor[]\" class=\"" . $classes . "\" > 
		<option value=\"all\">Todos</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idSetor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idSetor'] . "\">" . ($valor['nome']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function getNome($id) {
		$rs = $this->selectSetor(" WHERE idSetor = ".$id);
		$nome = $rs[0]['nome'];	
		return $nome;
		
	}

}
?>