<?php
class CalendarioProva extends Database {
	// class attributes
	var $idCalendarioProva;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $provaIdProva;
	var $dataPrevistaInicial;
	var $dataPrevistaNova;
	var $dataAplicacao;
	var $obs;
	var $validacao;
	var $provaOn;
	var $codLiberacao;
	

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idCalendarioProva = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> provaIdProva = "NULL";
		$this -> dataPrevistaInicial = "NULL";
		$this -> dataPrevistaNova = "NULL";
		$this -> dataAplicacao = "NULL";
		$this -> obs = "NULL";
		$this -> validacao = "NULL";
		$this -> provaOn = "0";
		$this -> codLiberacao = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdCalendarioProva($value) {
		$this -> idCalendarioProva = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProvaIdProva($value) {
		$this -> provaIdProva = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataPrevistaInicial($value) {
		$this -> dataPrevistaInicial = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataPrevistaNova($value) {
		$this -> dataPrevistaNova = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataAplicacao($value) {
		$this -> dataAplicacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setValidacao($value) {
		$this -> validacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setProvaOn($value) {
		$this -> provaOn = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setCodLiberacao($value) {
		$this -> codLiberacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	

	/**
	 * addCalendarioProva() Function
	 */
	function addCalendarioProva() {
		$sql = "INSERT INTO calendarioProva (planoAcaoGrupo_idPlanoAcaoGrupo, prova_idProva, dataPrevistaInicial, dataPrevistaNova, dataAplicacao, obs, validacao, provaOn, codLiberacao) VALUES ($this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->provaIdProva, $this->dataPrevistaInicial, $this->dataPrevistaNova, $this->dataAplicacao, $this->obs, $this->validacao, $this->provaOn, $this->codLiberacao)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	function deleteCalendarioProva($and = "") {

		$ItemCalendarioProva = new ItemCalendarioProva();
		$ItemCalendarioProva -> deleteItemCalendarioProva(" OR calendarioProva_idCalendarioProva = $this->idCalendarioProva");

		$sql = "DELETE FROM calendarioProva WHERE idCalendarioProva = $this->idCalendarioProva ";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldCalendarioProva() Function
	 */
	function updateFieldCalendarioProva($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE calendarioProva SET " . $field . " = " . $value . " WHERE idCalendarioProva = $this->idCalendarioProva";
//		echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateCalendarioProva() Function
	 */
	function updateCalendarioProva() {
		$sql = "UPDATE calendarioProva SET planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, prova_idProva = $this->provaIdProva, dataPrevistaInicial = $this->dataPrevistaInicial, dataPrevistaNova = $this->dataPrevistaNova, dataAplicacao = $this->dataAplicacao, obs = $this->obs, validacao = $this->validacao, provaOn = $this->provaOn, codLiberacao = $this->codLiberacao WHERE idCalendarioProva = $this->idCalendarioProva";
//		echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectCalendarioProva() Function
	 */
	function selectCalendarioProva($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idCalendarioProva, planoAcaoGrupo_idPlanoAcaoGrupo, prova_idProva, dataPrevistaInicial, dataPrevistaNova, dataAplicacao, obs, validacao, provaOn, codLiberacao FROM calendarioProva " . $where;
//		echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectCalendarioProvaTr() Function
	 */
	function selectCalendarioProvaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idCalendarioProva, planoAcaoGrupo_idPlanoAcaoGrupo, prova_idProva, dataPrevistaInicial, dataPrevistaNova, dataAplicacao, obs, validacao, provaOn, codLiberacao FROM calendarioProva " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idCalendarioProva'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idCalendarioProva'] . "</td>";
				$html .= "<td>" . $valor['planoAcaoGrupo_idPlanoAcaoGrupo'] . "</td>";
				$html .= "<td>" . $valor['prova_idProva'] . "</td>";
				$html .= "<td>" . $valor['dataPrevistaInicial'] . "</td>";
				$html .= "<td>" . $valor['dataPrevistaNova'] . "</td>";
				$html .= "<td>" . $valor['dataAplicacao'] . "</td>";
				$html .= "<td>" . $valor['validacao'] . "</td>";

				$html .= "<td>" . $valor['obs'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/CalendarioProva.php', " . $valor['idCalendarioProva'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectCalendarioProvaSelect() Function
	 */
	function selectCalendarioProvaSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idCalendarioProva, planoAcaoGrupo_idPlanoAcaoGrupo, prova_idProva, dataPrevistaInicial, dataPrevistaNova, dataAplicacao, obs FROM calendarioProva " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idCalendarioProva\" name=\"idCalendarioProva\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idCalendarioProva'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idCalendarioProva'] . "\">" . ($valor['idCalendarioProva']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>

