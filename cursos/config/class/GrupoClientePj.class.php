<?php
class GrupoClientePj extends Database {
	// class attributes
	var $idGrupoClientePj;
	var $grupoIdGrupo;
	var $clientePjIdClientePj;
	var $dataFim;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idGrupoClientePj = "NULL";
		$this -> grupoIdGrupo = "NULL";
		$this -> clientePjIdClientePj = "NULL";
		$this -> dataFim = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdGrupoClientePj($value) {
		$this -> idGrupoClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setGrupoIdGrupo($value) {
		$this -> grupoIdGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataFim($value) {
		$this -> dataFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addGrupoClientePj() Function
	 */
	function addGrupoClientePj() {
		$sql = "INSERT INTO grupoClientePj (grupo_idGrupo, clientePj_idClientePj, dataFim, dataCadastro) VALUES ($this->grupoIdGrupo, $this->clientePjIdClientePj, $this->dataFim, $this->dataCadastro)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteGrupoClientePj() Function
	 */
	function deleteGrupoClientePj() {
		$sql = "DELETE FROM grupoClientePj WHERE idGrupoClientePj = $this->idGrupoClientePj";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldGrupoClientePj() Function
	 */
	function updateFieldGrupoClientePj($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE grupoClientePj SET " . $field . " = " . $value . " WHERE idGrupoClientePj = $this->idGrupoClientePj";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateGrupoClientePj() Function
	 */
	function updateGrupoClientePj() {
		$sql = "UPDATE grupoClientePj SET grupo_idGrupo = $this->grupoIdGrupo, clientePj_idClientePj = $this->clientePjIdClientePj, dataFim = $this->dataFim,  WHERE idGrupoClientePj = $this->idGrupoClientePj";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectGrupoClientePj() Function
	 */
	function selectGrupoClientePj($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE GPJ.idGrupoClientePj, GPJ.grupo_idGrupo, GPJ.clientePj_idClientePj, GPJ.dataFim, GPJ.dataCadastro FROM grupoClientePj as GPJ " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectGrupoClientePjTr() Function
	 */
	function selectGrupoClientePjTr($caminhoAtualizar = "", $ondeAtualiza = "", $where) {

		$sql = "SELECT SQL_CACHE idGrupoClientePj, G.nome FROM grupoClientePj AS GPJ ";
		$sql .= " INNER JOIN grupo AS G ON G.idGrupo = GPJ.grupo_idGrupo " . $where;
		//echo $sql;
		//exit;
		$result = $this -> query($sql, true);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";
				$html .= "<td >" . ($valor['nome']) . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "gerente/include/acao/grupoClientePj.php', " . $valor['idGrupoClientePj'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectGrupoClientePjSelect() Function
	 */
	function selectGrupoClientePjSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idGrupoClientePj, grupo_idGrupo, clientePj_idClientePj, dataFim, dataCadastro FROM grupoClientePj " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idGrupoClientePj\" name=\"idGrupoClientePj\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idGrupoClientePj'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idGrupoClientePj'] . "\">" . ($valor['idGrupoClientePj']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function getNomePJ($idGrupo, $id = false) {

		$ClientePj = new ClientePj();
		$valorGrupoClientePj = $this -> selectGrupoClientePj(" WHERE grupo_idGrupo = " . $idGrupo);
		$idClientePj = $valorGrupoClientePj[0]['clientePj_idClientePj'];
		
		if ($id == false) {
		if ($idClientePj) {
			$nomePJ = $ClientePj -> selectClientePj(" WHERE idClientePj = " . $idClientePj);
			$nomePJ = $nomePJ[0]['razaoSocial'];
		} else {
			$nomePJ = "Particular";
		}
		} else {
			$nomePJ = $idClientePj;	
		}
		return $nomePJ;
	}
	
	

}
?>