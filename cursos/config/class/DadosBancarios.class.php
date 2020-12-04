<?php
class DadosBancarios extends Database {
	// class attributes
	var $idDadosBancarios;
	var $professorIdProfessor;
	var $banco;
	var $agencia;
	var $tipo;
	var $numero;
	var $dataCadastro;
	var $favorecido;
	var $cobrarDoc;
	var $valor;
	var $dataInicio;
	var $dataFim;
	var $retiraCheque;
	var $obs;
	var $cpf;
	var $pix;
	

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDadosBancarios = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> banco = "NULL";
		$this -> agencia = "NULL";
		$this -> tipo = "NULL";
		$this -> numero = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> favorecido = "NULL";
		$this -> cobrarDoc = "NULL";
		$this -> valor = "NULL";
		$this -> dataInicio = "NULL";
		$this -> dataFim = "NULL";
		$this -> retiraCheque = "NULL";
		$this -> obs = "NULL";
		$this -> cpf = "NULL";
		$this -> pix = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDadosBancarios($value) {
		$this -> idDadosBancarios = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setBanco($value) {
		$this -> banco = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAgencia($value) {
		$this -> agencia = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNumero($value) {
		$this -> numero = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}
	
	function setFavorecido($value) {
		$this -> favorecido = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCobrarDoc($value) {
		$this -> cobrarDoc = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setDataInicio($value) {
		$this -> dataInicio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataFim($value) {
		$this -> dataFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setRetiraCheque($value) {
		$this -> retiraCheque = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setCpf($value) {
		$this -> cpf = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPix($value) {
		$this -> pix = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addDadosBancarios() Function
	 */
	function addDadosBancarios() {
		$sql = "INSERT INTO dadosBancarios (professor_idProfessor, banco, agencia, tipo, numero, dataCadastro, favorecido, cobrarDoc, valor, dataInicio, dataFim, retiraCheque, obs, cpf, pix) VALUES ($this->professorIdProfessor, $this->banco, $this->agencia, $this->tipo, $this->numero, $this->dataCadastro, $this->favorecido, $this->cobrarDoc, $this->valor, $this->dataInicio, $this->dataFim, $this->retiraCheque, $this->obs, $this->cpf, $this->pix)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteDadosBancarios() Function
	 */
	function deleteDadosBancarios() {
		$sql = "DELETE FROM dadosBancarios WHERE idDadosBancarios = $this->idDadosBancarios";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDadosBancarios() Function
	 */
	function updateFieldDadosBancarios($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE dadosBancarios SET " . $field . " = " . $value . " WHERE idDadosBancarios = $this->idDadosBancarios";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDadosBancarios() Function
	 */
	function updateDadosBancarios() {
		$sql = "UPDATE dadosBancarios SET banco = $this->banco, agencia = $this->agencia, tipo = $this->tipo, numero = $this->numero, favorecido = $this->favorecido, cobrarDoc = $this->cobrarDoc, valor = $this->valor, dataInicio = $this->dataInicio, dataFim = $this->dataFim, retiraCheque = $this->retiraCheque, obs = $this->obs, cpf = $this->cpf, pix = $this->pix  WHERE professor_idProfessor = $this->professorIdProfessor";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDadosBancarios() Function
	 */
	function selectDadosBancarios($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDadosBancarios, professor_idProfessor, banco, agencia, tipo, numero, dataCadastro, favorecido, cobrarDoc, valor, dataInicio, dataFim, retiraCheque, obs, cpf, pix FROM dadosBancarios " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectDadosBancariosTr() Function
	 */
	function selectDadosBancariosTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idDadosBancarios, professor_idProfessor, banco, agencia, tipo, numero, dataCadastro, favorecido, cobrarDoc, valor, dataInicio, dataFim, retiraCheque, obs, cpf, pix FROM dadosBancarios " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idDadosBancarios'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idDadosBancarios'] . "</td>";
				$html .= "<td>" . $valor['professor_idProfessor'] . "</td>";
				$html .= "<td>" . $valor['banco'] . "</td>";
				$html .= "<td>" . $valor['agencia'] . "</td>";
				$html .= "<td>" . $valor['tipo'] . "</td>";
				$html .= "<td>" . $valor['numero'] . "</td>";
				$html .= "<td>" . $valor['favorecido'] . "</td>";
				$html .= "<td>" . $valor['dataCadastro'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/DadosBancarios.php', " . $valor['idDadosBancarios'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectDadosBancariosSelect() Function
	 */
	function selectDadosBancariosSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDadosBancarios, professor_idProfessor, banco, agencia, tipo, numero, dataCadastro, favorecido, cobrarDoc, valor, dataInicio, dataFim, retiraCheque FROM dadosBancarios " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDadosBancarios\" name=\"idDadosBancarios\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDadosBancarios'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDadosBancarios'] . "\">" . ($valor['idDadosBancarios']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>

