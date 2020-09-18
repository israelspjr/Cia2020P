<?php
class TipoAtividadeExtra extends Database {
	// class attributes
	var $idTipoAtividadeExtra;
	var $nome;
	var $inativo;
	var $dataCadastro;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoAtividadeExtra = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoAtividadeExtra($value) {
		$this -> idTipoAtividadeExtra = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addTipoAtividadeExtra() Function
	 */
	function addTipoAtividadeExtra() {
		$sql = "INSERT INTO tipoAtividadeExtra (nome, inativo, dataCadastro, excluido) VALUES ($this->nome, $this->inativo, '" . date('Y-m-y H:i:s') . "', $this->excluido)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteTipoAtividadeExtra() Function
	 */
	function deleteTipoAtividadeExtra() {
		$sql = "DELETE FROM tipoAtividadeExtra WHERE idTipoAtividadeExtra = $this->idTipoAtividadeExtra";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipoAtividadeExtra() Function
	 */
	function updateFieldTipoAtividadeExtra($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipoAtividadeExtra SET " . $field . " = " . $value . " WHERE idTipoAtividadeExtra = $this->idTipoAtividadeExtra";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipoAtividadeExtra() Function
	 */
	function updateTipoAtividadeExtra() {
		$sql = "UPDATE tipoAtividadeExtra SET nome = $this->nome, inativo = $this->inativo WHERE idTipoAtividadeExtra = $this->idTipoAtividadeExtra";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipoAtividadeExtra() Function
	 */
	function selectTipoAtividadeExtra($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoAtividadeExtra, nome, inativo, dataCadastro, excluido FROM tipoAtividadeExtra " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectTipoAtividadeExtraTr() Function
	 */
	function selectTipoAtividadeExtraTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idTipoAtividadeExtra, nome, inativo, dataCadastro, excluido FROM tipoAtividadeExtra " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idTipoAtividadeExtra = $valor['idTipoAtividadeExtra'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//
				$dataCadastro = $valor['dataCadastro'];

				$html .= "<td>" . $idTipoAtividadeExtra . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idTipoAtividadeExtra'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				//$html .= "<td>".$dataCadastro."</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idTipoAtividadeExtra'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectTipoAtividadeExtraSelect() Function
	 */
	function selectTipoAtividadeExtraSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idTipoAtividadeExtra, nome, inativo, dataCadastro, excluido FROM tipoAtividadeExtra " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idTipoAtividadeExtra\" name=\"idTipoAtividadeExtra\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoAtividadeExtra'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoAtividadeExtra'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectTipoatividadeextraDiv($idClientePf) {
		$sql = "SELECT SQL_CACHE idTipoAtividadeExtra, nome FROM tipoAtividadeExtra WHERE inativo = 0";
		 //echo $sql;
        //exit;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			$AtividadeExtra = new AtividadeExtra();
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<div class=\"linha-inteira\" style=\"margin-top:2em\" id=\"div_tipoAtividadeExtra_" . $valor['idTipoAtividadeExtra'] . "\"><strong>" . $valor['nome'] . "</strong></div>";
				$AtividadeExtra -> setTipoAtividadeExtraIdTipoAtividadeExtra($valor['idTipoAtividadeExtra']);
				$html .= "<div class=\"linha-inteira\" >" . $AtividadeExtra -> selectAtividadeextraCheckbox($idClientePf) . "</div></br>";
			}
		}
		return $html;
	}

}
?>