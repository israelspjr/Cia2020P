<?php
class Professor extends Database
{
    // class attributes
    var $idProfessor;
    var $id_migracao;
    var $candidato;
    var $paisIdPais;
    var $nome;
    var $nomeExibicao;
    var $sexo;
    var $dataNascimento;
    var $rg;
    var $tipoDocumentoUnicoIdTipoDocumentoUnico;
    var $documentoUnico;
    var $senha;
    var $obs;
    var $inativo;
    var $foto;
    var $inss;
    var $ccm;
    var $curriculum;
    var $otimaPerformance;
    var $altaPerformance;
    var $dataContratacao;
    var $vetado;
    var $indisponivel;
    var $naoreceberemail;
    var $presencial;
    var $online;
    var $tradutor;
    var $consultor;
    var $imersao;
    var $estadoCivilIdEstadoCivil;
    var $excluido;
    var $indicadoPor;
    var $cidadeOrigem;
	var $skype;
	var $deixandoGrupo;
	var $chatClub;
	var $terceiro;
	var $tipoVeto;
	var $expSkype;
	var $dataCadastro;
	var $sobre;
	var $tambemAluno;
	var $clientePjIdClientePj;
	var $dataCapacitacao;
	var $encontro;
	var $dataSegundo;
	var $comprovante;
	var $rgC;

    // constructor
    function __construct()
    {
        parent::__construct();
        $this->idProfessor = "NULL";
        $this->id_migracao = "NULL";
        $this->candidato = "0";
        $this->paisIdPais = "NULL";
        $this->nome = "NULL";
        $this->nomeExibicao = "NULL";
        $this->sexo = "NULL";
        $this->dataNascimento = "NULL";
        $this->rg = "NULL";
        $this->tipoDocumentoUnicoIdTipoDocumentoUnico = "NULL";
        $this->documentoUnico = "NULL";
        $this->senha = "NULL";
        $this->obs = "NULL";
        $this->inativo = "0";
        $this->foto = "NULL";
        $this->inss = "NULL";
        $this->ccm = "NULL";
        $this->curriculum = "NULL";
        $this->otimaPerformance = "0";
        $this->altaPerformance = "0";
        $this->dataContratacao = "NULL";
        $this->vetado = "0";
        $this->indisponivel = "0";
        $this->naoReceberEmail = "0";
        $this->presencial = "0";
        $this->online = "0";
        $this->tradutor = "0";
        $this->consultor = "0";
        $this->imersao = "1";
        $this->estadoCivilIdEstadoCivil = "NULL";
		$this->dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
        $this->excluido = "0";
        $this->indicadoPor = "NULL";
        $this->cidadeOrigem = "NULL";
		$this->skype = "0";
		$this->deixandoGrupo = "0";
		$this->chatClub = "0";
		$this->terceiro = "0";
		$this->tipoVeto = "0";
		$this->expSkype = "0";
		$this->sobre = "NULL";
		$this->tambemAluno = "0";
		$this->clientePjIdClientePj = "NULL";
		$this->dataCapacitacao = "NULL";
		$this->encontro = "0";
		$this->dataSegundo  = "NULL";
		$this->comprovante = "NULL";
		$this->rgC = "NULL";
    }

    function __destruct()
    {
        parent::__destruct();
    }

