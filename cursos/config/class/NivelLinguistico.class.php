<?php
class NivelLinguistico extends Database {
	// class attributes
	var $idNivelLinguistico;
	var $nivel;
    var $obs;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idNivelLinguistico = "NULL";
		$this -> nivel = "NULL";
        $this -> obs = "NULL";
		$this -> inativo = "0";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdNivelLinguistico($value) {
		$this -> idNivelLinguistico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNivel($value) {
		$this -> nivel = ($value) ? $this -> gravarBD($value) : "NULL";
	}

  function setObs($value) {
    $this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
  }

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addNivelLinguistico() Function
	 */
	function addNivelLinguistico() {
		$sql = "INSERT INTO nivelLinguistico (nivel, obs, inativo, excluido) VALUES ($this->nivel, $this->obs, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteNivelLinguistico() Function
	 */
	function deleteNivelLinguistico() {
		$sql = "DELETE FROM nivelLinguistico WHERE idNivelLinguistico = $this->idNivelLinguistico";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldNivelLinguistico() Function
	 */
	function updateFieldNivelLinguistico($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE nivelLinguistico SET " . $field . " = " . $value . " WHERE idNivelLinguistico = $this->idNivelLinguistico";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateNivelLinguistico() Function
	 */
	function updateNivelLinguistico() {
		$sql = "UPDATE nivelLinguistico SET nivel = $this->nivel, obs = $this->obs, inativo = $this->inativo WHERE idNivelLinguistico = $this->idNivelLinguistico";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectNivelLinguistico() Function
	 */
	function selectNivelLinguistico($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idNivelLinguistico, nivel, obs, inativo, excluido FROM nivelLinguistico " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectNivelLinguisticoTr() Function
	 */
	function selectNivelLinguisticoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idNivelLinguistico, nivel, obs, inativo, excluido FROM nivelLinguistico " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idNivelLinguistico = $valor['idNivelLinguistico'];
				$nivel = $valor['nivel'];
        $descricao = $valor['obs'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idNivelLinguistico . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idNivelLinguistico'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nivel . "</td>";
				$html .= "<td>" . $descricao . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idNivelLinguistico'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectNivelLinguisticoSelect() Function
	 */
	function selectNivelLinguisticoSelect($classes = "", $idAtual = 0, $and = " 1=1 ", $idObj) {

		$sql = "SELECT SQL_CACHE idNivelLinguistico, nivel, obs, inativo FROM nivelLinguistico 
		WHERE inativo = 0 AND (" . $and . ") ORDER BY nivel";
		$result = $this -> query($sql);
        $s = $idAtual == 0 ? "selected=\"selected\"" : "";
		$html = "<select id=\"idNivelLinguistico" . $idObj . "\" name=\"idNivelLinguistico" . $idObj . "\" 
		class=\"" . $classes . "\" >
		<option value=\"\" $s>Todos</option>";

		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idNivelLinguistico'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idNivelLinguistico'] . "\">" . $valor['nivel'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function selectNivelLinguisticoSelectMult($classes = "", $idAtual = 0, $and = "") {
		$sql = "SELECT SQL_CACHE idNivelLinguistico, nivel, obs, inativo 
		FROM nivelLinguistico WHERE inativo = 0 $and ORDER BY nivel";
		//echo $sql;
		//exit;
		$result = $this -> query($sql);
		$html = "<select id=\"idNivelLinguistico\" name=\"idNivelLinguistico[]\" class=\"" . $classes . "\" multiple=\"multiple\" >";
		$html .= "<option value=\"\" selected=\"selected\" >Todos</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idNivelLinguistico'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idNivelLinguistico'] . "\">" . $valor['nivel'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function getNome($id) {
		$rs = self::selectNivelLinguistico(" WHERE idNivelLinguistico = ".$id);
		return $rs[0]['nivel'];	
	}

}
?>