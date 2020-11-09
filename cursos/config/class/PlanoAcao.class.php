 <?php
class PlanoAcao extends Database {

    // class attributes
    var $idPlanoAcao;
    var $propostaIdProposta;
    var $grupoIdGrupo;
    var $focoCursoIdFocoCurso;
    var $expectativaInicioIdExpectativaInicio;
    var $dataExpectativaInicio;
    var $nivelEstudoIdNivelEstudo;
    var $horasPrograma;
    var $abordagemCurso;
    var $finalizado;
    var $kitMaterialIdKitMaterial;
    var $statusAprovacaoIdStatusAprovacao;
    var $dataCadastro;
    var $dataExclusao;
    var $dataAprovacao;
    var $mesReferenciaMudanca;
    var $anoReferenciaMudanca;
	var $paMudanca;
	var $tipoContrato;
	var $tipoCurso;
	var $tipoAval;
	var $tipoMaterial;
	var $dataContrato;

    // constructor
    function __construct() {
        parent::__construct();
        $this -> idPlanoAcao = "NULL";
        $this -> propostaIdProposta = "NULL";
        $this -> grupoIdGrupo = "NULL";
        $this -> focoCursoIdFocoCurso = "NULL";
        $this -> expectativaInicioIdExpectativaInicio = "NULL";
        $this -> dataExpectativaInicio = "NULL";
        $this -> nivelEstudoIdNivelEstudo = "NULL";
        $this -> horasPrograma = "NULL";
        $this -> abordagemCurso = "NULL";
        $this -> finalizado = "NULL";
        $this -> kitMaterialIdKitMaterial = "NULL";
        $this -> statusAprovacaoIdStatusAprovacao = "NULL";
        $this -> dataCadastro = "'" . date('Y-m-d') . "'";
        $this -> dataExclusao = "NULL";
        $this -> dataAprovacao = "NULL";
        $this -> mesReferenciaMudanca = "NULL";
        $this -> anoReferenciaMudanca = "NULL";
		$this -> paMudanca = "NULL";
		$this -> tipoContrato = 0;
		$this -> tipoCurso = "NULL";
		$this -> tipoAval = 0;
		$this -> tipoMaterial = 0;
		$this -> dataContrato = "NULL";

    }

    function __destruct() {
        parent::__destruct();
    }

