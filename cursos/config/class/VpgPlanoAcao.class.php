<?php
class VpgPlanoAcao extends Database {
	// class attributes
	var $idVpgPlanoAcao;
	var $integrantePlanoAcaoIdIntegrantePlanoAcao;
	var $valor;
	var $tipo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idVpgPlanoAcao = "NULL";
		$this -> integrantePlanoAcaoIdIntegrantePlanoAcao = "NULL";
		$this -> valor = "NULL";
		$this -> tipo = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdVpgPlanoAcao($value) {
		$this -> idVpgPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIntegrantePlanoAcaoIdIntegrantePlanoAcao($value) {
		$this -> integrantePlanoAcaoIdIntegrantePlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addVpgPlanoAcao() Function
	 */
	function addVpgPlanoAcao() {
		$sql = "INSERT INTO vpgPlanoAcao (integrantePlanoAcao_idIntegrantePlanoAcao, valor, tipo) VALUES ($this->integrantePlanoAcaoIdIntegrantePlanoAcao, $this->valor, $this->tipo)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteVpgPlanoAcao() Function
	 */
	function deleteVpgPlanoAcao($and = "") {
		$sql = "DELETE FROM vpgPlanoAcao WHERE idVpgPlanoAcao = $this->idVpgPlanoAcao " . $and;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldVpgPlanoAcao() Function
	 */
	function updateFieldVpgPlanoAcao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE vpgPlanoAcao SET " . $field . " = " . $value . " WHERE idVpgPlanoAcao = $this->idVpgPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateVpgPlanoAcao() Function
	 */
	function updateVpgPlanoAcao() {
		$sql = "UPDATE vpgPlanoAcao SET integrantePlanoAcao_idIntegrantePlanoAcao = $this->integrantePlanoAcaoIdIntegrantePlanoAcao, valor = $this->valor, tipo = $this->tipo WHERE idVpgPlanoAcao = $this->idVpgPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectVpgPlanoAcao() Function
	 */
	function selectVpgPlanoAcao($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idVpgPlanoAcao, integrantePlanoAcao_idIntegrantePlanoAcao, valor, tipo FROM vpgPlanoAcao " . $where;
		 //echo $sql;
        //exit;
		return $this -> executeQuery($sql);
	}

	function selectVpgPlanoAcaoLista() {

		$valorVpgPlanoAcao = $this -> selectVpgPlanoAcao(" WHERE integrantePlanoAcao_idIntegrantePlanoAcao = " . $this -> integrantePlanoAcaoIdIntegrantePlanoAcao . " AND tipo = " . $this -> tipo);

		for ($row = 0; $row < count($valorVpgPlanoAcao, 0); $row++) {
			$idVPG = $valorVpgPlanoAcao[$row]['idVpgPlanoAcao'];
			$tipo = $valorVpgPlanoAcao[$row]['tipo'];
			$idIntegrantePlanoAcao = $valorVpgPlanoAcao[$row]['integrantePlanoAcao_idIntegrantePlanoAcao'];
			$aba = "#listaVpg_" . $valorVpgPlanoAcao[$row]['tipo'];
			
			$deleta = "<img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"REMOVER ITEM\" onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "planoAcao/include/acao/vpgPlanoAcao.php',	'".$idVPG."',	'".CAMINHO_VENDAS."planoAcao/include/resourceHTML/vpgPlanoAcao.php?tipo=".$tipo."&idIntegrantePlanoAcao=".$idIntegrantePlanoAcao."', '".$aba."')\" >";
            $editar = "<img src=\"" . CAMINHO_IMG . "editar.png\" title=\"EDITAR ITEM\" onclick=\"Editar(".$idVPG.")\" >";
			echo "<div style=\"padding:5px;\">" . $deleta . "&nbsp;&nbsp;&nbsp;&nbsp;" . $valorVpgPlanoAcao[$row]['valor'] . "&nbsp;&nbsp;&nbsp;&nbsp;". $editar."</div>";

		}

	}

}
?>