<?php
class Telefone extends Database {
	// class attributes
	var $idTelefone;
	var $clientePjIdClientePj;
	var $clientePfIdClientePf;
	var $funcionarioIdFuncionario;
	var $professorIdProfessor;
	var $contatoAdicionalIdContatoAdicional;
	var $ddd;
	var $numero;
	var $operadoraCelularIdOperadoraCelular;
	var $obs;
	var $dataCadastro;
	var $descricaoTelefoneIdDescricaoTelefone;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTelefone = "NULL";
		$this -> clientePjIdClientePj = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> funcionarioIdFuncionario = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> contatoAdicionalIdContatoAdicional = "NULL";
		$this -> ddd = "NULL";
		$this -> numero = "NULL";
		$this -> operadoraCelularIdOperadoraCelular = "NULL";
		$this -> obs = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> descricaoTelefoneIdDescricaoTelefone = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTelefone($value) {
		$this -> idTelefone = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
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

	function setContatoAdicionalIdContatoAdicional($value) {
		$this -> contatoAdicionalIdContatoAdicional = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDdd($value) {
		$this -> ddd = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNumero($value) {
		$this -> numero = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setOperadoraCelularIdOperadoraCelular($value) {
		$this -> operadoraCelularIdOperadoraCelular = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setDescricaoTelefoneIdDescricaoTelefone($value) {
		$this -> descricaoTelefoneIdDescricaoTelefone = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addTelefone() Function
	 */
	function addTelefone() {
		$sql = "INSERT INTO telefone (clientePj_idClientePj, clientePf_idClientePf, funcionario_idFuncionario, professor_idProfessor, contatoAdicional_idContatoAdicional, ddd, numero, operadoraCelular_idOperadoraCelular, obs, dataCadastro, descricaoTelefone_idDescricaoTelefone) VALUES ($this->clientePjIdClientePj, $this->clientePfIdClientePf, $this->funcionarioIdFuncionario, $this->professorIdProfessor, $this->contatoAdicionalIdContatoAdicional, $this->ddd, $this->numero, $this->operadoraCelularIdOperadoraCelular, $this->obs, $this->dataCadastro, $this->descricaoTelefoneIdDescricaoTelefone)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteTelefone() Function
	 */
	function deleteTelefone($or = " 1 = 2 ") {
		$sql = "DELETE FROM telefone WHERE idTelefone = $this->idTelefone OR (" . $or . ")";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTelefone() Function
	 */
	function updateFieldTelefone($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE telefone SET " . $field . " = " . $value . " WHERE idTelefone = $this->idTelefone";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTelefone() Function
	 */
	function updateTelefone() {
		$sql = "UPDATE telefone SET clientePj_idClientePj = $this->clientePjIdClientePj, clientePf_idClientePf = $this->clientePfIdClientePf, funcionario_idFuncionario = $this->funcionarioIdFuncionario, professor_idProfessor = $this->professorIdProfessor, contatoAdicional_idContatoAdicional = $this->contatoAdicionalIdContatoAdicional, ddd = $this->ddd, numero = $this->numero, operadoraCelular_idOperadoraCelular = $this->operadoraCelularIdOperadoraCelular, obs = $this->obs, descricaoTelefone_idDescricaoTelefone = $this->descricaoTelefoneIdDescricaoTelefone WHERE idTelefone = $this->idTelefone";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTelefone() Function
	 */
	function selectTelefone($where = "") {
		$sql = "SELECT SQL_CACHE idTelefone, clientePj_idClientePj, clientePf_idClientePf, funcionario_idFuncionario, professor_idProfessor, contatoAdicional_idContatoAdicional, ddd, numero, operadoraCelular_idOperadoraCelular, obs, dataCadastro, descricaoTelefone_idDescricaoTelefone FROM telefone " . $where;
		return $this -> executeQuery($sql);
	}

	function selectTelefoneTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "",$mobile) {

		$sql = "SELECT SQL_CACHE T.idTelefone, T.numero, T.ddd, DT.nome 
		FROM telefone AS T 
		LEFT JOIN descricaoTelefone AS DT ON DT.idDescricaoTelefone = T.descricaoTelefone_idDescricaoTelefone " . $where;

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idTelefone = $valor['idTelefone'];
				$nome = $valor['nome'];
				$ddd = $valor['ddd'];
				$numero = $valor['numero'];
				
				if ($mobile != 1) {

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/telefone.php?id=$idTelefone', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "form/telefone.php?id=$idTelefone', '$ondeAtualiza')\" ";
					
				}

				$html .= "<tr>
				
				<td $onclick >" . $ddd . "</td> 
				
				<td  >" . $numero . "</td>
				
				<td $onclick >" . $nome . "</td>
				
				<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/telefone.php', '$idTelefone', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";

			}
		}
		return $html;
	}

	function getTelefone($id) {
		$sql = " SELECT T.ddd, T.numero, D.nome AS descricao
		FROM telefone AS T 
		LEFT JOIN descricaoTelefone AS D ON D.idDescricaoTelefone = T.descricaoTelefone_idDescricaoTelefone 		
		WHERE T.idTelefone = $id ";
		$rs = mysqli_fetch_array($this -> query($sql));
		return ($rs['ddd'] ? "(" . $rs['ddd'] . ") " : "") . $rs['numero'] . ($rs['descricao'] ? " [" . $rs['descricao'] . "]" : "");
		
	}

}
?>