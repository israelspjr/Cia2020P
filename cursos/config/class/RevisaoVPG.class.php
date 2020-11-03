<?php
class RevisaoVPG extends Database {
	// class attributes
	var $idRevisaoVPG;
	var $acompanhamentoCursoIdAcompanhamentoCurso;
	var $anexo;
	var $data;
	var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idRevisaoVPG = "NULL";
		$this -> acompanhamentoCursoIdAcompanhamentoCurso = "NULL";
		$this -> anexo = "NULL";
		$this -> data = "NULL";
		$this -> obs = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdRevisaoVPG($value) {
		$this -> idRevisaoVPG = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAcompanhamentoCursoIdAcompanhamentoCurso($value) {
		$this -> acompanhamentoCursoIdAcompanhamentoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAnexo($value) {
		$this -> anexo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setData($value) {
		$this -> data = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addRevisaoVPG() Function
	 */
	function addRevisaoVPG() {
		$sql = "INSERT INTO revisaoVPG (acompanhamentoCurso_idAcompanhamentoCurso, anexo, data, obs) VALUES ($this->acompanhamentoCursoIdAcompanhamentoCurso, $this->anexo, $this->data, $this->obs)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteRevisaoVPG() Function
	 */
	function deleteRevisaoVPG() {
		$sql = "DELETE FROM revisaoVPG WHERE idRevisaoVPG = $this->idRevisaoVPG";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldRevisaoVPG() Function
	 */
	function updateFieldRevisaoVPG($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE revisaoVPG SET " . $field . " = " . $value . " WHERE idRevisaoVPG = $this->idRevisaoVPG";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateRevisaoVPG() Function
	 */
	function updateRevisaoVPG() {
		$sql = "UPDATE revisaoVPG SET acompanhamentoCurso_idAcompanhamentoCurso = $this->acompanhamentoCursoIdAcompanhamentoCurso, anexo = $this->anexo, data = $this->data, obs = $this->obs WHERE idRevisaoVPG = $this->idRevisaoVPG";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectRevisaoVPG() Function
	 */
	function selectRevisaoVPG($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idRevisaoVPG, acompanhamentoCurso_idAcompanhamentoCurso, anexo, data, obs FROM revisaoVPG " . $where;
		return $this -> executeQuery($sql);
	}

	function selectRevisaoVPGTr($mostrarAcoes, $caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE idRevisaoVPG, acompanhamentoCurso_idAcompanhamentoCurso, anexo, data, obs FROM revisaoVPG " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/revisaoVPG.php?mostrarAcoes=" . $mostrarAcoes . "&id=" . $valor['idRevisaoVPG'] . "', '" . $caminhoAtualizar . "&mostrarAcoes=" . $mostrarAcoes . "', '$ondeAtualiza')\" >" . Uteis::exibirData($valor['data']) . "</td>
				
				<td> <a href=\"" . CAMINHO_UP . "arquivo/revisaovpg/" . $valor['anexo'] . "\" target=\"_blank\">" . "<center><img src=\"" . CAMINHO_IMG . "contrato.png\" ><center>" . "</td>";
				if ($mostrarAcoes) {
					$html .= "<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/revisaoVPG.php', '" . $valor['idRevisaoVPG'] . "', '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				} else {
					$html .= "<td></td>";
				}
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectRevisaoVPGSelect() Function
	 */
	function selectRevisaoVPGSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idRevisaoVPG, acompanhamentoCurso_idAcompanhamentoCurso, anexo, data, obs FROM revisaoVPG " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idRevisaoVPG\" name=\"idRevisaoVPG\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idRevisaoVPG'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idRevisaoVPG'] . "\">" . ($valor['idRevisaoVPG']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>

