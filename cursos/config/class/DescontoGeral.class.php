<?php
class DescontoGeral extends Database {
	// class attributes
	var $idDescontoGeral;
	var $descricao;
	var $valor;
	var $dataCadastro;
	var $inativo;


	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDescontoGeral = "NULL";
		$this -> descricao = "NULL";
		$this -> valor = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> inativo = "0";


	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDescontoGeral($value) {
		$this -> idDescontoGeral = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDescricao($value) {
		$this -> descricao = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	

	/**
	 * addDescontoGeral() Function
	 */
	function addDescontoGeral() {
		$sql = "INSERT INTO descontoGeral (descricao, valor, dataCadastro, inativo) VALUES ($this->descricao, $this->valor, $this->dataCadastro, $this->inativo)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteDescontoGeral() Function
	 */
	function deleteDescontoGeral() {
		$sql = "DELETE FROM descontoGeral WHERE idDescontoGeral = $this->idDescontoGeral";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDescontoGeral() Function
	 */
	function updateFieldDescontoGeral($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE descontoGeral SET " . $field . " = " . $value . " WHERE idDescontoGeral = $this->idDescontoGeral";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDescontoGeral() Function
	 */
	function updateDescontoGeral() {
		$sql = "UPDATE descontoGeral SET descricao = $this->descricao, valor = $this->valor, inativo = $this->inativo WHERE idDescontoGeral = $this->idDescontoGeral";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDescontoGeral() Function
	 */
	function selectDescontoGeral($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDescontoGeral, descricao, valor, inativo FROM descontoGeral " . $where;
//		echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectDescontoGeralTr() Function
	 */
	function selectDescontoGeralTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idDescontoGeral, descricao, valor, inativo FROM descontoGeral " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idDescontoGeral = $valor['idDescontoGeral'];
				$nome = $valor['descricao'];
				$valorDesconto = $valor['valor'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idDescontoGeral . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idDescontoGeral'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				$html .= "<td>".Uteis::formatarMoeda($valorDesconto)."</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idDescontoGeral'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectDescontoGeralSelect() Function
	 */
/*	function selectDescontoGeralSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDescontoGeral, nome, inativo, excluido FROM DescontoGeral " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDescontoGeral\" name=\"idDescontoGeral\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDescontoGeral'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDescontoGeral'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}*/

}
?>