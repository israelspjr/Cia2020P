<?php
class Gestor extends Database {
	// class attributes
	var $idGestor;
	var $clientePfIdClientePf;
	var $funcionarioIdFuncionario;
	var $professorIdProfessor;
	var $dataCadastro;
	var $inativo;
	var $funcionarioIdFuncionarioQuemCadastrou;
	var $senhaAcesso;
	var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idGestor = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> funcionarioIdFuncionario = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> inativo = "0";
		$this -> funcionarioIdFuncionarioQuemCadastrou = "NULL";
		$this -> senhaAcesso = "NULL";
		$this -> obs = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdGestor($value) {
		$this -> idGestor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFuncionarioIdFuncionario($value) {
		$this -> funcionarioIdFuncionario = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setFuncionarioIdFuncionarioQuemCadastrou($value) {
		$this -> funcionarioIdFuncionarioQuemCadastrou = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setSenhaAcesso($value) {
	  $value = EncryptSenha::B64_Encode($value);
		$this -> senhaAcesso = ($value) ? $this -> gravarBD($value) : "NULL";
    
    	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addGestor() Function
	 */
	function addGestor() {
		$sql = "INSERT INTO gestor (clientePf_idClientePf, funcionario_idFuncionario, professor_idProfessor, dataCadastro, inativo, funcionario_idFuncionario_QuemCadastrou, senhaAcesso, obs) VALUES ($this->clientePfIdClientePf, $this->funcionarioIdFuncionario, $this->professorIdProfessor, $this->dataCadastro, $this->inativo, $this->funcionarioIdFuncionarioQuemCadastrou, $this->senhaAcesso, $this->obs)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteGestor() Function
	 */
	function deleteGestor() {
		$sql = "DELETE FROM gestor WHERE idGestor = $this->idGestor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldGestor() Function
	 */
	function updateFieldGestor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE gestor SET " . $field . " = " . $value . " WHERE idGestor = $this->idGestor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateGestor() Function
	 */
	function updateGestor() {
		$sql = "UPDATE gestor SET clientePf_idClientePf = $this->clientePfIdClientePf, funcionario_idFuncionario = $this->funcionarioIdFuncionario, professor_idProfessor = $this->professorIdProfessor, inativo = $this->inativo, funcionario_idFuncionario_QuemCadastrou = $this->funcionarioIdFuncionarioQuemCadastrou, senhaAcesso = $this->senhaAcesso, obs = $this->obs WHERE idGestor = $this->idGestor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectGestor() Function
	 */
	function selectGestor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idGestor, clientePf_idClientePf, funcionario_idFuncionario, professor_idProfessor, dataCadastro, inativo, funcionario_idFuncionario_QuemCadastrou, senhaAcesso, obs FROM gestor " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectGestorTr() Function
	 */
	function selectGestorTr($where = "") {
		$sql = "SELECT SQL_CACHE g.idGestor, g.clientePf_idClientePf, g.funcionario_idFuncionario, g.professor_idProfessor, g.inativo FROM gestor g " . $where;
		$result = $this -> query($sql);
    //echo $sql;
		if (mysqli_num_rows($result) > 0) {
			while ($valor = mysqli_fetch_array($result)) {
				if ((!is_null($valor['clientePf_idClientePf'])) && $valor['clientePf_idClientePf'] > 0) {
					$sql2 = "SELECT SQL_CACHE idClientePf id, nome FROM clientePf WHERE idClientePf=" . $valor['clientePf_idClientePf'] . " LIMIT 1";
					$tipo = 1;
				} elseif ((!is_null($valor['funcionario_idFuncionario'])) && $valor['funcionario_idFuncionario'] > 0) {
					$sql2 = "SELECT SQL_CACHE idFuncionario id, nome FROM funcionario WHERE idFuncionario=" . $valor['funcionario_idFuncionario'] . " LIMIT 1";
					$tipo = 2;
				} elseif ((!is_null($valor['professor_idProfessor'])) && $valor['professor_idProfessor'] > 0) {
					$sql2 = "SELECT SQL_CACHE idProfessor id, nome FROM professor WHERE idProfessor=" . $valor['professor_idProfessor'] . " LIMIT 1";
					$tipo = 3;
				}
				$valor2 = mysqli_fetch_array(mysqli_query($sql2));

				$html .= "<tr>";
				$html .= "<td  onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "gestor/cadastro.php?id=" . $valor['idGestor'] . "', '" . CAMINHO_CAD . "gestor/index.php', '#centro')\" >" . ($valor2['nome']) . "</td>";

				$html .= "<td align=\"center\">" . Uteis::exibirStatus(!$valor['inativo']) . "</td>";

				$html .= "</tr>";
			}
		}

		return $html;
	}

	function gestorNome($and = "") {
		$sql = " SELECT idGestor, COALESCE(F.nome, PF.nome, P.nome, 'indefinido') AS nomeFK FROM gestor AS G ";
		$sql .= " LEFT JOIN funcionario AS F ON F.idFuncionario = G.funcionario_idFuncionario ";
		$sql .= " LEFT JOIN clientePf AS PF ON PF.idClientePf = G.clientePf_idClientePf ";
		$sql .= " LEFT JOIN professor AS P ON P.idProfessor = G.professor_idProfessor ";
		$sql .= " WHERE G.inativo  = 0 " . $and . " ORDER BY nomeFK ";

		$result = $this -> query($sql);
		return $result;
	}

	function selectGestorSelect($classes = "", $idAtual = 0, $and = "") {

		$result = $this -> gestorNome($and);

		$html = "<select id=\"idGestor\" name=\"idGestor\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idGestor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idGestor'] . "\">" . $valor['nomeFK'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function selectGestorSelectMult($classes = "", $idAtual = 0, $and = "") {

		$result = $this -> gestorNome($and);

		$html = "<select id=\"idGestor\" name=\"idGestor[]\" multiple=\"multiple\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Todos</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idGestor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idGestor'] . "\">" . $valor['nomeFK'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>