<?php
class FeedbackProfessor extends Database {
	// class attributes
	var $idFeedbackProfessor;
	var $professorIdProfessor;
	var $anexo;
	var $obs;
	var $dataAvaliada;
	var $grupoIdGrupo;
	var $status;
	var $quemAssistiu;
	var $status2;
	var $professorIdAssistido;
	var $pergunta1;
	var $pergunta2;
	var $pergunta3;
	var $pergunta4;
	var $pergunta5;
	var $pergunta6;
	var $pergunta7;
	var $pergunta8;
	var $pergunta9;
	var $pergunta10;
	var $pergunta11;
	var $pergunta12;
	var $pergunta13;		

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idFeedbackProfessor = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> anexo = "NULL";
		$this -> obs = "NULL";
		$this -> dataAvaliada = "NULL";
		$this -> grupoIdGrupo = "NULL";
		$this -> status = "NULL";
		$this -> quemAssistiu = "NULL";
		$this -> status2 = "NULL";
		$this -> professorIdAssistido = "NULL";
		$this -> pergunta1 = "NULL";
		$this -> pergunta2 = "NULL";
		$this -> pergunta3 = "NULL";
		$this -> pergunta4 = "NULL";		
		$this -> pergunta5 = "NULL";
		$this -> pergunta6 = "NULL";
		$this -> pergunta7 = "NULL";
		$this -> pergunta8 = "NULL";		
		$this -> pergunta9 = "NULL";
		$this -> pergunta10 = "NULL";
		$this -> pergunta11 = "NULL";
		$this -> pergunta12 = "NULL";		
		$this -> pergunta13 = "NULL";		

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdFeedbackProfessor($value) {
		$this -> idFeedbackProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAnexo($value) {
		$this -> anexo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataAvaliada($value) {
		$this -> dataAvaliada = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setGrupoIdGrupo($value) {
		$this -> grupoIdGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setStatus($value) {
		$this -> status = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setStatus2($value) {
		$this -> status2 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setQuemAssistiu($value) {
		$this -> quemAssistiu = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setProfessorIdAssistido($value) {
		$this -> professorIdAssistido = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPergunta1($value) {
		$this -> pergunta1 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPergunta2($value) {
		$this -> pergunta2 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPergunta3($value) {
		$this -> pergunta3 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPergunta4($value) {
		$this -> pergunta4 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPergunta5($value) {
		$this -> pergunta5 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPergunta6($value) {
		$this -> pergunta6 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPergunta7($value) {
		$this -> pergunta7 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPergunta8($value) {
		$this -> pergunta8 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPergunta9($value) {
		$this -> pergunta9 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPergunta10($value) {
		$this -> pergunta10 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPergunta11($value) {
		$this -> pergunta11 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPergunta12($value) {
		$this -> pergunta12 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPergunta13($value) {
		$this -> pergunta13 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	

	/**
	 * addFeedbackProfessor() Function
	 */
	function addFeedbackProfessor() {
		$sql = "INSERT INTO feedbackProfessor (professor_idProfessor, anexo, obs, dataAvaliada, grupo_idGrupo, status, quemAssistiu, status2, professor_idAssistido, pergunta1, pergunta2, pergunta3, pergunta4, pergunta5, pergunta6, pergunta7, pergunta8, pergunta9, pergunta10, pergunta11, pergunta12, pergunta13 ) VALUES ($this->professorIdProfessor, $this->anexo, $this->obs, $this->dataAvaliada, $this->grupoIdGrupo, $this->status, $this->quemAssistiu, $this->status2, $this->professorIdAssistido, $this->pergunta1, $this->pergunta2, $this->pergunta3, $this->pergunta4, $this->pergunta5, $this->pergunta6, $this->pergunta7, $this->pergunta8, $this->pergunta9, $this->pergunta10, $this->pergunta11, $this->pergunta12, $this->pergunta13)";
//		echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteFeedbackProfessor() Function
	 */
	function deleteFeedbackProfessor() {
		$sql = "DELETE FROM feedbackProfessor WHERE idFeedbackProfessor = $this->idFeedbackProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldFeedbackProfessor() Function
	 */
	function updateFieldFeedbackProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE feedbackProfessor SET " . $field . " = " . $value . " WHERE idFeedbackProfessor = $this->idFeedbackProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFeedbackProfessor() Function
	 */
	function updateFeedbackProfessor() {
		$sql = "UPDATE feedbackProfessor SET professor_idProfessor = $this->professorIdProfessor, anexo = $this->anexo, obs = $this->obs, dataAvaliada = $this->dataAvaliada, grupo_idGrupo = $this->grupoIdGrupo, status = $this->status, quemAssistiu = $this->quemAssistiu, status2 = $this->status2, professor_idAssistido = $this->professorIdAssistido, pergunta1 = $this->pergunta1, pergunta2 = $this->pergunta2, pergunta3 = $this->pergunta3, pergunta4 = $this->pergunta4, pergunta5 = $this->pergunta5, pergunta6 = $this->pergunta6, pergunta7 = $this->pergunta7, pergunta8 = $this->pergunta8, pergunta9 = $this->pergunta9, pergunta10 = $this->pergunta10, pergunta11 = $this->pergunta11, pergunta12 = $this->pergunta12, pergunta13 = $this->pergunta13 WHERE idFeedbackProfessor = $this->idFeedbackProfessor";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectFeedbackProfessor() Function
	 */
	function selectFeedbackProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idFeedbackProfessor, professor_idProfessor, anexo, obs, dataAvaliada, grupo_idGrupo, status, quemAssistiu, status2, professor_idAssistido, pergunta1, pergunta2, pergunta3, pergunta4, pergunta5, pergunta6, pergunta7, pergunta8, pergunta9, pergunta10, pergunta11, pergunta12, pergunta13 FROM feedbackProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectFeedbackProfessorTr() Function
	 */

	function selectFeedbackProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE idFeedbackProfessor, anexo, obs, dataAvaliada, grupo_idGrupo, status, quemAssistiu, status2, professor_idAssistido, pergunta1, pergunta2, pergunta3, pergunta4, pergunta5, pergunta6, pergunta7, pergunta8, pergunta9, pergunta10, pergunta11, pergunta12, pergunta13 FROM feedbackProfessor " . $where;
		$result = $this -> query($sql);
		$Grupo = new Grupo();
		$Professor = new Professor();
		
		$NotasTipoNotas = new NotasTipoNota();

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
				$nomeGrupo = $Grupo->getNome($valor['grupo_idGrupo']);
				$status = $valor['status'];
				
	    		$pergunta1 = $valor['pergunta1'];
				$pergunta2 = $valor['pergunta2'];
				$pergunta3 = $valor['pergunta3'];
				$pergunta4 = $valor['pergunta4'];
				$pergunta5 = $valor['pergunta5'];
				$pergunta6 = $valor['pergunta6'];
				$pergunta7 = $valor['pergunta7'];
				$pergunta8 = $valor['pergunta8'];
				$pergunta9 = $valor['pergunta9'];
				$pergunta10 = $valor['pergunta10'];
				$pergunta11 = $valor['pergunta11'];
				$pergunta12 = $valor['pergunta12'];
				$pergunta13 = $valor['pergunta13'];

				
				
				$idProfessor = $valor['quemAssistiu'];
				
				if (is_numeric($idProfessor)) {
						$nomeProfessor = "<font color=\"blue\">".$Professor->getNome($idProfessor)."</font>";
				} else {
						$nomeProfessor = $idProfessor;	
				}
				
				if ($status == 1) {
					$img = "<img src=\"".CAMINHO_IMG."excelente.png\" title=\" Aula excelente\" />";
					
				} elseif ($status == 2) {
					$img = "<img src=\"".CAMINHO_IMG."boa.png\" title=\"Aula Boa, mas pode ser melhor\"/>";
					
				} elseif ($status == 3) {
					$img = "<img src=\"".CAMINHO_IMG."regular.png\" title=\"Aula Regular, muitos pontos a melhorar (vetar professor)\"/>"; 
					
				} elseif ($status == 4) {
					$img = "<img src=\"".CAMINHO_IMG."ruim.png\" title=\"Aula Ruim (vetar professor e verificar trocas)\"/>"; 
					
				}
				

				$html .= "<tr>";
			$html .= "	
				<td align=\"center\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idFeedbackProfessor'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . Uteis::exibirData($valor['dataAvaliada']) . "</td>
				
				<td align=\"center\"> ".$nomeGrupo."</td>
				<td align=\"center\">".$img."</td>
				<td align=\"center\"> ".$valor['status2']."</td>
				<td align=\"center\">".$nomeProfessor."</td>";
			/*	<td align=\"center\">".$valor['obs']."</td>";
			/*	<td>".$pergunta1."</td>
				<td>".$pergunta2."</td>
				<td>".$pergunta3."</td>
				<td>".$pergunta4."</td>
				<td>".$pergunta5."</td>
				<td>".$pergunta6."</td>
				<td>".$pergunta7."</td>
				<td>".$pergunta8."</td>
	     		<td>".$pergunta9."</td>
				<td>".$pergunta10."</td>
				<td>".$pergunta11."</td>
				<td>".$pergunta12."</td>
				<td>".$pergunta13."</td>*/
		
				
			$html .= "	<td align=\"center\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"deletaRegistro('" . CAMINHO_CAD . "professor/include/acao/feedbackProfessor.php', " . $valor['idFeedbackProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\" ></center>
				</td>
				
				</tr>";

			}
		}

		return $html;
	}
	
	function selectFeedbackProfessorTrProfessor($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE idFeedbackProfessor, anexo, obs, dataAvaliada, grupo_idGrupo, status, quemAssistiu, status2, professor_idAssistido, pergunta1, pergunta2, pergunta3, pergunta4, pergunta5, pergunta6, pergunta7, pergunta8 FROM feedbackProfessor " . $where;
	//	echo $sql;
		$result = $this -> query($sql);
		$Grupo = new Grupo();
		$Professor = new Professor();
		
		$NotasTipoNotas = new NotasTipoNota();

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
				$nomeGrupo = $Grupo->getNome($valor['grupo_idGrupo']);
				$status = $valor['status'];
				$nomeAssistido = $Professor->getNome($valor['professor_idAssistido']);
				
				$pergunta1 = $valor['pergunta1'];
				$pergunta2 = $valor['pergunta2'];
				$pergunta3 = $valor['pergunta3'];
				$pergunta4 = $valor['pergunta4'];
				$pergunta5 = $valor['pergunta5'];
				$pergunta6 = $valor['pergunta6'];
				$pergunta7 = $valor['pergunta7'];
				$pergunta8 = $valor['pergunta8'];
	        	$pergunta9 = $valor['pergunta9'];
				$pergunta10 = $valor['pergunta10'];
				$pergunta11 = $valor['pergunta11'];
				$pergunta12 = $valor['pergunta12'];
				$pergunta13 = $valor['pergunta13'];
		
				if ($status == 1) {
					$img = "<img src=\"".CAMINHO_IMG."excelente.png\" title=\" Aula excelente\" />";
					
				} elseif ($status == 2) {
					$img = "<img src=\"".CAMINHO_IMG."boa.png\" title=\"Aula Boa, mas pode ser melhor\"/>";
					
				} elseif ($status == 3) {
					$img = "<img src=\"".CAMINHO_IMG."regular.png\" title=\"Aula Regular, muitos pontos a melhorar (vetar professor)\"/>"; 
					
				} elseif ($status == 4) {
					$img = "<img src=\"".CAMINHO_IMG."ruim.png\" title=\"Aula Ruim (vetar professor e verificar trocas)\"/>"; 
					
				}
				
// onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "?id=" . $valor['idFeedbackProfessor'] . $idPai . "', '#centro')\"
				$html .= "<tr>";
				$html .= "<td align=\"center\"  >" . Uteis::exibirData($valor['dataAvaliada']) . "</td>
				
				<td align=\"center\"> ".$nomeGrupo."</td>
				<td align=\"center\">".$img."</td>
				<td align=\"center\"> ".$valor['status2']."</td>
				<td align=\"center\">".$nomeAssistido."</td>";
			/*	<td align=\"center\">".$valor['obs']."</td>";
				<td>".$pergunta1."</td>
				<td>".$pergunta2."</td>
				<td>".$pergunta3."</td>
				<td>".$pergunta4."</td>
				<td>".$pergunta5."</td>
				<td>".$pergunta6."</td>
				<td>".$pergunta7."</td>
				<td>".$pergunta8."</td>
	     		<td>".$pergunta9."</td>
				<td>".$pergunta10."</td>
				<td>".$pergunta11."</td>
				<td>".$pergunta12."</td>
				<td>".$pergunta13."</td>*/
		
			$html .= "	<td align=\"center\">
			<center><img src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"deletaRegistro('modulos/aulas/acao.php', " . $valor['idFeedbackProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza');zerarCentro();carregarModulo('/cursos/portais/modulos/aulas/index.php', '#centro');\" ></center>
				</td>
				
				</tr>";

			}
		}

		return $html;
	}
	

}
?>

