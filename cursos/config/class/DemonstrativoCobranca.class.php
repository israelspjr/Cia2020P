<?php
class DemonstrativoCobranca extends Database {

    // class attributes
    var $idDemonstrativoCobranca;
    var $planoAcaoGrupoIdPlanoAcaoGrupo;
    var $clientePjIdClientePj;
    var $mes;
    var $ano;
    var $obs;
    var $dataVencimento;
    var $valCurso;
    var $valMaterial;
    var $valCredito;
    var $valDebito;

    // constructor
    function __construct() {
        parent::__construct();

        $this -> idDemonstrativoCobranca = "NULL";
        $this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
        $this -> clientePjIdClientePj = "NULL";
        $this -> mes = "NULL";
        $this -> ano = "NULL";
        $this -> obs = "NULL";
        $this -> dataVencimento = "NULL";
        $this -> valCurso = "NULL";
        $this -> valMaterial = "NULL";
        $this -> valCredito = "NULL";
        $this -> valDebito = "NULL";
        $this -> totalHoras = "NULL";

    }

    function __destruct() {
        parent::__destruct();
    }

    // class methods
    function setIdDemonstrativoCobranca($value) {
        $this -> idDemonstrativoCobranca = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
        $this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setClientePjIdClientePj($value) {
        $this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setMes($value) {
        $this -> mes = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setAno($value) {
        $this -> ano = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setObs($value) {
        $this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setValCurso($value) {
        $this -> valCurso = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
    }

    function setValMaterial($value) {

        $this -> valMaterial = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
    }

    function setValCredito($value) {

        $this -> valCredito = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
    }

    function setValDebito($value) {

        $this -> valDebito = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
    }
    
    function setDatavencimento($value){
       $this -> dataVencimento = ($value) ? $this -> gravarBD(Uteis::gravarData($value)) : "NULL";
    }

    function setTotalHoras($value) {

        $this -> totalHoras = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
    }

    /**
     addDemonstrativoCobranca() Function
     **/
    function addDemonstrativoCobranca() {
        $sql = "INSERT INTO demonstrativoCobranca (planoAcaoGrupo_idPlanoAcaoGrupo, clientePj_idClientePj, mes, ano, dataVencimento, obs, valCurso, valMaterial, valCredito, valDebito, totalHoras) VALUES ($this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->clientePjIdClientePj, $this->mes, $this->ano, $this->dataVencimento, $this->obs, $this->valCurso, $this->valMaterial, $this->valCredito, $this->valDebito, $this->totalHoras)";
        $result = $this -> query($sql, true);
        //echo $sql;
        //exit;
        return mysqli_insert_id($this -> connect);
    }

    /**
     * deleteDemonstrativoCobranca() Function
     */
    function deleteDemonstrativoCobranca() {

        $DemonstrativoCobrancaIntegranteGrupo = new DemonstrativoCobrancaIntegranteGrupo();
        $DemonstrativoCobrancaDias = new DemonstrativoCobrancaDias();
        $DemonstrativoCobrancaProfessor = new DemonstrativoCobrancaProfessor();
        $DemonstrativoCobrancaValorHora = new DemonstrativoCobrancaValorHora();
        $DemonstrativoCobrancaAjudaCusto = new DemonstrativoCobrancaAjudaCusto();

        $where = " OR ( demonstrativoCobranca_idDemonstrativoCobranca IN (" . $this -> idDemonstrativoCobranca . "))";

        $DemonstrativoCobrancaDias -> deleteDemonstrativoCobrancaDias($where);
        $DemonstrativoCobrancaProfessor -> deleteDemonstrativoCobrancaProfessor($where);
        $DemonstrativoCobrancaValorHora -> deleteDemonstrativoCobrancaValorHora($where);
        $DemonstrativoCobrancaAjudaCusto -> deleteDemonstrativoCobrancaAjudaCusto($where);

        $rs = $DemonstrativoCobrancaIntegranteGrupo -> selectDemonstrativoCobrancaIntegranteGrupo(" WHERE demonstrativoCobranca_idDemonstrativoCobranca IN (" . $this -> idDemonstrativoCobranca . ")");
        if ($rs) {
            foreach ($rs as $val) {
                $DemonstrativoCobrancaIntegranteGrupo -> setIdDemonstrativoCobrancaIntegranteGrupo($val['idDemonstrativoCobrancaIntegranteGrupo']);
                $DemonstrativoCobrancaIntegranteGrupo -> deleteDemonstrativoCobrancaIntegranteGrupo();
            }
        }

        $sql = "DELETE FROM demonstrativoCobranca WHERE idDemonstrativoCobranca = $this->idDemonstrativoCobranca ";
        $result = $this -> query($sql, true);
    }

    /**
     updateFieldDemonstrativoCobranca() Function
     **/
    function updateFieldDemonstrativoCobranca($field, $value) {
        $value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
        $sql = "UPDATE demonstrativoCobranca SET " . $field . " = " . $value . " WHERE idDemonstrativoCobranca = $this->idDemonstrativoCobranca";
        $result = $this -> query($sql, true);
        return $result;
    }

    /**
     * updateDemonstrativoCobranca() Function
     */
    //function updateDemonstrativoCobranca() {
    //      $sql = "UPDATE demonstrativoCobranca SET planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, clientePj_idClientePj = $this->clientePjIdClientePj, mes = $this->mes, ano = $this->ano, obs = $this->obs, valCurso = $this->valCurso, valMaterial = $this->valMaterial, valCredito = $this->valCredito, valDebito = $this->valDebito, totalHoras = $this->totalHoras WHERE idDemonstrativoCobranca = $this->idDemonstrativoCobranca";
    //      $result = $this->query($sql);
    //  }

    function selectDemonstrativoCobranca($where = "WHERE 1") {
        $sql = "SELECT SQL_CACHE idDemonstrativoCobranca, planoAcaoGrupo_idPlanoAcaoGrupo, clientePj_idClientePj, mes, ano, dataVencimento, obs, valCurso, valMaterial, valCredito, valDebito, totalHoras FROM demonstrativoCobranca " . $where;
        // echo $sql;
        return $this->executeQuery($sql);
    }

    function selectDemonstrativoCobrancaTr($mes, $ano, $caminhoAtualizar_base = "", $ondeAtualiza = "", $where = "", $apenasLinha = false, $idStatusCobranca,$ordem, $rh, $mesF, $anoF) {
	
        $GrupoClientePj = new GrupoClientePj();
        $PlanoAcaoGrupoNaoFaturar = new PlanoAcaoGrupoNaoFaturar();
        $RegistroDeAnotacoes = new RegistroDeAnotacoes();
		$ValorHoraGrupo = new ValorHoraGrupo();
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
	
	    $dataReferencia = "$ano-$mes-01";
	    $dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));
	
		$sql = "SELECT G.idGrupo, G.nome FROM
    				planoAcao AS P
        		INNER JOIN
    				planoAcaoGrupo PAG ON P.idPlanoAcao = PAG.planoAcao_idPlanoAcao
    				AND PAG.dataInicioEstagio <= '".$dataReferenciaFinal."'
        		INNER JOIN
    				grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
 				WHERE 1 ".$where." GROUP BY G.nome ORDER BY G.nome";
			
        $result = $this->query($sql);

        $cont = 0;
		$carga = "";
		$revertido =0;
        if (mysqli_num_rows($result) > 0) {   
		
            while ($valor = mysqli_fetch_array($result)) {
				
				$sql2 = "SELECT  max(PAG.idPlanoAcaoGrupo) as idPlanoAcaoGrupo
							FROM
    					planoAcao AS P
        					INNER JOIN
    					planoAcaoGrupo PAG ON P.idPlanoAcao = PAG.planoAcao_idPlanoAcao
    						AND PAG.dataInicioEstagio <= '".$dataReferenciaFinal."'
        					INNER JOIN
    					grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
							WHERE
						G.idGrupo = ".$valor['idGrupo'];
						
						$result2= $this->executeQuery($sql2);
				
		//		echo $sql2;

                $idPlanoAcaoGrupo = $result2[0]['idPlanoAcaoGrupo']; 
                $idGrupo = $valor['idGrupo'];
				
				$valorHG = $ValorHoraGrupo->selectValorHoraGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND dataFim is null AND cargaHorariaFixaMensal is not null");

				if ($valorHG[0]['cargaHorariaFixaMensal'] > 1 ) {
					$carga = Uteis::exibirHoras($valorHG[0]['cargaHorariaFixaMensal']);
				}

                $caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&mes=" . $mes . "&ano=" . $ano;

                if ($apenasLinha == true) {
                    $caminhoAtualizar .= "&ordem=" . $ordem;
                } else {
                    $caminhoAtualizar .= "&ordem=" . $cont;
                }

                //EMPRESA
                $empresa = $GrupoClientePj->getNomePJ($idGrupo);
				
				$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);

				for ($x=0;$x<count($ids);$x++) {
					$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
				}

				$valorx2 = implode(', ',$valorX);

                $where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo in ($valorx2) AND mes = $mes AND ano = $ano ";
                $rsDemonstrativo = $this->selectDemonstrativoCobranca($where);

                //CARREGA INF DE STATUS
                $sql = " SELECT PAGSC.idPlanoAcaoGrupoStatusCobranca, SC.status, SC.cor, SC.idStatusCobranca 
                FROM statusCobranca AS SC
                INNER JOIN planoAcaoGrupoStatusCobranca AS PAGSC ON PAGSC.statusCobranca_idStatusCobranca = SC.idStatusCobranca
                WHERE PAGSC.planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND PAGSC.mes = $mes AND PAGSC.ano = $ano ";
			//	Uteis::pr( $sql);
                $rsStatus = Uteis::executarQuery($sql);
				
                $cor = $rsStatus[0]['cor'] ? $rsStatus[0]['cor'] : "";
				
				$rsStatusEncerra = $rsStatus[0]['idStatusCobranca'];
                $status = "";
				
    				if ($rsStatus[0]['idStatusCobranca'] == 6) {
						
							$Status = "";
							
						} else {
							
							$Status = $rsStatus[0]['status'];
							
						}
                        $statusid = $rsStatus[0]['idStatusCobranca'];
						if ($rh != 1) {
					    $status = "
                        
                        <form id=\"form_DC_alt_$idPlanoAcaoGrupo\" 
                        class=\"validate\" method=\"post\" action=\"\" onsubmit=\"return false\" >
                            <input type=\"hidden\" name=\"idPlanoAcaoGrupo\" value=\"$idPlanoAcaoGrupo\" />
                            <input type=\"hidden\" name=\"mes\" value=\"$mes\" />
                            <input type=\"hidden\" name=\"ano\" value=\"$ano\" />

                            <input type=\"hidden\" name=\"caminhoAtualizar\" value=\"$caminhoAtualizar\" />
                    
                            <input type=\"hidden\" name=\"acao\" value=\"alterarStatusCobranca\" />".$rsStatus[0]['status']."<br>
                        
                            <button class=\"button gray\" 
                            onclick=\" postForm('form_DC_alt_$idPlanoAcaoGrupo', '" . CAMINHO_COBRANCA . "demonstrativo/include/acao/statusCobranca.php?tr=1&idPlanoAcaoGrupo=$idPlanoAcaoGrupo&mes=$mes&ano=$ano&ordem=$cont&st=$statusid')\" >
                            Alterar</button>
							
                            
                        </form>
                        <script>ativarForm();</script>";
					} else {
				$status = 	$rsStatus[0]['status'];
				}

                //GRUPO
				if ($rh != 1) {
                $grupo = "<div>
                    <img src=\"" . CAMINHO_IMG . "cad.png\" title=\"Ver grupo\" 
                    onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=" . $idPlanoAcaoGrupo . "', '$caminhoAtualizar', '$ondeAtualiza')\" /> " . $valor['nome'] . "
                </div>";
				} else {
				$grupo = "<div>"	. $valor['nome'] . " </div>";
				}
                
                $where = " WHERE ( YEAR(PA.data) < $ano OR (YEAR(PA.data) = $ano AND MONTH(PA.data) <= $mes)) AND PA.dataExcluido IS NULL AND PA.planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo;

               $rsPlanoAcaoGrupoNaoFaturar = $PlanoAcaoGrupoNaoFaturar->selectPlanoAcaoGrupoStatus($where);
                  if ($rsPlanoAcaoGrupoNaoFaturar[0]['tipo'] == 1) {
					$grupo .= "<strong>Status Financeiro: <font color=\"#FF0000\" size=\"3\">não faturar apartir de " . Uteis::exibirData($rsPlanoAcaoGrupoNaoFaturar[0]['dataFechamento']) . " Grupo em fechamento falar com o coordenador</strong></font>";
				} elseif ($rsPlanoAcaoGrupoNaoFaturar[0]['tipo'] == 2) {
	            $grupo .= "<strong>Status Financeiro: <font color=\"#008000\" size=\"3\">Grupo revertido em " . Uteis::exibirData($rsPlanoAcaoGrupoNaoFaturar[0]['dataFechamento']) . " </strong></font>";
				$revertido = 1;	
					
				} elseif ($rsPlanoAcaoGrupoNaoFaturar[0]['tipo'] == 3) {
	            $grupo .= "<strong>Status Financeiro: <font color=\"#f0af0a\" size=\"3\">Grupo pendente com gerente em " . Uteis::exibirData($rsPlanoAcaoGrupoNaoFaturar[0]['dataFechamento']) . " </strong></font>";     
				}
				
				$dataDoStatus = date("Y-m-d", strtotime($rsPlanoAcaoGrupoNaoFaturar[0]['dataFechamento']));
				
                //DEMONSTRATIVO
                $rsDemonstrativoSql = "
                    select D.idDemonstrativoCobranca, D.mes, D.ano, P.idPlanoAcaoGrupo
                    from demonstrativoCobranca as D
                    LEFT JOIN planoAcaoGrupo as P on P.idPlanoAcaoGrupo=D.planoAcaoGrupo_idPlanoAcaoGrupo
                    Where P.grupo_idGrupo=".$idGrupo." AND D.mes=".$mes." AND D.ano=".$ano."
                    Group by idDemonstrativoCobranca
                ";

                $rsDemonstrativoMes = Uteis::executarQuery($rsDemonstrativoSql);
                $idPlanoAcaoGrupoCheck = (isset($rsDemonstrativoMes[0]['idPlanoAcaoGrupo']))? $rsDemonstrativoMes[0]['idPlanoAcaoGrupo'] : $idPlanoAcaoGrupo;
   
   				if ($rh != 1) {
                $onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_COBRANCA . "demonstrativo/include/form/demonstrativo.php?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupoCheck . "&mes=" . $mes . "&ano=" . $ano . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('modulos/demonstrativoCobranca/demonstrativoCobrancaForm.php?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupoCheck . "&mes=" . $mes . "&ano=" . $ano . "', '#centro')\" ";
				
				}
	               if (isset($rsDemonstrativoMes[0]['idPlanoAcaoGrupo'])) {
                    $dem = "<img src=\"" . CAMINHO_IMG . "ver16.png\" title=\"Visualizar demonstrativo\" $onclick />";
                   
                } 	elseif ( ( !$rsStatus || $rsStatusEncerra == 6 ) && ($revertido == 1 || $dataDoStatus=="" || $dataDoStatus >= $dataReferencia && $dataDoStatus <= $dataReferenciaFinal)|| ($revertido == 0 || $dataDoStatus >= $dataReferenciaFinal)){
					
					
                   if ($rh !=1) $dem = "<img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Gerar demonstrativo\" $onclick />";
					$revertido = 0;
                } else {
                    $dem = " ";
                }
				if ($rh !=1) {
                $onclick2 = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_COBRANCA . "demonstrativo/include/resourceHTML/disparoEmail.php?id=" . $idPlanoAcaoGrupo . "&mes=" . $mes . "&ano=" . $ano . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				} else {
					$onclick2 = " onclick=\"zerarCentro();carregarModulo( '/cursos/portais/modulos/demonstrativoCobranca/disparoEmailRH.php?id=" . $idPlanoAcaoGrupo . "&mes=" . $mes . "&ano=" . $ano . "', '#centro')\" ";
				}
				 $email = "<img src=\"" . CAMINHO_IMG . "email.png\" title=\"Enviar Demonstrativo\" $onclick2 />";
                
                if ($rsDemonstrativo) {
                   
                    $dataVencimento = Uteis::exibirData($rsDemonstrativo[0]['dataVencimento']);
                    $alterar = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_COBRANCA . "demonstrativo/include/form/alterarVencimento.php?id=" .$rsDemonstrativo[0]['idDemonstrativoCobranca']. "', '$caminhoAtualizar', '$ondeAtualiza')\" ";;
                }else{
                    $email = "";
                    $dataVencimento = "";
                    $alterar = "";
                }
                
                
                //OBS FINANCEIRO
                $obsFinanceiro = "";
//				$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);	

				$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);
				$obsFinanceiro = "";
				unset($valorX);
				for ($x=0;$x<count($ids);$x++) {
				$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
				}
				$valorx2 = implode(', ',$valorX);
				
                $rsRegistroDeAnotacoes = $RegistroDeAnotacoes -> selectRegistroDeAnotacoes(" WHERE financeiro = 1 AND planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.")");
                     foreach ($rsRegistroDeAnotacoes as $valorRegistroDeAnotacoes) {
                        $obsFinanceiro .= "<div class=\"destacaLinha\" mostrarTitle=\"" . $valorRegistroDeAnotacoes['anotacao'] . "\" >" . $valorRegistroDeAnotacoes['titulo'] . "</div>";
                    }
  
                if ($apenasLinha == true) {
	
					//CARREGA INF DE STATUS DEPOIS QUE ATUALIZA
					if ($statusid == 1) {
						$corA = "#f0af0a";
					} elseif ($statusid == 2) {
						$corA = "#9e9e9e";
					} elseif ($statusid== 4) {
						$corA = "#628af3";
					} elseif ($statusid == 5) {
						$corA =  "#46f654";
					} elseif  ($statusid == 6) {
						$corA =  "";
					} else {
						$corA = "";
					}
							
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;\"><span style=\"line-height: 20px;\">".$empresa."</span></div>";
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;\">".$grupo."</div>";
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;line-height: 58px;\">".$carga."</div>";
					if ($rh != 1) {
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;line-height: 58px;\">".$obsFinanceiro."</div>";
					} else {
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;line-height: 330px;\"></div>";	
					}
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;line-height: 58px;\">".$dem."</div>";
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;line-height: 30px;    width: auto;\">".$status."</div>";
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;line-height: 58px;\">".$dataVencimento."</div>";
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;line-height: 58px;\">".$email."</div>";
	
                    $html = $col;
                    break;

                } else {
					
					$html .= "<tr  >";

                    $html .= "<td><div style=\"background-color:".$cor.";min-height: 59px;text-align: center;\"><span style=\"line-height: 20px;\">$empresa</span></div></td>";

                    $html .= "<td ><div style=\"background-color:" . $cor . ";min-height: 59px;text-align: center;\">$grupo</div></td>";
					
					$html .= "<td><div style=\"background-color:" . $cor . ";min-height: 59px;text-align: center;line-height: 58px;\">$carga</div></td>";
					
					if ($rh != 1) {

                    $html .= "<td><div style=\"background-color:" . $cor . ";min-height: 59px;text-align: center;line-height: 30px;\">$obsFinanceiro</div></td>";
					
					} else {
					$html .= "<td ></td>";	
					}

                    $html .= "<td><div  align=\"center\" style=\"background-color:" . $cor . ";min-height: 59px;text-align: center;line-height: 58px;\">$dem</div></td>";

                    $html .= "<td align=\"center\" id=\"StatusCobranca_$idPlanoAcaoGrupo\" ><div style=\"background-color:".$cor.";padding: 8px;    width: auto;\">$status</div></td>";
                    
                    $html .= "<td><div align=\"center\" $alterar style=\"background-color:" . $cor . ";min-height: 59px;text-align: center;line-height: 58px;\">$dataVencimento</div></td>";
                    
                    $html .= "<td><div align=\"center\" style=\"background-color:" . $cor . ";min-height: 59px;\">$email</div></td>";

                    $html .= "</tr>";

                }
                $cont++;
				$carga="";
            }

        }
        return $html;
    }
	
	function selectDemonstrativoCobrancaTrRH($mes, $ano, $caminhoAtualizar_base = "", $ondeAtualiza = "", $where = "", $apenasLinha = false, $idStatusCobranca,$ordem, $rh, $mesF, $anoF) {
	
        $GrupoClientePj = new GrupoClientePj();
        $PlanoAcaoGrupoNaoFaturar = new PlanoAcaoGrupoNaoFaturar();
        $RegistroDeAnotacoes = new RegistroDeAnotacoes();
		$ValorHoraGrupo = new ValorHoraGrupo();
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
	
	    $dataReferencia = "$ano-$mes-01";
	    $dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));
	