    // class methods
    function setIdProfessor($value)
    {
        $this->idProfessor = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setId_migracao($value)
    {
        $this->id_migracao = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setCandidato($value)
    {
        $this->candidato = ($value) ? $this->gravarBD($value) : "0";
    }

    function setPaisIdPais($value)
    {
        $this->paisIdPais = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setNome($value)
    {
        $this->nome = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setNomeExibicao($value)
    {
        $this->nomeExibicao = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setSexo($value)
    {
        $this->sexo = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setDataNascimento($value)
    {
        $this->dataNascimento = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setRg($value)
    {
        $this->rg = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setTipoDocumentoUnicoIdTipoDocumentoUnico($value)
    {
        $this->tipoDocumentoUnicoIdTipoDocumentoUnico = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setDocumentoUnico($value)
    {
        $this->documentoUnico = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setSenha($value)
    {
        $value = EncryptSenha::B64_Encode($value);
        $this->senha = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setObs($value)
    {
        $this->obs = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setInativo($value)
    {
        $this->inativo = ($value) ? $this->gravarBD($value) : "0";
    }

    function setFoto($value)
    {
        $this->foto = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setInss($value)
    {
        $this->inss = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setCcm($value)
    {
        $this->ccm = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setCurriculum($value)
    {
        $this->curriculum = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setOtimaPerformance($value)
    {
        $this->otimaPerformance = ($value) ? $this->gravarBD($value) : "0";
    }

    function setAltaPerformance($value)
    {
        $this->altaPerformance = ($value) ? $this->gravarBD($value) : "0";
    }

    function setDataContratacao($value)
    {
        $this->dataContratacao = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setVetado($value)
    {
        $this->vetado = ($value) ? $this->gravarBD($value) : "0";
    }

    function setIndisponivel($value)
    {
        $this->indisponivel = ($value) ? $this->gravarBD($value) : "0";
    }

    function setNaoReceberEmail($value)
    {
        $this->naoReceberEmail = ($value) ? $this->gravarBD($value) : "0";
    }

    function setPresencial($value)
    {
        $this->presencial = ($value) ? $this->gravarBD($value) : "0";
    }

    function setOnline($value)
    {
        $this->online = ($value) ? $this->gravarBD($value) : "0";
    }

    function setTradutor($value)
    {
        $this->tradutor = ($value) ? $this->gravarBD($value) : "0";
    }

    function setConsultor($value)
    {
        $this->consultor = ($value) ? $this->gravarBD($value) : "0";
    }

    function setImersao($value)
    {
        $this->imersao = ($value) ? $this->gravarBD($value) : "0";
    }

    function setEstadoCivilIdEstadoCivil($value)
    {
        $this->estadoCivilIdEstadoCivil = ($value) ? $this->gravarBD($value) : "NULL";
    }
	
	function setDataCadastro($value) {
        //$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setExcluido($value)
    {
        $this->excluido = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setIndicadoPor($value)
    {
        $this->indicadoPor = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setCidadeOrigem($value)
    {
        $this->cidadeOrigem = ($value) ? $this->gravarBD($value) : "NULL";
    }
	
	 function setSkype($value)
    {
        $this->skype = ($value) ? $this->gravarBD($value) : "0";
    }
	
	 function setDeixandoGrupo($value)
    {
        $this->deixandoGrupo = ($value) ? $this->gravarBD($value) : "0";
    }

	 function setChatClub($value)
    {
        $this->chatClub = ($value) ? $this->gravarBD($value) : "0";
    }
	
	 function setTerceiro($value)
    {
        $this->terceiro = ($value) ? $this->gravarBD($value) : "0";
    }
	
	 function setTipoVeto($value)
    {
        $this->tipoVeto = ($value) ? $this->gravarBD($value) : "0";
    }
	
	 function setExpSkype($value)
    {
        $this->expSkype = ($value) ? $this->gravarBD($value) : "0";
    }
	
	function setSobre($value)
    {
        $this->sobre = ($value) ? $this->gravarBD($value) : "NULL";
    }
	
	function setTambemAluno($value)
    {
        $this->tambemAluno = ($value) ? $this->gravarBD($value) : "0";
    }
	
	function setClientePjIdClientePj($value)
    {
        $this->clientePjIdClientePj = ($value) ? $this->gravarBD($value) : "NULL";
    }
	
	function setDataCapacitacao($value)
    {
        $this->dataCapacitacao = ($value) ? $this->gravarBD($value) : "NULL";
    }

	function setDataSegundo($value)
    {
        $this->dataSegundo = ($value) ? $this->gravarBD($value) : "NULL";
    }
	
	function setEncontro($value)
    {
        $this->encontro = ($value) ? $this->gravarBD($value) : "0";
    }
	
	function setRgC($value)
    {
        $this->rgC = ($value) ? $this->gravarBD($value) : "0";
    }
	
	function setComprovante($value)
    {
        $this->comprovante = ($value) ? $this->gravarBD($value) : "0";
    }


    /**
     * addProfessor() Function
     */
    function addProfessor()
    {
        $sql = "INSERT INTO professor (id_migracao, candidato, pais_idPais, nome, nomeExibicao, sexo, dataNascimento, rg, tipoDocumentoUnico_idTipoDocumentoUnico, documentoUnico, senha, obs, inativo, foto, inss, ccm, curriculum, otimaPerformance, altaPerformance, dataContratacao, vetado, indisponivel, presencial, online, tradutor, consultor, imersao, estadoCivil_idEstadoCivil, dataCadastro, excluido, indicadoPor, cidadeOrigem, naoReceberEmail, skype, deixandoGrupo, chatClub, terceiro, tipoVeto, expSkype, sobre, tambemAluno, clientePj_idClientePj, dataCapacitacao, encontro, dataSegundo, rgC, comprovante) VALUES ($this->id_migracao, $this->candidato, $this->paisIdPais, $this->nome, $this->nomeExibicao, $this->sexo, $this->dataNascimento, $this->rg, $this->tipoDocumentoUnicoIdTipoDocumentoUnico, $this->documentoUnico, $this->senha, $this->obs, $this->inativo, $this->foto, $this->inss, $this->ccm, $this->curriculum, $this->otimaPerformance, $this->altaPerformance, $this->dataContratacao, $this->vetado, $this->indisponivel, $this->presencial, $this->online, $this->tradutor, $this->consultor, $this->imersao, $this->estadoCivilIdEstadoCivil, $this->dataCadastro, $this->excluido, $this->indicadoPor, $this->cidadeOrigem, $this->naoReceberEmail, $this->skype, $this->deixandoGrupo, $this->chatClub, $this->terceiro, $this->tipoVeto, $this->expSkype, $this->sobre, $this->tambemAluno, $this->clientePjIdClientePj, $this->dataCapacitacao, $this->encontro, $this->dataSegundo, $this->rgC, $this->comprovante)";
//		echo $sql;
        $result = $this->query($sql, true);
        return mysqli_insert_id($this->connect);
    }

    /**
     * deleteProfessor() Function
     */
    function deleteProfessor()
    {
        $sql = "DELETE FROM professor WHERE idProfessor = $this->idProfessor";
        $result = $this->query($sql, true);
    }

    /**
     * updateFieldProfessor() Function
     */
    function updateFieldProfessor($field, $value)
    {
        $value = ($value != "NULL") ? $this->gravarBD($value) : $value;
        if ($field != "candidato") {
            $sql = "UPDATE professor SET " . $field . " = " . $value . " WHERE idProfessor = $this->idProfessor";
            $result = $this->query($sql, true);
        }
    }

    /**
     * updateProfessor() Function
     */
    function updateProfessor()
    {
        $sql = "UPDATE professor SET id_migracao = $this->id_migracao, candidato = $this->candidato, pais_idPais = $this->paisIdPais, nome = $this->nome, nomeExibicao = $this->nomeExibicao, sexo = $this->sexo, dataNascimento = $this->dataNascimento, rg = $this->rg, tipoDocumentoUnico_idTipoDocumentoUnico = $this->tipoDocumentoUnicoIdTipoDocumentoUnico, documentoUnico = $this->documentoUnico, senha = $this->senha, obs = $this->obs, inativo = $this->inativo, foto = $this->foto, inss = $this->inss, ccm = $this->ccm, curriculum = $this->curriculum, otimaPerformance = $this->otimaPerformance, altaPerformance = $this->altaPerformance, dataContratacao = $this->dataContratacao, vetado = $this->vetado, indisponivel = $this->indisponivel, presencial = $this->presencial, online = $this->online, tradutor = $this->tradutor, consultor = $this->consultor, imersao = $this->imersao, estadoCivil_idEstadoCivil = $this->estadoCivilIdEstadoCivil, excluido = $this->excluido, indicadoPor = $this->indicadoPor, cidadeOrigem = $this->cidadeOrigem, naoReceberEmail = $this->naoReceberEmail, skype = $this->skype, deixandoGrupo = $this->deixandoGrupo, chatClub = $this->chatClub, terceiro = $this->terceiro, tipoVeto = $this->tipoVeto, expSkype = $this->expSkype, sobre = $this->sobre, tambemAluno = $this->tambemAluno, clientePj_idClientePj = $this->clientePjIdClientePj, dataCapacitacao = $this->dataCapacitacao, encontro = $this->encontro, dataSegundo = $this->dataSegundo, rgC = $this->rgC, comprovante = $this->comprovante WHERE idProfessor = $this->idProfessor";
	//	echo $sql;
        $result = $this->query($sql, true);
    }

    /**
     * selectProfessor() Function
     */
    function selectProfessor($where = "WHERE 1")
    {
        $sql = "SELECT SQL_CACHE idProfessor, id_migracao, candidato, pais_idPais, nome, nomeExibicao, sexo, dataNascimento, rg, tipoDocumentoUnico_idTipoDocumentoUnico, documentoUnico, senha, obs, inativo, foto, inss, ccm, curriculum, otimaPerformance, altaPerformance, dataContratacao, vetado, indisponivel, presencial, online, tradutor, consultor, imersao, estadoCivil_idEstadoCivil, dataCadastro, excluido, indicadoPor, cidadeOrigem, naoReceberEmail, skype, deixandoGrupo, chatClub, terceiro, tipoVeto, expSkype, sobre, tambemAluno, clientePj_idClientePj, dataCapacitacao, encontro, dataSegundo, rgC, comprovante FROM professor " . $where;
    //    echo $sql;
        return $this->executeQuery($sql);
    }

    /**
     * selectProfessorCandidatoTr() Function
     */

    function selectProfessorCandidatoTr($where = "", $apenasLinha = false, $idIdioma)
    {
		$ComoConheceu = new ComoConheceu();
		$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();
		$Idioma = new Idioma();
		$NivelLinguistico = new NivelLinguistico();
	
		if ($idIdioma != '') {
			$and = ", PS.idioma_idIdioma ";	
		}
        $sql = "SELECT SQL_CACHE P.idProfessor, P.nome, P.presencial, P.online, P.indicadoPor, P.documentoUnico, P.dataCadastro, PS.idProcessoSeletivoProfessor, PS.regiaoAtende, PS.notaTeste, PS.contratoAssinado, PS.dataContrato, PS.integracao, PS.assistiu, PS.trilha, PS.dataTrilha, PS.dataIntegracao, PS.analiseFinal, PS.dataNivel, PS.idNivel, PS.oralFinal, PS.analiseC, PS.dataC, PS.dataP, PS.analiseP ".$and. " FROM professor AS P
		LEFT JOIN processoSeletivoProfessor AS PS ON PS.professor_idProfessor = P.idProfessor
		WHERE P.excluido = 0 " . $where;
		if ($idIdioma != '') {
			$sql .= " AND PS.idioma_idIdioma = ".$idIdioma;
		}
		$sql .= " GROUP BY idProfessor";

        $result = $this->query($sql);
		
//		Uteis::pr($result);

        if (mysqli_num_rows($result) > 0) {

            $html = "";
            $cont = 0;

            $caminhoAtualizar = CAMINHO_CAD . "professor/candidato/index.php";

            while ($valor = mysqli_fetch_array($result)) {

                $idProfessor = $valor['idProfessor'];
                $nome = $valor['nome'];
                $documentoUnico = $valor['documentoUnico'];
				$dataCadastro = Uteis::exibirData($valor['dataCadastro']);
				$presencial = $valor['presencia'];
				$online = $valor['online'];
				$idPSP = $valor['idProcessoSeletivoProfessor'];
				$modalidade = "";
				
				if  ($presencial == 1) {
					$modalidade = "Presencial";
				}
				if ($online == 1) {
					$modalidade .= "<br>On-line";	
				}
				
				//Como Conheceu
				$comoConheceu = $ComoConheceu->getNome($valor['indicadoPor']);
				
				//Região Atende
				$regiaoAtende = $valor['regiaoAtende'];
				
				//Contrato Assinado
				$dataContrato = Uteis::exibirData($valor['dataContrato']);
				$contratoAssinado = $valor['contratoAssinado'];
				
				//Integração
				$integracao = $valor['integracao'];
				$dataIntegracao = Uteis::exibirData($valor['dataIntegracao']);
				
				// Assistiu
				$assistiu = $valor['assistiu'];
				
				//Trilha
				$dataTrilha = Uteis::exibirData($valor['dataTrilha']);
				$trilha = $valor['trilha'];
				
				//Analise Final
				$analiseFinal = $valor['analiseFinal'];
				
				//Linguistico
				$dataLinguistico = Uteis::exibirData($valor['dataNivel']);
				$nomeNivel = $NivelLinguistico->getNome($valor['idNivel']);
				$statusOral = $valor['oralFinal'];
				
				//Comportamental
				$dataC = Uteis::exibirData($valor['dataC']);
				$analiseC = $valor['analiseC'];
				
				//Pedagógico
				$dataP = Uteis::exibirData($valor['dataP']);
				$analiseP = $valor['analiseP'];
			
                $onclick = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/candidato/cadastro.php?id=" . $idProfessor . "', '" . $caminhoAtualizar . "?tr=1&idProfessor=" . $idProfessor . "&ordem=" . ($cont++) . "', 'tr')\" ";
				
				$onclickR = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/candidato/regiaoAtende.php?id=" . $idProfessor . "', '" . $caminhoAtualizar . "?tr=1&idProfessor=" . $idProfessor . "&ordem=" . ($cont - 1) . "', 'tr')\" ";
				
				$onclickC = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/candidato/contratoAssinado.php?id=" . $idProfessor . "', '" . $caminhoAtualizar . "?tr=1&idProfessor=" . $idProfessor . "&ordem=" . ($cont - 1) . "', 'tr')\" ";
				
				$onclickI = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/candidato/integracao.php?id=" . $idProfessor . "', '" . $caminhoAtualizar . "?tr=1&idProfessor=" . $idProfessor . "&ordem=" . ($cont - 1) . "', 'tr')\" ";
				
				$onclickA = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/candidato/assistiu.php?id=" . $idProfessor . "', '" . $caminhoAtualizar . "?tr=1&idProfessor=" . $idProfessor . "&ordem=" . ($cont - 1) . "', 'tr')\" ";
				
				$onclickT = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/candidato/trilha.php?id=" . $idProfessor . "', '" . $caminhoAtualizar . "?tr=1&idProfessor=" . $idProfessor . "&ordem=" . ($cont - 1) . "', 'tr')\" ";
				
				$onclickF = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/candidato/analiseFinal.php?id=" . $idProfessor . "', '" . $caminhoAtualizar . "?tr=1&idProfessor=" . $idProfessor . "&ordem=" . ($cont - 1) . "', 'tr')\" ";
				
				$onclickAv = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/candidato/avaliacaoOralNivel.php?id=" . $idProfessor . "', '" . $caminhoAtualizar . "?tr=1&idProfessor=" . $idProfessor . "&ordem=" . ($cont - 1) . "', 'tr')\" ";
				
				$onclickCo = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/candidato/comportamental.php?id=" . $idProfessor . "', '" . $caminhoAtualizar . "?tr=1&idProfessor=" . $idProfessor . "&ordem=" . ($cont - 1) . "', 'tr')\" ";
				
				$onclickP = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/candidato/pedagogico.php?id=" . $idProfessor . "', '" . $caminhoAtualizar . "?tr=1&idProfessor=" . $idProfessor . "&ordem=" . ($cont - 1) . "', 'tr')\" ";
				
				$onclickQ = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/candidato/quadro.php?id=" . $idProfessor . "', '" . $caminhoAtualizar . "?tr=1&idProfessor=" . $idProfessor . "&ordem=" . ($cont - 1) . "', 'tr')\" ";
				
				$onclickQ2 = '<input type="checkbox" name="idh[]" value="'.$idPSP.'" title="Selecionar esta caixa para alteração múltipla">';
				
				$onclickQ3 = '<input type="checkbox" name="idhC[]" value="'.$idPSP.'" title="Selecionar esta caixa para alteração múltipla">';
				
                $delete = "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"
				onclick=\"deletaRegistro('" . CAMINHO_CAD . "professor/include/acao/professor.php', '" . $idProfessor . "', '" . $caminhoAtualizar . "', '#centro')\" /></center>";

				$idIdioma = $ProcessoSeletivoProfessor->getIdIdioma($valor['idProcessoSeletivoProfessor']);
				if ($idIdioma != '') {
					$nomeIdioma = $Idioma->getNome($idIdioma);	
				}
				$notaTeste = $nomeIdioma." ".$valor['notaTeste'];
			
                    $telefones = " ";
                    $sql = " SELECT ddd, numero FROM telefone /*INNER JOIN descricaoTelefone AS DT ON descricaoTelefone_idDescricaoTelefone = DT.idDescricaoTelefone */ WHERE professor_idProfessor = " . $valor['idProfessor'];
                    $rsTelefone = $this->query($sql);
                    if (mysqli_num_rows($rsTelefone) > 0) {
                        while ($valorTelefone = mysqli_fetch_array($rsTelefone)) {
                            $telefones .= " <div class=\"destacaLinha\"> [" . $valorTelefone['nome'] . "] (" . $valorTelefone['ddd'] . ") " . $valorTelefone['numero'] . "</div>";
                        }
                    }

                    $emails = " ";
                    $sql = " SELECT valor FROM enderecoVirtual INNER JOIN tipoEnderecoVirtual AS TEV on TEV.idTipoEnderecoVirtual = tipoEnderecoVirtual_idTipoEnderecoVirtual WHERE TEV.idTipoEnderecoVirtual = 1 AND professor_idProfessor = " . $valor['idProfessor'];
                    $rsEmail = $this->query($sql);
                    if (mysqli_num_rows($rsEmail) > 0) {
                        while ($valorEmail = mysqli_fetch_array($rsEmail)) {
                            $emails .= " <div class=\"destacaLinha\">" . $valorEmail['valor'] . "</div>";
                        }
                    }

                    $skype = " ";
                    $sql = " SELECT valor FROM enderecoVirtual INNER JOIN tipoEnderecoVirtual AS TEV.idTipoEnderecoVirtual = tipoEnderecoVirtual_idTipoEnderecoVirtual WHERE TEV.idTipoEnderecoVirtual = 9 AND professor_idProfessor = " . $valor['idProfessor'];
                    $rsSkype = $this->query($sql);
                    if (mysqli_num_rows($rsSkype) > 0) {
                        while ($valorSkype = mysqli_fetch_array($rsSkype)) {
                            $skype .= " <div class=\"destacaLinha\">" . $valorSkype['valor'] . "</div>";
                        }
                    }
        //        }

                if ($apenasLinha) {

                    $col = array();

                    $col[] = $nome;
                    $col[] = $dataCadastro;
                    $col[] = $telefones. $emails;
                    $col[] = "<img $onclickQ src=\"" . CAMINHO_IMG . "editar.png\"/>".$quadro. $onclickQ2;
					$col[] = $notaTeste;
				
				/*	$col[] = $espanhol; */
					$col[] = $modalidade;
					$col[] = "<img src=\"" . CAMINHO_IMG . "editar.png\"/>".$regiaoAtende;
					$col[] = $comoConheceu;
					$col[] = "<img src=\"" . CAMINHO_IMG . "editar.png\"/>".$onclickQ3.Uteis::exibirStatusA($analiseC)." ".$dataC;
					$col[] = "<img src=\"" . CAMINHO_IMG . "editar.png\"/>".Uteis::exibirStatusA($statusOral)." ".$dataLinguistico." ".$nomeNivel;
					$col[] = "<img src=\"" . CAMINHO_IMG . "editar.png\"/>".Uteis::exibirStatusA($analiseP)." ".$dataP;
				    $col[] = "<img src=\"" . CAMINHO_IMG . "editar.png\"/>".Uteis::exibirStatusA($analiseFinal); 
					$col[] = "<img src=\"" . CAMINHO_IMG . "editar.png\"/>".$dataTrilha." ".Uteis::exibirStatusA($trilha);
				//	$col[] = "<img src=\"" . CAMINHO_IMG . "editar.png\"/>".Uteis::exibirStatus($assistiu);
					$col[] = "<img src=\"" . CAMINHO_IMG . "editar.png\"/>".$dataIntegracao." ".Uteis::exibirStatusA($integracao);
				    $col[] = "<img src=\"" . CAMINHO_IMG . "editar.png\"/>".$dataContrato." ".Uteis::exibirStatusA($contratoAssinado); 
					
					$col[] = $delete;
                    $html = $col;
                    break;

                } else {

                    $html .= "<tr>";

                    //NOME
                    $html .= "<td $onclick >" . $nome . "</td>";

                    //contatos
                    $html .= "<td>" . $dataCadastro . "</td>";
                    $html .= "<td>" . $telefones .$emails. "</td>";
                    $html .= "<td ><img $onclickQ src=\"" . CAMINHO_IMG . "editar.png\"/>" .  $quadro. $onclickQ2."</td>";
					$html .= "<td>" . $notaTeste . "</td>";
                    $html .= "<td >" . $modalidade . "</td>";
					$html .= "<td $onclickR><img src=\"" . CAMINHO_IMG . "editar.png\"/>" .  $regiaoAtende. "</td>";
					$html .= "<td>" . $comoConheceu . "</td>";
					$html .= "<td ><img $onclickCo src=\"" . CAMINHO_IMG . "editar.png\"/>" .$onclickQ3.Uteis::exibirStatusA($analiseC)." ". $dataC."</td>";
					$html .= "<td $onclickAv><img src=\"" . CAMINHO_IMG . "editar.png\"/>" .Uteis::exibirStatusA($statusOral)." ". $dataLinguistico." ".$nomeNivel . "</td>";
					$html .= "<td $onclickP><img src=\"" . CAMINHO_IMG . "editar.png\"/>" .Uteis::exibirStatusA($analiseP)." ". $dataP."</td>";
					$html .= "<td $onclickF><img src=\"" . CAMINHO_IMG . "editar.png\"/>" . Uteis::exibirStatusA($analiseFinal) . "</td>"; 
					$html .= "<td $onclickT><img src=\"" . CAMINHO_IMG . "editar.png\"/>" .$dataTrilha." ". Uteis::exibirStatusA($trilha) . "</td>";
				//	$html .= "<td $onclickA><img src=\"" . CAMINHO_IMG . "editar.png\"/>" . Uteis::exibirStatus($assistiu) . "</td>";
					$html .= "<td $onclickI><img src=\"" . CAMINHO_IMG . "editar.png\"/>" .$dataIntegracao." ". Uteis::exibirStatusA($integracao) . "</td>";
					$html .= "<td $onclickC><img src=\"" . CAMINHO_IMG . "editar.png\"/>".$dataContrato ." ". Uteis::exibirStatusA($contratoAssinado). "</td>"; 

                    $html .= "<td >" . $delete . "</td>";

                    $html .= "</tr>";
                }
            }
        }
        return $html;
    }

    function selectProfessorContratadoTr($where = "", $apenasLinha = false, $comGrupo = "", $menor5grupos="", $excel = false, $terceiro = 0)
    {
        $html = "";
        $sql = "SELECT SQL_CACHE distinct(P.idProfessor), P.nome, P.inativo, P.otimaPerformance, P.altaPerformance, P.vetado, P.indisponivel, P.obs, P.skype, P.deixandoGrupo, P.chatClub, P.terceiro, P.presencial FROM professor as P
				WHERE P.candidato = 0 AND P.terceiro = ".$terceiro." " . $where;
 //        echo $sql;
        $result = $this->query($sql);

        $IdiomaProfessor = new IdiomaProfessor();
        $NivelLinguistico = new NivelLinguistico();
        $Disponibilidade = new DisponibilidadeProfessor();
		$AulaPermanenteGrupo = new AulaPermanenteGrupo();
		$Relatorio = new Relatorio();

        if (mysqli_num_rows($result) > 0) {

            $html = "";
            $cont = 0;

            $caminhoAtualizar_base = CAMINHO_CAD . "professor/contratado/index.php";

            while ($valor = mysqli_fetch_array($result)) {

                $idProfessor = $valor['idProfessor'];
                $nome = $valor['nome'];
                $documentoUnico = $valor['documentoUnico'];
				if (!$excel) {
                	$ativo = Uteis::exibirStatus(!$valor['inativo']);
				} else {
					if($valor['inativo'] == 0) {
						$ativo = "Não";
					} else {
						$ativo = "Sim";
					}
				}
                $obs = $valor['obs'];
                $marca = "";
                if ($valor['vetado'] == 1):
                    $marca = Uteis::StatusProfessor($valor['vetado'], "vetado");
                else:
                    if ($valor['altaPerformance']):
                        $marca = Uteis::StatusProfessor($valor['altaPerformance'], "alta");
                    else:
                        if ($valor['otimaPerformance']):
                            $marca = Uteis::StatusProfessor($valor['otimaPerformance'], "otima");
                        endif;
                    endif;
                endif;
				
				if ($valor['presencial'] == 1) {
				$marca .= "&nbsp;&nbsp;<strong > P</strong>";	
				}
				
				$marca .= Uteis::StatusProfessor($valor['skype'], "skype");
				$marca .= " ".Uteis::StatusProfessor($valor['deixandoGrupo'], "mao2");
				$marca .= " ".Uteis::StatusProfessor($valor['terceiro'], "terceiro");

                $cor = "";
                if ($valor['indisponivel'] == 1) $cor = "style='color:#aa0000;font-style:italic;'";

                $caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idProfessor=" . $idProfessor;
                if ($apenasLinha !== false) {
                    $caminhoAtualizar .= "&ordem=" . $apenasLinha;
                } else {
                    $caminhoAtualizar .= "&ordem=" . ($cont++);
                }
				
				if (!$excel) {
                	$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $idProfessor . "', '" . $caminhoAtualizar . "', 'tr')\" ";			
				}

  				if (!$excel) {
                	$delete = "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"
				onclick=\"deletaRegistro('" . CAMINHO_CAD . "professor/include/acao/professor.php', '" . $idProfessor . "', '" . $caminhoAtualizar . "', 'tr')\" /></center>";
				}
				
                $idioma = "";
                $sql = " SELECT DISTINCT(I.idioma), idIdiomaProfessor FROM idiomaProfessor AS IP
				INNER JOIN idioma AS I ON I.idIdioma = IP.Idioma_idIdioma
				WHERE IP.inativo = 0 AND professor_idProfessor = " . $idProfessor;
                $rsIdioma = $this->query($sql);
                if (mysqli_num_rows($rsIdioma) > 0) {
                    while ($valorIdioma = mysqli_fetch_array($rsIdioma)) {
						
						$sql2 = " SELECT PCI.idPlanoCarreirraIdiomaProfessor, PCI.mesIni, PCI.anoIni, PCI.mesFim, PCI.anoFim, PC.plano, PC.descricao, IP.idIdiomaProfessor
		FROM planoCarreirraIdiomaProfessor AS PCI 
		INNER JOIN idiomaProfessor AS IP ON IP.idIdiomaProfessor = PCI.idiomaProfessor_idIdiomaProfessor 
		INNER JOIN planoCarreirra AS PC ON PC.idPlanoCarreira = PCI.planoCarreirra_idPlanoCarreira WHERE PCI.mesFim IS NULL AND PCI.anoFim IS NULL AND IP.idIdiomaProfessor = ".$valorIdioma['idIdiomaProfessor']." ORDER BY PCI.anoIni DESC, PCI.mesIni DESC ";
		
		$result2 = $this -> query($sql2);

		$html2 = "";
		if (mysqli_num_rows($result2) > 0) {
			while ($valor2 = mysqli_fetch_array($result2)) {
				
				$html2 = "R$".Uteis::formatarMoeda($valor2['plano']);
					}
				}
                       $idioma .= "<div class=\"destacaLinha\">" . $valorIdioma['idioma'] . "<br>".$html2."</div>";
					}
                }
                $totalGrupos = 0;
                if ($comGrupo != "") {
                    $grupos = " ";
                    $sql = " SELECT DISTINCT(G.nome) AS grupo, PAG.idPlanoAcaoGrupo FROM professor AS P
				INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
				LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
				LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
				INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND
					(PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
				INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo AND G.inativo = 0
				WHERE ( AGP.dataFim >= CURDATE() OR AGP.dataFim IS NULL OR AGP.dataFim = '') AND P.idProfessor = " . $idProfessor;
                    $rsGrupos = $this->query($sql);
                    $totalGrupos = 0;
                    if (mysqli_num_rows($rsGrupos) > 0) {
                        while ($valorGrupo = mysqli_fetch_array($rsGrupos)) {
							
							$sql2 = "SELECT distinct(idAulaPermanenteGrupo) 
			FROM aulaGrupoProfessor AS AGP
			LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa AND AF.excluido = 0
			LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
			INNER JOIN planoAcaoGrupo AS PAG ON
			PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo
			WHERE PAG.idPlanoAcaoGrupo =" . $valorGrupo['idPlanoAcaoGrupo'] ." AND AP.dataFim is null";
	
		$rs = $this -> query($sql2);	
		$dia = "";
		 if (mysqli_num_rows($rs) > 0) {
			while ($valors = mysqli_fetch_array($rs)) {
		$dia .= $AulaPermanenteGrupo->montaDias($valors['idAulaPermanenteGrupo'])."&#013";
		$diaTmp = $AulaPermanenteGrupo->montaDias($valors['idAulaPermanenteGrupo'])."<br>";
			}
		 }
							
                            $grupos .= " <div title=\"$dia\" class=\"destacaLinha\"
						    onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=" . $valorGrupo['idPlanoAcaoGrupo'] . "', '$caminhoAtualizar', 'tr')\">" . $valorGrupo['grupo'] . "</div>";
                            $totalGrupos++;
                        }
                    }
                }
                $telefones = " ";
                $sql = " SELECT ddd, numero, DT.nome FROM telefone INNER JOIN descricaoTelefone AS DT ON descricaoTelefone_idDescricaoTelefone = DT.idDescricaoTelefone WHERE professor_idProfessor = " . $valor['idProfessor'];
                $rsTelefone = $this->query($sql);
                if (mysqli_num_rows($rsTelefone) > 0) {
                    while ($valorTelefone = mysqli_fetch_array($rsTelefone)) {
                        $telefones .= " <div class=\"destacaLinha\"> [" . $valorTelefone['nome'] . "] (" . $valorTelefone['ddd'] . ") " . $valorTelefone['numero'] . "</div>";
                    }
                }

                $emails = " ";
                $sql = " SELECT valor FROM enderecoVirtual INNER JOIN tipoEnderecoVirtual AS TEV ON TEV.idTipoEnderecoVirtual = tipoEnderecoVirtual_idTipoEnderecoVirtual WHERE TEV.idTipoEnderecoVirtual = 1 AND professor_idProfessor = " . $valor['idProfessor'];
                $rsEmail = $this->query($sql);
                if (mysqli_num_rows($rsEmail) > 0) {
                    while ($valorEmail = mysqli_fetch_array($rsEmail)) {
                        $emails .= " <div class=\"destacaLinha\">" . $valorEmail['valor'] . "</div>";
                    }
                }

                $nivelF = " ";
                $valorIdiomaProfessor = $IdiomaProfessor->selectIdiomaProfessor("where professor_idProfessor =" . $valor['idProfessor']);

                $idNivelLinguistico = $valorIdiomaProfessor[0]['nivelLinguistico_idNivelLinguistico'];

                $valorNivelLinguistico = $NivelLinguistico->selectNivelLinguistico("where idNivelLinguistico = " . $idNivelLinguistico);

                $nivelF = $valorNivelLinguistico[0]['nivel'];

                $skype = " ";
                $sql = " SELECT valor FROM enderecoVirtual INNER JOIN tipoEnderecoVirtual AS TEV ON TEV.idTipoEnderecoVirtual = tipoEnderecoVirtual_idTipoEnderecoVirtual WHERE TEV.idTipoEnderecoVirtual = 9 AND professor_idProfessor = " . $valor['idProfessor'];
                $rsSkype = $this->query($sql);
                if (mysqli_num_rows($rsSkype) > 0) {
                    while ($valorSkype = mysqli_fetch_array($rsSkype)) {
                        $skype .= " <div class=\"destacaLinha\">" . $valorSkype['valor'] . "</div>";
                    }
                }

                if ($apenasLinha !== false) {

                    $col = array();

                    $col[] = $nome;
                    $col[] = $idioma;
                    $col[] = $nivelF;
                    $col[] = $telefones;
                    $col[] = $emails;
                    $col[] = $skype;
                    $col[] = $grupos;
                    $col[] = $ativo;
                    $col[] = $delete . $obs;

                    $html = $col;
                    break;

                } else {

                    $htmlver = "<tr>";
                    //NOME
                    $htmlver .= "<td $onclick $cor>" . $nome . $marca . "</td>";
                    //IDIOMA
                    $htmlver .= "<td>" . $idioma . "</td>";
                    //Nivel
                    $htmlver .= "<td>" . $nivelF . "</td>";
                    //CONTATOS
                    $htmlver .= "<td>" . $telefones . "</td>";
                    $htmlver .= "<td>" . $emails . "</td>";
                    $htmlver .= "<td>" . $skype . "</td>";
                    //GRUPOS
                    $htmlver .= "<td >" . $grupos . "</td>";
                    //STATUS
                    $htmlver .= "<td onclick >" . $ativo . "</td>";
                    $htmlver .= "<td >" . $delete . $obs . "</td>";
                    $htmlver .= "</tr>";
					
					

                    if (($menor5grupos == 1) AND ($totalGrupos < 5)) {
                        $html .= $htmlver;
                    }elseif ($menor5grupos == 0) {
                        $html .= $htmlver;
                    	
					}
                }
            }
        }
		
		if ($excel) {
						
						$colunas = array("Nome", "Idioma", "Nivel", "Telefone", "Email", "Skype", "Grupos", "Inativo", "Obs");
						$html_base = $Relatorio -> montaTb($colunas, $excel);

    					$html2 = $html_base . $html;
						
						return $html2;
						
					} else {

        				return $html;
					}
    }

    /**
     * Select para Trazer os professores ativos e grupos na tela de demonstrativo de pagamento
     */

    function selectProfessorAtivoGrupo($idProfessor = "", $mes, $ano, $caminhoAtualizar)
    {
        /*Desmembrando a Data*/

        $FechamentoGrupo = new FechamentoGrupo();
        $PlanoAcaoGrupo = new PlanoAcaoGrupo();


        $x = date("Y-m-d", mktime(0, 0, 0, $mes + 1, 0, $ano));

        if ($mes < 10)
            $mes = "0" . $mes;

        $sql = "SELECT distinct(P.nome), P.idProfessor FROM professor AS P
		 INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
		 LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
		 LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
		 INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
		 INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo /* AND G.inativo = 0 */
		 WHERE ((AGP.dataFim >= '" . $ano . "-" . $mes . "-01' AND AGP.dataFim <= '" . $x . "') or AGP.dataFim is null OR AGP.dataFim >= '" . $x . "' ) AND idProfessor=" . $idProfessor . " order by P.idProfessor";
        $result = $this->query($sql);
//		 echo $sql;

        if (mysqli_num_rows($result) > 0) {
            $html = "";
            while ($valor = mysqli_fetch_array($result)) {
                $idProfessor = $valor['idProfessor'];
                $html .= "<tr>";
                $onclick = " <img src=\"".CAMINHO_IMG."cad.png\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $idProfessor . "', '$caminhoAtualizar', '$onde')\" >";
                $html .= "<td >" . $valor['nome'] . $onclick."</td>";

                $sql2 = "SELECT distinct(P.nome), P.idProfessor, G.nome AS grupo, G.idGrupo, G.inativo FROM professor AS P
		 INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
		 LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
		 LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
		 INNER JOIN planoAcaoGrupo AS PAG ON /*PAG.inativo = 0 AND*/ (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
		 INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo /*AND G.inativo = 0 */
		 WHERE ((AGP.dataFim >= '" . $ano . "-" . $mes . "-01' AND AGP.dataFim <= '" . $x . "') or AGP.dataFim is null OR AGP.dataFim >= '" . $x . "' ) AND idProfessor=" . $idProfessor . " order by P.idProfessor";
                //	 echo $sql2;
                $result2 = $this->query($sql2);

                $html .= "<td>";

                while ($valor2 = mysqli_fetch_array($result2)) {

                    if ($valor2['inativo'] == 0) {

                        $PagAtual = $PlanoAcaoGrupo->getPAG_atual($valor2['idGrupo']);

                        $valorNP = $FechamentoGrupo->selectFechamentoGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo =" . $PagAtual);

                        $dataFechamento = "";

                        if ($valorNP[0]['dataFechamento'] != "") {

                            $dataFechamento = date("Y-m-d", strtotime($valorNP[0]['dataFechamento']));
                        }

                        if (($dataFechamento >= $ano . "-" . $mes . "-01") || ($valorNP[0]['dataFechamento'] == "")) {
							
							 $onclick = " <img src=\"".CAMINHO_IMG."cad.png\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=" . $PagAtual . "', '$caminhoAtualizar', '$onde')\" >";


                            $html .= $valor2['grupo'] . $onclick;
                            $html .= "<br>";

                        }


                    }
                }
                $html .= "</td>";

                $html .= "</tr>";
            }

        }
        return $html;
    }

    /**
     * selectProfessorContratadoTr() Function
     */

    function selectProfessorDadosHorasTr($idProfessor)
    {
        $sql = "SELECT SQL_CACHE g.nome, (vhg.valorHora - IF(vhg.valorDescontohora is null, 0, vhg.valorDescontohora)) as valor, horaRealizada
		FROM grupo g
		INNER JOIN planoAcaoGrupo pag ON g.idGrupo = pag.grupo_idGrupo
		INNER JOIN valorHoraGrupo vhg ON pag.idPlanoAcaoGrupo = vhg.planoAcaoGrupo_idPlanoAcaoGrupo
		INNER JOIN folhaFrequencia ff ON pag.idPlanoAcaoGrupo = ff.planoAcaoGrupo_idPlanoAcaoGrupo
		INNER JOIN diaAulaFF daff ON ff.idFolhaFrequencia = daff.folhaFrequencia_idFolhaFrequencia
		WHERE ff.professor_idProfessor = " . $idProfessor . " AND horaRealizada > 0
		ORDER BY daff.dataAula";

        $result = $this->query($sql);

        $valorTotal = 0;
        if (mysqli_num_rows($result) > 0) {
            $html = "";
            while ($valor = mysqli_fetch_array($result)) {
                $html .= "<tr>";
                $html .= "<td>" . $valor['nome'] . "</td>";
                $html .= "<td>" . $valor['horaRealizada'] . "</td>";
                $html .= "<td>" . $valor['valor'] . "</td>";
                $valor = number_format(($valor['horaRealizada'] / 60) * $valor['valor'], 2, ',', '');
                $valorTotal += $valor;
                $html .= "<td>R$ " . $valor . "</td>";
                $html .= "</tr>";
            }

        }
        $html .= "<input type=\"hidden\" name=\"valorTotal\" id=\"valorTotal\" value=\"" . number_format($valorTotal, 2, ',', '') . "\">";

        return $html;
    }

    function selectProfessorContratadoTr_retornoBusca($where = "", $idIdioma, $idBuscaProfessor, $acao, $param, $lucro = array(), $data, $idPlanoAcaoGrupo = "")
    {

        $IdiomaProfessor = new IdiomaProfessor();
        $NivelLinguistico = new NivelLinguistico();
        $html = "";

        $sql = " SELECT DISTINCT(P.idProfessor) AS idProfessor, P.nome, P.inativo, P.otimaPerformance, P.altaPerformance, P.vetado, P.indisponivel, n.idNivelLinguistico, P.skype, P.deixandoGrupo, P.presencial, P.terceiro /*, E.cidade_idCidade,
    E.bairro */
		FROM professor AS P
		INNER JOIN idiomaProfessor AS I ON I.inativo = 0 AND I.professor_idProfessor = P.idProfessor
		LEFT JOIN nivelLinguistico n ON n.idNivelLinguistico = I.nivelLinguistico_idNivelLinguistico
		LEFT JOIN localAulaProfessor LA ON LA.professor_idProfessor = P.idProfessor
		LEFT JOIN opcaoAtividadeExtraProfessor AS OAE ON OAE.professor_idProfessor = P.idProfessor
		LEFT JOIN atividadeExtraProfessor AS AE ON AE.idAtividadeExtraProfessor = OAE.atividadeExtraProfessor_idAtividadeExtraProfessor
		LEFT JOIN endereco as E ON E.professor_idProfessor = P.idProfessor
		WHERE P.candidato = 0 AND P.inativo = 0 /*AND /*E.excluido = 0*/ AND I.Idioma_idIdioma = $idIdioma " . $where;
 //      echo $sql;

        $result = $this->query($sql);
        if ($acao == "apenas ids") {

            $idProfessor = array("0");
            while ($valor = mysqli_fetch_array($result))
                $idProfessor[] = $valor['idProfessor'];
            return implode(",", $idProfessor);

        } elseif (mysqli_num_rows($result) > 0) {

            while ($valor = mysqli_fetch_array($result)) {
                $marca = "";
                if ($valor['vetado'] == 1):
                    $marca = Uteis::StatusProfessor($valor['vetado'], "vetado");
                else:
                    if ($valor['altaPerformance']):
                        $marca = Uteis::StatusProfessor($valor['altaPerformance'], "alta");
                    else:
                        if ($valor['otimaPerformance']):
                            $marca = Uteis::StatusProfessor($valor['otimaPerformance'], "otima");
                        endif;
                    endif;
                endif;
				
				if ($valor['presencial'] == 1) {
				$marca .= "&nbsp;&nbsp;<strong > P</strong>";	
				}
				
				$marca .= Uteis::StatusProfessor($valor['skype'], "skype");
				$marca .= " ".Uteis::StatusProfessor($valor['deixandoGrupo'], "mao2");
				$marca .= " ".Uteis::StatusProfessor($valor['terceiro'], "terceiro");


                if (count($lucro) > 0) {
                    $valorHoraProfessor = $this->getPlanoCarreira($valor['idProfessor'], $idIdioma);

                    if ($lucro['desejavel'] >= $valorHoraProfessor) {
                        $lucroImg = Uteis::StatusProfessor(true, "certo");
                    } else if ($lucro['maximo'] >= $valorHoraProfessor) {
                        $lucroImg = Uteis::StatusProfessor(true, "alerta");
                    } else {
                        $lucroImg = Uteis::StatusProfessor(true, "error");
                    }
                }

                $cor = "";
                if ($valor['indisponivel'] == 1) $cor = "style='color:#aa0000;font-style:italic;'";

                $DisponibilidadeProfessor = new DisponibilidadeProfessor();
                if (!isset($data)) {
                    $sql1 = "SELECT COALESCE(AP.horaInicio, AF.horaInicio) AS horaInicio, COALESCE(AP.horaFim, AF.horaFim) AS horaFim
					,COALESCE(AP.diaSemana, (DATE_FORMAT(AF.dataAula, '%w')+1)) AS diaSemana
					FROM buscaProfessor AS B
					LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = B.aulaPermanenteGrupo_idAulaPermanenteGrupo
					LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = B.aulaDataFixa_idAulaDataFixa
					INNER JOIN planoAcaoGrupo AS PAG ON (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
					WHERE B.iDbuscaProfessor = $idBuscaProfessor";
                    //		echo $sql1;

                    $rs = Uteis::executarQuery($sql1);
                    $horaInicio_disp = $rs[0]['horaInicio'];
                    $horaFim_disp = $rs[0]['horaFim'];
                    $diaSemana_disp = $rs[0]['diaSemana'];
                    $resp_disp = $DisponibilidadeProfessor->VerificarDisponibilidade($valor['idProfessor'], $horaInicio_disp, $horaFim_disp, $diaSemana_disp);
                } else {

                    $horaInicio_disp = $data['horaInicio'];
                    $horaFim_disp = $data['horaFim'];
                    $diaSemana_disp = $data['semana']; /*($data['tipo']==1) ? $data['diaSemana']:date("w",$data['diaSemana']);	*/
                    $resp_disp = $DisponibilidadeProfessor->VerificarDisponibilidade($valor['idProfessor'], $horaInicio_disp, $horaFim_disp, $diaSemana_disp);
                }
                //			Uteis::pr($resp_disp);
                $dataX = date("Y");
                $grupos = " ";
                $sql1 = " SELECT DISTINCT(G.nome) AS grupo, PAG.idPlanoAcaoGrupo, COALESCE(AP.horaInicio, AF.horaInicio) AS horaInicio, COALESCE(AP.horaFim, AF.horaFim) AS horaFim
					,COALESCE(AP.diaSemana, (DATE_FORMAT(AF.dataAula, '%w'))) AS diaSemana FROM professor AS P
				INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
				LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
				LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
				INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND
					(PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
				INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo AND G.inativo = 0
				WHERE diaSemana = $diaSemana_disp AND (AP.horaInicio between $horaInicio_disp AND $horaFim_disp) AND (AP.horaFim between $horaInicio_disp AND $horaFim_disp) AND P.idProfessor = " . $valor['idProfessor'] . "
				AND YEAR(AGP.datainicio) = " . $dataX;
//				Uteis::pr( $sql1);
                $rsGrupos = $this->query($sql1);
                $total = mysqli_num_rows($rsGrupos);
                if ($total > 0) {
                    $xy = 0;
                    while ($valorGrupo = mysqli_fetch_array($rsGrupos)) {
                        $grupos .= $valorGrupo['grupo'] . "<br>";
                     $xy++;
                    }
                }
                if ($resp_disp['status'] == "Ocupado" && $xy > 0) {
                    $resp_disp['status'] = "<div class=\"destacaLinha\">Ocupado<br>Grupos: " . $grupos . "</div>";
                } else {
                    $resp_disp['status'] = "<div class=\"destacaLinha\">" . $resp_disp['status'] . "</div>";
                }

                $idProfessor = $valor['idProfessor'];

                $valorIdiomaProfessor = $IdiomaProfessor->selectIdiomaProfessor("where professor_idProfessor =" . $valor['idProfessor']);

                $idNivelLinguistico = $valorIdiomaProfessor[0]['nivelLinguistico_idNivelLinguistico'];

                $valorNivelLinguistico = $NivelLinguistico->selectNivelLinguistico("where idNivelLinguistico = " . $idNivelLinguistico);

                $editar = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"IR PARA O CADASTRO\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $idProfessor . "', '$caminhoAtualizar', '#lista');\" style=\"margin-right:1em;\">";

                $gruposG = " ";
                $sql = " SELECT DISTINCT(G.nome) AS grupo, PAG.idPlanoAcaoGrupo FROM professor AS P
				INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
				LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
				LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
				INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND
					(PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
				INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo AND G.inativo = 0
				WHERE ( AGP.dataFim >= CURDATE() OR AGP.dataFim IS NULL OR AGP.dataFim = '') AND P.idProfessor = " . $valor['idProfessor'];
                $rsGrupos = $this->query($sql);
                $totalGrupos = 0;
                if (mysqli_num_rows($rsGrupos) > 0) {
                    while ($valorGrupo = mysqli_fetch_array($rsGrupos)) {
                        $gruposG .= " <div class=\"destacaLinha\"
						onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=" . $valorGrupo['idPlanoAcaoGrupo'] . "', '$caminhoAtualizar', 'tr')\">" . $valorGrupo['grupo'] . "</div>";
                        $totalGrupos++;
                    }
                }
                    $htmlver = "<tr>";
                        $htmlver .= "<td " . $cor . ">" . $editar . $valor['nome'] . $marca . "&nbsp;&nbsp;" . $lucroImg . "</td>";
						$marca = "";
                        $htmlver .= "<td>" . $gruposG . "</td>";
                        $htmlver .= "<td title = \"" . $resp_disp['obs'] . "\">" . $resp_disp['status'] . $grupos . "</td>";

                        $nivelF = " ";
                        $nivelF = $valorNivelLinguistico[0]['nivel'];
                        $htmlver .= "<td>" . $nivelF . " </td>";
                        $val = "R$ " . Uteis::formatarMoeda($this->getPlanoCarreira($valor['idProfessor'], $idIdioma));
                        $htmlver .= "<td>" . $val . "</td>";
                        $htmlver .= "<td align=\"center\"><input class=\"button gray\" name=\"btn-select\" type=\"button\" value=\"Selecionar\" onclick=\"postForm('', '$acao', 'idProfessor=$idProfessor" . "$param')\" /></td>";
						
                    $htmlver .= "</tr>";
                // pega a variavel param e transforma em um array para extrair o param menor5grupos
                parse_str($param, $paramArray);
                if (($paramArray['menor5grupos'] == 1) AND ($totalGrupos < 5)) {
                    $html .= $htmlver;
                }elseif ($paramArray['menor5grupos'] == 0) {
                    $html .= $htmlver;
                }
            }
        } //end loop

        return $html;
    }

    function selectProfessorDemonstrativoTr($mes, $ano, $caminhoAtualizar, $onde, $tipo, $terceiro, $idProfessor, $apenasLinha = false, $zerado) {
	
		$DemonstrativoPagamento = new DemonstrativoPagamento();
		
		$caminhoAtualizar_base = $caminhoAtualizar;
		
	if ($terceiro == 1) {
		$rs = "";
	} else {
		$rs = " AND P.terceiro = 0";	
		}
		
		if ($idProfessor > 0 ) {
			$rs .= " AND idProfessor = ".$idProfessor;	
			
		}
		

        $x = date("Y-m-d", mktime(0, 0, 0, $mes + 1, 0, $ano));

        $sql = "SELECT distinct(P.nome), P.idProfessor, P.deixandoGrupo FROM professor AS P
		 INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
		 LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
		 LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
		 INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
		 INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo AND G.inativo = 0
		 WHERE 1 ".$rs." AND ((AGP.dataFim >= '" . $ano . "-" . $mes . "-01' AND AGP.dataFim <= '" . $x . "') or AGP.dataFim is null)";

        if ($tipo == 1) {
            //trazer todos os professores que tem horas nesses meses ou crédito/débito
            $sql = "SELECT SQL_CACHE P.idProfessor, P.nome FROM professor AS P
		WHERE  1 ".$rs." AND (P.idProfessor IN (
			SELECT professor_idProfessor FROM creditoDebitoGrupo WHERE mes = " . $mes . " AND ano = " . $ano . "
		) OR  P.idProfessor IN (
			SELECT professor_idProfessor FROM folhaFrequencia AS FF ";
            $sql .= " WHERE MONTH(FF.dataReferencia) = " . $mes . " AND YEAR(FF.dataReferencia) = " . $ano . " AND FF.planoAcaoGrupo_idPlanoAcaoGrupo != 1
				))";

        }
//		echo $sql;
        $result = $this->query($sql);
		$cont=0;
        while ($valor = mysqli_fetch_array($result)) {
			
			$idProfessor = $valor['idProfessor'];
			
			$caminhoAtualizar = $caminhoAtualizar_base . "&tr=1&idProfessor=" . $idProfessor;
		
			
			 if ($apenasLinha !== false) {
                    $caminhoAtualizar .= "&ordem=" . $apenasLinha;
                } else {
                    $caminhoAtualizar .= "&ordem=" . ($cont++);
                }
		//	$caminhoAtualizar2 = $caminhoAtualizar."&tr=1&ordem=".$x."&idProfessor=".$idProfessor;
			$x++;

            
            $nome = $valor['nome'];
			$marca = " ".Uteis::StatusProfessor($valor['deixandoGrupo'], "mao2");
			

            $sql = "SELECT idDemonstrativoPagamento FROM demonstrativoPagamento WHERE professor_idProfessor = $idProfessor AND mes = $mes AND ano = $ano AND tipoDemo = 1";
            $foiGeradoDemonstrativo = Uteis::executarQuery($sql);

            $cor = $foiGeradoDemonstrativo ? "reposicao" : "";
			
			$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $idProfessor . "', '$caminhoAtualizar', '$onde')\" ";
			  
		 	$img2 = "<img src=\"" . CAMINHO_IMG . "pa.png\" title=\"GERAR DEMONSTRATIVO\"
				onclick=\"abrirNivelPagina(this, '" . CAMINHO_PAG . "demonstrativo/include/form/demonstrativo.php?idProfessor=" . $idProfessor . "&mes=" . $mes . "&ano=" . $ano . "', '$caminhoAtualizar', 'tr')\" />";
				
					//AULAS
			$rsDemonstrativoPagamento = $DemonstrativoPagamento -> selectDemonstrativoPagamentoTr_aulasTotal($idProfessor, $mes, $ano, false);
			//Uteis::pr($rsDemonstrativoPagamento);
			$valorTotalAulas = 0;
			foreach ($rsDemonstrativoPagamento as $valorDemonstrativoPagamento) {
				$valorTotalAulas += $valorDemonstrativoPagamento['total'];
			}	
			$valorTotalAulas = Uteis::exibirMoeda($valorTotalAulas);
			
			if (($zerado == 0) && ($valorTotalAulas == 0)) {
				
			} else {
			
				 if ($apenasLinha !== false) {

                    $col = array();

                    $col[] = "<div class=\"" . $cor . "\" >".$nome.$marca."</div>";
                    $col[] = $img2;
                    $col[] = $valorTotalAulas;

                    $html = $col;
                    break;

                } else {
            $html .= "<tr>";
         
            $html .= "<td $onclick > <div class=\"" . $cor . "\" >" . $nome . $marca. "</div></td>";

            $html .= "<td align=\"center\">".$img2."</td>";
			
			$html .= "<td>".$valorTotalAulas."</td>";

            $html .= "</tr>";
				}
        	}
		}
        return $html;
    }

    function selectProfessorContratadoTr_opcaoBuscaProfessorSelecionada($where = "", $idIdioma, $idBuscaProfessor, $idPlanoAcaoGrupo)
    {

        $OpcaoBuscaProfessorSelecionada = new OpcaoBuscaProfessorSelecionada();

        $sql = " SELECT P.idProfessor, P.nome FROM professor AS P
		INNER JOIN idiomaProfessor AS I ON I.professor_idProfessor = P.idProfessor
		WHERE P.candidato = 0 AND P.idProfessor IN (
			SELECT professor_idProfessor FROM opcaoBuscaProfessorSelecionada
			WHERE buscaProfessor_idBuscaProfessor = $idBuscaProfessor
		) AND I.Idioma_idIdioma = " . $idIdioma . " AND P.inativo = 0 AND I.inativo = 0 " . $where;
        $result = $this->query($sql);
        //echo $sql;
        if (mysqli_num_rows($result) > 0) {

            $html = "";

            while ($valor = mysqli_fetch_array($result)) {

                $idProfessor = $valor['idProfessor'];

                $sql = "SELECT SQL_CACHE aceito FROM opcaoBuscaProfessorSelecionada
				WHERE aceito = 1 AND buscaProfessor_idBuscaProfessor = " . $idBuscaProfessor . " AND professor_idProfessor = " . $idProfessor;
                $aceito = mysqli_num_rows($this->query($sql));

                $checked = $aceito ? "<img src=\"" . CAMINHO_IMG . "ativo.png\" title=\"Professor escolhido\"
				onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $idProfessor . "', '', '')\" >" : "";

                $sql = "SELECT SQL_CACHE aceito FROM opcaoBuscaProfessorSelecionada
                WHERE aceito = 2 AND buscaProfessor_idBuscaProfessor = " . $idBuscaProfessor . " AND professor_idProfessor = " . $idProfessor;
                $aceitar = mysqli_num_rows($this->query($sql));

                $sql = "SELECT SQL_CACHE aceito FROM opcaoBuscaProfessorSelecionada
                WHERE aceito = 3 AND buscaProfessor_idBuscaProfessor = " . $idBuscaProfessor . " AND professor_idProfessor = " . $idProfessor;
                $rejeitar = mysqli_num_rows($this->query($sql));

                $sql = "SELECT SQL_CACHE idOpcaoBuscaProfessorSelecionada FROM opcaoBuscaProfessorSelecionada
                WHERE buscaProfessor_idBuscaProfessor = " . $idBuscaProfessor . " AND professor_idProfessor = " . $idProfessor;
                $remover = mysqli_num_rows($this->query($sql));


                $op1 = $OpcaoBuscaProfessorSelecionada->selectOpcaoBuscaProfessorSelecionada("WHERE aceito=2 AND buscaProfessor_idBuscaProfessor=" . $idBuscaProfessor . " AND professor_idProfessor = " . $idProfessor);
                $motivo1 = $op1[0]['motivo'];

                $op3 = $OpcaoBuscaProfessorSelecionada->selectOpcaoBuscaProfessorSelecionada("WHERE aceito=3 AND buscaProfessor_idBuscaProfessor=" . $idBuscaProfessor . " AND professor_idProfessor = " . $idProfessor);
                $motivo3 = $op3[0]['motivo'];


                $marca = $aceitar ? "<img src=\"" . CAMINHO_IMG . "confirma.png\" title=\"Aceitou a Vaga\" >" : "";
                if ($marca != "") {
                    $obs2 = "<img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Motivo: " . $motivo1 . "\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/vendas/include/form/motivo.php?aceito=2&idProfessor=" . $idProfessor . "&idBuscaProfessor=" . $idBuscaProfessor . "', '', '')\" >";
                }

                $marca2 = $rejeitar ? "<img src=\"" . CAMINHO_IMG . "rejeitou.png\" title=\"Rejeitou a Vaga\" >" : "";
                if ($marca2 != "") {
                    $obs = "<img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Motivo Rejeição: " . $motivo3 . "\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/vendas/include/form/motivo.php?aceito=3&idProfessor=" . $idProfessor . "&idBuscaProfessor=" . $idBuscaProfessor . "', '', '')\" >";
                }
                $html .= "<tr>";

                $html .= "<td >
					<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"Ver cadastro\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $idProfessor . "', '','')\" >
					$checked &nbsp; $marca &nbsp; $marca2" . $valor['nome'] . "
				</td>";
				
				 $rh = $OpcaoBuscaProfessorSelecionada->selectOpcaoBuscaProfessorSelecionada("   WHERE buscaProfessor_idBuscaProfessor=" . $idBuscaProfessor . " AND professor_idProfessor = " . $idProfessor);
				 
	    		 $editarValor = "<img src=\"" . CAMINHO_IMG . "editar.png\" title=\"Editar valor hora deste professor para esta aula\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/vendas/include/form/valorHora.php?idProfessor=" . $idProfessor . "&idBuscaProfessor=" . $idBuscaProfessor . "', '".CAMINHO_REL."busca/vendas/include/resourceHTML/opcao.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&idBuscaProfessor=".$idBuscaProfessor."', '#div_opcoes_planoacaogrupo')\" >";
				 
				if ($rh[0]['valorHora'] == '') {

                $html .= " <td align=\"center\">
				R$ " . Uteis::formatarMoeda($this->getPlanoCarreira($idProfessor, $idIdioma)) ." ".$editarValor. "</td>";
				} else {
				$html .= " <td align=\"center\">
				R$ " . Uteis::formatarMoeda($rh[0]['valorHora']) ." ".$editarValor. "</td>";
					
					
				}
				

                $html .= "<td align=\"center\">

					<img src=\"" . CAMINHO_IMG . "success.png\" title=\"Confirmar Professor\"
					onclick=\"postForm('', '" . CAMINHO_REL . "busca/vendas/include/acao/opcao.php', 'idBuscaProfessor=" . $idBuscaProfessor . "&idProfessor=" . $idProfessor . "&mudarAba=#aba_planoAcaoGrupo_op&negativa=2')\" />

				</td>";

                $html .= "<td align=\"center\">

                    <img src=\"" . CAMINHO_IMG . "confirma.png\" title=\"Aceitou vaga\"
                    onclick=\"postForm('', '" . CAMINHO_REL . "busca/vendas/include/acao/opcao.php', 'idBuscaProfessor=" . $idBuscaProfessor . "&idProfessor=" . $idProfessor . "&mudarAba=#aba_planoAcaoGrupo_op&negativa=0')\" />
					" . $obs2 . "

                </td>";

                $html .= "<td align=\"center\">

                    <img src=\"" . CAMINHO_IMG . "rejeitou.png\" title=\"Rejeitou vaga\"
                    onclick=\"postForm('', '" . CAMINHO_REL . "busca/vendas/include/acao/opcao.php', 'idBuscaProfessor=" . $idBuscaProfessor . "&idProfessor=" . $idProfessor . "&mudarAba=#aba_planoAcaoGrupo_op&negativa=1')\" />
                    " . $obs . "
                </td>";
                $html .= " <td align=\"center\">

                    <img src=\"" . CAMINHO_IMG . "error.png\" title=\"Excluir Professor\"
                    onclick=\"postForm('', '" . CAMINHO_REL . "busca/vendas/include/acao/opcao.php', 'idBuscaProfessor=" . $idBuscaProfessor . "&idProfessor=" . $idProfessor . "&mudarAba=#aba_planoAcaoGrupo_op&remover=1')\" />

                </td>
				</tr>";

            }
        }

        return $html;
    }

    function selectProfessorContratadoTr_diasBuscaAvulsaProfessor($where = "", $idIdioma, $idDiasBuscaAvulsa, $param)
    {

		$DiasBuscaAvulsaProfessor = new DiasBuscaAvulsaProfessor();
		
        $sql = " SELECT DISTINCT(DBP.idDiasBuscaAvulsaProfessor) AS idDiasBuscaAvulsaProfessor, P.idProfessor, P.nome, DBP.escolhido, DBP.obs, DBP.ordem
		FROM diasBuscaAvulsaProfessor AS DBP
		INNER JOIN professor AS P ON P.idProfessor = DBP.professor_idProfessor
		INNER JOIN idiomaProfessor AS I ON I.professor_idProfessor = P.idProfessor
		WHERE DBP.diasBuscaAvulsa_idDiasBuscaAvulsa = $idDiasBuscaAvulsa AND I.Idioma_idIdioma = $idIdioma";
        $result = $this->query($sql);
        //      echo $sql;
        if (mysqli_num_rows($result) > 0) {

            $html = "";

            while ($valor = mysqli_fetch_array($result)) {

                $idProfessor = $valor['idProfessor'];

                if ($valor['obs'] != "") {

                    $motivo = $valor['obs'];

                }
                $idDiasBuscaAvulsaProfessor = $valor['idDiasBuscaAvulsaProfessor'];

                $sql = "SELECT SQL_CACHE escolhido FROM diasBuscaAvulsaProfessor
                WHERE escolhido = 1 AND diasBuscaAvulsa_idDiasBuscaAvulsa = " . $idDiasBuscaAvulsa . " AND professor_idProfessor = " . $idProfessor;
                $escolhido = mysqli_num_rows($this->query($sql));

                $checked = $escolhido ? "<img src=\"" . CAMINHO_IMG . "ativo.png\" title=\"Professor escolhido\"
                onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $idProfessor . "', '', '')\" >" : "";

                $sql = "SELECT SQL_CACHE escolhido FROM diasBuscaAvulsaProfessor
                WHERE escolhido = 2 AND diasBuscaAvulsa_idDiasBuscaAvulsa = " . $idDiasBuscaAvulsa . " AND professor_idProfessor = " . $idProfessor;
                $aceita = mysqli_num_rows($this->query($sql));

                $sql = "SELECT SQL_CACHE escolhido FROM diasBuscaAvulsaProfessor
                WHERE escolhido = 3 AND diasBuscaAvulsa_idDiasBuscaAvulsa = " . $idDiasBuscaAvulsa . " AND professor_idProfessor = " . $idProfessor;
                $rejeita = mysqli_num_rows($this->query($sql));

                $marca = $aceita ? "<img src=\"" . CAMINHO_IMG . "confirma.png\" title=\"Aceitou a Vaga\" >" : "";

                $obs2 = "<div id=\"motivo2_" . $idDiasBuscaAvulsaProfessor . "\" style=\"display:inline\"></div>";
                if ($marca != "") {
                    $obs2 = "<div id=\"motivo2_" . $idDiasBuscaAvulsaProfessor . "\" style=\"display:inline\"><img height=\"30px;\" src=\"" . CAMINHO_IMG . "pa.png\" title=\"Motivo: " . $motivo . "\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/avulsa/include/form/motivo.php?aceito=2&idProfessor=" . $idProfessor . "&id=" . $idDiasBuscaAvulsaProfessor . "&idBuscaAvulsa=" . $idDiasBuscaAvulsa . "', '".CAMINHO_REL."busca/avulsa/include/resourceHTML/busca.php?idDiasBuscaAvulsa=" . $idDiasBuscaAvulsa . "&idBuscaAvulsa=".$param."', '')\" ></div>";
                    $motivo = "";
                }

                $marca2 = $rejeita ? "<img src=\"" . CAMINHO_IMG . "error.png\" title=\"Rejeitou a Vaga\" >" : "";
                $obs = "<div id=\"motivo3_" . $idDiasBuscaAvulsaProfessor . "\" style=\"display:inline\"></div>";
                if ($marca2 != "") {
                    $obs = "<div id=\"motivo3_" . $idDiasBuscaAvulsaProfessor . "\" style=\"display:inline\"><img height=\"30px;\" src=\"" . CAMINHO_IMG . "pa.png\" title=\"Motivo Rejeição: " . $motivo . "\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/avulsa/include/form/motivo.php?aceito=3&idProfessor=" . $idProfessor . "&id=" . $idDiasBuscaAvulsaProfessor . "&idBuscaAvulsa=" . $idDiasBuscaAvulsa . "', '".CAMINHO_REL."busca/avulsa/include/resourceHTML/busca.php?idDiasBuscaAvulsa=" . $idDiasBuscaAvulsa . "&idBuscaAvulsa=".$param."', '')\" ></div>";
                }

                $delProfVaga = "<img src=\"" . CAMINHO_IMG . "error.png\" title=\"Excluir\" onclick=\"deletaRegistro('" . CAMINHO_REL . "busca/avulsa/include/acao/opcao.php', $idDiasBuscaAvulsaProfessor,'" . CAMINHO_REL . "busca/avulsa/include/resourceHTML/opcao.php?idDiasBuscaAvulsa=".$idDiasBuscaAvulsa."&idIdioma=".$idIdioma."','#div_opcoes_avulsa')\">";

                $html .= "<tr>

                <td > $delProfVaga
                    <img src=\"" . CAMINHO_IMG . "cad.png\" title=\"Ver cadastro\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $idProfessor . "', '', '')\" >
                    $checked &nbsp; <span class=\"motivoimg".$idDiasBuscaAvulsaProfessor."\">$marca $marca2</span> &nbsp;" . $valor['nome'] . "
                </td>";
				
				 $rh = $DiasBuscaAvulsaProfessor->selectDiasBuscaAvulsaProfessor("   WHERE idDiasBuscaAvulsaProfessor = ".$idDiasBuscaAvulsaProfessor);
				 
	//			 Uteis::pr($rs);
				 
	    		 $editarValor = "<img src=\"" . CAMINHO_IMG . "editar.png\" title=\"Editar valor hora deste professor para esta aula\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/avulsa/include/form/valorHora.php?idProfessor=" . $idProfessor . "&id=" . $idDiasBuscaAvulsaProfessor . "&idBuscaAvulsa=" . $idDiasBuscaAvulsa . "', '".CAMINHO_REL."busca/avulsa/include/resourceHTML/opcao.php?idDiasBuscaAvulsa=" . $idDiasBuscaAvulsa."&idIdioma=".$idIdioma."', '#div_opcoes_avulsa')\" >";
				 
				if ($rh[0]['valorHora'] == '') {

                $html .= " <td align=\"center\">
				R$ " . Uteis::formatarMoeda($this->getPlanoCarreira($idProfessor, $idIdioma)) ." ".$editarValor. "</td>";
				} else {
				$html .= " <td align=\"center\">
				R$ " . Uteis::formatarMoeda($rh[0]['valorHora']) ." ".$editarValor. "</td>";
					
					
				}

            $html .= "    <td align=\"center\">

                    <img src=\"" . CAMINHO_IMG . "success.png\" title=\"Confirmar Professor\"
                    onclick=\"postForm('', '" . CAMINHO_REL . "busca/avulsa/include/acao/opcao.php', 'id=" . $idDiasBuscaAvulsaProfessor . "&idDiasBuscaAvulsa=" . $idDiasBuscaAvulsa . "&escolhido=1','')\" />

                </td>

                <td align=\"center\">

                    <img src=\"" . CAMINHO_IMG . "confirma.png\" title=\"Aceitou vaga\"
                    onclick=\"postForm('', '" . CAMINHO_REL . "busca/avulsa/include/acao/opcao.php', 'id=" . $idDiasBuscaAvulsaProfessor . "&idDiasBuscaAvulsa=" . $idDiasBuscaAvulsa . "&escolhido=2','');abre(3," . $idDiasBuscaAvulsaProfessor . ");\" />
					" . $obs2 . "

                </td>
                <td align=\"center\">

                    <img src=\"" . CAMINHO_IMG . "error.png\" title=\"Rejeitou vaga\"
                    onclick=\"postForm('', '" . CAMINHO_REL . "busca/avulsa/include/acao/opcao.php', 'id=" . $idDiasBuscaAvulsaProfessor . "&idDiasBuscaAvulsa=" . $idDiasBuscaAvulsa . "&escolhido=3','');abre(2," . $idDiasBuscaAvulsaProfessor . ");\" />
					" . $obs . "

                </td>
				<td text-align=\"center\">
				    <div id=\"obs_" . $idDiasBuscaAvulsaProfessor . "\" style=\"display:inline\">" . $valor['obs'] . "</div>
				    <img height=\"16px;\" src=\"" . CAMINHO_IMG . "editar.png\" title=\"Obs: " . $motivo . "\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/avulsa/include/form/obs.php?idProfessor=" . $idProfessor . "&id=" . $idDiasBuscaAvulsaProfessor . "&idBuscaAvulsa=" . $idDiasBuscaAvulsa . "','','')\" > </td>
				
				
				
				
				<td>
				<div id=\"ordem_" . $idDiasBuscaAvulsaProfessor . "\" style=\"display:inline\">" . $valor['ordem'] . "</div>
				    <img height=\"16px;\" src=\"" . CAMINHO_IMG . "editar.png\" title=\"Ordem: " . $ordem . "\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/avulsa/include/form/ordem.php?idProfessor=" . $idProfessor . "&id=" . $idDiasBuscaAvulsaProfessor . "&idBuscaAvulsa=" . $idDiasBuscaAvulsa . "','".CAMINHO_REL."busca/avulsa/include/resourceHTML/opcao.php?idDiasBuscaAvulsa=" . $idDiasBuscaAvulsa."&idIdioma=".$idIdioma."', '#div_opcoes_avulsa')\" >
	     		</td>	
					
					
					</tr>";
               $obs2 = "";

            }
        }

        return $html;
    }

    function getPlanoCarreira($idProfessor, $idIdioma)
    {
        $sql = "SELECT SQL_CACHE pc.plano FROM planoCarreirra pc
		INNER JOIN planoCarreirraIdiomaProfessor pcip On pc.idPlanoCarreira = pcip.planoCarreirra_idPlanoCarreira
		INNER JOIN idiomaProfessor ip On pcip.IdiomaProfessor_idIdiomaProfessor = ip.idIdiomaProfessor
		WHERE ip.Idioma_idIdioma = " . $idIdioma . " AND ip.inativo = 0 AND pc.inativo = 0
			AND ip.professor_idProfessor = " . $idProfessor . " AND pcip.anoFim is Null AND pcip.mesFim is Null
		GROUP BY idIdiomaProfessor";
	//	echo $sql;
        $result = $this->query($sql);
        if ($valor = mysqli_fetch_array($result)) {
            return $valor['plano'];
        }
    }

    function getPlanoCarreira_profs($idProfessor_s, $idIdioma, $valorHora_grupo)
    {
        //echo"// $valorHora_grupo";
        $profs = array("0");
        foreach ($idProfessor_s as $idProfessor) {
            $valorHora = $this->getPlanoCarreira($idProfessor, $idIdioma);
            if ($valorHora <= $valorHora_grupo)
                $profs[] = $idProfessor;
        }
        return implode(",", $profs);
    }

    /**
     * selectProfessorSelect() Function
     */
    function selectProfessorSelect($classes = "", $idAtual = 0, $and = "")
    {
        $sql = "SELECT SQL_CACHE idProfessor, nome FROM professor WHERE excluido = 0 AND inativo = 0 " . $and . " ORDER BY nome";
   //     echo $sql;
		$result = $this->query($sql);
        $html = "<select id=\"idProfessor\" name=\"idProfessor\"  class=\"" . $classes . "\" >";
        $html .= "<option value=\"\">Selecione</option>";
        while ($valor = mysqli_fetch_array($result)) {
            $selecionado = $idAtual == $valor['idProfessor'] ? "selected=\"selected\"" : "";
            $html .= "<option " . $selecionado . " value=\"" . $valor['idProfessor'] . "\">" . ($valor['nome']) . "</option>";
        }
        $html .= "</select>";
        return $html;
    }

    function selectProfessorSelectMult($classes = "", $idAtual = 0, $and = "")
    {
        $sql = "SELECT SQL_CACHE idProfessor, nome FROM professor  WHERE inativo = 0 " . $and . " ORDER BY nome";
        $result = $this->query($sql);
        $html = "<select id=\"idProfessor\" name=\"idProfessor[]\" multiple=\"multiple\" class=\"" . $classes . "\" >";
        $html .= "<option value=\"\">Todos</option>";
        while ($valor = mysqli_fetch_array($result)) {
            $selecionado = $idAtual == $valor['idProfessor'] ? "selected=\"selected\"" : "";
            $html .= "<option " . $selecionado . " value=\"" . $valor['idProfessor'] . "\">" . ($valor['nome']) . "</option>";
        }
        $html .= "</select>";
        return $html;
    }

    function impostoProfessor($idProfessor)
    {
        $sql = "SELECT SQL_CACHE ti.sigla nome, ti.idTipoImpostoProfessor, pi.idProfessorTipoImposto, pi.dataInicio, pi.dataFim FROM tipoImpostoProfessor ti LEFT JOIN professorTipoImposto pi ON (ti.idTipoImpostoProfessor = pi.TipoImpostoProfessor_idTipoImpostoProfessor AND pi.professor_idProfessor = '" . $idProfessor . "') WHERE ti.inativo = 0 ORDER BY ti.nome";
        //	echo $sql;
        $result = $this->query($sql);


        while ($valor = mysqli_fetch_array($result)) {
            $selecionado = '' != $valor['idProfessorTipoImposto'] ? "checked=\"checked\"" : "";
            $html .= "<div style=\"    width: 33%;float:left;\"><p><label>" . $valor['nome'] . " <input name=\"tipoImpostoProfessor[]\" type=\"checkbox\" value=\"" . $valor['idTipoImpostoProfessor'] . "\" " . $selecionado . " /></label> </p>";
            $html .= "  <p>
          <label>Cobrar a partir de:</label>
          <input type=\"text\" name=\"dataInicio_" . $valor['idTipoImpostoProfessor'] . "\" id=\"dataInicio_" . $valor['idTipoImpostoProfessor'] . "\" value=\"" . Uteis::exibirData($valor['dataInicio']) . "\"  class=\"data \"/>

          <label>Cobrar até:</label>
          <input type=\"text\" name=\"dataFim_" . $valor['idTipoImpostoProfessor'] . "\" id=\"dataFim_" . $valor['idTipoImpostoProfessor'] . "\" value=\"" . Uteis::exibirData($valor['dataFim']) . "\" class=\"data \"/>
			</p></div>";
        }
        return $html;
    }

    function gravaImpostoProfessor($idProfessor, $tipoImpostoProfessor, $dataInicio, $dataFim)
    {

        if ($dataInicio > 0) {
            $dataInicio2 = Uteis::gravarData($dataInicio);

        } else {
            $dataInicio2 = "NULL";
        }

        if ($dataFim > 0) {
            $dataFim2 = Uteis::gravarData($dataFim);
        } else {
            $dataFim2 = "NULL";
        }
        $sql2 = "INSERT INTO professorTipoImposto (professor_idProfessor,TipoImpostoProfessor_idTipoImpostoProfessor,inativo,dataCadastro,dataInicio, dataFim) VALUES (" . $idProfessor . ", " . $tipoImpostoProfessor . ", 0, '" . date('Y-m-d H:i:s') . "','" . $dataInicio2 . "','" . $dataFim2 . "')";
        $this->query($sql2);
     }

    function selectGrupoProfTr_query($where)
    {

        $sql = "SELECT SQL_CACHE DISTINCT(G.idGrupo), PAG.idPlanoAcaoGrupo, PAG.planoAcao_idPlanoAcao ,G.nome, N.nivel , P.idProfessor, PAG.dataPrevisaoTerminoEstagio, FF.dataReferencia
    FROM professor AS P
    INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
    LEFT JOIN aulaDataFixa AS ADF ON ADF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
    LEFT JOIN aulaPermanenteGrupo AS APG ON APG.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
	LEFT JOIN folhaFrequencia AS FF ON FF.professor_idProfessor = P.idProfessor
    INNER JOIN planoAcaoGrupo AS PAG ON
      (PAG.idPlanoAcaoGrupo = ADF.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = APG.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo)
    INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
    INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = PAG.nivelEstudo_IdNivelEstudo " . $where . " GROUP BY G.idGrupo";
//        echo "<hr>".$sql."<hr>";
        return $this->executeQuery($sql);

    }

    function selectGrupoProfTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $Ndados, $reposicao,$mobile)
    {
			$mes = date('m')-1;
			if ($mes < 10) {
				$mes = "0".$mes;
			} 
			$ano = date('Y');
			
        if ($reposicao == 0) {
            // Checa os grupos ativos
            $sql = " SELECT SQL_CACHE DISTINCT(G.idGrupo), PAG.idPlanoAcaoGrupo, PAG.planoAcao_idPlanoAcao ,G.nome, N.nivel , P.idProfessor, PAG.dataPrevisaoTerminoEstagio, FF.dataReferencia, FF.finalizadaParcial
			FROM professor AS P
                    INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
                    LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
                    LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
                    INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND
                        (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
                    LEFT JOIN folhaFrequencia AS FF ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo
						AND (FF.dataReferencia = '".$ano."-".$mes."-01')
					INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo 
					INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = PAG.nivelEstudo_IdNivelEstudo
                    WHERE ( AGP.dataFim >= CURDATE() OR AGP.dataFim IS NULL OR AGP.dataFim = '') AND P.idProfessor = " . $Ndados['idProf'] . $where;
		} elseif ($reposicao == 1) {
	$sql = "		SELECT SQL_CACHE DISTINCT
    (G.idGrupo),
    PAG.idPlanoAcaoGrupo,
    PAG.planoAcao_idPlanoAcao,
    G.nome,
    N.nivel,
    P.idProfessor,
    PAG.dataPrevisaoTerminoEstagio,
    FF.dataReferencia,  FF.idFolhaFrequencia,   FF.finalizadaParcial
FROM
    professor AS P
         LEFT JOIN
    folhaFrequencia AS FF ON FF.professor_idProfessor = P.idProfessor
        LEFT JOIN
    planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo
        INNER JOIN
    grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
        INNER JOIN
    nivelEstudo AS N ON N.IdNivelEstudo = PAG.nivelEstudo_IdNivelEstudo
	WHERE  P.idProfessor = " . $Ndados['idProf'] . $where;
	} elseif ($reposicao == 2) {
		
		$sql = " SELECT SQL_CACHE DISTINCT(G.idGrupo), PAG.idPlanoAcaoGrupo, PAG.planoAcao_idPlanoAcao ,G.nome, N.nivel , P.idProfessor, PAG.dataPrevisaoTerminoEstagio
			FROM professor AS P
                    INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
                    LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
                    LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
               /*     LEFT JOIN diaaulaff as DAFF ON DAFF.folhaFrequencia_idFolhaFrequencia=FF.idFolhaFrequencia*/
                    INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND
                        (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
                    INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo 
					INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = PAG.nivelEstudo_IdNivelEstudo
                    WHERE 1 AND P.idProfessor = " . $Ndados['idProf'] . $where;
					
	}
	//echo $sql;
            $result = $this->query($sql);
        if ($result) {

            $html = "";
            $GrupoClientePj = new GrupoClientePj();

            while ($valor = mysqli_fetch_array($result)) {
         //   while ($result $this->fetchArray( $valor)) {
                $data = explode('-',$valor['dataReferencia']);
                $dataff = $data[1].'/'.$data[0];
                $nome = $valor['nome'];
                $nivel = $valor['nivel'];
                $idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
                $idPlanoAcao = $valor['planoAcao_idPlanoAcao'];
                $empresa = $GrupoClientePj->getNomePJ($valor['idGrupo']);
				if ($mobile != 1) {
                $onclick = " onclick=\"abrirNivelPagina(this, '$caminhoAbrir?id=$idPlanoAcaoGrupo&Ndados=$Ndados&data=$dataff', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo( '$caminhoAbrir?id=$idPlanoAcaoGrupo&Ndados=$Ndados&data=$dataff', '#centro')\" ";	
					
				}
                $html .= "<tr>";
                $html .= "<td $onclick >" . $empresa . "</td>";
                $html .= "<td  >";
				$html .= "<center><img onclick=\"zerarPlano();carregarModulo('/cursos/mobile/professor/modulos/planoAcao/index.php?idPlanoAcao=" . $idPlanoAcao . "', '#planoAcao')\"
					src=\"" . CAMINHO_IMG . "pa.png\" title=\"Visualizar plano de ação\" />";
			//	}
				$html .= "Término previsto do estágio : " . Uteis::exibirData($valor['dataPrevisaoTerminoEstagio']) . "</center>
				</td>";
                $html .= "<td $onclick >" . $nome . "</td>";
                $html .= "<td $onclick >" . $nivel . "</td>";
				 if ($reposicao == 0) {
                $html .= "<td>".Uteis::exibirData($valor['dataReferencia'])."</td>";
				$html .= "<td>".Uteis::exibirStatus($valor['finalizadaParcial'])."</td>";
				 	}
				$html .= "</tr>";

            }
        }

        return ($html);

    }

    function getNome($id)
    {
        $rs = $this->selectProfessor(" WHERE idProfessor = $id");
        return $rs[0]['nome'];
    }
	
	  function getCandidato($id)
    {
        $rs = $this->selectProfessor(" WHERE idProfessor = $id");
        return $rs[0]['candidato'];
    }
	
	 function getnacionalidade($id)
    {
		$Pais = new Pais();
		
        $rs = $this->selectProfessor(" WHERE idProfessor = $id");
        $rs2 = $Pais->selectPais(" WHERE idPais = ".$rs[0]['pais_idPais']);
		return $rs2[0]['nacionalidade'];
    }


    function getEmail($idProfessor)
    {

        $emails = array();

        $sql = " SELECT E.valor, E.ePrinc FROM professor AS P
		INNER JOIN enderecoVirtual AS E ON E.professor_idProfessor = P.idProfessor AND E.tipoEnderecoVirtual_idTipoEnderecoVirtual = 1
		WHERE E.ePrinc = 1 And P.idProfessor = " . $idProfessor;
        $result = $this->query($sql);
        while ($valor = mysqli_fetch_array($result)) {
            $emails = $valor['valor'];
        }
        //echo implode(",", $emails);exit;
        return $emails;
    }
	
	function getIdade($idProfessor) {
		$sql = "SELECT SQL_CACHE distinct(P.idProfessor), P.nome, P.inativo, P.dataNascimento FROM professor AS P WHERE P.idProfessor = ".$idProfessor;
		$result = $this->query($sql);
		 while ($valor = mysqli_fetch_array($result)) {
            $data = Uteis::exibirData($valor['dataNascimento']);
        }
		
		// Declara a data! :P
  
    // Separa em dia, mês e ano
    list($dia, $mes, $ano) = explode('/', $data);
   
    // Descobre que dia é hoje e retorna a unix timestamp
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
   
    // Depois apenas fazemos o cálculo já citado :)
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
    return $idade;
	}

    function selectProfessorCheckBox_oferta($idPlanoAcaoGrupo)
    {

        // AND OBPS.aceito = 1
        $sql = " SELECT SQL_CACHE DISTINCT(P.idProfessor), P.nome
		FROM professor AS P
		WHERE P.idProfessor IN(
			SELECT OBPS.professor_idProfessor FROM buscaProfessor AS B
			LEFT JOIN aulaDataFixa AF ON AF.idAulaDataFixa = B.aulaDataFixa_idAulaDataFixa
			LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = B.aulaPermanenteGrupo_idAulaPermanenteGrupo
			INNER JOIN planoAcaoGrupo PAG ON
				(PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo)
			INNER JOIN opcaoBuscaProfessorSelecionada OBPS ON OBPS.buscaProfessor_idBuscaProfessor = B.idBuscaProfessor
			WHERE B.finalizada = 0 AND B.excluida = 0 AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo
		)";
        //echo $sql;
        $result = $this->query($sql);

        if (mysqli_num_rows($result) > 0) {

            $html = "";

            while ($valor = mysqli_fetch_array($result)) {

                $idProfessor = $valor['idProfessor'];

                $temEmail = $this->getEmail($idProfessor);

                $html .= "<div>
				<label for=\"check_disparoEmail_professor_" . $valor['idProfessor'] . "\">
				<input type=\"checkbox\" id=\"check_disparoEmail_professor_" . $valor['idProfessor'] . "\" name=\"check_disparoEmail_professor[]\" value=\"" . $valor['idProfessor'] . "\" " . ($temEmail ? "" : "disabled") . " /> " . $valor['nome'] . ($temEmail ? "" : " (não possui e-mail)") . "</label>
				<div class=\"tab2\" >" . $this->montaDias($idPlanoAcaoGrupo, $idProfessor) . "</div>
				</div>";
            }
        }
        return $html;
    }

    function montaDias($idPlanoAcaoGrupo, $idProfessor)
    {

        $AulaDataFixa = new AulaDataFixa();
        $AulaPermanenteGrupo = new AulaPermanenteGrupo();
        $Endereco = new Endereco();

        $sql = "SELECT DISTINCT(B.idBuscaProfessor), AF.idAulaDataFixa, AP.idAulaPermanenteGrupo, COALESCE(AF.endereco_idEndereco, AP.endereco_idEndereco) AS idEndereco
		FROM buscaProfessor AS B
		LEFT JOIN aulaDataFixa AF ON AF.idAulaDataFixa = B.aulaDataFixa_idAulaDataFixa
		LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = B.aulaPermanenteGrupo_idAulaPermanenteGrupo
		INNER JOIN planoAcaoGrupo PAG ON
			(PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo)
		INNER JOIN opcaoBuscaProfessorSelecionada OBPS ON OBPS.buscaProfessor_idBuscaProfessor = B.idBuscaProfessor
		WHERE B.finalizada = 0 AND B.excluida = 0 AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND OBPS.professor_idProfessor = $idProfessor ";
        $rsBusca = $this->query($sql);
        //print_r($rsBusca);exit;

        $dias = "";
        while ($valorBusca = mysqli_fetch_array($rsBusca)) {

            $idBuscaProfessor = $valorBusca['idBuscaProfessor'];
            $idAulaDataFixa = $valorBusca['idAulaDataFixa'];
            $idAulaPermanenteGrupo = $valorBusca['idAulaPermanenteGrupo'];
            $idEndereco = $valorBusca['idEndereco'];

            if ($idAulaDataFixa) {
                $dia = $AulaDataFixa->montaDias($idAulaDataFixa);
            } elseif ($idAulaPermanenteGrupo) {
                $dia = $AulaPermanenteGrupo->montaDias($idAulaPermanenteGrupo);
            }

            $endereco = $Endereco->getEnderecoCompleto($idEndereco);

            $dias .= "<p>$dia " . ($endereco ? " Endereço: $endereco" : "") . "</p>";
        }

        return $dias;
    }

    function select_gerentePorProfessor($idFuncionario = "", $class = "")
    {

        $sql = "SELECT DISTINCT(F.idFuncionario), F.nome FROM gerente AS G
		INNER JOIN funcionario AS F ON F.idFuncionario = G.funcionario_idFuncionario
		WHERE G.inativo = 0 AND F.inativO = 0";
        $result = $this->query($sql);

        $html = "<select id=\"idFuncionario\" name=\"idFuncionario\" class=\"$class\" >";
        $html .= "<option value=\"\">Selecione</option>";
        while ($valor = mysqli_fetch_array($result)) {
            $selecionado = $idFuncionario == $valor['idFuncionario'] ? "selected=\"selected\"" : "";
            $html .= "<option " . $selecionado . " value=\"" . $valor['idFuncionario'] . "\">" . ($valor['nome']) . "</option>";
        }

        $html .= "</select>";
        return $html;
    }

    function select_alunoPorProfessor($idProfessor, $idClientePf = "", $class = "")
    {

        if (!$idProfessor)
            $idProfessor = "0";

        $sql = "SELECT SQL_CACHE DISTINCT(PF.idClientePf), CONCAT('(', G.nome, ') ', PF.nome) AS nome
		FROM professor AS P
		INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
		LEFT JOIN aulaDataFixa AS ADF ON ADF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
		LEFT JOIN aulaPermanenteGrupo AS APG ON APG.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
		INNER JOIN planoAcaoGrupo AS PAG ON (PAG.idPlanoAcaoGrupo = ADF.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = APG.planoAcaoGrupo_idPlanoAcaoGrupo)
		INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
		INNER JOIN integranteGrupo AS IG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
		INNER JOIN clientePf AS PF ON PF.idClientePf = IG.clientePf_idClientePf
		WHERE P.idProfessor = $idProfessor AND PAG.inativo = 0 AND G.inativo = 0
		ORDER BY G.nome, PF.nome";
        $result = $this->query($sql);

        $html = "<select id=\"idClientePf\" name=\"idClientePf\" class=\"$class\" >";
        $html .= "<option value=\"\">Selecione</option>";
        while ($valor = mysqli_fetch_array($result)) {
            $selecionado = $idClientePf == $valor['idClientePf'] ? "selected=\"selected\"" : "";
            $html .= "<option " . $selecionado . " value=\"" . $valor['idClientePf'] . "\">" . ($valor['nome']) . "</option>";
        }

        $html .= "</select>";
        return $html;
    }

    public function queryProfessorGrupo($id)
    {
        return " AND idProfessor IN(
			SELECT DISTINCT(AGP.professor_idProfessor)
			FROM aulaGrupoProfessor AS AGP
			LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa AND AF.excluido = 0
			LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
			INNER JOIN planoAcaoGrupo AS PAG ON
			PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo
			WHERE PAG.idPlanoAcaoGrupo = $id
		) ";
    }

    function selectProfessorDemonstrativoConsultoriaTr($mes, $ano, $caminhoAtualizar, $onde, $idProfessor)
    {

        //trazer todos os professores que tem Outros Serviços
        $sql = "SELECT SQL_CACHE P.idProfessor, P.nome FROM professor AS P
        WHERE P.idProfessor IN (
            SELECT professor_idProfessor FROM outrosServicos WHERE mes = " . $mes . " AND ano = " . $ano . "
        )";
		if ($idProfessor > 0 ) {
			$sql .= " AND idProfessor = ".$idProfessor;
			
		}
       $result = $this->query($sql);

        while ($valor = mysqli_fetch_array($result)) {

            $idProfessor = $valor['idProfessor'];
            $nome = $valor['nome'];

            $sql = "SELECT idDemonstrativoPagamento FROM demonstrativoPagamento WHERE professor_idProfessor = $idProfessor AND mes = $mes AND ano = $ano AND tipoDemo = 2;";
            $foiGeradoDemonstrativo = Uteis::executarQuery($sql);

            $cor = $foiGeradoDemonstrativo ? "pagamentoProf" : "";
            $html .= "<tr>";

            $onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $idProfessor . "', '$caminhoAtualizar', '$onde')\" ";
            $html .= "<td $onclick > <div class=\"" . $cor . "\" >" . $nome . "</div></td>";

            $html .= "<td align=\"center\">

                <img src=\"" . CAMINHO_IMG . "pa.png\" title=\"GERAR DEMONSTRATIVO\"
                onclick=\"abrirNivelPagina(this, '" . CAMINHO_PAG . "demonstrativo/consultoria/include/form/demonstrativo.php?idProfessor=" . $idProfessor . "&mes=" . $mes . "&ano=" . $ano . "', '$caminhoAtualizar', '$onde')\" />

                </td>";

            $html .= "</tr>";
        }

        return $html;
    }
}
