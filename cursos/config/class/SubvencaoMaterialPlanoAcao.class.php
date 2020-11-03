<?php
class SubvencaoMaterialPlanoAcao extends Database {
	// class attributes
	var $idSubvencaoMaterialPlanoAcao;
	var $integrantePlanoAcaoIdIntegrantePlanoAcao;
	var $subvencao;
	var $teto;
	var $quemPaga;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idSubvencaoMaterialPlanoAcao = "NULL";
		$this -> integrantePlanoAcaoIdIntegrantePlanoAcao = "NULL";
		$this -> subvencao = "NULL";
		$this -> teto = "NULL";
		$this -> quemPaga = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdSubvencaoMaterialPlanoAcao($value) {
		$this -> idSubvencaoMaterialPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addSubvencaoMaterialPlanoAcao() Function
	 */
	function addSubvencaoMaterialPlanoAcao() {
		$sql = "INSERT INTO subvencaoMaterialPlanoAcao (integrantePlanoAcao_idIntegrantePlanoAcao, subvencao, teto, quemPaga) VALUES ($this->integrantePlanoAcaoIdIntegrantePlanoAcao, $this->subvencao, $this->teto, $this->quemPaga)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteSubvencaoMaterialPlanoAcao() Function
	 */
	function deleteSubvencaoMaterialPlanoAcao($and = "") {
		$sql = "DELETE FROM subvencaoMaterialPlanoAcao WHERE idSubvencaoMaterialPlanoAcao = $this->idSubvencaoMaterialPlanoAcao " . $and;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldSubvencaoMaterialPlanoAcao() Function
	 */
	function updateFieldSubvencaoMaterialPlanoAcao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE subvencaoMaterialPlanoAcao SET " . $field . " = " . $value . " WHERE idSubvencaoMaterialPlanoAcao = $this->idSubvencaoMaterialPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateSubvencaoMaterialPlanoAcao() Function
	 */
	function updateSubvencaoMaterialPlanoAcao() {
		$sql = "UPDATE subvencaoMaterialPlanoAcao SET integrantePlanoAcao_idIntegrantePlanoAcao = $this->integrantePlanoAcaoIdIntegrantePlanoAcao, subvencao = $this->subvencao, teto = $this->teto, quemPaga = $this->quemPaga WHERE idSubvencaoMaterialPlanoAcao = $this->idSubvencaoMaterialPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectSubvencaoMaterialPlanoAcao() Function
	 */
	function selectSubvencaoMaterialPlanoAcao($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idSubvencaoMaterialPlanoAcao, integrantePlanoAcao_idIntegrantePlanoAcao, subvencao, teto, quemPaga FROM subvencaoMaterialPlanoAcao " . $where;
		return $this -> executeQuery($sql);
	}

}
?>