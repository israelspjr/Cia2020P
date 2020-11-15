<?php
class FolhaPonto extends Database {
    // class attributes
    var $idFolhaPonto;
    var $finalizada;
    var $obs;
    var $funcionario_idFuncionario;
    var $dataReferencia;
    var $dataCadastro;
	var $dataFinalizada;
	var $saldoInicial;
	var $tipoSaldoInicial;
	var $saldoFinal;
	var $tipoSaldoFinal;


    // constructor
    function __construct() {
        parent::__construct();
        $this -> idFolhaPonto = "NULL";
        $this -> finalizada = "0";
        $this -> obs = "NULL";
        $this -> funcionarioIdFuncionario = "NULL";
        $this -> dataReferencia = "NULL";
        $this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> dataFinalizada = "NULL";
		$this -> saldoInicial = "0";
		$this -> tipoSaldoInicial = "0";
		$this -> saldoFinal = "0";
		$this -> tipoSaldoFinal = "0";


    }

    function __destruct() {
        parent::__destruct();
    }

    // class methods
    function setIdFolhaPonto($value) {
        $this -> idFolhaPonto = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setFinalizada($value) {
        $this -> finalizada = ($value) ? $this -> gravarBD($value) : "0";
    }

    function setObs($value) {
        $this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setFuncionarioIdFuncionario($value) {
        $this -> funcionarioIdFuncionario = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setDataReferencia($value) {
        $this -> dataReferencia = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setDataCadastro($value) {
        //$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
    }
	
	function setDataFinalizada($value) {
        $this -> dataFinalizada = ($value) ? $this -> gravarBD($value) : "NULL";
    }
	
	function setSaldoInicial($value) {
        $this -> saldoInicial = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setTipoSaldoInicial($value) {
        $this -> tipoSaldoInicial = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setSaldoFinal($value) {
        $this ->  saldoFinal = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setTipoSaldoFinal($value) {
        $this -> tipoSaldoFinal = ($value) ? $this -> gravarBD($value) : "0";
    }
	

    /**
     * addFolhaPonto() Function
     */
    function addFolhaPonto() {
        $sql = "INSERT INTO folhaPonto (finalizada, obs, funcionario_idFuncionario,  dataReferencia, dataCadastro, dataFinalizada, saldoInicial, tipoSaldoInicial, saldoFinal, tipoSaldoFinal) VALUES ($this->finalizada, $this->obs, $this->funcionarioIdFuncionario, $this->dataReferencia, $this->dataCadastro, $this->dataFinalizada, $this->saldoInicial, $this->tipoSaldoInicial, $this->saldoFinal, $this->tipoSaldoFinal)";
		echo $sql;
        $result = $this -> query($sql, true);
        return mysqli_insert_id($this -> connect);
    }

    /**
     * deleteFolhaPonto() Function
     */
    function deleteFolhaPonto() {
        $sql = "DELETE FROM folhaPonto WHERE idFolhaPonto = $this->idFolhaPonto";
	    $result = $this -> query($sql, true);
    }

    /**
     * updateFieldFolhaPonto() Function
     */
    function updateFieldFolhaPonto($field, $value) {
        $value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
        $sql = "UPDATE folhaPonto SET " . $field . " = " . $value . " WHERE idFolhaPonto = $this->idFolhaPonto";
	//	echo $sql;
        $result = $this -> query($sql, true);
    }

    /**
     * updateFolhaPonto() Function
     */
    function updateFolhaPonto() {
        $sql = "UPDATE folhaPonto SET finalizada = $this->finalizada, obs = $this->obs, funcionario_idFuncionario = $this->funcionarioIdFuncionario, dataReferencia = $this->dataReferencia, dataFinalizada = $this->dataFinalizada, saldoInicial = $this->saldoInicial, tipoSaldoInicial = $this->tipoSaldoInicial, saldoFinal = $this->saldoFinal, tipoSaldoFinal = $this->tipoSaldoFinal WHERE idFolhaPonto = $this->idFolhaPonto";
        $result = $this -> query($sql, true);
    }

    /**
     * selectFolhaPonto() Function
     */
    function selectFolhaPonto($where = "WHERE 1") {
        $sql = "SELECT SQL_CACHE idFolhaPonto, finalizada, obs, funcionario_idFuncionario, dataReferencia, dataCadastro, dataFinalizada, saldoInicial, tipoSaldoInicial, saldoFinal, tipoSaldoFinal FROM folhaPonto " . $where;
     //   echo $sql;
        //exit;
        return $this -> executeQuery($sql);
    }

    /**
     * selectFolhaPontoTr() Function
     */
    function selectFolhaPontoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $idFuncionario) {
		            
   //     $Professor = new Professor();
  //      $IntegranteGrupo = new IntegranteGrupo();
   //     $jaForamInseridos = array();
        $dataAtual = date('Y-m-d');
   //     if($add=="")
  //      $where .= "WHERE planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo ";
  //      else
  //      $where = $add;
 //       if( $idProfessor_base ) $where .= " AND professor_idProfessor = $idProfessor_base";
        $where .= " ORDER BY dataReferencia";
        
 //       $rsFF = $this->selectFolhaPonto($where);
     //   Uteis::pr($rsFF);
        
        if ($rsFF) {
            foreach ($rsFF as $value) {$dataReferencia = date('m/Y', strtotime($valorFF[0]['dataReferencia']));
                
                $idFolhaPonto = $value['idFolhaPonto'];
                $idProfessor = $value['professor_idProfessor'];
                $dataReferencia = date('m/Y', strtotime($value['dataReferencia']));
                $nomeProfessor = $Professor -> getNome($idProfessor);
                $finalizadaParcial = Uteis::exibirStatus($value['finalizadaParcial']);
                $finalizadaPrincipal = Uteis::exibirStatus($value['finalizadaPrincipal']);              
                
                $jaForamInseridos[] = $idProfessor."_".$dataReferencia;
				if ($mobile != 1) {
                $onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idFolhaPonto=$idFolhaPonto&Ndados=$Ndados', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "?idFolhaPonto=$idFolhaPonto&Ndados=$Ndados', '#centro')\" ";	
				}
                $html .= "<tr>";            
                
                $html .= "<td >" . strtotime($value['dataReferencia']) . "</td>";
                            
                $html .= "<td align=\"center\" $onclick >" . $dataReferencia . "</td>";
				if(!$idProfessor_base)
                $html .= "<td align=\"center\" $onclick >" . $nomeProfessor . "</td>";

                $html .= "<td align=\"center\" $onclick >" . $finalizadaParcial . "</td>";

                $html .= "<td align=\"center\" $onclick >" . $finalizadaPrincipal . "</td>";

                $html .= "</tr>";   
                
            }
        }
        
        $sql = " SELECT DISTINCT(AG.professor_idProfessor), PAG.idPlanoAcaoGrupo, 'AP' AS origem 
        , CAST(CONCAT( YEAR(AG.dataInicio), '-', MONTH(AG.dataInicio), '-01') AS DATE) AS dataInicio
        , CAST(CONCAT( YEAR(AG.dataFim), '-', MONTH(AG.dataFim), '-01') AS DATE) AS dataFim
        FROM planoAcaoGrupo AS PAG  
        INNER JOIN  aulaPermanenteGrupo AS AP ON AP.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
        INNER JOIN aulaGrupoProfessor AS AG ON AG.aulaPermanenteGrupo_idAulaPermanenteGrupo = AP.idAulaPermanenteGrupo 
        WHERE PAG.idPlanoAcaoGrupo in (".$idPlanoAcaoGrupo.") AND AG.dataInicio <= DATE_ADD(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), INTERVAL -1 DAY) "; 
        
        if( $idProfessor_base ) $sql .= " AND AG.professor_idProfessor = $idProfessor_base ";  
        
        $sql .= " UNION  
        SELECT DISTINCT(AG.professor_idProfessor), PAG.idPlanoAcaoGrupo, 'AF' AS origem         
        ,CAST(
            (SELECT MIN(AG2.dataInicio) FROM aulaGrupoProfessor AS AG2 
            WHERE AG2.aulaDataFixa_idAulaDataFixa IN(
                SELECT AF2.idAulaDataFixa FROM aulaDataFixa AS AF2 
                WHERE AF2.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
            ) AND AG2.professor_idProfessor = AG.professor_idProfessor) AS DATE
        ) AS dataInicio     
        ,CAST(
            (SELECT MAX(AG3.dataFim) FROM aulaGrupoProfessor AS AG3
            WHERE AG3.aulaDataFixa_idAulaDataFixa IN(       
                SELECT AF3.idAulaDataFixa FROM aulaDataFixa AS AF3 
                WHERE AF3.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo AND AF3.excluido = 0
            ) AND AG3.professor_idProfessor = AG.professor_idProfessor) AS DATE
        ) AS dataFim
        FROM planoAcaoGrupo AS PAG 
        INNER JOIN aulaDataFixa AS AF ON AF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo AND AF.excluido = 0
        INNER JOIN aulaGrupoProfessor AS AG ON AG.aulaDataFixa_idAulaDataFixa = AF.idAulaDataFixa   
        WHERE PAG.idPlanoAcaoGrupo in (".$idPlanoAcaoGrupo.") AND AG.dataInicio <= DATE_ADD(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), INTERVAL -1 DAY)";
        
        if( $idProfessor_base ) $sql .= " AND AG.professor_idProfessor = $idProfessor_base ";  
        
        $sql .= " GROUP BY AG.professor_idProfessor ";
        
        $result = $this -> query($sql);
 //      echo "<hr>".$sql;

        if (mysqli_num_rows($result) > 0) {
            
            while ($valor = mysqli_fetch_array($result)) {

       //         $idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
                $idProfessor = $valor['professor_idProfessor'];

/*                
                $dataParaCalculo = ($valor['dataFim'] && $valor['dataFim'] < $dataAtual) ? $valor['dataFim'] : $dataAtual;
  */		
  			$dataInicio = $valor['dataInicio'];
  			$dataX = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataAtual))));
			$dataParaCalculo = date($valor['dataFim'] && $valor['dataFim'] < $dataAtual) ? $valor['dataFim'] : $dataX;    
	              
                $diferenca = Uteis::diferencaEntreDatas($dataInicio, $dataParaCalculo, "m");
        
                if ($diferenca >= 0) {
                        
                    $nomeProfessor = $Professor -> getNome($idProfessor);                       
                    
                    for ($m = 0; $m <= $diferenca; $m++) {

                        $dataReferencia_base = strtotime("+$m months", strtotime($dataInicio));
                        $dataReferencia = date('m/Y', $dataReferencia_base);
                        $dataReferencia2 = date('Y-m', $dataReferencia_base) . "-01";
                        $valorParaProcurar = $idProfessor . "_" . $dataReferencia;

                        $rsIntegranteGrupo = $IntegranteGrupo -> selectIntegranteGrupoFF($idPlanoAcaoGrupo, $dataReferencia2);

                        if ($rsIntegranteGrupo && !in_array($valorParaProcurar, $jaForamInseridos)) {

                            $jaForamInseridos[] = $valorParaProcurar;
                            
                            $onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&idProfessor=" . $idProfessor . "&dataReferencia=" . $dataReferencia . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
                            
                            $html .= "<tr>";

                            $html .= "<td >" . $dataReferencia_base . "</td>";
                            
                            $html .= "<td align=\"center\" $onclick >" . $dataReferencia . " - <font color=\"#FF0000\">folha de frequência ainda não foi gerada</font></td>";
							if(!$idProfessor_base)
                            $html .= "<td align=\"center\" $onclick >" . $nomeProfessor . "</td>";

                            $html .= "<td align=\"center\" $onclick ></td>";

                            $html .= "<td align=\"center\" $onclick ></td>";

                            $html .= "</tr>";

                        }
                    }

                }
            }
        }
        return $html;
    }
	
	 function selectFolhaPontoTrTotal($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $idFuncionario) {
		 
			$valorFolhaPonto = $this->selectFolhaPonto(" WHERE funcionario_idFuncionario = $idFuncionario ");
															
			foreach ($valorFolhaPonto as $valor) {
				
				$finalizada = Uteis::exibirStatus($valor['finalizada']);
				$idFolhaPonto = $valor['idFolhaPonto'];
				$saldoInicial = $valor['saldoInicial'];
				if ($valor['tipoSaldoInicial'] == 0) {
					$tipoSaldoInicial = "Crédito";
				} else {
					$tipoSaldoInicial = "Débito";
				}
				
				if ($valor['tipoSaldoFinal'] == 0) {
					$tipoSaldoFinal = "Crédito";
				} else {
					$tipoSaldoFinal = "Débito";
				}
												
				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idFolhaPonto=" . $idFolhaPonto . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				$html .= "<tr>";
				$html .= "<td></td>";
                  
				$html .= "<td align=\"center\" $onclick >" . Uteis::exibirData($valor['dataReferencia']) . "</td>";
						
	            $html .= "<td align=\"center\" $onclick >" . $finalizada . "</td>";

				$html .= "<td align=\"center\" $onclick $font>". Uteis::exibirHoras($saldoInicial)."</td>";
			
				$html .= "<td align=\"center\" $onclick $font>". $tipoSaldoInicial."</td>";
				
				$html .= "<td align=\"center\" $onclick $font>". Uteis::exibirHoras($valor['saldoFinal'])."</td>";
				
				$html .= "<td align=\"center\" $onclick $font>". $tipoSaldoFinal."</td>";
							
				$html .= "<td align=\"center\">";
						
				$html .= "<img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"Desativar Folha de Ponto\" 
				onclick=\"deletaRegistro('" . CAMINHO_CAD . "funcionario/include/acao/folhaPonto.php', '" .  $valor['idFolhaPonto'] . "', '$caminhoAtualizar', '$ondeAtualiza')\" />";	
				
				
				$html .= "</td>";
		        $html .= "</tr>";
								
			}
       
        return $html;
    }

    /**
     * selectFolhaPontoSelect() Function
     */
    function selectFolhaPontoSelect($classes = "", $idAtual = 0, $where = "") {
        $sql = "SELECT SQL_CACHE idFolhaPonto, finalizadaParcial, finalizadaPrincipal, obs, planoAcaoGrupo_idPlanoAcaoGrupo, professor_idProfessor, dataReferencia, dataCadastro 
        FROM FolhaPonto " . $where;
        $result = $this -> query($sql);
        $html = "<select id=\"idFolhaPonto\" name=\"idFolhaPonto\"  class=\"" . $classes . "\" >";
        $html .= "<option value=\"\">Selecione</option>";
        while ($valor = mysqli_fetch_array($result)) {
            $selecionado = $idAtual == $valor['idFolhaPonto'] ? "selected=\"selected\"" : "";
            $html .= "<option " . $selecionado . " value=\"" . $valor['idFolhaPonto'] . "\">" . ($valor['idFolhaPonto']) . "</option>";
        }

        $html .= "</select>";
        return $html;
    }

    function selectFFtr_rh($caminho, $caminhoAtualiza, $idPlanoAcaoGrupo, $idIntegranteGrupo) {

        $html = "";

        $DiaAulaFF = new DiaAulaFF();
        $DiaAulaFFIndividual = new DiaAulaFFIndividual();
        $Relatorio = new Relatorio();
                
        $where = "WHERE FF.planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND FF.finalizadaPrincipal = 1 AND IG.idIntegranteGrupo IN ($idIntegranteGrupo)";
        $result = $Relatorio->relatorioFrequencia_mensal($where);
        
        if ($result) {
            
            $ClientePj = new ClientePj();
                        
            $soma_horaRealizadaTotal = 0;
            $soma_horaRealizadaAlunoTotal = 0;
            $horaFaltaJustificadaAlunoTotal = 0;
            
            $html .= "<tbody>";
            
            foreach($result as $valor){
                
                $idFolhaPonto = $valor['idFolhaPonto'];
                $mes = $valor['mes'];
                $ano = $valor['ano'];
                $idProfessor = $valor['idProfessor'];
                $dataReferencia = "$mes/$ano";
                $nomeProfessor = $valor['nomeProfessor'];
                
                $horaRealizadaTotal = $valor['horasRealizadasPeloGrupo'] + $valor['somarCom_horasRealizadasPeloGrupo'] ;
                $horaRealizadaAlunoTotal = $valor['horaRealizadaAluno'];
                $horaFaltaJustificadaAlunoTotal = $valor['aulasJustificadas_aluno'];
                
                $horaRealizadaAlunoTotal_percentual = ($ClientePj->get_faltaJustificadaPresenca($valor['idClientePj'])) ? ($horaRealizadaAlunoTotal+$horaFaltaJustificadaAlunoTotal) : $horaRealizadaAlunoTotal;        
                $horaRealizadaAlunoTotal_percentual = Uteis::formatarMoeda($horaRealizadaAlunoTotal_percentual * 100 / $horaRealizadaTotal);

                $onclick = " onclick=\"abrirNivelPagina(this, '$caminho?idFolhaPonto=$idFolhaPonto&idProfessor=$idProfessor&idPlanoAcaoGrupo=$idPlanoAcaoGrupo&idIntegranteGrupo=$idIntegranteGrupo&mes=$mes&ano=$ano', '$caminhoAtualiza', '')\" ";

                $soma_horaRealizadaTotal += $horaRealizadaTotal;
                $soma_horaRealizadaAlunoTotal += $horaRealizadaAlunoTotal;
                $soma_horaFaltaJustificadaAlunoTotal += $horaFaltaJustificadaAlunoTotal;

                $horaRealizadaTotal = Uteis::exibirHoras($horaRealizadaTotal);
                $horaRealizadaAlunoTotal = Uteis::exibirHoras($horaRealizadaAlunoTotal);
                $horaFaltaJustificadaAlunoTotal = Uteis::exibirHoras($horaFaltaJustificadaAlunoTotal);

                $html .= "<tr align=\"center\">
                    
                    <td >" . $ano.$mes . "</td>
                    
                    <td $onclick >" . $dataReferencia . "</td>
                    
                    <td $onclick >".$nomeProfessor."</td>
                    
                    <td $onclick >" . $horaRealizadaTotal . "</td>
                    
                    <td $onclick >" . $horaRealizadaAlunoTotal . "</td>
                    
                    <td $onclick >" . $horaFaltaJustificadaAlunoTotal . "</td>
                    
                    <td $onclick >" . $horaRealizadaAlunoTotal_percentual . " %</td>
                
                </tr>";

            }

            $html .= "</tbody>
            
            <tfoot>
        <tr>
            <th></th>
          <th></th>
          <th>TOTAL:</th>
          <th>" . Uteis::exibirHoras($soma_horaRealizadaTotal) . "</th>
          <th>" . Uteis::exibirHoras($soma_horaRealizadaAlunoTotal) . "</th>
          <th>" . Uteis::exibirHoras($soma_horaFaltaJustificadaAlunoTotal) . "</th>
          <th></th>
        </tr>
      </tfoot>";

        }

        return $html;

    }

    function selectFF_diasHoras($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor = "", $demonstrativo = "", $horasGerais) {
	//	echo $mesRef." ".$anoRef." ".$idProfessor." - ".$horasGerais."<br>";

        $AulaPermanenteGrupo = new AulaPermanenteGrupo();
        $AulaDataFixa = new AulaDataFixa();
        $DiaAulaFF = new DiaAulaFF();
        $NaoFazAulaNestaSemanaGrupo = new NaoFazAulaNestaSemanaGrupo();
		
		
		if($demonstrativo){
        $NaoFaturar = new PlanoAcaoGrupoNaoFaturar();        
        $data = $NaoFaturar->selectPlanoAcaoGrupoNaoFaturar("WHERE dataExcluido is null AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo");
		
		if($data[0]['data']!=""){
            $fim = date('d', strtotime($data[0]['data'])); 
            }       
        }
        //PEGA CARGA HORARIA FIXA
		$dataFim = date("Y-m-t", strtotime($anoRef."-".$mesRef."-01"));
        $sql = "SELECT SQL_CACHE cargaHorariaFixaMensal FROM valorHoraGrupo 
        WHERE dataInicio <= '".$anoRef."-".$mesRef."-01' AND (dataFim is null or dataFim >'".$dataFim."') AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo ORDER BY idValorHoraGrupo DESC LIMIT 1";
		
	//	Uteis::pr($sql);
        
        $rs = Uteis::executarQuery($sql);
       
        $cargaHorariaFixaMensal = $rs[0]['cargaHorariaFixaMensal'];
		
    	if ($horasGerais > 0 && $cargaHorariaFixaMensal > 0) {
		$cargaHorariaFixaMensal = $cargaHorariaFixaMensal - $horasGerais;	
		}

        $diasNoMes = Uteis::totalDiasMes($mesRef, $anoRef);
               
        $temAulaPermanenteGrupo = $AulaPermanenteGrupo -> ffTem_AulaPermanenteGrupo($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor);
        $temAulaDataFixa = $AulaDataFixa -> ffTem_AulaDataFixa($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor);
        $temReposicao = $DiaAulaFF -> ffTem_Reposicao($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor);
        
  //      Uteis::pr($temAulaPermanenteGrupo);
  //      Uteis::pr($temAulaDataFixa);
  //      Uteis::pr($temReposicao);
	//	echo $idProfessor;
         
        $res = array("permanente" => array(), "fixa" => array(), "reposicao" => array());

        $posPermanente = 0;
        $posFixa = 0;
        $posReposicao = 0;
        $horasTotalMes = 0;
        $excedeu = false; 
            

        for ($d = 1; $d <= $diasNoMes; $d++) {                
            
            $dia = str_pad($d, 2, '0', STR_PAD_LEFT);
            $dataAtual = date('Y-m-d', strtotime($anoRef . "-" . $mesRef . "-" . $dia));
            
            $diaDaSemanaAtual = getdate(strtotime($dataAtual));
            $diaDaSemanaAtual = $diaDaSemanaAtual['wday'] + 1;
            if ($d == 1) $diaDaSemana_InicioMes = $diaDaSemanaAtual;
            
            $idDiaAulaFF_todos = array();
			
			   //AULAS FIXAS
            if (/*!$excedeu &&*/ $temAulaDataFixa) {
                foreach ($temAulaDataFixa as $valorAulaDataFixa) {
                    if ($valorAulaDataFixa['dataAula'] == $dataAtual) {

                        $horasTotal = ($valorAulaDataFixa['horaFim'] - $valorAulaDataFixa['horaInicio']);
                        $horasTotalMes += $horasTotal;
					/*   if ($cargaHorariaFixaMensal && $horasTotalMes > $cargaHorariaFixaMensal) {
                            $excedeu = true;
                            break;
                        }*/

                        $res["fixa"][$posFixa]["id"] = $valorAulaDataFixa['idAulaDataFixa'];
                        $res["fixa"][$posFixa]["horaInicio"] = $valorAulaDataFixa['horaInicio'];
                        $res["fixa"][$posFixa]["horaFim"] = $valorAulaDataFixa['horaFim'];
                        $res["fixa"][$posFixa]["horasTotal"] = $horasTotal;
                        $res["fixa"][$posFixa]["dataAtual"] = $dataAtual;
                        $res["fixa"][$posFixa]["diaSemana"] = $diaDaSemanaAtual;
                        $res["fixa"][$posFixa]["aulaInexistente"] = $valorAulaDataFixa['aulaInexistente'];
                        $res["fixa"][$posFixa]["origem"] = "fixa";
                        
                        $posFixa++;
                    }
                }
            }

            //AULAS PERMANENTES
            if (!$excedeu && $temAulaPermanenteGrupo) {

                foreach ($temAulaPermanenteGrupo as $valorAulaPermanenteGrupo) {

                    $idAulaPermanenteGrupo = $valorAulaPermanenteGrupo['idAulaPermanenteGrupo'];

                    //PEGA SEMANAS EM QUE NÃO HAVERA AULA
                    $where_nfa = " WHERE aulaPermanenteGrupo_idAulaPermanenteGrupo = $idAulaPermanenteGrupo";
                    $rsNaoFazAulaNestaSemanaGrupo = $NaoFazAulaNestaSemanaGrupo -> selectNaoFazAulaNestaSemanaGrupo($where_nfa);

                    $semanaAtual = 0;
                    $semanasSemAula = array();
                    if ($rsNaoFazAulaNestaSemanaGrupo) {
                        $semanaAtual = Uteis::verificarNumSemana($dataAtual, $diaDaSemanaAtual, $diaDaSemana_InicioMes);                        
                        foreach ($rsNaoFazAulaNestaSemanaGrupo as $valorNaoFazAulaNestaSemanaGrupo) $semanasSemAula[] = $valorNaoFazAulaNestaSemanaGrupo['semana'];
                    };

                    if( !in_array($semanaAtual, $semanasSemAula) ) {
                        
                        $dataInicio = $valorAulaPermanenteGrupo['dataInicio'];
                        $dataFim = $valorAulaPermanenteGrupo['dataFim'];

                        if ($dataAtual >= $dataInicio && (!$dataFim || $dataAtual <= $dataFim)) {
                            
                            if ($valorAulaPermanenteGrupo['diaSemana'] == $diaDaSemanaAtual) {

                                $horasTotal = ($valorAulaPermanenteGrupo['horaFim'] - $valorAulaPermanenteGrupo['horaInicio']);
                                $horasTotalMes += $horasTotal;
                                if ($cargaHorariaFixaMensal && $horasTotalMes > $cargaHorariaFixaMensal) /*&& !$temAulaDataFixa)*/ {                                  
                                    $excedeu = true;
                                    break;
                                }

                                $res["permanente"][$posPermanente]["id"] = $idAulaPermanenteGrupo;
                                $res["permanente"][$posPermanente]["horaInicio"] = $valorAulaPermanenteGrupo['horaInicio'];
                                $res["permanente"][$posPermanente]["horaFim"] = $valorAulaPermanenteGrupo['horaFim'];
                                $res["permanente"][$posPermanente]["horasTotal"] = $horasTotal;
                                $res["permanente"][$posPermanente]["dataAtual"] = $dataAtual;
                                $res["permanente"][$posPermanente]["diaSemana"] = $diaDaSemanaAtual;
                                $res["permanente"][$posPermanente]["aulaInexistente"] = $valorAulaPermanenteGrupo['aulaInexistente'];
                                $res["permanente"][$posPermanente]["origem"] = "permanente";
                                
                                $posPermanente++;
                            }
                        }
                    }
                }
            }

         

            //REPOSIÇOES
            if ($temReposicao) {
                foreach ($temReposicao as $valorReposicao) {
                    if ($valorReposicao['dataAula'] == $dataAtual) {
                        $res["reposicao"][$posReposicao]["id"] = $valorReposicao['idDiaAulaFF'];
                        $res["reposicao"][$posReposicao]["horasTotal"] = $valorReposicao['horaRealizada'];
                        $res["reposicao"][$posReposicao]["dataAtual"] = $dataAtual;
                        $res["reposicao"][$posReposicao]["diaSemana"] = $diaDaSemanaAtual;
                        $res["reposicao"][$posReposicao]["origem"] = "reposicao";
                        $posReposicao++;
                    }
                }
            } else {
                if ($excedeu && !$temReposicao && !$temAulaDataFixa) {
        //         echo "excedeu";
				    break;
				}
            }

            }
  //         echo "<br>11111: ".$mesRef."-".$horasTotalMes;
 //       echo"<pre>";print_r($res);echo"</pre>";
        return $res;
    }

    function verificaDiasFF($idFolhaPonto = "", $idDiaAulaFF_todos = array()) {
        
        //DELETAR DIAS QUE NÃO ESTÃO MAIS NA FOLHA DE FREQUENCIA GERAL
        if ($idFolhaPonto != '' && is_array($idDiaAulaFF_todos) ) {
            //INFS DA FF INDIVIDUAL(sem reposição)
            $sql = "SELECT SQL_CACHE idDiaAulaFF FROM diaAulaFF 
            WHERE reposicao = 0 AND aulaInexistente = 0 AND FolhaPonto_idFolhaPonto = $idFolhaPonto ";
            //echo "$sql";exit;
            $rsDiaAulaFF = Uteis::executarQuery($sql);
      if (count($rsDiaAulaFF) > 0) {
                $DiaAulaFF = new DiaAulaFF();
                foreach ($rsDiaAulaFF as $valorDiaAulaFF) {
                    if (!in_array($valorDiaAulaFF['idDiaAulaFF'], $idDiaAulaFF_todos)) {
                        $DiaAulaFF -> setIdDiaAulaFF($valorDiaAulaFF['idDiaAulaFF']);
                        $DiaAulaFF -> deleteDiaAulaFF();
                    }
                }
            }

        }

        //DELETAR DIAS QUE NÃO ESTÃO MAIS NA FF INDIVIDUAL
        if ($idFolhaPonto != '') {
            //SELECIONA DIAS DA FF INDIVIDUAL QUE SAO MAIORES Q A DATA DE SAIDA DO ALUNO, OU SEJA NAO DEVERIAM MAIS ESTAR NA FF
            $sql = "SELECT SQL_CACHE DISTINCT(DFI.idDiaAulaFFIndividual) FROM diaAulaFF AS DF 
            INNER JOIN diaAulaFFIndividual AS DFI ON DFI.diaAulaFF_idDiaAulaFF = DF.idDiaAulaFF 
            INNER JOIN integranteGrupo AS I ON I.idIntegranteGrupo = DFI.integranteGrupo_idIntegranteGrupo 
            WHERE DF.FolhaPonto_idFolhaPonto = $idFolhaPonto 
            AND DF.dataAula > I.dataSaida";
            //echo $sql;
            //exit;
            $rs = Uteis::executarQuery($sql);
            if (count($rs) > 0) {
                $DiaAulaFFIndividual = new DiaAulaFFIndividual();
                foreach ($rs as $valor) {
                    $DiaAulaFFIndividual -> setIdDiaAulaFFIndividual($valor['idDiaAulaFFIndividual']);
                    $DiaAulaFFIndividual -> deleteDiaAulaFFIndividual();
                }
            }
        }

    }
	
	function selectFolhaPontoMax($idPlanoAcaoGrupo) {
	
	$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$idPlanoAcaoGrupo.") AND finalizadaPrincipal = 1 order by dataReferencia DESC";
	$valorFolha = $this->selectFolhaPonto($where);	
	$data = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($valorFolha[0]['dataReferencia']))));
		
	return $data;
	}
	
	function selectFolhaPontoPrimeira($idPlanoAcaoGrupo) {
	
	$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$idPlanoAcaoGrupo.") AND finalizadaPrincipal = 1 order by dataReferencia ASC";
	$valorFolha = $this->selectFolhaPonto($where);	
	$data = $valorFolha[0]['dataReferencia'];
		
	return $data;
	}

}
?>