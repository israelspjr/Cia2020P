<?php
class RespostaPsaRegular extends Database {
	// class attributes
	var $idRespostaPsaRegular;
	var $psaIntegranteGrupoIdPsaIntegranteGrupo;
	var $psaRegularIdPsa;
	var $notasTipoNotaIdNotasTipoNota;
	var $obs;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idRespostaPsaRegular = "NULL";
		$this -> psaIntegranteGrupoIdPsaIntegranteGrupo = "NULL";
		$this -> psaRegularIdPsa = "NULL";
		$this -> notasTipoNotaIdNotasTipoNota = "NULL";
		$this -> obs = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdRespostaPsaRegular($value) {
		$this -> idRespostaPsaRegular = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPsaIntegranteGrupoIdPsaIntegranteGrupo($value) {
		$this -> psaIntegranteGrupoIdPsaIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPsaRegularIdPsa($value) {
		$this -> psaRegularIdPsa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNotasTipoNotaIdNotasTipoNota($value) {
		$this -> notasTipoNotaIdNotasTipoNota = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addRespostaPsaRegular() Function
	 */
	function addRespostaPsaRegular() {
		$sql = "INSERT INTO respostaPsaRegular (psaIntegranteGrupo_idPsaIntegranteGrupo, psaRegular_idPsa, notasTipoNota_idNotasTipoNota, obs, dataCadastro) VALUES ($this->psaIntegranteGrupoIdPsaIntegranteGrupo, $this->psaRegularIdPsa, $this->notasTipoNotaIdNotasTipoNota, $this->obs, $this->dataCadastro)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteRespostaPsaRegular() Function
	 */
	function deleteRespostaPsaRegular($and = "") {
		$sql = "DELETE FROM respostaPsaRegular WHERE idRespostaPsaRegular = $this->idRespostaPsaRegular".$and;
		$result = $this -> query($sql, true);
	}
 
	/**
	 * updateFieldRespostaPsaRegular() Function
	 */
	function updateFieldRespostaPsaRegular($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE respostaPsaRegular SET " . $field . " = " . $value . " WHERE idRespostaPsaRegular = $this->idRespostaPsaRegular";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateRespostaPsaRegular() Function
	 */
	function updateRespostaPsaRegular() {
		$sql = "UPDATE respostaPsaRegular SET psaIntegranteGrupo_idPsaIntegranteGrupo = $this->psaIntegranteGrupoIdPsaIntegranteGrupo, psaRegular_idPsa = $this->psaRegularIdPsa, notasTipoNota_idNotasTipoNota = $this->notasTipoNotaIdNotasTipoNota, obs = $this->obs,  WHERE idRespostaPsaRegular = $this->idRespostaPsaRegular";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectRespostaPsaRegular() Function
	 */
	function selectRespostaPsaRegular($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE 
		r.idRespostaPsaRegular, r.psaIntegranteGrupo_idPsaIntegranteGrupo, r.psaRegular_idPsa, r.notasTipoNota_idNotasTipoNota, r.obs, r.dataCadastro, pp.titulo, pp.pergunta, pp.tipo 
		FROM respostaPsaRegular AS r INNER JOIN psaRegular pp ON pp.idPsa = r.psaRegular_idPsa " . $where;
		//echo $sql;
		return $this -> executeQuery($sql);
	}
    function selectPsaRegularNota($integrante, $periodo) {
        $sql = "SELECT 
        pp.titulo, n.nome FROM psaIntegranteGrupo as pi
        INNER JOIN respostaPsaRegular AS r ON pi.idPsaIntegranteGrupo = r.psaIntegranteGrupo_idPsaIntegranteGrupo
        INNER JOIN psaRegular pp ON pp.idPsa = r.psaRegular_idPsa 
        INNER JOIN tipoNota AS tn ON tn.idTipoNota = pp.tipo 
        INNER JOIN notasTipoNota AS n ON n.tipoNota_idTipoNota = tn.idTipoNota AND n.idNotasTipoNota = r.notasTipoNota_idNotasTipoNota  
        WHERE pi.idPsaIntegranteGrupo = $integrante AND r.notasTipoNota_idNotasTipoNota != 19 AND pi.dataReferencia = '".$periodo."'";
    //    echo $sql;
        return $this -> executeQuery($sql);
    }
	/**
	 * selectRespostaPsaRegularTr() Function
	 */
	function selectRespostaPsaRegularTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idRespostaPsaRegular, psaIntegranteGrupo_idPsaIntegranteGrupo, psaRegular_idPsa, notasTipoNota_idNotasTipoNota, obs, dataCadastro FROM respostaPsaRegular " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idRespostaPsaRegular'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idRespostaPsaRegular'] . "</td>";
				$html .= "<td>" . $valor['psaIntegranteGrupo_idPsaIntegranteGrupo'] . "</td>";
				$html .= "<td>" . $valor['psaRegular_idPsa'] . "</td>";
				$html .= "<td>" . $valor['notasTipoNota_idNotasTipoNota'] . "</td>";
				$html .= "<td>" . $valor['obs'] . "</td>";
				$html .= "<td>" . $valor['dataCadastro'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/RespostaPsaRegular.php', " . $valor['idRespostaPsaRegular'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectRespostaPsaRegularSelect() Function
	 */
	function selectRespostaPsaRegularSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idRespostaPsaRegular, psaIntegranteGrupo_idPsaIntegranteGrupo, psaRegular_idPsa, notasTipoNota_idNotasTipoNota, obs, dataCadastro FROM respostaPsaRegular " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idRespostaPsaRegular\" name=\"idRespostaPsaRegular\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idRespostaPsaRegular'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idRespostaPsaRegular'] . "\">" . ($valor['idRespostaPsaRegular']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>