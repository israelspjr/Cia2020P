<?php
class SubvencaoMaterialGrupo extends Database {
	// class attributes
	var $idSubvencaoMaterialGrupo;
	var $integranteGrupoIdIntegranteGrupo;
	var $subvencao;
	var $teto;
	var $quemPaga;
	var $dataInicio;
	var $dataFim;
	var $dataCadastro;
	var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idSubvencaoMaterialGrupo = "NULL";
		$this -> integranteGrupoIdIntegranteGrupo = "NULL";
		$this -> subvencao = "NULL";
		$this -> teto = "NULL";
		$this -> quemPaga = "NULL";
		$this -> dataInicio = "NULL";
		$this -> dataFim = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> obs = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdSubvencaoMaterialGrupo($value) {
		$this -> idSubvencaoMaterialGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIntegranteGrupoIdIntegranteGrupo($value) {
		$this -> integranteGrupoIdIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setSubvencao($value) {
		$this -> subvencao = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
	}

	function setTeto($value) {
		$this -> teto = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
	}

	function setQuemPaga($value) {
		$this -> quemPaga = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataInicio($value) {
		$this -> dataInicio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataFim($value) {
		$this -> dataFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addSubvencaoMaterialGrupo() Function
	 */
	function addSubvencaoMaterialGrupo() {
		$sql = "INSERT INTO subvencaoMaterialGrupo (integranteGrupo_idIntegranteGrupo, subvencao, teto, quemPaga, dataInicio, dataFim, dataCadastro, obs) VALUES ($this->integranteGrupoIdIntegranteGrupo, $this->subvencao, $this->teto, $this->quemPaga, $this->dataInicio, $this->dataFim, $this->dataCadastro, $this->obs)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteSubvencaoMaterialGrupo() Function
	 */
	function deleteSubvencaoMaterialGrupo() {
		$sql = "DELETE FROM subvencaoMaterialGrupo WHERE idSubvencaoMaterialGrupo = $this->idSubvencaoMaterialGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldSubvencaoMaterialGrupo() Function
	 */
	function updateFieldSubvencaoMaterialGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE subvencaoMaterialGrupo SET " . $field . " = " . $value . " WHERE idSubvencaoMaterialGrupo = $this->idSubvencaoMaterialGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateSubvencaoMaterialGrupo() Function
	 */
	function updateSubvencaoMaterialGrupo() {
		$sql = "UPDATE subvencaoMaterialGrupo SET integranteGrupo_idIntegranteGrupo = $this->integranteGrupoIdIntegranteGrupo, subvencao = $this->subvencao, teto = $this->teto, quemPaga = $this->quemPaga, dataInicio = $this->dataInicio, dataFim = $this->dataFim, obs = $this->obs WHERE idSubvencaoMaterialGrupo = $this->idSubvencaoMaterialGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectSubvencaoMaterialGrupo() Function
	 */
	function selectSubvencaoMaterialGrupo($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idSubvencaoMaterialGrupo, integranteGrupo_idIntegranteGrupo, subvencao, teto, quemPaga, dataInicio, dataFim, dataCadastro, obs FROM subvencaoMaterialGrupo " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectSubvencaoMaterialGrupoTr() Function
	 */
	function selectSubvencaoMaterialGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE idSubvencaoMaterialGrupo, integranteGrupo_idIntegranteGrupo, subvencao, teto, quemPaga, dataInicio, dataFim, dataCadastro, obs FROM subvencaoMaterialGrupo " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idSubvencaoMaterialGrupo = $valor['idSubvencaoMaterialGrupo'];
				$subvencao = Uteis::formatarMoeda($valor['subvencao']);
				$teto = $valor['teto'] ? "R$ " . Uteis::formatarMoeda($valor['teto']) : "";
				$quemPaga = $valor['quemPaga'] == "E" ? "pago pela empresa" : "pago pelo aluno";
				$dataInicio = $valor['dataInicio'] ? Uteis::exibirData($valor['dataInicio']) : "";
				$dataFim = $valor['dataFim'] ? Uteis::exibirData($valor['dataFim']) : "";

				$onclick = "  onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $idSubvencaoMaterialGrupo . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>";

				$html .= "<td >" . strtotime($valor['dataInicio']) . "</td>";

				//$img = !$dataFim ? "<img src=\"".CAMINHO_IMG."ativo.png \" title=\"Atual\">" : "";
				$html .= "<td $onclick >" . $subvencao . "%</td>";

				$html .= "<td $onclick >" . $teto . "</td>";

				$html .= "<td $onclick >" . $quemPaga . "</td>";

				$html .= "<td $onclick >" . $dataInicio . "</td>";

				$html .= "<td $onclick >" . $dataFim . "</td>";

				$html .= "<td align=\"center\" > " . ($dataFim ? "" : "
					<img src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/deleta_subvencaoMaterialGrupo.php?id=" . $idSubvencaoMaterialGrupo . "', '$caminhoAtualizar', '');\" title=\"Excluir\" />") . "
				</td>";

				$html .= "</tr>";

			}
		}

		return $html;
	}

	/**
	 * selectSubvencaoMaterialGrupoSelect() Function
	 */
	function selectSubvencaoMaterialGrupoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idSubvencaoMaterialGrupo, integranteGrupo_idIntegranteGrupo, subvencao, teto, quemPaga, dataInicio, dataFim, dataCadastro, obs FROM subvencaoMaterialGrupo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idSubvencaoMaterialGrupo\" name=\"idSubvencaoMaterialGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idSubvencaoMaterialGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idSubvencaoMaterialGrupo'] . "\">" . ($valor['idSubvencaoMaterialGrupo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectSubvencaoMaterialGrupo_periodo($idIntegranteGrupo, $dataReferencia, $where2 = "") {

		$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));

		$where = " WHERE integranteGrupo_idIntegranteGrupo = " . $idIntegranteGrupo;
		$where .= " AND dataInicio <= '" . $dataReferenciaFinal . "' ";
		$where .= " AND ((dataFim >= '" . $dataReferencia . "' AND dataFim <= '" . $dataReferenciaFinal . "') OR dataFim IS NULL OR dataFim = '') " . $where2;

		$rs = $this -> selectSubvencaoMaterialGrupo($where);
		//echo $where;

		return $rs;

	}

}
?>