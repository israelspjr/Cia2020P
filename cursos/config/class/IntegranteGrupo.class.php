<?php
class IntegranteGrupo extends Database {
	// class attributes
	var $idIntegranteGrupo;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $clientePfIdClientePf;
	var $envioPsa;
	var $dataEntrada;
	var $dataSaida;
	var $dataSaidaDemonstrativo;
	var $dataCadastro;
    var $obs;
	var $dataRetorno;
	var $professorIdProfessor;


	// constructor
	function __construct() {
		parent::__construct();
		$this -> idIntegranteGrupo = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> envioPsa = "NULL";
		$this -> dataEntrada = "NULL";
		$this -> dataSaida = "NULL";
		$this -> dataSaidaDemonstrativo = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
        $this -> obs = "NULL";
		$this -> dataRetorno = "NULL";
		$this -> professorIdProfessor = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdIntegranteGrupo($value) {
		$this -> idIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEnvioPsa($value) {
		$this -> envioPsa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataEntrada($value) {
		$this -> dataEntrada = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataSaida($value) {
		$this -> dataSaida = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataSaidaDemonstrativo($value) {
		$this -> dataSaidaDemonstrativo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}
    function setObs($value) {
        $this->obs = ($value) ? $this->gravarBD($value) : "NULL";
    }
	
	function setDataRetorno($value) {
		$this -> dataRetorno = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	
	
	
	/**
	 * addIntegranteGrupo() Function
	 */
	function addIntegranteGrupo() {
		
    $this->tornarCliente();
    
		$sql = "INSERT INTO integranteGrupo (planoAcaoGrupo_idPlanoAcaoGrupo, clientePf_idClientePf, envioPsa, dataEntrada, dataSaida, dataSaidaDemonstrativo, dataCadastro, obs, dataRetorno, professor_idProfessor) 
		VALUES ($this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->clientePfIdClientePf, $this->envioPsa, $this->dataEntrada, $this->dataSaida, $this->dataSaidaDemonstrativo, $this->dataCadastro, $this->obs, $this->dataRetorno, $this->professorIdProfessor)";
		//echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteIntegranteGrupo() Function
	 */
	function deleteIntegranteGrupo() {
		$sql = "DELETE FROM integranteGrupo WHERE idIntegranteGrupo = $this->idIntegranteGrupo";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldIntegranteGrupo() Function
	 */
	function updateFieldIntegranteGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE integranteGrupo SET " . $field . " = " . $value . " WHERE idIntegranteGrupo = $this->idIntegranteGrupo";
		$Log = new LOG();
		$Log -> Log('Excluindo Integrante Classe IntegranteGrupo', 0, "IntegranteGrupo:".$idIntegranteGrupo." - Data:".$dataSaida,array("usuario"=>$_SESSION['usuario'],"idUsuario"=>$_SESSION['idUsuario']));
		$result = $this -> query($sql, true);
	}

	/**
	 * updateIntegranteGrupo() Function
	 */
	function updateIntegranteGrupo() {
		$sql = "UPDATE integranteGrupo SET planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, clientePf_idClientePf = $this->clientePfIdClientePf, dataEntrada = $this->dataEntrada, dataSaida = $this->dataSaida, obs = this->obs dataRetorno = this->dataRetorno, professor_idProfessor = $this->professorIdProfessor WHERE idIntegranteGrupo = $this->idIntegranteGrupo";
	//	echo $sql;
		$result = $this->query($sql, true);
	}

	/**
	 * selectIntegranteGrupo() Function
	 */
	function selectIntegranteGrupo($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idIntegranteGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, clientePf_idClientePf, envioPsa, dataEntrada, dataSaida, dataSaidaDemonstrativo, dataCadastro, obs, dataRetorno, professor_idProfessor FROM integranteGrupo " . $where;
	//	echo "<hr>".$sql;
		return $this -> executeQuery($sql);
	}

	function selectIntegranteGrupoTr($where = "",$apenasVer) {
		
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
		$ClientePf = new ClientePf();
		$Professor = new Professor();

		$sql = "SELECT SQL_CACHE idIntegranteGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, clientePf_idClientePf, dataEntrada, dataSaida, dataSaidaDemonstrativo, dataCadastro, envioPsa, professor_idProfessor FROM integranteGrupo " . $where;
		
	//	echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
				$prazoPsa = $valor['envioPsa'];
			
				$idGrupo = $PlanoAcaoGrupo->getIdGrupo($valor['planoAcaoGrupo_idPlanoAcaoGrupo']);
				
				$idPlanoInicial = $PlanoAcaoGrupo->getPAGPrimeiro($idGrupo);
											
				$valorPlano = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE grupo_idGrupo = ".$idGrupo);
				$valorPAG = $PlanoAcaoGrupo->getTodosPAG($valor['planoAcaoGrupo_idPlanoAcaoGrupo']);
	
				$caminhoAtualizar = CAMINHO_REL . "grupo/include/resourceHTML/integranteGrupo.php?id=" . $valor['planoAcaoGrupo_idPlanoAcaoGrupo'];
				
				if ($valor['clientePf_idClientePf'] > 0 ) {
					$img = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"IR PARA O CADASTRO\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "clientePf/cadastro.php?idIntegranteGrupo=".$valor['idIntegranteGrupo']."&id=" . $valor['clientePf_idClientePf'] . "', '$caminhoAtualizar', '#div_integranteGrupo')\" >";
				}
				
				if ($valor['professor_idProfessor'] > 0) {
					$img = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"IR PARA O CADASTRO\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?idProfessor=".$valor['idIntegranteGrupo']."&id=" . $valor['professor_idProfessor'] . "', '$caminhoAtualizar', '#div_integranteGrupo')\" >";
				}
				
				$valorPf = $ClientePf->selectClientePf(" WHERE idClientePf = ".$valor['clientePf_idClientePf']);
				
				$ativo = $valorPf[0]['inativo'];
				
				
				if ($ativo == 0) {
					$font = " style=\"color:green;\" title=\"Ativo\"";	
					
				} else {
					$font = " style=\"color:red;\" title=\"Inativo\"";		
					
				}
				
				$naoEnviarPsa = $valorPf[0]['inativaPsa'];		
				
				$valorNivel = $PlanoAcaoGrupo->getIdNivel($idPlanoInicial,true);
				
				
                $valorI = $this->selectIntegranteGrupo(" WHERE clientePf_idClientePf = ".$valor['clientePf_idClientePf']. " AND planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorPAG.")");
			 		  
		  		$IntegranteGrupoX = "(";
		  			foreach ($valorI as $valor2) {
			  			$IntegranteGrupoX .= $valor2['idIntegranteGrupo'].", ";
		  			}
		  		$IntegranteGrupoX .= "0)";
						

				$html .= "<tr>";

				$dataEntrada = $valor['dataEntrada'];
				$dataSaida = $valor['dataSaida'];
				$dataSaidaDemonstrativo = $valor['dataSaidaDemonstrativo'];

				$entrada = $dataEntrada > date('Y-m-d') ? " - <font color=\"#009900;\"> iniciará em " . Uteis::exibirData($dataEntrada) . "</font>" : "";
				$saida = $dataSaida ? " - <font color=\"#FF0000;\"> sairá do grupo em " . Uteis::exibirData($dataSaida) . "</font>" : "";
				$saida2 = $dataSaidaDemonstrativo ? "<font color=\"#FF0000;\">, mas só sairá do rateamento em " . Uteis::exibirData($dataSaidaDemonstrativo) . "</font> <img title=\"Cancelar agendamento de cancelamento\" onclick=\"cancelarA(".$valor['idIntegranteGrupo'].");\" src=\"" . CAMINHO_IMG . "excluir.png\">" : "";
				
				if ($valor['clientePf_idClientePf'] > 0 ) {
					
					$html .= "<td>" . $img . "&nbsp;" . "<a title=\"inicio em " . Uteis::exibirData($dataEntrada) . "\"><font ".$font.">" . $this -> getNomePF($valor['idIntegranteGrupo']) . "</font></a>" . $entrada . $saida . $saida2 . "</td>";
				}
				
				if ($valor['professor_idProfessor'] > 0) {
						$html .= "<td>" . $img . "&nbsp;" . "<a title=\"inicio em " . Uteis::exibirData($dataEntrada) . "\"><font ".$font.">" . $this -> getNomePro($valor['idIntegranteGrupo']) . "</font></a>" . $entrada . $saida . $saida2 . "</td>";
					
				}
				
				if ($apenasVer != 1) {
				
				$html .= "<td align=\"center\">".Uteis::exibirData($dataEntrada)."</td>";
				
				$html .= "<td align=\"center\">".$valorNivel."</td>";

				
				//Grafico Frequência
				$html .= "<td align=\"center\"><img src=\"" . CAMINHO_IMG . "graf.png\" title=\"Gráfico de Frequência\" onclick=\"window.open('" . CAMINHO_REL . "grupo/include/resourceHTML/grafico.php?idIntegranteGrupo=" . $valor['idIntegranteGrupo'] . "')\"></td>";
				
				//PSA
			    $psa = new PsaIntegranteGrupo();
	             $resp = $psa->selectPsaIntegranteGrupo(" WHERE integranteGrupo_idIntegranteGrupo  in ".$IntegranteGrupoX." ORDER BY idPsaIntegranteGrupo DESC");
	
	              $UltimaPsa = $resp[0]['dataReferencia'];
	    		   $envioPsa = $valor['envioPsa'];
				
				if ($UltimaPsa == '') {
					$d = strtotime($dataEntrada);
					$dias = $envioPsa;
				} else {
					$d = strtotime($UltimaPsa);
					if ($prazoPsa > 0) {
						$dias = $prazoPsa;
					} else {
					    $dias = 90;
					}
				}
	
               $dataReferencia = date('Y-m-d', strtotime("+".$dias ."days",$d));
			   $dataAtual = date("Y-m-d"); 
	
	              if(!$resp && (strtotime($dataReferencia)>=strtotime($dataAtual))):
                    $cor = "style='border:2px solid #FFFF00'";
		        else:
                    if($resp[0]['finalizado']):
                       if(strtotime($dataReferencia)>=strtotime($dataAtual)):
                            $cor = "style='border:2px solid #006400'";
                        else:
                            $cor = "style='border:2px solid #FF0000'";
                       endif;                    
                    else:
                            $cor = "style='border:2px solid #FF0000'";
					endif;        
                endif;
                          
                        
				$html .= "<td align=\"center\"><img src=\"" . CAMINHO_IMG . "lista.png\" title=\"Avaliações\"  onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "/grupo/include/resourceHTML/exibirNotas.php?idIntegranteGrupo=" . $valor['idIntegranteGrupo'] . "', '', '')\"></td>";
				
				if ($naoEnviarPsa == 0) {
				$html .= "<td align=\"center\">".Uteis::exibirData($UltimaPsa)."</td>";
				$html .= "<td align=\"center\"><img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Pesquisa de satisfação\" ".$cor." onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "/grupo/include/resourceHTML/psa.php?idIntegranteGrupo=" . $valor['idIntegranteGrupo'] . "', '', '')\"></td>";	
				
				} elseif ($naoEnviarPsa == 1) {
				$html .= "<td></td>";	
				$html .= "<td align=\"center\">Não enviar Psa para esse Aluno!</td>";
				}
				}
                
                //Subvencao
				$html .= "<td align=\"center\"><img src=\"" . CAMINHO_IMG . "sub.png\" title=\"Subvenção\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "/grupo/include/resourceHTML/subvencao.php?idIntegranteGrupo=" . $valor['idIntegranteGrupo'] . "', '', '')\"></td>";				
				if ($apenasVer != 1) {
				//EXCLUIR
				$delete = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/deleta_integranteGrupo.php?id=" . $valor['idIntegranteGrupo'] . "', '$caminhoAtualizar', '#div_integranteGrupo');\" ";

				$html .= "<td align=\"center\" $delete >" . "<img title=\"DESVINCULAR ALUNO\" src=\"" . CAMINHO_IMG . "excluir.png\">" . "</td>";
				}

				$html .= "</tr>";
			}
		}
		return $html;
	}

	function selectIntegranteGrupoTr_rh($caminho, $where = "",$mobile) {
		
		$Professor = new Professor();

		$sql = " SELECT idIntegranteGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, clientePf_idClientePf, dataEntrada, dataSaida, professor_idProfessor 
		FROM integranteGrupo " . $where;

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idIntegranteGrupo = $valor['idIntegranteGrupo'];
				$idPlanoAcaoGrupo = $valor['planoAcaoGrupo_idPlanoAcaoGrupo'];
				$nome = $this -> getNomePF($valor['idIntegranteGrupo']);
				
				if($nome == '') {
				if ($valor['professor_idProfessor'] > 0) {
						$nome =  $this -> getNomePro($valor['idIntegranteGrupo']);
					}	
				}
								
				$dataEntrada = Uteis::exibirData($valor['dataEntrada']);
				$dataSaida = Uteis::exibirData($valor['dataSaida']);
                $motivo = $valor['obs'];
				
				  $valorI = $this->selectIntegranteGrupo(" WHERE clientePf_idClientePf = ".$valor['clientePf_idClientePf']); 
		 		  
		  		$IntegranteGrupoX = "(";
		  			foreach ($valorI as $valor2) {
			  			$IntegranteGrupoX .= $valor2['idIntegranteGrupo'].", ";
		  			}
		  		$IntegranteGrupoX .= "0)";
				
					//PSA
			    $psa = new PsaIntegranteGrupo();
	               $resp = $psa->selectPsaIntegranteGrupo(" WHERE integranteGrupo_idIntegranteGrupo  in ".$IntegranteGrupoX." ORDER BY idPsaIntegranteGrupo DESC");
             $UltimaPsa = $resp[0]['dataReferencia'];
			   $envioPsa = $valor['envioPsa'];
				
				if ($UltimaPsa == '') {
					$d = strtotime($dataEntrada);
					$dias = $envioPsa;
				} else {
					$d = strtotime($UltimaPsa);
					$dias = 90;
				}

               $dataReferencia = date('Y-m-d', strtotime("+".$dias ."days",$d));
			   $dataAtual = date("Y-m-d"); 
	
	             if(!$resp && (strtotime($dataReferencia)>=strtotime($dataAtual))):
                    $cor = "style='border:2px solid #FFFF00'";
		        else:
                    if($resp[0]['finalizado']):
                       if(strtotime($dataReferencia)>=strtotime($dataAtual)):
                            $cor = "style='border:2px solid #006400'";
                        else:
                            $cor = "style='border:2px solid #FF0000'";
                       endif;                    
                    else:
                            $cor = "style='border:2px solid #FF0000'";
					endif;        
                endif;
                          

				$html .= "<tr>
				
				<td>" . $nome . "</td>
				
				<td>" . $dataEntrada . "</td>
				
				<td>" . $dataSaida . "</td>
				
				<td>". $motivo ."</td>";
	
				$html .= "<td align=\"center\" 
				onclick=\"zerarCentro();carregarModulo('" . $caminho . "frequencia.php?id=$idIntegranteGrupo&idPlanoAcaoGrupo=$idPlanoAcaoGrupo', '#centro')\" >
					<img src=\"" . CAMINHO_IMG . "graf.png\" title=\"Frequência do aluno\" >
					
				</td>";
			
		//		}
		
		$html .= "<td align=\"center\">".Uteis::exibirData($UltimaPsa)."</td>";
		if ($mobile != 1) {
				$html .= "<td align=\"center\"><img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Pesquisa de satisfação\" ".$cor." onclick=\"abrirNivelPagina(this, '" . $caminho . "psa.php?idIntegranteGrupo=" . $valor['idIntegranteGrupo'] . "&idPlanoAcaoGrupo=$idPlanoAcaoGrupo', '', '')\"></td>";	
		} else {
		$html .= "<td align=\"center\"><img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Pesquisa de satisfação\" ".$cor." onclick=\"zerarCentro();carregarModulo('" . $caminho . "psa.php?idIntegranteGrupo=" . $valor['idIntegranteGrupo'] . "&idPlanoAcaoGrupo=$idPlanoAcaoGrupo', '#centro');\"></td>";	
			
			
		}
	
		if ($mobile != 1) {
			$html .= "	<td align=\"center\" 
				onclick=\"abrirNivelPagina(this, '" . $caminho . "exibirNotas.php?id=$idIntegranteGrupo&idPlanoAcaoGrupo=$idPlanoAcaoGrupo', '', '')\" >";
		} else {
			
			$html .= "	<td align=\"center\" 
				onclick=\"zerarCentro();carregarModulo('" . $caminho . "exibirNotas.php?id=$idIntegranteGrupo&idPlanoAcaoGrupo=$idPlanoAcaoGrupo', '#centro');\" >";
				
		}
		$html .="<img src=\"" . CAMINHO_IMG . "lista.png\" title=\"Provas e notas\" >
				</td>";
				
		if ($mobile != 1) {		
				
		$html .= "	<td align=\"center\" onclick=\"abrirNivelPagina(this, 'modulos/desempenho/indexI.php?idIntegranteGrupo=$idIntegranteGrupo&idPlanoAcaoGrupo=$idPlanoAcaoGrupo', '', '')\" >		";
		} else {
		$html .= "	<td align=\"center\" onclick=\"zerarCentro();carregarModulo( 'modulos/desempenho/indexI.php?idIntegranteGrupo=$idIntegranteGrupo&idPlanoAcaoGrupo=$idPlanoAcaoGrupo', '#centro');\" >		";
	
		}
		$html .= "<img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Relatório de desempenho\" >
				</td>
											
				</tr>";
			}
		}

		return $html;

	}

	function selectIntegranteGrupoTr_historico($where = "",$podeAtualizar) {

		$sql = "SELECT SQL_CACHE idIntegranteGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, clientePf_idClientePf, dataEntrada, dataSaida, obs, dataSaidaDemonstrativo, dataRetorno  FROM integranteGrupo
		WHERE dataSaida < CURDATE() " . $where;
		
//		echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
				//Avaliações
				
				$sql2 = "SELECT distinct(nome), integranteGrupo_idIntegranteGrupo, nota, data FROM compa184_oficial.itemCalendarioProva AS ICP 
INNER JOIN itenProva AS IP on IP.idItenProva =  ICP.itenProva_idItenProva
where integranteGrupo_idIntegranteGrupo = ".$valor['idIntegranteGrupo'];

				$result2 = $this -> query($sql2);
				
				if (mysqli_num_rows($result2) > 0) {
					
				$notas = "";	
					while ($valor2 = mysqli_fetch_array($result2)) {
						if ($valor2['nota'] != '') {
	
					$notas .= "<div>".$valor2['nome'].":<strong>".$valor2['nota']."</strong></div>";		
						}
						
					}
					
				}
				
				if ($podeAtualizar != 1) {
				$caminhoAtualizar = CAMINHO_REL . "grupo/include/resourceHTML/integranteGrupo_historico.php?id=" . $valor['planoAcaoGrupo_idPlanoAcaoGrupo'];

				$img = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"IR PARA O CADASTRO\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "clientePf/cadastro.php?id=" . $valor['clientePf_idClientePf'] . "', '$caminhoAtualizar', '')\" >";
				}
				$html .= "<tr>";

				$html .= "<td>" . $img . "&nbsp;" . $this -> getNomePF($valor['idIntegranteGrupo']) . "</td>";

				$dataEntrada = Uteis::exibirData($valor['dataEntrada']);
				$html .= "<td>" . $dataEntrada . "</td>";

				$dataSaida = Uteis::exibirData($valor['dataSaida']);
				
				if ($dataSaida != '') {
				$delete = "<img title=\"Deletar data de saída\" src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"deletarDataSaida(".$valor['idIntegranteGrupo'].");\" />";
					
				}
				
				$html .= "<td >$delete" . $dataSaida . "</td>";
				
				$dataSaidaD = Uteis::exibirData($valor['dataSaidaDemonstrativo']);
				
				$html .= "<td>" . $dataSaidaD . "</td>";
				
				$html .= "<td>" . $notas .= "</td>";
                
                $motivo = $valor['obs'];
                $html .= "<td>" . $motivo . "</td>";
				
				$dataRetorno = Uteis::exibirData($valor['dataRetorno']);
				  $html .= "<td>" . $dataRetorno . "</td>";
				

				$html .= "</tr>";
			}
		} else {
			$html .= "<tr><td>Sem Informação</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		}
		return $html;
	}
	
	function selectIntegranteGrupoTr_historicoInd($where = "",$podeAtualizar,$idClientePj, $excel = false, $dataSaidaFiltro, $tipo, $campos,$camposNome ) {
	
		if ($dataSaidaFiltro == "") {
		$dataSaidaFiltro = date("Y-m-t");	
		}
		
	//	echo $dataSaidaFiltro;
		$GrupoClientePj  = new GrupoClientePj();
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
		$ClientePf = new ClientePf();
		$Idioma = new Idioma();
		$ValorHoraGrupo = new ValorHoraGrupo();
		$AulaGrupoProfessor = new AulaGrupoProfessor();
		$Professor = new Professor();
		$Ocorrencia = new Ocorrencia();
		$Relatorio = new Relatorio();
				
		$sql = "SELECT SQL_CACHE P.idIntegranteGrupo, P.planoAcaoGrupo_idPlanoAcaoGrupo, P.clientePf_idClientePf, P.dataEntrada, P.dataSaida, P.obs, P.dataSaidaDemonstrativo, P.dataRetorno, PAG.nivelEstudo_IdNivelEstudo  FROM integranteGrupo AS P
		INNER JOIN clientePf as CPF on CPF.idClientePf = P.clientePf_idClientePf
		INNER JOIN planoAcaoGrupo as PAG on PAG.idPlanoAcaoGrupo = P.planoAcaoGrupo_idPlanoAcaoGrupo";
		
		if (($idClientePj != '') && ($idClientePj >0 )){
			
		$sql .= " INNER JOIN grupoClientePj as GP on GP.grupo_idGrupo = PAG.grupo_idGrupo
		where GP.clientePj_idClientePj = ".$idClientePj . $where;	
		
		} else {
		
		$sql .=  $where;
		}
		echo $sql;
			$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
				$idPlanoAcaoGrupo = $valor['planoAcaoGrupo_idPlanoAcaoGrupo'];
				$idClientePf = $valor['clientePf_idClientePf'];
				
				$sql2 = " SELECT DISTINCT(I.idIntegranteGrupo) FROM integranteGrupo AS I
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = I.planoAcaoGrupo_idPlanoAcaoGrupo 
			AND PAG.inativo = 0
		INNER JOIN clientePf AS C ON C.idClientePf = I.clientePf_idClientePf
	    WHERE C.idClientePf = ".$idClientePf." AND (I.dataSaida is null or I.dataSaida > '".$dataSaidaFiltro."') ";
	//	 echo $sql2;
		 
		 $result2 = $this -> query($sql2);	
		 
		 $x =0;
		 while ($valor2 = mysqli_fetch_array($result2)) {
			$x++; 
		 }
		 
		 	//Avaliações
				
				$sql2 = "SELECT distinct(nome), integranteGrupo_idIntegranteGrupo, nota, data FROM compa184_oficial.itemCalendarioProva AS ICP 
INNER JOIN itenProva AS IP on IP.idItenProva =  ICP.itenProva_idItenProva
where integranteGrupo_idIntegranteGrupo = ".$valor['idIntegranteGrupo'];

				$result2 = $this -> query($sql2);
				
				$notas = "";
				
				if (mysqli_num_rows($result2) > 0) {
					
				$notas = "";	
					while ($valor2 = mysqli_fetch_array($result2)) {
						if ($valor2['nota'] != '') {
	
					$notas .= "<div>".$valor2['nome'].":<strong>".$valor2['nota']."</strong></div>";		
						}
						
					}
					
				}
		 
			
				if (($x == 0 ) || ($tipo == 1)) { 
				if ($podeAtualizar != 1) {
				$caminhoAtualizar = CAMINHO_RELAT . "comercial/include/resourceHTML/retorno.php";

				if (!$excel) $img = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"IR PARA O CADASTRO\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "clientePf/cadastro.php?id=" . $valor['clientePf_idClientePf'] . "', '$caminhoAtualizar', '#lista_clientepf')\" >";
				
					
				$onclick = " onclick=\"abrirNivelPagina(this, '" .CAMINHO_RELAT."comercial/include/resourceHTML/historico.php?idClientePf=$idClientePf', '', '#lista_clientepf')\" ";
				}
				
				  if ($campos) {
				
				$html .= "<tr>";
				
				 foreach ($campos as $campo) {
					 
					 if ($campo == 'nome') {
				$html .= "<td >" . $img . "&nbsp;" . $this -> getNomePF($valor['idIntegranteGrupo']) . "</td>";
					 } elseif ($campo == 'email') {
				$emails = $ClientePf->getEmail($valor['clientePf_idClientePf']);
				$html .= "<td>".$emails."</td>";
					 } elseif ($campo == 'empresa') {
				$idGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo,true);
				$nomeEmpresa = $GrupoClientePj->getNomePj($idGrupo);
				$html .= "<td $onclick>" . $nomeEmpresa . "</td>";
					 } elseif ($campo == 'nomeGrupo') {
				$nomeGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);
				$html .= "<td $onclick>" . $nomeGrupo . "</td>";
					 } elseif ($campo == 'nivel') {
				$nivel = $PlanoAcaoGrupo->getIdNivel($idPlanoAcaoGrupo,true);
				$html .= "<td $onclick>" . $nivel . "</td>";
					 } elseif ($campo == 'idioma') {
				$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);
				$nomeIdioma = $Idioma->getNome($idIdioma);
				$html .= "<td $onclick>" . $nomeIdioma . "</td>";
					 } elseif ($campo == 'valorHora') {
				$dataReferencia = date("Y-m-01", strtotime($valor['dataSaida']));
				$rs = $ValorHoraGrupo->selectValorHoraGrupo_periodo($idPlanoAcaoGrupo, $dataReferencia);
				$valorHg = $rs[0]['valorHora'];	
				$html .= "<td $onclick>". Uteis::exibirMoeda($valorHg) . "</td>";
					 } elseif ($campo == 'professor') {
				$idProfessor = $AulaGrupoProfessor->selectAulaGrupoProfessor_periodo($idPlanoAcaoGrupo,$dataReferencia);
				$nomeProfessor = $Professor->getNome($idProfessor[0]);
				$html .= "<td $onclick>". $nomeProfessor . "</td>";	
					 } elseif ($campo == 'telefone') {
				$telefones = " ";
                $sql = " SELECT clientePf_idClientePf, ddd, numero, DT.nome FROM telefone INNER JOIN descricaoTelefone AS DT ON descricaoTelefone_idDescricaoTelefone = DT.idDescricaoTelefone WHERE clientePf_idClientePf = ".$idClientePf." limit 3";
				$rsTelefone = $this->query($sql);
		        if(mysqli_num_rows($rsTelefone) > 0){
                      while ($valorTelefone = mysqli_fetch_array($rsTelefone)) {
                       $telefones .= " <div class=\"destacaLinha\"> [".$valorTelefone['nome']."] (".$valorTelefone['ddd'].") ".$valorTelefone['numero']."</div>";
               		      }
                    }
				$html .= "<td $onclick>". $telefones . "</td>";	
					 } elseif ($campo == 'dataEntrada') {
				$dataEntrada = Uteis::exibirData($valor['dataEntrada']);
				$html .= "<td $onclick>" . $dataEntrada . "</td>";
					 } elseif ($campo == 'dataSaida') {
				$dataSaida = Uteis::exibirData($valor['dataSaida']);
				$html .= "<td $onclick>" . $dataSaida . "</td>";
					 } elseif ($campo == 'notas') {
				$html .= "<td $onclick>" . $notas . "</td>";
					 } elseif ($campo == 'motivo') {
                $html .= "<td $onclick>" . $valor['obs'] . "</td>";
					 } elseif ($campo == 'dataRetorno') {
				$dataRetorno = Uteis::exibirData($valor['dataRetorno']);
				$html .= "<td $onclick>" . $dataRetorno . "</td>";}
				 		}
				  }

				$html .= "</tr>";
				}
			}
		} 
		
