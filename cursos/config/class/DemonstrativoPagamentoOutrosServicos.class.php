<?php
class DemonstrativoPagamentoOutrosServicos extends Database {
	// class attributes
	var $idDemonstrativoPagamentoOutrosServicos;
	var $demonstrativoPagamentoIdDemonstrativoPagamento;
	var $tipo;
	var $valor;
	var $obs;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDemonstrativoPagamentoOutrosServicos = "NULL";
		$this -> demonstrativoPagamentoIdDemonstrativoPagamento = "NULL";
		$this -> tipo = "NULL";
		$this -> valor = "NULL";
		$this -> obs = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDemonstrativoPagamentoOutrosServicos($value) {
		$this -> idDemonstrativoPagamentoCredDeb = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDemonstrativoPagamentoIdDemonstrativoPagamento($value) {
		$this -> demonstrativoPagamentoIdDemonstrativoPagamento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}
	
	function getTotal($id) {
		$rs = $this -> selectDemonstrativoPagamentoOutrosServicos(" WHERE DemonstrativoPagamento_idDemonstrativoPagamento = $id");
		return $rs[0]['valor'];
	}

	/**
	 * addDemonstrativoPagamentoCredDeb() Function
	 */
	function addDemonstrativoPagamentoOutrosServicos() {
		$sql = "INSERT INTO demonstrativoPagamentoOutrosServicos (demonstrativoPagamento_idDemonstrativoPagamento, tipo, valor, obs, dataCadastro) VALUES ($this->demonstrativoPagamentoIdDemonstrativoPagamento, $this->tipo, $this->valor, $this->obs, $this->dataCadastro)";
		//echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteDemonstrativoPagamentoCredDeb() Function
	 */
	function deleteDemonstrativoPagamentoOutrosServicos($or = "") {
		$sql = "DELETE FROM demonstrativoPagamentoOutrosServicos WHERE idDemonstrativoPagamentoOutrosServicos = $this->idDemonstrativoPagamentoOutrosServicos " . $or;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDemonstrativoPagamentoCredDeb() Function
	 */
	function updateFieldDemonstrativoPagamentoOutrosServicos($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE demonstrativoPagamentoOutrosServicos SET " . $field . " = " . $value . " WHERE idDemonstrativoPagamentoOutrosServicos = $this->idDemonstrativoPagamentoCredDeb";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDemonstrativoPagamentoCredDeb() Function
	 */
	function updateDemonstrativoPagamentoOutrosServicos() {
		$sql = "UPDATE demonstrativoPagamentoOutrosServicos SET demonstrativoPagamento_idDemonstrativoPagamento = $this->demonstrativoPagamentoIdDemonstrativoPagamento, tipo = $this->tipo, valor = $this->valor, obs = $this->obs,  WHERE idDemonstrativoPagamentoOutrosServicos = $this->idDemonstrativoPagamentoCredDeb";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDemonstrativoPagamentoCredDeb() Function
	 */
	function selectDemonstrativoPagamentoOutrosServicos($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamentoOutrosServicos, demonstrativoPagamento_idDemonstrativoPagamento, tipo, valor, obs, dataCadastro FROM demonstrativoPagamentoOutrosServicos " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectDemonstrativoPagamentoCredDebTr() Function
	 */
	function selectDemonstrativoPagamentoOutrosServicosTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamentoCredDeb, demonstrativoPagamento_idDemonstrativoPagamento, tipo, valor, obs, dataCadastro FROM demonstrativoPagamentoOutrosServicos " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idDemonstrativoPagamentoCredDeb'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idDemonstrativoPagamentoOutrosServicos'] . "</td>";
				$html .= "<td>" . $valor['demonstrativoPagamento_idDemonstrativoPagamento'] . "</td>";
				$html .= "<td>" . $valor['tipo'] . "</td>";
				$html .= "<td>" . $valor['valor'] . "</td>";
				$html .= "<td>" . $valor['obs'] . "</td>";
				$html .= "<td>" . $valor['dataCadastro'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/DemonstrativoPagamentoOutrosServicos.php', " . $valor['idDemonstrativoPagamentoCredDeb'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectDemonstrativoPagamentoCredDebSelect() Function
	 */
	function selectDemonstrativoPagamentoOutrosServicosSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamentoOutrosServicos, demonstrativoPagamento_idDemonstrativoPagamento, tipo, valor, obs, dataCadastro FROM demonstrativoPagamentoOutrosServicos " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDemonstrativoPagamentoOutrosServicos\" name=\"idDemonstrativoPagamentoOutrosServicos\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDemonstrativoPagamentoOutrosServicos'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDemonstrativoPagamentoOutrosServicos'] . "\">" . ($valor['idDemonstrativoPagamentoOutrosServicos']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>