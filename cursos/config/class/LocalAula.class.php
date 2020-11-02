<?php
class LocalAula extends Database {
	// class attributes
	var $idLocalAula;
	var $local;
	var $inativo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idLocalAula = "NULL";
		$this -> local = "NULL";
		$this -> inativo = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdLocalAula($value) {
		$this -> idLocalAula = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setLocal($value) {
		$this -> local = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addLocalAula() Function
	 */
	function addLocalAula() {
		$sql = "INSERT INTO localAula (local, inativo) VALUES ($this->local, $this->inativo)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteLocalAula() Function
	 */
	function deleteLocalAula() {
		$sql = "DELETE FROM localAula WHERE idLocalAula = $this->idLocalAula";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldLocalAula() Function
	 */
	function updateFieldLocalAula($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE localAula SET " . $field . " = " . $value . " WHERE idLocalAula = $this->idLocalAula";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateLocalAula() Function
	 */
	function updateLocalAula() {
		$sql = "UPDATE localAula SET local = $this->local, inativo = $this->inativo WHERE idLocalAula = $this->idLocalAula";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectLocalAula() Function
	 */
	function selectLocalAula($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idLocalAula, local, inativo FROM localAula " . $where;
		return $this -> executeQuery($sql);
	}

	function selectLocalAulaSelect($classes = "", $idAtual = 0, $and = "", $d = "") {
	        
	       
		$sql = "SELECT SQL_CACHE idLocalAula, local, inativo FROM localAula WHERE inativo = 0 " . $and . " ORDER BY local ";
		$result = $this -> query($sql);
		$html = "<select id=\"idLocalAula$d\" name=\"idLocalAula$d\" class=\"" . $classes . "\" onchange=\"mudarCampo".$d."()\" >";
		$html .= "<option value=\"\">Selecione</option>";

		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idLocalAula'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idLocalAula'] . "\">" . $valor['local'] . $padrao . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	/**
	 * selectLocalAulaTr() Function
	 */
	function selectLocalAulaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idLocalAula, local, inativo, excluido FROM localAula " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idLocalAula = $valor['idLocalAula'];
				$local = $valor['local'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idLocalAula . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idLocalAula'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\">" . $local . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idLocalAula'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

}
?>