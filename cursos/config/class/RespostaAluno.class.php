<?php
class RespostaAluno extends Database {
	// class attributes
	var $idRespostaAluno;
	var $integranteGrupoIdIntegranteGrupo;
	var $calendarioProvaIdCalendarioProva;
	var $questaoIdQuestao;
	var $resposta;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idRepostaAluno = "NULL";
		$this -> integranteGrupoIdIntegranteGrupo = "NULL";
		$this -> calendarioProvaIdCalendarioProva = "NULL";
		$this -> questaoIdQuestao = "NULL";
		$this -> resposta = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdRespostaAluno($value) {
		$this -> idRespostaAluno = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIntegranteGrupoIdIntegranteGrupo($value) {
		$this -> integranteGrupoIdIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCalendarioProvaIdCalendarioProva($value) {
		$this -> calendarioProvaIdCalendarioProva = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setQuestaoIdQuestao($value) {
		$this -> questaoIdQuestao = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setResposta($value) {
		$this -> resposta = ($value) ? $this -> gravarBD($value) : "0";
	}
	

	/**
	 * addProva() Function
	 */
	function addRespostaAluno() {
		$sql = "INSERT INTO respostaAluno (integranteGrupo_idIntegranteGrupo, calendarioProva_idCalendarioProva, questao_idQuestao, resposta) VALUES ($this->integranteGrupoIdIntegranteGrupo, $this->calendarioProvaIdCalendarioProva, $this->questaoIdQuestao, $this->resposta)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteProva() Function
	 */
	function deleteRespostaAluno() {
		$sql = "DELETE FROM respostaAluno WHERE idRespostaAluno = $this->idRespostaAluno";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldProva() Function
	 */
	function updateFieldRespostaAluno($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE respostaAluno SET " . $field . " = " . $value . " WHERE idRespostaAluno = $this->idRespostaAluno";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateProva() Function
	 */
	function updateRespostaAluno() {
		$sql = "UPDATE respostaAluno SET integranteGrupo_idIntegranteGrupo = $this->integranteGrupoIdIntegranteGrupo, calendarioProva_idCalendarioProva = $this->calendarioProvaIdCalendarioProva, questao_idQuestao = $this->questaoIdQuestao, resposta = $this->resposta WHERE idRespostaAluno = $this->idRespostaAluno";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectProva() Function
	 */
	function selectRespostaAluno($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idRespostaAluno, integranteGrupo_idIntegranteGrupo, calendarioProva_idCalendarioProva, questao_idQuestao, resposta FROM respostaAluno " . $where;
		return $this -> executeQuery($sql);
	}
/*
	function selectProvaDisponivel($idPlanoAcaoGrupo, $idProva) {

		$PlanoAcaoGrupo = new PlanoAcaoGrupo();

		$sql = " SELECT pa.focoCurso_idFocoCurso, pa.nivelEstudo_IdNivelEstudo 
			FROM planoAcao pa 
			INNER JOIN planoAcaoGrupo ON pa.idPlanoAcao = planoAcao_idPlanoAcao 
			WHERE idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo;
//			echo $sql;
		$rsCadastroPlanoAcaoGrupo = mysqli_fetch_array($this -> query($sql));

		$idNivelEstudo = $rsCadastroPlanoAcaoGrupo['nivelEstudo_IdNivelEstudo'];
		$idFocoCurso = $rsCadastroPlanoAcaoGrupo['focoCurso_idFocoCurso'];
		$idIdioma = $PlanoAcaoGrupo -> getIdIdioma($idPlanoAcaoGrupo);

		$sql = "SELECT SQL_CACHE DISTINCT(P.idProva), P.nome, P.idProva 
			FROM provaINF AS PI
			INNER JOIN relacionamentoINF AS R ON R.idRelacionamentoINF = PI.relacionamentoINF_idRelacionamentoINF 
			INNER JOIN provaOn AS P ON P.idProva = PI.prova_idProva 
			WHERE R.nivelEstudo_IdNivelEstudo = $idNivelEstudo AND R.focoCurso_idFocoCurso = $idFocoCurso AND R.idioma_idIdioma = $idIdioma 
			AND P.idProva NOT IN (
				SELECT prova_idProva FROM calendarioProva WHERE planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo
			) ";
//			echo "<br>".$sql;
		$result = $this -> query($sql);

		$html = "<select id=\"idProva\" name=\"idProva\" class=\"required\" onChange=\"atualizaIntens(this.value);\" >
			<option value=\"\">Selecione</option>";

		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idProva == $valor['idProva'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idProva'] . "\">" . ($valor['nome']) . "</option>";
		}
		$html .= "</select>";
		return $html;

	}

	function selectProvaNotasTr($idCalendarioProva, $idPlanoAcaoGrupo, $idProva, $idItenProva) {

		$Professor = new Professor();
		$AulaGrupoProfessor = new AulaGrupoProfessor();

		$AulaDataFixa = new AulaDataFixa();
		$AulaPermanenteGrupo = new AulaPermanenteGrupo();

		$sqlIntegrantes = "SELECT SQL_CACHE nome, clientePf_idClientePf, idIntegranteGrupo 
		FROM integranteGrupo 
		INNER JOIN clientePf ON idClientePf = clientePf_idClientePf 
		WHERE planoAcaoGrupo_idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo;
		$rsIntegrantes = $this -> query($sqlIntegrantes);

		while ($valorIntegrantes = mysqli_fetch_array($rsIntegrantes)) {

			$sqlNota = "SELECT SQL_CACHE nota, anexo, professor_idProfessor, idItemCalendarioProva FROM itemCalendarioProva 
			WHERE calendarioProva_idCalendarioProva=" . $idCalendarioProva . " AND integranteGrupo_idIntegranteGrupo=" . $valorIntegrantes['idIntegranteGrupo'] . " 
			AND itenProva_idItenProva=" . $idItenProva;

			$rsNota = mysqli_fetch_array($this -> query($sqlNota));
			if ($rsNota['anexo'] != "" && !(is_null($rsNota['anexo']))) {
				$anexoVer = "<a href=\"" . CAMINHO_UP . "/anexonota/" . $rsNota['anexo'] . "\" target=\"_blank\">Visualizar</a>";
			}

			$aulaFixaIds = $AulaDataFixa -> selectAulaDataFixa(" AND planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo);
			$aulaPermanenteIds = $AulaPermanenteGrupo -> selectAulaPermanenteGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo);

			$aulaFixaIds = implode(",", Uteis::arrayCampoEspecifico($aulaFixaIds, 'idAulaDataFixa'));
			$aulaFixaIds = $aulaFixaIds ? $aulaFixaIds : "0";

			$aulaPermanenteIds = implode(",", Uteis::arrayCampoEspecifico($aulaPermanenteIds, 'idAulaPermanenteGrupo'));
			$aulaPermanenteIds = $aulaPermanenteIds ? $aulaPermanenteIds : "0";

			$rsProf = $AulaGrupoProfessor -> selectAulaGrupoProfessor(" WHERE aulaDataFixa_idAulaDataFixa IN (" . $aulaFixaIds . ") 
			OR aulaPermanenteGrupo_idAulaPermanenteGrupo IN (" . $aulaPermanenteIds . ")");

			$idProfs = implode(",", Uteis::arrayCampoEspecifico($rsProf, 'professor_idProfessor'));

			$rsProf = $Professor -> selectProfessorSelect("required", $rsNota['professor_idProfessor'], " AND idProfessor IN (" . $idProfs . ")");

			$html = "<td>" . $valorIntegrantes['nome'] . "</td>
			
			<td>
			
			<script>
			
			function aguardarCarregamento" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "(){		
				if( $('#visualizar_contrato" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "[status=esperando]').length > 0 ){
					alert('Aguarde o final do carregamento do contrato');
				}else{
					postForm('form_nota" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "', '" . CAMINHO_REL . "grupo/include/acao/nota.php');
				}
			}
					
			function enviaArquivo" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "(){
				$('#visualizar_contrato" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "').attr({'status':'esperando'}).html('Carregando arquivo...').css('display','block');
				$('#anexar" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "').css('display', 'none');
				$('#formulario_upload_nota_" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "').ajaxForm({
					target:'#visualizar_contrato" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "',
					success: function() {
						if($('#visualizar_contrato" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "').html==\"Erro\"){
							alert('Erro ao subir o arquivo');
							$('#visualizar_contrato" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "').html().css('display','none');
							$('#anexar" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "').css('display', 'block');
						}else{
							$('#anexo" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "').val($('#visualizar_contrato" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "').html());
							$('#visualizar_contrato" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "').removeAttr('status').html('Carregado');
							
						}
					}
				}).submit();
			}
			</script>
						
			<form id=\"formulario_upload_nota_" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "\" method=\"post\" enctype=\"multipart/form-data\" 
			action=\"" . CAMINHO_REL . "grupo/include/acao/nota.php\" style=\"display:none;\">
			
				<input type=\"file\" id=\"add_file_contrato" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "\" 
				onchange=\"enviaArquivo" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "();\" name=\"file\" /> 
				
				<input type=\"hidden\" id=\"acao\" name=\"acao\" value=\"file\" />
			
			</form>
			
			<form id=\"form_nota" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "\" class=\"validate\"  method=\"post\" onsubmit=\"return false\" >
				
				<div class=\"esquerda\">
				
					<input name=\"idIntegranteGrupo\" type=\"hidden\" value=\"" . $valorIntegrantes['idIntegranteGrupo'] . "\" />
					
					<input name=\"idCalendarioProva\" type=\"hidden\" value=\"" . $idCalendarioProva . "\" />
			
					<input id=\"idItemCalendarioProva" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "\" 
					name=\"idItemCalendarioProva\" type=\"hidden\" value=\"" . $rsNota['idItemCalendarioProva'] . "\" />
			
					<input name=\"anexo\" id=\"anexo" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "\" type=\"hidden\" value=\"" . $rsNota['anexo'] . "\" />
					
					<input name=\"idItenProva\" type=\"hidden\" value=\"" . $idItenProva . "\" />
				
					<p><label>Nota:</label>
					<input name=\"nota\" id=\"nota\" class=\"required numeric nota\" type=\"text\" value=\"" . $rsNota['nota'] . "\" ><span class=\"placeholder\">Campo obrigatório</span>
					</p> 
					
					<p><label>Professor:</label>" . $rsProf . "<span class=\"placeholder\"></span></p>
				
				</div>
				
				<div class=\"direita\">
				
					<p><label>Anexo:</label> " . $anexoVer . " </p>
					
					<div id=\"visualizar_contrato" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "\" style=\"display:none\" ></div> 
					
					<img id=\"anexar" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "\" src=\"" . CAMINHO_IMG . "upload_file.png\" 
					onclick=\"$('#add_file_contrato" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "').click();\" title=\"ANEXAR NOVO\"/>
					
					<p><button class=\"button blue\" 
					onclick=\"aguardarCarregamento" . $idItenProva . "_" . $valorIntegrantes['idIntegranteGrupo'] . "()\">Gravar</button></p>
				</div>
				
			</form>
			
			</td>";
		}
		return $html;
	}

	function selectProvaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "", $idPlanoAcaoGrupo, $professor) {

		$sql = "SELECT SQL_CACHE CP.dataPrevistaInicial, CP.dataPrevistaNova, CP.idCalendarioProva, P.nome, CP.validacao 
		FROM calendarioProva AS CP 
		INNER JOIN prova AS P ON P.idProva = CP.prova_idProva " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/provas.php?id=" . $valor['idCalendarioProva'] . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>
				
				<td $onclick>" . $valor['nome'] . "</td>
				
				<td $onclick >" . Uteis::exibirData($valor['dataPrevistaInicial']) . "</td>
				
				<td $onclick >" . Uteis::exibirData($valor['dataPrevistaNova']) . "</td>
				
				<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/resourceHTML/notas.php?id=" . $valor['idCalendarioProva'] . "', '$caminhoAtualizar', '$ondeAtualiza')\" >
					<center><img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Notas\"></center>
				</td>
				
				<td $onclick >" . Uteis::exibirData($valor['validacao']) . "</td>";
				
				if ($professor == 1) {
					$html .= "<td></td>";
				} else {
					$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_REL . "grupo/include/acao/provas.php', '" . $valor['idCalendarioProva'] . "', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"Excluir\"></center>
				</td>";
				}
				
				$html .= "</tr>";

			}
		}
		return $html;
	}

	/**
	 * selectProvaTr() Function
	 */
	function selectRespostaAlunoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		
		$Idioma = new Idioma();
		$Questao = new Questao();
		$sql = "SELECT SQL_CACHE idRespostaAluno, integranteGrupo_idIntegranteGrupo, calendarioProva_idCalendarioProva, questao_idQuestao, respostao FROM respostaAluno " . $where;
	//	echo $sql;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			$ordem = 0;
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idProva = $valor['id'];
				$nome = $valor['nome'];
			//	$ordem = $valor['ordem'];
				
				$titulo = $Questao->getTitulo($valor['questao_idQuestao']);
				$enunciado = $Questao->getEnunciado($valor['questao_idQuestao']);
				
				$obs = $valor['obs'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				
				$nomeIdioma = $Idioma->getNome($valor['idioma_IdIdioma']);
			
				$html .= "<td>" . $ordem . "</td>";
		//		$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idProvaOn'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $enunciado . "</td>";
				$html .= "<td>" . $titulo . "</td>";
				$html .= "<td>".$enunciado."</td>";
		    
		//		$html .= "<td>".$obs."</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "gravaQuestoes.php', " . $valor['id'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
				$ordem++;
			}
		}
		return $html;
	}
/*
	function selectProvaTr_grupo($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $podeExcluir = false, $idPlanoAcaoGrupo,$mobile,$idFolhaFrequencia) {
		
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
		
//		echo $where;

		$sql = "SELECT SQL_CACHE CP.idCalendarioProva, CP.dataPrevistaInicial, CP.dataPrevistaNova, CP.dataAplicacao, CP.validacao, P.nome 
		FROM calendarioProva AS CP 
		INNER JOIN prova AS P ON P.idProva = CP.prova_idProva "; 
		
		if ($idPlanoAcaoGrupo == '') {
		 $sql = $sql .$where;
		 $sql .= " ORDER BY CP.idCalendarioProva DESC";
		} else {
			
	     		$idGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo, true);
	
				$valorIdPlanoAcaoGrupo = $PlanoAcaoGrupo->getPAG_total($idGrupo);
				
				for ($x=0;$x<count($valorIdPlanoAcaoGrupo);$x++) {
					$idPlanoAcaoGrupo2Tmp[] = $valorIdPlanoAcaoGrupo[$x]['idPlanoAcaoGrupo'];
					$idPlanoAcaoGrupo2 = implode(",",$idPlanoAcaoGrupo2Tmp);
				}	
		$sql = "SELECT SQL_CACHE CP.idCalendarioProva, CP.dataPrevistaInicial, CP.dataPrevistaNova, CP.dataAplicacao, CP.validacao, P.nome, NE.nivel
		FROM calendarioProva AS CP 
		INNER JOIN prova AS P ON P.idProva = CP.prova_idProva 
		INNER JOIN planoAcaoGrupo AS PAG on PAG.idPlanoAcaoGrupo = CP.planoAcaoGrupo_idPLanoAcaoGrupo
		INNER JOIN planoAcao AS PA on PAG.planoAcao_idPlanoAcao = PA.idPlanoAcao
		INNER JOIN nivelEstudo AS NE on NE.idNivelEstudo = PA.nivelEstudo_idNivelEstudo"; 
				
		$sql .= " WHERE CP.planoAcaoGrupo_idPLanoAcaoGrupo in (".$idPlanoAcaoGrupo2.") ORDER BY CP.idCalendarioProva DESC";
	}
//	echo $sql;

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				if ($mobile != 1) {
				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/provas.php?id=" . $valor['idCalendarioProva'] . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				$onclick2 = "onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "resourceHTML/notas.php?id=" . $valor['idCalendarioProva'] . "', '$caminhoAtualizar', '$ondeAtualiza')\"";
				} else {
				$onclick = " onclick=\"carregarModulo('" . $caminhoAbrir . "form/provas.php?id=" . $valor['idCalendarioProva'] . "&idFolhaFrequencia=".$idFolhaFrequencia."', '$ondeAtualiza')\" ";	
				$onclick2 = "onclick=\"carregarModulo('" . $caminhoAbrir . "resourceHTML/notas.php?id=" . $valor['idCalendarioProva'] . "&idFolhaFrequencia=".$idFolhaFrequencia."','$ondeAtualiza')\"";
					
				}

				$html .= "<tr>
				
				<td id=\"provaGrupo\" $onclick>" . $valor['nome'] . "</td>
				
				<td $onclick>" . $valor['nivel'] . "</td>
				
				<td $onclick >" . Uteis::exibirData($valor['dataPrevistaInicial']) . ($valor['dataPrevistaNova'] ? " - nova data <strong>" . Uteis::exibirData($valor['dataPrevistaNova']) . "</strong>" : "") . "
				</td>
				
				<td $onclick >" . Uteis::exibirData($valor['dataAplicacao']) . "</td>
				
				<td $onclick >" . Uteis::exibirData($valor['validacao']) . "</td>
				
				<td  $onclick2>
					<center><img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Notas\"></center>
				</td>";

				if ($podeExcluir == true) {
					$html .= "
					<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/provas.php', '" . $valor['idCalendarioProva'] . "', '$caminhoAtualizar', '$ondeAtualiza')\">
						<center><img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"Excluir\"></center>
					</td>";
				}

				$html .= "</tr>";

			}
		}
		return $html;
	}

	function selectProvaSelectMult($classes = "", $idAtual = 0, $where = "") {

		$sql = "SELECT SQL_CACHE idProva, nome, ordem, obs, inativo FROM prova " . $where;
		$result = $this -> query($sql);

		$html = "<select id=\"idProva\" name=\"idProva[]\" multiple=\"multiple\" class=\"" . $classes . "\" >		
		<option value=\"\">Todos</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idProva'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idProva'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectProvaSelect($classes = "", $idAtual = 0, $where = "") {

		$sql = "SELECT SQL_CACHE idProva, nome, ordem, obs, inativo FROM prova " . $where;
		$result = $this -> query($sql);

		$html = "<select id=\"idProva\" name=\"idProva\" class=\"" . $classes . "\" >		
<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idProva'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idProva'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}*/

}
?>

