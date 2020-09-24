<?php
class BuscaAvulsa extends Database {
	// class attributes
	var $idBuscaAvulsa;
	var $idiomaIdIdioma;
	var $clientePjIdClientePj;
	var $enderecoIdEndereco;
	var $obs;
	var $dataApartir;
	var $excluida;
	var $urgente;
	var $finalizada;
	var $grupoIdGrupo;
	var $portalP;
	var $status;
	var $gerenteIdGerente;
	var $valorHoraAluno;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idBuscaAvulsa = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> clientePjIdClientePj = "NULL";
		$this -> enderecoIdEndereco = "NULL";
		$this -> obs = "NULL";
		$this -> dataApartir = "NULL";
		$this -> excluida = "0";
		$this -> urgente = "0";
		$this -> finalizada = "0";
		$this -> grupoIdGrupo = "NULL";
		$this -> portalP = "0";
		$this -> status = "1";
		$this -> gerenteIdGerente = "NULL";
		$this -> valorHoraAluno = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdBuscaAvulsa($value) {
		$this -> idBuscaAvulsa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
	}

    function setAlunoObs($value) {
        $this -> setAlunoObs = ($value) ? $this -> gravarBD($value) : "NULL";
    }

	function setEnderecoIdEndereco($value) {
		$this -> enderecoIdEndereco = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataApartir($value) {
		$this -> dataApartir = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluida($value) {
		$this -> excluida = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setUrgente($value) {
		$this -> urgente = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setFinalizada($value) {
		$this -> finalizada = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setGrupoIdGrupo($value) {
		$this -> grupoIdGrupo = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setPortalP($value) {
		$this -> portalP = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setStatus($value) {
		$this -> status = ($value) ? $this -> gravarBD($value) : "1";
	}
	
	
	function setGerenteIdGerente($value) {
		$this -> gerenteIdGerente = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setValorHoraAluno($value) {
		$this -> valorHoraAluno = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addBuscaAvulsa() Function
	 */
	function addBuscaAvulsa() {
		$sql = "INSERT INTO buscaAvulsa (idioma_idIdioma, clientePj_idClientePj, alunoobs, endereco_idEndereco, obs, dataApartir, excluida, urgente, finalizada, grupo_idGrupo, portalP, status, gerente_idGerente, valorHoraAluno) VALUES ($this->idiomaIdIdioma, $this->clientePjIdClientePj, $this->setAlunoObs, $this->enderecoIdEndereco, $this->obs, $this->dataApartir, $this->excluida, $this->urgente, $this->finalizada, $this->grupoIdGrupo, $this->portalP, $this->status, $this->gerenteIdGerente, $this->valorHoraAluno)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteBuscaAvulsa() Function
	 */
	function deleteBuscaAvulsa() {
		$sql = "DELETE FROM buscaAvulsa WHERE idBuscaAvulsa = $this->idBuscaAvulsa";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldBuscaAvulsa() Function
	 */
	function updateFieldBuscaAvulsa($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE buscaAvulsa SET " . $field . " = " . $value . " WHERE idBuscaAvulsa = $this->idBuscaAvulsa";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateBuscaAvulsa() Function
	 */
	function updateBuscaAvulsa() {
		$sql = "UPDATE buscaAvulsa SET idioma_idIdioma = $this->idiomaIdIdioma, clientePj_idClientePj = $this->clientePjIdClientePj, alunoobs = $this->setAlunoObs, endereco_idEndereco = $this->enderecoIdEndereco, obs = $this->obs, dataApartir = $this->dataApartir, excluida = $this->excluida, urgente = $this->urgente, finalizada = $this->finalizada, grupo_idGrupo = $this->grupoIdGrupo, portalP = $this->portalP, status = $this->status, gerente_idGerente = $this->gerenteIdGerente, valorHoraAluno = $this->valorHoraAluno WHERE idBuscaAvulsa = $this->idBuscaAvulsa";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectBuscaAvulsa() Function
	 */
	function selectBuscaAvulsa($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idBuscaAvulsa, idioma_idIdioma, clientePj_idClientePj, alunoobs, endereco_idEndereco, obs, dataApartir, excluida, urgente, finalizada, grupo_idGrupo, portalP, status, gerente_idGerente, valorHoraAluno FROM buscaAvulsa " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectBuscaAvulsaTr() Function
	 */
	function selectBuscaAvulsaTr($caminhoAtualizar_base, $where = "", $apenasLinha = false, $vBusca) {
		
		$Grupo = new Grupo();
		$Gerente = new Gerente();
		
		
		if ($vBusca > 0) {
		$where .= " AND B.status = ".$vBusca;	
			
		}

		$sql = " SELECT DISTINCT(B.idBuscaAvulsa) AS idBuscaAvulsa, B.dataApartir, B.urgente, COALESCE(PJ.razaoSocial, 'Particular') AS razaoSocial, B.alunoobs, B.grupo_idGrupo, B.gerente_idGerente, B.valorHoraAluno, I.idioma, B.obs, B.status, I.idIdioma
		FROM buscaAvulsa AS B 		
		INNER JOIN idioma AS I ON I.idIdioma = B.idioma_idIdioma
		LEFT JOIN clientePj AS PJ ON PJ.idClientePj = B.clientePj_idClientePj
		WHERE B.excluida = 0 " . $where;
		$resultBusca = $this -> query($sql);
 //       echo $sql;
		if (mysqli_num_rows($resultBusca) > 0) {

			$html = "";
			$cont = 0;

			$DiasBuscaAvulsa = new DiasBuscaAvulsa();

			while ($valor = mysqli_fetch_array($resultBusca)) {
				
				$status = "";

				$idBuscaAvulsa = $valor['idBuscaAvulsa'];
				
				$urgente = $valor['urgente'];
				$statusP = $valor['status'];
				
				$nomeGerente = $Gerente->getNomeGerente($valor['gerente_idGerente']);;
				$valorHoraAluno = Uteis::exibirMoeda($valor['valorHoraAluno']);

				$nomeGrupo = $Grupo->getNome($valor['grupo_idGrupo']);
					
				if ($nomeGrupo != '') {
					$nomeGrupo = " /Grupo: ".$nomeGrupo;
				}
					
                $nome = ($valor['alunoobs']<>"")? '<br><em>'.Uteis::resumir($valor['alunoobs'], 120).'</em>' : '';
				
				if ($valor['obs'] != '') {
					
				}
				
				//EMPRESA
				$empresa = "<span onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/avulsa/include/form/avulsa.php?idBuscaAvulsa=$idBuscaAvulsa', '$caminhoAtualizar', 'tr')\" >" . $valor['razaoSocial'] . $nomeGrupo. ($urgente ? " <strong><font color=\"#FF0000\">URGENTE</font></strong>" : "")  .$nome. "</span>";
				//DIAS
				$dias = $DiasBuscaAvulsa -> selectDiasBuscaAvulsaTr_dias(CAMINHO_REL . "busca/avulsa/include/form/dia.php", $caminhoAtualizar, "tr", " AND buscaAvulsa_idBuscaAvulsa = $idBuscaAvulsa");

				//PROF
				$prof = $DiasBuscaAvulsa -> selectDiasBuscaAvulsaTr_prof(CAMINHO_REL . "busca/avulsa/include/resourceHTML/busca.php", $caminhoAtualizar, "tr", " AND buscaAvulsa_idBuscaAvulsa = $idBuscaAvulsa", $valor['idIdioma']);

			//Status da Busca
			$status = "<input type=\"radio\" id=\"".$idBuscaAvulsa."\" name=\"".$idBuscaAvulsa."\" value=\"1\" onchange=\"mudarStatus($idBuscaAvulsa, 1)\"";
			if ($statusP == 1) {
				$status .= "checked=\"checked\"";	
				$estilo = "style=\"color:red\" ";			
			}
			$status .= " /><span $estilo id=\"".$idBuscaAvulsa."_1\" name=\"".$idBuscaAvulsa."_1\" > Não tem professor </span><br>";
			$estilo = "";
			$status .= "<input type=\"radio\" id=\"".$idBuscaAvulsa."\" name=\"".$idBuscaAvulsa."\" value=\"2\" onchange=\"mudarStatus($idBuscaAvulsa, 2)\"";
			if ($statusP == 2) {
				$status .= "checked=\"checked\"";
				$estilo = " style=\"font-weight:bold;color:blue;\" ";				
			}
			$status .= " /><span $estilo id=\"".$idBuscaAvulsa."_2\" name=\"".$idBuscaAvulsa."_2\"> Aguardando aprovação do coordenador </span><br>";
			$estilo = "";
			$status .= "<input type=\"radio\" id=\"".$idBuscaAvulsa."\" name=\"".$idBuscaAvulsa."\" value=\"3\" onchange=\"mudarStatus(".$idBuscaAvulsa.", 3)\"";
			if ($statusP == 3) {
				$status .= "checked=\"checked\"";	
				$estilo = "style=\"color:green;\" ";			
			}
			$status .= " /><span $estilo id=\"".$idBuscaAvulsa."_3\" name=\"".$idBuscaAvulsa."_3\"> TUDO OK!</span>";
			$estilo = "";

			$result2 = Uteis::executarQuery($sql2);
			
			foreach ($result2 as $valor2) {

			if ($valor2['nome'] <> "" )
				{
				$enviarGrupo = "<center> <img src=\"" . CAMINHO_IMG . "esquerda.png\" title=\"Enviar dados para o Grupo\" onclick=\"postForm('', '" . CAMINHO_REL . "busca/avulsa/include/acao/mandarGrupo.php?idBuscaAvulsa=$idBuscaAvulsa')\"/></center>";	
				} else {
					
					$enviarGrupo = "";
				}
		} 
                
				$del = "<center> <img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"Excluir\" onclick=\"deletaRegistro('" . CAMINHO_REL . "busca/avulsa/include/acao/avulsa.php', '$idBuscaAvulsa', '$caminhoAtualizar_base', '#centro')\" /> </center>";

				$novoDia = "<center> <img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Novo dia\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/avulsa/include/form/dia.php?idBuscaAvulsa=$idBuscaAvulsa', '$caminhoAtualizar', 'tr')\" /> </center>";
				
				$nomeIdioma = $valor['idioma'];
				
				if ($apenasLinha !== false) {
					$caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idBuscaAvulsa=" . $idBuscaAvulsa . "&ordem=" . $apenasLinha;
					$col = array();

					$col[] = $empresa;
					$col[] = $nomeIdioma;
                    $col[] = Uteis::exibirData($valor['dataApartir']);
					$col[] = $novoDia;
					$col[] = $dias;
					$col[] = $prof;	
					$col[] = $nomeGerente;
					$col[] = $valorHoraAluno;
					$col[] = $enviarGrupo;	
					$col[] = $status;			
					$col[] = $del;

					$html = $col;
					break;

				} else {

					$caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idBuscaAvulsa=" . $idBuscaAvulsa . "&ordem=" . ($cont++);
					$html .= "<tr >";
					$html .= "<td>" . $empresa . "</td>";
					$html .= "<td>" . $nomeIdioma . "</td>";					
                    $html .= "<td align=\"center\">" . Uteis::exibirData($valor['dataApartir']) . "</td>";
					$html .= "<td>" . $novoDia . "</td>";
					$html .= "<td>" . $dias . "</td>";
					$html .= "<td>" . $prof . "</td>";
					$html .= "<td>" . $nomeGerente . "</td>";
					$html .= "<td>" . $valorHoraAluno . "</td>";										
					$html .= "<td>". $enviarGrupo."</td>";
					$html .= "<td>". $status."</td>";					
					$html .= "<td>" . $del . "</td>";
					$html .= "</tr>";

				}
			}
		}
		return $html;
	}
	
	//Relatorio Busca Avulsa
	function selectRelatorioBuscaAvulsaTr($where = "", $apenasLinha = false, $vBusca, $campos, $camposNome, $excel = false,$dataInicio, $dataReferenciaFinal) {
		
		$Grupo = new Grupo();
		$Gerente = new Gerente();
		$Relatorio = new Relatorio();
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
		$AulaGrupoProfessor = new AulaGrupoProfessor();
		$Professor = new Professor();
		
		if ($vBusca > 0) {
		$where .= " AND B.status = ".$vBusca;	
			
		}

		$sql = " SELECT DISTINCT(B.idBuscaAvulsa) AS idBuscaAvulsa, B.dataApartir, B.urgente, COALESCE(PJ.razaoSocial, 'Particular') AS razaoSocial, B.alunoobs, B.grupo_idGrupo, B.gerente_idGerente, B.valorHoraAluno, I.idioma, B.obs, B.status, I.idIdioma, PJ.idClientePj
		FROM buscaAvulsa AS B 		
		INNER JOIN idioma AS I ON I.idIdioma = B.idioma_idIdioma
		LEFT JOIN clientePj AS PJ ON PJ.idClientePj = B.clientePj_idClientePj
		WHERE 1 /* B.excluida = 0 */" . $where;
		$resultBusca = $this -> query($sql);
		if (mysqli_num_rows($resultBusca) > 0) {

			$html = "";
			$cont = 0;

			$DiasBuscaAvulsa = new DiasBuscaAvulsa();

			while ($valor = mysqli_fetch_array($resultBusca)) {
				$status = "";

				$idBuscaAvulsa = $valor['idBuscaAvulsa'];
				
				$urgente = $valor['urgente'];
				$statusP = $valor['status'];
				
				$nomeGerente = $Gerente->getNomeGerente($valor['gerente_idGerente']);;
				$valorHoraAluno = Uteis::exibirMoeda($valor['valorHoraAluno']);
				
				$idPlanoAcaoGrupo = $PlanoAcaoGrupo->getPAG_atual($valor['grupo_idGrupo']);
				
				if (!$excel) {
					$acesso =  "<img src='/cursos/images/cad.png' title='Ver grupo' onclick='abrirNivelPagina(this, \"/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$idPlanoAcaoGrupo."\", \"\", \"\")'>".$nomeGrupo."";
				}

				
				if ($valor['grupo_idGrupo'] > 0) {
					$nomeGrupo = $Grupo->getNome($valor['grupo_idGrupo']);
					
				} else {
					$nomeGrupo = '';
				}
				
                $nome = ($valor['alunoobs']<>"")? '<br><em>'.Uteis::resumir($valor['alunoobs'], 120).'</em>' : '';
				
				//EMPRESA
				$empresa = "<span onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/avulsa/include/form/avulsa.php?idBuscaAvulsa=$idBuscaAvulsa', '$caminhoAtualizar', 'tr')\" >" . $valor['razaoSocial'] . ($urgente ? " <strong><font color=\"#FF0000\">URGENTE</font></strong>" : "")  .$nome. "</span>";
				//DIAS
				$dias = $DiasBuscaAvulsa -> selectDiasBuscaAvulsaTr_dias(CAMINHO_REL . "busca/avulsa/include/form/dia.php", $caminhoAtualizar, "tr", " AND buscaAvulsa_idBuscaAvulsa = $idBuscaAvulsa");

				//PROF
				
				$profAntigo = "";
				
				$sql3 = "SELECT G.nome, APG.diaSemana, AGP.dataInicio, AGP.dataFim, APG.dataFim AS dataFimAula, P.nome AS Pnome, BP.obs, P.idProfessor, PAG.idPlanoAcaoGrupo, AGP.motivo, AGP.subMotivo FROM aulaGrupoProfessor AS AGP INNER JOIN professor as P ON AGP.professor_idProfessor = P.idProfessor INNER JOIN aulaPermanenteGrupo AS APG ON APG.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo LEFT JOIN buscaProfessor AS BP ON BP.aulaPermanenteGrupo_idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = APG.planoAcaoGrupo_idPlanoAcaoGrupo INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo INNER JOIN grupoClientePj AS GCP on GCP.grupo_idGrupo = G.idGrupo INNER JOIN gerenteTem AS GT on GT.clientePj_idClientePj = GCP.clientePj_idClientePj 
				WHERE GCP.clientePj_idClientePj = ".$valor['idClientePj']." AND (AGP.dataFim between '".$dataInicio."' AND '".$dataReferenciaFinal."') GROUP BY APG.idAulaPermanenteGrupo";
				
				 $result3 = $this-> query($sql3);
				 			 
				  while ($valor3 = mysqli_fetch_array($result3)) {
					  $motivo = $valor3['motivo'];
					  
					  if ($motivo == 1) {
					$motivo = "Alteração de dia / horário ";
				} elseif ($motivo == 2) {
          			$motivo = "Insatisfação Aluno ou RH ";
				} elseif ($motivo == 3) {
          			$motivo = "Professor deixou o grupo ";
				} elseif ($motivo == 4) {
          			$motivo = "Decisão CI (Coordenação) "; 
				} elseif ($motivo == 5) {
          			$motivo = "Previsto em contrato ";
				}  elseif ($motivo == 13) {
					$motivo = "Grupo fechou";
				} 
				elseif ($motivo == 0) {
					$motivo = "";
				}
				
				if($valor3['subMotivo'] == 6) {
				   $subMotivo = "Emprego CLT/ Passou em concurso";	
				} else if($valor3['subMotivo'] == 7) {
				   $subMotivo = "Indisponibilidade de agenda";	
				} else if($valor3['subMotivo'] == 8) {
				   $subMotivo = "Mudou de região/ cidade ";	
				} else if($valor3['subMotivo'] == 9) {
				   $subMotivo = "Problemas de saúde";	
				} else if($valor3['subMotivo'] == 10) {
				   $subMotivo = "Não adaptação ao método";	
				} else if($valor3['subMotivo'] == 11) {
				   $subMotivo = "Pedagógico";	
				} else if($valor3['subMotivo'] == 12) {
				   $subMotivo = "Comportamental";	
				} else if ($valor3['subMotivo'] == 0) {
					$subMotivo = "";	
				}
					  
					 $profAntigo = "<div>".$valor3['Pnome']."</div>";
					 
				 }
				 	
				$Valorprof = $AulaGrupoProfessor->selectAulaGrupoProfessor_periodo($idPlanoAcaoGrupo, $dataInicio);
				$profNovo = $Professor->getNome($Valorprof[0]);
				$nomeIdioma = $valor['idioma'];
		
					 if ($campos) {
					$html .= "<tr >";
					foreach ($campos as $campo) {
					if ($campo == 'empresa') {
						$html .= "<td>" . $empresa . "</td>";
					} elseif ($campo == 'grupo') {
						$html .= "<td>".$nomeGrupo."</td>";
					} elseif ($campo == 'idioma') {
						$html .= "<td>" . $nomeIdioma . "</td>";
					} elseif ($campo == 'dataPartir') {
                    	$html .= "<td align=\"center\">" . Uteis::exibirData($valor['dataApartir']) . "</td>";
					} elseif ($campo == 'dias') {
						$html .= "<td>" . $dias . "</td>";
					} elseif ($campo == 'profAntigo') {
						$html .= "<td>" . $profAntigo . "</td>";
					} elseif ($campo == 'profNovo') {
						$html .= "<td>" . $profNovo . "</td>";
					} elseif ($campo == 'coordenador') {
						$html .= "<td>" . $nomeGerente . "</td>";
					} elseif ($campo == 'motivo') {
						$html .= "<td>". $motivo;
						if ($subMotivo != '') {
							$html .= "<br>SubMotivo:".$subMotivo;
						}
						$html .= "</td>";										
					} elseif ($campo == 'valorHora') {
						$html .= "<td>" . $valorHoraAluno . "</td>";
					} elseif ($campo == 'status') {
						$html .= "<td>". $status."</td>";					
						}
					}
					$html .= "</tr>";

				}
			}
		}
		$html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head);
		return $html_base.$html;
	}

	function selectBuscaAvulsaProfessorTr($caminhoAtualizar_base, $where = "", $apenasLinha = false, $idProfessor) {
		
		$Grupo = new Grupo();
		$Endereco = new Endereco();
		$Professor = new Professor();
		$DiasBuscaAvulsa = new DiasBuscaAvulsa();
		$valorProfessor = $Professor->selectProfessor(" WHERE idProfessor = ".$idProfessor);
		
		$professorVetado = $valorProfessor[0]['vetado'];
				
		if ($professorVetado != 1) {

		$sql = " SELECT DISTINCT(B.idBuscaAvulsa) AS idBuscaAvulsa, B.dataApartir, B.urgente, COALESCE(PJ.razaoSocial, 'Particular') AS razaoSocial, B.grupo_idGrupo, I.idioma, B.obs, B.endereco_idEndereco
		FROM buscaAvulsa AS B 		
		INNER JOIN idioma AS I ON I.idIdioma = B.idioma_idIdioma
		LEFT JOIN clientePj AS PJ ON PJ.idClientePj = B.clientePj_idClientePj
		WHERE B.excluida = 0 AND B.portalP = 1" . $where;
		$resultBusca = $this -> query($sql);
        //echo $sql;
		if (mysqli_num_rows($resultBusca) > 0) {

			$html = "";
			$cont = 0;

			$DiasBuscaAvulsa = new DiasBuscaAvulsa();

			while ($valor = mysqli_fetch_array($resultBusca)) {

				$idBuscaAvulsa = $valor['idBuscaAvulsa'];
				$urgente = $valor['urgente'];
				$nomeEndereco = $Endereco->getEnderecoCompleto2semZona($valor['endereco_idEndereco']);

                $nome = ($valor['obs']<>"")? '<br><em>'.$valor['obs'].'</em>' : '';
				
				//EMPRESA
				$empresa = "<span>" . $valor['razaoSocial'] . $nomeGrupo. ($urgente ? " <strong><font color=\"#FF0000\">URGENTE</font></strong>" : "")  .$nome. "</span>";
             
				//DIAS
				$dias = $DiasBuscaAvulsa -> selectDiasBuscaAvulsaTr_dias("", '', "", " AND buscaAvulsa_idBuscaAvulsa = $idBuscaAvulsa", 1);

				$valorDiasBuscaAvulsa = $DiasBuscaAvulsa->selectDiasBuscaAvulsa(" WHERE buscaAvulsa_idBuscaAvulsa = ".$idBuscaAvulsa);

 				foreach ($valorDiasBuscaAvulsa AS $valor) {
        			$valorX[] = $valor['idDiasBuscaAvulsa'];
    			}

				$valorx2 = implode(', ', $valorX);
 
				$sql2 .= "SELECT SQL_CACHE
    				DB.idDiasBuscaAvulsaProfessor, DB.diasBuscaAvulsa_idDiasBuscaAvulsa, P.nome
						FROM
    				diasBuscaAvulsaProfessor AS DB
						INNER JOIN professor AS P on P.idProfessor = DB.professor_idProfessor
					WHERE
    					diasBuscaAvulsa_idDiasBuscaAvulsa in (".$valorx2.")
        			AND DB.professor_idProfessor = ".$idProfessor."
        			AND DB.escolhido = 2";

				$result2 =  $this -> query($sql2);
	
		if (mysqli_num_rows($result2) > 0) {
		
		$enviarGrupo = "Professor inscrito no processo seletivo";
		
		} else {
		
		$sql3 = "SELECT SQL_CACHE DB.idDiasBuscaAvulsa, DB.buscaAvulsa_idBuscaAvulsa, P.nome FROM diasBuscaAvulsa AS DB LEFT JOIN diasBuscaAvulsaProfessor AS DBP ON DBP.diasBuscaAvulsa_idDiasBuscaAvulsa = DB.idDiasBuscaAvulsa AND escolhido = 1 LEFT JOIN professor AS P ON P.idProfessor = DBP.professor_idProfessor WHERE excluida = 0 AND buscaAvulsa_idBuscaAvulsa = ".  $idBuscaAvulsa;	
		$result3 = Uteis::executarQuery($sql3);
	
			foreach ($result3 as $valor3) {
				
				$idDiasBuscaAvulsa = $valor3['idDiasBuscaAvulsa'];

				$enviarGrupo = "<center> <img src=\"" . CAMINHO_IMG . "confirma.png\" title=\"Tenho Interesse\" onclick=\"postForm('', 'modulos/busca/acao/aceitou.php?idDiasBuscaAvulsa=$idDiasBuscaAvulsa&idProfessor=$idProfessor');zerarCentro();carregarModulo('/cursos/mobile/professor/modulos/busca/index.php', '#centro');\"/></center>";	
			} 
				
		}
				
  			$nomeIdioma = $valor['idioma'];

				if ($apenasLinha !== false) {

					$col = array();
	
					$col[] = $empresa;
					$col[] = $nomeIdioma;
                    $col[] = Uteis::exibirData($valor['dataApartir']);
					$col[] = $dias;
					$col[] = $nomeEndereco;
	   				$col[] = $enviarGrupo;				
	
					$html = $col;
					break;

				} else {

					$html .= "<tr >";
					$html .= "<td>" . $empresa . "</td>";
					$html .= "<td>" . $nomeIdioma . "</td>";					
                    $html .= "<td align=\"center\">" . Uteis::exibirData($valor['dataApartir']) . "</td>";
					$html .= "<td>" . $dias . "</td>";
                    $html .= "<td>" . $nomeEndereco . "</td>";
					$html .= "<td>". $enviarGrupo."</td>";
					$html .= "</tr>";
					}
				}
			}
		}
		return $html;
	}

	/**
	 * selectBuscaAvulsaSelect() Function
	 */
	function selectBuscaAvulsaSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idBuscaAvulsa, idioma_idIdioma, clientePj_idClientePj, endereco_idEndereco, obs, dataApartir, excluida, urgente, finalizada FROM buscaAvulsa " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idBuscaAvulsa\" name=\"idBuscaAvulsa\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idBuscaAvulsa'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idBuscaAvulsa'] . "\">" . ($valor['idBuscaAvulsa']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>
