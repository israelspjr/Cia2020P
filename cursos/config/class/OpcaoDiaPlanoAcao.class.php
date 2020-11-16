<?php
class OpcaoDiaPlanoAcao extends Database {
	// class attributes
	var $idOpcaoDiaPlanoAcao;
	var $opcaoDiaIdOpcao;
	var $horaInicio;
	var $horaFim;
	var $dataAula;
	var $diaSemana;
	var $localAulaIdLocalAula;
	var $enderecoIdEndereco;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idOpcaoDiaPlanoAcao = "NULL";
		$this -> opcaoDiaIdOpcao = "NULL";
		$this -> horaInicio = "NULL";
		$this -> horaFim = "NULL";
		$this -> dataAula = "NULL";
		$this -> diaSemana = "NULL";
		$this -> localAulaIdLocalAula = "NULL";
		$this -> enderecoIdEndereco = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdOpcaoDiaPlanoAcao($value) {
		$this -> idOpcaoDiaPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setOpcaoDiaIdOpcao($value) {
		$this -> opcaoDiaIdOpcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHoraInicio($value) {
		$this -> horaInicio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHoraFim($value) {
		$this -> horaFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataAula($value) {
		$this -> dataAula = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setexibirDiaSemana($value) {
		$this -> diaSemana = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setLocalAulaIdLocalAula($value) {
		$this -> localAulaIdLocalAula = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEnderecoIdEndereco($value) {
		$this -> enderecoIdEndereco = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addOpcaoDiaPlanoAcao() Function
	 */
	function addOpcaoDiaPlanoAcao() {
		$sql = "INSERT INTO opcaoDiaPlanoAcao (opcaoDia_idOpcao, horaInicio, horaFim, dataAula, diaSemana, localAula_idLocalAula, endereco_idEndereco, dataCadastro) VALUES ($this->opcaoDiaIdOpcao, $this->horaInicio, $this->horaFim, $this->dataAula, $this->diaSemana, $this->localAulaIdLocalAula, $this->enderecoIdEndereco, $this->dataCadastro)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteOpcaoDiaPlanoAcao() Function
	 */
	function deleteOpcaoDiaPlanoAcao($and = "") {
		$sql = "DELETE FROM opcaoDiaPlanoAcao WHERE idOpcaoDiaPlanoAcao = $this->idOpcaoDiaPlanoAcao " . $and;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldOpcaoDiaPlanoAcao() Function
	 */
	function updateFieldOpcaoDiaPlanoAcao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE opcaoDiaPlanoAcao SET " . $field . " = " . $value . " WHERE idOpcaoDiaPlanoAcao = $this->idOpcaoDiaPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateOpcaoDiaPlanoAcao() Function
	 */
	function updateOpcaoDiaPlanoAcao() {
		$sql = "UPDATE opcaoDiaPlanoAcao SET opcaoDia_idOpcao = $this->opcaoDiaIdOpcao, horaInicio = $this->horaInicio, horaFim = $this->horaFim, dataAula = $this->dataAula, diaSemana = $this->diaSemana, localAula_idLocalAula = $this->localAulaIdLocalAula, endereco_idEndereco = $this->enderecoIdEndereco,  WHERE idOpcaoDiaPlanoAcao = $this->idOpcaoDiaPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectOpcaoDiaPlanoAcao() Function
	 */
	function selectOpcaoDiaPlanoAcao($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idOpcaoDiaPlanoAcao, opcaoDia_idOpcao, horaInicio, horaFim, dataAula, diaSemana, localAula_idLocalAula, endereco_idEndereco, dataCadastro FROM opcaoDiaPlanoAcao " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectOpcaoDiaPlanoAcaoTr() Function
	 */
	function selectOpcaoDiaPlanoAcaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idOpcaoDiaPlanoAcao, opcaoDia_idOpcao, horaInicio, horaFim, dataAula, diaSemana, localAula_idLocalAula, endereco_idEndereco, dataCadastro FROM opcaoDiaPlanoAcao " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idOpcaoDiaPlanoAcao'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idOpcaoDiaPlanoAcao'] . "</td>";
				$html .= "<td>" . $valor['opcaoDia_idOpcao'] . "</td>";
				$html .= "<td>" . $valor['horaInicio'] . "</td>";
				$html .= "<td>" . $valor['horaFim'] . "</td>";
				$html .= "<td>" . $valor['dataAula'] . "</td>";
				$html .= "<td>" . $valor['diaSemana'] . "</td>";
				$html .= "<td>" . $valor['localAula_idLocalAula'] . "</td>";
				$html .= "<td>" . $valor['endereco_idEndereco'] . "</td>";
				$html .= "<td>" . $valor['dataCadastro'] . "</td>";

				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/OpcaoDiaPlanoAcao.php', " . $valor['idOpcaoDiaPlanoAcao'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectOpcaoDiaPlanoAcaoSelect() Function
	 */
	function selectOpcaoDiaPlanoAcaoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idOpcaoDiaPlanoAcao, opcaoDia_idOpcao, horaInicio, horaFim, dataAula, diaSemana, localAula_idLocalAula, endereco_idEndereco, dataCadastro FROM opcaoDiaPlanoAcao " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idOpcaoDiaPlanoAcao\" name=\"idOpcaoDiaPlanoAcao\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idOpcaoDiaPlanoAcao'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idOpcaoDiaPlanoAcao'] . "\">" . ($valor['idOpcaoDiaPlanoAcao']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}
	
	function montarDia($id)	{
			
		$rs = $this->selectOpcaoDiaPlanoAcao(" WHERE idOpcaoDiaPlanoAcao = $id ");
		
		$diaDaSemana = Uteis::exibirDiaSemana($rs[0]['diaSemana']);
		$dataAula = Uteis::exibirData($rs[0]['dataAula']);		
		$horaInicio = Uteis::exibirHoras($rs[0]['horaInicio']);
		$horaFim = Uteis::exibirHoras($rs[0]['horaFim']);
		
		if( $diaDaSemana ){
			return $diaDaSemana . " das " . $horaInicio . " às " . $horaFim;
		}else{
			return $dataAula . " das " . $horaInicio . " às " . $horaFim;
		}
		
	}
}
