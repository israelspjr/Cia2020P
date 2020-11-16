<?php
class MedicaoResultadoINF extends Database {
	// class attributes
	var $idMedicaoResultadoINF;
	var $relacionamentoINFIdRelacionamentoINF;
	var $medicaoResultadoIdMedicaoResultado;
	var $qtd;
	var $inativo;
	var $dataCadastro;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idMedicaoResultadoINF = "NULL";
		$this -> relacionamentoINFIdRelacionamentoINF = "NULL";
		$this -> medicaoResultadoIdMedicaoResultado = "NULL";
		$this -> qtd = "NULL";
		$this -> inativo = "0";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdMedicaoResultadoINF($value) {
		$this -> idMedicaoResultadoINF = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setRelacionamentoINFIdRelacionamentoINF($value) {
		$this -> relacionamentoINFIdRelacionamentoINF = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMedicaoResultadoIdMedicaoResultado($value) {
		$this -> medicaoResultadoIdMedicaoResultado = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setQtd($value) {
		$this -> qtd = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addMedicaoResultadoINF() Function
	 */
	function addMedicaoResultadoINF() {
		$sql = "INSERT INTO medicaoResultadoINF (relacionamentoINF_idRelacionamentoINF, medicaoResultado_idMedicaoResultado, qtd, inativo, dataCadastro, excluido) VALUES ($this->relacionamentoINFIdRelacionamentoINF, $this->medicaoResultadoIdMedicaoResultado, $this->qtd, $this->inativo, '" . date('Y-m-y H:i:s') . "', $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteMedicaoResultadoINF() Function
	 */
	function deleteMedicaoResultadoINF() {
		$sql = "DELETE FROM medicaoResultadoINF WHERE idMedicaoResultadoINF = $this->idMedicaoResultadoINF";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldMedicaoResultadoINF() Function
	 */
	function updateFieldMedicaoResultadoINF($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE medicaoResultadoINF SET " . $field . " = " . $value . " WHERE idMedicaoResultadoINF = $this->idMedicaoResultadoINF";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateMedicaoResultadoINF() Function
	 */
	function updateMedicaoResultadoINF() {
		$sql = "UPDATE medicaoResultadoINF SET relacionamentoINF_idRelacionamentoINF = $this->relacionamentoINFIdRelacionamentoINF, medicaoResultado_idMedicaoResultado = $this->medicaoResultadoIdMedicaoResultado, qtd = $this->qtd, inativo = $this->inativo WHERE idMedicaoResultadoINF = $this->idMedicaoResultadoINF";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectMedicaoResultadoINF() Function
	 */
	function selectMedicaoResultadoINF($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idMedicaoResultadoINF, relacionamentoINF_idRelacionamentoINF, medicaoResultado_idMedicaoResultado, qtd, inativo, dataCadastro, excluido FROM medicaoResultadoINF " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectMedicaoResultadoINFTr() Function
	 */
	function selectMedicaoResultadoINFTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {

		$RelacionamentoINF = new RelacionamentoINF();

		$sql = "SELECT SQL_CACHE m.idMedicaoResultadoINF, r.idRelacionamentoINF, m.medicaoResultado_idMedicaoResultado, m.qtd, m.inativo, m.dataCadastro, m.excluido, mr.medicao nomeidMedicaoResultado, r.cargaHoraria nomeidRelacionamentoINF  
		FROM medicaoResultadoINF m  
		INNER JOIN relacionamentoINF r ON r.idRelacionamentoINF = m.relacionamentoINF_idRelacionamentoINF 
		INNER JOIN medicaoResultado mr ON mr.idMedicaoResultado = m.medicaoResultado_idMedicaoResultado" . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idMedicaoResultadoINF = $valor['idMedicaoResultadoINF'];
				$relacionamentoINF_idRelacionamentoINF = $valor['idRelacionamentoINF'];
				$medicaoResultado_idMedicaoResultado = $valor['nomeidMedicaoResultado'];
				$qtd = $valor['qtd'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//
				$dataCadastro = $valor['dataCadastro'];

				$html .= "<td>" . $idMedicaoResultadoINF . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idMedicaoResultadoINF'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $RelacionamentoINF -> getRelacionamentoINF($relacionamentoINF_idRelacionamentoINF) . "</td>";
				$html .= "<td>" . $medicaoResultado_idMedicaoResultado . "</td>";
				$html .= "<td>" . $qtd . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				//$html .= "<td>".$dataCadastro."</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idMedicaoResultadoINF'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectMedicaoResultadoINFSelect() Function
	 */
	function selectMedicaoResultadoINFSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idMedicaoResultadoINF, relacionamentoINF_idRelacionamentoINF, medicaoResultado_idMedicaoResultado, qtd, inativo, dataCadastro, excluido FROM medicaoResultadoINF " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idMedicaoResultadoINF\" name=\"idMedicaoResultadoINF\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idMedicaoResultadoINF'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idMedicaoResultadoINF'] . "\">" . ($valor['qtd']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>