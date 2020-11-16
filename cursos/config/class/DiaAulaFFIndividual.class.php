<?php
class DiaAulaFFIndividual extends Database {
	// class attributes
	var $idDiaAulaFFIndividual;
	var $diaAulaFFIdDiaAulaFF;
	var $integranteGrupoIdIntegranteGrupo;
	var $horaRealizadaAluno;
	var $faltaJustificada;
	var $obsFaltaJustificada;
	var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDiaAulaFFIndividual = "NULL";
		$this -> diaAulaFFIdDiaAulaFF = "NULL";
		$this -> integranteGrupoIdIntegranteGrupo = "NULL";
		$this -> horaRealizadaAluno = "0";
		$this -> faltaJustificada = "0";
		$this -> obsFaltaJustificada = "NULL";
		$this -> obs = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDiaAulaFFIndividual($value) {
		$this -> idDiaAulaFFIndividual = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDiaAulaFFIdDiaAulaFF($value) {
		$this -> diaAulaFFIdDiaAulaFF = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIntegranteGrupoIdIntegranteGrupo($value) {
		$this -> integranteGrupoIdIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHoraRealizadaAluno($value) {
		$this -> horaRealizadaAluno = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setFaltaJustificada($value) {
		$this -> faltaJustificada = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setObsFaltaJustificada($value) {
		$this -> obsFaltaJustificada = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function addDiaAulaFFIndividual() {
		
		$rs = $this->selectDiaAulaFFIndividual(" WHERE diaAulaFF_idDiaAulaFF = $this->diaAulaFFIdDiaAulaFF AND integranteGrupo_idIntegranteGrupo = $this->integranteGrupoIdIntegranteGrupo");		
		if( !$rs ){
			
			$sql = "INSERT INTO diaAulaFFIndividual (diaAulaFF_idDiaAulaFF, integranteGrupo_idIntegranteGrupo, horaRealizadaAluno, faltaJustificada, obsFaltaJustificada, obs) VALUES ($this->diaAulaFFIdDiaAulaFF, $this->integranteGrupoIdIntegranteGrupo, $this->horaRealizadaAluno, $this->faltaJustificada, $this->obsFaltaJustificada, $this->obs)";
			$result = $this -> query($sql, true);
			return $this -> connect;
			
		}else{
				
			$idDiaAulaFFIndividual = $rs[0]['idDiaAulaFFIndividual'];
			
			$this->setIdDiaAulaFFIndividual($idDiaAulaFFIndividual);
			$this->updateDiaAulaFFIndividual();
			
			return $idDiaAulaFFIndividual;
		}
		
	}

	/**
	 * deleteDiaAulaFFIndividual() Function
	 */
	function deleteDiaAulaFFIndividual($and = "") {
		$sql = "DELETE FROM diaAulaFFIndividual WHERE idDiaAulaFFIndividual = $this->idDiaAulaFFIndividual " . $and;
		$result = $this -> query($sql, true);
		//echo "<br>".$sql;
	}

	/**
	 * updateFieldDiaAulaFFIndividual() Function
	 */
	function updateFieldDiaAulaFFIndividual($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE diaAulaFFIndividual SET " . $field . " = " . $value . " WHERE idDiaAulaFFIndividual = $this->idDiaAulaFFIndividual";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDiaAulaFFIndividual() Function
	 */
	function updateDiaAulaFFIndividual() {
		//, faltaJustificada = $this->faltaJustificada, obsFaltaJustificada = $this->obsFaltaJustificada
		$sql = "UPDATE diaAulaFFIndividual SET diaAulaFF_idDiaAulaFF = $this->diaAulaFFIdDiaAulaFF, integranteGrupo_idIntegranteGrupo = $this->integranteGrupoIdIntegranteGrupo, horaRealizadaAluno = $this->horaRealizadaAluno, obs = $this->obs WHERE idDiaAulaFFIndividual = $this->idDiaAulaFFIndividual";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDiaAulaFFIndividual() Function
	 */
	function selectDiaAulaFFIndividual($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDiaAulaFFIndividual, diaAulaFF_idDiaAulaFF, integranteGrupo_idIntegranteGrupo, horaRealizadaAluno, faltaJustificada, obsFaltaJustificada, obs FROM diaAulaFFIndividual " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectDiaAulaFFIndividualTr() Function
	 */
	function selectDiaAulaFFIndividualTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idDiaAulaFFIndividual, diaAulaFF_idDiaAulaFF, integranteGrupo_idIntegranteGrupo, horaRealizadaAluno, faltaJustificada, obsFaltaJustificada, obs FROM diaAulaFFIndividual " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idDiaAulaFFIndividual'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idDiaAulaFFIndividual'] . "</td>";
				$html .= "<td>" . $valor['diaAulaFF_idDiaAulaFF'] . "</td>";
				$html .= "<td>" . $valor['integranteGrupo_idIntegranteGrupo'] . "</td>";
				$html .= "<td>" . $valor['horaRealizadaAluno'] . "</td>";
				$html .= "<td>" . $valor['faltaJustificada'] . "</td>";
				$html .= "<td>" . $valor['obsFaltaJustificada'] . "</td>";
				$html .= "<td>" . $valor['obs'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/DiaAulaFFIndividual.php', " . $valor['idDiaAulaFFIndividual'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectDiaAulaFFIndividualSelect() Function
	 */
	function selectDiaAulaFFIndividualSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDiaAulaFFIndividual, diaAulaFF_idDiaAulaFF, integranteGrupo_idIntegranteGrupo, horaRealizadaAluno, faltaJustificada, obsFaltaJustificada, obs FROM diaAulaFFIndividual " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDiaAulaFFIndividual\" name=\"idDiaAulaFFIndividual\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDiaAulaFFIndividual'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDiaAulaFFIndividual'] . "\">" . ($valor['idDiaAulaFFIndividual']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>