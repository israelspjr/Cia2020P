<?php
class DemonstrativoCobrancaValorHora extends Database {
	// class attributes
	var $idDemonstrativoCobrancaValorHora;
	var $demonstrativoCobrancaIdDemonstrativoCobranca;
	var $valor;
	var $valorDesconto;
	var $validadeDesconto;
	var $dataInicio;
	var $dataFim;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDemonstrativoCobrancaValorHora = "NULL";
		$this -> demonstrativoCobrancaIdDemonstrativoCobranca = "NULL";
		$this -> valor = "NULL";
		$this -> valorDesconto = "NULL";
		$this -> validadeDesconto = "NULL";
		$this -> dataInicio = "NULL";
		$this -> dataFim = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDemonstrativoCobrancaValorHora($value) {
		$this -> idDemonstrativoCobrancaValorHora = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDemonstrativoCobrancaIdDemonstrativoCobranca($value) {
		$this -> demonstrativoCobrancaIdDemonstrativoCobranca = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {

		$this -> valor = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
	}

	function setValorDesconto($value) {

		$this -> valorDesconto = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
	}

	function setValidadeDesconto($value) {
		$this -> validadeDesconto = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataInicio($value) {
		$this -> dataInicio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataFim($value) {
		$this -> dataFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addDemonstrativoCobrancaValorHora() Function
	 */
	function addDemonstrativoCobrancaValorHora() {
		$sql = "INSERT INTO demonstrativoCobrancaValorHora (demonstrativoCobranca_idDemonstrativoCobranca, valor, valorDesconto, validadeDesconto, dataInicio, dataFim, dataCadastro) VALUES ($this->demonstrativoCobrancaIdDemonstrativoCobranca, $this->valor, $this->valorDesconto, $this->validadeDesconto, $this->dataInicio, $this->dataFim, $this->dataCadastro)";
		$result = $this -> query($sql, true);
		//echo "//$sql";exit;
		return $this -> connect;
	}

	/**
	 * deleteDemonstrativoCobrancaValorHora() Function
	 */
	function deleteDemonstrativoCobrancaValorHora($or = "") {
		$sql = "DELETE FROM demonstrativoCobrancaValorHora WHERE idDemonstrativoCobrancaValorHora = $this->idDemonstrativoCobrancaValorHora " . $or;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDemonstrativoCobrancaValorHora() Function
	 */
	function updateFieldDemonstrativoCobrancaValorHora($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE demonstrativoCobrancaValorHora SET " . $field . " = " . $value . " WHERE idDemonstrativoCobrancaValorHora = $this->idDemonstrativoCobrancaValorHora";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDemonstrativoCobrancaValorHora() Function
	 */
	function updateDemonstrativoCobrancaValorHora() {
		$sql = "UPDATE demonstrativoCobrancaValorHora SET demonstrativoCobranca_idDemonstrativoCobranca = $this->demonstrativoCobrancaIdDemonstrativoCobranca, valor = $this->valor, valorDesconto = $this->valorDesconto, validadeDesconto = $this->validadeDesconto, dataInicio = $this->dataInicio, dataFim = $this->dataFim,  WHERE idDemonstrativoCobrancaValorHora = $this->idDemonstrativoCobrancaValorHora";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDemonstrativoCobrancaValorHora() Function
	 */
	function selectDemonstrativoCobrancaValorHora($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDemonstrativoCobrancaValorHora, demonstrativoCobranca_idDemonstrativoCobranca, valor, valorDesconto, validadeDesconto, dataInicio, dataFim, dataCadastro FROM demonstrativoCobrancaValorHora " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectDemonstrativoCobrancaValorHoraTr() Function
	 */
	function selectDemonstrativoCobrancaValorHoraTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoCobrancaValorHora, demonstrativoCobranca_idDemonstrativoCobranca, valor, valorDesconto, validadeDesconto, dataInicio, dataFim, dataCadastro FROM demonstrativoCobrancaValorHora " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idDemonstrativoCobrancaValorHora'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idDemonstrativoCobrancaValorHora'] . "</td>";
				$html .= "<td>" . $valor['demonstrativoCobranca_idDemonstrativoCobranca'] . "</td>";
				$html .= "<td>" . $valor['valor'] . "</td>";
				$html .= "<td>" . $valor['valorDesconto'] . "</td>";
				$html .= "<td>" . $valor['validadeDesconto'] . "</td>";
				$html .= "<td>" . $valor['dataInicio'] . "</td>";
				$html .= "<td>" . $valor['dataFim'] . "</td>";
				$html .= "<td>" . $valor['dataCadastro'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/DemonstrativoCobrancaValorHora.php', " . $valor['idDemonstrativoCobrancaValorHora'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectDemonstrativoCobrancaValorHoraSelect() Function
	 */
	function selectDemonstrativoCobrancaValorHoraSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoCobrancaValorHora, demonstrativoCobranca_idDemonstrativoCobranca, valor, valorDesconto, validadeDesconto, dataInicio, dataFim, dataCadastro FROM demonstrativoCobrancaValorHora " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDemonstrativoCobrancaValorHora\" name=\"idDemonstrativoCobrancaValorHora\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDemonstrativoCobrancaValorHora'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDemonstrativoCobrancaValorHora'] . "\">" . ($valor['idDemonstrativoCobrancaValorHora']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>