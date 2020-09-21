<?php
class SubCursoDemonstrativoCobrancaIntegranteGrupo extends Database {
	// class attributes
	var $idSubCursoDemonstrativoCobrancaIntegranteGrupo;
	var $demonstrativoCobrancaIntegranteGrupoId;
	var $dataInicio;
	var $dataFim;
	var $percentual;
	var $teto;
	var $quemPaga;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idSubCursoDemonstrativoCobrancaIntegranteGrupo = "NULL";
		$this -> demonstrativoCobrancaIntegranteGrupoId = "NULL";
		$this -> dataInicio = "NULL";
		$this -> dataFim = "NULL";
		$this -> percentual = "NULL";
		$this -> teto = "NULL";
		$this -> quemPaga = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdSubCursoDemonstrativoCobrancaIntegranteGrupo($value) {
		$this -> idSubCursoDemonstrativoCobrancaIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDemonstrativoCobrancaIntegranteGrupoId($value) {
		$this -> demonstrativoCobrancaIntegranteGrupoId = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataInicio($value) {
		$this -> dataInicio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataFim($value) {
		$this -> dataFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPercentual($value) {
		$this -> percentual = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTeto($value) {
		$this -> teto = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setQuemPaga($value) {
		$this -> quemPaga = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addSubCursoDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function addSubCursoDemonstrativoCobrancaIntegranteGrupo() {
		$sql = "INSERT INTO subCurso_demonstrativoCobrancaIntegranteGrupo (demonstrativoCobrancaIntegranteGrupo_id, dataInicio, dataFim, percentual, teto, quemPaga) VALUES ($this->demonstrativoCobrancaIntegranteGrupoId, $this->dataInicio, $this->dataFim, $this->percentual, $this->teto, $this->quemPaga)";
		$result = $this -> query($sql, true);
		//echo "$sql";
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteSubCursoDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function deleteSubCursoDemonstrativoCobrancaIntegranteGrupo($or = "") {
		$sql = "DELETE FROM subCurso_demonstrativoCobrancaIntegranteGrupo WHERE idSubCurso_demonstrativoCobrancaIntegranteGrupo = $this->idSubCursoDemonstrativoCobrancaIntegranteGrupo " . $or;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldSubCursoDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function updateFieldSubCursoDemonstrativoCobrancaIntegranteGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE subCurso_demonstrativoCobrancaIntegranteGrupo SET " . $field . " = " . $value . " WHERE idSubCurso_demonstrativoCobrancaIntegranteGrupo = $this->idSubCursoDemonstrativoCobrancaIntegranteGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateSubCursoDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function updateSubCursoDemonstrativoCobrancaIntegranteGrupo() {
		$sql = "UPDATE subCurso_demonstrativoCobrancaIntegranteGrupo SET demonstrativoCobrancaIntegranteGrupo_id = $this->demonstrativoCobrancaIntegranteGrupoId, dataInicio = $this->dataInicio, dataFim = $this->dataFim, percentual = $this->percentual, teto = $this->teto, quemPaga = $this->quemPaga WHERE idSubCurso_demonstrativoCobrancaIntegranteGrupo = $this->idSubCursoDemonstrativoCobrancaIntegranteGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectSubCursoDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function selectSubCursoDemonstrativoCobrancaIntegranteGrupo($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idSubCurso_demonstrativoCobrancaIntegranteGrupo, demonstrativoCobrancaIntegranteGrupo_id, dataInicio, dataFim, percentual AS subvencao, teto, quemPaga FROM subCurso_demonstrativoCobrancaIntegranteGrupo " . $where;

		return $this -> executeQuery($sql);
	}

	/**
	 * selectSubCursoDemonstrativoCobrancaIntegranteGrupoTr() Function
	 */
	function selectSubCursoDemonstrativoCobrancaIntegranteGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idSubCurso_demonstrativoCobrancaIntegranteGrupo, demonstrativoCobrancaIntegranteGrupo_id, dataInicio, dataFim, percentual, teto, quemPaga FROM subCurso_demonstrativoCobrancaIntegranteGrupo " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idSubCurso_demonstrativoCobrancaIntegranteGrupo'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idSubCurso_demonstrativoCobrancaIntegranteGrupo'] . "</td>";
				$html .= "<td>" . $valor['demonstrativoCobrancaIntegranteGrupo_id'] . "</td>";
				$html .= "<td>" . $valor['dataInicio'] . "</td>";
				$html .= "<td>" . $valor['dataFim'] . "</td>";
				$html .= "<td>" . $valor['percentual'] . "</td>";
				$html .= "<td>" . $valor['teto'] . "</td>";
				$html .= "<td>" . $valor['quemPaga'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/SubCursoDemonstrativoCobrancaIntegranteGrupo.php', " . $valor['idSubCurso_demonstrativoCobrancaIntegranteGrupo'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectSubCursoDemonstrativoCobrancaIntegranteGrupoSelect() Function
	 */
	function selectSubCursoDemonstrativoCobrancaIntegranteGrupoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idSubCurso_demonstrativoCobrancaIntegranteGrupo, demonstrativoCobrancaIntegranteGrupo_id, dataInicio, dataFim, percentual, teto, quemPaga FROM subCurso_demonstrativoCobrancaIntegranteGrupo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idSubCurso_demonstrativoCobrancaIntegranteGrupo\" name=\"idSubCurso_demonstrativoCobrancaIntegranteGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idSubCurso_demonstrativoCobrancaIntegranteGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idSubCurso_demonstrativoCobrancaIntegranteGrupo'] . "\">" . ($valor['idSubCurso_demonstrativoCobrancaIntegranteGrupo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>