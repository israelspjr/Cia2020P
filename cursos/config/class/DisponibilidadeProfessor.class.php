<?php
class DisponibilidadeProfessor extends Database {
	// class attributes
	var $idDisponibilidade;
	var $professorIdProfessor;
	var $statusAgendaIdStatusAgenda;
	var $horaInicio;
	var $horaFim;
	var $diaSemana;
	var $obs;
	var $dataDisponibilidade;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDisponibilidade = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> statusAgendaIdStatusAgenda = "NULL";
		$this -> horaInicio = "NULL";
		$this -> horaFim = "NULL";
		$this -> diaSemana = "NULL";
		$this -> obs = "NULL";
		$this -> dataDisponibilidade = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDisponibilidade($value) {
		$this -> idDisponibilidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setStatusAgendaIdStatusAgenda($value) {
		$this -> statusAgendaIdStatusAgenda = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHoraInicio($value) {
		$this -> horaInicio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHoraFim($value) {
		$this -> horaFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setexibirDiaSemana($value) {
		$this -> diaSemana = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setDataDisponibilidade($value) {
//		$this -> dataDisponibilidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addDisponibilidadeProfessor() Function
	 */
	function addDisponibilidadeProfessor() {
		$sql = "INSERT INTO disponibilidadeProfessor (professor_idProfessor, statusAgenda_idStatusAgenda, horaInicio, horaFim, diaSemana, obs, dataDisponibilidade) VALUES ($this->professorIdProfessor, $this->statusAgendaIdStatusAgenda, $this->horaInicio, $this->horaFim, $this->diaSemana, $this->obs, $this->dataDisponibilidade)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteDisponibilidadeProfessor() Function
	 */
	function deleteDisponibilidadeProfessor() {
		$sql = "DELETE FROM disponibilidadeProfessor WHERE idDisponibilidade = $this->idDisponibilidade";
		$result = $this -> query($sql, true);
	}
	
	function deleteDisponibilidadeProfessorTotal($professor_idProfessor, $and) {
		if ($professor_idProfessor != null) 
		$sql = "DELETE FROM disponibilidadeProfessor WHERE professor_idProfessor = ".$professor_idProfessor. $and;
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDisponibilidadeProfessor() Function
	 */
	function updateFieldDisponibilidadeProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE disponibilidadeProfessor SET " . $field . " = " . $value . " WHERE idDisponibilidade = $this->idDisponibilidade";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDisponibilidadeProfessor() Function
	 */
	function updateDisponibilidadeProfessor() {
		$sql = "UPDATE disponibilidadeProfessor SET professor_idProfessor = $this->professorIdProfessor, statusAgenda_idStatusAgenda = $this->statusAgendaIdStatusAgenda, horaInicio = $this->horaInicio, horaFim = $this->horaFim, diaSemana = $this->diaSemana, obs = $this->obs, dataDisponibilidade = $this->dataDisponibilidade WHERE idDisponibilidade = $this->idDisponibilidade";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDisponibilidadeProfessor() Function
	 */
	function selectDisponibilidadeProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDisponibilidade, professor_idProfessor, statusAgenda_idStatusAgenda, horaInicio, horaFim, diaSemana, obs, dataDisponibilidade FROM disponibilidadeProfessor " . $where;
		//echo "1 - $sql // ";
		return $this -> executeQuery($sql);
	}

	function selectDisponibilidadeProfessorTr($caminhoAbrir, $caminhoAtualizar, $onde, $idProfessor,$mobile) {

		$html .= "<tr>";

		$html .= "<td align=\"center\" width=\"9%\">";
		for ($hora = 6; $hora < 22; $hora++) {
			$html .= "<div style=\"height:30px;\" ><strong>" . Uteis::exibirHoras($hora * 60) . "</strong></div>";
		}
		$html .= "</td>";

		//MINUTOS DO DIA PERMITIDO CADASTRAR (DAS 06:00 AS 22:00)
		for ($diaSemana = 1; $diaSemana <= 7; $diaSemana++) {
			if ($mobile != 1) {
			$deletaDia = " onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/disponibilidadeProfessorDia.php?diaSemana=" . $diaSemana . "&idProfessor=" . $idProfessor . "', '" . $idProfessor . "', '$caminhoAtualizar', '#div_disponibilidade_professor');\" ";
			} else {
			$deletaDia = " onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/disponibilidadeProfessorDia.php?diaSemana=" . $diaSemana . "&idProfessor=" . $idProfessor . "', '" . $idProfessor . "', '$caminhoAtualizar', '#centro');\" ";				
				
			}
			
			$html .= "<td width=\"13%\"><img src=\"/cursos/images/excluir.png\" title=\"Excluir as disponibilidades neste dia\" ".$deletaDia."/>";

			$sql = "SELECT SQL_CACHE idDisponibilidade, professor_idProfessor, statusAgenda_idStatusAgenda, horaInicio, horaFim, diaSemana, obs, dataDisponibilidade 
			FROM disponibilidadeProfessor 
			WHERE diaSemana = $diaSemana AND professor_idProfessor = $idProfessor ORDER BY horaInicio ";
			$result = $this -> query($sql);

			$pxIni = 180;

			if ($result) {
				while ($valor = mysqli_fetch_array($result)) {
					
			//Grupos
			$MesAnterior = date('Y-m-01');

			$sql1 = " SELECT DISTINCT(G.nome) AS grupo, PAG.idPlanoAcaoGrupo, PA.tipoCurso, COALESCE(AP.horaInicio, AF.horaInicio) AS horaInicio, COALESCE(AP.horaFim, AF.horaFim) AS horaFim 
					,COALESCE(AP.diaSemana, (DATE_FORMAT(AF.dataAula, '%w'))) AS diaSemana FROM professor AS P 
				INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
				LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
				LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
				INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND 
					(PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
				INNER JOIN planoAcao AS PA on PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao	
				INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo AND G.inativo = 0 
				WHERE diaSemana = $diaSemana AND (AP.horaInicio between ".$valor['horaInicio']."
                AND  ". $valor['horaFim'].")  AND P.idProfessor = " . $idProfessor."
                AND (AGP.dataFim is null or AGP.dataFim >= '".$MesAnterior."')";

	//	Uteis::pr( $sql1);
			$rsGrupos = Uteis::executarQuery($sql1);
			
	//		Uteis::pr($rsGrupos);

					$idDisponibilidade = $valor['idDisponibilidade'];
					$idProfessor = $valor['professor_idProfessor'];
					$idStatusAgenda = $valor['statusAgenda_idStatusAgenda'];
					if ($idStatusAgenda == 1) {
						$classStatus = "background-color:#FF0000;color:white;"; //"disponibilidadeIndisponivel";
					} elseif ($idStatusAgenda == 2) {
						$classStatus = "background-color:#00FF00;color:white;"; //"disponibilidadeDisponivel";
					} elseif ($idStatusAgenda == 3) {
						$classStatus = "background-color:#660000;color:white;"; //disponibilidadeOnline";
					} elseif ($idStatusAgenda == 4) {
						$classStatus = "background-color:#0000FF;color:white;"; //"disponibilidadeTotal";
					}
					
					$horaInicio = $valor['horaInicio'] / 2;
					$horaFim = $valor['horaFim'] / 2;
					$duracao = $horaFim - $horaInicio;
					$obs = $valor['obs'];
					$dataDisponibilidade = "Atualizado em: ".Uteis::exibirData($valor['dataDisponibilidade']);
					$grupo = $rsGrupos[0]['grupo'];
				//	echo $grupo;

					if ($pxIni < $horaInicio) {

						$dif = $horaInicio - $pxIni;
						
						if ($mobile != 1) {

						$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/disponibilidadeProfessor.php?horaInicio=" . ($pxIni * 2) . "&horaFim=" . ($horaInicio * 2) . "&diaSemana=" . $diaSemana . "&idProfessor=" . $idProfessor . "', '$caminhoAtualizar', '#div_disponibilidade_professor');\" ";
						} else {
						$onclick = " onclick=\"zerarCentro();carrregarModulo('" . $caminhoAbrir . "form/disponibilidadeProfessor.php?horaInicio=" . ($pxIni * 2) . "&horaFim=" . ($horaInicio * 2) . "&diaSemana=" . $diaSemana . "&idProfessor=" . $idProfessor . "',  '#centro');\" ";
						
							
						}
						$html .= "<div $onclick style=\"height:" . str_replace(",", ".", $dif) . "px;cursor:pointer;\" title=\"Completar disponibilidade\" ></div>";

						$pxIni += $dif;
					}
					if ($mobile != 1) {
					$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/disponibilidadeProfessor.php?id=" . $idDisponibilidade . "', '$caminhoAtualizar', '#div_disponibilidade_professor');\" ";
					} else {
					$onclick = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "form/disponibilidadeProfessor.php?id=" . $idDisponibilidade . "',  '#centro');\" ";
					
						
					}
					$html .= "<div $onclick style=\"".$classStatus."height:" . str_replace(",", ".", $duracao) . "px;\" title=\"" . $obs . "\" >";
					
					$pxIni += $duracao;

					$html .= "<div style=\"" . $classStatus . "\" title=\"". $dataDisponibilidade."\" class=\"2\"\">";
					$html .= "das " . Uteis::exibirHoras($horaInicio * 2) . " às " . Uteis::exibirHoras($horaFim * 2);
					if ($mobile != 1) {
					$onclick = " onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/disponibilidadeProfessor.php', '" . $idDisponibilidade . "', '$caminhoAtualizar', '#div_disponibilidade_professor')\" ";
					} else {
					$onclick = " onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/disponibilidadeProfessor.php', '" . $idDisponibilidade . "', '$caminhoAtualizar', '#centro')\" ";
					
					}
					$html .= "<a $onclick style=\"float:right\">x&nbsp;</a>";
					$html .= "</div>";

                    $grupoInicio = Uteis::exibirHoras($rsGrupos[0]['horaInicio']);
                    $grupoFim = Uteis::exibirHoras($rsGrupos[0]['horaFim']);
                    if ( (strlen($grupo)>2)){
						if ($rsGrupos[0]['tipoCurso'] == 0) {
						$color = "color:#00FF00;font-weight:bold;";	
						} else {
						$color = "color:#660000;font-weight:bold;";	
						}
					    $html .= "<div style='background: #FFFFBF;".$color."'>{$grupo}";
                        $html .= " ({$grupoInicio} - {$grupoFim})<br></div>";
                    }else{
                        $html .= '<div>&nbsp;</div>';
                    }
			//		$html .= "<div>".."</div>";

					$html .= "</div>";
				}
			}

			if ($pxIni < 660) {
				if ($mobile != 1) {
				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/disponibilidadeProfessor.php?horaInicio=" . ($pxIni * 2) . "&horaFim=1320&diaSemana=" . $diaSemana . "&idProfessor=" . $idProfessor . "', '$caminhoAtualizar', '#div_disponibilidade_professor');\" ";
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "form/disponibilidadeProfessor.php?horaInicio=" . ($pxIni * 2) . "&horaFim=1320&diaSemana=" . $diaSemana . "&idProfessor=" . $idProfessor . "',  '#centro');\" ";
				
					
				}
				$html .= "<div $onclick style=\"height:" . str_replace(",", ".", (660 - $pxIni)) . "px;cursor:pointer;\" title=\"Completar disponibilidade\" ></div>";
			}

			$html .= "</td>";
		}

		$html .= "</tr>";

		return $html;
	}

	function idDisponibilidade_professor($idProfessor, $horaInicio_aula, $horaFim_aula, $diaSemana_aula) {

		$profs = array("0");
		//echo "$horaInicio_aula, $horaFim_aula, $diaSemana_aula";

		$sql = " SELECT professor_idProfessor, horaInicio, horaFim 
		FROM disponibilidadeProfessor 
		WHERE professor_idProfessor IN($idProfessor) AND statusAgenda_idStatusAgenda = 2 AND diaSemana = $diaSemana_aula";
		$rs = $this -> query($sql);
		//echo $sql;

		while ($valor = mysqli_fetch_array($rs)) {

			$professor_idProfessor = $valor['professor_idProfessor'];

			if (!in_array($professor_idProfessor, $profs)) {
				$horaInicio = $valor['horaInicio'];
				$horaFim = $valor['horaFim'];
				if ($horaInicio <= $horaInicio_aula && $horaFim >= $horaFim_aula)
					$profs[] = $professor_idProfessor;
			}
		}

		return implode(",", $profs);

	}
	function VerificarDisponibilidade($idProfessor, $horaInicio_aula, $horaFim_aula, $diaSemana_aula){
			
		$sql = " SELECT professor_idProfessor, horaInicio, horaFim, obs, statusAgenda_idStatusAgenda 
		FROM disponibilidadeProfessor 
		WHERE professor_idProfessor = $idProfessor AND diaSemana = $diaSemana_aula AND horaInicio <= $horaInicio_aula AND horaFim >= $horaFim_aula";
	//	echo $sql;
		
		//exit;
		$rs = $this -> query($sql);
		if(mysqli_num_rows($rs)>0){
		while ($valor = mysqli_fetch_array($rs)) {

			$obs = $valor['obs'];
			
			$statusAgenda_idStatusAgenda = $valor['statusAgenda_idStatusAgenda']; 
			if($statusAgenda_idStatusAgenda>1){				
				$status = "Livre";
			}elseif ($statusAgenda_idStatusAgenda =="") {
				$status = "Disponibilidade não registrada";
			}elseif ($statusAgenda_idStatusAgenda<2){	
				$status = "Ocupado";
				
			}
				
			$horaInicio = $valor['horaInicio'];
			$horaFim = $valor['horaFim'];
			$retorno['obs'] = $obs;
			$retorno['status'] = $status;
			}
		} else{
			$retorno['obs'] = "";
			$retorno['status'] = "Disponibilidade não registrada";
		}
		return $retorno;
}

}
