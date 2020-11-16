<?php
class SubMaterialDemonstrativoCobrancaIntegranteGrupo extends Database {
	// class attributes
	var $idSubMaterialDemonstrativoCobrancaIntegranteGrupo;
	var $demonstrativoCobrancaIntegranteGrupoId;
	var $dataInicio;
	var $dataFim;
	var $percentual;
	var $teto;
	var $quemPaga;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idSubMaterialDemonstrativoCobrancaIntegranteGrupo = "NULL";
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
	function setIdSubMaterialDemonstrativoCobrancaIntegranteGrupo($value) {
		$this -> idSubMaterialDemonstrativoCobrancaIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addSubMaterialDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function addSubMaterialDemonstrativoCobrancaIntegranteGrupo() {
		$sql = "INSERT INTO subMaterial_demonstrativoCobrancaIntegranteGrupo (demonstrativoCobrancaIntegranteGrupo_id, dataInicio, dataFim, percentual, teto, quemPaga) VALUES ($this->demonstrativoCobrancaIntegranteGrupoId, $this->dataInicio, $this->dataFim, $this->percentual, $this->teto, $this->quemPaga)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteSubMaterialDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function deleteSubMaterialDemonstrativoCobrancaIntegranteGrupo($or = "") {
		$sql = "DELETE FROM subMaterial_demonstrativoCobrancaIntegranteGrupo WHERE idSubMaterial_demonstrativoCobrancaIntegranteGrupo = $this->idSubMaterialDemonstrativoCobrancaIntegranteGrupo " . $or;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldSubMaterialDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function updateFieldSubMaterialDemonstrativoCobrancaIntegranteGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE subMaterial_demonstrativoCobrancaIntegranteGrupo SET " . $field . " = " . $value . " WHERE idSubMaterial_demonstrativoCobrancaIntegranteGrupo = $this->idSubMaterialDemonstrativoCobrancaIntegranteGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateSubMaterialDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function updateSubMaterialDemonstrativoCobrancaIntegranteGrupo() {
		$sql = "UPDATE subMaterial_demonstrativoCobrancaIntegranteGrupo SET demonstrativoCobrancaIntegranteGrupo_id = $this->demonstrativoCobrancaIntegranteGrupoId, dataInicio = $this->dataInicio, dataFim = $this->dataFim, percentual = $this->percentual, teto = $this->teto, quemPaga = $this->quemPaga WHERE idSubMaterial_demonstrativoCobrancaIntegranteGrupo = $this->idSubMaterialDemonstrativoCobrancaIntegranteGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectSubMaterialDemonstrativoCobrancaIntegranteGrupo() Function
	 */
	function selectSubMaterialDemonstrativoCobrancaIntegranteGrupo($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idSubMaterial_demonstrativoCobrancaIntegranteGrupo, demonstrativoCobrancaIntegranteGrupo_id, dataInicio, dataFim, percentual AS subvencao, teto, quemPaga FROM subMaterial_demonstrativoCobrancaIntegranteGrupo " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectSubMaterialDemonstrativoCobrancaIntegranteGrupoTr() Function
	 */
	function selectSubMaterialDemonstrativoCobrancaIntegranteGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idSubMaterial_demonstrativoCobrancaIntegranteGrupo, demonstrativoCobrancaIntegranteGrupo_id, dataInicio, dataFim, percentual, teto, quemPaga FROM subMaterial_demonstrativoCobrancaIntegranteGrupo " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idSubMaterial_demonstrativoCobrancaIntegranteGrupo'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idSubMaterial_demonstrativoCobrancaIntegranteGrupo'] . "</td>";
				$html .= "<td>" . $valor['demonstrativoCobrancaIntegranteGrupo_id'] . "</td>";
				$html .= "<td>" . $valor['dataInicio'] . "</td>";
				$html .= "<td>" . $valor['dataFim'] . "</td>";
				$html .= "<td>" . $valor['percentual'] . "</td>";
				$html .= "<td>" . $valor['teto'] . "</td>";
				$html .= "<td>" . $valor['quemPaga'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/SubMaterialDemonstrativoCobrancaIntegranteGrupo.php', " . $valor['idSubMaterial_demonstrativoCobrancaIntegranteGrupo'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectSubMaterialDemonstrativoCobrancaIntegranteGrupoSelect() Function
	 */
	function selectSubMaterialDemonstrativoCobrancaIntegranteGrupoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idSubMaterial_demonstrativoCobrancaIntegranteGrupo, demonstrativoCobrancaIntegranteGrupo_id, dataInicio, dataFim, percentual, teto, quemPaga FROM subMaterial_demonstrativoCobrancaIntegranteGrupo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idSubMaterial_demonstrativoCobrancaIntegranteGrupo\" name=\"idSubMaterial_demonstrativoCobrancaIntegranteGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idSubMaterial_demonstrativoCobrancaIntegranteGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idSubMaterial_demonstrativoCobrancaIntegranteGrupo'] . "\">" . ($valor['idSubMaterial_demonstrativoCobrancaIntegranteGrupo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>