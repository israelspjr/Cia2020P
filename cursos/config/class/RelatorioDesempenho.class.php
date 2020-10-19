<?php
class RelatorioDesempenho extends Database {
	// class attributes
	var $idRelatorioDesempenho;
	var $integranteGrupoIdIntegranteGrupo;
	var $acompanhamentoCursoIdAcompanhamentoCurso;
	var $itenRelatorioDesempenhoIdItenRelatorioDesempenho;
	var $nota;
	var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idRelatorioDesempenho = "NULL";
		$this -> integranteGrupoIdIntegranteGrupo = "NULL";
		$this -> acompanhamentoCursoIdAcompanhamentoCurso = "NULL";
		$this -> itenRelatorioDesempenhoIdItenRelatorioDesempenho = "NULL";
		$this -> nota = "NULL";
		$this -> obs = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdRelatorioDesempenho($value) {
		$this -> idRelatorioDesempenho = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIntegranteGrupoIdIntegranteGrupo($value) {
		$this -> integranteGrupoIdIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAcompanhamentoCursoIdAcompanhamentoCurso($value) {
		$this -> acompanhamentoCursoIdAcompanhamentoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setItenRelatorioDesempenhoIdItenRelatorioDesempenho($value) {
		$this -> itenRelatorioDesempenhoIdItenRelatorioDesempenho = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNota($value) {
		$this -> nota = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addRelatorioDesempenho() Function
	 */
	function addRelatorioDesempenho() {
		$sql = "INSERT INTO relatorioDesempenho (integranteGrupo_idIntegranteGrupo, acompanhamentoCurso_idAcompanhamentoCurso, itenRelatorioDesempenho_idItenRelatorioDesempenho, nota, obs) VALUES ($this->integranteGrupoIdIntegranteGrupo, $this->acompanhamentoCursoIdAcompanhamentoCurso, $this->itenRelatorioDesempenhoIdItenRelatorioDesempenho, $this->nota, $this->obs)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteRelatorioDesempenho() Function
	 */
	function deleteRelatorioDesempenho() {
		$sql = "DELETE FROM relatorioDesempenho WHERE idRelatorioDesempenho = $this->idRelatorioDesempenho";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldRelatorioDesempenho() Function
	 */
	function updateFieldRelatorioDesempenho($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE relatorioDesempenho SET " . $field . " = " . $value . " WHERE idRelatorioDesempenho = $this->idRelatorioDesempenho";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateRelatorioDesempenho() Function
	 */
	function updateRelatorioDesempenho() {
		$sql = "UPDATE relatorioDesempenho SET integranteGrupo_idIntegranteGrupo = $this->integranteGrupoIdIntegranteGrupo, acompanhamentoCurso_idAcompanhamentoCurso = $this->acompanhamentoCursoIdAcompanhamentoCurso, itenRelatorioDesempenho_idItenRelatorioDesempenho = $this->itenRelatorioDesempenhoIdItenRelatorioDesempenho, nota = $this->nota, obs = $this->obs WHERE idRelatorioDesempenho = $this->idRelatorioDesempenho";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectRelatorioDesempenho() Function
	 */
	function selectRelatorioDesempenho($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idRelatorioDesempenho, integranteGrupo_idIntegranteGrupo, acompanhamentoCurso_idAcompanhamentoCurso, itenRelatorioDesempenho_idItenRelatorioDesempenho, nota, obs FROM relatorioDesempenho " . $where;
		//echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectRelatorioDesempenhoTr($where = "", $idAcompanhamentoCurso, $idIntegranteGrupo, $mes, $Sonota, $mediaFinal,$idFolhaFrequencia, $somedia) {

		$sql = "SELECT SQL_CACHE idTipoItenRelatorioDesempenho, nome 
			FROM tipoItenRelatorioDesempenho 
			WHERE inativo = 0 AND (avaliacao = $mes or reavaliacao = $mes)";
	//		Uteis::pr( $sql);
		$result = $this -> query($sql);
		$xy =0;
		$html2 = array();
		
		if (mysqli_num_rows($result) > 0) {

			$AcompanhamentoCurso = new AcompanhamentoCurso();

			while ($valor = mysqli_fetch_array($result)) {

				$idTipoItenRelatorioDesempenho = $valor['idTipoItenRelatorioDesempenho'];
				$nomeItem = $valor['nome'];
                
                
				$html .= "<p>" . ($nomeItem) . "</p>";
               
				$sql = "SELECT SQL_CACHE idItenRelatorioDesempenho, nome, orientacao FROM itenRelatorioDesempenho 
					WHERE inativo = 0 AND tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho = $idTipoItenRelatorioDesempenho";
	//			Uteis::pr($sql);
				$result2 = $this -> query($sql);
				
			//	$nota = 0;			
				while ($valor2 = mysqli_fetch_array($result2)) {

					$html .= "<div>";
                    
					$idItenRelatorioDesempenho = $valor2['idItenRelatorioDesempenho'];
					$nome = $valor2['nome'];

					$sql = "SELECT SQL_CACHE idRelatorioDesempenho, integranteGrupo_idIntegranteGrupo, itenRelatorioDesempenho_idItenRelatorioDesempenho, nota, obs 
						FROM relatorioDesempenho 
						WHERE itenRelatorioDesempenho_idItenRelatorioDesempenho = " . $idItenRelatorioDesempenho . " " . $where;
						
			//		Uteis::pr($sql);
					$valorNota = mysqli_fetch_array($this -> query($sql));
					
					if ($Sonota == 1) {
					
					$nota .= "[".$valorNota['nota']."] ";
					
					} else {
					$nota = $valorNota['nota'];	
					
					}
					
				/*	if ($mediaFinal == 1) {
						
					$html2[] = $valorNota['nota'];		
						
						
					}*/
					
					$totalNota += $valorNota['nota'];
					
					if ($valorNota['nota'] > 0 ) {
					$xy++;
					}
					 
					$mostrarAcoes = $AcompanhamentoCurso -> verificaPodeEditar($idAcompanhamentoCurso);
                    $obs = $valorNota['obs'];
                    $orientacao = $valor2['orientacao'];
                     if($orientacao!=""):
                        $html .= "<hr>".$orientacao;
                    endif;
					if ($mostrarAcoes) {

						$idRelatorioDesempenho = $valorNota['idRelatorioDesempenho'];

						$nomeCampo = $idIntegranteGrupo . "_" . $idItenRelatorioDesempenho;

						$options = "";
						for ($n = 0; $n <= 10; $n++) {
							$options .= "<option value=\"$n\" " . ((string)$n === $nota ? "selected" : "") . ">" . ($n ? $n : "N/A") . "</option>";
						}

						$html .= "					
							<form id=\"form_relatorioDesempenho_" . $nomeCampo . "\" 
							class=\"validate rel\" action=\"\" method=\"post\" onsubmit=\"return false\" >
							
								<input name=\"idRelatorioDesempenho\" id=\"idRelatorioDesempenho" . $nomeCampo . "\" 
								type=\"hidden\" value=\"" . $idRelatorioDesempenho . "\" />
								
								<input name=\"idItenRelatorioDesempenho\" type=\"hidden\" value=\"" . $idItenRelatorioDesempenho . "\" /><input name=\"idIntegranteGrupo\" 
								type=\"hidden\" value=\"" . $idIntegranteGrupo . "\" />
								
								<input name=\"idAcompanhamentoCurso\" type=\"hidden\" value=\"" . $idAcompanhamentoCurso . "\" />
								
								<p><label>" . $nome . ":
								<select name=\"nota\" id=\"nota\" >
									<option value=\"\" >Selecione</option>" . $options . "									
								</select><span class=\"placeholder\"></span></label></p>
								<p>
								    <label>Comentário:</label>
								    <textarea id='obs' name='obs' style=\"width:570px; height:130px;\">$obs</textarea>
								</p>
								
								<input name=\"idFolhaFrequencia\" id=\"idFolhaFrequencia\" 
								type=\"hidden\" value=\"" . $idFolhaFrequencia . "\" />
											
							</form>";

					} else {
						$html .= "<div  class=\"tab2\">" . $nome . ": <strong>" . $nota . "</strong></div><br />";
					}

					$html .= "</div>";

				}

			}
		}
		

		if ($xy >0 ) {
			$media1 = ($totalNota / $xy);
			if ($somedia != 1) {
				$html8 = $nota." média: ".$media1; 
			} else {
				$html8 = $media1; 
				
			}
		}
		
		if ($mediaFinal != 1) {
			if ($Sonota != 1) {
		
				return $html;
			} else {
		
				return $nota;
			}
		} else {
		return $html8;
		} 
		
	}
	
	function selectRelatorioDesempenhoTrRel($where = "", $idAcompanhamentoCurso, $idIntegranteGrupo, $mes, $Sonota, $mediaFinal,$idFolhaFrequencia, $somedia, $idClientePf="") {
			$dataAtual = date("Y-mm-d");
			$IntegranteGrupo = new IntegranteGrupo();
			if ($idClientePf >0) {
				$ids = $IntegranteGrupo->getidIntegranteGrupo($idClientePf,"",$dataAtual);
			}
		$sql = "SELECT SQL_CACHE idTipoItenRelatorioDesempenho, nome 
			FROM tipoItenRelatorioDesempenho 
			WHERE inativo = 0 AND (avaliacao = $mes or reavaliacao = $mes)";
	//		Uteis::pr( $sql);
		$result = $this -> query($sql);
		$xy =0;
		$html2 = array();
		$notasSM = array();
		
		if (mysqli_num_rows($result) > 0) {

			$AcompanhamentoCurso = new AcompanhamentoCurso();

			while ($valor = mysqli_fetch_array($result)) {

				$idTipoItenRelatorioDesempenho = $valor['idTipoItenRelatorioDesempenho'];
				$nomeItem = $valor['nome'];
                 
				$html .= "<p>" . ($nomeItem) . "</p>";
               
				$sql = "SELECT SQL_CACHE idItenRelatorioDesempenho, nome, orientacao FROM itenRelatorioDesempenho 
					WHERE inativo = 0 AND tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho = $idTipoItenRelatorioDesempenho";
	//			Uteis::pr($sql);
				$result2 = $this -> query($sql);
				
			//	$nota = 0;			
			
			
				while ($valor2 = mysqli_fetch_array($result2)) {

					$html .= "<div>";
                    
					$idItenRelatorioDesempenho = $valor2['idItenRelatorioDesempenho'];
					$nome = $valor2['nome'];

					$sql = "SELECT SQL_CACHE idRelatorioDesempenho, integranteGrupo_idIntegranteGrupo, itenRelatorioDesempenho_idItenRelatorioDesempenho, nota, obs 
						FROM relatorioDesempenho 
						WHERE itenRelatorioDesempenho_idItenRelatorioDesempenho = " . $idItenRelatorioDesempenho . " " . $where;
						if ($idClientePf != '') {
							$where .= " AND integranteGrupo_idIntegranteGrupo in (".$ids.")";	
						}
	
					$valorNota = mysqli_fetch_array($this -> query($sql));
					
					if ($Sonota == 1) {
					
					$nota .= "[".$valorNota['nota']."] ";
					$notasSM[] = $valorNota['nota'];
					
					} else {
					$nota = $valorNota['nota'];	
					
					}
					
					$totalNota += $valorNota['nota'];
					
					if ($valorNota['nota'] > 0 ) {
					$xy++;
					}
					 
					$mostrarAcoes = $AcompanhamentoCurso -> verificaPodeEditar($idAcompanhamentoCurso);
                    $obs = $valorNota['obs'];
                    $orientacao = $valor2['orientacao'];
                     if($orientacao!=""):
                        $html .= "<hr>".$orientacao;
                    endif;
					if ($mostrarAcoes) {

						$idRelatorioDesempenho = $valorNota['idRelatorioDesempenho'];

						$nomeCampo = $idIntegranteGrupo . "_" . $idItenRelatorioDesempenho;

						$options = "";
						for ($n = 0; $n <= 10; $n++) {
							$options .= "<option value=\"$n\" " . ((string)$n === $nota ? "selected" : "") . ">" . ($n ? $n : "N/A") . "</option>";
						}

						$html .= "					
							<form id=\"form_relatorioDesempenho_" . $nomeCampo . "\" 
							class=\"validate rel\" action=\"\" method=\"post\" onsubmit=\"return false\" >
							
								<input name=\"idRelatorioDesempenho\" id=\"idRelatorioDesempenho" . $nomeCampo . "\" 
								type=\"hidden\" value=\"" . $idRelatorioDesempenho . "\" />
								
								<input name=\"idItenRelatorioDesempenho\" type=\"hidden\" value=\"" . $idItenRelatorioDesempenho . "\" /><input name=\"idIntegranteGrupo\" 
								type=\"hidden\" value=\"" . $idIntegranteGrupo . "\" />
								
								<input name=\"idAcompanhamentoCurso\" type=\"hidden\" value=\"" . $idAcompanhamentoCurso . "\" />
								
								<p><label>" . $nome . ":
								<select name=\"nota\" id=\"nota\" >
									<option value=\"\" >Selecione</option>" . $options . "									
								</select><span class=\"placeholder\"></span></label></p>
								<p>
								    <label>Comentário:</label>
								    <textarea id='obs' name='obs' style=\"width:570px; height:130px;\">$obs</textarea>
								</p>

								
								<input name=\"idFolhaFrequencia\" id=\"idFolhaFrequencia\" 
								type=\"hidden\" value=\"" . $idFolhaFrequencia . "\" />
											
							</form>";

					} else {
						$html .= "<div  class=\"tab2\">" . $nome . ": <strong>" . $nota . "</strong></div><br />";
					}

					$html .= "</div>";

				}

			}
		}

	return $notasSM;	
	}
	
	
	
	function selectRelatorioDesempenhoTrObs($where = "", $idAcompanhamentoCurso, $idIntegranteGrupo, $mes) {
	
		$sql = "SELECT SQL_CACHE idTipoItenRelatorioDesempenho, nome 
			FROM tipoItenRelatorioDesempenho 
			WHERE inativo = 0 AND (avaliacao = $mes or reavaliacao = $mes)";
	//		Uteis::pr( $sql);
		$result = $this -> query($sql);
	//	$xy =0;
	//	$html2 = array();
		
		if (mysqli_num_rows($result) > 0) {

			$AcompanhamentoCurso = new AcompanhamentoCurso();

			while ($valor = mysqli_fetch_array($result)) {

				$idTipoItenRelatorioDesempenho = $valor['idTipoItenRelatorioDesempenho'];
	             
				$sql = "SELECT SQL_CACHE idItenRelatorioDesempenho, nome, orientacao FROM itenRelatorioDesempenho 
					WHERE inativo = 0 AND tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho = $idTipoItenRelatorioDesempenho";

				$result2 = $this -> query($sql);
				
		
				while ($valor2 = mysqli_fetch_array($result2)) {

		//			$html .= "<div>";
                    
					$idItenRelatorioDesempenho = $valor2['idItenRelatorioDesempenho'];
		//			$nome = $valor2['nome'];

					$sql = "SELECT SQL_CACHE idRelatorioDesempenho, integranteGrupo_idIntegranteGrupo, itenRelatorioDesempenho_idItenRelatorioDesempenho, nota, obs 
						FROM relatorioDesempenho 
						WHERE itenRelatorioDesempenho_idItenRelatorioDesempenho = " . $idItenRelatorioDesempenho . " " . $where;
		
						$valorNota = mysqli_fetch_array($this -> query($sql));
					
									
	             $obs .= "<p>".$valorNota['obs']."</p>";
	     		}
				
			}
			
		}
		return $obs;
		
	}
	

	/**
	 * selectRelatorioDesempenhoSelect() Function
	 */
	function selectRelatorioDesempenhoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idRelatorioDesempenho, integranteGrupo_idIntegranteGrupo, acompanhamentoCurso_idAcompanhamentoCurso, itenRelatorioDesempenho_idItenRelatorioDesempenho, nota, obs FROM relatorioDesempenho " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idRelatorioDesempenho\" name=\"idRelatorioDesempenho\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idRelatorioDesempenho'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idRelatorioDesempenho'] . "\">" . ($valor['idRelatorioDesempenho']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>