<?php
class SubvencaoCursoPlanoAcao extends Database {
	// class attributes
	var $idSubvencaoCursoPlanoAcao;
	var $integrantePlanoAcaoIdIntegrantePlanoAcao;
	var $subvencao;
	var $teto;
	var $quemPaga;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idSubvencaoCursoPlanoAcao = "NULL";
		$this -> integrantePlanoAcaoIdIntegrantePlanoAcao = "NULL";
		$this -> subvencao = "NULL";
		$this -> teto = "NULL";
		$this -> quemPaga = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdSubvencaoCursoPlanoAcao($value) {
		$this -> idSubvencaoCursoPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIntegrantePlanoAcaoIdIntegrantePlanoAcao($value) {
		$this -> integrantePlanoAcaoIdIntegrantePlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
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

	/**
	 * addSubvencaoCursoPlanoAcao() Function
	 */
	function addSubvencaoCursoPlanoAcao() {
		$sql = "INSERT INTO subvencaoCursoPlanoAcao (integrantePlanoAcao_idIntegrantePlanoAcao, subvencao, teto, quemPaga) VALUES ($this->integrantePlanoAcaoIdIntegrantePlanoAcao, $this->subvencao, $this->teto, $this->quemPaga)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteSubvencaoCursoPlanoAcao() Function
	 */
	function deleteSubvencaoCursoPlanoAcao($and = "") {
		$sql = "DELETE FROM subvencaoCursoPlanoAcao WHERE idSubvencaoCursoPlanoAcao = $this->idSubvencaoCursoPlanoAcao " . $and;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldSubvencaoCursoPlanoAcao() Function
	 */
	function updateFieldSubvencaoCursoPlanoAcao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE subvencaoCursoPlanoAcao SET " . $field . " = " . $value . " WHERE idSubvencaoCursoPlanoAcao = $this->idSubvencaoCursoPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateSubvencaoCursoPlanoAcao() Function
	 */
	function updateSubvencaoCursoPlanoAcao() {
		$sql = "UPDATE subvencaoCursoPlanoAcao SET integrantePlanoAcao_idIntegrantePlanoAcao = $this->integrantePlanoAcaoIdIntegrantePlanoAcao, subvencao = $this->subvencao, teto = $this->teto, quemPaga = $this->quemPaga WHERE idSubvencaoCursoPlanoAcao = $this->idSubvencaoCursoPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectSubvencaoCursoPlanoAcao() Function
	 */
	function selectSubvencaoCursoPlanoAcao($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idSubvencaoCursoPlanoAcao, integrantePlanoAcao_idIntegrantePlanoAcao, subvencao, teto, quemPaga FROM subvencaoCursoPlanoAcao " . $where;
		return $this -> executeQuery($sql);
	}

}
?>