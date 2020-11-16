<?php
class DemonstrativoCobrancaIntegranteGrupo extends Database {
	// class attributes
	var $idDemonstrativoCobrancaIntegranteGrupo;
	var $demonstrativoCobrancaIdDemonstrativoCobranca;
	var $integranteGrupoIdIntegranteGrupo;
	var $cursoEmpresa;
	var $materialEmpresa;
	var $creditoEmpresa;
	var $debitoEmpresa;
	var $cursoAluno;
	var $materialAluno;
	var $creditoAluno;
	var $debitoAluno;
	var $dataCadastro;
	var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDemonstrativoCobrancaIntegranteGrupo = "NULL";
		$this -> demonstrativoCobrancaIdDemonstrativoCobranca = "NULL";
		$this -> integranteGrupoIdIntegranteGrupo = "NULL";
		$this -> cursoEmpresa = "0";
		$this -> materialEmpresa = "0";
		$this -> creditoEmpresa = "0";
		$this -> debitoEmpresa = "0";
		$this -> cursoAluno = "0";
		$this -> materialAluno = "0";
		$this -> creditoAluno = "0";
		$this -> debitoAluno = "0";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> obs = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDemonstrativoCobrancaIntegranteGrupo($value) {
		$this -> idDemonstrativoCobrancaIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDemonstrativoCobrancaIdDemonstrativoCobranca($value) {
		$this -> demonstrativoCobrancaIdDemonstrativoCobranca = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIntegranteGrupoIdIntegranteGrupo($value) {
		$this -> integranteGrupoIdIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCursoEmpresa($value) {
		$this -> cursoEmpresa = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "0";
	}

	function setMaterialEmpresa($value) {

		$this -> materialEmpresa = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "0";
	}

	function setCreditoEmpresa($value) {

		$this -> creditoEmpresa = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "0";
	}

	function setDebitoEmpresa($value) {

		$this -> debitoEmpresa = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "0";
	}

	function setCursoAluno($value) {

		$this -> cursoAluno = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "0";
	}

	function setMaterialAluno($value) {

		$this -> materialAluno = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "0";
	}

	function setCreditoAluno($value) {
		$this -> creditoAluno = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "0";
	}

	function setDebitoAluno($value) {
		$this -> debitoAluno = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}
	
	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
	}

	/**
	 * addDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function addDemonstrativoCobrancaIntegranteGrupo() {
		$sql = "INSERT INTO demonstrativoCobrancaIntegranteGrupo (demonstrativoCobranca_idDemonstrativoCobranca, integranteGrupo_idIntegranteGrupo, cursoEmpresa, materialEmpresa, creditoEmpresa, debitoEmpresa, cursoAluno, materialAluno, creditoAluno, debitoAluno, dataCadastro, obs) VALUES ($this->demonstrativoCobrancaIdDemonstrativoCobranca, $this->integranteGrupoIdIntegranteGrupo, $this->cursoEmpresa, $this->materialEmpresa, $this->creditoEmpresa, $this->debitoEmpresa, $this->cursoAluno, $this->materialAluno, $this->creditoAluno, $this->debitoAluno, $this->dataCadastro, $this->obs)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function deleteDemonstrativoCobrancaIntegranteGrupo($or = "") {

		$SubCursoDemonstrativoCobrancaIntegranteGrupo = new SubCursoDemonstrativoCobrancaIntegranteGrupo();
		$SubMaterialDemonstrativoCobrancaIntegranteGrupo = new SubMaterialDemonstrativoCobrancaIntegranteGrupo();

		$where = " OR ( demonstrativoCobrancaIntegranteGrupo_id IN (" . $this -> idDemonstrativoCobrancaIntegranteGrupo . "))";

		$SubCursoDemonstrativoCobrancaIntegranteGrupo -> deleteSubCursoDemonstrativoCobrancaIntegranteGrupo($where);
		$SubMaterialDemonstrativoCobrancaIntegranteGrupo -> deleteSubMaterialDemonstrativoCobrancaIntegranteGrupo($where);

		$sql = "DELETE FROM demonstrativoCobrancaIntegranteGrupo WHERE idDemonstrativoCobrancaIntegranteGrupo IN ($this->idDemonstrativoCobrancaIntegranteGrupo) " . $or;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function updateFieldDemonstrativoCobrancaIntegranteGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE demonstrativoCobrancaIntegranteGrupo SET " . $field . " = " . $value . " WHERE idDemonstrativoCobrancaIntegranteGrupo = $this->idDemonstrativoCobrancaIntegranteGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function updateDemonstrativoCobrancaIntegranteGrupo() {
		$sql = "UPDATE demonstrativoCobrancaIntegranteGrupo SET demonstrativoCobranca_idDemonstrativoCobranca = $this->demonstrativoCobrancaIdDemonstrativoCobranca, integranteGrupo_idIntegranteGrupo = $this->integranteGrupoIdIntegranteGrupo, cursoEmpresa = $this->cursoEmpresa, materialEmpresa = $this->materialEmpresa, creditoEmpresa = $this->creditoEmpresa, debitoEmpresa = $this->debitoEmpresa, cursoAluno = $this->cursoAluno, materialAluno = $this->materialAluno, creditoAluno = $this->creditoAluno, debitoAluno = $this->debitoAluno, obs = $this->obs  WHERE idDemonstrativoCobrancaIntegranteGrupo = $this->idDemonstrativoCobrancaIntegranteGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function selectDemonstrativoCobrancaIntegranteGrupo($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDemonstrativoCobrancaIntegranteGrupo, demonstrativoCobranca_idDemonstrativoCobranca, integranteGrupo_idIntegranteGrupo, cursoEmpresa, materialEmpresa, creditoEmpresa, debitoEmpresa, cursoAluno, materialAluno, creditoAluno, debitoAluno, dataCadastro, obs FROM demonstrativoCobrancaIntegranteGrupo " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
	}
	
	function selectDemonstrativoCobrancaIntegranteGrupoInd($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE
    idDemonstrativoCobrancaIntegranteGrupo,
    demonstrativoCobranca_idDemonstrativoCobranca,
    integranteGrupo_idIntegranteGrupo,
    cursoEmpresa,
    materialEmpresa,
    creditoEmpresa,
    debitoEmpresa,
    cursoAluno,
    materialAluno,
    creditoAluno,
    debitoAluno,
    DCIG.dataCadastro,
    DCIG.obs,
    IG.clientePf_idClientePf
    
FROM
    demonstrativoCobrancaIntegranteGrupo AS DCIG
    INNER JOIN
    integranteGrupo as IG on DCIG.integranteGrupo_idIntegranteGrupo = IG.idIntegranteGrupo" . $where;
//		echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectDemonstrativoCobrancaIntegranteGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "",$mobile) {

		$sql = "SELECT SQL_CACHE D.idDemonstrativoCobranca, D.mes, D.ano, 	
		COALESCE(DI.cursoAluno,0) AS cursoAluno, COALESCE(DI.materialAluno,0) AS materialAluno,
		COALESCE(DI.creditoAluno,0) AS creditoAluno, COALESCE(DI.debitoAluno,0) AS debitoAluno
		FROM demonstrativoCobrancaIntegranteGrupo AS DI
		INNER JOIN demonstrativoCobranca AS D ON D.idDemonstrativoCobranca = DI.demonstrativoCobranca_idDemonstrativoCobranca 
		INNER JOIN integranteGrupo AS I ON I.idIntegranteGrupo = DI.integranteGrupo_idIntegranteGrupo
		" . $where;
		
//		echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$periodo = $valor['mes'] . "/" . $valor['ano'];

				$totalAluno = Uteis::formatarMoeda($valor['cursoAluno'] + $valor['materialAluno'] + $valor['creditoAluno'] - $valor['debitoAluno']);
				
				if ($mobile != 1) {

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "&mes=".$valor['mes']."&ano=".$valor['ano']."', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "&mes=".$valor['mes']."&ano=".$valor['ano']."',  '#centro');\" ";	
					
				}

				$html .= "<tr>
				
				<td >" . $valor['ano'] . $valor['mes'] . "</td>
				
				<td $onclick >" . $periodo . "</td>
				
				<td $onclick >" . $totalAluno . "</td>						
								
				</tr>";
			}
		}
		return $html;
	}

	function selectDemonstrativoCobrancaIntegranteGrupoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoCobrancaIntegranteGrupo, demonstrativoCobranca_idDemonstrativoCobranca, integranteGrupo_idIntegranteGrupo, cursoEmpresa, materialEmpresa, creditoEmpresa, debitoEmpresa, cursoAluno, materialAluno, creditoAluno, debitoAluno, dataCadastro FROM demonstrativoCobrancaIntegranteGrupo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDemonstrativoCobrancaIntegranteGrupo\" name=\"idDemonstrativoCobrancaIntegranteGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDemonstrativoCobrancaIntegranteGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDemonstrativoCobrancaIntegranteGrupo'] . "\">" . ($valor['idDemonstrativoCobrancaIntegranteGrupo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>