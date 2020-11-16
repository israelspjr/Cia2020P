<?php
class FuncionarioSetor extends Database {

	// class attributes
	var $idFuncionarioSetor;
	var $funcionarioIdFuncionario;
	var $setorIdSetor;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idFuncionarioSetor = "NULL";
		$this -> funcionarioIdFuncionario = "NULL";
		$this -> setorIdSetor = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdFuncionarioSetor($value) {
		$this -> idFuncionarioSetor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFuncionarioIdFuncionario($value) {
		$this -> funcionarioIdFuncionario = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setSetorIdSetor($value) {
		$this -> setorIdSetor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function addFuncionarioSetor() {
		$sql = "INSERT INTO funcionarioSetor (funcionario_idFuncionario, setor_idSetor) VALUES ($this->funcionarioIdFuncionario, $this->setorIdSetor)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	function deleteFuncionarioSetor() {
		$sql = "DELETE FROM funcionarioSetor WHERE idFuncionarioSetor = $this->idFuncionarioSetor";
		$result = $this -> query($sql, true);
	}

	function updateFieldFuncionarioSetor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $this -> gravarBD($value);
		$sql = "UPDATE funcionarioSetor SET " . $field . " = " . $value . " WHERE idFuncionarioSetor = $this->idFuncionarioSetor";
		$result = $this -> query($sql, true);
	}

	function updateFuncionarioSetor() {
		$sql = "UPDATE funcionarioSetor SET funcionario_idFuncionario = $this->funcionarioIdFuncionario, setor_idSetor = $this->setorIdSetor 
		WHERE idFuncionarioSetor = $this->idFuncionarioSetor";
		$result = $this -> query($sql, true);
	}

	function selectFuncionarioSetor($where = "WHERE 1") {
		$sql = "SELECT idFuncionarioSetor, funcionario_idFuncionario, setor_idSetor FROM funcionarioSetor " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectFuncionarioSetorTr($caminhoModulo, $caminhoAtualizar, $ondeAtualiza, $where = "") {

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

	function selectFuncionarioSetorSelect($classes = "", $idAtual = 0, $where = "") {

		$sql = "SELECT idFuncionarioSetor, funcionario_idFuncionario, setor_idSetor FROM funcionarioSetor " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idFuncionarioSetor\" name=\"idFuncionarioSetor\"  class=\"" . $classes . "\" >";
		$html = $html . "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idFuncionarioSetor'] ? "selected=\"selected\"" : "";
			$html = $html . "<option " . $selecionado . " value=\"" . $valor['idFuncionarioSetor'] . "\">" . ($valor['idFuncionarioSetor']) . "</option>";
		}

		$html = $html . "</select>";
		return $html;
	}

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

}
?>