		$sql = "SELECT G.idGrupo, G.nome FROM
    				planoAcao AS P
        		INNER JOIN
    				planoAcaoGrupo PAG ON P.idPlanoAcao = PAG.planoAcao_idPlanoAcao
    				AND PAG.dataInicioEstagio <= '".$dataReferenciaFinal."'
        		INNER JOIN
    				grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
 				WHERE 1 ".$where." GROUP BY G.nome ORDER BY G.nome";
			
        $result = $this->query($sql);

        $cont = 0;
		$carga = "";
		$revertido =0;
        if (mysqli_num_rows($result) > 0) {   
		
            while ($valor = mysqli_fetch_array($result)) {
				
				$sql2 = "SELECT  max(PAG.idPlanoAcaoGrupo) as idPlanoAcaoGrupo
							FROM
    					planoAcao AS P
        					INNER JOIN
    					planoAcaoGrupo PAG ON P.idPlanoAcao = PAG.planoAcao_idPlanoAcao
    						AND PAG.dataInicioEstagio <= '".$dataReferenciaFinal."'
        					INNER JOIN
    					grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
							WHERE
						G.idGrupo = ".$valor['idGrupo'];
						
						$result2= $this->executeQuery($sql2);
				
		//		echo $sql2;

                $idPlanoAcaoGrupo = $result2[0]['idPlanoAcaoGrupo']; 
                $idGrupo = $valor['idGrupo'];
				
				$valorHG = $ValorHoraGrupo->selectValorHoraGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND dataFim is null AND cargaHorariaFixaMensal is not null");

				if ($valorHG[0]['cargaHorariaFixaMensal'] > 1 ) {
					$carga = Uteis::exibirHoras($valorHG[0]['cargaHorariaFixaMensal']);
				}

                $caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&mes=" . $mes . "&ano=" . $ano;

                if ($apenasLinha == true) {
                    $caminhoAtualizar .= "&ordem=" . $ordem;
                } else {
                    $caminhoAtualizar .= "&ordem=" . $cont;
                }

                //EMPRESA
                $empresa = $GrupoClientePj->getNomePJ($idGrupo);
				
				$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);

				for ($x=0;$x<count($ids);$x++) {
					$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
				}

				$valorx2 = implode(', ',$valorX);

                $where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo in ($valorx2) AND mes = $mes AND ano = $ano ";
                $rsDemonstrativo = $this->selectDemonstrativoCobranca($where);

                //CARREGA INF DE STATUS
                $sql = " SELECT PAGSC.idPlanoAcaoGrupoStatusCobranca, SC.status, SC.cor, SC.idStatusCobranca 
                FROM statusCobranca AS SC
                INNER JOIN planoAcaoGrupoStatusCobranca AS PAGSC ON PAGSC.statusCobranca_idStatusCobranca = SC.idStatusCobranca
                WHERE PAGSC.planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND PAGSC.mes = $mes AND PAGSC.ano = $ano ";
			//	Uteis::pr( $sql);
                $rsStatus = Uteis::executarQuery($sql);
				
           //     $cor = $rsStatus[0]['cor'] ? $rsStatus[0]['cor'] : "";
				
				$rsStatusEncerra = $rsStatus[0]['idStatusCobranca'];
                $status = "";
				
    				if ($rsStatus[0]['idStatusCobranca'] == 6) {
						
							$Status = "";
							
						} else {
							
							$Status = $rsStatus[0]['status'];
							
						}
                        $statusid = $rsStatus[0]['idStatusCobranca'];
						if ($rh != 1) {
					    $status = "
                        
                        <form id=\"form_DC_alt_$idPlanoAcaoGrupo\" 
                        class=\"validate\" method=\"post\" action=\"\" onsubmit=\"return false\" >
                            <input type=\"hidden\" name=\"idPlanoAcaoGrupo\" value=\"$idPlanoAcaoGrupo\" />
                            <input type=\"hidden\" name=\"mes\" value=\"$mes\" />
                            <input type=\"hidden\" name=\"ano\" value=\"$ano\" />

                            <input type=\"hidden\" name=\"caminhoAtualizar\" value=\"$caminhoAtualizar\" />
                    
                            <input type=\"hidden\" name=\"acao\" value=\"alterarStatusCobranca\" />".$rsStatus[0]['status']."<br>
                        
                            <button class=\"button gray\" 
                            onclick=\" postForm('form_DC_alt_$idPlanoAcaoGrupo', '" . CAMINHO_COBRANCA . "demonstrativo/include/acao/statusCobranca.php?tr=1&idPlanoAcaoGrupo=$idPlanoAcaoGrupo&mes=$mes&ano=$ano&ordem=$cont&st=$statusid')\" >
                            Alterar</button>
							
                            
                        </form>
                        <script>ativarForm();</script>";
					} else {
				$status = 	$rsStatus[0]['status'];
				}

                //GRUPO
				if ($rh != 1) {
                $grupo = "<div>
                    <img src=\"" . CAMINHO_IMG . "cad.png\" title=\"Ver grupo\" 
                    onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=" . $idPlanoAcaoGrupo . "', '$caminhoAtualizar', '$ondeAtualiza')\" /> " . $valor['nome'] . "
                </div>";
				} else {
				$grupo = "<div>"	. $valor['nome'] . " </div>";
				}
                
                $where = " WHERE ( YEAR(PA.data) < $ano OR (YEAR(PA.data) = $ano AND MONTH(PA.data) <= $mes)) AND PA.dataExcluido IS NULL AND PA.planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo;

               $rsPlanoAcaoGrupoNaoFaturar = $PlanoAcaoGrupoNaoFaturar->selectPlanoAcaoGrupoStatus($where);
                  if ($rsPlanoAcaoGrupoNaoFaturar[0]['tipo'] == 1) {
					$grupo .= "<strong>Status Financeiro: <font color=\"#FF0000\" size=\"3\">não faturar apartir de " . Uteis::exibirData($rsPlanoAcaoGrupoNaoFaturar[0]['dataFechamento']) . " Grupo em fechamento falar com o coordenador</strong></font>";
				} elseif ($rsPlanoAcaoGrupoNaoFaturar[0]['tipo'] == 2) {
	            $grupo .= "<strong>Status Financeiro: <font color=\"#008000\" size=\"3\">Grupo revertido em " . Uteis::exibirData($rsPlanoAcaoGrupoNaoFaturar[0]['dataFechamento']) . " </strong></font>";
				$revertido = 1;	
					
				} elseif ($rsPlanoAcaoGrupoNaoFaturar[0]['tipo'] == 3) {
	            $grupo .= "<strong>Status Financeiro: <font color=\"#f0af0a\" size=\"3\">Grupo pendente com gerente em " . Uteis::exibirData($rsPlanoAcaoGrupoNaoFaturar[0]['dataFechamento']) . " </strong></font>";     
				}
				
				$dataDoStatus = date("Y-m-d", strtotime($rsPlanoAcaoGrupoNaoFaturar[0]['dataFechamento']));
				
                //DEMONSTRATIVO
                $rsDemonstrativoSql = "
                    select D.idDemonstrativoCobranca, D.mes, D.ano, P.idPlanoAcaoGrupo
                    from demonstrativoCobranca as D
                    LEFT JOIN planoAcaoGrupo as P on P.idPlanoAcaoGrupo=D.planoAcaoGrupo_idPlanoAcaoGrupo
                    Where P.grupo_idGrupo=".$idGrupo." AND D.mes=".$mes." AND D.ano=".$ano."
                    Group by idDemonstrativoCobranca
                ";

                $rsDemonstrativoMes = Uteis::executarQuery($rsDemonstrativoSql);
                $idPlanoAcaoGrupoCheck = (isset($rsDemonstrativoMes[0]['idPlanoAcaoGrupo']))? $rsDemonstrativoMes[0]['idPlanoAcaoGrupo'] : $idPlanoAcaoGrupo;
   
   			//	if ($rh != 1) {
            //    $onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_COBRANCA . "demonstrativo/include/form/demonstrativo.php?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupoCheck . "&mes=" . $mes . "&ano=" . $ano . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
			//	} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('modulos/demonstrativoCobranca/demonstrativoCobrancaForm.php?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupoCheck . "&mes=" . $mes . "&ano=" . $ano . "', '#centro')\" ";
				
			//	}
	               if (isset($rsDemonstrativoMes[0]['idPlanoAcaoGrupo'])) {
                    $dem = "<img src=\"" . CAMINHO_IMG . "ver16.png\" title=\"Visualizar demonstrativo\" $onclick />";
                   
                } 	elseif ( ( !$rsStatus || $rsStatusEncerra == 6 ) && ($revertido == 1 || $dataDoStatus=="" || $dataDoStatus >= $dataReferencia && $dataDoStatus <= $dataReferenciaFinal)|| ($revertido == 0 || $dataDoStatus >= $dataReferenciaFinal)){
					
					
                   if ($rh !=1) $dem = "<img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Gerar demonstrativo\" $onclick />";
					$revertido = 0;
                } else {
                    $dem = " ";
                }
			//	if ($rh !=1) {
             //   $onclick2 = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_COBRANCA . "demonstrativo/include/resourceHTML/disparoEmail.php?id=" . $idPlanoAcaoGrupo . "&mes=" . $mes . "&ano=" . $ano . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
			//	} else {
					$onclick2 = " onclick=\"zerarCentro();carregarModulo( '/cursos/portais/modulos/demonstrativoCobranca/disparoEmailRH.php?id=" . $idPlanoAcaoGrupo . "&mes=" . $mes . "&ano=" . $ano . "', '#centro')\" ";
			//	}
				 $email = "<img src=\"" . CAMINHO_IMG . "email.png\" title=\"Enviar Demonstrativo\" $onclick2 />";
                
                if ($rsDemonstrativo) {
                   
                    $dataVencimento = Uteis::exibirData($rsDemonstrativo[0]['dataVencimento']);
           //         $alterar = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_COBRANCA . "demonstrativo/include/form/alterarVencimento.php?id=" .$rsDemonstrativo[0]['idDemonstrativoCobranca']. "', '$caminhoAtualizar', '$ondeAtualiza')\" ";;
                }else{
                    $email = "";
                    $dataVencimento = "";
                    $alterar = "";
                }
                
                
                //OBS FINANCEIRO
                $obsFinanceiro = "";
//				$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);	

				$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);
				$obsFinanceiro = "";
				unset($valorX);
				for ($x=0;$x<count($ids);$x++) {
				$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
				}
				$valorx2 = implode(', ',$valorX);
				
