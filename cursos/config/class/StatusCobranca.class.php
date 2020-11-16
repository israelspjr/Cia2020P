<?php
class StatusCobranca extends Database {
	// class attributes
	var $idStatusCobranca;
	var $status;
	var $cor;
	var $inativo;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idStatusCobranca = "NULL";
		$this -> status = "NULL";
		$this -> cor = "NULL";
		$this -> inativo = "0";
		$this -> excluido = "0";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdStatusCobranca($value) {
		$this -> idStatusCobranca = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setStatus($value) {
		$this -> status = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCor($value) {
		$this -> cor = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addStatusCobranca() Function
	 */
	function addStatusCobranca() {
		$sql = "INSERT INTO statusCobranca (status, cor, inativo, dataCadastro, excluido) VALUES ($this->status, $this->cor, $this->inativo, $this->dataCadastro, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteStatusCobranca() Function
	 */
	function deleteStatusCobranca() {
		$sql = "DELETE FROM statusCobranca WHERE idStatusCobranca = $this->idStatusCobranca";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldStatusCobranca() Function
	 */
	function updateFieldStatusCobranca($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE statusCobranca SET " . $field . " = " . $value . " WHERE idStatusCobranca = $this->idStatusCobranca";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateStatusCobranca() Function
	 */
	function updateStatusCobranca() {
		$sql = "UPDATE statusCobranca SET status = $this->status, cor = $this->cor, inativo = $this->inativo
		WHERE idStatusCobranca = $this->idStatusCobranca";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectStatusCobranca() Function
	 */
	function selectStatusCobranca($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idStatusCobranca, status, cor, inativo, dataCadastro, excluido 
		FROM statusCobranca " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectStatusCobrancaTr() Function
	 */
	function selectStatusCobrancaTr($caminhoModulo, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE idStatusCobranca, status, cor, inativo, dataCadastro, excluido 
		FROM statusCobranca " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoModulo . "formulario.php?id=" . $valor['idStatusCobranca'] . $idPai . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$inativo = "<center>
					" . Uteis::exibirStatus(!$valor['inativo']) . "
				</center>";

				$html .= "<tr>
				
				<td $onclick >" . $valor['status'] . "</td>
				
				<td $onclick align=\"center\" >
					<div style=\"background-color:" . $valor['cor'] . "; width:50%; height:5px;\" ></div>
				</td>
								
				<td $onclick >" . $inativo . "</td>
				
				<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', '" . $valor['idStatusCobranca'] . "', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectStatusCobrancaSelect() Function
	 */
	function selectStatusCobrancaSelect($classes = "", $idAtual = 0, $where = "") {

		$sql = "SELECT SQL_CACHE idStatusCobranca, status, cor, inativo, dataCadastro, excluido FROM statusCobranca " . $where;
		$result = $this -> query($sql);
//		echo $sql;

		$html = "<select id=\"idStatusCobranca\" name=\"idStatusCobranca\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"0\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idStatusCobranca'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idStatusCobranca'] . "\">" . ($valor['status']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectStatusCobranca_legenda() {

		$html = "";
		$rs = $this -> selectStatusCobranca(" WHERE (excluido = 0 AND inativo = 0) OR idStatusCobranca = 1 ");
		if ($rs) {
			$html .= "<div style=\"float:right\">";
			foreach ($rs as $valor) {
				$html .= "<div class=\"legenda\" ><div class=\"legenda_box\" style=\"background-color:" . $valor['cor'] . "\"></div>" . $valor['status'] . "</div>";
			}
			$html .= "</div>";
			$html .= "<div class=\"clear\"></div>";
		}

		return $html;
	}

}
?>