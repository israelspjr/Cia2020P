<?php
class RespostaPsaProfessor extends Database {
	// class attributes
	var $idRespostaPsaProfessor;
	var $psaIntegranteGrupoIdPsaIntegranteGrupo;
	var $psaProfessorIdPsaProfessor;
	var $professorIdProfessor;
	var $notasTipoNotaIdNotasTipoNota;
	var $obs;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idRespostaPsaProfessor = "NULL";
		$this -> psaIntegranteGrupoIdPsaIntegranteGrupo = "NULL";
		$this -> psaProfessorIdPsaProfessor = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> notasTipoNotaIdNotasTipoNota = "NULL";
		$this -> obs = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdRespostaPsaProfessor($value) {
		$this -> idRespostaPsaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPsaIntegranteGrupoIdPsaIntegranteGrupo($value) {
		$this -> psaIntegranteGrupoIdPsaIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPsaProfessorIdPsaProfessor($value) {
		$this -> psaProfessorIdPsaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addRespostaPsaProfessor() Function
	 */
	function addRespostaPsaProfessor() {
		$sql = "INSERT INTO respostaPsaProfessor (psaIntegranteGrupo_idPsaIntegranteGrupo, psaProfessor_idPsaProfessor, professor_idProfessor, notasTipoNota_idNotasTipoNota, obs, dataCadastro) VALUES ($this->psaIntegranteGrupoIdPsaIntegranteGrupo, $this->psaProfessorIdPsaProfessor, $this->professorIdProfessor, $this->notasTipoNotaIdNotasTipoNota, $this->obs, $this->dataCadastro)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteRespostaPsaProfessor() Function
	 */
	function deleteRespostaPsaProfessor($and = "") {
		$sql = "DELETE FROM respostaPsaProfessor WHERE idRespostaPsaProfessor = $this->idRespostaPsaProfessor".$and;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldRespostaPsaProfessor() Function
	 */
	function updateFieldRespostaPsaProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE respostaPsaProfessor SET " . $field . " = " . $value . " WHERE idRespostaPsaProfessor = $this->idRespostaPsaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateRespostaPsaProfessor() Function
	 */
	function updateRespostaPsaProfessor() {
		$sql = "UPDATE respostaPsaProfessor SET psaIntegranteGrupo_idPsaIntegranteGrupo = $this->psaIntegranteGrupoIdPsaIntegranteGrupo, psaProfessor_idPsaProfessor = $this->psaProfessorIdPsaProfessor, professor_idProfessor = $this->professorIdProfessor, notasTipoNota_idNotasTipoNota = $this->notasTipoNotaIdNotasTipoNota, obs = $this->obs,  WHERE idRespostaPsaProfessor = $this->idRespostaPsaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectRespostaPsaProfessor() Function
	 */
	function selectRespostaPsaProfessor($where = "WHERE 1") {
		  $sql = "SELECT r.idRespostaPsaProfessor, r.psaIntegranteGrupo_idPsaIntegranteGrupo, r.psaProfessor_idPsaProfessor, 
        r.professor_idProfessor, r.notasTipoNota_idNotasTipoNota, r.obs, r.dataCadastro , p.nome, pp.titulo, pp.pergunta, pp.tipo FROM respostaPsaProfessor r 
        LEFT JOIN professor p ON p.idProfessor = r.professor_idProfessor 
        INNER JOIN psaProfessor pp ON pp.idPsaProfessor = r.psaProfessor_idPsaProfessor " . $where;
		return $this -> executeQuery($sql);
	}
	
	function selectPsaProfessorNota($integrante, $periodo){
	    $sql = "SELECT pp.titulo, n.nome FROM psaIntegranteGrupo as pi
                INNER JOIN respostaPsaProfessor AS r ON pi.idPsaIntegranteGrupo = r.psaIntegranteGrupo_idPsaIntegranteGrupo
                INNER JOIN psaProfessor AS pp ON pp.idPsaProfessor = r.psaProfessor_idPsaProfessor
                INNER JOIN tipoNota AS tn ON tn.idTipoNota = pp.tipo   
                INNER JOIN notasTipoNota AS n ON n.tipoNota_idTipoNota = tn.idTipoNota AND n.idNotasTipoNota = r.notasTipoNota_idNotasTipoNota      
                WHERE pi.idPsaIntegranteGrupo = $integrante AND r.notasTipoNota_idNotasTipoNota != 19 AND pi.dataReferencia = '".$periodo."'";
    //   echo $sql;
        return $this->executeQuery($sql);
	}

	/**
	 * selectRespostaPsaProfessorTr() Function
	 */
	function selectRespostaPsaProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idRespostaPsaProfessor, psaIntegranteGrupo_idPsaIntegranteGrupo, psaProfessor_idPsaProfessor, professor_idProfessor, notasTipoNota_idNotasTipoNota, obs, dataCadastro FROM respostaPsaProfessor " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idRespostaPsaProfessor'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idRespostaPsaProfessor'] . "</td>";
				$html .= "<td>" . $valor['psaIntegranteGrupo_idPsaIntegranteGrupo'] . "</td>";
				$html .= "<td>" . $valor['psaProfessor_idPsaProfessor'] . "</td>";
				$html .= "<td>" . $valor['professor_idProfessor'] . "</td>";
				$html .= "<td>" . $valor['notasTipoNota_idNotasTipoNota'] . "</td>";
				$html .= "<td>" . $valor['obs'] . "</td>";
				$html .= "<td>" . $valor['dataCadastro'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/RespostaPsaProfessor.php', " . $valor['idRespostaPsaProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectRespostaPsaProfessorSelect() Function
	 */
	function selectRespostaPsaProfessorSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idRespostaPsaProfessor, psaIntegranteGrupo_idPsaIntegranteGrupo, psaProfessor_idPsaProfessor, professor_idProfessor, notasTipoNota_idNotasTipoNota, obs, dataCadastro FROM respostaPsaProfessor " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idRespostaPsaProfessor\" name=\"idRespostaPsaProfessor\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idRespostaPsaProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idRespostaPsaProfessor'] . "\">" . ($valor['idRespostaPsaProfessor']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>