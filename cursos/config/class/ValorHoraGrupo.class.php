<?php
class ValorHoraGrupo extends Database {
	// class attributes
	var $idValorHoraGrupo;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $modalidadeIdModalidade;
	var $valorHora;
	var $cargaHorariaFixaMensal;
	var $valorDescontoHora;
	var $validadeDesconto;
	var $previsaoReajuste;
	var $dataInicio;
	var $dataFim;
	var $dataCadastro;
	var $naoPagarProfessor;
	var $valorHoraProfessor;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idValorHoraGrupo = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> modalidadeIdModalidade = "NULL";
		$this -> valorHora = "NULL";
		$this -> cargaHorariaFixaMensal = "NULL";
		$this -> valorDescontoHora = "NULL";
		$this -> validadeDesconto = "NULL";
		$this -> previsaoReajuste = "NULL";
		$this -> dataInicio = "NULL";
		$this -> dataFim = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> naoPagarProfessor = "0";
		$this -> valorHoraProfessor = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdValorHoraGrupo($value) {
		$this -> idValorHoraGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setModalidadeIdModalidade($value) {
		$this -> modalidadeIdModalidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValorHora($value) {
		$this -> valorHora = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCargaHorariaFixaMensal($value) {
		$this -> cargaHorariaFixaMensal = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValorDescontoHora($value) {
		$this -> valorDescontoHora = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValidadeDesconto($value) {
		$this -> validadeDesconto = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPrevisaoReajuste($value) {
		$this -> previsaoReajuste = ($value) ? $this -> gravarBD($value) : "NULL";
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
	
	function setNaoPagarProfessor($value) {
		$this -> naoPagarProfessor = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setValorHoraProfessor($value) {
		$this -> valorHoraProfessor = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addValorHoraGrupo() Function
	 */
	function addValorHoraGrupo() {
		$sql = "INSERT INTO valorHoraGrupo (planoAcaoGrupo_idPlanoAcaoGrupo, modalidade_idModalidade, valorHora, cargaHorariaFixaMensal, valorDescontoHora, validadeDesconto, previsaoReajuste, dataInicio, dataFim, dataCadastro, naoPagarProfessor, valorHoraProfessor) VALUES ($this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->modalidadeIdModalidade, $this->valorHora, $this->cargaHorariaFixaMensal, $this->valorDescontoHora, $this->validadeDesconto, $this->previsaoReajuste, $this->dataInicio, $this->dataFim, $this->dataCadastro, $this->naoPagarProfessor, $this->valorHoraProfessor)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteValorHoraGrupo() Function
	 */
	function deleteValorHoraGrupo() {
		$sql = "DELETE FROM valorHoraGrupo WHERE idValorHoraGrupo = $this->idValorHoraGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldValorHoraGrupo() Function
	 */
	function updateFieldValorHoraGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE valorHoraGrupo SET " . $field . " = " . $value . " WHERE idValorHoraGrupo = $this->idValorHoraGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateValorHoraGrupo() Function
	 */
	function updateValorHoraGrupo() {
		$sql = "UPDATE valorHoraGrupo SET planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, modalidade_idModalidade = $this->modalidadeIdModalidade, valorHora = $this->valorHora, cargaHorariaFixaMensal = $this->cargaHorariaFixaMensal, valorDescontoHora = $this->valorDescontoHora, validadeDesconto = $this->validadeDesconto, previsaoReajuste = $this->previsaoReajuste, dataInicio = $this->dataInicio, dataFim = $this->dataFim, naoPagarProfessor = $this->naoPagarProfessor, valorHoraProfessor = $this->valorHoraProfessor WHERE idValorHoraGrupo = $this->idValorHoraGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectValorHoraGrupo() Function
	 */
	function selectValorHoraGrupo($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idValorHoraGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, modalidade_idModalidade, valorHora, cargaHorariaFixaMensal, valorDescontoHora, validadeDesconto, previsaoReajuste, dataInicio, dataFim, dataCadastro, naoPagarProfessor, valorHoraProfessor FROM valorHoraGrupo " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
        
	}

	/**
	 * selectValorHoraGrupoTr() Function
	 */
	function selectValorHoraGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $pa = "") {

		$sql = "SELECT SQL_CACHE idValorHoraGrupo, valorHora, cargaHorariaFixaMensal, valorDescontoHora, validadeDesconto, dataInicio, dataFim, naoPagarProfessor, previsaoReajuste, valorHoraProfessor  
		FROM valorHoraGrupo AS VG 
		INNER JOIN modalidade AS MO ON MO.idModalidade = VG.modalidade_idModalidade " . $where;
	//	echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				//<td onclick=\"deletaRegistro('".$caminhoModulo."/include/acao/ValorHoraGrupo.php', ".$valor['idValorHoraGrupo'].", '$caminhoAtualizar', '$ondeAtualiza')\">"."<center><img src=\"".CAMINHO_IMG."excluir.png\"></center>"."</td>";
				
				$naoPagarProfessor = Uteis::exibirStatus($valor['naoPagarProfessor']);
				$idValorHoraGrupo = $valor['idValorHoraGrupo'];
				$idPlanoAcaoGrupo = $valor['planoAcaoGrupo_idPlanoAcaoGrupo'];
				$valorHoraProfessor = Uteis::formatarMoeda($valor['valorHoraProfessor']);
				$valorHora = $valor['valorHora'];
				$cargaHorariaFixaMensal = $valor['cargaHorariaFixaMensal'] ? Uteis::exibirHoras($valor['cargaHorariaFixaMensal']) : "";

				$valorDescontoHora = $valor['valorDescontoHora'] ? Uteis::formatarMoeda($valor['valorDescontoHora']) : "";
				$validadeDesconto = $valor['validadeDesconto'] ? Uteis::exibirData($valor['validadeDesconto']) : "";
				$desc = ($valorDescontoHora && $validadeDesconto) ? "$valorDescontoHora até $validadeDesconto" : "";

				$dataInicio = Uteis::exibirData($valor['dataInicio']);
				$dataFim = $valor['dataFim'] ? Uteis::exibirData($valor['dataFim']) : "";

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "&id=$idValorHoraGrupo', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>
				
				<td>". /*strtotime($valor['dataInicio'])*/   "</td>
				
				<td $onclick>R$ " . Uteis::formatarMoeda($valorHora) . "</td>
				
				<td $onclick>" . $cargaHorariaFixaMensal . "</td>
				
				<td $onclick>" . $desc . "</td>
				
				<td $onclick>" . $dataInicio . "</td>
				
				<td $onclick>" . $dataFim . "</td>
				
				<td $onclick>" . Uteis::exibirData($valor['previsaoReajuste']). "</td>
				
				<td align=\"center\" $onclick >" . $naoPagarProfessor . "</td>";
				if ($pa == 1) {
					$html .= "<td align=\"center\" $onclick >" . $valorHoraProfessor . "</td>";
				}
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectValorHoraGrupoSelect() Function
	 */
	function selectValorHoraGrupoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idValorHoraGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, modalidade_idModalidade, valorHora, cargaHorariaFixaMensal, valorDescontoHora, validadeDesconto, previsaoReajuste, dataInicio, dataFim, dataCadastro FROM valorHoraGrupo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idValorHoraGrupo\" name=\"idValorHoraGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idValorHoraGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idValorHoraGrupo'] . "\">" . ($valor['idValorHoraGrupo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectValorHoraGrupo_periodo($idPlanoAcaoGrupo, $dataReferencia) {

		$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));

		$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo;
		$where .= " AND dataInicio <= '" . $dataReferenciaFinal . "' ";
		$where .= " AND ((dataFim >= '" . $dataReferenciaFinal . "' )";/*AND dataFim <= '" . $dataReferenciaFinal . "')*/ 
		$where .= "OR dataFim IS NULL OR dataFim = '') ";

		$rs = $this -> selectValorHoraGrupo($where);
		//echo $where;

		return $rs;
	}

}
?>