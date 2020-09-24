<?php
class VivenciaProfessor extends Database {
	// class attributes
	var $idVivenciaProfessor;
	var $paisIdPais;
	var $professorIdProfessor;
	var $obs;
	var $dataPartida;
	var $dataRetorno;
	var $atividade;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idVivenciaProfessor = "NULL";
		$this -> paisIdPais = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> obs = "NULL";
		$this -> dataPartida = "NULL";
		$this -> dataRetorno = "NULL";
		$this -> atividade = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdVivenciaProfessor($value) {
		$this -> idVivenciaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPaisIdPais($value) {
		$this -> paisIdPais = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setDataPartida($value) {
		$this -> dataPartida = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setDataRetorno($value) {
		$this -> dataRetorno = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setAtividade($value) {
		$this -> atividade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addVivenciaProfessor() Function
	 */
	function addVivenciaProfessor() {
		$sql = "INSERT INTO vivenciaProfessor (pais_idPais, professor_idProfessor, obs, dataPartida, dataRetorno, atividade) VALUES ($this->paisIdPais, $this->professorIdProfessor, $this->obs, $this->dataPartida, $this->dataRetorno, $this->atividade)";
//		echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteVivenciaProfessor() Function
	 */
	function deleteVivenciaProfessor() {
		$sql = "DELETE FROM vivenciaProfessor WHERE idVivenciaProfessor = $this->idVivenciaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldVivenciaProfessor() Function
	 */
	function updateFieldVivenciaProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE vivenciaProfessor SET " . $field . " = " . $value . " WHERE idVivenciaProfessor = $this->idVivenciaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateVivenciaProfessor() Function
	 */
	function updateVivenciaProfessor() {
		$sql = "UPDATE vivenciaProfessor SET pais_idPais = $this->paisIdPais, professor_idProfessor = $this->professorIdProfessor, obs = $this->obs, dataPartida = $this->dataPartida, dataRetorno = $this->dataRetorno, atividade = $this->atividade WHERE idVivenciaProfessor = $this->idVivenciaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectVivenciaProfessor() Function
	 */
	function selectVivenciaProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idVivenciaProfessor, pais_idPais, professor_idProfessor, obs, dataPartida, dataRetorno, atividade FROM vivenciaProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	function selectVivenciaProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "",$mobile) {

		$sql = " SELECT idVivenciaProfessor, pais, professor_idProfessor, obs, dataPartida, dataRetorno, atividade 
		FROM vivenciaProfessor AS VP 
		INNER JOIN pais AS P ON P.idPais = VP.pais_idPais " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
				if ($valor['atividade'] == 1) {
					$atividade = "Turismo";	
				} elseif($valor['atividade'] == 2) {
					$atividade = "Trabalho";
				} elseif($valor['atividade'] == 3) {
					$atividade = "Estudo";
				} elseif($valor['atividade'] == 4) {
					$atividade = "Outras atividades";
				}
				
				
				if ($mobile != 1) {

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/vivenciaProfessor.php?id=" . $valor['idVivenciaProfessor'] . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "form/vivenciaProfessor.php?id=" . $valor['idVivenciaProfessor'] . "', '$ondeAtualiza');\" ";
					
					
				}
				$html .= "<tr>
				
				<td $onclick >" . ($valor['pais']) . "</td>
				
				<td $onclick >" . Uteis::exibirData($valor['dataPartida']) . "</td>
				
				<td $onclick >" . Uteis::exibirData($valor['dataRetorno']) . "</td>
				
				<td $onclick >" . $atividade . "</td>
				
				<td $onclick >" . $valor['obs'] . "</td>
				
				<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/vivenciaProfessor.php', '" . $valor['idVivenciaProfessor'] . "', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";
			}
		}
		return $html;
	}

}
?>