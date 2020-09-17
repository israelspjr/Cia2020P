<?php
class PlanoAcaoGrupoStatusCobranca extends Database {
	// class attributes
	var $idPlanoAcaoGrupoStatusCobranca;
	var $statusCobrancaIdStatusCobranca;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $mes;
	var $ano;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPlanoAcaoGrupoStatusCobranca = "NULL";
		$this -> statusCobrancaIdStatusCobranca = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> mes = "NULL";
		$this -> ano = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPlanoAcaoGrupoStatusCobranca($value) {
		$this -> idPlanoAcaoGrupoStatusCobranca = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setStatusCobrancaIdStatusCobranca($value) {
		$this -> statusCobrancaIdStatusCobranca = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMes($value) {
		$this -> mes = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAno($value) {
		$this -> ano = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addPlanoAcaoGrupoStatusCobranca() Function
	 */
	function addPlanoAcaoGrupoStatusCobranca() {
		$sql = "INSERT INTO planoAcaoGrupoStatusCobranca (statusCobranca_idStatusCobranca, planoAcaoGrupo_idPlanoAcaoGrupo, mes, ano, dataCadastro) VALUES ($this->statusCobrancaIdStatusCobranca, $this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->mes, $this->ano, $this->dataCadastro)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deletePlanoAcaoGrupoStatusCobranca() Function
	 */
	function deletePlanoAcaoGrupoStatusCobranca($or = "") {
		$sql = "DELETE FROM planoAcaoGrupoStatusCobranca WHERE idPlanoAcaoGrupoStatusCobranca = $this->idPlanoAcaoGrupoStatusCobranca " . $or;
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPlanoAcaoGrupoStatusCobranca() Function
	 */
	function updateFieldPlanoAcaoGrupoStatusCobranca($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE planoAcaoGrupoStatusCobranca SET " . $field . " = " . $value . " WHERE idPlanoAcaoGrupoStatusCobranca = $this->idPlanoAcaoGrupoStatusCobranca";
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePlanoAcaoGrupoStatusCobranca() Function
	 */
	function updatePlanoAcaoGrupoStatusCobranca() {
		$sql = "UPDATE planoAcaoGrupoStatusCobranca SET statusCobranca_idStatusCobranca = $this->statusCobrancaIdStatusCobranca, planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, mes = $this->mes, ano = $this->ano,  WHERE idPlanoAcaoGrupoStatusCobranca = $this->idPlanoAcaoGrupoStatusCobranca";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPlanoAcaoGrupoStatusCobranca() Function
	 */
	function selectPlanoAcaoGrupoStatusCobranca($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPlanoAcaoGrupoStatusCobranca, statusCobranca_idStatusCobranca, planoAcaoGrupo_idPlanoAcaoGrupo, mes, ano, dataCadastro FROM planoAcaoGrupoStatusCobranca " . $where;
//		echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectPlanoAcaoGrupoStatusCobrancaTr() Function
	 */
	function selectPlanoAcaoGrupoStatusCobrancaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idPlanoAcaoGrupoStatusCobranca, statusCobranca_idStatusCobranca, planoAcaoGrupo_idPlanoAcaoGrupo, mes, ano, dataCadastro FROM planoAcaoGrupoStatusCobranca " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idPlanoAcaoGrupoStatusCobranca'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idPlanoAcaoGrupoStatusCobranca'] . "</td>";
				$html .= "<td>" . $valor['statusCobranca_idStatusCobranca'] . "</td>";
				$html .= "<td>" . $valor['planoAcaoGrupo_idPlanoAcaoGrupo'] . "</td>";
				$html .= "<td>" . $valor['mes'] . "</td>";
				$html .= "<td>" . $valor['ano'] . "</td>";
				$html .= "<td>" . $valor['dataCadastro'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/PlanoAcaoGrupoStatusCobranca.php', " . $valor['idPlanoAcaoGrupoStatusCobranca'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectPlanoAcaoGrupoStatusCobrancaSelect() Function
	 */
	function selectPlanoAcaoGrupoStatusCobrancaSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idPlanoAcaoGrupoStatusCobranca, statusCobranca_idStatusCobranca, planoAcaoGrupo_idPlanoAcaoGrupo, mes, ano, dataCadastro FROM planoAcaoGrupoStatusCobranca " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idPlanoAcaoGrupoStatusCobranca\" name=\"idPlanoAcaoGrupoStatusCobranca\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idPlanoAcaoGrupoStatusCobranca'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idPlanoAcaoGrupoStatusCobranca'] . "\">" . ($valor['idPlanoAcaoGrupoStatusCobranca']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>