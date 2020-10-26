<?php
class Representante extends Database {
	// class attributes
	var $idRepresentante;
	var $clientePfIdClientePf;
	var $funcionarioIdFuncionario;
	var $professorIdProfessor;
	var $dataCadastro;
	var $inativo;
	var $funcionarioIdFuncionarioQuemCadastrou;
	var $senhaAcesso;
	var $obs;
	var $campo;
	var $campo2;
	var $opcao;
	var $opcao2;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idRepresentante = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> funcionarioIdFuncionario = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> inativo = "0";
		$this -> funcionarioIdFuncionarioQuemCadastrou = "NULL";
		$this -> senhaAcesso = "NULL";
		$this -> obs = "NULL";
		$this -> campo = "NULL";
		$this -> campo2 = "NULL";
		$this -> opcao = "NULL";
		$this -> opcao2 = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdRepresentante($value) {
		$this -> idRepresentante = ($value) ? $this -> gravarBD($value) : "NULL";
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
		$this -> senhaAcesso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCampo($value) {
		$this -> campo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCampo2($value) {
		$this -> campo2 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setOpcao($value) {
		$this -> opcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setOpcao2($value) {
		$this -> opcao2 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addRepresentante() Function
	 */
	function addRepresentante() {
		$sql = "INSERT INTO representante (clientePf_idClientePf, funcionario_idFuncionario, professor_idProfessor, dataCadastro, inativo, funcionario_idFuncionario_QuemCadastrou, senhaAcesso, obs, campo, campo2, opcao, opcao2) VALUES ($this->clientePfIdClientePf, $this->funcionarioIdFuncionario, $this->professorIdProfessor, $this->dataCadastro, $this->inativo, $this->funcionarioIdFuncionarioQuemCadastrou, $this->senhaAcesso, $this->obs, $this->campo, $this->campo2, $this->opcao, $this->opcao2)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteRepresentante() Function
	 */
	function deleteRepresentante() {
		$sql = "DELETE FROM representante WHERE idRepresentante = $this->idRepresentante";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldRepresentante() Function
	 */
	function updateFieldRepresentante($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE representante SET " . $field . " = " . $value . " WHERE idRepresentante = $this->idRepresentante";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateRepresentante() Function
	 */
	function updateRepresentante() {
		$sql = "UPDATE representante SET clientePf_idClientePf = $this->clientePfIdClientePf, funcionario_idFuncionario = $this->funcionarioIdFuncionario, professor_idProfessor = $this->professorIdProfessor, inativo = $this->inativo, funcionario_idFuncionario_QuemCadastrou = $this->funcionarioIdFuncionarioQuemCadastrou, senhaAcesso = $this->senhaAcesso, obs = $this->obs, campo = $this->campo, campo2 = $this->campo2, opcao = $this->opcao, opcao2 = $this->opcao2 WHERE idRepresentante = $this->idRepresentante";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectRepresentante() Function
	 */
	function selectRepresentante($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idRepresentante, clientePf_idClientePf, funcionario_idFuncionario, professor_idProfessor, dataCadastro, inativo, funcionario_idFuncionario_QuemCadastrou, senhaAcesso, obs, campo, campo2, opcao, opcao2 FROM representante " . $where;
		return $this -> executeQuery($sql);
	}

	function representanteNome($and = "") {
		$sql = " SELECT idRepresentante, COALESCE(F.nome, PF.nome, P.nome, 'indefinido') AS nomeFK 
		FROM representante AS G 
		LEFT JOIN funcionario AS F ON F.idFuncionario = G.funcionario_idFuncionario 
		LEFT JOIN clientePf AS PF ON PF.idClientePf = G.clientePf_idClientePf 
		LEFT JOIN professor AS P ON P.idProfessor = G.professor_idProfessor 
		WHERE G.inativo  = 0 " . $and . " ORDER BY nomeFK ";
		//echo "<br>".$sql;
		$result = $this -> query($sql);
		return $result;
	}

	function getNome($idRepresentante) {
		$representante = mysqli_fetch_array($this -> representanteNome(" AND idRepresentante = " . $idRepresentante));
		return $representante["nomeFK"];
	}

	function selectRepresentanteSelect($classes = "", $idAtual = 0, $and = "") {

		$result = $this -> representanteNome($and);

		$html = "<select id=\"idRepresentante\" name=\"idRepresentante\" class=\"" . $classes . "\" >
		<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idRepresentante'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " 
			value=\"" . $valor['idRepresentante'] . "\">" . $valor['nomeFK'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function selectRepresentanteSelectMult($classes = "", $idAtual = 0, $and = "") {

		$result = $this -> representanteNome($and);

		$html = "<select id=\"idRepresentante\" name=\"idRepresentante[]\" class=\"" . $classes . "\" multiple=\"multiple\" >";
		$html .= "<option value=\"\">Todos</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idRepresentante'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idRepresentante'] . "\">" . $valor['nomeFK'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	/**
	 * selectGestorTr() Function
	 */
	function selectRepresentanteTr($where = "") {

		$RepresentanteIdioma = new RepresentanteIdioma();

		$sql = "SELECT SQL_CACHE g.idRepresentante, g.clientePf_idClientePf, g.funcionario_idFuncionario, g.professor_idProfessor, g.inativo FROM representante AS g " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			while ($valor = mysqli_fetch_array($result)) {

				if ($valor['clientePf_idClientePf']) {
					$sql = "SELECT SQL_CACHE idClientePf id, nome FROM clientePf 
					WHERE idClientePf=" . $valor['clientePf_idClientePf'] . " LIMIT 1";
					//$tipo = 1;
				} elseif ($valor['funcionario_idFuncionario']) {
					$sql = "SELECT SQL_CACHE idFuncionario id, nome FROM funcionario 
					WHERE idFuncionario=" . $valor['funcionario_idFuncionario'] . " LIMIT 1";
					//$tipo = 2;
				} elseif ($valor['professor_idProfessor']) {
					$sql = "SELECT SQL_CACHE idProfessor id, nome FROM professor 
					WHERE idProfessor=" . $valor['professor_idProfessor'] . " LIMIT 1";
					//$tipo = 3;
				}
				$valor2 = mysqli_fetch_array(mysqli_query($sql));

				$html .= "<tr>
					
				<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "representante/cadastro.php?id=" . $valor['idRepresentante'] . "', '" . CAMINHO_CAD . "representante/index.php', '#centro')\" >" . ($valor2['nome']) . "</td>
				
				<td align=\"center\">" . $RepresentanteIdioma -> exibeIdiomas($valor['idRepresentante']) . "</td>
				
				<td align=\"center\">" . Uteis::exibirStatus(!$valor['inativo']) . "</td>
				
				</tr>";
			}
		}

		return $html;
	}

}
?>