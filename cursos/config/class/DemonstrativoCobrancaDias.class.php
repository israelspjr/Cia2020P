<?php
class DemonstrativoCobrancaDias extends Database {
	// class attributes
	var $idDemonstrativoCobrancaDias;
	var $demonstrativoCobrancaIdDemonstrativoCobranca;
	var $dia;
	var $horas;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDemonstrativoCobrancaDias = "NULL";
		$this -> demonstrativoCobrancaIdDemonstrativoCobranca = "NULL";
		$this -> dia = "NULL";
		$this -> horas = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDemonstrativoCobrancaDias($value) {
		$this -> idDemonstrativoCobrancaDias = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDemonstrativoCobrancaIdDemonstrativoCobranca($value) {
		$this -> demonstrativoCobrancaIdDemonstrativoCobranca = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDia($value) {
		$this -> dia = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHoras($value) {
		$this -> horas = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addDemonstrativoCobrancaDias() Function
	 */
	function addDemonstrativoCobrancaDias() {
		$sql = "INSERT INTO demonstrativoCobrancaDias (demonstrativoCobranca_idDemonstrativoCobranca, dia, horas, dataCadastro) VALUES ($this->demonstrativoCobrancaIdDemonstrativoCobranca, $this->dia, $this->horas, $this->dataCadastro)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteDemonstrativoCobrancaDias() Function
	 */
	function deleteDemonstrativoCobrancaDias($or = "") {
		$sql = "DELETE FROM demonstrativoCobrancaDias WHERE idDemonstrativoCobrancaDias = $this->idDemonstrativoCobrancaDias " . $or;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDemonstrativoCobrancaDias() Function
	 */
	function updateFieldDemonstrativoCobrancaDias($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE demonstrativoCobrancaDias SET " . $field . " = " . $value . " WHERE idDemonstrativoCobrancaDias = $this->idDemonstrativoCobrancaDias";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDemonstrativoCobrancaDias() Function
	 */
	function updateDemonstrativoCobrancaDias() {
		$sql = "UPDATE demonstrativoCobrancaDias SET demonstrativoCobranca_idDemonstrativoCobranca = $this->demonstrativoCobrancaIdDemonstrativoCobranca, dia = $this->dia, horas = $this->horas,  WHERE idDemonstrativoCobrancaDias = $this->idDemonstrativoCobrancaDias";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDemonstrativoCobrancaDias() Function
	 */
	function selectDemonstrativoCobrancaDias($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDemonstrativoCobrancaDias, demonstrativoCobranca_idDemonstrativoCobranca, dia, horas, dataCadastro FROM demonstrativoCobrancaDias " . $where;
		//echo $sql;
		return $this -> executeQuery($sql);
        
	}

	/**
	 * selectDemonstrativoCobrancaDiasTr() Function
	 */
	function selectDemonstrativoCobrancaDiasTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoCobrancaDias, demonstrativoCobranca_idDemonstrativoCobranca, dia, horas, dataCadastro FROM demonstrativoCobrancaDias " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idDemonstrativoCobrancaDias'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idDemonstrativoCobrancaDias'] . "</td>";
				$html .= "<td>" . $valor['demonstrativoCobranca_idDemonstrativoCobranca'] . "</td>";
				$html .= "<td>" . $valor['dia'] . "</td>";
				$html .= "<td>" . $valor['horas'] . "</td>";
				$html .= "<td>" . $valor['dataCadastro'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/DemonstrativoCobrancaDias.php', " . $valor['idDemonstrativoCobrancaDias'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectDemonstrativoCobrancaDiasSelect() Function
	 */
	function selectDemonstrativoCobrancaDiasSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoCobrancaDias, demonstrativoCobranca_idDemonstrativoCobranca, dia, horas, dataCadastro FROM demonstrativoCobrancaDias " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDemonstrativoCobrancaDias\" name=\"idDemonstrativoCobrancaDias\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDemonstrativoCobrancaDias'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDemonstrativoCobrancaDias'] . "\">" . ($valor['idDemonstrativoCobrancaDias']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>