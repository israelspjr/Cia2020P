<?php
class AcompanhamentoCurso extends Database {

	// class attributes
	var $idAcompanhamentoCurso;
	var $professorIdProfessor;
	var $periodoAcompanhamentoCursoIdPeriodoAcompanhamentoCurso;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $obs;
	var $finalizadoParcial;
	var $finalizadoGeral;
	var $arquivado;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idAcompanhamentoCurso = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> periodoAcompanhamentoCursoIdPeriodoAcompanhamentoCurso = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> obs = "NULL";
		$this -> finalizadoParcial = "NULL";
		$this -> finalizadoGeral = "NULL";
		$this -> arquivado = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdAcompanhamentoCurso($value) {
		$this -> idAcompanhamentoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPeriodoAcompanhamentoCursoIdPeriodoAcompanhamentoCurso($value) {
		$this -> periodoAcompanhamentoCursoIdPeriodoAcompanhamentoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFinalizadoParcial($value) {
		$this -> finalizadoParcial = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFinalizadoGeral($value) {
		$this -> finalizadoGeral = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setArquivado($value) {
		$this -> arquivado = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addAcompanhamentoCurso() Function
	 */
	function addAcompanhamentoCurso() {
		$sql = "INSERT INTO acompanhamentoCurso (professor_idProfessor, periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso, planoAcaoGrupo_idPlanoAcaoGrupo, obs, finalizadoParcial, finalizadoGeral, arquivado) VALUES ($this->professorIdProfessor, $this->periodoAcompanhamentoCursoIdPeriodoAcompanhamentoCurso, $this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->obs, $this->finalizadoParcial, $this->finalizadoGeral, $this->arquivado)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteAcompanhamentoCurso() Function
	 */
	function deleteAcompanhamentoCurso() {
		$sql = "DELETE FROM acompanhamentoCurso WHERE idAcompanhamentoCurso = $this->idAcompanhamentoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldAcompanhamentoCurso() Function
	 */
	function updateFieldAcompanhamentoCurso($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE acompanhamentoCurso SET " . $field . " = " . $value . " WHERE idAcompanhamentoCurso = $this->idAcompanhamentoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateAcompanhamentoCurso() Function
	 */
	function updateAcompanhamentoCurso() {
		$sql = "UPDATE acompanhamentoCurso SET professor_idProfessor = $this->professorIdProfessor, periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso = $this->periodoAcompanhamentoCursoIdPeriodoAcompanhamentoCurso, planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, obs = $this->obs, finalizadoParcial = $this->finalizadoParcial, finalizadoGeral = $this->finalizadoGeral, arquivado = $this->arquivado WHERE idAcompanhamentoCurso = $this->idAcompanhamentoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectAcompanhamentoCurso() Function
	 */
	function selectAcompanhamentoCurso($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idAcompanhamentoCurso, professor_idProfessor, periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso, planoAcaoGrupo_idPlanoAcaoGrupo, obs, finalizadoParcial, finalizadoGeral, arquivado FROM acompanhamentoCurso " . $where;
//		echo  $sql;
		return $this -> executeQuery($sql);
	}

	function selectAcompanhamentoCursoTr_rh($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $mobile) {

		$sql = "SELECT SQL_CACHE A.idAcompanhamentoCurso, P.nome, PE.mes, PE.ano 
			FROM acompanhamentoCurso AS A 
			INNER JOIN professor AS P ON P.idProfessor = A.professor_idProfessor 
			INNER JOIN periodoAcompanhamentoCurso AS PE ON PE.idPeriodoAcompanhamentoCurso = A.periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso" . $where;
	//		echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
				if ($mobile != 1) {

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idAcompanhamentoCurso=" . $valor['idAcompanhamentoCurso'] . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "?idAcompanhamentoCurso=" . $valor['idAcompanhamentoCurso'] . "&mes=".$valor['mes']."',  '#centro')\" ";
				
					
				}

				$html .= "<tr>
								
					<td $onclick >" . $valor['mes'] . "/" . $valor['ano'] . "</td>
					
					<td $onclick >" . $valor['nome'] . "</td>
					
					";

			}

		}
		return $html;
	}
	
	function selectAcompanhamentoCursoTr_aluno($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $mobile, $idClientePf, $excel = false) {
				
		$RelatorioDesempenho = new RelatorioDesempenho();
		$IntegranteGrupo = new IntegranteGrupo();
		$Relatorio = new Relatorio();
		
		$valorI = $IntegranteGrupo->selectIntegranteGrupo( " WHERE clientePf_idClientePf =". $idClientePf);
		
		foreach ($valorI as $int) {
		
		$valorX[] = $int['idIntegranteGrupo'];			
		}
		
		$valorx2 = implode(', ',$valorX);
		
		$idIntegranteGrupo = $valorI[0]['idIntegranteGrupo'];
		
		$sql = "SELECT SQL_CACHE A.idAcompanhamentoCurso, P.nome, PE.mes, PE.ano 
			FROM acompanhamentoCurso AS A 
			INNER JOIN professor AS P ON P.idProfessor = A.professor_idProfessor 
			INNER JOIN periodoAcompanhamentoCurso AS PE ON PE.idPeriodoAcompanhamentoCurso = A.periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso" . $where;
			echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
		/*		if ($mobile != 1) {

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idAcompanhamentoCurso=" . $valor['idAcompanhamentoCurso'] . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "?idAcompanhamentoCurso=" . $valor['idAcompanhamentoCurso'] . "&mes=".$valor['mes']."',  '#centro')\" ";
				
					
				}*/
				
				$idAcompanhamentoCurso = $valor['idAcompanhamentoCurso'];
				
				$nota1 = $RelatorioDesempenho->selectRelatorioDesempenhoTr(" AND acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso." AND integranteGrupo_idIntegranteGrupo in ( ".$valorx2. ")", $idAcompanhamentoCurso, $idIntegranteGrupo, $valor['mes'], 1, 1);
				
				$sql2 = "SELECT SQL_CACHE idTipoItenRelatorioDesempenho, nome 
			FROM tipoItenRelatorioDesempenho 
			WHERE inativo = 0 AND (avaliacao = ".$valor['mes']." or reavaliacao = ".$valor['mes'].")";
			$result2 = Uteis::executarQuery($sql2);
			
			$obs = $result2[0]['nome'];
			
			if ($valor['mes'] < 10) {
				$mes = "0".$valor['mes'];
			} else {
				$mes = $valor['mes'];
			}
	
				$html .= "<tr>
								
					<td $onclick >01/" . $mes . "/" . $valor['ano'] . "</td>
					
					<td $onclick >" . $valor['nome'] . "</td>";
					
				$html .= "	<td $onclick >" . $obs . "</td>";
				
				
$mystring = $nota1;
$findme   = ']';

$texto1 = substr($nota1, 1 , 2);
$texto1 = str_replace(']','',$texto1);

$pos = strripos($mystring, $findme);
$pos = $pos - 2;

$texto2 = substr($nota1, $pos);
$texto2 = str_replace(']','',$texto2);
$texto2 = str_replace('[','',$texto2);
$pos = explode(" ", $texto2);
$texto2 = $pos[0];


			//Observações
			$obsNotas = $RelatorioDesempenho->selectRelatorioDesempenhoTrObs(" AND acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso." AND integranteGrupo_idIntegranteGrupo in ( ".$valorx2. ")", $idAcompanhamentoCurso, $idIntegranteGrupo, $valor['mes']);
			
				
				
				$html .= "<td $onclick >" . $texto1 . "</td>";
				$html .= "<td $onclick >" . $texto2 . "</td>";	
    			$html .= "<td $onclick >" . $obsNotas . "</td>";		
							

			}

		}
		$colunas = array("Período","Professor","Habilidade","Nota", "Atitude", "Observações");
		
		$html_base = $Relatorio -> montaTb($colunas, $excel);

    return $html_base . $html;
	}
	
	

	function selectAcompanhamentoCursoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $idProfessor, $mes_ref, $ano_ref, $idPlanoAcaoGrupo, $podeExcluir = false,$mobile,$idFolhaFrequencia) {
      $sql = " SELECT SQL_CACHE YEAR(dataInicioEstagio) AS anoInicio, MONTH(dataInicioEstagio) AS mesInicio, 
			YEAR(dataPrevisaoTerminoEstagio) AS anoFim, MONTH(dataPrevisaoTerminoEstagio) AS mesFim 
			FROM planoAcaoGrupo WHERE idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo;
		$rsDataIni = mysqli_fetch_array($this -> query($sql));
		//print_r($rsDataIni);
	//	echo $sql;

		$anoInicio = $rsDataIni['anoInicio'];
		$mesInicio = $rsDataIni['mesInicio'];

		$anoFim = $ano_ref;
		$mesFim = $mes_ref;

		$sql = "SELECT SQL_CACHE A.idAcompanhamentoCurso, P.mes, P.ano, PR.nome AS nomeProfessor, P.idPeriodoAcompanhamentoCurso 
			FROM periodoAcompanhamentoCurso AS P  
			LEFT JOIN acompanhamentoCurso AS A ON A.periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso = P.idPeriodoAcompanhamentoCurso 
			LEFT JOIN professor AS PR ON A.professor_idProfessor = PR.idProfessor 
			WHERE ((P.mes = " . $mes_ref . " AND P.ano >= " . $anoInicio . ")) 
			AND ((P.mes = " . $mesFim . " AND P.ano = " . $anoFim . ")) AND A.planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND PR.idProfessor = ".$idProfessor." GROUP BY P.idPeriodoAcompanhamentoCurso ";
		$result = $this -> query($sql);
    //    echo $sql;
        
		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idPeriodoAcompanhamentoCurso = $valor['idPeriodoAcompanhamentoCurso'];
				$idAcompanhamentoCurso = $valor['idAcompanhamentoCurso'];
				$ano = $valor['ano'];
				$mes = $valor['mes'];
/*
				$sql = " SELECT DISTINCT(AG.professor_idProfessor), AG.dataInicio, AG.dataFim, PAG.idPlanoAcaoGrupo, 'AP' AS origem, P.nome AS nomeProfe, P.idProfessor 
					FROM planoAcaoGrupo AS PAG 
					INNER JOIN aulaPermanenteGrupo AS AP ON AP.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo 
					INNER JOIN aulaGrupoProfessor AS AG ON AG.aulaPermanenteGrupo_idAulaPermanenteGrupo = AP.idAulaPermanenteGrupo 
					INNER JOIN professor AS P ON AG.professor_idProfessor = P.idProfessor /*AND P.idProfessor = ".$idProfessor."*/
		/*			WHERE idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . " 
						AND (
							($mes >= MONTH(AG.dataInicio) AND $ano = YEAR(AG.dataInicio)) 
							OR 
							$ano > YEAR(AG.dataInicio)
						)AND (
							($mes <= MONTH(COALESCE(AG.dataFim, CURDATE())) AND $ano = YEAR(COALESCE(AG.dataFim, CURDATE()))) 
							OR 
							$ano < YEAR(COALESCE(AG.dataFim, CURDATE()))
						)				 
					GROUP BY AG.professor_idProfessor, PAG.idPlanoAcaoGrupo
					UNION
					SELECT DISTINCT(AG.professor_idProfessor), AG.dataInicio, AG.dataFim, PAG.idPlanoAcaoGrupo, 'AF' AS origem, P.nome AS nomeProfe, P.idProfessor 
					FROM planoAcaoGrupo AS PAG 
					INNER JOIN aulaDataFixa AS AF ON AF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo 
					INNER JOIN aulaGrupoProfessor AS AG ON AG.aulaDataFixa_idAulaDataFixa = AF.idAulaDataFixa 
					INNER JOIN  professor AS P ON AG.professor_idProfessor = P.idProfessor 
					WHERE MONTH(AG.dataInicio) = " . $mes . " AND YEAR(AG.dataInicio) = " . $ano . " AND idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo." 
					GROUP BY AG.professor_idProfessor, PAG.idPlanoAcaoGrupo
					";
				$resultx = $this -> query($sql); */
				
				$sql = "SELECT DISTINCT
					    P.nome AS nomeProfe,
    					P.idProfessor
							FROM
    					professor AS P
							WHERE
						P.idProfessor = ".$idProfessor."";
						
						$resultx = $this -> query($sql);
				
				
				if (mysqli_num_rows($resultx) > 0) {
					while ($valorx = mysqli_fetch_array($resultx)) {

						$idProfessor = $valorx['idProfessor'];
						$nomeProfe = $valorx['nomeProfe'];
						
						if ($mobile != 1) {

						$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&idProfessor=" . $idProfessor . "&idPeriodoAcompanhamentoCurso=" . $idPeriodoAcompanhamentoCurso . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
						} else {
						$onclick = " onclick=\"zerarNotas();carregarModulo('" . $caminhoAbrir . "?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&idProfessor=" . $idProfessor . "&idPeriodoAcompanhamentoCurso=" . $idPeriodoAcompanhamentoCurso . "&idFolhaFrequencia=".$idFolhaFrequencia."', '$ondeAtualiza')\" ";	
							
						}

						$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND professor_idProfessor = $idProfessor 
							AND periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso = $idPeriodoAcompanhamentoCurso LIMIT 1 ";
						$rsAcomapanhamentoCurso = $this -> selectAcompanhamentoCurso($where);
                        $integrantes = new IntegranteGrupo();
                        $alunos = $integrantes->getidIntegranteGrupo("",$idPlanoAcaoGrupo,$ano_ref."-".$mes_ref."-01");
                        $rsa = explode(",",$alunos);
                        $relatorio = new RelatorioDesempenho();
                        
                        for($i=0;$i<count($rsa);$i++):
                            $rel = $relatorio->selectRelatorioDesempenho(" WHERE acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso." AND integranteGrupo_idIntegranteGrupo = ".$rsa[$i]);    
                            if(count($rel)==2)
                                $finAluno[$rsa[$i]] = "Finalizado";
                            else if(count($rel)>0)
                                $finAluno[$rsa[$i]] = "Parcial";
                            else
                                $finAluno[$rsa[$i]] = "Em aberto";        
                        endfor;	                       
                        foreach($finAluno as $k => $value):
                            if($value == "Finalizado")
                                $finalizado .= "<font color='green'>".$integrantes->getNomePF($k)." - ".$value."</font><br />";
                            else
                                $finalizado .= "<font color='red'>".$integrantes->getNomePF($k)." - ".$value."</font><br />";                           
                        endforeach;  
							$html .= "<tr>
								
								<td $onclick >" . $valor['mes'] . "/" . $valor['ano'] . $jaPossuiTxt . "</td>
								
								<td $onclick>" . $nomeProfe . "</td>
								
								<td id=\"AcompAluno\" $onclick >" . $finalizado . "</td>";
								$finalizado = "";
								
							if ($podeExcluir == true) {
								$excluir = "";
								if ($rsAcomapanhamentoCurso && !$finalizadoParcial) {
									$excluir = "<img src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"deletaRegistro('" . CAMINHO_REL . "grupo/include/acao/acompanhamento.php', " . $idAcompanhamentoCurso . ", '$caminhoAtualizar', '$ondeAtualiza')\" title=\"Excluir\" >";
								}
								$html .= "<td align=\"center\">" . $excluir . "</td>";
							}

							$html .= " </tr>";
						
					}
				}
			}
		}else{
			
		   $periodo = new PeriodoAcompanhamentoCurso();
           $p = $periodo->selectPeriodoAcompanhamentoCurso("WHERE mes = $mes_ref AND ano = $ano_ref");
           $novo = new AcompanhamentoCurso();
           $novo->setPeriodoAcompanhamentoCursoIdPeriodoAcompanhamentoCurso($p[0]['idPeriodoAcompanhamentoCurso']);
           $novo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
           $novo->setProfessorIdProfessor($idProfessor);
           $rs = $novo->addAcompanhamentoCurso();   
		   echo "<font color=\"#FF0000\">Feche e abra essa tela para aparecer o Período de acompanhamento</font>";       
		}
		return $html;
	}

	function selectAcompanhamentoCursoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idAcompanhamentoCurso, professor_idProfessor, periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso, planoAcaoGrupo_idPlanoAcaoGrupo, obs, finalizadoParcial, finalizadoGeral, arquivado FROM acompanhamentoCurso " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idAcompanhamentoCurso\" name=\"idAcompanhamentoCurso\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idAcompanhamentoCurso'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idAcompanhamentoCurso'] . "\">" . ($valor['idAcompanhamentoCurso']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function verificaPodeEditar($idAcompanhamentoCurso) {

		$rs = $this -> selectAcompanhamentoCurso(" WHERE idAcompanhamentoCurso = " . $idAcompanhamentoCurso);
		$res = $rs[0]['finalizadoParcial'];

		return !$res;
	}

}
?>

