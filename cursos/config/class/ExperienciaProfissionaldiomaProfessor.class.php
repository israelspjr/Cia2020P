<?php
class ExperienciaProfissionaldiomaProfessor extends Database {
	// class attributes
	var $idExperienciaProfissionaldiomaProfessor;
	var $idiomaProfessorIdIdiomaProfessor;
	var $escolaIdEscola;
	var $nivel;
	var $comentario;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idExperienciaProfissionaldiomaProfessor = "NULL";
		$this -> idiomaProfessorIdIdiomaProfessor = "NULL";
		$this -> escolaIdEscola = "NULL";
		$this -> nivel = "NULL";
		$this -> comentario = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdExperienciaProfissionaldiomaProfessor($value) {
		$this -> idExperienciaProfissionaldiomaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaProfessorIdIdiomaProfessor($value) {
		$this -> idiomaProfessorIdIdiomaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEscolaIdEscola($value) {
		$this -> escolaIdEscola = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNivel($value) {
		$this -> nivel = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setComentario($value) {
		$this -> comentario = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addExperienciaProfissionaldiomaProfessor() Function
	 */
	function addExperienciaProfissionaldiomaProfessor() {
		$sql = "INSERT INTO experienciaProfissionaldiomaProfessor (idiomaProfessor_idIdiomaProfessor, escola_idEscola, nivel, comentario) VALUES ($this->idiomaProfessorIdIdiomaProfessor, $this->escolaIdEscola, $this->nivel, $this->comentario)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteExperienciaProfissionaldiomaProfessor() Function
	 */
	function deleteExperienciaProfissionaldiomaProfessor() {
		$sql = "DELETE FROM experienciaProfissionaldiomaProfessor WHERE idExperienciaProfissionaldiomaProfessor = $this->idExperienciaProfissionaldiomaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldExperienciaProfissionaldiomaProfessor() Function
	 */
	function updateFieldExperienciaProfissionaldiomaProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE experienciaProfissionaldiomaProfessor SET " . $field . " = " . $value . " WHERE idExperienciaProfissionaldiomaProfessor = $this->idExperienciaProfissionaldiomaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateExperienciaProfissionaldiomaProfessor() Function
	 */
	function updateExperienciaProfissionaldiomaProfessor() {
		$sql = "UPDATE experienciaProfissionaldiomaProfessor SET idiomaProfessor_idIdiomaProfessor = $this->idiomaProfessorIdIdiomaProfessor, escola_idEscola = $this->escolaIdEscola, nivel = $this->nivel, comentario = $this->comentario WHERE idExperienciaProfissionaldiomaProfessor = $this->idExperienciaProfissionaldiomaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectExperienciaProfissionaldiomaProfessor() Function
	 */
	function selectExperienciaProfissionaldiomaProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idExperienciaProfissionaldiomaProfessor, idiomaProfessor_idIdiomaProfessor, escola_idEscola, nivel, comentario FROM experienciaProfissionaldiomaProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	function selectExperienciaProfissionaldiomaProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "") {
		$sql = "SELECT SQL_CACHE idExperienciaProfissionaldiomaProfessor, E.nome, nivel FROM experienciaProfissionaldiomaProfessor AS EP ";
		$sql .= "INNER JOIN escola AS E ON E.idEscola = EP.escola_idEscola" . $where;

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idExperienciaProfissionaldiomaProfessor'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . ($valor['nome']) . "</td>";
				$html .= "<td>" . $valor['nivel'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "professor/contratado/include/acao/experienciaProfissionalIdiomaProfessor.php', " . $valor['idExperienciaProfissionaldiomaProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

}
?>