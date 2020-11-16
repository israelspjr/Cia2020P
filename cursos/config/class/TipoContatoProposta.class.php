<?php
class TipoContatoProposta extends Database {
	// class attributes
	var $idTipoContatoProposta;
  var $migracao_id;
	var $tipo;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoContatoProposta = "NULL";
    $this -> migracao_id = "NULL";
		$this -> tipo = "NULL";
		$this -> inativo = "0";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoContatoProposta($value) {
		$this -> idTipoContatoProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}
  
  function setMigracao_id($value){
    $this -> migracao_id = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addTipoContatoProposta() Function
	 */
	function addTipoContatoProposta() {
		$sql = "INSERT INTO tipoContatoProposta (migracao_id, tipo, inativo, excluido) VALUES ($this->migracao_id, $this->tipo, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTipoContatoProposta() Function
	 */
	function deleteTipoContatoProposta() {
		$sql = "DELETE FROM tipoContatoProposta WHERE idTipoContatoProposta = $this->idTipoContatoProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipoContatoProposta() Function
	 */
	function updateFieldTipoContatoProposta($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipoContatoProposta SET " . $field . " = " . $value . " WHERE idTipoContatoProposta = $this->idTipoContatoProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipoContatoProposta() Function
	 */
	function updateTipoContatoProposta() {
		$sql = "UPDATE tipoContatoProposta SET migracao_id = $this->migracao_id, tipo = $this->tipo, inativo = $this->inativo WHERE idTipoContatoProposta = $this->idTipoContatoProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipoContatoProposta() Function
	 */
	function selectTipoContatoProposta($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoContatoProposta, migracao_id, tipo, inativo, excluido FROM tipoContatoProposta " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectTipoContatoPropostaTr() Function
	 */
	function selectTipoContatoPropostaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idTipoContatoProposta, migracao_id, tipo, inativo, excluido FROM tipoContatoProposta " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idTipoContatoProposta = $valor['idTipoContatoProposta'];
				$tipo = $valor['tipo'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idTipoContatoProposta . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idTipoContatoProposta'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $tipo . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idTipoContatoProposta'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectTipoContatoPropostaSelect() Function
	 */
	function selectTipoContatoPropostaSelect($classes = "", $idAtual = 0, $and = "") {
		$sql = "SELECT SQL_CACHE idTipoContatoProposta, tipo FROM tipoContatoProposta WHERE inativo  = 0 AND excluido = 0 " . $and . " ORDER BY tipo ";
		$result = $this -> query($sql);
		$html = "<select id=\"idTipoContatoProposta\" name=\"idTipoContatoProposta\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoContatoProposta'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoContatoProposta'] . "\">" . $valor['tipo'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>