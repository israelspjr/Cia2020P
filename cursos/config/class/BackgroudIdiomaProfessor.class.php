<?php
class BackgroudIdiomaProfessor extends Database {
	// class attributes
	var $idBackgroudIdiomaProfessor;
	var $idiomaProfessorIdIdiomaProfessor;
	var $escolaIdEscola;
	var $comentario1;
	var $comentario2;
	var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idBackgroudIdiomaProfessor = "NULL";
		$this -> idiomaProfessorIdIdiomaProfessor = "NULL";
		$this -> escolaIdEscola = "NULL";
		$this -> comentario1 = "NULL";
		$this -> comentario2 = "NULL";
		$this -> obs = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdBackgroudIdiomaProfessor($value) {
		$this -> idBackgroudIdiomaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaProfessorIdIdiomaProfessor($value) {
		$this -> idiomaProfessorIdIdiomaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEscolaIdEscola($value) {
		$this -> escolaIdEscola = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setComentario1($value) {
		$this -> comentario1 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setComentario2($value) {
		$this -> comentario2 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addBackgroudIdiomaProfessor() Function
	 */
	function addBackgroudIdiomaProfessor() {
		$sql = "INSERT INTO backgroudIdiomaProfessor (idiomaProfessor_idIdiomaProfessor, escola_idEscola, comentario1, comentario2, obs) VALUES ($this->idiomaProfessorIdIdiomaProfessor, $this->escolaIdEscola, $this->comentario1, $this->comentario2, $this->obs)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteBackgroudIdiomaProfessor() Function
	 */
	function deleteBackgroudIdiomaProfessor() {
		$sql = "DELETE FROM backgroudIdiomaProfessor WHERE idBackgroudIdiomaProfessor = $this->idBackgroudIdiomaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldBackgroudIdiomaProfessor() Function
	 */
	function updateFieldBackgroudIdiomaProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE backgroudIdiomaProfessor SET " . $field . " = " . $value . " WHERE idBackgroudIdiomaProfessor = $this->idBackgroudIdiomaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateBackgroudIdiomaProfessor() Function
	 */
	function updateBackgroudIdiomaProfessor() {
		$sql = "UPDATE backgroudIdiomaProfessor SET idiomaProfessor_idIdiomaProfessor = $this->idiomaProfessorIdIdiomaProfessor, escola_idEscola = $this->escolaIdEscola, comentario1 = $this->comentario1, comentario2 = $this->comentario2, obs = $this->obs WHERE idBackgroudIdiomaProfessor = $this->idBackgroudIdiomaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectBackgroudIdiomaProfessor() Function
	 */
	function selectBackgroudIdiomaProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idBackgroudIdiomaProfessor, idiomaProfessor_idIdiomaProfessor, escola_idEscola, comentario1, comentario2, obs FROM backgroudIdiomaProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	function selectBackgroudIdiomaProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "") {
		$sql = "SELECT SQL_CACHE idBackgroudIdiomaProfessor, E.nome, comentario1 FROM backgroudIdiomaProfessor AS B ";
		$sql .= "INNER JOIN escola AS E ON E.idEscola = B.escola_idEscola" . $where;
		//echo $sql;
		//exit;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idBackgroudIdiomaProfessor'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . ($valor['nome']) . "</td>";
				$html .= "<td>" . $valor['comentario1'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "professor/contratado/include/acao/backgroundIdiomaProfessor.php', " . $valor['idBackgroudIdiomaProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

}
?>