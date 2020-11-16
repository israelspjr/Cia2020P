<?php
class DemonstrativoPagamentoAulas extends Database {
	// class attributes
	var $idDemonstrativoPagamentoAulas;
	var $demonstrativoPagamentoIdDemonstrativoPagamento;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $valor;
	var $horas;
	var $dias;
	var $ajudaCusto;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDemonstrativoPagamentoAulas = "NULL";
		$this -> demonstrativoPagamentoIdDemonstrativoPagamento = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> valor = "0";
		$this -> horas = "0";
		$this -> dias = "0";
		$this -> ajudaCusto = "0";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDemonstrativoPagamentoAulas($value) {
		$this -> idDemonstrativoPagamentoAulas = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDemonstrativoPagamentoIdDemonstrativoPagamento($value) {
		$this -> demonstrativoPagamentoIdDemonstrativoPagamento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "0";
	}

	function setHoras($value) {
		$this -> horas = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setDias($value) {
		$this -> dias = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setAjudaCusto($value) {		
		$this -> ajudaCusto = ($value) ? $this -> gravarBD(($value)) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function addDemonstrativoPagamentoAulas() {
		$sql = "INSERT INTO demonstrativoPagamentoAulas (demonstrativoPagamento_idDemonstrativoPagamento, planoAcaoGrupo_idPlanoAcaoGrupo, valor, horas, dias, ajudaCusto, dataCadastro) 
		VALUES ($this->demonstrativoPagamentoIdDemonstrativoPagamento, $this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->valor, $this->horas, $this->dias, $this->ajudaCusto, $this->dataCadastro)";
		//echo "$sql";
		//exit;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}
	
	function deleteDemonstrativoPagamentoAulas($or = "") {
		$sql = "DELETE FROM demonstrativoPagamentoAulas WHERE idDemonstrativoPagamentoAulas = $this->idDemonstrativoPagamentoAulas " . $or;
		$result = $this -> query($sql, true);
	}

	function updateFieldDemonstrativoPagamentoAulas($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE demonstrativoPagamentoAulas SET " . $field . " = " . $value . " WHERE idDemonstrativoPagamentoAulas = $this->idDemonstrativoPagamentoAulas";
		$result = $this -> query($sql, true);
	}

	function updateDemonstrativoPagamentoAulas() {
		$sql = "UPDATE demonstrativoPagamentoAulas SET demonstrativoPagamento_idDemonstrativoPagamento = $this->demonstrativoPagamentoIdDemonstrativoPagamento, planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, valor = $this->valor, horas = $this->horas, dias = $this->dias, ajudaCusto = $this->ajudaCusto	WHERE idDemonstrativoPagamentoAulas = $this->idDemonstrativoPagamentoAulas";
		$result = $this -> query($sql, true);
	}

	function selectDemonstrativoPagamentoAulas($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamentoAulas, demonstrativoPagamento_idDemonstrativoPagamento, planoAcaoGrupo_idPlanoAcaoGrupo, valor, horas, dias, ajudaCusto, dataCadastro 
		FROM demonstrativoPagamentoAulas " . $where;
        //echo $sql;
		return $this -> executeQuery($sql);
	}

}
?>