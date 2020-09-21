<?php
class Grupo extends Database {

	// class attributes
	var $idGrupo;
	var $nome;
	var $inativo;
	var $dataCadastro;
	var $naoBancoHoras;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idGrupo = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "0";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> naoBancoHoras = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdGrupo($value) {
		$this -> idGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setNaoBancoHoras($value) {
		$this -> naoBancoHoras = ($value) ? $this -> gravarBD($value) : "0";
	}
	/**
	 * addGrupo() Function
	 */
	function addGrupo() {
		$sql = "INSERT INTO grupo (idGrupo, nome, inativo, dataCadastro, naoBancoHoras) VALUES ($this->idGrupo, $this->nome, $this->inativo, $this->dataCadastro, $this->naoBancoHoras)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteGrupo() Function
	 */
	function deleteGrupo() {
		$sql = "DELETE FROM grupo WHERE idGrupo = $this->idGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldGrupo() Function
	 */
	function updateFieldGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE grupo SET " . $field . " = " . $value . " WHERE idGrupo = $this->idGrupo";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateGrupo() Function
	 */
	function updateGrupo() {
		$sql = "UPDATE grupo SET nome = $this->nome, inativo = $this->inativo,  WHERE idGrupo = $this->idGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectGrupo() Function
	 */
	function selectGrupo($where = "WHERE 1", $and) {
		if ($and != '') {
		$G = " G.";	
		} else {
		$G = "";	
		}
		$sql = "SELECT SQL_CACHE idGrupo, nome, ".$G."inativo, ".$G."dataCadastro, naoBancoHoras, dataInativado FROM grupo ".$and . $where;
	//	echo $sql."<hr>";
		return $this -> executeQuery($sql);
	}

	function selectGrupoTr_Rh($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $mobile) {

		$html = "";

		$sql = "SELECT SQL_CACHE G.idGrupo, PAG.idPlanoAcaoGrupo, G.nome, PAG.planoAcao_idPlanoAcao 
		FROM grupo AS G 
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo AND PAG.inativo = 0 
		INNER JOIN grupoClientePj AS GPJ ON GPJ.grupo_idGrupo = G.idGrupo 
			AND ( dataFim <= CURDATE() OR dataFim IS NULL OR dataFim = '' ) " . $where;
		//echo $sql;

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			while ($valor = mysqli_fetch_array($result)) {

				$idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
				$idGrupo = $valor['idGrupo'];
				$idPlanoAcao = $valor['planoAcao_idPlanoAcao'];
				$nome = $valor['nome'];

				$html .= "<tr>";
				
				if ($mobile != 1) {

				$html .= "<td title=\"Visualizar\" onclick=\"abrirNivelPagina(this, '$caminhoAbrir?id=$idPlanoAcaoGrupo&idPlanoAcao=$idPlanoAcao&idGrupo=$idGrupo', '$caminhoAtualizar', '$ondeAtualiza')\" > $nome </td>";
				} else {
				$html .= "<td title=\"Visualizar\" onclick=\"zerarCentro();carregarModulo( '$caminhoAbrir?id=$idPlanoAcaoGrupo&idPlanoAcao=$idPlanoAcao&idGrupo=$idGrupo', '$ondeAtualiza');\" > $nome </td>";
				
					
					
				}

				$html .= "</tr>";
			}
		}
		return $html;
	}

	function selectGrupoTr($caminhoAbrir, $caminhoAtualizar, $onde, $where = "", $apenasLinha = false,$aluno, $ArrIdioma) {
		
	$FechamentoGrupo = new FechamentoGrupo();
	$GrupoClientePj = new GrupoClientePj();
	$GerenteTem = new GerenteTem();
	$PlanoAcao = new PlanoAcao();
	$ValorHoraGrupo = new ValorHoraGrupo();
	$AulaGrupoProfessor = new AulaGrupoProfessor();
	$Professor = new Professor();
	$IntegranteGrupo = new IntegranteGrupo();
	$ClientePf = new ClientePf();
	$PlanoAcaoGrupoNaoFaturar = new PlanoAcaoGrupoNaoFaturar();
	$PlanoAcaoGrupo = new PlanoAcaoGrupo();
	$Relatorio = new Relatorio();
	$IdiomaProfessor = new IdiomaProfessor();
	$TipoCurso = new TipoCurso();

	
	$sql = "SELECT SQL_CACHE G.idGrupo, PAG.idPlanoAcaoGrupo, PAG.nivelEstudo_IdNivelEstudo, G.nome, G.inativo, PA.idPlanoAcao, N.nivel, PAG.dataPrevisaoTerminoEstagio, PAG.dataInicioEstagio, PA.tipoCurso, PA.tipoContrato, PA.dataContrato
    FROM grupo AS G 
    INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo 
    INNER JOIN planoAcao AS PA ON PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao 
	INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = PA.nivelEstudo_IdNivelEstudo    
    INNER JOIN grupoClientePj AS GC ON GC.grupo_idGrupo = G.idGrupo 
	left JOIN gerenteTem AS GT ON GT.clientePj_idClientePj = GC.clientePj_idClientePj 
	INNER JOIN clientePj AS CL ON CL.idClientePj = GC.clientePj_idClientePj " . $where . " AND GT.dataExclusao is NULL";	
//	echo $sql;

	//Array para conferir se o professor pode continuar no grupo
	//1-A e A+
	//5-A* nativo
	//6-B*
	//10-B+
	//2-B
	//9-C+
	//3-C
	
	$arrayNivel[1] = [	1,2,3,4,13,14,15,16,17,18,19,20,33,34,35,36,37, 39, 40, 41,42,48,49,50,60,61,5,6,21,22,23,24,38,43,44,45,46,62,7,8,25,26,27,28,51,52,53,54,63,9,29,30,31,32,55,56,57,58,64,10,11,12,59];
	$arrayNivel[5] = [	1,2,3,4,13,14,15,16,17,18,19,20,33,34,35,36,37, 39, 40, 41,42,48,49,50,60,61,5,6,21,22,23,24,38,43,44,45,46,62,7,8,25,26,27,28,51,52,53,54,63,9,29,30,31,32,55,56,57,58,64,10,11,12,59];
	$arrayNivel[6] = [1,2,3,4,13,14,15,16,17,18,19,20,33,34,35,36,37, 39, 40, 41,42,48,49,50,60,61,5,6,21,22,23,24,38,43,44,45,46,62,7,8,25,26,27,28,51,52,53,54,63,9,29,30,31,32,55,56,57,58,64];
	$arrayNivel[10] = [1,2,3,4,13,14,15,16,17,18,19,20,33,34,35,36,37, 39, 40, 41,42,48,49,50,60,61,5,6,21,22,23,24,38,43,44,45,46,62,7,8,25,26,27,28,51,52,53,54,63,9,29,30,31,32,55,56,57,58,64];
	$arrayNivel[2] = [1,2,3,4,13,14,15,16,17,18,19,20,33,34,35,36,37, 39, 40, 41,42,48,49,50,60,61,5,6,21,22,23,24,38,43,44,45,46,62,7,8,25,26,27,28,51,52,53,54,63];	
	$arrayNivel[9] = [1,2,3,4,13,14,15,16,17,18,19,20,33,34,35,36,37, 39, 40, 41,42,48,49,50,60,61,5,6,21,22,23,24,38,43,44,45,46,62];
	$arrayNivel[3] = [1,2,3,4,13,14,15,16,17,18,19,20,33,34,35,36,37, 39, 40, 41,42,48,49,50,60,61];
	
//	Uteis::pr($arrayNivel);

	$result = $this -> query($sql);		

		if (mysqli_num_rows($result) > 0) {

			$html = "";
			$cont = 0;
			$carga = "";
		
				
	
			while ($valor = mysqli_fetch_array($result)) {
				
				$dataInicio = Uteis::exibirData($valor['dataInicioEstagio']);
				$tipoCursoD = $valor['tipoCurso'];
				if ($tipoCursoD == '') {
					$tipoCurso = "Presencial";
				} else {
				$Ncurso = $TipoCurso->selectTipoCurso(" WHERE idTipoCurso in (".$tipoCursoD.")");
				$tipoCurso = "";
				foreach ($Ncurso as $v) {
					$tipoCurso .= $v['nome']."<br>";
					}
				}
					
				if ($valor['tipoContrato'] == 0 || $valor['tipoContrato'] == '') {
					$tipoContrato = "Prazo indeterminado ";
				} elseif ($valor['tipoContrato'] == 1) {
					$tipoContrato = "Pacote de horas ";
				} elseif ($valor['tipoContrato'] == 2) {
					$tipoContrato = "Prazo Determinado. <br>Data vigência: ".Uteis::exibirData($valor['dataContrato']);	
				} 
					
				
				$idPlanoAcao = $valor['idPlanoAcao'];
				$idGrupo = $valor['idGrupo'];
				$idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
				
				$idioma = $PlanoAcao -> getIdIdioma($idPlanoAcao, true);
				
				$Ididioma = $PlanoAcao -> getIdIdioma($idPlanoAcao, false);
				
				$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);
				
				unset($valorX);
				foreach($ids AS $valor2) {
				$valorX[] = $valor2['idPlanoAcaoGrupo'];		
				}

				$valorx2 = implode(', ',$valorX);
				
				$valorDataF = $FechamentoGrupo->selectFechamentoGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo in ( ".$valorx2. ")  Order By dataFechamento DESC");
				
				if ($valorDataF[0]['tipo'] != 2) {
					$valorTexto = $FechamentoGrupo->retornaTipo($valorDataF[0]['tipo']);
					$dataF = "<strong><font color='red' style=\"font-size:15px;\">".Uteis::exibirData($valorDataF[0]['dataFechamento'])."</font></strong>";
				} else {
					$valorTexto = "";	
					$dataF = "";	
				}
				
				if ((in_array($Ididioma, $ArrIdioma)) || (empty($ArrIdioma))) {
				
				$dataAtual = date("Y-m-d");
				
				$valorHG = $ValorHoraGrupo->selectValorHoraGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND (( dataFim is null) OR (dataFim >= '".$dataAtual."')) AND cargaHorariaFixaMensal is not null");

				if ($valorHG[0]['cargaHorariaFixaMensal'] > 1 ) {
				
				$carga = Uteis::exibirHoras($valorHG[0]['cargaHorariaFixaMensal']);
				
				}
				//Alunos 

				$dataFim = date("Y-m-t");
				$rs = $IntegranteGrupo->getidIntegranteGrupo("",$idPlanoAcaoGrupo, $dataFim);
				
				
				if($rs) {
				
				$alunos = "";
				$rs2 = explode(",", $rs);
				$totalAlunos = 0;
				foreach ($rs2 as $valor2) {
				$nomePf = $IntegranteGrupo->getNomePf($valor2);
				$alunos .= "<div>".$nomePf."</div>";	
					
				$totalAlunos++;	
					}
				}
				
				//Professor aluno
				$rs = $IntegranteGrupo->getidIntegranteGrupoProf("",$idPlanoAcaoGrupo, $dataFim);
		//		Uteis::pr($rs);
				if($rs) {
				//$alunos = "";
				$rs2 = explode(",", $rs);
				$totalAlunos = 0;
				foreach ($rs2 as $valor2) {
				$nomePf = $IntegranteGrupo->getNomePro($valor2);
				$alunos .= "<div>".$nomePf."</div>";	
					
				$totalAlunos++;	
					}
				}
				
				//Professor
				$dataAtual = date("Y-m-01");
				$valorProfessor = $AulaGrupoProfessor->selectAulaGrupoProfessor_periodo($idPlanoAcaoGrupo,$dataAtual);
				
				$idNivel = $valor['nivelEstudo_IdNivelEstudo'];
				
				$nomeProfessor = "";
				foreach ($valorProfessor as $VP) {		
				$valorP = $IdiomaProfessor->getNivelAtual($VP);	
				
				$nivelPro = $valorP[0]['nivelLinguistico_idNivelLinguistico'];	
				$idPro = $IdiomaProfessor->getNivelAtual($VP, false);	
		//			echo $idPro;
		//			Uteis::pr($arrayNivel[$idPro]);
				if(in_array($idNivel,($arrayNivel[$idPro]))) {
					$style="style=\"\"";
				} else {
					$style="style=\"color:red;\" title=\"Professor com nível não recomendado para o grupo\"";
				}
												
				$nomeProfessor .= "<span $style>".$Professor->getNome($VP)." (".$nivelPro.")</span><br>";
				}
				
				$nome = $valor['nome'];
				$nivel = $valor['nivel'];
				
				$ativo = Uteis::exibirStatus(!$valor['inativo'])."<br><strong><font color='red' style=\"font-size:15px;\">".$valorTexto."</font></strong>";
				$dataT = Uteis::exibirData($valor['dataPrevisaoTerminoEstagio']);

				$empresa = $GrupoClientePj -> getNomePJ($idGrupo);
				

				$onclick = " title=\"Ver grupo\" onclick=\"abrirNivelPagina(this, '$caminhoAbrir?id=$idPlanoAcaoGrupo', '$caminhoAtualizar?tr=1&idPlanoAcaoGrupo=$idPlanoAcaoGrupo&ordem=" . ($cont++) . "', '$onde');\" ";

				$cor = $GerenteTem -> selectGerenteTem_cor($idPlanoAcaoGrupo);
				$grupo = "<font color=\"" . $cor . "\" ><strong>" . $nome . "</strong></font>";

				if ($apenasLinha) {

					$col = array();

					$col[] = $grupo." (Alunos:".$totalAlunos.")";
					$col[] = $empresa;
					$col[] = $alunos;
					$col[] = $nivel;
					$col[] = $idioma;
					$col[] = $tipoContrato;
					$col[] = $tipoCurso;
					$col[] = $nomeProfessor;
					$col[] = $carga;
					$col[] = $dataInicio;
					$col[] = $dataF;
					$col[] = $dataT;
					$col[] = $ativo;

					$html = $col;
					break;

				} else {

					$html .= "<tr>";

					$html .= "<td $onclick >".$grupo." (Alunos:".$totalAlunos.")</td>";

					$html .= "<td $onclick>$empresa</td>";
					
					$html .= "<td $onclick>$alunos</td>";

					$html .= "<td $onclick >$nivel</td>";

					$html .= "<td $onclick >$idioma</td>";
					
					$html .= "<td $onclick >$tipoContrato</td>";
					
					$html .= "<td $onclick >$tipoCurso</td>";
					
					$html .= "<td $onclick >$nomeProfessor</td>";
					
					$html .= "<td $onclick >$carga</td>";
					
					$html .= "<td $onclick >$dataInicio</td>";
										
					$html .= "<td $onclick >$dataF</td>";
					
					$html .= "<td $onclick >$dataT</td>";

					$html .= "<td $onclick >$ativo</td>";

					$html .= "</tr>";

				}
				$carga = "";
			}
			}
		}
		
		return  $html;
	}
	function selectGrupoTr_editar($caminhoAbrir, $caminhoAtualizar, $onde, $where = "", $apenasLinha = false) {

		$sql = "SELECT SQL_CACHE G.idGrupo, PAG.idPlanoAcaoGrupo, G.nome, G.inativo, PA.idPlanoAcao, N.nivel  
    FROM grupo AS G 
    INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo 
    INNER JOIN planoAcao AS PA ON PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao 
    INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = PA.nivelEstudo_IdNivelEstudo    
    INNER JOIN grupoClientePj AS GC ON GC.grupo_idGrupo = G.idGrupo 
	left JOIN gerenteTem AS GT ON GT.clientePj_idClientePj = GC.clientePj_idClientePj 
	INNER JOIN clientePj AS CL ON CL.idClientePj = GC.clientePj_idClientePj " . $where . " AND GT.dataExclusao is NULL";	
		
		$result = $this -> query($sql);
//		echo $sql;
		if (mysqli_num_rows($result) > 0) {

			$html = "";
            $cont = 0;

			$GrupoClientePj = new GrupoClientePj();
			$GerenteTem = new GerenteTem();
			$PlanoAcao = new PlanoAcao();

			while ($valor = mysqli_fetch_array($result)) {

				$idGrupo = $valor['idGrupo'];
				$idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
				$idPlanoAcao = $valor['idPlanoAcao'];
				$nome = $valor['nome'];
				$nivel = $valor['nivel'];
				$empresa = $GrupoClientePj -> getNomePJ($idGrupo);
				$idioma = $PlanoAcao -> getIdIdioma($idPlanoAcao, true);
				$status = Uteis::exibirStatus(!$valor['inativo']);

				$cor = $GerenteTem -> selectGerenteTem_cor($idPlanoAcaoGrupo);
				$grupo = "<font color=\"" . $cor . "\" ><strong>" . $nome . "</strong></font>";
                $onclick = "onclick=\"abrirNivelPagina(this, '" .$caminhoAbrir."?idGrupo=$idGrupo', '$caminhoAtualizar?tr=1&idGrupo=$idGrupo&ordem=" . ($cont++)."', '$onde')\"";   
				
				if ($apenasLinha) {

                    $col = array();

                    $col[] = $grupo;
                    $col[] = $empresa;
                    $col[] = $nivel;
                    $col[] = $idioma;
                    $col[] = $ativo;

                    $html = $col;
                    break;

                } else {               
				
    				$html .="<tr>";
    				$html .= "<td $onclick>$grupo</td>";
    				$html .= "<td $onclick>$empresa</td>";
    				$html .= "<td $onclick>$nivel</td>";
    				$html .= "<td $onclick>$idioma</td>";
    				$html .= "<td $onclick>$status</td>";
    				$html .= "</tr>";
                }

			}
		}
		return $html;
	}

	function selectGrupoSelect($classes = "", $idAtual = 0, $where) {
		$sql = "SELECT SQL_CACHE idGrupo, nome FROM grupo AS G $where ORDER BY nome";
		$result = $this -> query($sql);
//		echo $sql;
		$html = "<select id=\"idGrupo\" name=\"idGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idGrupo'] . "\">" . ($valor['nome']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
    
	function selectGrupoSelectMult($classes = "", $idAtual = 0, $where) {
		$sql = "SELECT SQL_CACHE idGrupo, nome FROM grupo AS G $where ORDER BY nome";
		$result = $this -> query($sql);
		//echo $sql;
		$html = "<select id=\"idGrupo\" name=\"idGrupo[]\"  class=\"" . $classes . "\" multiple=\"multiple\" >
		<option value=\"\">Todos</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idGrupo'] . "\">" . ($valor['nome']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function getIdIdioma($id) {

		$sql = "SELECT SQL_CACHE P.idioma_idIdioma FROM grupo AS G 
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo 
		INNER JOIN planoAcao AS PA ON PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao 
		INNER JOIN proposta AS P ON P.idProposta= PA.proposta_idProposta 
		WHERE G.idGrupo = $id";
		$rs = mysqli_fetch_array($this -> query($sql));

		$idIdioma = $rs['idioma_idIdioma'];
		return ($idIdioma) ? $idIdioma : "0";
	}

	function getNome($id) {
		$rs = $this -> selectGrupo(" WHERE idGrupo = $id");
		return $rs[0]['nome'];
	}

}
