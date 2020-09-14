<?php
class ContestacaoFF extends Database {
	// class attributes
	var $idContestacaoFF;
	var $folhaFrequenciaIdFolhaFrequencia;
	var $integranteGrupoIdIntegranteGrupo;
	var $status;
	var $obs;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idContestacaoFF = "NULL";
		$this -> folhaFrequenciaIdFolhaFrequencia = "NULL";
		$this -> integranteGrupoIdIntegranteGrupo = "NULL";
		$this -> status = "NULL";
		$this -> obs = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdContestacaoFF($value) {
		$this -> idContestacaoFF = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFolhaFrequenciaIdFolhaFrequencia($value) {
		$this -> folhaFrequenciaIdFolhaFrequencia = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIntegranteGrupoIdIntegranteGrupo($value) {
		$this -> integranteGrupoIdIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setStatus($value) {
		$this -> status = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addContestacaoFF() Function
	 */
	function addContestacaoFF() {
		$sql = "INSERT INTO contestacaoFF (folhaFrequencia_idFolhaFrequencia, integranteGrupo_idIntegranteGrupo, status, obs, dataCadastro) VALUES ($this->folhaFrequenciaIdFolhaFrequencia, $this->integranteGrupoIdIntegranteGrupo, $this->status, $this->obs, $this->dataCadastro)";
		$result = $this -> query($sql, true);
		//echo $sql
    //exit;
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteContestacaoFF() Function
	 */
	function deleteContestacaoFF() {
		$sql = "DELETE FROM contestacaoFF WHERE idContestacaoFF = $this->idContestacaoFF";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldContestacaoFF() Function
	 */
	function updateFieldContestacaoFF($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE contestacaoFF SET " . $field . " = " . $value . " WHERE idContestacaoFF = $this->idContestacaoFF";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateContestacaoFF() Function
	 */
	function updateContestacaoFF() {
		$sql = "UPDATE contestacaoFF SET folhaFrequencia_idFolhaFrequencia = $this->folhaFrequenciaIdFolhaFrequencia, integranteGrupo_idIntegranteGrupo = $this->integranteGrupoIdIntegranteGrupo, status = $this->status, obs = $this->obs,  WHERE idContestacaoFF = $this->idContestacaoFF";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectContestacaoFF() Function
	 */
	function selectContestacaoFF($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idContestacaoFF, folhaFrequencia_idFolhaFrequencia, integranteGrupo_idIntegranteGrupo, status, obs, dataCadastro FROM contestacaoFF " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectContestacaoFFTr() Function
	 */
	function selectContestacaoFFTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idContestacaoFF, folhaFrequencia_idFolhaFrequencia, integranteGrupo_idIntegranteGrupo, status, obs, dataCadastro FROM contestacaoFF " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idContestacaoFF'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idContestacaoFF'] . "</td>";
				$html .= "<td>" . $valor['folhaFrequencia_idFolhaFrequencia'] . "</td>";
				$html .= "<td>" . $valor['integranteGrupo_idIntegranteGrupo'] . "</td>";
				$html .= "<td>" . $valor['status'] . "</td>";
				$html .= "<td>" . $valor['obs'] . "</td>";
				$html .= "<td>" . $valor['dataCadastro'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/ContestacaoFF.php', " . $valor['idContestacaoFF'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectContestacaoFFSelect() Function
	 */
	function selectContestacaoFFSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idContestacaoFF, folhaFrequencia_idFolhaFrequencia, integranteGrupo_idIntegranteGrupo, status, obs, dataCadastro FROM contestacaoFF " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idContestacaoFF\" name=\"idContestacaoFF\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idContestacaoFF'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idContestacaoFF'] . "\">" . ($valor['idContestacaoFF']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function getContestacoes($idFolhaFrequencia) {

		$IntegranteGrupo = new IntegranteGrupo();

		$html = "";
		$rs = $this -> selectContestacaoFF(" WHERE folhaFrequencia_idFolhaFrequencia = $idFolhaFrequencia");
		if ($rs) {
			foreach ($rs as $valor) {

				$idIntegranteGrupo = $valor["integranteGrupo_idIntegranteGrupo"];
				$concoda = $valor["status"] == 1 ? "confirmou" : "contestou";
				$obs = $valor["obs"] ? "<br>Comentário: " . $valor["obs"] : "";
				$dataCadastroCFF = Uteis::exibirDataHora($valor["dataCadastro"]);

				$nome = $IntegranteGrupo -> getNomePF($idIntegranteGrupo);

				$html .= "<p>
				O aluno $nome <strong>$concoda</strong> os dados lançados na folha de frequência em $dataCadastroCFF.$obs
				</p>";
			}
		}
		return $html;
	}

}
?>