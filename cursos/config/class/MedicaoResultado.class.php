<?php
class MedicaoResultado extends Database {
	// class attributes
	var $idMedicaoResultado;
	var $medicao;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idMedicaoResultado = "NULL";
		$this -> medicao = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdMedicaoResultado($value) {
		$this -> idMedicaoResultado = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMedicao($value) {
		$this -> medicao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addMedicaoResultado() Function
	 */
	function addMedicaoResultado() {
		$sql = "INSERT INTO medicaoResultado (medicao, inativo, excluido) VALUES ($this->medicao, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteMedicaoResultado() Function
	 */
	function deleteMedicaoResultado() {
		$sql = "DELETE FROM medicaoResultado WHERE idMedicaoResultado = $this->idMedicaoResultado";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldMedicaoResultado() Function
	 */
	function updateFieldMedicaoResultado($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE medicaoResultado SET " . $field . " = " . $value . " WHERE idMedicaoResultado = $this->idMedicaoResultado";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateMedicaoResultado() Function
	 */
	function updateMedicaoResultado() {
		$sql = "UPDATE medicaoResultado SET medicao = $this->medicao, inativo = $this->inativo WHERE idMedicaoResultado = $this->idMedicaoResultado";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectMedicaoResultado() Function
	 */
	function selectMedicaoResultado($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idMedicaoResultado, medicao, inativo, excluido FROM medicaoResultado " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectMedicaoResultadoTr() Function
	 */
	function selectMedicaoResultadoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idMedicaoResultado, medicao, inativo, excluido FROM medicaoResultado " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idMedicaoResultado = $valor['idMedicaoResultado'];
				$medicao = $valor['medicao'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idMedicaoResultado . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idMedicaoResultado'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $medicao . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idMedicaoResultado'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectMedicaoResultadoSelect() Function
	 */
	function selectMedicaoResultadoSelect($classes = "", $idAtual = 0, $addQuery = "", $where = "") {
		$sql = "SELECT SQL_CACHE DISTINCT(M.idMedicaoResultado), M.medicao FROM medicaoResultado AS M " . $addQuery;
		$sql .= " WHERE M.inativo = 0 " . $where . " ORDER BY M.medicao";
		//echo $sql;
		$result = $this -> query($sql);

		$html = "<select id=\"idMedicaoResultado\" name=\"idMedicaoResultado\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idMedicaoResultado'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idMedicaoResultado'] . "\">" . $valor['medicao'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>