//	 $colunas = array("Nome", "Email", "Empresa", "Nome grupo", "Nível", "Idioma", "Valor Hora", "Professor", "Telefones", "Data entrada", "Data saída", "Notas", "Motivo", "Data retorno" );

	$html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head);

    return $html_base . $html;
	
	}

	/**
	 * selectIntegranteGrupoSelect() Function
	 */
	function selectIntegranteGrupoSelect($classes = "", $idAtual = 0, $where = "", $ExibirNome) {
		$sql = "SELECT SQL_CACHE idIntegranteGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, clientePf_idClientePf, dataEntrada, dataSaida, dataCadastro FROM integranteGrupo " . $where;
		
		$result = $this -> query($sql);
		$ClientePf =  new ClientePf();
		$html = "<select id=\"idIntegranteGrupo\" name=\"idIntegranteGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$nome = $ClientePf->getNome($valor['clientePf_idClientePf']);
			$selecionado = $idAtual == $valor['idIntegranteGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idIntegranteGrupo'] . "\">";
			
			if ($ExibirNome == 1) {
				$html .= $nome;
			} else {
			 $html .= ($valor['idIntegranteGrupo']) . "</option>";
			}
		}

		$html .= "</select>";
		return $html;
	}
	
	function getIdClientePf($idIntegranteGrupo) {
		$ClientePf = new ClientePf();
		$valorIntegranteGrupo = $this -> selectIntegranteGrupo(" WHERE idIntegranteGrupo = " . $idIntegranteGrupo);
		return $valorIntegranteGrupo[0]['clientePf_idClientePf'];
	}
	
	function getNomePF($idIntegranteGrupo, $nomeMenor = false) {
		$ClientePf = new ClientePf();
		$valorIntegranteGrupo = $this -> selectIntegranteGrupo(" WHERE idIntegranteGrupo = " . $idIntegranteGrupo);
		$nomeClientepf = $ClientePf -> selectClientepf(" WHERE idClientePf = " . $valorIntegranteGrupo[0]['clientePf_idClientePf']);
		return ($nomeMenor == false) ? $nomeClientepf[0]['nome'] : $nomeClientepf[0]['nomeExibicao'];
	}
	
	function getNomePro($idIntegranteGrupo, $nomeMenor = false) {
		$Professor = new Professor();
		$valorIntegranteGrupo = $this -> selectIntegranteGrupo(" WHERE idIntegranteGrupo = " . $idIntegranteGrupo);
		$nomeProfessor = $Professor -> selectProfessor(" WHERE idProfessor = " . $valorIntegranteGrupo[0]['professor_idProfessor']);
		return ($nomeMenor == false) ? $nomeProfessor[0]['nome'] : $nomeProfessor[0]['nomeExibicao'];
	}

	function getEmail($idIntegranteGrupo) {

		$sql = " SELECT C.nome, E.valor FROM clientePf AS C 
		INNER JOIN integranteGrupo AS I ON I.clientePf_idClientePf = C.idClientePf
		INNER JOIN enderecoVirtual AS E ON E.clientePf_idClientePf = C.idClientePf AND tipoEnderecoVirtual_idTipoEnderecoVirtual = 1
		WHERE E.ePrinc = 1 AND C.naoReceberEmail = 0 AND I.idIntegranteGrupo = " . $idIntegranteGrupo;
		$result = $this -> query($sql);
        $valor = $this->fetchArray($result);
  		$emails = $valor['valor'];
     
		
		return $emails;
      

	}
    function getTelefone($idIntegranteGrupo){
            
        $sql = "SELECT T.ddd, T.numero, D.nome AS descricao FROM clientePf AS C 
        INNER JOIN integranteGrupo AS I ON I.clientePf_idClientePf = C.idClientePf
        INNER JOIN telefone AS T ON T.clientePf_idClientePf = C.idClientePf
        LEFT JOIN descricaoTelefone AS D ON D.idDescricaoTelefone = T.descricaoTelefone_idDescricaoTelefone
        WHERE I.idIntegranteGrupo = " . $idIntegranteGrupo." LIMIT 1";
        $result = $this -> query($sql);
        while ($valor = mysqli_fetch_array($result)) {
            $telefones = "(".$valor['ddd'].") ".$valor['numero']." - ".$valor['descricao'];     
        }
        
        return $telefone;
    }

	function getidIntegranteGrupo($idClientePf="", $idPlanoAcaoGrupo = "", $dataSaida="") {

		$sql = " SELECT DISTINCT(I.idIntegranteGrupo) FROM integranteGrupo AS I
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = I.planoAcaoGrupo_idPlanoAcaoGrupo 
		INNER JOIN clientePf AS C ON C.idClientePf = I.clientePf_idClientePf";
		if($idClientePf):
            $sql .= " WHERE C.idClientePf = $idClientePf AND (I.dataSaida is null or I.dataSaida < ".$dataSaida.") ";		
		  if ($idPlanoAcaoGrupo):
			     $sql .= " AND PAG.idPlanoAcaoGrupo in ($idPlanoAcaoGrupo) ";
          endif;	     
        else:
                  
          if ($idPlanoAcaoGrupo):
                 $sql .= " WHERE PAG.idPlanoAcaoGrupo in ( $idPlanoAcaoGrupo) AND (I.dataSaida is null or I.dataSaida < ".$dataSaida.") ";
          endif;  
        endif;	
//		echo $sql;	
		$rs = $this -> query($sql);

		if (mysqli_num_rows($rs) > 0) {
			while ($valor = mysqli_fetch_array($rs))
				$id[] = $valor['idIntegranteGrupo'];
		}
		return implode(",", $id);
	}
	
	function getidIntegranteGrupoProf($idProfessor="", $idPlanoAcaoGrupo = "", $dataSaida="") {

		$sql = " SELECT DISTINCT(I.idIntegranteGrupo) FROM integranteGrupo AS I
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = I.planoAcaoGrupo_idPlanoAcaoGrupo 
		INNER JOIN professor AS C ON C.idProfessor = I.professor_idProfessor";
		if($idProfessor):
            $sql .= " WHERE C.idProfessor = $idProfessor AND (I.dataSaida is null or I.dataSaida < ".$dataSaida.") ";		
		  if ($idPlanoAcaoGrupo):
			     $sql .= " AND PAG.idPlanoAcaoGrupo in ($idPlanoAcaoGrupo) ";
          endif;	     
        else:
                  
          if ($idPlanoAcaoGrupo):
                 $sql .= " WHERE PAG.idPlanoAcaoGrupo in ( $idPlanoAcaoGrupo) AND (I.dataSaida is null or I.dataSaida < ".$dataSaida.") ";
          endif;  
        endif;	
//		echo $sql;	
		$rs = $this -> query($sql);

		if (mysqli_num_rows($rs) > 0) {
			while ($valor = mysqli_fetch_array($rs))
				$id[] = $valor['idIntegranteGrupo'];
		}
		return implode(",", $id);
	}
	
	function integrantePAG($integranteGrupo) {
		$rs = self::selectIntegranteGrupo(" WHERE idIntegranteGrupo = ".$integranteGrupo);
		return $rs[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
		
	}

	function selectIntegranteGrupoFF($idPlanoAcaoGrupo, $dataReferencia) {

		$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));

		$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . " 
		AND dataEntrada <= '" . $dataReferenciaFinal . "' 
		AND (dataSaida >= '" . $dataReferencia . "' OR dataSaida IS NULL OR dataSaida = '') ";
		$rs = $this -> selectIntegranteGrupo($where);
	//	Uteis::pr( $where);

		return $rs;

	}

	function selectIntegranteGrupo_Demonstrativo($idPlanoAcaoGrupo, $dataReferencia) {
		$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));
		$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . " 
		AND dataEntrada <= '" . $dataReferenciaFinal . "' 
		AND (
			dataSaidaDemonstrativo > '" . $dataReferencia . "' 
			OR dataSaidaDemonstrativo IS NULL OR dataSaidaDemonstrativo = ''
		) ";
		$rs = $this -> selectIntegranteGrupo($where);
	//	echo $where;
		return $rs;

	}

	function select_professoresIntegranteGrupo($idIntegranteGrupo, $idProfessor = "", $class = "") {

		if (!$idIntegranteGrupo)
			$idIntegranteGrupo = "0";

		$sql = "SELECT SQL_CACHE idProfessor, nome FROM professor 
		WHERE idProfessor IN (
			SELECT professor_idProfessor FROM aulaGrupoProfessor 
			WHERE aulaPermanenteGrupo_idAulaPermanenteGrupo in ( 
				SELECT idAulaPermanenteGrupo FROM aulaPermanenteGrupo 
				WHERE planoAcaoGrupo_idPlanoAcaoGrupo IN (
					SELECT planoAcaoGrupo_idPlanoAcaoGrupo FROM integranteGrupo 
					WHERE idIntegranteGrupo IN (" . $idIntegranteGrupo . ") 
				)
			) 
			OR aulaDataFixa_idAulaDataFixa IN (
				SELECT idAulaDataFixa FROM aulaDataFixa WHERE planoAcaoGrupo_idPlanoAcaoGrupo IN (
					SELECT planoAcaoGrupo_idPlanoAcaoGrupo FROM integranteGrupo 
					WHERE idIntegranteGrupo IN (" . $idIntegranteGrupo . ") 
				)
			)
		)";

		$result = $this -> query($sql);

		$html = "<select id=\"idProfessor\" name=\"idProfessor\" class=\"$class\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idProfessor == $valor['idProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idProfessor'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;

	}

	function select_professoresIntegranteGrupoPsa($idIntegranteGrupo, $idProfessor = "", $class = "") {
		
		$Professor = new Professor();

		if (!$idIntegranteGrupo)
			$idIntegranteGrupo = "0";

		$sql = "SELECT SQL_CACHE idProfessor, nome FROM professor 
		WHERE idProfessor IN (
			SELECT professor_idProfessor FROM aulaGrupoProfessor 
			WHERE aulaPermanenteGrupo_idAulaPermanenteGrupo in ( 
				SELECT idAulaPermanenteGrupo FROM aulaPermanenteGrupo 
				WHERE planoAcaoGrupo_idPlanoAcaoGrupo IN (
					SELECT planoAcaoGrupo_idPlanoAcaoGrupo FROM integranteGrupo 
					WHERE idIntegranteGrupo IN (" . $idIntegranteGrupo . ") 
				)
			) 
			OR aulaDataFixa_idAulaDataFixa IN (
				SELECT idAulaDataFixa FROM aulaDataFixa WHERE planoAcaoGrupo_idPlanoAcaoGrupo IN (
					SELECT planoAcaoGrupo_idPlanoAcaoGrupo FROM integranteGrupo 
					WHERE idIntegranteGrupo IN (" . $idIntegranteGrupo . ") 
				)
			)
		)";

		$result = $this -> query($sql);

		$html = "<select id=\"idProfessor\" name=\"idProfessor\" class=\"$class\" >";
		$html .= "<option value=\"\">Selecione</option>";
		
		while ($valor = mysqli_fetch_array($result)) {
			$ids[] = $valor['idProfessor'];
			$selecionado = $idProfessor == $valor['idProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idProfessor'] . "\">" . ($valor['nome']) . "</option>";
		}
		
		$valorx2 = implode(',', $ids);
		
		$sql2 = "SELECT SQL_CACHE idProfessor, nome FROM professor WHERE excluido = 0 AND inativo = 0 AND candidato = 0 AND idProfessor not in (" . $valorx2 . ") ORDER BY nome";
		$result2 = $this -> query($sql2);
		while ($valor2 = mysqli_fetch_array($result2)) {
			$selecionado = $idProfessor == $valor2['idProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor2['idProfessor'] . "\">" . ($valor2['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;

	}

	function select_gerentePorIdCliente($idClientePf, $idFuncionario = "", $class = "", $soId = 0) {

		if (!$idClientePf)
			$idClientePf = "0";

		$sql = "SELECT DISTINCT(F.idFuncionario), F.nome FROM (		
			SELECT DISTINCT(GT.gerente_idGerente) AS idGerente, C.idClientePf 
			FROM clientePf AS C 	
			INNER JOIN gerenteTem AS GT ON GT.clientePj_idClientePj = C.clientePj_idClientePj
				AND (dataExclusao IS NULL OR dataExclusao = '')
			UNION 
			SELECT DISTINCT(GT.gerente_idGerente) AS idGerente, IG.clientePf_idClientePf AS idClientePf
			FROM integranteGrupo AS IG
			INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = IG.planoAcaoGrupo_idPlanoAcaoGrupo
			INNER JOIN gerenteTem AS GT ON GT.grupo_idGrupo = PAG.grupo_idGrupo
				AND (dataExclusao IS NULL OR dataExclusao = '')
		) AS T
		INNER JOIN gerente AS G ON G.idGerente = T.idGerente
		INNER JOIN funcionario AS F ON F.idFuncionario = G.funcionario_idFuncionario 
		WHERE T.idClientePf = $idClientePf";
		$result = $this -> query($sql);
		
		if ($soId == 0) {

		$html = "<select id=\"idFuncionario\" name=\"idFuncionario\" class=\"$class\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idFuncionario == $valor['idFuncionario'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idFuncionario'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		
		} else {
			while ($valor = mysqli_fetch_array($result)) {
		$html = $valor['idFuncionario'];	
			}
			
		}
		return $html;
	}
  
  function tornarCliente() {
    
    $ClientePf = new ClientePf();    
    $ClientePf->setIdClientePf($this->clientePfIdClientePf);
    $ClientePf->updateFieldClientepf("tipoCliente_idTipoCliente", "3");
    
  }
  function ExAluno($where){
      $sql = "SELECT SQL_CACHE I.idIntegranteGrupo, I.planoAcaoGrupo_idPlanoAcaoGrupo, I.clientePf_idClientePf FROM integranteGrupo as I 
              INNER JOIN planoAcaoGrupo AS PA ON PA.idPlanoAcaoGrupo = I.planoAcaoGrupo_idPlanoAcaoGrupo
              INNER JOIN grupo AS G ON G.idGrupo = PA.grupo_idGrupo " . $where;
       // echo "<hr>".$sql;
      return $this -> executeQuery($sql);
  } 
}
?>