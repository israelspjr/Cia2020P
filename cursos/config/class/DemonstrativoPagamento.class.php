<?php
class DemonstrativoPagamento extends Database {
	// class attributes
	var $idDemonstrativoPagamento;
	var $professorIdProfessor;
	var $demonstrativoPagamentoIdDemonstrativoPagamento;
	var $tipoPagamentoIdTipoPagamento;
	var $mes;
	var $ano;
	var $total;
	var $dataCadastro;
	var $dataBaixa;
    var $tipoDemo;
	var $obs;
	
	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDemonstrativoPagamento = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> demonstrativoPagamentoIdDemonstrativoPagamento = "NULL";
		$this -> tipoPagamentoIdTipoPagamento = "NULL";
		$this -> mes = "NULL";
		$this -> ano = "NULL";
		$this -> total = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> dataBaixa = "NULL";
        $this -> tipoDemo = 1;
		$this -> obs = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDemonstrativoPagamento($value) {
		$this -> idDemonstrativoPagamento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDemonstrativoPagamentoIdDemonstrativoPagamento($value) {
		$this -> demonstrativoPagamentoIdDemonstrativoPagamento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoPagamentoIdTipoPagamento($value) {
		$this -> tipoPagamentoIdTipoPagamento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMes($value) {
		$this -> mes = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAno($value) {
		$this -> ano = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTotal($value) {

		$this -> total = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setDataBaixa($value) {
		$this -> dataBaixa = ($value) ? $this -> gravarBD($value) : "NULL";
	}
    
	function setTipoDemo($value) {
        $this -> tipoDemo = ($value) ? $this -> gravarBD($value) : 1;
    }
	
	function setObs($value) {
        $this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
    }
	
	function getObs($id) {
        $valor = $this -> selectDemonstrativoPagamento(" WHERE idDemonstrativoPagamento = ".$id);
		$obs = $valor[0]['obs'];
		return $obs;
    }
	/**
	 * addDemonstrativoPagamento() Function
	 */
	function addDemonstrativoPagamento() {
		$sql = "INSERT INTO demonstrativoPagamento (professor_idProfessor, demonstrativoPagamento_idDemonstrativoPagamento, tipoPagamento_idTipoPagamento, mes, ano, total, dataCadastro, dataBaixa, tipoDemo, obs) VALUES ($this->professorIdProfessor, $this->demonstrativoPagamentoIdDemonstrativoPagamento, $this->tipoPagamentoIdTipoPagamento, $this->mes, $this->ano, $this->total, $this->dataCadastro, $this->dataBaixa, $this->tipoDemo, $this->obs)";
		//echo $sql;
		//exit;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteDemonstrativoPagamento() Function
	 */
	function deleteDemonstrativoPagamento() {

		$DemonstrativoPagamentoAulas = new DemonstrativoPagamentoAulas();
		$DemonstrativoPagamentoCredDeb = new DemonstrativoPagamentoCredDeb();
		$DemonstrativoPagamentoImposto = new DemonstrativoPagamentoImposto();

		$where = " OR demonstrativoPagamento_idDemonstrativoPagamento = " . $this -> idDemonstrativoPagamento;

		$DemonstrativoPagamentoAulas -> deleteDemonstrativoPagamentoAulas($where);
		$DemonstrativoPagamentoCredDeb -> deleteDemonstrativoPagamentoCredDeb($where);
		$DemonstrativoPagamentoImposto -> deleteDemonstrativoPagamentoImposto($where);

		$sql = "DELETE FROM demonstrativoPagamento WHERE idDemonstrativoPagamento = $this->idDemonstrativoPagamento";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDemonstrativoPagamento() Function
	 */
	function updateFieldDemonstrativoPagamento($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE demonstrativoPagamento SET " . $field . " = " . $value . " WHERE idDemonstrativoPagamento = $this->idDemonstrativoPagamento ";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDemonstrativoPagamento() Function
	 */
	function updateDemonstrativoPagamento() {
		$sql = "UPDATE demonstrativoPagamento SET professor_idProfessor = $this->professorIdProfessor, demonstrativoPagamento_idDemonstrativoPagamento = $this->demonstrativoPagamentoIdDemonstrativoPagamento, tipoPagamento_idTipoPagamento = $this->tipoPagamentoIdTipoPagamento, mes = $this->mes, ano = $this->ano, total = $this->total, dataBaixa = $this->dataBaixa, obs = $this->obs WHERE idDemonstrativoPagamento = $this->idDemonstrativoPagamento";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDemonstrativoPagamento() Function
	 */
	function selectDemonstrativoPagamento($where = "WHERE 1") {

		$sql = "SELECT SQL_CACHE idDemonstrativoPagamento, professor_idProfessor, demonstrativoPagamento_idDemonstrativoPagamento, tipoPagamento_idTipoPagamento, mes, ano, total, dataCadastro, dataBaixa, tipoDemo, obs FROM demonstrativoPagamento " . $where;
		//echo $sql;
		return $this -> 
		executeQuery($sql);
	}

	function selectDemonstrativoPagamentoTr_professor($where = "", $caminhoAbrir, $atualizar, $onde, $mobile, $admin) {

		$sql = "SELECT SQL_CACHE D.idDemonstrativoPagamento, D.mes, D.ano, D.dataBaixa, (D.total - COALESCE(D2.total, 0)) AS total
		FROM demonstrativoPagamento AS D 
		LEFT JOIN tipoBaixaPagamento AS T ON T.idTipoBaixaPagamento = D.tipoPagamento_idTipoPagamento
		LEFT JOIN demonstrativoPagamento AS D2 ON D2.idDemonstrativoPagamento = D.demonstrativoPagamento_idDemonstrativoPagamento
		" . $where;
		$result = $this -> query($sql);
		//echo $sql;
		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
				if ($admin == 1) {

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idDemonstrativoPagamento=" . $valor['idDemonstrativoPagamento'] . "', '$atualizar', '$onde')\" ";
				} else {
			$onclick = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "?idDemonstrativoPagamento=" . $valor['idDemonstrativoPagamento'] . "', '#centro')\" ";
					
					
				}

				$html .= "<tr align=\"center\">";
				
				if ($valor['mes'] < 10) {
					$mes = "0".$valor['mes'];
				} else {
					$mes = $valor['mes'];
				}
                
                $html .= "<td $onclick >01/" . $mes."/".$valor['ano']. "</td>";
   
                $html .= "<td $onclick >".Uteis::retornaNomeMes($mes)."/".$valor['ano']. "</td>";

	//			$html .= "<td >" . Uteis::exibirData($valor['dataBaixa']) . "</td>";				

				$html .= "<td $onclick >R$ " . Uteis::formatarMoeda($valor['total']) . "</td>";

				$html .= "</tr>";

			}

		}

		return $html;
	}

	function selectDemonstrativoPagamentoTr($where = "", $emAberto, $excel = false) {
		
		$Relatorio = new Relatorio();
		$DadosBancarios = new DadosBancarios();
		
		$colunas = array("Professor", "Valor", "Banco", "Foma de Pagamento");
		
		
		if ($emAberto == 1) {
			$where .= " And dataBaixa IS NULL ";
		}
		
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamento, professor_idProfessor,
		demonstrativoPagamento_idDemonstrativoPagamento, 
		tipoPagamento_idTipoPagamento, mes, ano, total, dataCadastro, dataBaixa, tipoDemo FROM demonstrativoPagamento " . $where;
		$result = $this -> query($sql);
	//	echo $sql;
		if (mysqli_num_rows($result) > 0) {

			$html .= "<tbody>";

			$Professor = new Professor();
			$TipoBaixaPagamento = new TipoBaixaPagamento();

			while ($valor = mysqli_fetch_array($result)) {

				$idDemonstrativoPagamento = $valor['idDemonstrativoPagamento'];
				$idDemonstrativoPagamento_aux = $valor['demonstrativoPagamento_idDemonstrativoPagamento'];
				$total = $valor['total'];

				if (!$idDemonstrativoPagamento_aux) {
					$totalFinal = $total;
				} else {

					$valorAnterior = $this -> selectDemonstrativoPagamento(" WHERE idDemonstrativoPagamento = $idDemonstrativoPagamento_aux");
					$valorAnterior = $valorAnterior[0]['total'];
					$totalFinal = ($total - $valorAnterior);
				}

				$mes = $valor['mes'];
				$ano = $valor['ano'];
				$idTipoPagamento = $valor['tipoPagamento_idTipoPagamento'];
				$idProfessor = $valor['professor_idProfessor'];
				$valorBanco = $DadosBancarios->selectDadosBancarios(" WHERE professor_idProfessor = ".$idProfessor);
				$nomeBanco = $valorBanco[0]['banco'];
				$nomeProfessor = $Professor -> selectProfessor(" WHERE idProfessor = " . $idProfessor);
				$nomeProfessor = $nomeProfessor[0]['nome'];
				$dataBaixa = $valor['dataBaixa'];
                $tipo = $valor['tipoDemo'];
                
                if($tipo==2)
                    $obs = "&nbsp; - &nbsp;<i>Tradução/Consultoria</i>";
                else
                   $obs = "";

				$html .= "<tr align=\"center\">";

				//PROFESSOR
				$html .= "<td>" . $nomeProfessor.$obs. "</td>";

				//VALOR
				$html .= "<td> R$ " . Uteis::formatarMoeda($totalFinal) . "</td>";
				
				//Banco
				$html .= "<td>".$nomeBanco."</td>";

				//FORMA DE PGTO
				$html .= "<td>";
                if(!$excel){
                    if (!$idTipoPagamento || !$dataBaixa) {
                        $html .= "<form id=\"form_demonstrativoPagamento_$idDemonstrativoPagamento\" class=\"validate\"
                        action=\"\" method=\"post\" onsubmit=\"return false\" >
                            <input type=\"hidden\" name=\"idDemonstrativoPagamento\" id=\"idDemonstrativoPagamento\" value=\"$idDemonstrativoPagamento\" />
                            <input type=\"hidden\" name=\"mes\" id=\"mes\" value=\"$mes\" />
                            <input type=\"hidden\" name=\"ano\" id=\"ano\" value=\"$ano\" />
                            <input type=\"hidden\" name=\"emAberto\" id=\"emAberto\" value=\"$emAberto\" />

                            " . $TipoBaixaPagamento -> selectTipoBaixaPagamentoSelect("required", "", " WHERE inativo = 0") . "<span style=\"display:none\">Campo obrigatório</span>

                            <button class=\"button gray\"
                            onclick=\"postForm('form_demonstrativoPagamento_$idDemonstrativoPagamento', '" . CAMINHO_PAG . "baixa/include/acao/baixa.php')\">
                            Gravar</button>
                        </form>
                        ";
                    } else {
                        $rsTipoBaixaPagamento = $TipoBaixaPagamento -> selectTipoBaixaPagamento(" WHERE idTipoBaixaPagamento = $idTipoPagamento");
                        $html .= "<strong>" . $rsTipoBaixaPagamento[0]['nome'] . "</strong> - em " . Uteis::exibirDataHora($dataBaixa);
                        $html .= "<form id=\"Reverter_$idDemonstrativoPagamento\" class=\"validate\" action=\"\" method=\"post\"
                        onsubmit=\"return false\" >
                        <input type=\"hidden\" name=\"mes\" id=\"mes\" value=\"$mes\" />
                            <input type=\"hidden\" name=\"ano\" id=\"ano\" value=\"$ano\" />
                            <input type=\"hidden\" name=\"emAberto\" id=\"emAberto\" value=\"$emAberto\" />
                        <input type=\"hidden\" name=\"idDemonstrativoPagamento\" id=\"idDemonstrativoPagamento\" value=\"$idDemonstrativoPagamento\" />
                        <input type=\"hidden\" name=\"reverter\" id=\"reverter\" value=\"reverter\" />
                        <button class=\"button gray\" onclick=\"postForm('Reverter_$idDemonstrativoPagamento', '" . CAMINHO_PAG . "baixa/include/acao/baixa.php')\">Reverter </button>
                        </form> ";
                    }
                }else{
                    $rsTipoBaixaPagamento = $TipoBaixaPagamento -> selectTipoBaixaPagamento(" WHERE idTipoBaixaPagamento = $idTipoPagamento");
                    $html .= "<strong>" . $rsTipoBaixaPagamento[0]['nome'] . "</strong> - em " . Uteis::exibirDataHora($dataBaixa);
                }
				$html .= "</td>";

			}
			
			$html .= "</tbody>";
		}
		
		$html_base = $Relatorio->montaTb($colunas, $excel);
	
		return $html_base . $html;

		
	}

	function selectDemonstrativoPagamentoTr_aulasTotal($idProfessor, $mes, $ano,$soPrincipal = FALSE) {
		
		//if ($mes <10) {
		//	$mesF = "0".$mes;	
		//}
		
		$dataReferencia = $ano."-".$mes."-01";
		$dataReferenciaFinal = date("Y-m-t", strtotime($dataReferencia));

		$Relatorio = new Relatorio();
		$ValorHoraGrupo = new ValorHoraGrupo();
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();

		$result = $Relatorio->relatorioFrequencia_mensal(" WHERE DAF.banco = 0 AND PRF.idProfessor = $idProfessor AND MONTH(FF.dataReferencia) = $mes AND YEAR(FF.dataReferencia) = $ano ", $soPrincipal, TRUE, $dataReferenciaFinal);
	  //exit;	
	   	if( $result ){
							
			$res = array();		
		
			foreach ($result as $cont => $valorAulas) {
				$idPlanoAcaoGrupo = $valorAulas['idPlanoAcaoGrupo'];
		
				if( $idPlanoAcaoGrupo != $idPlanoAcaoGrupo_ultimo ){
						$idPlanoAcaoGrupo_ultimo = $idPlanoAcaoGrupo;
					
					$rs = $ValorHoraGrupo->selectValorHoraGrupo_periodo($idPlanoAcaoGrupo, $dataReferencia);
							
					$pagarProfessor = $rs[0]['valorHora'];
					
					$valorHoraProf = $rs[0]['valorHoraProfessor'];
					
					if ($valorHoraProf == 0) {
					
					if ($pagarProfessor == 1) {
						
						$valorHoraProf = 0;
					} else {
						
						$sql2 = " SELECT AGP.plano AS valorHora 
		FROM planoAcaoGrupo AS PAG
		LEFT JOIN aulaDataFixa AS AF ON AF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
		LEFT JOIN aulaPermanenteGrupo AS AP ON AP.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo 
		INNER JOIN aulaGrupoProfessor AS AGP ON 
			(AGP.aulaDataFixa_idAulaDataFixa = AF.idAulaDataFixa OR AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo = AP.idAulaPermanenteGrupo) 
		WHERE PAG.idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND AGP.professor_idProfessor = ".$idProfessor." AND AGP.dataInicio <= '" . $dataReferenciaFinal . "' 
			AND (
				(AGP.dataFim >= '" . $dataReferencia . "' ) /*AND AGP.dataFim <= '" . $dataReferenciaFinal . "') */
				OR 
				AGP.dataFim IS NULL OR AGP.dataFim = ''
			) AND AGP.plano IS NOT NULL ";
			
			$valorHoraProfAula = Uteis::executarQuery($sql2);
			$valorHoraProf = $valorHoraProfAula[0]['valorHora'];
		
			if ($valorHoraProf == '') {		
					$idIdioma = $PlanoAcaoGrupo -> getIdIdioma($idPlanoAcaoGrupo);
					$sql = "SELECT PC.plano FROM planoCarreirra AS PC 
					INNER JOIN planoCarreirraIdiomaProfessor AS PCIP ON PCIP.planoCarreirra_idPlanoCarreira = PC.idPlanoCarreira 
					INNER JOIN idiomaProfessor AS I ON I.idIdiomaProfessor = PCIP.idiomaProfessor_idIdiomaProfessor 
					WHERE PC.inativo = 0 AND I.inativo = 0 AND I.idioma_idIdioma = ".$idIdioma." AND I.professor_idProfessor = ".$valorAulas['idProfessor']."  
					AND (
						PCIP.anoIni < $ano OR ( PCIP.anoIni = $ano AND PCIP.mesIni <= $mes ) 
					) 
					AND(
						PCIP.anoFim IS NULL OR PCIP.anoFim > $ano OR ( PCIP.anoFim = $ano AND PCIP.mesFim >= $mes ) 
					)";
					//echo $valorAulas['grupo']."<br>$sql<br>";
					$valorHoraProf = Uteis::executarQuery($sql);
					$valorHoraProf = $valorHoraProf ? $valorHoraProf[0]['plano'] : 0;
							}
						}
					}
					
					$horaRealizada = $valorAulas['horasRealizadasPeloGrupo']+$valorAulas['somarCom_horasRealizadasPeloGrupo']-$valorAulas['CSAesp'];
													
					$res[$cont]['nome'] = $valorAulas['grupo'];
					$res[$cont]['idPlanoAcaoGrupo'] = $idPlanoAcaoGrupo;
					$res[$cont]['idFolhaFrequencia'] = $valorAulas['idFolhaFrequencia'];
					$res[$cont]['horaRealizada'] = $horaRealizada;				
					$res[$cont]['diasAula'] = $valorAulas['diasAula_pagarProf'];
					$res[$cont]['valorHora'] = $valorHoraProf;
					$res[$cont]['ajudaCustoDia'] = $valorAulas['ajudaCustoDia'];
					$res[$cont]['ajudaCustoHora'] = $valorAulas['ajudaCustoHora'];
					$total = (($valorHoraProf + $res[$cont]['ajudaCustoHora']) * ($horaRealizada / 60)) + ($res[$cont]['ajudaCustoDia'] * $res[$cont]['diasAula']);
			
					$res[$cont]['total'] = $total;
					
				}
				
			}
		}
	
	//	Uteis::pr($res);
		return $res;
		
	}

	function selectDemonstrativoPagamento_imprimir($idDemonstrativoPagamento, $tipodemo = 1) {

        $rs = $this -> selectDemonstrativoPagamento(" WHERE idDemonstrativoPagamento = " . $idDemonstrativoPagamento);
        $html = "";
		$totalAulas = 0;
		$totalR = 0;

        if ($rs) {
			$DadosBancarios = new DadosBancarios();
			$DescontoGeral = new DescontoGeral();

            $idProfessor = $rs[0]['professor_idProfessor'];
            $idDemonstrativoPagamento_aux = $rs[0]['demonstrativoPagamento_idDemonstrativoPagamento'];
            $mes = $rs[0]['mes'];
            $ano = $rs[0]['ano'];
            $totalFinal = $rs[0]['total'];
			
	        $DemonstrativoPagamentoAulas = new DemonstrativoPagamentoAulas();
            $DemonstrativoPagamentoCredDeb = new DemonstrativoPagamentoCredDeb();
            $DemonstrativoPagamentoImposto = new DemonstrativoPagamentoImposto();
            $Professor = new Professor();
            $PlanoAcaoGrupo = new PlanoAcaoGrupo();
            $TipoImpostoProfessor = new TipoImpostoProfessor();
            $OutrosServicos = new OutrosServicos();
            $valorProfessor = $Professor -> selectProfessor(" WHERE idProfessor = " . $idProfessor);
            $nomeProfessor = $valorProfessor[0]['nome'];
			$cpf = $valorProfessor[0]['documentoUnico'];
			$inss = $valorProfessor[0]['inss'];
			$ccm = $valorProfessor[0]['ccm'];
            
            $html .= "          
            <p>Professor: <strong>$nomeProfessor</strong><br>
            CPF: <strong>$cpf</strong><br>
			INSS/PIS: <strong>$inss</strong><br>";
			
			if ($ccm != '') {
				$html .= "CCM: <strong>$ccm</strong></p>";	
			} else {
				$html .= "</p>";
			}
			
            $html .= "<p>Período: <strong>$mes/$ano</strong></p>";
            
            $where = " WHERE demonstrativoPagamento_idDemonstrativoPagamento = $idDemonstrativoPagamento";
           
                
            //GRUPOS
            if($tipodemo==1){
            $rsDemonstrativoPagamentoAulas = $DemonstrativoPagamentoAulas -> selectDemonstrativoPagamentoAulas($where);
            if ($rsDemonstrativoPagamentoAulas) {

                $html .= "<table id=\"tb_dem_aulas\" class=\"registros\">               
            <thead>
              <tr>
                <th>Grupo</th>
                <th>Valor Hora</th>
                <th>Horas de aulas</th>";
              //  <th>Dias de aula</th>
             $html .= "   <th>Ajuda de custo</th>
                <th>Sub-total</th>
              </tr>
            </thead>
            
            <tbody>";
                    
                    foreach ($rsDemonstrativoPagamentoAulas as $valorDemonstrativoPagamentoAulas) {
                    
                        $idPlanoAcaoGrupo = $valorDemonstrativoPagamentoAulas['planoAcaoGrupo_idPlanoAcaoGrupo'];
                        $nomeGrupo = $PlanoAcaoGrupo -> getNomeGrupo($idPlanoAcaoGrupo);
    
                        $valor = $valorDemonstrativoPagamentoAulas['valor'];
                        $horas = $valorDemonstrativoPagamentoAulas['horas'];
                        $dias = $valorDemonstrativoPagamentoAulas['dias'];
                        $ajudaCusto = $valorDemonstrativoPagamentoAulas['ajudaCusto'];
                        $total = (($horas / 60) * $valor) + ($ajudaCusto);
						$totalGeral += $total;
					
                        $html .= "<tr>                      
                            <td>" . $nomeGrupo . "</td>     
                            <td> R$ " . Uteis::formatarMoeda($valor) . "</td>       
                            <td> " . Uteis::exibirHoras($horas) . " </td>    ";                       
                         //   <td> " . $dias . " dias</td>                            
						$html .= "<td> " . ($ajudaCusto ? "R$ " . Uteis::formatarMoeda($ajudaCusto) : "&nbsp;") . "</td>      
                            <td> R$ " . Uteis::formatarMoeda($total) . "</td> 
                        </tr>";
						
						$totalAulas += $horas;
						$totalR += $total;
						
                    }
					
                    
            $html .= "</tbody> ";
			
			$html .=  "<tfoot>
              <tr>
                <th></th>
                <th></th>
                <th>Total Horas: ".Uteis::exibirHoras($totalAulas)."</th>";
              //  <th></th>
            $html .= "    <th></th>
                <th>Total  R$ ".Uteis::formatarMoeda($totalR)." </th>
              </tr>
            </tfoot>
                    
                </table>";
                            
            }
            }else{
                 //Outros Servicos
             $where1 = "WHERE mes = '" . $mes . "' AND ano= '" . $ano . "' AND professor_idProfessor = " . $idProfessor;
             $rsOutros = $OutrosServicos->selectOutrosServicos($where1);
             $html .= "<table id=\"tb_dem_outrosservicos\" class=\"registros\">               
            <thead>
              <tr>
                <th>Serviço</th>
                <th>Obs</th>
                <th>Valor</th>               
              </tr>
            </thead>            
            <tbody>";
             foreach($rsOutros as $Outros):
                
             $tipo = $Outros['tipo'];
                              
             switch($tipo) {
                    case 1:
                     $tipoNome = "Consultoria";
                     break;
                     
                    case 2:
                    $tipoNome = "Tradução";
                    break;
                    
                    case 3:
                    $tipoNome = "Revisão";
                    break;
                    
                    case 4:
                    $tipoNome = "Versão";
                    break;
                    
                    case 5:
                    $tipoNome = "Correção";
                    break;
                    
                    case 6:
                    $tipoNome = "Outros";
                    break;
                    
                    case 7:
                    $tipoNome = "Débitos";
                    break;  
                }  
               
                 
                 
             $valor = ($tipo==7) ? Uteis::formatarMoeda($Outros['valor']*(-1)):Uteis::formatarMoeda($Outros['valor']);
             $obs = $Outros['obs']; 
                $html .= "<tr>                      
                            <td>" . $tipoNome . "</td>                                
                            <td> " . $obs. " </td>
                            <td> R$ " . $valor . "</td>                             
                         </tr>";
             endforeach;
            $html .= "</tbody> </table>";
			
			
			
					
			
            }
            //CREDITOS DEBITOS
            $rsDemonstrativoPagamentoCredDeb = $DemonstrativoPagamentoCredDeb -> selectDemonstrativoPagamentoCredDeb($where);
            if  (($rsDemonstrativoPagamentoCredDeb) || ($valorDoc > 0)) {
   			
		
                $html .= "<table id=\"tb_dem_credDeb\" class=\"registros\">             
        <thead>
          <tr>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Observação</th>             
          </tr>
        </thead>
        
        <tbody>";

                foreach ($rsDemonstrativoPagamentoCredDeb as $valorDemonstrativoPagamentoCredDeb) {

                    $tipo = $valorDemonstrativoPagamentoCredDeb['tipo'];
                    $tipo = $tipo == 1 ? "Crédito" : "Débito";
                    $valor = $valorDemonstrativoPagamentoCredDeb['valor'];
                    $obs = $valorDemonstrativoPagamentoCredDeb['obs'] ? $valorDemonstrativoPagamentoCredDeb['obs'] : "&nbsp;";
					
					if ($valorDemonstrativoPagamentoCredDeb['premiacao'] == 1) {
					$obs .= " (Premiação)";	
						
					}

                    $html .= "<tr>
                        <td>" . $tipo . "</td>  
                        <td>R$ " . Uteis::formatarMoeda($valor) . "</td>    
                        <td>" . $obs . "</td>
                    </tr>";
                }
	         
                $html .= "</tbody> 
                    
                </table>";
                    
            }

            //IMPOSTOS
            $rsDemonstrativoPagamentoImposto = $DemonstrativoPagamentoImposto -> selectDemonstrativoPagamentoImposto($where);
            if ($rsDemonstrativoPagamentoImposto) {
                $html .= "<table id=\"tb_dem_imposto\" class=\"registros\">             
            <thead>
              <tr>
                <th>Imposto</th>
                <th>Valor</th>                             
              </tr>
            </thead>
        
        <tbody>";
                
                foreach ($rsDemonstrativoPagamentoImposto as $valorDemonstrativoPagamentoImposto) {

                    $idTipoImpostoProfessor = $valorDemonstrativoPagamentoImposto['tipoImpostoProfessor_idTipoImpostoProfessor'];
                    $nomeImposto = $TipoImpostoProfessor -> selectTipoImpostoProfessor(" WHERE idTipoImpostoProfessor = " . $idTipoImpostoProfessor, $ano, $mes);
                    $nomeImposto = $nomeImposto[0]['sigla'];

                    $valor = $valorDemonstrativoPagamentoImposto['valor'];

                    $html .= "<tr>
                        <td>" . $nomeImposto . "</td>   
                        <td> R$ " . Uteis::formatarMoeda($valor) . "</td>
                    </tr>";
                }

                $html .= "</tbody> 
                    
                </table>";
                
            }
            
            if (!$idDemonstrativoPagamento_aux) {
                $html .= "<p>---------------------------------------------------------------------------------------</p>
                <p><strong>TOTAL: R$ " . Uteis::formatarMoeda($totalFinal) . "</strong></p>";
            } else {
                $html .= "<p>Sub-total: <strong>R$ " . Uteis::formatarMoeda($totalFinal) . "</strong></p>";

                $valorAnterior = $this -> selectDemonstrativoPagamento(" WHERE idDemonstrativoPagamento = $idDemonstrativoPagamento_aux");
                $valorAnterior = $valorAnterior[0]['total'];
                $html .= "<p>Valor pago anteriormente: <strong>R$ " . Uteis::formatarMoeda($valorAnterior) . "</strong></p>";

                $html .= "<p>---------------------------------------------------------------------------------------</p>
                <p><strong>TOTAL: R$ " . Uteis::formatarMoeda($totalFinal - $valorAnterior) . "</strong><font color=\"#F00\" > [demonstrativo complementar]</font></p>";
            }
        
            //$html .= "        ";

        }
        return $html;
    }

	function selectDemonstrativoPagamentoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDemonstrativoPagamento, professor_idProfessor, demonstrativoPagamento_idDemonstrativoPagamento, tipoPagamento_idTipoPagamento, mes, ano, total, dataCadastro, dataBaixa FROM demonstrativoPagamento " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDemonstrativoPagamento\" name=\"idDemonstrativoPagamento\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDemonstrativoPagamento'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDemonstrativoPagamento'] . "\">" . ($valor['idDemonstrativoPagamento']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectDemonstrativoPagamentoTr_relatorioTotal($where) {

		$sql = "SELECT SQL_CACHE SUM(COALESCE(D.total,0) - COALESCE(D2.total,0)) AS total
		FROM demonstrativoPagamento AS D		
		LEFT JOIN demonstrativoPagamento AS D2 ON D2.idDemonstrativoPagamento = D.demonstrativoPagamento_idDemonstrativoPagamento
		LEFT JOIN professor AS PR ON PR.idProfessor = D.professor_idProfessor
		LEFT JOIN tipoBaixaPagamento AS TP ON TP.idTipoBaixaPagamento = D.tipoPagamento_idTipoPagamento		
		" . $where;
		$result = Uteis::executarQuery($sql);
//		echo $sql;

		$total = "0";
		if ($result) {
			$total = $result[0]["total"];
		}

		return Uteis::formatarMoeda($total);
	}

	function selectDemonstrativoPagamentoTr_historico($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$html = "";

		$rs = $this -> selectDemonstrativoPagamento($where);

		if ($rs) {
			foreach ($rs as $valor) {

				$idDemonstrativoPagamento = $valor['idDemonstrativoPagamento'];
				$idDemonstrativoPagamento_aux = $valor['demonstrativoPagamento_idDemonstrativoPagamento'];
				$dataCadastro = $valor['dataCadastro'];
				$total = $valor['total'];

				$podeExcluir = ($valor['tipoPagamento_idTipoPagamento'] && $valor['dataBaixa']) ? "" : "<img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"Deletar\" 
				onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/demonstrativo_del.php', '" . $idDemonstrativoPagamento . "', '$caminhoAtualizar', '$ondeAtualiza')\" />";

				if ($idDemonstrativoPagamento_aux) {
					$rsAux = $this -> selectDemonstrativoPagamento(" WHERE idDemonstrativoPagamento = " . $idDemonstrativoPagamento_aux);
					$valorAnt = $rsAux[0]["total"];
					$total -= $valorAnt;
				}

				$html .= "<tr>
				
				<td>".strtotime($dataCadastro)."</td>
				
				<td>" . Uteis::exibirDataHora($dataCadastro) . ($idDemonstrativoPagamento_aux ? " [complementar]" : "") . "</td>
			
				<td>R$ " . Uteis::formatarMoeda($total) . "</td>
			
				<td align=\"center\">
					<img src=\"" . CAMINHO_IMG . "ver16.png\" title=\"Visualizar\" 
					onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/demonstrativoVer.php?id=" . $idDemonstrativoPagamento . "', '', '')\" />
				</td>
				
				<td align=\"center\">" . $podeExcluir . "</td>
				<td align=\"center\"><button class=\"button blue\" onclick=\"postForm('', '" . $caminhoAbrir . "acao/envioEmail.php', 'id=" . $idDemonstrativoPagamento . "')\" >Enviar Email</button></td>			
								
				</tr>";
			}
		}
		return $html;
	}

}
?>