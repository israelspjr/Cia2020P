<?php
class ItemCalendarioProva extends Database {
	// class attributes
	var $idItemCalendarioProva;
	var $calendarioProvaIdCalendarioProva;
	var $itenProvaIdItenProva;
	var $integranteGrupoIdIntegranteGrupo;
	var $nota;
	var $anexo;
	var $obs;
	var $professorIdProfessor;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idItemCalendarioProva = "NULL";
		$this -> calendarioProvaIdCalendarioProva = "NULL";
		$this -> itenProvaIdItenProva = "NULL";
		$this -> integranteGrupoIdIntegranteGrupo = "NULL";
		$this -> nota = "NULL";
		$this -> anexo = "NULL";
		$this -> obs = "NULL";
		$this -> professorIdProfessor = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdItemCalendarioProva($value) {
		$this -> idItemCalendarioProva = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCalendarioProvaIdCalendarioProva($value) {
		$this -> calendarioProvaIdCalendarioProva = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setItenProvaIdItenProva($value) {
		$this -> itenProvaIdItenProva = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIntegranteGrupoIdIntegranteGrupo($value) {
		$this -> integranteGrupoIdIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNota($value) {
		$this -> nota = ($value) ? $this -> gravarBD($value) : "NULL";
	}

    function setData($value) {
        $this->data = ($value) ? $this->gravarBD($value) : "NULL";
    }

	function setAnexo($value) {
		$this -> anexo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addItemCalendarioProva() Function
	 */
	function addItemCalendarioProva() {
		$sql = "INSERT INTO itemCalendarioProva (calendarioProva_idCalendarioProva, itenProva_idItenProva, integranteGrupo_idIntegranteGrupo, nota, data, anexo, obs, professor_idProfessor) VALUES ($this->calendarioProvaIdCalendarioProva, $this->itenProvaIdItenProva, $this->integranteGrupoIdIntegranteGrupo, $this->nota, $this->data, $this->anexo, $this->obs, $this->professorIdProfessor)";
		$result = $this->query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteItemCalendarioProva() Function
	 */
	function deleteItemCalendarioProva($and = "") {

		$sql = "DELETE FROM itemCalendarioProva WHERE idItemCalendarioProva = $this->idItemCalendarioProva " . $and;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldItemCalendarioProva() Function
	 */
	function updateFieldItemCalendarioProva($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE itemCalendarioProva SET " . $field . " = " . $value . " WHERE idItemCalendarioProva = $this->idItemCalendarioProva";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateItemCalendarioProva() Function
	 */
	function updateItemCalendarioProva() {
		$sql = "UPDATE itemCalendarioProva SET calendarioProva_idCalendarioProva = $this->calendarioProvaIdCalendarioProva, itenProva_idItenProva = $this->itenProvaIdItenProva, integranteGrupo_idIntegranteGrupo = $this->integranteGrupoIdIntegranteGrupo, nota = $this->nota, data = $this->data, anexo = $this->anexo, obs = $this->obs, professor_idProfessor = $this->professorIdProfessor WHERE idItemCalendarioProva = $this->idItemCalendarioProva";
		//echo $sql;
		//exit;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectItemCalendarioProva() Function
	 */
	function selectItemCalendarioProva($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idItemCalendarioProva, calendarioProva_idCalendarioProva, itenProva_idItenProva, integranteGrupo_idIntegranteGrupo, nota, anexo, obs, professor_idProfessor FROM itemCalendarioProva " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectItemCalendarioProvaTr() Function
	 */
	function selectItemCalendarioProvaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idItemCalendarioProva, calendarioProva_idCalendarioProva, itenProva_idItenProva, integranteGrupo_idIntegranteGrupo, nota, anexo, obs, professor_idProfessor FROM itemCalendarioProva " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idItemCalendarioProva'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idItemCalendarioProva'] . "</td>";
				$html .= "<td>" . $valor['calendarioProva_idCalendarioProva'] . "</td>";
				$html .= "<td>" . $valor['itenProva_idItenProva'] . "</td>";
				$html .= "<td>" . $valor['integranteGrupo_idIntegranteGrupo'] . "</td>";
				$html .= "<td>" . $valor['nota'] . "</td>";
				$html .= "<td>" . $valor['anexo'] . "</td>";
				$html .= "<td>" . $valor['obs'] . "</td>";
				$html .= "<td>" . $valor['professor_idProfessor'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/ItemCalendarioProva.php', " . $valor['idItemCalendarioProva'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectItemCalendarioProvaSelect() Function
	 */
	function selectItemCalendarioProvaSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idItemCalendarioProva, calendarioProva_idCalendarioProva, itenProva_idItenProva, integranteGrupo_idIntegranteGrupo, nota, anexo, obs, professor_idProfessor FROM itemCalendarioProva " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idItemCalendarioProva\" name=\"idItemCalendarioProva\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idItemCalendarioProva'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idItemCalendarioProva'] . "\">" . ($valor['idItemCalendarioProva']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>