    // class methods
    function setIdPlanoAcao($value) {
        $this -> idPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setPropostaIdProposta($value) {
        $this -> propostaIdProposta = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setGrupoIdGrupo($value) {
        $this -> grupoIdGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setFocoCursoIdFocoCurso($value) {
        $this -> focoCursoIdFocoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setExpectativaInicioIdExpectativaInicio($value) {
        $this -> expectativaInicioIdExpectativaInicio = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setDataExpectativaInicio($value) {
        $this -> dataExpectativaInicio = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setNivelEstudoIdNivelEstudo($value) {
        $this -> nivelEstudoIdNivelEstudo = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setHorasPrograma($value) {
        $this -> horasPrograma = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setAbordagemCurso($value) {
        $this -> abordagemCurso = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setFinalizado($value) {
        $this -> finalizado = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setKitMaterialIdKitMaterial($value) {
        $this -> kitMaterialIdKitMaterial = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setStatusAprovacaoIdStatusAprovacao($value) {
        $this -> statusAprovacaoIdStatusAprovacao = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setDataCadastro($value) {
        //$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setDataExclusao($value) {
        $this -> dataExclusao = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setDataAprovacao($value) {
        $this -> dataAprovacao = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setMesReferenciaMudanca($value) {
        $this -> mesReferenciaMudanca = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setAnoReferenciaMudanca($value) {
        $this -> anoReferenciaMudanca = ($value) ? $this -> gravarBD($value) : "NULL";
    }
	
	function setPaMudanca($value) {
        $this -> paMudanca = ($value) ? $this -> gravarBD($value) : "NULL";
    }
	
	function setTipoContrato($value) {
        $this -> tipoContrato = ($value) ? $this -> gravarBD($value) : "NULL";
    }
	
	function setTipoCurso($value) {
        $this -> tipoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
    }
	
	function setTipoAval($value) {
        $this -> tipoAval = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setTipoMaterial($value) {
        $this -> tipoMaterial = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setDataContrato($value) {
      //  $this -> dataContrato = ($value) ? $this -> gravarBD($value) : "NULL";
    }
	
    function getExpectativaInicioIdExpectativaInicio(){
        return $this->dataExpectativaInicio;
    }
    /**
     * addPlanoAcao() Function
     */
    function addPlanoAcao() {
        $sql = "INSERT INTO planoAcao (proposta_idProposta, grupo_idGrupo, focoCurso_idFocoCurso, expectativaInicio_idExpectativaInicio, dataExpectativaInicio, nivelEstudo_IdNivelEstudo, horasPrograma, abordagemCurso, finalizado, kitMaterial_idKitMaterial, statusAprovacao_idStatusAprovacao, dataCadastro, dataExclusao, dataAprovacao, mesReferenciaMudanca, anoReferenciaMudanca, tipoContrato, tipoCurso, tipoAval, tipoMaterial, dataContrato) VALUES ($this->propostaIdProposta, $this->grupoIdGrupo, $this->focoCursoIdFocoCurso, $this->expectativaInicioIdExpectativaInicio, $this->dataExpectativaInicio, $this->nivelEstudoIdNivelEstudo, $this->horasPrograma, $this->abordagemCurso, $this->finalizado, $this->kitMaterialIdKitMaterial, $this->statusAprovacaoIdStatusAprovacao, $this->dataCadastro, $this->dataExclusao, $this->dataAprovacao, $this->mesReferenciaMudanca, $this->anoReferenciaMudanca, $this->tipoContrato, $this->tipoCurso, $this->tipoAval, $this->tipoMaterial, $this->dataContrato)";
		echo $sql;
        $result = $this -> query($sql, true);
//		echo mysqli_insert_id($this -> connect);
        return mysqli_insert_id($this -> connect);
    }

    /**
     * deletePlanoAcao() Function
     */
    function deletePlanoAcao() {
        $sql = "DELETE FROM planoAcao WHERE idPlanoAcao = $this->idPlanoAcao";
        $result = $this -> query($sql, true);
    }

    /**
     * updateFieldPlanoAcao() Function
     */
    function updateFieldPlanoAcao($field, $value) {
        $value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
        $sql = "UPDATE planoAcao SET " . $field . " = " . $value . " WHERE idPlanoAcao = $this->idPlanoAcao";
        $result = $this -> query($sql, true);
    }

    /**
     * updatePlanoAcao() Function
     */
    function updatePlanoAcao() {
        $sql = "UPDATE planoAcao SET proposta_idProposta = $this->propostaIdProposta, grupo_idGrupo = $this->grupoIdGrupo, focoCurso_idFocoCurso = $this->focoCursoIdFocoCurso, expectativaInicio_idExpectativaInicio = $this->expectativaInicioIdExpectativaInicio, dataExpectativaInicio = $this->dataExpectativaInicio, nivelEstudo_IdNivelEstudo = $this->nivelEstudoIdNivelEstudo, horasPrograma = $this->horasPrograma, abordagemCurso = $this->abordagemCurso, finalizado = $this->finalizado, kitMaterial_idKitMaterial = $this->kitMaterialIdKitMaterial, statusAprovacao_idStatusAprovacao = $this->statusAprovacaoIdStatusAprovacao, dataExclusao = $this->dataExclusao, dataAprovacao = $this->dataAprovacao, mesReferenciaMudanca = $this->mesReferenciaMudanca, anoReferenciaMudanca = $this->anoReferenciaMudanca, tipoContrato = $this->tipoContrato, tipoCurso = $this->tipoCurso, tipoAval = $this->tipoAval, tipoMaterial = $this->tipoMaterial, dataContrato = $this->dataContrato WHERE idPlanoAcao = $this->idPlanoAcao";
        //echo $sql;
        //exit;
        $result = $this -> query($sql, true);
    }

    /**
     * selectPlanoAcao() Function
     */
    function selectPlanoAcao($where = "WHERE 1") {
        $sql = "SELECT SQL_CACHE idPlanoAcao, proposta_idProposta, grupo_idGrupo, focoCurso_idFocoCurso, expectativaInicio_idExpectativaInicio, dataExpectativaInicio, nivelEstudo_IdNivelEstudo, horasPrograma, abordagemCurso, finalizado, kitMaterial_idKitMaterial, statusAprovacao_idStatusAprovacao, dataCadastro, dataExclusao, dataAprovacao, mesReferenciaMudanca, anoReferenciaMudanca, tipoContrato, tipoCurso, tipoAval, tipoMaterial, dataContrato FROM planoAcao " . $where;
        //echo $sql;
        return $this -> executeQuery($sql);
    }

    /**
     * selectPlanoAcaoSelect() Function
     */
    function selectPlanoAcaoSelect($classes = "", $idAtual = 0, $where = "") {
        $sql = "SELECT SQL_CACHE idPlanoAcao FROM planoAcao " . $where;
        $result = $this -> query($sql);
        $html = "<select id=\"idPlanoAcao\" name=\"idPlanoAcao\"  class=\"" . $classes . "\" >";
        $html .= "<option value=\"\">Selecione</option>";
        while ($valor = mysqli_fetch_array($result)) {
            $selecionado = $idAtual == $valor['idPlanoAcao'] ? "selected=\"selected\"" : "";
            $html .= "<option " . $selecionado . " value=\"" . $valor['idPlanoAcao'] . "\">" . ($valor['idPlanoAcao']) . "</option>";
        }

        $html .= "</select>";
        return $html;
    }

    function selectPlanoAcaoTr_hist() {

        $sql = "SELECT PA.idPlanoAcao, ST.idStatusAprovacao, I.idioma, NE.nivel, PA.dataCadastro, PA.dataAprovacao, FC.foco, 
		COALESCE(FU_RE.nome, PR_RE.nome, CPF_RE.nome, '') AS nomeRepresentante, COALESCE(CPJ.razaoSocial, 'Particular') AS razaoSocial 
		FROM planoAcao AS PA  
		INNER JOIN proposta AS P ON P.idProposta = PA.proposta_idProposta  
		LEFT JOIN clientePj AS CPJ ON CPJ.idClientePj = P.clientePj_idClientePj
		INNER JOIN idioma AS I ON I.idIdioma = P.idioma_idIdioma  
		INNER JOIN nivelEstudo AS NE ON NE.IdNivelEstudo = PA.nivelEstudo_IdNivelEstudo 
		LEFT JOIN focoCurso AS FC ON FC.idFocoCurso = PA.focoCurso_idFocoCurso 	 
		LEFT JOIN statusAprovacao AS ST ON ST.idStatusAprovacao = PA.statusAprovacao_idStatusAprovacao  
		LEFT JOIN representante AS RE ON RE.idRepresentante = P.representante_idRepresentante 					
		LEFT JOIN funcionario AS FU_RE ON FU_RE.idFuncionario = RE.funcionario_idFuncionario 			
		LEFT JOIN professor AS PR_RE ON PR_RE.idProfessor = RE.professor_idProfessor 			
		LEFT JOIN clientePf AS CPF_RE ON CPF_RE.idClientePf = RE.clientePf_idClientePf 
		WHERE PA.dataExclusao IS NOT NULL ";
        $result = $this -> query($sql);

        if (mysqli_num_rows($result) > 0) {

            $html = "";

            while ($valor = mysqli_fetch_array($result)) {

                $idPlanoAcao = $valor['idPlanoAcao'];
                $idioma = $valor['idioma'];
                $razaoSocial = $valor['razaoSocial'];

                $onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "planoAcao/cadastro.php?id=" . $idPlanoAcao . "', '" . CAMINHO_VENDAS . "planoAcao/historico.php', '')\" ";

                $html .= "<tr>";

                $html .= "<td >" . strtotime($valor['dataCadastro']) . "</td>";

                $html .= "<td $onclick >" . $idPlanoAcao . "</td>";

                $html .= "<td $onclick >" . $razaoSocial . "</td>";

                $html .= "<td $onclick >" . $idioma . "</td>";

                $html .= "</tr>";

            }
        }
        return $html;
    }

    function selectPlanoAcaoTr($where = "", $apenasLinha = false,$tipo) {

        $PlanoAcaoGrupo = new PlanoAcaoGrupo();
		$TipoCurso = new TipoCurso();

        $sql = " SELECT PA.idPlanoAcao, PA.proposta_idProposta, ST.idStatusAprovacao, I.idioma, NE.nivel, PA.dataCadastro, PA.dataAprovacao, FC.foco, PA.tipoCurso,
		COALESCE(FU_RE.nome, PR_RE.nome, CPF_RE.nome, '') AS nomeRepresentante, COALESCE(CPJ.razaoSocial, 'Particular') AS razaoSocial 
		FROM planoAcao AS PA  
		INNER JOIN proposta AS P ON P.idProposta = PA.proposta_idProposta  
		LEFT JOIN clientePj AS CPJ ON CPJ.idClientePj = P.clientePj_idClientePj
		INNER JOIN idioma AS I ON I.idIdioma = P.idioma_idIdioma  
		INNER JOIN nivelEstudo AS NE ON NE.IdNivelEstudo = PA.nivelEstudo_IdNivelEstudo 
		LEFT JOIN focoCurso AS FC ON FC.idFocoCurso = PA.focoCurso_idFocoCurso 	 
		LEFT JOIN statusAprovacao AS ST ON ST.idStatusAprovacao = PA.statusAprovacao_idStatusAprovacao  
		LEFT JOIN representante AS RE ON RE.idRepresentante = P.representante_idRepresentante 					
		LEFT JOIN funcionario AS FU_RE ON FU_RE.idFuncionario = RE.funcionario_idFuncionario 			
		LEFT JOIN professor AS PR_RE ON PR_RE.idProfessor = RE.professor_idProfessor 			
		LEFT JOIN clientePf AS CPF_RE ON CPF_RE.idClientePf = RE.clientePf_idClientePf	
		WHERE (PA.dataExclusao IS NULL OR PA.dataExclusao='') " . $where;
		
		if ($tipo == 1) {
		$sql .= " AND PA.paMudanca = 1";	
			
		} else {
		$sql .= " AND PA.paMudanca = 0";	
			
		}
		
   //     echo $sql;
        $result = $this -> query($sql);

        if (mysqli_num_rows($result) > 0) {

            $html = "";
            $cont = 0;

            $caminhoAtualizar_base = CAMINHO_VENDAS . "planoAcao/index.php";

            while ($valor = mysqli_fetch_array($result)) {
					
                $idPlanoAcao = $valor['idPlanoAcao'];
                $idProposta = $valor['proposta_idProposta'];
                $dataCadastro = strtotime($valor['dataCadastro']);
                $dataAbertura = Uteis::exibirData($valor['dataCadastro']);
                $dataAprovacao = Uteis::exibirData($valor['dataAprovacao']);
                $idioma = $valor['idioma'];
                $nivel = $valor['nivel'];
                $nomeRepresentante = $valor['nomeRepresentante'];
                $razaoSocial = $valor['razaoSocial'];
                $foco = $valor['foco'];
                $integrantes = self::listaPessoas($idPlanoAcao);
				
				$tipoCursoD = $valor['tipoCurso'];
				
				$Ncurso = $TipoCurso->selectTipoCurso(" WHERE idTipoCurso in (".$tipoCursoD.")");
				$nomeCurso = "";
				foreach ($Ncurso as $v) {
					$nomeCurso .= $v['nome']."<br>";
				}
				
				//Editar PAs
				
				if ($valor['idStatusAprovacao'] != 1) {
				
					$htmlAprovado = "<div id=\"liberarPA\"><img src=\"" . CAMINHO_IMG . "editar.png\" title=\"Editar PA aprovada\" onclick=\"editarPA(".$idPlanoAcao.")\"/></div>";
				
				}

                $caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idPlanoAcao=" . $idPlanoAcao . "&ordem=" . ($cont++);

                $onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "planoAcao/cadastro.php?id=" . $idPlanoAcao . "', '$caminhoAtualizar', 'tr')\" ";
				
				$editarEmpresa = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "planoAcao/editarEmpresa.php?id=" . $idPlanoAcao . "', '$caminhoAtualizar', 'tr')\" ";

                $ativo = Uteis::exibirStatusAprovacao($valor['idStatusAprovacao']);

                //VERIFICA SE JA EXISTE ALGUM GRUPO A PARTIR DESSE PLANO
                $temPlanoAcaoGrupo = $PlanoAcaoGrupo -> selectPlanoAcaoGrupo(" WHERE planoAcao_idPlanoAcao = " . $idPlanoAcao);
                if (!$temPlanoAcaoGrupo) {
                    $delete = "<img onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "planoAcao/include/acao/planoAcao.php', '$idPlanoAcao', '$caminhoAtualizar', 'tr')\"
					src=\"" . CAMINHO_IMG . "excluir.png\" title=\"Excluir Plano de ação\" />";
                } else {
                    $delete = "";
                }

                if ($apenasLinha) {

                    $col = array();

                    $col[] = $dataCadastro;
                    $col[] = $idPlanoAcao . $htmlAprovado. "<br>(" . $idProposta . ")";
                    $col[] = $razaoSocial;
                    $col[] = $idioma;
                    $col[] = $nivel;
                    $col[] = $foco;
					$col[] = $nomeCurso;
                    $col[] = $integrantes;
                    $col[] = $nomeRepresentante;
                    $col[] = $dataAbertura;
                    $col[] = $dataAprovacao;
                    $col[] = $ativo;
                    $col[] = $delete;

                    $html = $col;
                    break;

                } else {

                    $html .= "<tr>";

                    $html .= "<td >" . $dataCadastro . "</td>";

                    $html .= "<td $onclick >" . $idPlanoAcao .$htmlAprovado. "(" . $idProposta . ")</td>";
                    $html .= "<td $editarEmpresa ><img src=\"" . CAMINHO_IMG . "editar.png\" title=\"Editar Empresa\" />" . $razaoSocial . "</td>";

                    $html .= "<td $onclick >" . $idioma . "</td>";

                    $html .= "<td $onclick >" . $nivel . "</td>";

                    $html .= "<td $onclick >" . $foco . "</td>";
					$html .= "<td $onclick >" . $nomeCurso . "</td>";
                    $html .= "<td $onclick >" . $integrantes . "</td>";
                    $html .= "<td $onclick >" . $nomeRepresentante . "</td>";
                    $html .= "<td $onclick >" . $dataAbertura . "</td>";
                    $html .= "<td $onclick >" . $dataAprovacao . "</td>";

                    $html .= "<td $onclick >" . $ativo . "</td>";

                    $html .= "<td>" . $delete . "</td>";

                    $html .= "</tr>";

                }
            }
        }

        return $html;
    }
	/**
	* Função que busca o endereço da empresa a partir do plano de ação
	**/
	
	function selectEnderecoPlanoAcaoEmp($idValorSimuladoPlanoAcao) {
	
	$sql ="SELECT C.razaoSocial, C.idClientePj, E.rua, E.bairro, E.numero, E.complemento  
			FROM proposta AS P 
			LEFT JOIN clientePj AS C ON P.clientePj_idClientePj = C.idClientePj
            INNER JOIN planoAcao AS A on A.proposta_idProposta = P.idProposta 
            INNER JOIN endereco AS E on E.clientePj_idClientePj = C.idClientePj
            INNER JOIN valorSimuladoPlanoAcao AS V on V.planoAcao_idPlanoAcao = A.idPlanoAcao
			WHERE E.principal = 1 AND V.idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao;
	$resultClientePj = $this -> query($sql);
    $row = $this->fetchArray($resultClientePj);
    if (mysqli_num_rows($resultClientePj) > 0) {	    	
		$html = "Empresa:".$row['razaoSocial']." - Endereço: ".$row['rua']." nº: ".$row['numero']." - ".$row['complemento']." - Bairro: ".$row['bairro'];//".$resultClientePj['razaoSocial']. - .$resultClientePj['rua'].";	
	}
		return $html;

	}
	
	
	
    function selectIntegrantesPlanoAcaoCheckBox($idPlanoAcao) {

        $ClientePf = new ClientePf();

        $sql = " SELECT DISTINCT(idIntegrantePlanoAcao), PF.nome, P.idPlanoAcao, PF.idClientePf
		FROM clientePf AS PF  
		INNER JOIN integrantePlanoAcao AS IP ON IP.clientePf_idClientePf = PF.idClientePf  
		INNER JOIN planoAcao AS P ON P.idPlanoAcao = IP.planoAcao_idPlanoAcao  		
		WHERE P.idPlanoAcao = " . $idPlanoAcao;
        //echo "$sql";
        $result = $this -> query($sql);
        if (mysqli_num_rows($result) > 0) {

            $html = "";

            while ($valor = mysqli_fetch_array($result)) {

                $idClientePf = $valor['idClientePf'];

                $temEmail = $ClientePf -> getEmail($idClientePf);

                $html .= "<p>
				
				<label for=\"check_disparoEmail_integrantePlanoAcao_" . $valor['idIntegrantePlanoAcao'] . "\">				
				<input type=\"checkbox\" id=\"check_disparoEmail_integrantePlanoAcao_" . $valor['idIntegrantePlanoAcao'] . "\" name=\"check_disparoEmail_integrantePlanoAcao[]\" value=\"" . $valor['idIntegrantePlanoAcao'] . "\" " . ($temEmail ? "" : "disabled") . " /> " . $valor['nome'] . ($temEmail ? "" : "(não possui e-mail)") . "</label>";

            }
        }
        return $html;
    }

    //inicio imprime plano
    function ImprimePlanoAcao($area, $integrante) {

        /*
         * 1 adm
         * 2 prof
         * 3 aluno
         */
		 
		 

        $Endereco = new Endereco();
        $Telefone = new Telefone();
        $EnderecoVirtual = new EnderecoVirtual();
        $ValorSimuladoPlanoAcao = new ValorSimuladoPlanoAcao();
        $ContatoAdicional = new ContatoAdicional();
        $AtividadeExtra = new AtividadeExtra();
        $PlanoAcaoComplemento = new PlanoAcaoComplemento();
        $Complemento = new ComplementoAbordagem();
        $FormacaoPerfil = new FormacaoPerfil();
        $IdiomaBackgroundPerfil = new IdiomaBackgroundPerfil();
        $PerfilProfessor = new OpcaoAtividadeExtraProfessorClientePf();
        $OpcaoDia = new OpcaoDia();
        $OpcaoDiaPlanoAcao = new OpcaoDiaPlanoAcao();
     //   $kitMaterial = new KitMaterial();
		$TipoQualidadeComunicacao = new TipoQualidadeComunicacao();
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
		$RegistroDeAnotacoes = new RegistroDeAnotacoes();
		

        //PLANO DE AÇÃO
        $sql = " SELECT DISTINCT(P.idPlanoAcao) AS idPlanoAcao, PR.idProposta, FC.foco AS nomeFoco, P.dataCadastro, 
		EI.expectativa AS nomeExpectativa, P.dataExpectativaInicio, P.kitMaterial_idKitMaterial, NE.nivel AS nomeNivel, P.horasPrograma, P.abordagemCurso, P.finalizado, KM.nome AS nomeKit, G.idGrupo, P.tipoContrato 
		FROM planoAcao AS P 
		LEFT JOIN grupo AS G ON G.idGrupo = P.grupo_idGrupo 
		LEFT JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo 
		LEFT JOIN planoAcao AS P2 ON P2.idPlanoAcao = PAG.planoAcao_idPlanoAcao
		INNER JOIN proposta AS PR ON 
			(PR.idProposta = P2.proposta_idProposta OR PR.idProposta = P.proposta_idProposta)
		INNER JOIN focoCurso AS FC ON FC.idFocoCurso = P.focoCurso_idFocoCurso 
		INNER JOIN expectativaInicio AS EI ON EI.idExpectativaInicio = P.expectativaInicio_idExpectativaInicio 
		INNER JOIN nivelEstudo AS NE ON NE.idNivelEstudo = P.nivelEstudo_IdNivelEstudo 
		LEFT JOIN kitMaterial AS KM ON KM.idKitMaterial = P.kitMaterial_idKitMaterial 
		WHERE P.idPlanoAcao = " . $this -> idPlanoAcao;

        $html = "";
//		echo $sql;
		
	
        $rsPlanoAcao = $this -> query($sql);
        if ($valorPlanoAcao = mysqli_fetch_array($rsPlanoAcao)) {
            //INFS DO PLANO
            $idPlanoAcao = $valorPlanoAcao['idPlanoAcao'];
            $idProposta = $valorPlanoAcao['idProposta'];
            $nomeKit = $valorPlanoAcao['nomeKit'];
            $nomeExpectativa = $valorPlanoAcao['nomeExpectativa'];
            $dataExpectativaInicio = $valorPlanoAcao['dataExpectativaInicio'];
            $nomeFoco = $valorPlanoAcao['nomeFoco'];
            $nomeNivel = $valorPlanoAcao['nomeNivel'];
            $kit = $valorPlanoAcao['kitMaterial_idKitMaterial'];
            $dataPA = Uteis::exibirData($valorPlanoAcao['dataCadastro']);
            $horasPrograma = Uteis::exibirHoras($valorPlanoAcao['horasPrograma']);
            $abordagemCurso = $valorPlanoAcao['abordagemCurso'];
			$idGrupo2 = $valorPlanoAcao['idGrupo'];
			$tipoContrato = $valorPlanoAcao['tipoContrato'];
			
			if ($tipoContrato == 0) {
				$nomeTipoContrato = "Prazo Inderteminado";
			} else {
				$nomeTipoContrato = "Pacote de horas";
			}

            //INFS DA PROPOSTA
            $sql = " SELECT C.razaoSocial, P.idioma_idIdioma, I.idioma, P.representante_idRepresentante, C.idClientePj  
			FROM proposta AS P 
			INNER JOIN idioma AS I ON P.idioma_idIdioma = I.idIdioma 
			LEFT JOIN clientePj AS C ON P.clientePj_idClientePj = C.idClientePj
			WHERE P.idProposta = " . $idProposta;
            $valorProposta = Uteis::executarQuery($sql);

            $idioma = $valorProposta[0]['idioma'];
            $razaoSocial = $valorProposta[0]['razaoSocial'];
            $idClientePj = $valorProposta[0]['idClientePj'];
            $idIdioma = $valorProposta[0]['idioma_idIdioma'];
            $html .= "
			<link href=\"" . CAMINHO_CFG . "css/folha.css\" type=\"text/css\" rel=\"stylesheet\" media=\"all\" />
			<div class=\"folha\" id=\"planoAcao_" . $idPlanoAcao . "\">";

            //INF GERAL
            $html .= "<p class=\"titulo\" >Plano de ação número " . $idPlanoAcao . "</p>";
            $html .= "<p><strong>Empresa</strong>: " . (($razaoSocial) ? $razaoSocial : "`Particular") . "</p>			
			<p><strong>Data</strong>: " . $dataPA . " <small>(válido por 30 dias)</small></p>";

            //CONTATO RH
            if ($idClientePj) {
                $rsContatoAdicional = $ContatoAdicional -> selectContatoAdicional(" AND clientePj_idClientePj = $idClientePj AND contatoRH = 1");
                if ($rsContatoAdicional) {
                    $html .= "<p class=\"titulo\" >Contato RH</p>";
                    foreach ($rsContatoAdicional as $valor) {

                        $idContatoAdicional = $valor['idContatoAdicional'];
                        $nomeAdd = $valor['nome'];

                        $html .= "<p class=\"subTitulo\" >$nomeAdd</p>
						<div class=\"tab1\">";

                        $rsTelefone = $Telefone -> selectTelefone(" WHERE contatoAdicional_idContatoAdicional = $idContatoAdicional");
                        if ($rsTelefone) {
                            foreach ($rsTelefone as $value) {
                                $html .= "<p>Telefone: " . $Telefone -> getTelefone($value['idTelefone']) . "</p>";
                            }
                        }

                        $rsEnderecoVirtual = $EnderecoVirtual -> selectEnderecoVirtualJoin(" WHERE E.contatoAdicional_idContatoAdicional = $idContatoAdicional", array("E.valor", "T.tipo"));
                        if ($rsEnderecoVirtual) {
                            foreach ($rsEnderecoVirtual as $value) {
                                $html .= "<p>" . $value['tipo'] . ": " . $value['valor'] . "</p>";
                            }
                        }

                        $html .= "</div>";

                    }
                }
            }
            
			//CONTATO Outros
            if ($idClientePj) {
                $rsContatoAdicional = $ContatoAdicional -> selectContatoAdicional(" AND clientePj_idClientePj = $idClientePj AND contatoOutro = 1");
                if ($rsContatoAdicional) {
                    $html .= "<p class=\"titulo\" >Contatos Adicionais</p>";
                    foreach ($rsContatoAdicional as $valor) {

                        $idContatoAdicional = $valor['idContatoAdicional'];
                        $nomeAdd = $valor['nome'];

                        $html .= "<p class=\"subTitulo\" >$nomeAdd</p>
						<div class=\"tab1\">";

                        $rsTelefone = $Telefone -> selectTelefone(" WHERE contatoAdicional_idContatoAdicional = $idContatoAdicional");
                        if ($rsTelefone) {
                            foreach ($rsTelefone as $value) {
                                $html .= "<p>Telefone: " . $Telefone -> getTelefone($value['idTelefone']) . "</p>";
                            }
                        }

                        $rsEnderecoVirtual = $EnderecoVirtual -> selectEnderecoVirtualJoin(" WHERE E.contatoAdicional_idContatoAdicional = $idContatoAdicional", array("E.valor", "T.tipo"));
                        if ($rsEnderecoVirtual) {
                            foreach ($rsEnderecoVirtual as $value) {
                                $html .= "<p>" . $value['tipo'] . ": " . $value['valor'] . "</p>";
                            }
                        }

                        $html .= "</div>";

                    }
                }
            }

            //ALUNOS
            $html .= "<p class=\"titulo\" >Alunos</p>";
            if ($area == "3")
                $html .= "<p style=\"color:#F00\"><i>Seus números de documentos, endereços, e informações de perfil não estão disponíveis para os outros alunos.</i></p>";
	//		echo $integrante;
			$idPlanoAcaoGrupo = $PlanoAcaoGrupo->getPAG_atual($idGrupo2);
	
            $sql = " SELECT I.idIntegrantePlanoAcao, C.idClientePf, N.nivel AS nomeNivel, C.cargo, C.estadoCivil_idEstadoCivil, C.dataNascimento, C.nome AS nomeCliente, I.obsDiagnosticoNivel, C.documentoUnico, C.rg, TD.valor AS tipoDoc
			FROM integrantePlanoAcao AS I 
			LEFT JOIN planoAcao AS PA ON PA.idPlanoAcao = I.planoAcao_idPlanoAcao 
			LEFT JOIN nivelEstudo AS N ON N.idNivelEstudo = I.Nivel_IdNivel 
			LEFT JOIN clientePf AS C ON C.idClientePf = I.clientePf_idClientePf
			LEFT JOIN tipoDocumentoUnico AS TD ON TD.idTipoDocumentoUnico = C.tipoDocumentoUnico_idTipoDocumentoUnico			 
			WHERE PA.idPlanoAcao = " . $idPlanoAcao;
			if ($integrante > 0 ) {
				$sql .= " AND I.idIntegrantePlanoAcao = ".$integrante;
			}
			
	        $rsIntegrantes = $this -> executeQuery($sql);
            $estado = new EstadoCivil();
           
            if ($rsIntegrantes) {
                foreach ($rsIntegrantes as $valorIntegrantes) {

                    $idIntegrantePlanoAcao = $valorIntegrantes['idIntegrantePlanoAcao'];
                    $nomeCliente = $valorIntegrantes['nomeCliente'];
                    $inte = ($idIntegrantePlanoAcao===$integrante);
                    $idClientePf = $valorIntegrantes['idClientePf'];
                    $nomeNivel_i = $valorIntegrantes['nomeNivel'];                        
                    $cargo = $valorIntegrantes['cargo']; 
                    
                    $obs = $valorIntegrantes['obsDiagnosticoNivel'];

                    $html .= "<p class=\"subTitulo\">" . $nomeCliente . "</p>";

                    $html .= "<div class=\"tab1\">"; 
                                       
                   if($valorIntegrantes['cargo']!="") $html .= "<p> Cargo: ".$cargo."</p>";

                    //PROFESSOR E OUTROS ALUNOS NAO VEEM
                    if ($rg) {
                        if ($area != "2" && ($idClientePf == $_SESSION['idClientePf_SS']))
                            $html .= "<p>RG: " . $rg . "</p>";
                    }

                    //PROFESSOR E OUTROS ALUNOS NAO VEEM
                    if ($tipoDoc && $documentoUnico) {
                        if ($area =="" || $area != "2" && ($area != "3" || ($idClientePf == $_SESSION['idClientePf_SS'] || $inte == 1)))
                            $html .= "<p>$tipoDoc : $documentoUnico </p>";
                    }

                   $rsTelefone = $Telefone -> selectTelefone(" WHERE clientePf_idClientePf = $idClientePf");
                    if ($rsTelefone) {
                        foreach ($rsTelefone as $value) {
                            $html .= "<p>Telefone: " . $Telefone -> getTelefone($value['idTelefone']) . "</p>";
                        }
                    }

                    $rsEnderecoVirtual = $EnderecoVirtual -> selectEnderecoVirtualJoin(" WHERE E.clientePf_idClientePf = $idClientePf", array("E.valor", "T.tipo"));
                    if ($area =="" || $area != "3" || $idClientePf == $_SESSION['idClientePf_SS']) {
                        if ($rsEnderecoVirtual) {
                            foreach ($rsEnderecoVirtual as $value) {
                                $html .= "<p>" . $value['tipo'] . ": " . $value['valor'] . "</p>";
                            }
                        }
                    }
                    
                    if($valorIntegrantes['estadoCivil_idEstadoCivil']!=""){
                    $estadoCivil = $estado->getEstadoCivil($valorIntegrantes['estadoCivil_idEstadoCivil']);
                    $html .= "<p> Estado Civil: ".$estadoCivil."</p>";
                    }
                    
                     if($valorIntegrantes['dataNascimento']!=""){
                        $dataNascimento = Uteis::exibirData($valorIntegrantes['dataNascimento']);
                        $idade =  date("Y") - date("Y",strtotime($valorIntegrantes['dataNascimento']));
                        if($area == "2"){ 
                            $html .= "<p> Data de Nascimento: ".$dataNascimento."</p>";
                        }
                        $html .= "<p> Idade: ".$idade."</p>";
                     }

                    //OUTROS ALUNOS NAO VEEM
                    if ($area != "3" || $idClientePf == $_SESSION['idClientePf_SS']) {

                        if ($nomeNivel_i != $nomeNivel)
                            $html .= "<p class=\"importante\">Nivel pessoal: " . $nomeNivel . "</p>";

                        //NENHUM ALUNO NAO VE
                        if ($area != "3" && $obs)
                            $html .= "<p class=\"importante\">Observações sobre o aluno: " . $obs . "</p>";

                        //INFS ADICIONAIS
                        $sql = "SELECT AE.nome, TAE.nome AS tipo, O.obs FROM atividadeExtra AS AE 
						INNER JOIN tipoAtividadeExtra AS TAE ON TAE.idTipoAtividadeExtra = AE.tipoAtividadeExtra_idTipoAtividadeExtra
						INNER JOIN opcaoAtividadeExtraClientePf AS O ON O.atividadeExtra_idAtividadeExtra = AE.idAtividadeExtra 
						WHERE O.clientePf_idClientePf = $idClientePf order by TAE.idTipoAtividadeExtra asc";
                       
                        $rsAtividadeExtra = Uteis::executarQuery($sql);
                        if ($rsAtividadeExtra) {

                            $tipoUltimo = "";
                            $imprimeTipo = false;

                            $html .= "<p><strong>Perfil</strong></p>";
                            foreach ($rsAtividadeExtra as $key => $valor) {

                                if ($valor['tipo'] != $tipoUltimo) {
                                    $tipoUltimo = $valor['tipo'];
                                    $imprimeTipo = true;
                                }

                                if ($key != 0 && $imprimeTipo)
                                    $html .= "</p>";

                                if ($imprimeTipo)
                                    $html .= "
								<p class=\"tab1\"><u>" . $valor['tipo'] . ":</u></p>
								<p class=\"tab2\">";

                                $html .= "<li>" . $valor['nome'] ." ". $valor['obs'] . "</li>";

                                if ($key + 1 == count($rsAtividadeExtra))
                                    $html .= "</p>";
                                $imprimeTipo = false;
                            }
                        }

                        $rsFormacaoPerfil = $FormacaoPerfil -> selectFormacaoperfil(" WHERE clientePf_idClientePf = $idClientePf");
                        if ($rsFormacaoPerfil) {
                            $html .= "<p><strong>Formação escolar</strong></p>";
                            foreach ($rsFormacaoPerfil as $valor){
                            $html .="<style>.com_wrap { width:400px; word-wrap: break-word; }</style>";
                                $html .= "<p class=\"tab1\">" . $valor['instituicao'] . " - " . $valor['curso'] . " - " . $valor['formacao'] . "</p>";
                                $html .= "<p class=\"tab1\"><div class=\"com_wrap\">" . $valor['obs'] . "</div></p>";}
                        }

                        $rsIdiomaBackgroundPerfil = $IdiomaBackgroundPerfil -> selectIdiomabackgroundperfilJoin(" WHERE clientePf_idClientePf = $idClientePf", array("I.idioma", "E.nome", "IB.obs"));
                        if ($rsIdiomaBackgroundPerfil) {
                            $html .= "<p><strong>Background no idioma</strong></p>";
                            foreach ($rsIdiomaBackgroundPerfil as $valor)
                                $html .= "<p class=\"tab1\">" . $valor['nome'] . " - " . $valor['idioma'] ." ". $valor['obs'] . "</p>";
                                //$html .= "<p class=\"tab1\">" .  $valor['obs'] . "</p>";
                        }

                        $sql = "SELECT  AEP.nome, TAEP.nome AS tipo, OPC.obs FROM atividadeExtraProfessor AS AEP 
                       INNER JOIN tipoAtividadeExtraProfessor AS TAEP ON TAEP.idTipoAtividadeExtraProfessor = AEP.tipoAtividadeExtraProfessor_idTipoAtividadeExtraProfessor 
                       INNER JOIN opcaoAtividadeExtraProfessorClientePf AS OPC ON OPC.atividadeExtraProfessor_idAtividadeExtraProfessor = AEP.idAtividadeExtraProfessor 
                       WHERE OPC.clientePf_idClientePf = $idClientePf ";
                        $rsPerfilProfessor = Uteis::executarQuery($sql);
                        if ($rsPerfilProfessor) {
                            $tipoUltimo = "";
                            $imprimeTipo = false;
                            $html .= "<p><strong>Perfil do Professor</strong></p>";
                            foreach ($rsPerfilProfessor as $key => $valor) {
                                if ($valor['tipo'] != $tipoUltimo) {
                                    $tipoUltimo = $valor['tipo'];
                                    $imprimeTipo = true;
                                }
                                if ($key != 0 && $imprimeTipo)
                                    $html .= "</p>";

                                if ($imprimeTipo)
                                    $html .= "
                                <p class=\"tab1\"><u>" . $valor['tipo'] . ":</u></p>
                                <p class=\"tab2\">";

                                $html .= "" . $valor['nome'] ." ". $valor['obs'] ."; ";

                                if ($key + 1 == count($rsPerfilProfessor))
                                    $html .= "</p>";
                                $imprimeTipo = false;
                            }
                        }

                        $sql = " SELECT idVpgPlanoAcao, integrantePlanoAcao_idIntegrantePlanoAcao, valor, tipo 
						FROM vpgPlanoAcao 
						WHERE integrantePlanoAcao_idIntegrantePlanoAcao = $idIntegrantePlanoAcao";
//						echo $sql;
                        $rsVpgPlanoAcao = Uteis::executarQuery($sql);
						$VPG = array();
                       
					    if ($rsVpgPlanoAcao) {

                            $html .= "<p><strong>VPG</strong></p>";
                            $cont = 0;
                            foreach ($rsVpgPlanoAcao as $key => $valorVpgPlanoAcao) {

                               
                                    switch ($valorVpgPlanoAcao['tipo']) {
                                        case "V" :
                                            $descTipo = "Vocabulário";
                                            $VPG[$descTipo][] = $valorVpgPlanoAcao['valor'];
                                            break;

                                        case "P" :
                                            $descTipo = "Pronúncia";
                                            $VPG[$descTipo][] = $valorVpgPlanoAcao['valor'];
                                            break;

                                        case "G" :
                                            $descTipo = "Gramática";
                                            $VPG[$descTipo][] = $valorVpgPlanoAcao['valor'];
                                            break;
                                    }
                                   
                                $cont++;

                            }
                          foreach($VPG as $k => $value):
                            $html .=  "<p class=\"tab1\"><strong>".$k."</strong>";
                            foreach($value as $s => $valor):
                                $html .=  "<li>".$valor."</li>";
                            endforeach;    
                            $html .=  "</p>";                           
                          endforeach;  
                            
                        }
						
						if ($jaInserido == 0) {
						
                        $sql = "SELECT SQL_CACHE QC.idQualidadeComunicacaoPlanoAcao, IQC.nome as subcategoria , IQC.descricao as descricao, TQC.nome as categoria
                                FROM qualidadeComunicacaoPlanoAcao AS QC
                                INNER JOIN itenQualidadeComunicacao AS IQC ON QC.itenQualidadeComunicacao_idItenQualidadeComunicacao = IQC.idItenQualidadeComunicacao
                                INNER JOIN tipoQualidadeComunicacao AS TQC ON IQC.tipoQualidadeComunicacao_idTipoQualidadeComunicacao = TQC.idTipoQualidadeComunicacao
                                WHERE QC.integrantesPlanoAcao_idIntegrantesPlanoAcao = $idIntegrantePlanoAcao order by categoria,subcategoria";
               // echo $sql;
				        $rsQC = Uteis::executarQuery($sql);
	
	                     if ($rsQC) {
                            $cont = 0;
                            $html .= "<p><strong>Qualidade da comunicação</strong></p>";   
							
							foreach ($rsQC as $k => $valor){
                               $Qualidade[$valor['categoria']][$valor['subcategoria']][] = $valor['idQualidadeComunicacaoPlanoAcao'];
							}
								
                            foreach($Qualidade as $i => $j){
                               $html .= "<p><strong>".$i."</strong></p>";
                 
							
				                   foreach($j as $k => $l){
                                     $html .= "<i><p style=\"color:#000;\"><strong>".$k."</strong></p></i>";
                					
											foreach($l as $m => $n){
												
												$nome = $TipoQualidadeComunicacao->getNome($n);
												
												
		                                       $html .= "<p style=\"color:#000;\">".$nome."</p>"; 
                                        }
 								   }
							}
                            
                        }
                        
                    }
				}

                    $html .= "</div>";

                }

            }

            //INFS CURSOS
            $html .= "<p class=\"titulo\" >Informações do curso</p>";

            $html .= "<p><strong>Idioma</strong>: " . $idioma . "</p>";

            $html .= "<p><strong>Foco</strong>: " . $nomeFoco . "</p>";

            $html .= "<p><strong>Nível</strong>: " . $nomeNivel . "</p>";
			
			 $html .= "<p><strong>Tipo de contrato</strong>: " . $nomeTipoContrato . "</p>";

            $html .= "<p><strong>Horas previstas</strong>: " . $horasPrograma . "</p>";
			
			 $cargaFixaMensal = Uteis::executarQuery("SELECT cargaHorariaFixaMensal FROM valorSimuladoPlanoAcao
                WHERE planoAcao_idPlanoAcao = $idPlanoAcao");
				if ($cargaFixaMensal[0]['cargaHorariaFixaMensal'] > 0) 
			$html .= "<p><strong>Carga horária fixa mensal</strong>: ".Uteis::exibirHoras($cargaFixaMensal[0]['cargaHorariaFixaMensal'])."</p>";

            if ($dataExpectativaInicio)
                $html .= "<p><strong>Expectativa de início</strong>: " . Uteis::exibirData($dataExpectativaInicio) . "</p>";

            $html .= "<p class=\"subTitulo\" >Dias de aula:</p>";
            $rsOpcaoDia = $OpcaoDia -> selectOpcaoDia(" WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao IN(
				SELECT idValorSimuladoPlanoAcao FROM valorSimuladoPlanoAcao
				WHERE planoAcao_idPlanoAcao = $idPlanoAcao
			)");
            $obs = Uteis::executarQuery("SELECT obs FROM valorSimuladoPlanoAcao
                WHERE planoAcao_idPlanoAcao = $idPlanoAcao");
            $html .= "<p><strong>Obs:</strong>: " . $obs[0]['obs'] . "</p>";    
            if ($rsOpcaoDia) {
                foreach ($rsOpcaoDia as $key => $valorOpcaoDia) {
                    $html .= "<p><strong>" . ($key + 1) . "ª opção</strong></p>";
                    $rsOpcaoDiaPlanoAcao = $OpcaoDiaPlanoAcao -> selectOpcaoDiaPlanoAcao(" WHERE opcaoDia_idOpcao = " . $valorOpcaoDia['idOpcao']);
                    if ($rsOpcaoDiaPlanoAcao) {
                        foreach ($rsOpcaoDiaPlanoAcao as $valorOpcaoDiaPlanoAcao) {
                            //echo "<br>";print_r($valorOpcaoDiaPlanoAcao);
                            $html .= "<p class=\"tab1\">" . $OpcaoDiaPlanoAcao -> montarDia($valorOpcaoDiaPlanoAcao['idOpcaoDiaPlanoAcao']) . "</p>";
                            switch($valorOpcaoDiaPlanoAcao['localAula_idLocalAula']) {
                                case 1 :
                                    $rsEndereco = $Endereco -> selectEndereco(" WHERE idEndereco = ".$valorOpcaoDiaPlanoAcao['endereco_idEndereco']);
                                    if ($rsEndereco[0]['rua'] != "") :
                                        $html .= "<p>Endereço: Rua " . $rsEndereco[0]['rua'] . ", nº " . $rsEndereco[0]['numero'] . "</p>";
                                    else :
                                        $html .= "<p>Endereço não encontrado</p>";
                                    endif;
                                    break;

                                case 2 :
                                    $html .= "<p>Endereço: " . ENDERECO . "</p>";
                                    break;

                                case 3 :
                                    $rsEndereco = $Endereco -> selectEndereco(" WHERE idEndereco = ".$valorOpcaoDiaPlanoAcao['endereco_idEndereco']);                                   
                                    if ($rsEndereco[0]['rua'] != "") :
                                        $html .= "<p>Endereço: Rua " . $rsEndereco[0]['rua'] . ", nº " . $rsEndereco[0]['numero'] . ", Bairro:  " . $rsEndereco[0]['bairro'] . ", Complemento:  " . $rsEndereco[0]['complemento'] . ", CEP:  " . $rsEndereco[0]['cep'] . "</p>";
                                    else :
                                        $html .= "<p>Endereço não encontrado</p>";
                                    endif;
                                    break;
                                case 5 :
                                    $html .= "<p>Aulas por Telefone</p>";
                                    break;
								case 6 :
                                    $html .= "<p>Aulas por Skype</p>";
                                    break;
                                case 8 :
                                    $rsEndereco = $Endereco -> selectEndereco(" WHERE idEndereco = ".$valorOpcaoDiaPlanoAcao['endereco_idEndereco']);
                                    if ($rsEndereco[0]['rua'] != "") :
                                        $html .= "<p>Endereço: Rua " . $rsEndereco[0]['rua'] . ", nº " . (($rsEndereco[0]['numero'] > 0) ? $rsEndereco[0]['numero']." - ".$rsEndereco[0]['complemento']: "S/n") . "</p>";
                                    else :
                                        $html .= "<p>Endereço não encontrado</p>";
                                    endif;
                                    break;
                            }
                        }
                    }
                }
            }

            if ($abordagemCurso) {
                $html .= "<p class=\"subTitulo\" >Abordagem do curso:</p>";
                $html .= "<p style=\"border:none\" >" . $abordagemCurso . "</p>";
            }
            //Complementos Plano de Ação
            $html .= "<p class=\"titulo\" >Complemento de Abordagem</p>";
            $rsComp = $PlanoAcaoComplemento -> selectPlanoAcaoComplemento("WHERE planoAcao_idPlanoAcao = $idPlanoAcao");
            if ($rsComp[0]['idPlanoAcaoComplemento'] != "") {
                for ($i = 0; $i < count($rsComp); $i++) {
                    $rc = $Complemento -> selectComplementoAbordagem("WHERE idComplementoAbordagem = " . $rsComp[$i]['complementoAbordagem_idComplementoAbordagem']);
                    $html .= "<p class=\"subTitulo\" >" . $rc[0]['nome'] . "</p>";
                    $html .= "<p style=\"border:none\" >" . $rc[0]['item'] . "</p>";
                }
            } else {
                $html .= "<p>Informação não disponível.</p>";
            }

            //INVESTIMENTO CURSO
            if ($area != "2") {

                $html .= "<p class=\"titulo\" >Investimento curso</p>";

                $html .= "<p><strong>Valores simulados</strong>: <span style=\"color:red;\"> (Este valor pode variar de acordo com a quantidade de aulas em cada mês.)</span></p>";
                $ValorSimuladoPlanoAcao -> setPlanoAcaoIdPlanoAcao($idPlanoAcao);
                $html .= $ValorSimuladoPlanoAcao -> listaValorSimuladoPlanoAcao();

                if ($rsIntegrantes) {
                    foreach ($rsIntegrantes as $valorIntegrantes) {

                        $idIntegrantePlanoAcao = $valorIntegrantes['idIntegrantePlanoAcao'];
                        $nomeCliente = $valorIntegrantes['nomeCliente'];

                        $html .= "<p class=\"subTitulo\">" . $nomeCliente . "</p>";

                        //SUB CURSO
                        $sql = " SELECT idSubvencaoCursoPlanoAcao, integrantePlanoAcao_idIntegrantePlanoAcao, subvencao, teto, quemPaga 
						FROM subvencaoCursoPlanoAcao 
						WHERE integrantePlanoAcao_idIntegrantePlanoAcao = $idIntegrantePlanoAcao";
                        $rsSubvencaoCursoPlanoAcao = Uteis::executarQuery($sql);

                        if ($rsSubvencaoCursoPlanoAcao) {
                            foreach ($rsSubvencaoCursoPlanoAcao as $valorSubvencaoCursoPlanoAcao) {

                                $teto = $valorSubvencaoCursoPlanoAcao['teto'];
                                $quemPaga = $valorSubvencaoCursoPlanoAcao['quemPaga'] == "A" ? "Aluno" : "Empresa";
                                $subvencao = $valorSubvencaoCursoPlanoAcao['subvencao'];

                                $html .= "<p class=\"tab1\">Subvenção de <strong>" . Uteis::formatarMoeda($subvencao) . " %</strong> ";

                                if ($teto)
                                    $html .= "com teto de <strong>R$ " . Uteis::formatarMoeda($teto) . "</strong>";

                                $html .= " pagos pelo(a) <strong>" . $quemPaga . "</strong></p>";
                            }
                        }

                    }
                }
				
				
				$html .= "<p class=\"titulo\" >Observações:</p>";
				$rw = $RegistroDeAnotacoes->selectRegistroDeAnotacoes( "WHERE planoAcao_idPlanoAcao = " . $idPlanoAcao);
				
				foreach ($rw as $valorRW) {
						$html .= "<p>".$valorRW['anotacao']."</p>";
				}

            }

            //INFS RECURsOS
            $html .= "<p class=\"titulo\" >Informações dos materiais</p>";
            $temMaerial = false;
            $MaterialDidatico = new MaterialDidatico();
            $sql = "SELECT SQL_CACHE 
                    distinct(MD.idMaterialDidatico), MD.editoraMaterialDidatico_idEditoraMaterialDidatico, 
                    MD.materialDidaticoTipo_idMaterialDidaticoTipo, 
                    MD.idioma_idIdioma, MD.isbn, MD.valor, MD.opcional, 
                    MD.dataCadastro, MD.obs, MD.inativo, MD.nome, MD.excluido 
                    FROM materialDidatico AS MD
                    INNER JOIN
                    materialDidaticoINF AS MDINF ON MD.idMaterialDidatico = MDINF.materialDidatico_idMaterialDidatico
                    INNER JOIN
                    relacionamentoINF AS R ON R.idRelacionamentoINF = MDINF.relacionamentoINF_idRelacionamentoINF
                    INNER JOIN
                    kitMaterialDidatico AS K2 ON idMaterialDidatico = K2.materialDidatico_idMaterialDidatico
                    INNER JOIN
                    planoAcao AS PA ON PA.kitMaterial_idKitMaterial = K2.kitMaterial_idKitMaterial
                    AND PA.focoCurso_idFocoCurso = R.focoCurso_idFocoCurso
                    AND PA.nivelEstudo_idNivelEstudo = R.nivelEstudo_idNivelEstudo
                    INNER JOIN proposta AS P ON P.idProposta = PA.proposta_idProposta AND P.idioma_idIdioma = R.idioma_idIdioma
                    WHERE K2.excluido = 0 AND PA.idPlanoAcao =$idPlanoAcao";
					
		//			echo $sql;
			
            $rsMaterial = Uteis::executarQuery($sql);
            if ($rsMaterial) {
                $temMaerial = true;
				$html .= "<p class=\"subTitulo\" >Kit Material</p>";
                foreach ($rsMaterial as $valor) {
                    $html .= "<p>" . $MaterialDidatico -> montaMaterial($valor['idMaterialDidatico']) . "</p>";
                }

            }

            //MATERIAL AVULSO
            $rsMaterial = $MaterialDidatico -> selectMaterialDidatico(" WHERE idMaterialDidatico IN (
                SELECT materialDidatico_idMaterialDidatico FROM materialDidaticPlanoAcao AS M2 WHERE M2.planoAcao_idPlanoAcao = $idPlanoAcao
            )");
            if ($rsMaterial) {
                $temMaerial = true;
				$html .= "<p class=\"subTitulo\" >Material Avulso</p>";
                foreach ($rsMaterial as $valor)
                    $html .= "<p>" . $MaterialDidatico -> montaMaterial($valor['idMaterialDidatico'],false) . "</p>";
            }

            //MATERIAL MONTADO/PERSONALIZADO/APOSTILAS
            $MaterialMontadoPlanoAcao = new MaterialMontadoPlanoAcao();
            $rsMaterial = $MaterialMontadoPlanoAcao -> selectMaterialMontadoPlanoAcao(" WHERE planoAcao_idPlanoAcao = $idPlanoAcao");
            if ($rsMaterial) {
                $temMaerial = true;
				$html .= "<p class=\"subTitulo\" >Material Montado / Personalizado / Apostilas</p>";
                foreach ($rsMaterial as $valor) {
                    $html .= "<p>" . $valor['nome'];
					if ($area != 2 ) {
					$html .= " - R$ " . Uteis::formatarMoeda($valor['preco']);
					 $html .=  " | ". $valor['obs'];
					}
			//		$html .=  "</p>";
                    $html .= "</p>";
				}
            }

            if (!$temMaerial)
                $html .= "<p>Não foi solicitado material.</p>";
            //INVESTIMENTO CURSO
            if ($area != "2") {
                $html .= "<p class=\"titulo\" >Investimento em materiais</p>";

                if ($rsIntegrantes) {
                    foreach ($rsIntegrantes as $valorIntegrantes) {

                        $idIntegrantePlanoAcao = $valorIntegrantes['idIntegrantePlanoAcao'];
                        $nomeCliente = $valorIntegrantes['nomeCliente'];

                        $html .= "<p class=\"subTitulo\">" . $nomeCliente . "</p>";

                        //SUB MATERIAL
                        $sql = "SELECT SQL_CACHE 
						idSubvencaoMaterialPlanoAcao, integrantePlanoAcao_idIntegrantePlanoAcao, subvencao, teto, quemPaga 
						FROM subvencaoMaterialPlanoAcao 
						WHERE integrantePlanoAcao_idIntegrantePlanoAcao = '" . $valorIntegrantes['idIntegrantePlanoAcao'] . "'";
                        $rsSubvencaoMaterialPlanoAcao = Uteis::executarQuery($sql);

                        if ($rsSubvencaoMaterialPlanoAcao) {
                            foreach ($rsSubvencaoMaterialPlanoAcao as $valorSubvencaoMaterialPlanoAcao) {

                                $teto = $valorSubvencaoMaterialPlanoAcao['teto'];
                                $quemPaga = $valorSubvencaoMaterialPlanoAcao['quemPaga'] == "A" ? "Aluno" : "Empresa";
                                $subvencao = $valorSubvencaoMaterialPlanoAcao['subvencao'];

                                $html .= "<p class=\"tab1\">Subvencao de <strong>" . Uteis::formatarMoeda($subvencao) . " %</strong> ";

                                if ($teto)
                                    $html .= "com teto de <strong>R$ " . Uteis::formatarMoeda($teto) . "</strong>";

                                $html .= " pagos pelo(a) <strong>" . $quemPaga . "</strong></p>";
                            }
                        }

                    }
                }
            }

            //MEDIÇÃO DE RESULTADO
            $sql = "SELECT SQL_CACHE idPlanoAcaoMedicaoResultado, planoAcao_idPlanoAcao, medicaoResultado.medicao nomeMed, quantidade 
			FROM planoAcaoMedicaoResultado 
			LEFT JOIN medicaoResultado ON medicaoResultado.idMedicaoResultado = planoAcaoMedicaoResultado.medicaoResultado_idMedicaoResultado 
			WHERE planoAcao_idPlanoAcao = " . $idPlanoAcao;
            $rsMedicao = Uteis::executarQuery($sql);
            //echo "$sql";
            if ($rsMedicao) {
                $html .= "<p class=\"titulo\" >Medição de resultados</p>";
                foreach ($rsMedicao as $valor)
                    $html .= "<p>" . $valor['nomeMed'] . " (" . $valor['quantidade'] . "x)</p>";
            }

            //REGRAS
            $sql = " SELECT tituloRegra, regra 
			FROM planoAcaoRegras AS PAR
			LEFT JOIN regras ON idRegras = regras_idRegras 
			WHERE PAR.planoAcao_idPlanoAcao = " . $idPlanoAcao . " order by tituloRegra";
	//		echo $sql;
            $rsRegras = Uteis::executarQuery($sql);
			
	//		Uteis::pr($rsRegras);
            if ($rsRegras) {
                $html .= "<p class=\"titulo\" >Regras</p>";
                foreach ($rsRegras as $valorRegras)
                    $html .= "<p class=\"subTitulo\">" . strip_tags($valorRegras['tituloRegra'],"<b><strong>") . "</p> <p>" . strip_tags($valorRegras['regra'],"<b><strong>") . "</p>";
            }

            $html .= "</div>";

        }

        return $html;
    }

    function getIdIdioma($id, $nomeIdioma = false) {

        $sql = " SELECT I.idIdioma, I.idioma FROM planoAcao AS PA 
		LEFT JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = PA.grupo_idGrupo 
		LEFT JOIN planoAcao AS PA2 ON PA2.idPlanoAcao = PAG.planoAcao_idPlanoAcao		
		INNER JOIN proposta AS P ON ( P.idProposta = PA.proposta_idProposta OR P.idProposta = PA2.proposta_idProposta )
		INNER JOIN idioma AS I ON I.idIdioma = P.idioma_idIdioma
		WHERE PA.idPlanoAcao = $id";
        //echo "<br>$sql";
        $rs = mysqli_fetch_array($this -> query($sql));
        $idIdioma = $nomeIdioma ? $rs['idioma'] : $rs['idIdioma'];
        return $idIdioma;

    }

    function getIdProposta($idPlanoAcao) {
        $rs = $this -> selectPlanoAcao("WHERE idPlanoAcao = $idPlanoAcao");
        if ($rs[0]['proposta_idProposta']) {
            return $rs[0]['proposta_idProposta'];
        } else {
            $sql = "SELECT P.idProposta FROM planoAcao AS PA
			INNER JOIN grupo AS G ON G.idGrupo = PA.grupo_idGrupo 
			INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo
			INNER JOIN planoAcao AS PA2 ON PA2.idPlanoAcao = PAG.planoAcao_idPlanoAcao
			INNER JOIN proposta AS P ON P.idProposta = PA2.proposta_idProposta
			WHERE PA.idPlanoAcao = $idPlanoAcao";
            $rs = Uteis::executarQuery($sql);
            return $rs[0]['idProposta'];
        }
    }

    function listaPessoas($idPlanoAcao) {
		$Professor = new Professor();
		$ClientePf = new ClientePf();
		
        $html = "";
        if ($idPlanoAcao) {
            $sql = "SELECT DISTINCT(IP.clientePf_idClientePf), IP.professor_idProfessor, IP.planoAcao_idPlanoAcao   
			FROM integrantePlanoAcao AS IP ";
		//	INNER JOIN clientePf AS C ON C.idClientePf = IP.clientePf_idClientePf 
			$sql .= " WHERE IP.planoAcao_idPlanoAcao = $idPlanoAcao ";
		//	echo $sql."<hr>";
            $rs = Uteis::executarQuery($sql);
            if ($rs) {
                foreach ($rs as $valor) {
					if ($valor['professor_idProfessor'] > 0) {
						$nome = $Professor->getNome($valor['professor_idProfessor']);
					} else {
						$nome = $ClientePf->getNome($valor['clientePf_idClientePf']);	
					}
                    $html .= "<div class=\"destacaLinha\">" . $nome . "</div>";
				}
			}
        }

        return $html;
    }

    function calculaDataTermino($idPlanoAcao, $dataInicioEstagio) {

        if ($idPlanoAcao && Uteis::verificarData($dataInicioEstagio)) {

            $sql = "SELECT tipo, horasPorAula, frequenciaSemanalAula, cargaHorariaFixaMensal 
			FROM valorSimuladoPlanoAcao AS VSPA WHERE planoAcao_idPlanoAcao = $idPlanoAcao";
            $rs = Uteis::executarQuery($sql);

            if ($rs) {

                $tipo = $rs[0]['tipo'];

                //REGULAR
                if ($tipo == "R") {

                    $horasPorAula = $rs[0]['horasPorAula'];
                    $frequenciaSemanalAula = $rs[0]['frequenciaSemanalAula'];
                    $cargaHorariaFixaMensal = $rs[0]['cargaHorariaFixaMensal'];

                    $horasSemana = ($frequenciaSemanalAula * $horasPorAula);
                    $horasSemana = ($cargaHorariaFixaMensal && ($horasSemana * 4) > $cargaHorariaFixaMensal) ? ($cargaHorariaFixaMensal / 4) : $horasSemana;

                    if ($horasSemana) {

                        $horasPrograma = self::getHorasPrograma($idPlanoAcao);

                        $dias = ceil($horasPrograma / $horasSemana) * 7;
                        $dataFim = strtotime("+$dias days", strtotime($dataInicioEstagio));
                    }

                    //TOTAL
                } elseif ($tipo == "E" || $tipo == "T") {

                    //pegar o maior dia da opção de dias simulados escolhida, e jogar como data final
                    $sql = " SELECT MAX(OPA.dataAula) AS dataAula 
					FROM opcaoDia AS O 
					INNER JOIN opcaoDiaPlanoAcao AS OPA ON OPA.opcaoDia_idOpcao = O.idOpcao
					INNER JOIN valorSimuladoPlanoAcao AS VPA ON VPA.idValorSimuladoPlanoAcao = O.valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao
					WHERE O.escolhido = 1 AND VPA.planoAcao_idPlanoAcao = $idPlanoAcao";
                    $rs = Uteis::executarQuery($sql);
                    $dataFim = strtotime($rs[0]['dataAula']);

                }

            }

            return date('Y-m-d', $dataFim);

        } else {
            return "";
        }
    }

    function getHorasPrograma($idPlanoAcao) {
        $sql = "SELECT horasPrograma FROM planoAcao WHERE idPlanoAcao = $idPlanoAcao";
        $rs = Uteis::executarQuery($sql);
        return $rs[0]['horasPrograma'];
    }

    function verificaStatusAprovacao($idPlanoAcao) {

        if ($idPlanoAcao) {

            $sql = "SELECT SQL_CACHE statusAprovacao_idStatusAprovacao, dataExclusao FROM planoAcao WHERE idPlanoAcao = $idPlanoAcao";
            $rs = Uteis::executarQuery($sql);
            return ($rs[0]['dataExclusao'] || $rs[0]['statusAprovacao_idStatusAprovacao'] != "1") ? true : false;

        } else {
            return false;
        }
    }

}
