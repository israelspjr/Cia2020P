<?php
class NaoFazAulaNestaSemanaGrupo extends Database {
	// class attributes
	var $idNaoFazAulaNestaSemanaGrupo;
	var $semana;
	var $aulaPermanenteGrupoIdAulaPermanenteGrupo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idNaoFazAulaNestaSemanaGrupo = "NULL";
		$this -> semana = "NULL";
		$this -> aulaPermanenteGrupoIdAulaPermanenteGrupo = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdNaoFazAulaNestaSemanaGrupo($value) {
		$this -> idNaoFazAulaNestaSemanaGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setSemana($value) {
		$this -> semana = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAulaPermanenteGrupoIdAulaPermanenteGrupo($value) {
		$this -> aulaPermanenteGrupoIdAulaPermanenteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addNaoFazAulaNestaSemanaGrupo() Function
	 */
	function addNaoFazAulaNestaSemanaGrupo() {
		$sql = "INSERT INTO naoFazAulaNestaSemanaGrupo (semana, aulaPermanenteGrupo_idAulaPermanenteGrupo) VALUES ($this->semana, $this->aulaPermanenteGrupoIdAulaPermanenteGrupo)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteNaoFazAulaNestaSemanaGrupo() Function
	 */
	function deleteNaoFazAulaNestaSemanaGrupo() {
		$sql = "DELETE FROM naoFazAulaNestaSemanaGrupo WHERE idNaoFazAulaNestaSemanaGrupo = $this->idNaoFazAulaNestaSemanaGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldNaoFazAulaNestaSemanaGrupo() Function
	 */
	function updateFieldNaoFazAulaNestaSemanaGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE naoFazAulaNestaSemanaGrupo SET " . $field . " = " . $value . " WHERE idNaoFazAulaNestaSemanaGrupo = $this->idNaoFazAulaNestaSemanaGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateNaoFazAulaNestaSemanaGrupo() Function
	 */
	function updateNaoFazAulaNestaSemanaGrupo() {
		$sql = "UPDATE naoFazAulaNestaSemanaGrupo SET semana = $this->semana, aulaPermanenteGrupo_idAulaPermanenteGrupo = $this->aulaPermanenteGrupoIdAulaPermanenteGrupo WHERE idNaoFazAulaNestaSemanaGrupo = $this->idNaoFazAulaNestaSemanaGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectNaoFazAulaNestaSemanaGrupo() Function
	 */
	function selectNaoFazAulaNestaSemanaGrupo($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idNaoFazAulaNestaSemanaGrupo, semana, aulaPermanenteGrupo_idAulaPermanenteGrupo FROM naoFazAulaNestaSemanaGrupo " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectNaoFazAulaNestaSemanaGrupoTr() Function
	 */
	function selectNaoFazAulaNestaSemanaGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idNaoFazAulaNestaSemanaGrupo, semana, aulaPermanenteGrupo_idAulaPermanenteGrupo FROM naoFazAulaNestaSemanaGrupo " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idNaoFazAulaNestaSemanaGrupo'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idNaoFazAulaNestaSemanaGrupo'] . "</td>";
				$html .= "<td>" . $valor['semana'] . "</td>";
				$html .= "<td>" . $valor['aulaPermanenteGrupo_idAulaPermanenteGrupo'] . "</td>";

				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/NaoFazAulaNestaSemanaGrupo.php', " . $valor['idNaoFazAulaNestaSemanaGrupo'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectNaoFazAulaNestaSemanaGrupoSelect() Function
	 */
	function selectNaoFazAulaNestaSemanaGrupoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idNaoFazAulaNestaSemanaGrupo, semana, aulaPermanenteGrupo_idAulaPermanenteGrupo FROM naoFazAulaNestaSemanaGrupo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idNaoFazAulaNestaSemanaGrupo\" name=\"idNaoFazAulaNestaSemanaGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idNaoFazAulaNestaSemanaGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idNaoFazAulaNestaSemanaGrupo'] . "\">" . ($valor['idNaoFazAulaNestaSemanaGrupo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>