                $rsRegistroDeAnotacoes = $RegistroDeAnotacoes -> selectRegistroDeAnotacoes(" WHERE financeiro = 1 AND planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.")");
                     foreach ($rsRegistroDeAnotacoes as $valorRegistroDeAnotacoes) {
                        $obsFinanceiro .= "<div class=\"destacaLinha\" mostrarTitle=\"" . $valorRegistroDeAnotacoes['anotacao'] . "\" >" . $valorRegistroDeAnotacoes['titulo'] . "</div>";
                    }
  
                if ($apenasLinha == true) {
	
					//CARREGA INF DE STATUS DEPOIS QUE ATUALIZA
					if ($statusid == 1) {
				//		$corA = "#f0af0a";
					} elseif ($statusid == 2) {
				//		$corA = "#9e9e9e";
					} elseif ($statusid== 4) {
				//		$corA = "#628af3";
					} elseif ($statusid == 5) {
				//		$corA =  "#46f654";
					} elseif  ($statusid == 6) {
				//		$corA =  "";
					} else {
						$corA = "";
					}
							
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;\"><span style=\"line-height: 20px;\">".$empresa."</span></div>";
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;\">".$grupo."</div>";
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;line-height: 58px;\">".$carga."</div>";
					if ($rh != 1) {
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;line-height: 58px;\">".$obsFinanceiro."</div>";
					} else {
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;line-height: 330px;\"></div>";	
					}
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;line-height: 58px;\">".$dem."</div>";
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;line-height: 30px;    width: auto;\">".$status."</div>";
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;line-height: 58px;\">".$dataVencimento."</div>";
					$col[] = "<div style=\"background-color:".$corA.";min-height: 59px;text-align: center;line-height: 58px;\">".$email."</div>";
	
                    $html = $col;
                    break;

                } else {
					
					$html .= "<tr  >";

                    $html .= "<td><div style=\"background-color:".$cor.";min-height: 59px;text-align: center;\"><span style=\"line-height: 20px;\">$empresa</span></div></td>";

                    $html .= "<td ><div style=\"background-color:" . $cor . ";min-height: 59px;text-align: center;\">$grupo</div></td>";
					
					$html .= "<td><div style=\"background-color:" . $cor . ";min-height: 59px;text-align: center;line-height: 58px;\">$carga</div></td>";
					
					if ($rh != 1) {

                    $html .= "<td><div style=\"background-color:" . $cor . ";min-height: 59px;text-align: center;line-height: 30px;\">$obsFinanceiro</div></td>";
					
					} else {
					$html .= "<td ></td>";	
					}

                    $html .= "<td><div  align=\"center\" style=\"background-color:" . $cor . ";min-height: 59px;text-align: center;line-height: 58px;\">$dem</div></td>";

                    $html .= "<td align=\"center\" id=\"StatusCobranca_$idPlanoAcaoGrupo\" ><div style=\"background-color:".$cor.";padding: 8px;    width: auto;\">$status</div></td>";
                    
                    $html .= "<td><div align=\"center\" $alterar style=\"background-color:" . $cor . ";min-height: 59px;text-align: center;line-height: 58px;\">$dataVencimento</div></td>";
                    
                    $html .= "<td><div align=\"center\" style=\"background-color:" . $cor . ";min-height: 59px;\">$email</div></td>";

                    $html .= "</tr>";

                }
                $cont++;
				$carga="";
            }

        }
        return $html;
    }

    function selectDemonstrativoCobrancaTr_relatorioTotal($where) {

        $sql = "SELECT SQL_CACHE SUM(COALESCE(D.valCurso,0) + COALESCE(D.valMaterial,0) + COALESCE(D.valCredito,0) - COALESCE(D.valDebito,0)) AS totalCusto 
        FROM demonstrativoCobranca AS D     
        LEFT JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = D.planoAcaoGrupo_idPlanoAcaoGrupo
        LEFT JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
        LEFT JOIN clientePj AS CPJ ON CPJ.idClientePj = D.clientePj_idClientePj
        " . $where;
        $result = Uteis::executarQuery($sql);
        //echo $sql;

        $totalCusto = "0";
        if ($result) {
            $totalCusto = $result[0]["totalCusto"];
        }

        return Uteis::formatarMoeda($totalCusto);
    }

	function selectDemonstrativoCobrancaTr_Rh($where, $caminho, $caminhoAtualizar, $excel, $mobile) {
		
        $sql = "Select D.valCurso, D.valMaterial, D.valCredito, D.valDebito, D.mes, D.ano, PAG.idPlanoAcaoGrupo
        FROM demonstrativoCobranca AS D     
        LEFT JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = D.planoAcaoGrupo_idPlanoAcaoGrupo
        LEFT JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
        LEFT JOIN clientePj AS CPJ ON CPJ.idClientePj = D.clientePj_idClientePj
        " . $where;
		$sql .= " order by idDemonstrativoCobranca Desc";
        $result = Uteis::executarQuery($sql);
 //       echo $sql;

        $totalCusto = "0";
		$html = " ";
        if (count($result) > 0) {
			
			for($x=0;$x<count($result);$x++) {
			
				$valCurso = $result[$x]['valCurso'];
				$valMaterial = $result[$x]['valMaterial'];
				$valCredito = $result[$x]['valCredito'];
				$valDebito = $result[$x]['valDebito'];
				
				$idPlanoAcaoGrupo = $result[$x]['idPlanoAcaoGrupo'];
								
				$mes = $result[$x]['mes'];
				$ano = $result[$x]['ano'];
				
				if ($mobile != 1) {
				
				 $onclick = "onclick=\"abrirNivelPagina(this, 'modulos/demonstrativoCobranca/demonstrativoVer.php?mes=" .$mes. "&ano=".$ano."&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."', '', '')\" ";
				} else {
				$onclick = "onclick=\"zerarCentro();carregarModulo( 'modulos/demonstrativoCobranca/demonstrativoVer.php?mes=" .$mes. "&ano=".$ano."&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."', '#centro')\" ";
					
					
				}
				
				$valTotal = $valCurso + $valCredito - $valMaterial - $valDebito; 
				
				$y = $x +1;
				
				$html .= "<tr >";
				$html .= "<td $onclick>".$y."</td>";
				$html .= "<td $onclick><center>".$mes."/".$ano."</center></td>";
				$html .= "<td $onclick><center> R$ ".Uteis::exibirMoeda($valTotal)."</center></td>";
				$html .= "</tr>";
				
				$totalGeral += $valTotal;
			}
				$html .= "   <tfoot>
            <tr>
              <th></th>          
              <th>Total</th>
              <th><center> R$ ".$totalGeral."</center></th>
            </tr>
          </tfoot>";
			
  //          $totalCusto = $result[0]["totalCusto"];
        }

        return $html; //Uteis::formatarMoeda($totalCusto);
    }


}