<?php
class ProcessoSeletivoProfessorComEtapas extends Database {
	// class attributes
	var $idProcessoSeletivoProfessorComEtapas;
	var $processoSeletivoProfessorIdProcessoSeletivoProfessor;
	var $etapasProcessoSeletivoProfIdEtapasProcessoSeletivoProf;
	var $status;
	var $dataReferencia;
	var $dataCadastro;
	var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idProcessoSeletivoProfessorComEtapas = "NULL";
		$this -> processoSeletivoProfessorIdProcessoSeletivoProfessor = "NULL";
		$this -> etapasProcessoSeletivoProfIdEtapasProcessoSeletivoProf = "NULL";
		$this -> status = "NULL";
		$this -> dataReferencia = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> obs = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdProcessoSeletivoProfessorComEtapas($value) {
		$this -> idProcessoSeletivoProfessorComEtapas = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProcessoSeletivoProfessorIdProcessoSeletivoProfessor($value) {
		$this -> processoSeletivoProfessorIdProcessoSeletivoProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEtapasProcessoSeletivoProfIdEtapasProcessoSeletivoProf($value) {
		$this -> etapasProcessoSeletivoProfIdEtapasProcessoSeletivoProf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setStatus($value) {
		$this -> status = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataReferencia($value) {
		$this -> dataReferencia = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addProcessoSeletivoProfessorComEtapas() Function
	 */
	function addProcessoSeletivoProfessorComEtapas() {
		$sql = "INSERT INTO processoSeletivoProfessorComEtapas (processoSeletivoProfessor_idProcessoSeletivoProfessor, etapasProcessoSeletivoProf_idEtapasProcessoSeletivoProf, status, dataReferencia, dataCadastro, obs) VALUES ($this->processoSeletivoProfessorIdProcessoSeletivoProfessor, $this->etapasProcessoSeletivoProfIdEtapasProcessoSeletivoProf, $this->status, $this->dataReferencia, $this->dataCadastro, $this->obs)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteProcessoSeletivoProfessorComEtapas() Function
	 */
	function deleteProcessoSeletivoProfessorComEtapas($or = " 1=2 ") {
		$sql = "DELETE FROM processoSeletivoProfessorComEtapas WHERE idProcessoSeletivoProfessorComEtapas = $this->idProcessoSeletivoProfessorComEtapas OR (" . $or . ")";
		//echo $sql;
		//exit;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldProcessoSeletivoProfessorComEtapas() Function
	 */
	function updateFieldProcessoSeletivoProfessorComEtapas($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE processoSeletivoProfessorComEtapas SET " . $field . " = " . $value . " WHERE idProcessoSeletivoProfessorComEtapas = $this->idProcessoSeletivoProfessorComEtapas";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateProcessoSeletivoProfessorComEtapas() Function
	 */
	function updateProcessoSeletivoProfessorComEtapas() {
		$sql = "UPDATE processoSeletivoProfessorComEtapas SET processoSeletivoProfessor_idProcessoSeletivoProfessor = $this->processoSeletivoProfessorIdProcessoSeletivoProfessor, etapasProcessoSeletivoProf_idEtapasProcessoSeletivoProf = $this->etapasProcessoSeletivoProfIdEtapasProcessoSeletivoProf, status = $this->status, dataReferencia = $this->dataReferencia, obs = $this->obs WHERE idProcessoSeletivoProfessorComEtapas = $this->idProcessoSeletivoProfessorComEtapas";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectProcessoSeletivoProfessorComEtapas() Function
	 */

	function selectProcessoSeletivoProfessorComEtapas($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idProcessoSeletivoProfessorComEtapas, processoSeletivoProfessor_idProcessoSeletivoProfessor, etapasProcessoSeletivoProf_idEtapasProcessoSeletivoProf, status, dataReferencia, dataCadastro, obs FROM processoSeletivoProfessorComEtapas " . $where;
		return $this -> executeQuery($sql);
	}

	function selectProcessoSeletivoProfessorComEtapasTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = " SELECT idProcessoSeletivoProfessorComEtapas, E.nome, status, dataReferencia 
		FROM processoSeletivoProfessorComEtapas  AS P 
		INNER JOIN etapasProcessoSeletivoProfessor AS E ON E.idEtapasProcessoSeletivoProfessor = P.etapasProcessoSeletivoProf_idEtapasProcessoSeletivoProf " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			while ($valor = mysqli_fetch_array($result)) {

				$ativo = $valor['status'] == 1 ? "ativo.png" : ($valor['status'] == 2 ? "inativo.png" : "none.png");

				$html .= "<tr>
				
				<td>" . strtotime($valor['dataReferencia']) . "</td>
				
				<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idProcessoSeletivoProfessorComEtapas'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . ($valor['nome']) . "</td>
				
				<td>" . Uteis::exibirData($valor['dataReferencia']) . "</td>
				
				<td align=\"center\">
					<img src=\"" . CAMINHO_IMG . $ativo . "\">				
				</td>
				
				<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "professor/include/acao/processoSeletivoProfessorComEtapas.php', " . $valor['idProcessoSeletivoProfessorComEtapas'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";
			}
		}
		return $html;
	}

}
?>