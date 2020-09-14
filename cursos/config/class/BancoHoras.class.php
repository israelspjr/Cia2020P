<?php
class BancoHoras extends Database {
	// class attributes
	var $idBancoHoras;
	var $diaAulaFFIdDiaAulaFF;
	var $horas;
	var $dataCadastro;
	var $dataExpira;
	var $obs;
	var $professorNomeProfessorRep;
	var $credDeb;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idBancoHoras = "NULL";
		$this -> diaAulaFFIdDiaAulaFF = "NULL";
		$this -> horas = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> dataExpira = "NULL";
		$this -> obs = "NULL";
		$this -> professorNomeProfessorRep = "NULL";
		$this -> credDeb = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdBancoHoras($value) {
		$this -> idBancoHoras = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDiaAulaFFIdDiaAulaFF($value) {
		$this -> diaAulaFFIdDiaAulaFF = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHoras($value) {
		$this -> horas = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setDataExpira($value) {
		$this -> dataExpira = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setProfessorNomeProfessorRep($value) {
		$this -> professorNomeProfessorRep = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setCredDeb($value) {
			$this -> credDeb = ($value) ? $this -> gravarBD($value) : "NULL";
		
	}

	/**
	 * addBancoHoras() Function
	 */
	function addBancoHoras() {
		$sql = "INSERT INTO bancoHoras (diaAulaFF_idDiaAulaFF, horas, dataCadastro, dataExpira, obs, professor_NomeProfessorRep, credDeb) VALUES ($this->diaAulaFFIdDiaAulaFF, $this->horas, $this->dataCadastro, $this->dataExpira, $this->obs, $this->professorNomeProfessorRep, $this->credDeb)";
//		echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteBancoHoras() Function
	 */
	function deleteBancoHoras($or = "") {
		$sql = "DELETE FROM bancoHoras WHERE idBancoHoras = $this->idBancoHoras " . $or;
//		echo $sql;
		return $result = $this -> query($sql, true);
	}

	/**
	 * updateFieldBancoHoras() Function
	 */
	function updateFieldBancoHoras($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE bancoHoras SET " . $field . " = " . $value . " WHERE idBancoHoras = $this->idBancoHoras";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateBancoHoras() Function
	 */
	function updateBancoHoras() {
		$sql = "UPDATE bancoHoras SET diaAulaFF_idDiaAulaFF = $this->diaAulaFFIdDiaAulaFF, horas = $this->horas, dataExpira = $this->dataExpira, obs = $this->obs, professor_NomeProfessorRep = $this->professorNomeProfessorRep, credDeb = $this->credDeb WHERE idBancoHoras = $this->idBancoHoras";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectBancoHoras() Function
	 */
	function selectBancoHoras($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idBancoHoras, diaAulaFF_idDiaAulaFF, horas, dataCadastro, dataExpira, obs, professor_NomeProfessorRep, credDeb FROM bancoHoras " . $where;
		return $this -> executeQuery($sql);
	}

// Utilizado para o Relatorio de banco de horas.	
	function selectBancoHorasTo($where = "", $podeAlterar = false, $opcao = "", $idPlanoAcaoGrupo2, $dataini, $datafim, $controle,$idGrupo, $campos, $camposNome) {
		
		//Somente Visualiza os dados.
		
			$BancoHorasAulasRepostas = new BancoHorasAulasRepostas();
			$respostas = array();
			

		$html = "";
		
		$valorOcorrencia = self::OcorrenciaGrupoNovo($idPlanoAcaoGrupo2, $dataini, $datafim);
	//	Uteis::pr($valorOcorrencia);
		
		if (mysqli_num_rows($valorOcorrencia) > 0) {
			
			while ($valor = mysqli_fetch_array($valorOcorrencia )) {
			
			$totalOcorrencia += $valor['horas'];		
			}
		}
		 $respostas['ocorrencia'] = $totalOcorrencia;
		
		// Total de horas Repostas
		
		$datainiTmp = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataini))));
		$datafimTmp = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($datafim))));
	$sql3 = "SELECT FF.idFolhaFrequencia, FF.dataReferencia as dataRefenciaFolha
				FROM folhaFrequencia AS FF 
				WHERE FF.planoAcaoGrupo_idPlanoAcaoGrupo in  (".$idPlanoAcaoGrupo2.")";
			$sql3 .= "  AND FF.finalizadaPrincipal = 1
					   AND FF.idFolhaFrequencia not in (0)";
					   
				if ($dataini > 0) {	   
				$sql3 .=  " And dataReferencia between '".$datainiTmp."' and '".$datafimTmp."'";
				}
                $sql3 .=  " Order By dataRefenciaFolha desc";
			   
			$valorFolha = Uteis::executarQuery($sql3);
			
			$dataFolha = $valorFolha[0]['dataRefenciaFolha'];	
			$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataFolha))));	  
			
		//Total Expirado
		$whereEx = "where planoAcaoGrupo_idPlanoAcaoGrupo in (".$idPlanoAcaoGrupo2.") and ocorrenciaExpirada = 1";
		
		if ($dataini > 0) {
		
		$whereEx .= " And dataReferenciaFinal between '".$datainiTmp."' and '".$datafimTmp."' ";
		
		} else {
		
		$whereEx .= " And dataReferenciaFinal <= '" . $dataReferenciaFinal . "'";
		}
			
		$totalExpirado = $BancoHorasAulasRepostas->selectBancoHorasAulasRepostas($whereEx);
			
		
		for ($x=0;$x<count($totalExpirado);$x++) {

			$horasARepor = $totalExpirado[$x]['horasRepostas'];
			$total = $horasARepor- $totalExpirado[$x]['somaReposicao'];	
			$totalExpiradoG += $total;					
							
		}
		
		// Total Reposto
		
			$reporInserir[0] = "0";
	
			$sql = "select sum(DFF.horaRealizada) as total	FROM folhaFrequencia AS FF 
				INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo AND FF.finalizadaPrincipal = 1
				INNER JOIN professor AS P ON P.idProfessor = FF.professor_idProfessor 
				INNER JOIN diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia	AND (DFF.reposicao = 1 or DFF.ocorrenciaFF_idOcorrenciaFF = 7)
				WHERE FF.planoAcaoGrupo_idPlanoAcaoGrupo in ($idPlanoAcaoGrupo2) ";
	if ($dataini > 0) {	
		$sql .="	AND (DFF.dataAula is not Null AND DFF.dataAula between '".$datainiTmp."' and '" . $dataReferenciaFinal . "')";
	} else {
	    $sql .= "	AND (DFF.dataAula is not Null AND DFF.dataAula <='" . $dataReferenciaFinal . "')	AND DFF.idDiaAulaFF NOT IN ( ". implode(",", $reporInserir). ") "; 
	}
			$sql .= " ORDER BY DFF.dataAula ASC";
		$reposicoesMais = Uteis::executarQuery($sql);
		$totalReposicaoGeral = $reposicoesMais[0]['total'];
		
		if ($controle != 1) {
				
      if ($opcao == "totalOcorrencia") {
			
			$html = $totalOcorrencia;
			
	   }  else if ($opcao == "reposicao") {
		   	    
            $html = $totalReposicaoGeral;
			 
	   } else if ($opcao == "expirada") {
	   
	        $html = $totalExpiradoG;
	   } 
	   
	   return $html;
	   
			} else {
	   
	   $respostas['ocorrencia'] = $totalOcorrencia;
	   $respostas['reposicao'] = $totalReposicaoGeral;
	   $respostas['expirada'] = $totalExpiradoG;
	   
		  $saldoHoras = $totalOcorrencia - $totalReposicaoGeral - $totalExpiradoG;
	
	   $respostas['saldo'] = $saldoHoras;  
	   
	   if($saldoHoras == 0){
         $obs = "";
    }else if($saldoHoras > 0){
		 $obs = " a compensar";
	}else{
		$calcularHorasRestantes = 1;
		$saldoHoras *= -1;
		$obs = " realizadas a mais";
	}
	
	
		//Totais de ocorrências em aberto
	$sql2 = " SELECT    BH.horas,   DFF.idDiaAulaFF,    DFF.horaRealizada,    DFF.dataAula,    DFF.ocorrenciaFF_idOcorrenciaFF
 FROM
    diaAulaFF AS DFF
        INNER JOIN
    folhaFrequencia AS FF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
        INNER JOIN
    planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo
        INNER JOIN
    grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
        LEFT JOIN
    bancoHoras AS BH ON DFF.idDiaAulaFF = BH.diaAulaFF_idDiaAulaFF
        INNER JOIN
    prioriedade AS PR ON DFF.ocorrenciaFF_idOcorrenciaFF = PR.ocorrenciaFF_idOcorrenciaFF
WHERE
    planoAcaoGrupo_idPlanoAcaoGrupo IN (".$idPlanoAcaoGrupo2.")
		AND FF.dataReferencia BETWEEN '".$dataini."' AND '".$datafim."'
        AND idDiaAulaFF NOT IN (SELECT 
            diaAulaFF_idDiaAulaFF
        FROM
            bancoHorasAulasRepostas planoAcaoGrupo_idPlanoAcaoGrupo
        WHERE
            planoAcaoGrupo_idPlanoAcaoGrupo IN (".$idPlanoAcaoGrupo2.")
                AND ((ocorrenciaExpirada = 1)
                OR finalizado = 1))";

		$result2 = Uteis::executarQuery($sql2);
		
		//Totais de Ocorrência
		
			for ($z=0;$z<count($result2);$z++) {
				$where = "WHERE diaAulaFF_idDiaAulaFF =" .$result2[$z]['idDiaAulaFF']."
				AND (DATE(DAF.dataAula) <= DATE('".$datafim."'))";
				
				$rs = $BancoHorasAulasRepostas->BancoHorasAulasRepostas($where);
				$rsTotal = 0;
				$rsHoras = 0;
	
				foreach ($rs AS $value) {
				$rsTotal += $value['totalReposto'];	
						
				}
				
				$rsHoras = $result2[$z]['horas'];
				
					$valorHoras = $rsHoras - $rsTotal;
			
				if($result2[$z]['ocorrenciaFF_idOcorrenciaFF'] == 3) {
				
				$respostas['totalOcorrencia'][4] += $valorHoras;
				$valor3 += $valorHoras;
					
				} else {
	
					$outras += $valorHoras;	
				}
				
				if (($outras + $valor3) >= $saldoHoras) {
					$respostas['totalOcorrencia']['outras'] = ($saldoHoras - $valor3);
					
				} else {
					$respostas['totalOcorrencia']['outras'] = $outras;
					
				}
		
		}		
	
	
	    $respostas['obs'] = $obs;
	    	   	   
	   
	   return $respostas;
			}
	}

    function selectBancoHorasReposicaoTr($where = "") {
		
		$html = "";
		
		$sql = "SELECT DFF.idDiaAulaFF, DFF.horaRealizada, DFF.dataAula, DFF.professor_NomeProfessorRep, P.nome, PAG.idPlanoAcaoGrupo 
				FROM folhaFrequencia AS FF 
				INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo 
				INNER JOIN professor AS P ON P.idProfessor = FF.professor_idProfessor 
				INNER JOIN diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
				". $where;					
			
			$result = $this -> query($sql);
			
			$result2 = $this -> query($sql);
			
			while ($valor2 = mysqli_fetch_array($result2)) {
				
				$sql3 = "select BHR.idDiaAulaFFR from bancoHorasAulasRepostas as BHR where idDiaAulaFFR = ".$valor2['idDiaAulaFF'];
				$rs3 = Uteis::executarQuery($sql3);
				
				for ($x=0;$x<count($rs3);$x++) {
					
					$idReposicoesUsadas[] = $rs3[$x]['idDiaAulaFFR'];
					
				}
				
				}
				$valorIds = implode(', ',$idReposicoesUsadas);
			
		$html = "<select id=\"idBancoHorasAulasRepostas\" name=\"idBancoHorasAulasRepostas\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
	
		while ($valor = mysqli_fetch_array($result)) {
			
							if(in_array($valor['idDiaAulaFF'],$idReposicoesUsadas)) {
								
								
							} else {
								$selecionado = $idAtual == $valor['idDiaAulaFF'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDiaAulaFF'] . "\">".Uteis::exibirHoras($valor['horaRealizada']) ." em " . ($valor['dataAula']) . " - ".$valor['nome']. "</option>";
							}
		}

		$html .= "</select>";
				
		return $html;
	}

	/**
	 * selectBancoHorasSelect() Function
	 */
	function selectBancoHorasSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idBancoHoras, diaAulaFF_idDiaAulaFF, horas, dataCadastro, dataExpira, obs FROM bancoHoras " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idBancoHoras\" name=\"idBancoHoras\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idBancoHoras'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idBancoHoras'] . "\">" . ($valor['idBancoHoras']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	
	function selectBancoHorasTrNovo($where, $excel = false, $valorx2, $atualizar='') {
		
		//Utilizada para gerar o quadro de conferência na tela de grupos. Traz informação do cruzamente dos demonstrativos.
		
		$FolhaFrequencia = new FolhaFrequencia();
		$DemonstrativoCobranca = new DemonstrativoCobranca();
		$DiaAulaFF = new DiaAulaFF();
		$BancoHorasAulasRepostas = new BancoHorasAulasRepostas();
		$valorHoraGrupo = new ValorHoraGrupo();
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
		
		$total = array();
		
		$valorFolha = $FolhaFrequencia->selectFolhaFrequencia(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND finalizadaPrincipal = 1 Group by dataReferencia ORDER BY dataReferencia");
    	$idPlanoAcaoGrupo = $valorFolha[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
		
		$valor = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);

		$idGrupo = $valor[0]['grupo_idGrupo'];
		
		// Grupos com carga horaria Fixa
		$horaFixa = $valorHoraGrupo->selectValorHoraGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo . " AND datafim is null");
		
		$valorHoraFixa = $horaFixa[0]['cargaHorariaFixaMensal'];
		$align = "style=\"text-align:center;\"";
		$onclick = " onclick=\"abrirNivelPagina(this, '".CAMINHO_REL."grupo/include/form/tabelaBH.php?idPlanoAcaoGrupo=$idPlanoAcaoGrupo&idGrupo=$idGrupo&alt=$atualizar', '".CAMINHO_REL."grupo/include/resourceHTML/ff_banco.php?id=".$atualizar."', '#div_aulas')\" ";
		$ordem = 0;
		foreach($valorFolha as $valor) {
		$ordem++;
			
		$dataReferencia = $valor['dataReferencia'];	
		$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));
		
		$MesAnterior = date("Y-m-d", strtotime("-1 days", strtotime($dataReferencia)));
		$MesAnteriorP = date("Y-m-01", strtotime($MesAnterior));
		
		$idFolhaFrequencia = $valor['idFolhaFrequencia'];
				
		$ano = date("Y", strtotime($dataReferencia));
		$mes = date("m", strtotime($dataReferencia));
		
		$nomeMes = Uteis::retornaNomeMes($mes);
	
		// Horas Pagas
		$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND mes = $mes AND ano = $ano ";

$rsDemonstrativo = $DemonstrativoCobranca->selectDemonstrativoCobranca($where);

		if($rsDemonstrativo){
			$obs3 = "";
            //GERA A PARTIR DO Q FOI GRAVADO
	        $rsDemonstrativo = $rsDemonstrativo[0];
		    $horasPagas = $rsDemonstrativo['totalHoras'];
		} else {
            $horasPagas = 0;
            $obs3 = "<span style=\"color:red;\"> Não foi gerado demonstrativo de cobrança</span>";

		}
		
		// Verificar se tem mais folhas ->
		
		$valorFolha2 = $FolhaFrequencia->selectFolhaFrequencia(" WHERE dataReferencia = '".$dataReferencia."' AND finalizadaPrincipal = 1 AND planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.")");
		// Horas Realizadas pelos alunos
		$horaRealizadas = 0;
		$horaRepostas = 0;
		$horasPerdidas2 = 0;
		
		foreach ($valorFolha2 as $valor2) {
		
		$horaRealizadas += $DiaAulaFF->selectDiaAulaFF_qtdHoras( " WHERE folhaFrequencia_idFolhaFrequencia = ".$valor2['idFolhaFrequencia']." AND reposicao = 0 AND banco = 0 AND (ocorrenciaFF_idOcorrenciaFF is null OR ocorrenciaFF_idOcorrenciaFF <> 7) ");
		
		// Horas Repostas
		$horaRepostas += $DiaAulaFF->selectDiaAulaFF_qtdHoras( " WHERE folhaFrequencia_idFolhaFrequencia = ".$valor2['idFolhaFrequencia']." AND ((reposicao = 1 and ocorrenciaFF_idOcorrenciaFF is null) OR (banco = 1 AND ocorrenciaFF_idOcorrenciaFF = 7))");
		
		//Horas Perdidas (CSA, GA e CEX)
		$horasPerdidas2 += $DiaAulaFF->selectDiaAulaFFPerdidas( " WHERE folhaFrequencia_idFolhaFrequencia = ".$valor2['idFolhaFrequencia']." AND (( ocorrenciaFF_idOcorrenciaFF = 10) OR (ocorrenciaFF_idOcorrenciaFF = 15) OR (ocorrenciaFF_idOcorrenciaFF = 2) )");			
		}
		//Horas Ocorrências
		
		// Atualização para trazer o quadro de credito/debito para este quadro:
		$sql = "SELECT PR.prioriedade, BH.idBancoHoras, BH.dataExpira, PAG.idPlanoAcaoGrupo, BH.credDeb, BH.horas, BH.professor_NomeProfessorRep,
		         FF.professor_idProfessor, DFF.idDiaAulaFF, DFF.horaRealizada, DFF.dataAula,  DFF.ocorrenciaFF_idOcorrenciaFF,
		         FF.idFolhaFrequencia, G.idGrupo
		         FROM diaAulaFF AS DFF
	             INNER JOIN folhaFrequencia AS FF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia 
                 INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo
                 INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo 
                 LEFT JOIN bancoHoras as BH on DFF.idDiaAulaFF = BH.diaAulaFF_idDiaAulaFF
				 INNER JOIN prioriedade as PR on DFF.ocorrenciaFF_idOcorrenciaFF = PR.ocorrenciaFF_idOcorrenciaFF 
				 WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND (DFF.dataAula between '".$dataReferencia."' AND '".$dataReferenciaFinal."') AND BH.credDeb=1";
		
		$result1 = Uteis::executarQuery($sql);
		
		//Totais de Ocorrência
		$totalOcorrencia = 0;
		$horasCredDeb = 0;
		$obs2 = "";
		$obs4 = "";
		for ($z=0;$z<count($result1);$z++) {
				    $horasCredDeb += $result1[$z]['horaRealizada'];
		}

        $sqlOcorre ="SELECT count(DFF.idDiaAulaFF) as total
               FROM diaAulaFF AS DFF
	           INNER JOIN folhaFrequencia AS FF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
               INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo
               INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo WHERE reposicao = 0 AND banco = 1 AND (DFF.dataAula between '".$dataReferencia."' AND '".$dataReferenciaFinal."') AND PAG.idPlanoAcaoGrupo in ( ".$valorx2. ")";
        $rsOcorre = Uteis::executarQuery($sqlOcorre);
        
        if($rsOcorre[0]['total']>0){
            $obs4 = "<br>Somou horas de Crédito/Débitos";
        }
		
		// Horas de ocorrência
			$sql2 = "SELECT PR.prioriedade, BH.idBancoHoras, BH.dataExpira, PAG.idPlanoAcaoGrupo, BH.horas, BH.professor_NomeProfessorRep, FF.professor_idProfessor, DFF.idDiaAulaFF, DFF.horaRealizada, DFF.dataAula,  DFF.ocorrenciaFF_idOcorrenciaFF, FF.idFolhaFrequencia, G.idGrupo FROM diaAulaFF AS DFF
	             INNER JOIN folhaFrequencia AS FF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia 
                 INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo
                 INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo 
                 left join bancoHoras as BH on DFF.idDiaAulaFF = BH.diaAulaFF_idDiaAulaFF 
				 INNER JOIN prioriedade as PR on DFF.ocorrenciaFF_idOcorrenciaFF = PR.ocorrenciaFF_idOcorrenciaFF 
				 WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND (DFF.dataAula between '".$dataReferencia."' AND '".$dataReferenciaFinal."') AND (BH.credDeb = 0 OR BH.credDeb is null)";
				 $result2 = Uteis::executarQuery($sql2);
		for ($z=0;$z<count($result2);$z++) {
			
			if ($result2[$z]['horas'] == 0) {
			
		$totalOcorrencia += ($result2[$z]['horas'] + $result2[$z]['horaRealizada']);
				} else {
					
		$totalOcorrencia += $result2[$z]['horas'];		
				}
			
			
		}
	$horaPerdidas = $totalOcorrencia;
		
		// Horas Expiradas
		
		$whereEx = " where planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") and ocorrenciaExpirada = 1";
		
		$whereEx .= " And ( dataReferenciaFinal between '".$dataReferencia."' and '".$dataReferenciaFinal."' )";
		$totalExpirado = $BancoHorasAulasRepostas->selectBancoHorasAulasRepostas($whereEx);
		$totalExpiradoG =0;
		for ($x=0;$x<count($totalExpirado);$x++) {

			$horasARepor = $totalExpirado[$x]['horasRepostas'];
			$total = $horasARepor- $totalExpirado[$x]['somaReposicao'];	
			$totalExpiradoG += $total;					
							
		}
		
		if ($horaRealizadas > $valorHoraFixa) {
			
			$diferenca = $horaRealizadas - $valorHoraFixa;
		}
		$horaExpiradas = $totalExpiradoG;
		
		// Verificação de banco
		if ($horasPagas == ($horaRealizadas + $horasPerdidas2 + $horaPerdidas)) {
/*			echo "<hr>";
			echo $ordem."<br>";
			echo $horasPagas."<br>";
			echo $horaRealizadas."<br>";
			echo $horasPerdidas2."<br>";
			echo $horaPerdidas;*/
			$verificar = "";
		} else {
			$verificar = "title=\"verificar essa linha\" style=\"background-color:red\"";
		}
			
		$html .= "<tr $align>";
		$html .= "<td $onclick $verificar>".$ordem."</td>";	
		$html .= "<td $onclick >".$mes."/".$ano."</td>";
		$html .= "<td $onclick>".Uteis::exibirHoras($saldoBH).$obs."</td>";
		$html .= "<td $onclick>".Uteis::exibirHoras($horasPagas).$obs3."</td>";
		$html .= "<td $onclick>".Uteis::exibirHoras($horaRealizadas)."</td>";
		$html .= "<td $onclick>".Uteis::exibirHoras($horaRepostas)."</td>";
		$html .= "<td $onclick>".Uteis::exibirHoras($horasPerdidas2)."</td>";
		$html .= "<td $onclick>".Uteis::exibirHoras($horaExpiradas)."</td>";
		
            $saldoBHTotal = $saldoBHTotal+$saldoBH;
            $horasPagasTotal = $horasPagasTotal+$horasPagas;
            $horaRealizadasTotal = $horaRealizadasTotal+$horaRealizadas;
            $horaRepostasTotal = $horaRepostasTotal+$horaRepostas;
            $horasPerdidas2Total = $horasPerdidas2Total+$horasPerdidas2;
            $horaExpiradasTotal = $horaExpiradasTotal+$horaExpiradas;

		$saldoHoras =  $saldoInicial + $horasPagas + $horasCredDeb - $horaRealizadas - $horaRepostas - $horasPerdidas2 - $horaExpiradas;

           if ($saldoHoras > 0) {
                $obs = " Horas a compensar";
                $horaVisisel = $saldoHoras;
            } elseif ($saldoHoras < 0) {
                $obs = " Horas realizadas a mais";
                $horaVisisel = $saldoHoras * -1;
            } else {
                $horaVisisel = 0;
                $obs = " ";

            }
            $html .= "<td $onclick>".Uteis::exibirHoras($horaVisisel).$obs.$obs4."</td>";
            $saldoBH = $horaVisisel;
            $saldoInicial = $saldoHoras;
            $html .= "<td $onclick>".$obs2."</td>";
            $html .= "<td $onclick><i>".Uteis::exibirHoras($horaPerdidas)."</i></td>";
            $html .= "</tr>";
            $DiasTotal = $DiasTotal++;
            $horaVisiselTotal = $horaVisiselTotal+$horaVisisel;
            $horaPerdidasTotal = $horaPerdidasTotal + $horaPerdidas;
		}


	 	$colunas = array("Ordem", "Mês", "Saldo Inicial", "Horas Pagas", "Horas Pagas Realizadas", "Horas Repostas", "Horas Perdidas (CSA, GA, CEX)", "Horas Expiradas", "Saldo Final", "Observações",   "Horas a compensar (CCA, PA, F, CSA*)");

        $html_colunas = '';
        foreach ($colunas as $col){
            $html_colunas .= "<th>" . $col . "</th>";
        }

        $mTable  = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $mTable .= "<table id=\"tb_lista_res3\" class=\"registros\">";
        $mTable .= " <thead><tr>" . $html_colunas . "</tr></thead>";
        $mTable .= " <tbody>" . $html . "</tbody>";
        $mTable .= " <tfoot><tr role=\"row\" class=\"even\">";
            $mTable .= "<th class=\"ui-state-default\">&nbsp;</th>";
            $mTable .= "<th class=\"ui-state-default\">$ordem mes(es)</th>";
            $mTable .= "<th class=\"ui-state-default\">"/*.Uteis::exibirHoras($saldoBHTotal)*/."</th>";
            $mTable .= "<th class=\"ui-state-default\">".Uteis::exibirHoras($horasPagasTotal)."</th>";
            $mTable .= "<th class=\"ui-state-default\">".Uteis::exibirHoras($horaRealizadasTotal)."</th>";
            $mTable .= "<th class=\"ui-state-default\">".Uteis::exibirHoras($horaRepostasTotal)."</th>";
            $mTable .= "<th class=\"ui-state-default\">".Uteis::exibirHoras($horasPerdidas2Total)."</th>";
            $mTable .= "<th class=\"ui-state-default\">".Uteis::exibirHoras($horaExpiradasTotal)."</th>";
            $mTable .= "<th class=\"ui-state-default\">"/*.Uteis::exibirHoras($horaVisiselTotal)*/."</th>";
            $mTable .= "<th class=\"ui-state-default\">&nbsp;</td>";
            $mTable .= "<th class=\"ui-state-default\">".Uteis::exibirHoras($horaPerdidasTotal)."</th>";
        $mTable .= " </tr><tr>" . $html_colunas . "</tr></tfoot>";
        $mTable .= " </table>";

   	return $mTable;
		
	   }
	   
  /*  function selectBancoHorasGrupo($where, $excel = false, $valorx2, $podeAlterar = 1, $atualizar = 0) {
		   
		   // v 0.0.1 data: 28/09/2017
		   
		   //Atualiza 3 meses atrás!
		
		$FolhaFrequencia = new FolhaFrequencia();
		$DiaAulaFF = new DiaAulaFF();
		$BancoHorasAulasRepostas = new BancoHorasAulasRepostas();
		$OcorrenciaFF = new OcorrenciaFF();
		
		
		//Zerar Variaveis Global
		$jaForamInseridosR[0] = 0;
		$pos[0] = 0;	
		$TotalSaldoFinal = 0;
		$totalOcorrencia = 0;	
		$TotalReposicao = 0;
		$TotalExpirado = 0;

		// Fechar Folha a Folha
		
		$valorFolha = $FolhaFrequencia->selectFolhaFrequencia(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND finalizadaPrincipal = 1 ORDER BY dataReferencia ");
		
		$valorFolhaUltima = $FolhaFrequencia->selectFolhaFrequencia(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND finalizadaPrincipal = 1 ORDER BY dataReferencia DESC");
	//	echo $valorFolhaUltima;

		$idPlanoAcaoGrupo = $valorFolha[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
		$dataReferenciaUltimaA = $valorFolhaUltima[0]['dataReferencia'];
		$dataReferenciaPrimeira = date('Y-m-d', strtotime('-3 months', strtotime($dataReferenciaUltimaA)));
		
	
//Data Final de referência		
		$dataReferenciaUltima = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferenciaUltimaA))));
				
	//	$align = "style=\"text-align:center;\"";
		$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));
		
		//Ocorrências	
		$result = self::OcorrenciaGrupo($valorx2, $dataReferenciaPrimeira, $dataReferenciaUltima);

		
		$ordem = 0;
		while ($valor = mysqli_fetch_array($result)) {
			$ordem++;
				
			$idDiaAulaFF = $valor['idDiaAulaFF'];
			$dataExpira = $valor['dataExpira'];
			$horaARepor = $valor['horas'];
			$idBancoHoras = $valor['idBancoHoras'];	
			$idOcorrenciaFF = $valor['ocorrenciaFF_idOcorrenciaFF'];
			$dataReferenciaFinal = date("Y-m-t", strtotime($valor['dataReferencia']));
			
			$onclick  = "ref=".$valor['idDiaAulaFF'];		
			
		if ($valor['dataExpira'] > 0) {
			
			$dataReferenciaExpira = date("Y-m-t", strtotime($valor['dataExpira']));
			
			} 
					
		$d = Uteis::diferencaEntreDatas($valor['dataAula'] , $valor['dataExpira']);
		
			if ($d == 2) {

		}
		$totalOcorrencia += $valor['horas'];
		
		$reposicoes = self::calcularReposicao($valorx2, $dataReferenciaFinal, $dataReferenciaExpira, $idDiaAulaFF, $dataExpira, $horaARepor, $idBancoHoras, $jaForamInseridosR, $pos );
	
			$where24 = " where diaAulaFF_idDiaAulaFF IN (". $idDiaAulaFF. ") ";				
			$resultR24 = $BancoHorasAulasRepostas->selectBancoHorasAulasRepostas($where24);
			$TotalRepostoGeral =0;				
				
			for($x=0;$x<count($resultR24);$x++) {
				
				$valorData = $DiaAulaFF->selectDiaAulaFF(" WHERE idDiaAulaFF = ".$resultR24[$x]['idDiaAulaFFR']);
				$dataReposicao = $valorData[0]['dataAula'];
				$totalReposto = $resultR24[$x]['totalReposto'];
				$idBancoHorasAulasExpiradas = $resultR24[$x]['idBancoHorasAulasRepostas'];
							
				$TotalRepostoGeral += $totalReposto;
			
				}
		
		$jaForamInseridosR = $reposicoes[1];
		$TotalReposicao += $reposicoes[2];
			
		//Calculando HoraSobra
		$temHoraSobra = $reposicoes[3];
		$horaSobra = $reposicoes[4];

		$saldoFinal = $valor['horas'] - $TotalRepostoGeral;
		$TotalSaldoFinal += $saldoFinal;
		
		if ($saldoFinal == 0) {
    		$BancoHorasAulasRepostas->setIdBancoHorasAulasRepostas($idBancoHorasAulasExpiradas);
			$BancoHorasAulasRepostas->updateFieldBancoHorasAulasRepostas('finalizado', 1);
			$BancoHorasAulasRepostas->updateFieldBancoHorasAulasRepostas('ocorrenciaExpirada', 0);
			
		} else {
		
		// Expirar Horas que não conseguiram ser repostas ( foi reposto somente uma parte).
		if (($dataExpira > 0) && ($dataExpira < $dataReferenciaUltima) && ($idOcorrenciaFF != 3)) {		
		$saldoExpirar = $saldoFinal;
		if ($expirada ==0) {
			
			$BancoHorasAulasRepostas->setIdBancoHorasAulasRepostas($idBancoHorasAulasExpiradas);
			$BancoHorasAulasRepostas->updateFieldBancoHorasAulasRepostas('ocorrenciaExpirada', 1);
	}
				}
		}		

		// Fim Reposição Horas

		// Horas Expiradas
		$where2 = " where diaAulaFF_idDiaAulaFF = ".$idDiaAulaFF. " order By idBancoHorasAulasRepostas Desc";
		$ocorrenciaExpirada = $BancoHorasAulasRepostas->selectBancoHorasAulasRepostas($where2);
		
		$finalizada = $ocorrenciaExpirada[0]['finalizado'];
		$expirada = $ocorrenciaExpirada[0]['ocorrenciaExpirada'];
		$idDiaAulaFFR = $ocorrenciaExpirada[0]['idDiaAulaFFR'];
		$rs2 = $BancoHorasAulasRepostas->selectBancoHorasAulasRepostasMax($where2);
		$somaReposicaoExpirada = $rs2[0]['horas'];
		if (($idOcorrenciaFF != 3) && ($finalizada == 0) && ($dataExpira > 0) && ($dataExpira <= $dataReferenciaUltima) || ($expirada == 1) ) {
			
		$horasExpiradas = $horaARepor - $somaReposicaoExpirada;
			
		if ($expirada ==0) {
			
		$resultado2 = $BancoHorasAulasRepostas->calcularReposicao($idDiaAulaFF,$dataExpira,$horaARepor,$idDiaAulaFF, $dataReferenciaUltima, $horaRealizada, $dataReposicao,$idBancoHoras,$idProfessor,$idPlanoAcaoGrupo,1);			
		}
		
		$saldoFinal = 0;
		$TotalSaldoFinal -= $horasExpiradas;
		}
		// Fim Horas Expiradas
	
			} // Fim do While Principal
			
				$whereEx = " where planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") and ocorrenciaExpirada = 1";
		
		$whereEx .= " And ( dataReferenciaFinal between '".$dataReferenciaPrimeira."' and '".$dataReferenciaUltima."' )";
    	$totalExpirado = $BancoHorasAulasRepostas->selectBancoHorasAulasRepostas($whereEx);	
		for ($x=0;$x<count($totalExpirado);$x++) {

			$horasARepor = $totalExpirado[$x]['horasRepostas'];
			$total = $horasARepor- $totalExpirado[$x]['somaReposicao'];	
			$totalExpiradoG += $total;					
							
		}
		
		$horaExpiradas = $totalExpiradoG;	
	   }	*/
	   
	   
	
	function OcorrenciaGrupo($valorx2, $dataReferencia, $dataReferenciaFinal) {
		
		
		$sql = "SELECT PR.prioriedade, BH.idBancoHoras, BH.dataExpira, PAG.idPlanoAcaoGrupo, BH.horas, BH.professor_NomeProfessorRep, FF.professor_idProfessor, DFF.idDiaAulaFF, DFF.horaRealizada, DFF.dataAula,  DFF.ocorrenciaFF_idOcorrenciaFF, DFF.obs, FF.idFolhaFrequencia, G.idGrupo, FF.dataReferencia FROM diaAulaFF AS DFF
	             INNER JOIN folhaFrequencia AS FF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia 
                 INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo
                 INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo 
                 left join bancoHoras as BH on DFF.idDiaAulaFF = BH.diaAulaFF_idDiaAulaFF 
				 INNER JOIN prioriedade as PR on DFF.ocorrenciaFF_idOcorrenciaFF = PR.ocorrenciaFF_idOcorrenciaFF 
				 WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND (DFF.dataAula between '".$dataReferencia."' AND '".$dataReferenciaFinal."')
				 ORDER BY dataExpira is null, COALESCE(dataExpira)";
	//	Uteis::pr( $sql);

		$result = $this -> query($sql);
		return $result;
		
		
	}
	
	
		function calcularReposicao($valorx2, $dataReferenciaFinal, $dataReferenciaExpira, $idDiaAulaFF, $dataExpira, $horaARepor, $idBancoHoras, $jaForamInseridosR, $pos, $temHoraSobra, $horaSobra, $dataReposicaoMaxima) {
		
			$BancoHorasAulasRepostas = new BancoHorasAulasRepostas();

			//Zerar Variavel Global
			$TotalRepostoGeral = 0;	
			$resultado = array();
		
			$sql = " SELECT PAG.dataValidade, DFF.idDiaAulaFF, DFF.horaRealizada, DFF.dataAula, DFF.professor_NomeProfessorRep, PAG.idPlanoAcaoGrupo 
				FROM folhaFrequencia AS FF 
				INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo AND FF.finalizadaPrincipal = 1
				INNER JOIN professor AS P ON P.idProfessor = FF.professor_idProfessor 
				INNER JOIN diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia	AND (DFF.reposicao = 1 or DFF.ocorrenciaFF_idOcorrenciaFF = 7)
				WHERE FF.planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.")";
				 
				$sql .= " AND (DFF.dataAula is not Null)"; 

				if ($jaForamInseridosR[1] > 0) {
				 
				$sql .= " AND DFF.idDiaAulaFF NOT IN ( ". implode(",", $jaForamInseridosR). ")";
				
				}
				if ($dataReposicaoMaxima != '') {
				$sql .= "AND (DFF.dataAula <= '".$dataReposicaoMaxima."')";	
					
				}
				
				$sql .= " /*AND (DFF.dataAula <= '".$dataReferenciaFinal."')*/ ORDER BY DFF.dataAula ASC";
			
				$reposicoes = $this -> query($sql);
			
			
				
				
				while ($valorR = mysqli_fetch_array($reposicoes) ) {
							
					
					$idDataReposicao = $valorR['idDiaAulaFF'];
					if ($temHoraSobra == 1) {
						
						$horaRealizada = $horaSobra;
						
					} else {
					
						$horaRealizada = $valorR['horaRealizada'];
					
					}
					
					$dataReposicao = $valorR['dataAula'];
					
					$resultado = $BancoHorasAulasRepostas->calcularReposicao($idDiaAulaFF,$dataExpira,$horaARepor,$idDataReposicao, $dataReferenciaFinal, $horaRealizada, $dataReposicao,$idBancoHoras,0, $valorR['idPlanoAcaoGrupo'], 0);
					$html .= $resultado;
					
					
			$where24 = " where idDiaAulaFFR = ".$idDataReposicao. " And diaAulaFF_idDiaAulaFF IN (". $idDiaAulaFF. ") ";
				$resultR24 = $BancoHorasAulasRepostas->selectBancoHorasAulasRepostas($where24);
				$totalReposto = $resultR24[0]['totalReposto'];
				$finalizada = $resultR24[0]['reposicaoFinalizada'];
				$horaSobra = $resultR24[0]['horaSobra'];
				$reposicaoFinalizada = $resultR24[0]['reposicaoFinalizada'];
				$horaRealizada = $totalReposto;	
				
					
				$html .= "<div class=\"destacaLinha\" ref=\"" . $idDataReposicao . "\" >" . $delete . Uteis::exibirHoras($horaRealizada) . " em " . Uteis::exibirData($dataReposicao) . " - 2OK</div>";
				
					if ($finalizada == 1 ) {
					array_push($jaForamInseridosR, $idDataReposicao);
					
					$temHoraSobra = 0;
					
					} else {
    				$TotalReposto += $horaRealizada;
				
					if ($TotalReposto > $horasRealizada) {
						
					$temHoraSobra = 1;	
					
					}
					}
						
					$saldoFinal -= $horaRealizada; 
					$TotalRepostoGeral += $horaRealizada;
			}
				
		$resultado[0] = $html;
		$resultado[1] = $jaForamInseridosR;	
		$resultado[2] = $TotalRepostoGeral;	
		$resultado[3] = $temHoraSobra;
		$resultado[4] = $horaSobra;
				
		return $resultado;	
	}	
	
	 function bancoHorasTabela($idGrupo, $idPlanoAcaoGrupo, $semHtml = 0) {
		 
		 //Visualiza e Atualiza a tabela detalhada do banco de horas.
		   
		   // v 0.0.5 data: 06/05/2020
		
		$FolhaFrequencia = new FolhaFrequencia();
		$DiaAulaFF = new DiaAulaFF();
		$BancoHorasAulasRepostas = new BancoHorasAulasRepostas();
		$OcorrenciaFF = new OcorrenciaFF();
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
		
		$valorPlanoAcaoGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
		$validadeP = $valorPlanoAcaoGrupo[0]['dataValidade'];
		if ($validadeP == '') {	$validadeP = 3;	}
		
		$valorx2 = $PlanoAcaoGrupo->getTodosPAG($idPlanoAcaoGrupo);
		
		//Zerar Variaveis Global
		$jaForamInseridosR[0] = 0;
		$pos[0] = 0;	
		$TotalSaldoFinal = 0;
		$totalOcorrencia = 0;	
		$TotalReposicao = 0;
		$TotalExpirado = 0;

		// Fechar Folha a Folha
		$valorFolha = $FolhaFrequencia->selectFolhaFrequencia(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND finalizadaPrincipal = 1 ORDER BY dataReferencia ");
		$dataReferenciaPrimeira = $valorFolha[0]['dataReferencia'];

       //Data Final de referência		
		$dataReferenciaUltima = $FolhaFrequencia->selectFolhaFrequenciaMax($valorx2);
		$align = "style=\"text-align:center;\"";
		
		//Ocorrências	
    	$result = self::OcorrenciaGrupoNovo($valorx2, $dataReferenciaPrimeira, $dataReferenciaUltima);
		
		$ordem = 0;
		while ($valor = mysqli_fetch_array($result)) {
			$ordem++;
				
			$idDiaAulaFF = $valor['idDiaAulaFF'];
			$dataExpira = $valor['dataExpira'];
			$horaARepor = $valor['horas'];
			$idBancoHoras = $valor['idBancoHoras'];	
			$idOcorrenciaFF = $valor['ocorrenciaFF_idOcorrenciaFF'];
			$dataReferenciaFinal = date("Y-m-t", strtotime($valor['dataReferencia']));
			$dataReposicaoMaxima = date("Y-m-d", strtotime("+24 months", strtotime($dataReferenciaFinal)));
			$onclick  = "ref=".$idDiaAulaFF;		
			$style="";
			
				
		if ($valor['dataExpira'] > 0) {
			
			$dataReferenciaExpira = date("Y-m-t", strtotime($valor['dataExpira']));
			
			$d = Uteis::diferencaEntreDatas($valor['dataAula'] , $valor['dataExpira']);
			
				if ($d < $validadeP) {
		$style = "style=background-color:red;";	
		}	
			
			} 
					
		// Montando a Tabela
		
		  $alteraValidade = "<img src=\"" . CAMINHO_IMG . "editar.png\" title=\"Editar a data de expiração\"
		    onclick=\"abrirNivelPagina(this, '".CAMINHO_REL."grupo/include/form/bancoHoras_validade.php?id=$idBancoHoras', '$caminhoAtu', '$ondeAtu')\" />&nbsp;
	        <input type=\"checkbox\" name=\"idh[]\" value=\"".$idBancoHoras."\" title=\"Selecionar esta data para alteração múltipla\"/>";
				
		$html .= "<tr $align>";	
		$html .= "<td >".$ordem."</td>";
		$html .= "<td $onclick $style>".Uteis::exibirData($valor['dataExpira'])."</td>";
        $html .= "<td>";
	    $html .= " &nbsp; $alteraValidade";
		$html .= "</td>";
		$html .= "<td $onclick >".$OcorrenciaFF->getSiglaOcorrencia($valor['ocorrenciaFF_idOcorrenciaFF'])."</td>";
		$html .= "<td $onclick >".Uteis::exibirData($valor['dataAula'])."</td>";
		$html .= "<td $onclick >".Uteis::exibirHoras($valor['horas'])."</td>";
		
		$totalOcorrencia += $valor['horas'];
		
		// Repor Horas
		
		$html .= "<td $onclick >";
		
	$reposicoes = self::calcularReposicao($valorx2, $dataReferenciaFinal, $dataReferenciaExpira, $idDiaAulaFF, $dataExpira, $horaARepor, $idBancoHoras, $jaForamInseridosR, $pos,$temHoraSobra,$horaSobra, $dataReposicaoMaxima );
	
	
			$where24 = " where diaAulaFF_idDiaAulaFF IN (". $idDiaAulaFF. ") ";				
			$resultR24 = $BancoHorasAulasRepostas->selectBancoHorasAulasRepostas($where24);
			$TotalRepostoGeral =0;				
				
			for($x=0;$x<count($resultR24);$x++) {
				
				$valorData = $DiaAulaFF->selectDiaAulaFF(" WHERE idDiaAulaFF = ".$resultR24[$x]['idDiaAulaFFR']);
				
				$dataReposicao = $valorData[0]['dataAula'];
	//			echo $dataReposicao." - ".$resultR24[$x]['idDiaAulaFFR'] ." -".$valorData[0]['folhaFrequencia_idFolhaFrequencia']."<br>";
				$totalReposto = $resultR24[$x]['totalReposto'];
				$idBancoHorasAulasExpiradas = $resultR24[$x]['idBancoHorasAulasRepostas'];
							
				$TotalRepostoGeral += $totalReposto;
				
				if ($resultR24[$x]['idDiaAulaFFR'] != "-1") {
					
				$html .= "<div class=\"destacaLinha\" ref=\"" . $resultR24[$x]['idDiaAulaFFR'] . "\" >" . $delete . Uteis::exibirHoras($totalReposto) . " em " . $dataReposicao . " - 3OK</div>";
				
				}
				
				}
		
		$jaForamInseridosR = $reposicoes[1];
		$TotalReposicao += $reposicoes[2];
			
		//Calculando HoraSobra
		$temHoraSobra = $reposicoes[3];
		$horaSobra = $reposicoes[4];

		$saldoFinal = $valor['horas'] - $TotalRepostoGeral;
		$TotalSaldoFinal += $saldoFinal;
		
		if ($saldoFinal == 0) {
			
			$html .= "<div class=\"destacaLinha\" align=\"center\"><font color=\"green\">1-Finalizado</font></div>";
			
		$BancoHorasAulasRepostas->setIdBancoHorasAulasRepostas($idBancoHorasAulasExpiradas);
			$BancoHorasAulasRepostas->updateFieldBancoHorasAulasRepostas('finalizado', 1);
			$BancoHorasAulasRepostas->updateFieldBancoHorasAulasRepostas('ocorrenciaExpirada', 0);
			
		} else {
		
		// Expirar Horas que não conseguiram ser repostas ( foi reposto somente uma parte).
		if (($dataExpira > 0) && ($dataExpira < $dataReferenciaUltima) && ($idOcorrenciaFF != 3)) {		
		$saldoExpirar = $saldoFinal;
		if ($expirada ==0) {
			
			$BancoHorasAulasRepostas->setIdBancoHorasAulasRepostas($idBancoHorasAulasExpiradas);
			$BancoHorasAulasRepostas->updateFieldBancoHorasAulasRepostas('ocorrenciaExpirada', 1);
	}
				}
		}		

		// Fim Reposição Horas
		$html .= "</td>";
		
		
		// Horas Expiradas
	
		$html .= "<td $onclick >";
		$where2 = " where diaAulaFF_idDiaAulaFF = ".$idDiaAulaFF. " order By idBancoHorasAulasRepostas Desc";
		$ocorrenciaExpirada = $BancoHorasAulasRepostas->selectBancoHorasAulasRepostas($where2);
		
		$finalizada = $ocorrenciaExpirada[0]['finalizado'];
		$expirada = $ocorrenciaExpirada[0]['ocorrenciaExpirada'];
		$idDiaAulaFFR = $ocorrenciaExpirada[0]['idDiaAulaFFR'];
		$rs2 = $BancoHorasAulasRepostas->selectBancoHorasAulasRepostasMax($where2);
		$somaReposicaoExpirada = $rs2[0]['horas'];
		if ( ($finalizada == 0) && ($dataExpira > 0) && ($dataExpira <= $dataReferenciaUltima) || ($expirada == 1) ) {
			
		$horasExpiradas = $horaARepor - $somaReposicaoExpirada;
			
		$html .= "<div class=\"destacaLinha\" ref=\"" . $resultR24[$x]['idDiaAulaFFR'] . "\" >" . $delete . Uteis::exibirHoras($horasExpiradas) . "</div>";	
		
		$html .= "<strong><font color='red'>Data de validade Expirada </font></strong>";
			
		if ($expirada ==0) {
			
		$resultado2 = $BancoHorasAulasRepostas->calcularReposicao($idDiaAulaFF,$dataExpira,$horaARepor,$idDiaAulaFF, $dataReferenciaUltima, $horaRealizada, $dataReposicao,$idBancoHoras,$idProfessor,$idPlanoAcaoGrupo,1);			
		}
		
		$saldoFinal = 0;
		$TotalSaldoFinal -= $horasExpiradas;
		}
		// Fim Horas Expiradas
		$html .= "</td>";
		
		// Saldo A compensar ou a Mais
		$html .= "<td $onclick >";
		
		$html .= Uteis::exibirHoras($saldoFinal);
		
		// Fim saldo Acumulado periodo
		$html .= "</td>";
		
		//Observação		
		$html .= "<td $onclick >".$valor['obs']."</td>";
		$html .= "</tr>";
		
	
			} // Fim do While Principal
			
				$whereEx = " where planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") and ocorrenciaExpirada = 1";
		
		$whereEx .= " And ( dataReferenciaFinal between '".$dataReferenciaPrimeira."' and '".$dataReferenciaUltima."' )";
    	$totalExpirado = $BancoHorasAulasRepostas->selectBancoHorasAulasRepostas($whereEx);	
		for ($x=0;$x<count($totalExpirado);$x++) {

			$horasARepor = $totalExpirado[$x]['horasRepostas'];
			$total = $horasARepor- $totalExpirado[$x]['somaReposicao'];	
			$totalExpiradoG += $total;					
							
		}
		
		$horaExpiradas = $totalExpiradoG;	
		
	 	$colunas = array("Ordem", "Data Expiração", "Ação", "Ocorrência Sigla",  "Data de Aula", "Hora Aula: &nbsp;(".Uteis::exibirHoras($totalOcorrencia).")", "Horas Repostas: &nbsp;("/*.Uteis::exibirHoras($TotalReposicao)*/. ")", "Horas Expiradas &nbsp;("/*.Uteis::exibirHoras($horaExpiradas)*/. ")", "Saldo Final (".Uteis::exibirHoras($TotalSaldoFinal). $obs.") ", "Observações");
		
		$html_base = Relatorio::montaTb($colunas, $excel,"",6);
		
		if ($semHtml == 0) {

    	return $html_base . $html;
		
			}
		
	   }		
	
		
	function bancoHorasTo($idGrupo, $idPlanoAcaoGrupo) {	
	
		//Somente Visualiza os dados. Utilizado nas Telas De FF
		
		$BancoHorasAulasRepostas = new BancoHorasAulasRepostas();
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
		$FolhaFrequencia = new FolhaFrequencia();
		
		$respostas = array();
		$idPlanoAcaoGrupo2 = $PlanoAcaoGrupo->getTodosPAG($idPlanoAcaoGrupo);
		
		//	Horas não realizadas no banco
		$result1 = $this->selectBancoPadrao($idPlanoAcaoGrupo2, $idGrupo,1);
		while ($valor = mysqli_fetch_array($result1)) {
		
			$respostas['ocorrencia'] = $valor['horas'];	
		}
   
   		// Pegar última Folha finalizada	
		$dataReferenciaF = $FolhaFrequencia->selectFolhaFrequenciaMax($idPlanoAcaoGrupo2);
			
		if (empty($dataReferenciaF)) {
			$respostas['dataReferenciaF'] = "2016-01-01";	
		} else {
			$respostas['dataReferenciaF'] = $dataReferenciaF; 
		}
		
		//Total Expirado
		$totalExpirado = $BancoHorasAulasRepostas->selectBancoHorasAulasRepostas("WHERE planoAcaoGrupo_idPlanoAcaoGrupo IN (".$idPlanoAcaoGrupo2.") AND ocorrenciaExpirada = 1");
	
		for ($x=0;$x<count($totalExpirado);$x++) {

			$horasARepor = $totalExpirado[$x]['horasRepostas'];
			$respostas['expirada'] += $horasARepor- $totalExpirado[$x]['somaReposicao'];	
		}
		
		// Total Reposto
    	$valorReposto = $PlanoAcaoGrupo->totalReposto($idPlanoAcaoGrupo2);
		$respostas['reposicao']= $valorReposto[0]['total'];
		
		//Saldo
 	    $respostas['saldo'] = $respostas['ocorrencia'] - $respostas['reposicao'] - $respostas['expirada'];
	   
	   if($respostas['saldo'] == 0){
         $obs = "";
       }else if($respostas['saldo'] > 0){
		 $obs = " a compensar";
       }else{
		$calcularHorasRestantes = 1;
		$saldoHoras *= -1;
		$obs = " realizadas a mais";
	   }
	
	    $respostas['obs'] = $obs;
	//	Uteis::pr($respostas);

	   return $respostas;

	}
	
	function selectBancoPadrao($idPlanoAcaoGrupo2, $idGrupo, $somarHorasRepor ) {
	
		// Atualização para trazer o quadro de credito/debito para este quadro:
		if ($somarHorasRepor == 1) {
			$sql = "SELECT SUM(BH.horas) AS horas";
		} else {
			$sql = "SELECT PR.prioriedade, BH.idBancoHoras, BH.dataExpira, PAG.idPlanoAcaoGrupo, BH.horas, FF.professor_idProfessor, DFF.idDiaAulaFF, DFF.horaRealizada, DFF.dataAula,  DFF.ocorrenciaFF_idOcorrenciaFF, FF.idFolhaFrequencia, FF.dataReferencia ";
		}
		
			$sql .= " FROM diaAulaFF AS DFF
	             INNER JOIN folhaFrequencia AS FF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia 
                 INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo
                 INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo 
                 LEFT JOIN bancoHoras as BH on DFF.idDiaAulaFF = BH.diaAulaFF_idDiaAulaFF 
				 INNER JOIN prioriedade as PR on DFF.ocorrenciaFF_idOcorrenciaFF = PR.ocorrenciaFF_idOcorrenciaFF 
				 WHERE  DFF.reposicao = 0 AND DFF.banco = 1 AND PAG.idPlanoAcaoGrupo in (".$idPlanoAcaoGrupo2.") 
                 OR DFF.idDiaAulaFF in 
                 (SELECT 
            diaAulaFF_idDiaAulaFF
        FROM
            planoAcaoGrupo AS PAG
                INNER JOIN
            folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
                AND FF.finalizadaParcial = 1
                AND FF.finalizadaPrincipal = 1
                INNER JOIN
            diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                INNER JOIN
            bancoHoras AS BH ON BH.diaAulaFF_idDiaAulaFF = DFF.idDiaAulaFF
        WHERE
            PAG.grupo_idGrupo =".$idGrupo.")
			 ORDER BY BH.dataExpira is null, DFF.ocorrenciaFF_idOcorrenciaFF, COALESCE(BH.dataExpira)";
			
		$rs = $this -> query($sql);
		
		return $rs;
		
	}
	
	function OcorrenciaGrupoNovo($valorx2, $dataReferencia, $dataReferenciaFinal) {
	
		$sql = "SELECT PR.prioriedade, BH.idBancoHoras, BH.dataExpira, BH.horas,  DFF.idDiaAulaFF, DFF.horaRealizada, DFF.dataAula,  DFF.ocorrenciaFF_idOcorrenciaFF, DFF.obs,  FF.dataReferencia FROM diaAulaFF AS DFF
	             INNER JOIN folhaFrequencia AS FF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia 
                INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo
                 INNER JOIN bancoHoras as BH on DFF.idDiaAulaFF = BH.diaAulaFF_idDiaAulaFF 
				 INNER JOIN prioriedade as PR on DFF.ocorrenciaFF_idOcorrenciaFF = PR.ocorrenciaFF_idOcorrenciaFF
				 WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND (DFF.dataAula between '".$dataReferencia."' AND '".$dataReferenciaFinal."')
				 ORDER BY BH.dataExpira is null, COALESCE(BH.dataExpira)";
	//	echo $sql;
		$result = $this -> query($sql);
		return $result;
		
		
	}
	
 }
?>