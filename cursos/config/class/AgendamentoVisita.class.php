<?php
class AgendamentoVisita extends Database {
	// class attributes
	var $idAgendamentoVisita;
	var $propostaIdProposta;
	var $tipoVisitaIdTipoVisita;
	var $enderecoIdEndereco;
	var $obs;
	var $dataCadastro;
	var $dataVisita;
	var $horaInicio;
	var $horaFim;
	var $realizada;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idAgendamentoVisita = "NULL";
		$this -> propostaIdProposta = "NULL";
		$this -> tipoVisitaIdTipoVisita = "NULL";
		$this -> enderecoIdEndereco = "NULL";
		$this -> obs = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> dataVisita = "NULL";
		$this -> horaInicio = "NULL";
		$this -> horaFim = "NULL";
		$this -> realizada = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdAgendamentoVisita($value) {
		$this -> idAgendamentoVisita = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPropostaIdProposta($value) {
		$this -> propostaIdProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoVisitaIdTipoVisita($value) {
		$this -> tipoVisitaIdTipoVisita = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEnderecoIdEndereco($value) {
		$this -> enderecoIdEndereco = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setDataVisita($value) {
		$this -> dataVisita = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHoraInicio($value) {
		$this -> horaInicio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHoraFim($value) {
		$this -> horaFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setRealizada($value) {
		$this -> realizada = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addAgendamentoVisita() Function
	 */
	function addAgendamentoVisita() {
		$sql = "INSERT INTO agendamentoVisita (proposta_idProposta, tipoVisita_idTipoVisita, endereco_idEndereco, obs, dataCadastro, dataVisita, horaInicio, horaFim, realizada) VALUES ($this->propostaIdProposta, $this->tipoVisitaIdTipoVisita, $this->enderecoIdEndereco, $this->obs, $this->dataCadastro, $this->dataVisita, $this->horaInicio, $this->horaFim, $this->realizada)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteAgendamentoVisita() Function
	 */
	function deleteAgendamentoVisita() {
		$sql = "DELETE FROM agendamentoVisita WHERE idAgendamentoVisita = $this->idAgendamentoVisita";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldAgendamentoVisita() Function
	 */
	function updateFieldAgendamentoVisita($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE agendamentoVisita SET " . $field . " = " . $value . " WHERE idAgendamentoVisita = $this->idAgendamentoVisita";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateAgendamentoVisita() Function
	 */
	function updateAgendamentoVisita() {
		//, dataCadastro = $this->dataCadastro
		$sql = "UPDATE agendamentoVisita SET proposta_idProposta = $this->propostaIdProposta, tipoVisita_idTipoVisita = $this->tipoVisitaIdTipoVisita, endereco_idEndereco = $this->enderecoIdEndereco, obs = $this->obs, dataVisita = $this->dataVisita, horaInicio = $this->horaInicio, horaFim = $this->horaFim, realizada = $this->realizada WHERE idAgendamentoVisita = $this->idAgendamentoVisita";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectAgendamentoVisita() Function
	 */
	function selectAgendamentoVisita($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idAgendamentoVisita, proposta_idProposta, tipoVisita_idTipoVisita, endereco_idEndereco, obs, dataCadastro, dataVisita, horaInicio, horaFim, realizada FROM agendamentoVisita " . $where;
		return $this -> executeQuery($sql);
	}

}
?>