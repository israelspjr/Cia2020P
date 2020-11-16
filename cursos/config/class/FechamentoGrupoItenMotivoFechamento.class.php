<?php
class FechamentoGrupoItenMotivoFechamento extends Database {
	// class attributes
	var $idFechamentoGrupoItenMotivoFechamento;
	var $itenMotivoFechamentoIdItenMotivoFechamento;
	var $fechamentoGrupoIdFechamentoGrupo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idFechamentoGrupoItenMotivoFechamento = "NULL";
		$this -> itenMotivoFechamentoIdItenMotivoFechamento = "NULL";
		$this -> fechamentoGrupoIdFechamentoGrupo = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdFechamentoGrupoItenMotivoFechamento($value) {
		$this -> idFechamentoGrupoItenMotivoFechamento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setItenMotivoFechamentoIdItenMotivoFechamento($value) {
		$this -> itenMotivoFechamentoIdItenMotivoFechamento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFechamentoGrupoIdFechamentoGrupo($value) {
		$this -> fechamentoGrupoIdFechamentoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addFechamentoGrupoItenMotivoFechamento() Function
	 */
	function addFechamentoGrupoItenMotivoFechamento() {
		$sql = "INSERT INTO fechamentoGrupo_ItenMotivoFechamento (itenMotivoFechamento_idItenMotivoFechamento, fechamentoGrupo_idFechamentoGrupo) VALUES ($this->itenMotivoFechamentoIdItenMotivoFechamento, $this->fechamentoGrupoIdFechamentoGrupo)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteFechamentoGrupoItenMotivoFechamento() Function
	 */
	function deleteFechamentoGrupoItenMotivoFechamento($add = "") {
		$sql = "DELETE FROM fechamentoGrupo_ItenMotivoFechamento WHERE idFechamentoGrupo_ItenMotivoFechamento = $this->idFechamentoGrupoItenMotivoFechamento " . $add;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldFechamentoGrupoItenMotivoFechamento() Function
	 */
	function updateFieldFechamentoGrupoItenMotivoFechamento($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE fechamentoGrupo_ItenMotivoFechamento SET " . $field . " = " . $value . " WHERE idFechamentoGrupo_ItenMotivoFechamento = $this->idFechamentoGrupoItenMotivoFechamento";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFechamentoGrupoItenMotivoFechamento() Function
	 */
	function updateFechamentoGrupoItenMotivoFechamento() {
		$sql = "UPDATE fechamentoGrupo_ItenMotivoFechamento SET itenMotivoFechamento_idItenMotivoFechamento = $this->itenMotivoFechamentoIdItenMotivoFechamento, fechamentoGrupo_idFechamentoGrupo = $this->fechamentoGrupoIdFechamentoGrupo WHERE idFechamentoGrupo_ItenMotivoFechamento = $this->idFechamentoGrupoItenMotivoFechamento";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectFechamentoGrupoItenMotivoFechamento() Function
	 */
	function selectFechamentoGrupoItenMotivoFechamento($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idFechamentoGrupo_ItenMotivoFechamento, itenMotivoFechamento_idItenMotivoFechamento, fechamentoGrupo_idFechamentoGrupo FROM fechamentoGrupo_ItenMotivoFechamento " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectFechamentoGrupoItenMotivoFechamentoTr() Function
	 */
	function selectFechamentoGrupoItenMotivoFechamentoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idFechamentoGrupo_ItenMotivoFechamento, itenMotivoFechamento_idItenMotivoFechamento, fechamentoGrupo_idFechamentoGrupo FROM fechamentoGrupo_ItenMotivoFechamento " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idFechamentoGrupo_ItenMotivoFechamento = $valor['idFechamentoGrupo_ItenMotivoFechamento'];
				$itenMotivoFechamento_idItenMotivoFechamento = $valor['itenMotivoFechamento_idItenMotivoFechamento'];
				$fechamentoGrupo_idFechamentoGrupo = $valor['fechamentoGrupo_idFechamentoGrupo'];

				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idFechamentoGrupo_ItenMotivoFechamento'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $idFechamentoGrupo_ItenMotivoFechamento . "</td>";
				$html .= "<td>" . $itenMotivoFechamento_idItenMotivoFechamento . "</td>";
				$html .= "<td>" . $fechamentoGrupo_idFechamentoGrupo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idFechamentoGrupo_ItenMotivoFechamento'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectFechamentoGrupoItenMotivoFechamentoSelect() Function
	 */
	function selectFechamentoGrupoItenMotivoFechamentoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idFechamentoGrupo_ItenMotivoFechamento, itenMotivoFechamento_idItenMotivoFechamento, fechamentoGrupo_idFechamentoGrupo FROM fechamentoGrupo_ItenMotivoFechamento " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idFechamentoGrupo_ItenMotivoFechamento\" name=\"idFechamentoGrupo_ItenMotivoFechamento\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idFechamentoGrupo_ItenMotivoFechamento'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idFechamentoGrupo_ItenMotivoFechamento'] . "\">" . ($valor['idFechamentoGrupo_ItenMotivoFechamento']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>