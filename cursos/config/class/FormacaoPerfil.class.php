<?php
class FormacaoPerfil extends Database {
	// class attributes
	var $idFormacaoPerfil;
	var $professorIdProfessor;
	var $clientePfIdClientePf;
	var $formacao;
	var $curso;
	var $instituicao;
	var $obs;
	var $finalizado;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idFormacaoPerfil = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> formacao = "NULL";
		$this -> curso = "NULL";
		$this -> instituicao = "NULL";
		$this -> obs = "NULL";
		$this -> finalizado = 0;

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdFormacaoPerfil($value) {
		$this -> idFormacaoPerfil = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFormacao($value) {
		$this -> formacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCurso($value) {
		$this -> curso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInstituicao($value) {
		$this -> instituicao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setFinalizado($value) {
		$this -> finalizado = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addFormacaoperfil() Function
	 */
	function addFormacaoperfil() {
		$sql = "INSERT INTO formacaoPerfil (professor_idProfessor, clientePf_idClientePf, formacao, curso, instituicao, obs, finalizado) VALUES ($this->professorIdProfessor, $this->clientePfIdClientePf, $this->formacao, $this->curso, $this->instituicao, $this->obs, $this->finalizado)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteFormacaoperfil() Function
	 */
	function deleteFormacaoperfil() {
		$sql = "DELETE FROM formacaoPerfil WHERE idFormacaoPerfil = $this->idFormacaoPerfil";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldFormacaoperfil() Function
	 */
	function updateFieldFormacaoperfil($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE formacaoPerfil SET " . $field . " = " . $value . " WHERE idFormacaoPerfil = $this->idFormacaoPerfil";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFormacaoperfil() Function
	 */
	function updateFormacaoperfil() {
		$sql = "UPDATE formacaoPerfil SET professor_idProfessor = $this->professorIdProfessor, clientePf_idClientePf = $this->clientePfIdClientePf, formacao = $this->formacao, curso = $this->curso, instituicao = $this->instituicao, obs = $this->obs, finalizado = $this->finalizado WHERE idFormacaoPerfil = $this->idFormacaoPerfil";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectFormacaoperfil() Function
	 */
	function selectFormacaoperfil($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idFormacaoPerfil, professor_idProfessor, clientePf_idClientePf, formacao, curso, instituicao, obs, finalizado FROM formacaoPerfil " . $where;
		return $this -> executeQuery($sql);
	}

	function selectFormacaoperfilTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "",$mobile) {
		
		$CertificadoCurso = new CertificadoCurso();
		$Escola = new Escola();

		$sql = " SELECT idFormacaoPerfil, professor_idProfessor, clientePf_idClientePf, formacao, curso, instituicao, obs, finalizado 
		FROM formacaoPerfil " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
				if ($mobile != 1) {

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/formacaoPerfil.php?id=" . $valor['idFormacaoPerfil'] . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "form/formacaoPerfil.php?id=" . $valor['idFormacaoPerfil'] . "', '$caminhoAtualizar', '$ondeAtualiza');\" ";
					
					
				}
				$html .= "<tr>
				
				<td $onclick >" . $CertificadoCurso->getNome($valor['formacao']) . "</td>
				
				<td $onclick >" . $CertificadoCurso->getNome($valor['curso']) . "</td>
				
				<td $onclick >" . $Escola->getNome($valor['instituicao']) . "</td>
				
				<td $onclick >" . $valor['obs'] . "</td>
				
				<td $onclick >" . Uteis::exibirStatus($valor['finalizado']). "</td>
				
				<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/formacaoPerfil.php', " . $valor['idFormacaoPerfil'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";
			}
		}

		return $html;
	}

}
?>