<?php
class DemonstrativoPagamentoImposto extends Database {
	// class attributes
	var $idDemonstrativoPagamentoImposto;
	var $demonstrativoPagamentoIdDemonstrativoPagamento;
	var $tipoImpostoProfessorIdTipoImpostoProfessor;
	var $valor;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDemonstrativoPagamentoImposto = "NULL";
		$this -> demonstrativoPagamentoIdDemonstrativoPagamento = "NULL";
		$this -> tipoImpostoProfessorIdTipoImpostoProfessor = "NULL";
		$this -> valor = "0";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDemonstrativoPagamentoImposto($value) {
		$this -> idDemonstrativoPagamentoImposto = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDemonstrativoPagamentoIdDemonstrativoPagamento($value) {
		$this -> demonstrativoPagamentoIdDemonstrativoPagamento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoImpostoProfessorIdTipoImpostoProfessor($value) {
		$this -> tipoImpostoProfessorIdTipoImpostoProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {		
		$this -> valor = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addDemonstrativoPagamentoImposto() Function
	 */
	function addDemonstrativoPagamentoImposto() {
		$sql = "INSERT INTO demonstrativoPagamentoImposto (demonstrativoPagamento_idDemonstrativoPagamento, tipoImpostoProfessor_idTipoImpostoProfessor, valor, dataCadastro) VALUES ($this->demonstrativoPagamentoIdDemonstrativoPagamento, $this->tipoImpostoProfessorIdTipoImpostoProfessor, $this->valor, $this->dataCadastro)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteDemonstrativoPagamentoImposto() Function
	 */
	function deleteDemonstrativoPagamentoImposto($or = "") {
		$sql = "DELETE FROM demonstrativoPagamentoImposto WHERE idDemonstrativoPagamentoImposto = $this->idDemonstrativoPagamentoImposto " . $or;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDemonstrativoPagamentoImposto() Function
	 */
	function updateFieldDemonstrativoPagamentoImposto($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE demonstrativoPagamentoImposto SET " . $field . " = " . $value . " WHERE idDemonstrativoPagamentoImposto = $this->idDemonstrativoPagamentoImposto";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDemonstrativoPagamentoImposto() Function
	 */
	function updateDemonstrativoPagamentoImposto() {
		$sql = "UPDATE demonstrativoPagamentoImposto SET demonstrativoPagamento_idDemonstrativoPagamento = $this->demonstrativoPagamentoIdDemonstrativoPagamento, tipoImpostoProfessor_idTipoImpostoProfessor = $this->tipoImpostoProfessorIdTipoImpostoProfessor, valor = $this->valor,  WHERE idDemonstrativoPagamentoImposto = $this->idDemonstrativoPagamentoImposto";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDemonstrativoPagamentoImposto() Function
	 */
	function selectDemonstrativoPagamentoImposto($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamentoImposto, demonstrativoPagamento_idDemonstrativoPagamento, tipoImpostoProfessor_idTipoImpostoProfessor, valor, dataCadastro FROM demonstrativoPagamentoImposto " . $where;
		//echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectDemonstrativoPagamentoImpostoTr() Function
	 */
	function selectDemonstrativoPagamentoImpostoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamentoImposto, demonstrativoPagamento_idDemonstrativoPagamento, tipoImpostoProfessor_idTipoImpostoProfessor, valor, dataCadastro FROM demonstrativoPagamentoImposto " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idDemonstrativoPagamentoImposto'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idDemonstrativoPagamentoImposto'] . "</td>";
				$html .= "<td>" . $valor['demonstrativoPagamento_idDemonstrativoPagamento'] . "</td>";
				$html .= "<td>" . $valor['tipoImpostoProfessor_idTipoImpostoProfessor'] . "</td>";
				$html .= "<td>" . $valor['valor'] . "</td>";
				$html .= "<td>" . $valor['dataCadastro'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/DemonstrativoPagamentoImposto.php', " . $valor['idDemonstrativoPagamentoImposto'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectDemonstrativoPagamentoImpostoSelect() Function
	 */
	function selectDemonstrativoPagamentoImpostoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamentoImposto, demonstrativoPagamento_idDemonstrativoPagamento, tipoImpostoProfessor_idTipoImpostoProfessor, valor, dataCadastro FROM demonstrativoPagamentoImposto " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDemonstrativoPagamentoImposto\" name=\"idDemonstrativoPagamentoImposto\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDemonstrativoPagamentoImposto'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDemonstrativoPagamentoImposto'] . "\">" . ($valor['idDemonstrativoPagamentoImposto']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>