<?php
class ExperienciaProfissional extends Database {
	// class attributes
	var $idExperienciaProfissional;
	var $professorIdProfessor;
	var $empresa;
	var $funcao;
	var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idExperienciaProfissional = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> empresa = "NULL";
		$this -> funcao = "NULL";
		$this -> obs = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdExperienciaProfissional($value) {
		$this -> idExperienciaProfissional = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEmpresa($value) {
		$this -> empresa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFuncao($value) {
		$this -> funcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addExperienciaProfissional() Function
	 */
	function addExperienciaProfissional() {
		$sql = "INSERT INTO experienciaProfissional (professor_idProfessor, empresa, funcao, obs) VALUES ($this->professorIdProfessor, $this->empresa, $this->funcao, $this->obs)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteExperienciaProfissional() Function
	 */
	function deleteExperienciaProfissional() {
		$sql = "DELETE FROM experienciaProfissional WHERE idExperienciaProfissional = $this->idExperienciaProfissional";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldExperienciaProfissional() Function
	 */
	function updateFieldExperienciaProfissional($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE experienciaProfissional SET " . $field . " = " . $value . " WHERE idExperienciaProfissional = $this->idExperienciaProfissional";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateExperienciaProfissional() Function
	 */
	function updateExperienciaProfissional() {
		$sql = "UPDATE experienciaProfissional SET professor_idProfessor = $this->professorIdProfessor, empresa = $this->empresa, funcao = $this->funcao, obs = $this->obs WHERE idExperienciaProfissional = $this->idExperienciaProfissional";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectExperienciaProfissional() Function
	 */
	function selectExperienciaProfissional($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idExperienciaProfissional, professor_idProfessor, empresa, funcao, obs FROM experienciaProfissional " . $where;
		return $this -> executeQuery($sql);
	}

	function selectExperienciaProfissionalTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "",$mobile) {

		$sql = "SELECT SQL_CACHE idExperienciaProfissional, professor_idProfessor, empresa, funcao, obs 
		FROM experienciaProfissional " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
				if($mobile != 1) {

				$onclik = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/experienciaProfissional.php?id=" . $valor['idExperienciaProfissional'] . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				
				} else {
				$onclik = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "form/experienciaProfissional.php?id=" . $valor['idExperienciaProfissional'] . "', '$ondeAtualiza');\" ";
				
					
				}

				$html .= "<tr>
				
				<td $onclik >" . ($valor['empresa']) . "</td>
				
				<td $onclik >" . $valor['funcao'] . "</td>
				
				<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/experienciaProfissional.php', '" . $valor['idExperienciaProfissional'] . "', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";
			}
		}
		return $html;
	}

}
?>