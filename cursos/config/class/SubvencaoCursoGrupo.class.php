<?php
class SubvencaoCursoGrupo extends Database {
	// class attributes
	var $idSubvencaoCursoGrupo;
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
		$this -> idSubvencaoCursoGrupo = "NULL";
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
	function setIdSubvencaoCursoGrupo($value) {
		$this -> idSubvencaoCursoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addSubvencaoCursoGrupo() Function
	 */
	function addSubvencaoCursoGrupo() {
		$sql = "INSERT INTO subvencaoCursoGrupo (integranteGrupo_idIntegranteGrupo, subvencao, teto, quemPaga, dataInicio, dataFim, dataCadastro, obs) VALUES ($this->integranteGrupoIdIntegranteGrupo, $this->subvencao, $this->teto, $this->quemPaga, $this->dataInicio, $this->dataFim, $this->dataCadastro, $this->obs)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteSubvencaoCursoGrupo() Function
	 */
	function deleteSubvencaoCursoGrupo() {
		$sql = "DELETE FROM subvencaoCursoGrupo WHERE idSubvencaoCursoGrupo = $this->idSubvencaoCursoGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldSubvencaoCursoGrupo() Function
	 */
	function updateFieldSubvencaoCursoGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE subvencaoCursoGrupo SET " . $field . " = " . $value . " WHERE idSubvencaoCursoGrupo = $this->idSubvencaoCursoGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateSubvencaoCursoGrupo() Function
	 */
	function updateSubvencaoCursoGrupo() {
		$sql = "UPDATE subvencaoCursoGrupo SET integranteGrupo_idIntegranteGrupo = $this->integranteGrupoIdIntegranteGrupo, subvencao = $this->subvencao, teto = $this->teto, quemPaga = $this->quemPaga, dataInicio = $this->dataInicio, dataFim = $this->dataFim, obs = $this->obs WHERE idSubvencaoCursoGrupo = $this->idSubvencaoCursoGrupo";
		$result = $this -> query($sql, true);
        //echo $sql;
	}

	/**
	 * selectSubvencaoCursoGrupo() Function
	 */
	function selectSubvencaoCursoGrupo($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idSubvencaoCursoGrupo, integranteGrupo_idIntegranteGrupo, subvencao, teto, quemPaga, dataInicio, dataFim, dataCadastro, obs FROM subvencaoCursoGrupo " . $where;
		//echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectSubvencaoCursoGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPlanoAcaoGrupo="") {

		$sql = "SELECT SQL_CACHE idSubvencaoCursoGrupo, integranteGrupo_idIntegranteGrupo, subvencao, 
		teto, quemPaga, dataInicio, dataFim, dataCadastro, obs 
		FROM subvencaoCursoGrupo " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idSubvencaoCursoGrupo = $valor['idSubvencaoCursoGrupo'];
				$subvencao = Uteis::formatarMoeda($valor['subvencao']);
				$teto = $valor['teto'] ? "R$ " . Uteis::formatarMoeda($valor['teto']) : "";
				$quemPaga = $valor['quemPaga'] == "E" ? "pago pela empresa" : "pago pelo aluno";
				$dataInicio = $valor['dataInicio'] ? Uteis::exibirData($valor['dataInicio']) : "";
				$dataFim = $valor['dataFim'] ? Uteis::exibirData($valor['dataFim']) : "";

				$onclick = "  onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $idSubvencaoCursoGrupo . "&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>";

				$html .= "<td >" . strtotime($valor['dataInicio']) . "</td>";

				//$img = !$dataFim ? "<img src=\"".CAMINHO_IMG."ativo.png \" title=\"Atual\">" : "";
				$html .= "<td $onclick >" . $subvencao . "%</td>";

				$html .= "<td $onclick >" . $teto . "</td>";

				$html .= "<td $onclick >" . $quemPaga . "</td>";

				$html .= "<td $onclick >" . $dataInicio . "</td>";

				$html .= "<td $onclick >" . $dataFim . "</td>";

				$html .= "<td align=\"center\" > " . ($dataFim ? "" : "
					<img src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/deleta_subvencaoCursoGrupo.php?id=" . $idSubvencaoCursoGrupo . "', '$caminhoAtualizar', '');\" title=\"Excluir\" />") . "
				</td>";

				$html .= "</tr>";

			}
		}
		return $html;
	}

	/**
	 * selectSubvencaoCursoGrupoSelect() Function
	 */
	function selectSubvencaoCursoGrupoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idSubvencaoCursoGrupo, integranteGrupo_idIntegranteGrupo, subvencao, teto, quemPaga, dataInicio, dataFim, dataCadastro, obs 
		FROM subvencaoCursoGrupo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idSubvencaoCursoGrupo\" name=\"idSubvencaoCursoGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idSubvencaoCursoGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idSubvencaoCursoGrupo'] . "\">" . ($valor['idSubvencaoCursoGrupo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectSubvencaoCursoGrupo_periodo($idIntegranteGrupo, $dataReferencia, $where2 = "") {

		$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));

		$where = " WHERE integranteGrupo_idIntegranteGrupo = " . $idIntegranteGrupo;
		$where .= " AND dataInicio <= '" . $dataReferenciaFinal . "' ";
		$where .= " AND ((dataFim >= '" . $dataReferencia . "' AND dataFim <= '" . $dataReferenciaFinal . "') OR dataFim IS NULL OR dataFim = '') " . $where2;

		$rs = $this -> selectSubvencaoCursoGrupo($where);
		//echo $where;

		return $rs;

	}
	
	function selectSubvencaoCursoGrupoTrTotal($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {
		
		$NivelEstudo = new NivelEstudo();

		$sql = "SELECT SQL_CACHE
    SC.idSubvencaoCursoGrupo,
    SC.integranteGrupo_idIntegranteGrupo,
    SC.subvencao,
    SC.teto,
    SC.quemPaga,
    SC.dataInicio,
    SC.dataFim,
    SC.dataCadastro,
    SC.obs,
    IG.planoAcaoGrupo_idPlanoAcaoGrupo,
    IG.clientePf_idClientePf,
    CPF.nome,
	IG.dataEntrada,
	IG.planoAcaoGrupo_idPlanoAcaoGrupo,
	IG.dataSaida,
	PAG.nivelEstudo_IdNivelEstudo
FROM
    subvencaoCursoGrupo AS SC
		INNER JOIN
	integranteGrupo AS IG on IG.idIntegranteGrupo = SC.integranteGrupo_idIntegranteGrupo
		INNER JOIN
	clientePf AS CPF on CPF.idClientePf = IG.clientePf_idClientePf
	    INNER JOIN
	planoAcaoGrupo AS PAG on PAG.idPlanoAcaoGrupo = IG.planoAcaoGrupo_idPlanoAcaoGrupo
 " . $where;
//		echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idSubvencaoCursoGrupo = $valor['idSubvencaoCursoGrupo'];
				$nome = $valor['nome'];
				$dataEntrada = $valor['dataEntrada'] ? Uteis::exibirData($valor['dataEntrada']) : "";
				$subvencao = Uteis::formatarMoeda($valor['subvencao']);
				$teto = $valor['teto'] ? "R$ " . Uteis::formatarMoeda($valor['teto']) : "";
				$quemPaga = $valor['quemPaga'] == "E" ? "pago pela empresa" : "pago pelo aluno";
				$dataInicio = $valor['dataInicio'] ? Uteis::exibirData($valor['dataInicio']) : "";
				$dataFim = $valor['dataFim'] ? Uteis::exibirData($valor['dataFim']) : "";
				$dataSaida = $valor['dataSaida'] ? Uteis::exibirData($valor['dataSaida']) : "";
				

				$onclick = "  onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $idSubvencaoCursoGrupo . "&idPlanoAcaoGrupo=".$valor['planoAcaoGrupo_idPlanoAcaoGrupo']."', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>";

				$html .= "<td >" .$nome . "</td>";

				$html .= "<td $onclick >" . $subvencao . "%</td>";

				$html .= "<td $onclick >" . $teto . "</td>";

				$html .= "<td $onclick >" . $quemPaga . "</td>";

				$html .= "<td $onclick >" . $dataInicio . "</td>";
				
				$NivelNome = $NivelEstudo->getNome($valor['nivelEstudo_IdNivelEstudo']);

				$html .= "<td $onclick >" . $dataFim . "</td>";
				
				$html .= "<td $onclick >" . $NivelNome. "</td>";
				
				$html .= "<td $onclick >" . $dataEntrada . "</td>";
				
				$html .= "<td $onclick >" . $dataSaida . "</td>";

				$html .= "<td align=\"center\" > " . ($dataFim ? "" : "
					<img src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/deleta_subvencaoCursoGrupo.php?id=" . $idSubvencaoCursoGrupo . "', '$caminhoAtualizar', '');\" title=\"Excluir\" />") . "
				</td>";
				
				

				$html .= "</tr>";

			}
		}
		return $html;
	}

}
?>