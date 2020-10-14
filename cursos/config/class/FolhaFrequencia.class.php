<?php
class FolhaFrequencia extends Database {
    // class attributes
    var $idFolhaFrequencia;
    var $finalizadaParcial;
    var $finalizadaPrincipal;
    var $obs;
    var $planoAcaoGrupoIdPlanoAcaoGrupo;
    var $professorIdProfessor;
    var $dataReferencia;
    var $dataCadastro;
	var $dataFinalizada;


    // constructor
    function __construct() {
        parent::__construct();
        $this -> idFolhaFrequencia = "NULL";
        $this -> finalizadaParcial = "0";
        $this -> finalizadaPrincipal = "0";
        $this -> obs = "NULL";
        $this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
        $this -> professorIdProfessor = "NULL";
        $this -> dataReferencia = "NULL";
        $this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> dataFinalizada = "NULL";


    }

    function __destruct() {
        parent::__destruct();
    }

    // class methods
    function setIdFolhaFrequencia($value) {
        $this -> idFolhaFrequencia = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setFinalizadaParcial($value) {
        $this -> finalizadaParcial = ($value) ? $this -> gravarBD($value) : "0";
    }

    function setFinalizadaPrincipal($value) {
        $this -> finalizadaPrincipal = ($value) ? $this -> gravarBD($value) : "0";
    }

    function setObs($value) {
        $this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
        $this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setProfessorIdProfessor($value) {
        $this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
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


    /**
     * addFolhaFrequencia() Function
     */
    function addFolhaFrequencia() {
        $sql = "INSERT INTO folhaFrequencia (finalizadaParcial, finalizadaPrincipal, obs, planoAcaoGrupo_idPlanoAcaoGrupo, professor_idProfessor, dataReferencia, dataCadastro, dataFinalizada) VALUES ($this->finalizadaParcial, $this->finalizadaPrincipal, $this->obs, $this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->professorIdProfessor, $this->dataReferencia, $this->dataCadastro, $this->dataFinalizada)";
        $result = $this -> query($sql, true);
        return mysql_insert_id($this -> connect);
    }

    /**
     * deleteFolhaFrequencia() Function
     */
    function deleteFolhaFrequencia() {
        $sql = "DELETE FROM folhaFrequencia WHERE idFolhaFrequencia = $this->idFolhaFrequencia";
        $result = $this -> query($sql, true);
    }

    /**
     * updateFieldFolhaFrequencia() Function
     */
    function updateFieldFolhaFrequencia($field, $value) {
        $value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
        $sql = "UPDATE folhaFrequencia SET " . $field . " = " . $value . " WHERE idFolhaFrequencia = $this->idFolhaFrequencia";
	//	echo $sql;
        $result = $this -> query($sql, true);
    }

    /**
     * updateFolhaFrequencia() Function
     */
    function updateFolhaFrequencia() {
        $sql = "UPDATE folhaFrequencia SET finalizadaParcial = $this->finalizadaParcial, finalizadaPrincipal = $this->finalizadaPrincipal, obs = $this->obs, planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, professor_idProfessor = $this->professorIdProfessor, dataReferencia = $this->dataReferencia, dataFinalizada = $this->dataFinalizada WHERE idFolhaFrequencia = $this->idFolhaFrequencia";
        $result = $this -> query($sql, true);
    }

    /**
     * selectFolhaFrequencia() Function
     */
    function selectFolhaFrequencia($where = "WHERE 1") {
        $sql = "SELECT SQL_CACHE idFolhaFrequencia, finalizadaParcial, finalizadaPrincipal, obs, planoAcaoGrupo_idPlanoAcaoGrupo, professor_idProfessor, dataReferencia, dataCadastro, dataFinalizada FROM folhaFrequencia " . $where;
 //       echo $sql;
        //exit;
        return $this -> executeQuery($sql);
    }

    /**
     * selectFolhaFrequenciaTr() Function
     */
    function selectFolhaFrequenciaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $idPlanoAcaoGrupo, $idProfessor_base = "", $add = "", $Ndados, $mobile) {
		            
        $Professor = new Professor();
        $IntegranteGrupo = new IntegranteGrupo();
        $jaForamInseridos = array();
        $dataAtual = date('Y-m-d');
        if($add=="")
        $where .= "WHERE planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo ORDER BY dataReferencia";
        else
        $where = $add;
        if( $idProfessor_base ) $where .= " AND professor_idProfessor = $idProfessor_base";
      //  $where .= " ORDER BY dataReferencia";
        
        $rsFF = $this->selectFolhaFrequencia($where);
     //   Uteis::pr($rsFF);
        
        if ($rsFF) {
            foreach ($rsFF as $value) {$dataReferencia = date('m/Y', strtotime($valorFF[0]['dataReferencia']));
                
                $idFolhaFrequencia = $value['idFolhaFrequencia'];
                $idProfessor = $value['professor_idProfessor'];
                $dataReferencia = date('m/Y', strtotime($value['dataReferencia']));
                $nomeProfessor = $Professor -> getNome($idProfessor);
                $finalizadaParcial = Uteis::exibirStatus($value['finalizadaParcial']);
                $finalizadaPrincipal = Uteis::exibirStatus($value['finalizadaPrincipal']);              
                
                $jaForamInseridos[] = $idProfessor."_".$dataReferencia;
				if ($mobile != 1) {
                $onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idFolhaFrequencia=$idFolhaFrequencia&Ndados=$Ndados', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "?idFolhaFrequencia=$idFolhaFrequencia&Ndados=$Ndados', '#centro')\" ";	
				$professor = 1;
				}
                $html .= "<tr>";            
                if ($professor != 1) {
                	$html .= "<td >" . strtotime($value['dataReferencia']) . "</td>";
				}
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
	
	 function selectFolhaFrequenciaTrTotal($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $idPlanoAcaoGrupo, $idProfessor_base = "", $add = "") {
		 
		$PlanoAcaoGrupoId = new PlanoAcaoGrupo();
		$Professor = new Professor();
        $IntegranteGrupo = new IntegranteGrupo();
		$AulaGrupoProfessor = new AulaGrupoProfessor();
		
        	
		$rs = explode(",",$idPlanoAcaoGrupo);
        $idPlanoAcaoGrupoTmp = $rs[0]; //substr($idPlanoAcaoGrupo, -3);
		$idGrupo = $PlanoAcaoGrupoId->getIdGrupo($idPlanoAcaoGrupoTmp);
		$idPlanoAcaoGrupoAtual = $PlanoAcaoGrupoId->getPAG_atual($idGrupo);
		        
        $jaForamInseridos = array();
        $dataAtual = date('Y-m-d');
        if($add=="")
        $where .= "WHERE planoAcaoGrupo_idPlanoAcaoGrupo in ( $idPlanoAcaoGrupo )";
        else
        $where = $add;
        if( $idProfessor_base ) $where .= " AND professor_idProfessor = $idProfessor_base";
        $where .= " ORDER BY dataReferencia";
 //      echo $where;
        $rsFF = $this->selectFolhaFrequencia($where);
 //       Uteis::pr($rsFF);

        if ($rsFF) {
            foreach ($rsFF as $value) {
				
				//$dataReferencia = date('m/Y', strtotime($valorFF[0]['dataReferencia']));
			
				
		        $idFolhaFrequencia = $value['idFolhaFrequencia'];
                $idProfessor = $value['professor_idProfessor'];
                $dataReferencia = date('m/Y', strtotime($value['dataReferencia']));
                $nomeProfessor = $Professor -> getNome($idProfessor);
                $finalizadaParcial = Uteis::exibirStatus($value['finalizadaParcial']);
				$finalizadaPrincipal = Uteis::exibirStatus($value['finalizadaPrincipal']);
				$idPlanoAcaoGrupoP = $value['planoAcaoGrupo_idPlanoAcaoGrupo'];


                $jaForamInseridos[] = $idProfessor."_".$dataReferencia;
                $onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idFolhaFrequencia=$idFolhaFrequencia', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				
				$finalizarPri =  "<button class=\"button blue\"  
            onclick=\"finalizarProfessorPri('1','$idFolhaFrequencia','$idProfessor');\" > Finalizar</button>";
			
				$desFinalizarPri =  "<button class=\"button blue\"  
             onclick=\"finalizarProfessorPri('0','$idFolhaFrequencia','$idProfessor');\" > Desfinalizar</button><input type=\"checkbox\" name=\"idh[]\" value=\"$idFolhaFrequencia\" title=\"Selecionar esta data para alteração múltipla\">";

                $html .= "<tr>";
                $html .= "<td >" . strtotime($value['dataReferencia']) . "</td>";
                $html .= "<td align=\"center\" $onclick >" . $dataReferencia . "</td>";
                $html .= "<td align=\"center\" $onclick >" . $nomeProfessor . "</td>";
                $html .= "<td align=\"center\" $onclick >" . $finalizadaParcial . "</td>";
                $html .= "<td align=\"center\" $onclick >" . $finalizadaPrincipal . "</td>";

                // calcula horas
                $anoRef = date('Y', strtotime($value['dataReferencia']));
                $mesRef = date('m', strtotime($value['dataReferencia']));
				
				
				$valorProfessor = $AulaGrupoProfessor ->selectAulaGrupoProfessor_periodo($idPlanoAcaoGrupoAtual, $value['dataReferencia']);
		
	//	Uteis::pr($valorProfessor);
				        $totalHorasAulas = 0;
						$qP = 0;
				foreach ($valorProfessor as $valorP) {
						$qP++;
						$totalHorasProfessor = 0;
						if ($valorP != $idProfessor) {
						
						$rsFFT = $this->selectFF_diasHoras($idPlanoAcaoGrupoP, $anoRef, $mesRef, $valorP," ",$totalHorasAulas);
						 $rsFF_pf2 = array_merge($rsFF['permanente'], $rsFF['fixa']);

                //Uteis::pr($rsFF_pf);
        
				
                foreach($rsFF_pf2 as $valorFF2){
                    //foreach($rsFF['permanente'] as $valorPermanente){

                    //INF GERAIS
                //    $dataAtual = $valorFF["dataAtual"];
                 //   $diaDaSemanaAtual = $valorFF["diaSemana"];
                //    $horaInicio = $valorFF["horaInicio"];
                //    $horaFim = $valorFF["horaFim"];
                    $horasTotal = $valorFF2["horasTotal"];
                    $totalHorasAulas += $horasTotal;
					$totalHorasProfessor += $horasTotal;
                	
				}
		//		echo $totalHorasProfessor."<br>";
						}
						
			if ($qP > 1) {
				 $font = "style=\"color:red;\"";	
				} else {
				 $font = "";	
			}
						
				}
                $rsFF = $this->selectFF_diasHoras($idPlanoAcaoGrupoP, $anoRef, $mesRef, $idProfessor," ",$totalHorasAulas);
        //        Uteis::pr($rsFF);
                $rsFF_pf = array_merge($rsFF['permanente'], $rsFF['fixa']);

                //Uteis::pr($rsFF_pf);
        
				$totalHorasAulas = 0;
                foreach($rsFF_pf as $valorFF){
                    //foreach($rsFF['permanente'] as $valorPermanente){

                    //INF GERAIS
                    $dataAtual = $valorFF["dataAtual"];
                    $diaDaSemanaAtual = $valorFF["diaSemana"];
                    $horaInicio = $valorFF["horaInicio"];
                    $horaFim = $valorFF["horaFim"];
                    $horasTotal = $valorFF["horasTotal"];
                    $totalHorasAulas += $horasTotal;
				//	$totalHorasProfessor += $horasTotal;
                	
				}
		//		echo $totalHorasAulas;
				
				
	
                $html .= "<td align=\"center\" $onclick  $font>" . Uteis::exibirHoras($totalHorasAulas) . "</td>";
				$html .= "<td align=\"center\"> ";
				
                    if ($value['finalizadaParcial'] == 1) {

                        if  ($value['finalizadaPrincipal'] == 1) {

                        $html .= $desFinalizarPri." ".$podeExcluir;

                        } else {

                        $html .= $finalizarPri." ".$podeExcluir;;

                        }

                    } else {
                    $podeExcluir = "<img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"Desativar Folha de Frequência\"
                    onclick=\"deletaRegistro('" . CAMINHO_REL . "grupo/include/acao/folhaFrequencia.php', '" .  $idFolhaFrequencia . "', '$caminhoAtualizar', '$ondeAtualiza')\" />";

                    $html .= $podeExcluir;

                    }
				    $podeExcluir = " ";
				
				$html .= "</td>";

                $html .= "</tr>";   
                
            }
        }
		
			$idPlanoAcaoGrupo = $idPlanoAcaoGrupoAtual;        
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
		
	    
		$result2 = Uteis::executarQuery($sql);
		
		
        $result = $this -> query($sql);


        if (mysqli_num_rows($result) > 0) {
			
			
     
            while ($valor = mysqli_fetch_array($result)) {

                $idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
	             $idProfessor = $valor['professor_idProfessor'];

                $dataInicio = $valor['dataInicio'];
			
			$dataX = date("Y-m-d", strtotime("-1 days", strtotime("+3 months", strtotime($dataAtual))));

			$dataParaCalculo = date($valor['dataFim'] && $valor['dataFim'] < $dataAtual) ? $valor['dataFim'] : $dataX;    
			
                $diferenca = Uteis::diferencaEntreDatas($dataInicio, $dataParaCalculo, "m");
						
       
                if ($diferenca >= 0) {
                        
                    $nomeProfessor = $Professor -> getNome($idProfessor);  
				//	echo $diferenca."Professor: ".$idProfessor."<br>";                     
                    
                    for ($m = 0; $m <= $diferenca; $m++) {
						
		                $dataReferencia_base = strtotime("+$m months", strtotime($dataInicio));
                        $dataReferencia = date('m/Y', $dataReferencia_base);
						
                        $dataReferencia2 = date('Y-m', $dataReferencia_base) . "-01";
						$anoRef = date("Y", strtotime($dataReferencia2));
						$mesRef = date("m", strtotime($dataReferencia2));
						
		
						
			           $valorParaProcurar = $idProfessor . "_" . $dataReferencia;

                        $rsIntegranteGrupo = $IntegranteGrupo -> selectIntegranteGrupoFF($idPlanoAcaoGrupo, $dataReferencia2);
						
						

                        if ($rsIntegranteGrupo && !in_array($valorParaProcurar, $jaForamInseridos)) {
								
					         $jaForamInseridos[] = $valorParaProcurar;
																					
							//Não Aparece folhas não geradas a 6 meses atrás.
							
							$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("-4 months", strtotime($dataAtual))));
													
							if ($dataReferencia2 > $dataReferenciaFinal) {
								
											
								$dataCriarFF = date("Y-m-01");
														
								if ($dataReferencia2 != $dataCriarFF) {
								
								$idPlanoAcaoGrupo = $idPlanoAcaoGrupoAtual;
								                            
                            $onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupoAtual . "&idProfessor=" . $idProfessor . "&dataReferencia=" . $dataReferencia . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
                            
                            $html .= "<tr>";

                            $html .= "<td >" . $dataReferencia_base . "</td>";
                            
							$html .= "<td align=\"center\" $onclick >" . $dataReferencia . " - <font color=\"#FF0000\">folha de frequência ainda não foi gerada.</font></td>";
						
						    $html .= "<td align=\"center\" $onclick >" . $nomeProfessor . "</td>";

                            $html .= "<td align=\"center\" $onclick ></td>";

                            $html .= "<td align=\"center\" $onclick ></td>";

                            $html .= "<td align=\"center\"> </td>";
							
							$html .= "<td align=\"center\"> </td>";
							
                            $html .= "</tr>";
							} else {

								
								$mesRef = date("m", strtotime($dataCriarFF));
								$anoRef = date("Y", strtotime($dataCriarFF));
								
								$this->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);	
								$this->setProfessorIdProfessor($idProfessor);	
								$this->setDataReferencia($anoRef."-".$mesRef."-01");
								$idFolhaFrequencia = $this->addFolhaFrequencia();		
								
								// Inserindo Periodo de acompanhamento
								
           $periodo = new PeriodoAcompanhamentoCurso();
           $p = $periodo->selectPeriodoAcompanhamentoCurso("WHERE mes = $mes_ref AND ano = $ano_ref");
           $novo = new AcompanhamentoCurso();
           $novo->setPeriodoAcompanhamentoCursoIdPeriodoAcompanhamentoCurso($p[0]['idPeriodoAcompanhamentoCurso']);
           $novo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
           $novo->setProfessorIdProfessor($idProfessor);
           $rs = $novo->addAcompanhamentoCurso();  
	//	   Uteis::pr($rs); 
								
								
								
								$valorFolhaFrequencia = $this->selectFolhaFrequencia(" WHERE idFolhaFrequencia = $idFolhaFrequencia ");
															
							    $finalizadaParcial = Uteis::exibirStatus($valorFolhaFrequencia[0]['finalizadaParcial']);
								$finalizadaPrincipal = Uteis::exibirStatus($valorFolhaFrequencia[0]['finalizadaPrincipal']); 
								
								$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idFolhaFrequencia=" . $idFolhaFrequencia . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
								
							$html .= "<tr>";

                            $html .= "<td >" . $dataReferencia_base . "</td>";
                            
							$html .= "<td align=\"center\" $onclick >" . $dataReferencia . " - <font color=\"#FF0000\"></font></td>";
						
						    $html .= "<td align=\"center\" $onclick >" . $nomeProfessor . "</td>";

                            $html .= "<td align=\"center\" $onclick >" . $finalizadaParcial . "</td>";

                            $html .= "<td align=\"center\" $onclick >" . $finalizadaPrincipal . "</td>";
                            
							$html .= "<td align=\"center\" $onclick $font>". Uteis::exibirHoras($totalHorasAulas)."</td>";
							
							$html .= "<td align=\"center\">";
							
			
				$html .= "<img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"Desativar Folha de Frequência\" 
				onclick=\"deletaRegistro('" . CAMINHO_REL . "grupo/include/acao/folhaFrequencia.php', '" .  $idFolhaFrequencia . "', '$caminhoAtualizar', '$ondeAtualiza')\" />";	
				
				
							$html .= "</td>";
							
                            $html .= "</tr>";
								
								}
							}
                        }
                    }

                }
            }
        }
        return $html;
    }

    /**
     * selectFolhaFrequenciaSelect() Function
     */
    function selectFolhaFrequenciaSelect($classes = "", $idAtual = 0, $where = "") {
        $sql = "SELECT SQL_CACHE idFolhaFrequencia, finalizadaParcial, finalizadaPrincipal, obs, planoAcaoGrupo_idPlanoAcaoGrupo, professor_idProfessor, dataReferencia, dataCadastro 
        FROM folhaFrequencia " . $where;
        $result = $this -> query($sql);
        $html = "<select id=\"idFolhaFrequencia\" name=\"idFolhaFrequencia\"  class=\"" . $classes . "\" >";
        $html .= "<option value=\"\">Selecione</option>";
        while ($valor = mysqli_fetch_array($result)) {
            $selecionado = $idAtual == $valor['idFolhaFrequencia'] ? "selected=\"selected\"" : "";
            $html .= "<option " . $selecionado . " value=\"" . $valor['idFolhaFrequencia'] . "\">" . ($valor['idFolhaFrequencia']) . "</option>";
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
                
                $idFolhaFrequencia = $valor['idFolhaFrequencia'];
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

                $onclick = " onclick=\"abrirNivelPagina(this, '$caminho?idFolhaFrequencia=$idFolhaFrequencia&idProfessor=$idProfessor&idPlanoAcaoGrupo=$idPlanoAcaoGrupo&idIntegranteGrupo=$idIntegranteGrupo&mes=$mes&ano=$ano', '$caminhoAtualiza', '')\" ";

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

    function verificaDiasFF($idFolhaFrequencia = "", $idDiaAulaFF_todos = array()) {
        
        //DELETAR DIAS QUE NÃO ESTÃO MAIS NA FOLHA DE FREQUENCIA GERAL
        if ($idFolhaFrequencia != '' && is_array($idDiaAulaFF_todos) ) {
            //INFS DA FF INDIVIDUAL(sem reposição)
            $sql = "SELECT SQL_CACHE idDiaAulaFF FROM diaAulaFF 
            WHERE reposicao = 0 AND aulaInexistente = 0 AND folhaFrequencia_idFolhaFrequencia = $idFolhaFrequencia ";
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
        if ($idFolhaFrequencia != '') {
            //SELECIONA DIAS DA FF INDIVIDUAL QUE SAO MAIORES Q A DATA DE SAIDA DO ALUNO, OU SEJA NAO DEVERIAM MAIS ESTAR NA FF
            $sql = "SELECT SQL_CACHE DISTINCT(DFI.idDiaAulaFFIndividual) FROM diaAulaFF AS DF 
            INNER JOIN diaAulaFFIndividual AS DFI ON DFI.diaAulaFF_idDiaAulaFF = DF.idDiaAulaFF 
            INNER JOIN integranteGrupo AS I ON I.idIntegranteGrupo = DFI.integranteGrupo_idIntegranteGrupo 
            WHERE DF.folhaFrequencia_idFolhaFrequencia = $idFolhaFrequencia 
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
	
	function selectFolhaFrequenciaMax($idPlanoAcaoGrupo) {
	
	$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$idPlanoAcaoGrupo.") AND finalizadaPrincipal = 1 order by dataReferencia DESC";
	$valorFolha = $this->selectFolhaFrequencia($where);	
	$data = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($valorFolha[0]['dataReferencia']))));
		
	return $data;
	}
	
	function selectFolhaFrequenciaPrimeira($idPlanoAcaoGrupo) {
	
	$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$idPlanoAcaoGrupo.") AND finalizadaPrincipal = 1 order by dataReferencia ASC";
	$valorFolha = $this->selectFolhaFrequencia($where);	
	$data = $valorFolha[0]['dataReferencia'];
		
	return $data;
	}

}
?>