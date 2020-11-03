<?php
class VariedadeRecurso extends Database {
	// class attributes
	var $idVariedadeRecurso;
	var $acompanhamentoCursoIdAcompanhamentoCurso;
	var $tipoVariedadeRecursoIdTipoVariedadeRecurso;
	var $titulo;
	var $dataAplicacao;
	var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idVariedadeRecurso = "NULL";
		$this -> acompanhamentoCursoIdAcompanhamentoCurso = "NULL";
		$this -> tipoVariedadeRecursoIdTipoVariedadeRecurso = "NULL";
		$this -> titulo = "NULL";
		$this -> dataAplicacao = "NULL";
		$this -> obs = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdVariedadeRecurso($value) {
		$this -> idVariedadeRecurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAcompanhamentoCursoIdAcompanhamentoCurso($value) {
		$this -> acompanhamentoCursoIdAcompanhamentoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoVariedadeRecursoIdTipoVariedadeRecurso($value) {
		$this -> tipoVariedadeRecursoIdTipoVariedadeRecurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTitulo($value) {
		$this -> titulo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataAplicacao($value) {
		$this -> dataAplicacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addVariedadeRecurso() Function
	 */
	function addVariedadeRecurso() {
		$sql = "INSERT INTO variedadeRecurso (acompanhamentoCurso_idAcompanhamentoCurso, tipoVariedadeRecurso_idTipoVariedadeRecurso, titulo, dataAplicacao, obs) VALUES ($this->acompanhamentoCursoIdAcompanhamentoCurso, $this->tipoVariedadeRecursoIdTipoVariedadeRecurso, $this->titulo, $this->dataAplicacao, $this->obs)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteVariedadeRecurso() Function
	 */
	function deleteVariedadeRecurso() {
		$sql = "DELETE FROM variedadeRecurso WHERE idVariedadeRecurso = $this->idVariedadeRecurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldVariedadeRecurso() Function
	 */
	function updateFieldVariedadeRecurso($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE variedadeRecurso SET " . $field . " = " . $value . " WHERE idVariedadeRecurso = $this->idVariedadeRecurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateVariedadeRecurso() Function
	 */
	function updateVariedadeRecurso() {
		$sql = "UPDATE variedadeRecurso SET acompanhamentoCurso_idAcompanhamentoCurso = $this->acompanhamentoCursoIdAcompanhamentoCurso, tipoVariedadeRecurso_idTipoVariedadeRecurso = $this->tipoVariedadeRecursoIdTipoVariedadeRecurso, titulo = $this->titulo, dataAplicacao = $this->dataAplicacao, obs = $this->obs WHERE idVariedadeRecurso = $this->idVariedadeRecurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectVariedadeRecurso() Function
	 */
	function selectVariedadeRecurso($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idVariedadeRecurso, acompanhamentoCurso_idAcompanhamentoCurso, tipoVariedadeRecurso_idTipoVariedadeRecurso, titulo, dataAplicacao, obs FROM variedadeRecurso " . $where;
		return $this -> executeQuery($sql);
	}

	function selectVariedadeRecursoTr($mostrarAcoes, $caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE idVariedadeRecurso, acompanhamentoCurso_idAcompanhamentoCurso, tipoVariedadeRecurso_idTipoVariedadeRecurso, titulo, dataAplicacao, obs 
		FROM variedadeRecurso " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$html .= "<tr>";

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/variedadeRecurso.php?mostrarAcoes=" . $mostrarAcoes . "&id=" . $valor['idVariedadeRecurso'] . "', '" . $caminhoAtualizar . "&mostrarAcoes=" . $mostrarAcoes . "', '$ondeAtualiza')\" ";

				$html .= "<td $onclick >" . $valor['titulo'] . "</td>
				
				<td $onclick >" . Uteis::exibirData($valor['dataAplicacao']) . "</td>";

				if ($mostrarAcoes) {
					$html .= "<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/variedadeRecurso.php', '" . $valor['idVariedadeRecurso'] . "', '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				} else {
					$html .= "<td></td>";
				}

				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectVariedadeRecursoSelect() Function
	 */
	function selectVariedadeRecursoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idVariedadeRecurso, acompanhamentoCurso_idAcompanhamentoCurso, tipoVariedadeRecurso_idTipoVariedadeRecurso, titulo, dataAplicacao, obs FROM variedadeRecurso " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idVariedadeRecurso\" name=\"idVariedadeRecurso\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idVariedadeRecurso'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idVariedadeRecurso'] . "\">" . ($valor['idVariedadeRecurso']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>

