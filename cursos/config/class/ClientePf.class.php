<?php
class ClientePf extends Database {
    // class attributes
    var $idClientePf;
    var $id_migracao;
    var $tipoClienteIdTipoCliente;
    var $nome;
    var $nomeExibicao;
    var $sexo;
    var $dataNascimento;
    var $estadoCivilIdEstadoCivil;
    var $paisIdPais;
    var $inativo;
    var $foto;
    var $cargo;
    var $clientePjIdClientePj;
    var $frequenciaEnvioPsa;
    var $naoReceberEmail;
    var $tipoDocumentoUnicoIdTipoDocumentoUnico;
    var $documentoUnico;
    var $senhaAcesso;
    var $obs;
    var $rg;
    var $dataCadastro;
    var $excluido;
    var $motivo;
    var $dataRetorno;
    var $inativaPsa;
    var $dataInativar;
    var $rf;
    var $subEmpresa;
    var $cc;
    var $politica;
    var $politicaA;
    var $dataPolitica;
	var $area;
	var $conheceu;
	var $categoria;
	var $alunoIndica;
	var $influencia;
	var $poder;
	var $clientePjIdClientePj2;

    // constructor
    function __construct() {
        parent::__construct();

        $this -> idClientePf = "NULL";
        $this -> id_migracao = "NULL";
        $this -> tipoClienteIdTipoCliente = "NULL";
        $this -> nome = "NULL";
        $this -> nomeExibicao = "NULL";
        $this -> sexo = "NULL";
        $this -> dataNascimento = "NULL";
        $this -> estadoCivilIdEstadoCivil = "NULL";
        $this -> paisIdPais = "NULL";
        $this -> inativo = "0";
        $this -> foto = "NULL";
        $this -> cargo = "NULL";
        $this -> clientePjIdClientePj = "NULL";
        $this -> naoReceberEmail = "0";
        $this -> tipoDocumentoUnicoIdTipoDocumentoUnico = "NULL";
        $this -> documentoUnico = "NULL";
        $this -> senhaAcesso = "NULL";
        $this -> obs = "NULL";
        $this -> rg = "NULL";
        $this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
        $this -> excluido = "0";
        $this -> motivo = "NULL";
        $this -> dataRetorno = "NULL";
        $this -> inativaPsa = "0";
        $this -> dataInativar = "NULL";
        $this -> rf = "NULL";
        $this -> subEmpresa = "NULL";
        $this -> cc = "NULL";
        $this -> politica = "NULL";
        $this -> politicaA = "0";
        $this -> dataPolitica = "NULL";
		$this -> area = "0";
		$this -> conheceu = "0";
		$this -> categoria = "0";
		$this -> alunoIndica = "0";
		$this -> influencia = "0";
		$this -> poder = "0";
		$this -> clientePjIdClientePj2 = "NULL";
    }

    function __destruct() {
        parent::__destruct();
    }

    // class methods
    function setIdClientePf($value) {
        $this -> idClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setId_migracao($value) {
        $this -> id_migracao = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setTipoClienteIdTipoCliente($value) {
        $this -> tipoClienteIdTipoCliente = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setNome($value) {
        $this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setNomeExibicao($value) {
        $this -> nomeExibicao = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setSexo($value) {
        $this -> sexo = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setDataNascimento($value) {
        $this -> dataNascimento = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setEstadoCivilIdEstadoCivil($value) {
        $this -> estadoCivilIdEstadoCivil = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setPaisIdPais($value) {
        $this -> paisIdPais = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setInativo($value) {
        $this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
    }

    function setFoto($value) {
        $this -> foto = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setCargo($value) {
        $this -> cargo = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setClientePjIdClientePj($value) {
        $this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setNaoReceberEmail($value) {
        $this -> naoReceberEmail = ($value) ? $this -> gravarBD($value) : "0";
    }

    function setTipoDocumentoUnicoIdTipoDocumentoUnico($value) {
        $this -> tipoDocumentoUnicoIdTipoDocumentoUnico = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setDocumentoUnico($value) {
        $this -> documentoUnico = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setSenhaAcesso($value) {
        $value = EncryptSenha::B64_Encode($value);
        $this -> senhaAcesso = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setObs($value) {
        $this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setRg($value) {
        $this -> rg = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setDataCadastro($value) {
        //$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setExcluido($value) {
        $this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
    }

    function setMotivo($value) {
        $this -> motivo = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setDataRetorno($value) {
        $this -> dataRetorno = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setInativaPsa($value) {
        $this -> inativaPsa = ($value) ? $this -> gravarBD($value) : "0";
    }

    function setDataInativar($value) {
        $this -> dataInativar = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setCc($value) {
        $this -> cc = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setRf($value) {
        $this -> rf = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setSubEmpresa($value) {
        $this -> subEmpresa = ($value) ? $this -> gravarBD($value) : "NULL";
    }
	
	function setConheceu($value) {
        $this -> conheceu = ($value) ? $this -> gravarBD($value) : "0";
    }
	
    function setPolitica($value) {
        $this -> politica = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setPoliticaA($value) {
        $this -> politicaA = ($value) ? $this -> gravarBD($value) : "0";
    }

    function setDataPolitica($value) {
        $this -> dataPolitica = ($value) ? $this -> gravarBD($value) : "NULL";
    }
	
	function setArea($value) {
        $this -> area = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setCategoria($value) {
        $this -> categoria = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setAlunoIndica($value) {
        $this -> alunoIndica = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setInfluencia($value) {
        $this -> influencia = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setPoder($value) {
        $this -> poder = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setClientePjIdClientePj2($value) {
        $this -> clientePjIdClientePj2 = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function getRf($id) {
        $rs = $this -> selectClientepf(" WHERE idClientePf = $id");
        return $rs[0]['rf'];
    }

    function getCc($id) {
        $rs = $this -> selectClientepf(" WHERE idClientePf = $id");
        return $rs[0]['cc'];
    }

    function getSubEmpresa($id) {
        $rs = $this -> selectClientepf(" WHERE idClientePf = $id");
        return $rs[0]['subEmpresa'];
    }

    function getDataPolitica($id) {
        $rs = $this -> selectClientepf(" WHERE idClientePf = $id AND politicaA = 1");
        return $rs[0]['dataPolitica'];
    }
	
	function getFuncao($id) {
        $rs = $this -> selectClientepf(" WHERE idClientePf = $id");
        return $rs[0]['cargo'];
    }

    function getCategoria($id) {
        $rs = $this -> selectClientepf(" WHERE idClientePf = $id");
        return $rs[0]['categoria'];
    }
	
	function getAlunoIndica($id) {
        $rs = $this -> selectClientepf(" WHERE idClientePf = $id");
        return $rs[0]['alunoIndica'];
    }
	
	function getInfluencia($id) {
        $rs = $this -> selectClientepf(" WHERE idClientePf = $id");
        return $rs[0]['influencia'];
    }
	
	function getPoder($id) {
        $rs = $this -> selectClientepf(" WHERE idClientePf = $id");
        return $rs[0]['poder'];
    }
	
	function getStatus($id) {
        $rs = $this -> selectClientepf(" WHERE idClientePf = $id");
        return $rs[0]['inativo'];
    }
	
	function getDocumentoUnico($id) {
		 $rs = $this -> selectClientepf(" WHERE idClientePf = $id");
        return $rs[0]['documentoUnico'];
	}

    /**
     * addClientepf() Function
     */
    function addClientepf() {

        $sql = "INSERT INTO clientePf (id_migracao, tipoCliente_idTipoCliente, nome, nomeExibicao, sexo, dataNascimento, estadoCivil_idEstadoCivil, pais_idPais, inativo, foto, cargo, clientePj_idClientePj, naoReceberEmail, tipoDocumentoUnico_idTipoDocumentoUnico, documentoUnico, senhaAcesso, obs, rg, dataCadastro, excluido,motivo,dataRetorno, inativaPsa, dataInativar, rf, subEmpresa, cc, politica, politicaA, dataPolitica, area, conheceu, categoria, alunoIndica, influencia, poder,clientePj_idClientePj2) VALUES ($this->id_migracao, $this->tipoClienteIdTipoCliente, $this->nome, $this->nomeExibicao, $this->sexo, $this->dataNascimento, $this->estadoCivilIdEstadoCivil, $this->paisIdPais, $this->inativo, $this->foto, $this->cargo, $this->clientePjIdClientePj, $this->naoReceberEmail, $this->tipoDocumentoUnicoIdTipoDocumentoUnico, $this->documentoUnico, $this->senhaAcesso, $this->obs, $this->rg, $this->dataCadastro, $this->excluido,$this->motivo,$this->dataRetorno, $this->inativaPsa, $this->dataInativar, $this->rf, $this->subEmpresa, $this->cc, $this->politica, $this->politicaA, $this->dataPolitica, $this->area, $this->conheceu, $this->categoria, $this->alunoIndica, $this->influencia, $this->poder, $this->clientePjIdClientePj2)";
        $result = $this -> query($sql, true);
        return mysqli_insert_id($this -> connect);
    }

    /**
     * deleteClientepf() Function
     */
    function deleteClientepf() {
        $sql = "DELETE FROM clientePf WHERE idClientePf = $this->idClientePf";
        $result = $this -> query($sql, true);
    }

    /**
     * updateFieldClientepf() Function
     */
    function updateFieldClientepf($field, $value) {
        $value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
        $sql = "UPDATE clientePf SET " . $field . " = " . $value . " WHERE idClientePf = $this->idClientePf";
        //echo $sql;
        $result = $this -> query($sql, true);
    }

    /**
     * updateClientepf() Function
     */
    function updateClientepf() {
        $sql = "UPDATE clientePf SET id_migracao = $this->id_migracao, tipoCliente_idTipoCliente = $this->tipoClienteIdTipoCliente, nome = $this->nome, nomeExibicao = $this->nomeExibicao, sexo = $this->sexo, dataNascimento = $this->dataNascimento, estadoCivil_idEstadoCivil = $this->estadoCivilIdEstadoCivil, pais_idPais = $this->paisIdPais, inativo = $this->inativo, foto = $this->foto, cargo = $this->cargo, clientePj_idClientePj = $this->clientePjIdClientePj, naoReceberEmail = $this->naoReceberEmail, tipoDocumentoUnico_idTipoDocumentoUnico = $this->tipoDocumentoUnicoIdTipoDocumentoUnico, documentoUnico = $this->documentoUnico, senhaAcesso = $this->senhaAcesso, obs = $this->obs, rg = $this->rg, motivo = $this->motivo, dataRetorno = $this->dataRetorno, inativaPsa = $this->inativaPsa, dataInativar = $this->dataInativar, rf = $this->rf, subEmpresa = $this->subEmpresa, cc = $this->cc, politica = $this->politica, politicaA = $this->politicaA, dataPolitica = $this->dataPolitica, area = $this->area, excluido = $this->excluido, conheceu = $this->conheceu, categoria = $this->categoria, alunoIndica = $this->alunoIndica, influencia = $this->influencia, poder = $this->poder, clientePj_idClientePj2 = $this->clientePjIdClientePj2  WHERE idClientePf = $this->idClientePf";
  //      	echo $sql;
        $result = $this -> query($sql, true);
    }

    /**
     * selectClientepf() Function
     */
    function selectClientepf($where = "WHERE 1") {
        $sql = "SELECT SQL_CACHE idClientePf, id_migracao, tipoCliente_idTipoCliente, nome, nomeExibicao, sexo, dataNascimento, estadoCivil_idEstadoCivil, pais_idPais, inativo, foto, cargo, clientePj_idClientePj, naoReceberEmail, tipoDocumentoUnico_idTipoDocumentoUnico, documentoUnico, senhaAcesso, obs, rg, dataCadastro, excluido, motivo, dataRetorno, inativaPsa, dataInativar, rf, subEmpresa, cc, politica, politicaA, dataPolitica, area, conheceu, categoria, alunoIndica, influencia, poder, clientePj_idClientePj2 FROM clientePf " . $where;
        //	echo $sql;
        return $this -> executeQuery($sql);
    }

    function selectClientepfTr_hist(){

        $sql = "SELECT SQL_CACHE PF.idClientePf, PF.nome, PF.inativo, PF.documentoUnico, PJ.razaoSocial
		FROM clientePf AS PF
		LEFT JOIN clientePj AS PJ ON PJ.idClientePj = PF.clientePj_idClientePj 
		WHERE PF.excluido = 1 " . $where;
        //echo $sql;
        $result = $this -> query($sql);

        if (mysqli_num_rows($result) > 0) {

            $html = "";

            $caminhoAtualizar = CAMINHO_CAD . "clientePf/index.php";

            while ($valor = mysqli_fetch_array($result)) {

                $idClientePf = $valor['idClientePf'];

                $nome = $valor['nome'];
                $documentoUnico = $valor['documentoUnico'];
                $ativo = Uteis::exibirStatus(!$valor['inativo']);

                $onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "clientePf/cadastro.php?id=" . $idClientePf . "', '".CAMINHO_CAD . "clientePf/historico.php', '')\" ";

                $html .= "<tr>";

                $html .= "<td $onclick >" . $nome . "</td>";

                $html .= "<td $onclick >" . $documentoUnico . "</td>";

                $html .= "<td $onclick >" . $ativo . "</td>";

                $html .= "</tr>";

            }
        }
        return $html;
    }

    function selectClientepfTr($where = "", $apenasLinha = false, $grupo1 = "",$pendentes, $excel = false) {
		
		$FechamentoGrupo = new FechamentoGrupo();
		$Relatorio = new Relatorio();
		$ClientePj = new ClientePj();
		$paginador = new Paginador($sql,25);
		$IntegranteGrupo = new IntegranteGrupo();
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();

        $total_reg = "10"; //Registro por página
        //echo $grupo1;

        if ($pendentes == 1) {
            $sql = "SELECT SQL_CACHE IG.planoAcaoGrupo_idPlanoAcaoGrupo, G.nome , G.idGrupo, PF.idClientePf, PF.nome, PF.inativo, PF.clientePj_idClientePj
		FROM planoAcaoGrupo AS PAG
		INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
		AND G.inativo = 1
		INNER JOIN integranteGrupo AS IG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
		INNER JOIN clientePf AS PF ON PF.idClientePf = IG.clientePf_idClientePf 
		WHERE PAG.inativo = 0 " . $where;
        } else {
			
			if ($grupo1 == '') {
			
            $sql = "SELECT SQL_CACHE PF.idClientePf, PF.nome, PF.inativo, PF.clientePj_idClientePj, PF.clientePj_idClientePj2, PF.categoria, PF.alunoIndica
		FROM clientePf AS PF WHERE 1 ". $where;
			} else {
			$sql = "SELECT SQL_CACHE IG.planoAcaoGrupo_idPlanoAcaoGrupo, G.nome as grupoNome, G.idGrupo, PF.idClientePf, PF.nome, PF.inativo, PF.clientePj_idClientePj, PF.clientePj_idClientePj2
		FROM planoAcaoGrupo AS PAG
		INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
		INNER JOIN integranteGrupo AS IG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
		INNER JOIN clientePf AS PF ON PF.idClientePf = IG.clientePf_idClientePf WHERE G.idGrupo = ".$grupo1."  ".$where;	
				
			}

        }
        
        $result = $this -> query($sql);

        if (mysqli_num_rows($result) > 0) {

            $html = "";
            $cont = 0;
			$nomeExt = "";

            $caminhoAtualizar_base = CAMINHO_CAD . "clientePf/index.php";

            while ($valor = mysqli_fetch_array($result)) {
				
				$categorias = 0;
				$nomeExt = "";

                $idClientePf = $valor['idClientePf'];
				$alunoIndica = $valor['alunoIndica'];
				$cat = explode(",", $valor['categoria']);
				
				if ($alunoIndica == 1) {
					$nomeExt = "<img src=\"".CAMINHO_IMG."diamante.png\" width=\"18\" height=\"18\" title=\"Aluno Indica\" >";
					
				}
				
				if ($cat != '') {
					
					foreach ($cat AS $valor2) {
						$categorias++;
					}
					$nomeExt .= "  ".$categorias."<img src=\"".CAMINHO_IMG."estrela.gif\">";
					
				}
                

                $nome = $valor['nome'] ."<br>". $nomeExt;
                if($valor['clientePj_idClientePj']!='')
                    $razaoSocial = $ClientePj->getNome($valor['clientePj_idClientePj']);
                else
                    $razaoSocial = "";
					
				if($valor['clientePj_idClientePj2']!='')
                    $razaoSocial2 = $ClientePj->getNome($valor['clientePj_idClientePj2']);
                else
                    $razaoSocial2 = "";
					
					$razaoSocial .= "<br>".$razaoSocial2;
					
                if (!$excel) $ativo = Uteis::exibirStatus(!$valor['inativo']);

                $caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idClientePf=" . $idClientePf;
                if ($apenasLinha) {
                    $caminhoAtualizar .= "&ordem=" . $apenasLinha;
                } else {
                    $caminhoAtualizar .= "&ordem=" . ($cont++);
                }

                $onclick = " onclick=\"abrirNivelPagina(this, '". CAMINHO_CAD ."clientePf/cadastro.php?id=$idClientePf', '".$caminhoAtualizar."', 'tr')\" ";

               if (!$excel) $delete = "<center>
					<img src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"deletaRegistro('" . CAMINHO_CAD . "clientePf/include/acao/clientepf.php', '" . $idClientePf . "', '".$caminhoAtualizar."', 'tr')\" />
				</center>";

          //     if ($grupo1 == "on") {
                    $whereG = " AND IG.dataEntrada <= CURDATE()
				AND (IG.dataSaida >= CURDATE() OR IG.dataSaida IS NULL OR IG.dataSaida = '') AND CPF.idClientePf = $idClientePf ";
                    $rsGrupo = $this -> gruposClientePf($whereG);
                    $grupos = "";
           //     }
		   
		   		//Nivel atual
					$sql = "SELECT SQL_CACHE idIntegranteGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, clientePf_idClientePf, dataEntrada, dataSaida, obs, dataSaidaDemonstrativo, dataRetorno  FROM integranteGrupo
		WHERE  clientePf_idClientePf =" . $idClientePf." ORDER BY idIntegranteGrupo DESC limit 1";
				$rs2  = Uteis::executarQuery($sql);
				
				$idGrupo = $rs2[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
				$nivelAtual = $PlanoAcaoGrupo->getIdNivel($idGrupo, true);
	
                $telefones = " ";
                $sql = " SELECT clientePf_idClientePf, ddd, numero, DT.nome FROM telefone INNER JOIN descricaoTelefone AS DT ON descricaoTelefone_idDescricaoTelefone = DT.idDescricaoTelefone WHERE clientePf_idClientePf = ".$idClientePf." limit 3";

                $rsTelefone = $this->query($sql);
                if(mysqli_num_rows($rsTelefone) > 0){
                    while ($valorTelefone = mysqli_fetch_array($rsTelefone)) {
                        $telefones .= " <div class=\"destacaLinha\"> [".$valorTelefone['nome']."] (".$valorTelefone['ddd'].") ".$valorTelefone['numero']."</div>";

                    }
                }

                $emails = " ";
                $sql = " SELECT valor FROM enderecoVirtual WHERE clientePf_idClientePf = ".$idClientePf;
                $rsEmail = $this->query($sql);
                if(mysqli_num_rows($rsEmail) > 0){
                    while ($valorEmail = mysqli_fetch_array($rsEmail)) {
                        $emails .= " <div class=\"destacaLinha\">".$valorEmail['valor']."</div>";
                    }
                }

                if ($rsGrupo) {
                    foreach ($rsGrupo as $valorGrupo) {
						
						$valorDataF = $FechamentoGrupo->selectFechamentoGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$valorGrupo['planoAcaoGrupo_idPlanoAcaoGrupo'] . " AND tipo <> 2 Order By idFechamentoGrupo DESC");
						
						$valorTexto = $FechamentoGrupo->retornaTipo($valorDataF[0]['tipo']);
						
						if ($valorTexto != '') {
						$style = "style=\"color:red\"";	
						$obsGrupo = $valorTexto;
							
						} else {
						$style = "";
						$obsGrupo = "";	
							
						}
						
                        $grupos .= " <div class=\"destacaLinha\"
						onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=" . $valorGrupo['planoAcaoGrupo_idPlanoAcaoGrupo'] . "', '' , '')\" $style >" . $valorGrupo['nome'] . "<br>".$obsGrupo."</div>";
                    }
                }
				
				if ($rsGrupo == '') {
						 $grupos .= " <div class=\"destacaLinha\"
						onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=" . $valorGrupo['planoAcaoGrupo_idPlanoAcaoGrupo'] . "', '' , '')\" $style >" . $valor['grupoNome'] . "<br>".$obsGrupo."</div>";
				}

                if ($apenasLinha) {

                    $col = array();

                    $col[] = $nome;
                    $col[] = $emails;
                    $col[] = $telefones;
                    $col[] = $grupos;
                    $col[] = $razaoSocial;
                    $col[] = $ativo;
					$col[] = $nivelAtual;
                    $col[] = $delete;

                    $html = $col;
                    break;

                } else {

                    $html .= "<tr>";
                    $html .= "<td $onclick >" . $nome . "</td>";
                    $html .= "<td >" . $emails . "</td>";
                    $html .= "<td>" . $telefones . "</td>";
                    $html .= "<td>" . $grupos . "</td>";
                    $html .= "<td $onclick >" . $razaoSocial . "</td>";
                    $html .= "<td $onclick >" . $ativo . "</td>";
					$html .= "<td $onclick >" . $nivelAtual . "</td>";
                    $html .= "<td >$delete</td>";
                    $html .= "</tr>";

                }
            }
			
			$colunas = array("Nome", "Email", "Telefone", "Grupo", "Empresa", "Status", "Nivel Atual", "");
			
			if ($excel == true) {
			$html_base = $Relatorio->montaTb($colunas, true, "", 1);
			
			return $html_base .$html; 
			
				
			} else {

            return $html;
			
			}
        }
    }
	
	
    /**
     * gruposClientePf() Function
     */
    function gruposClientePf($where = "") {

        $sql = "SELECT SQL_CACHE IG.planoAcaoGrupo_idPlanoAcaoGrupo, G.nome , G.idGrupo
		FROM planoAcaoGrupo AS PAG
		INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
		INNER JOIN integranteGrupo AS IG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
		INNER JOIN clientePf AS CPF ON CPF.idClientePf = IG.clientePf_idClientePf 
		WHERE PAG.inativo = 0 " . $where;
        //	echo "<br>$sql";
        $rs = Uteis::executarQuery($sql);

        return $rs;
    }

    function selectClientePfSelect($classes = "", $idAtual = 0, $and, $status = 0) {

        $sql = "SELECT SQL_CACHE idClientePf, nome FROM clientePf
		WHERE inativo = ".$status." AND excluido = 0 " . $and . " ORDER BY nome";
        $result = $this -> query($sql);
        //echo $sql;
		if($status == 0) {

        $html = "<select id=\"idClientePf\" name=\"idClientePf\"  class=\"" . $classes . "\" >
		<option value=\"\">Selecione</option>";
		$html .= "<option value=\"novo\">Novo Registro</option>";
		} else {
		$html = "<select id=\"idClientePfI\" name=\"idClientePfI\"  class=\"" . $classes . "\" >
		<option value=\"\">Selecione</option>";
			
			
		}
		
        while ($valor = mysqli_fetch_array($result)) {
            $selecionado = $idAtual == $valor['idClientePf'] ? "selected=\"selected\"" : "";
            $html .= "<option " . $selecionado . " value=\"" . $valor['idClientePf'] . "\">" . ($valor['nome']) . "</option>";
        }
        
        $html .= "</select>";
        return $html;
    }

    function selectGrupoAluno($caminhoAbrir = "", $caminhoAtualizar = "", $onde = "", $where,$mobile) {

        $sql = "SELECT SQL_CACHE DISTINCT(P.idPlanoAcaoGrupo), P.planoAcao_idPlanoAcao, G.nome, G.idGrupo, NI.nivel
		FROM clientePf AS C
		INNER JOIN integranteGrupo AS I ON I.clientePf_idClientePf = C.idClientePf
		INNER JOIN planoAcaoGrupo AS P ON P.idPlanoAcaoGrupo = I.planoAcaoGrupo_idPlanoAcaoGrupo
		INNER JOIN nivelEstudo AS NI ON NI.IdNivelEstudo = P.nivelEstudo_IdNivelEstudo 
		INNER JOIN grupo AS G ON G.idGrupo = P.grupo_idGrupo" . $where ." 
		ORDER BY G.nome, NI.nivel";
        $result = $this -> query($sql);
    //    echo $sql;
        if (mysqli_num_rows($result) > 0) {

            $html = "";
            $GrupoClientePj = new GrupoClientePj();

            while ($valor = mysqli_fetch_array($result)) {

                $idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
                $idPlanoAcao = $valor['planoAcao_idPlanoAcao'];
                $empresa = $GrupoClientePj -> getNomePJ($valor['idGrupo']);
                $nivel = $valor['nivel'];
				
				if ($mobile != 1) {

                $onclick = " onclick=\"abrirNivelPagina(this, '$caminhoAbrir?idPlanoAcaoGrupo=$idPlanoAcaoGrupo', '$caminhoAtualizar', '$onde')\" ";
				
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('$caminhoAbrir?idPlanoAcaoGrupo=$idPlanoAcaoGrupo',  '$onde');\" ";

				}

                $html .= "<tr>";

                $html .= "<td $onclick >" . $empresa . "</td>";

                $html .= "<td $onclick >" . $valor['nome'] . "</td>";

                $html .= "<td $onclick >" . $nivel . "</td>";

                $html .= "<td >";
				
				if ($mobile != 1) {
				$html .= "	<center><img onclick=\"abrirNivelPagina(this, '" . CAMINHO_MODULO . "planoAcao/index.php?idPlanoAcao=" . $idPlanoAcao . "', '$caminhoAtualizar', '$onde')\"
					src=\"" . CAMINHO_IMG . "pa.png\" title=\"Visualizar plano de ação\" /></center>";
				} else {
				$html .= "	<center><img onclick=\"zerarCentro();carregarModulo('modulos/planoAcao/index.php?idPlanoAcao=" . $idPlanoAcao . "', '$onde');\"
					src=\"" . CAMINHO_IMG . "pa.png\" title=\"Visualizar plano de ação\" /></center>";
				
					
				}
				
				$html .= "</td>";

                $html .= "</tr>";

            }
        }

        return ($html);

    }

    function selectGrupoAlunoMes($caminhoAbrir, $caminhoAtualizar, $onde, $where,$mobile) {
		
        $ContestacaoFF = new ContestacaoFF();

        $where .= " ORDER By idFolhaFrequencia DESC";

        $sql = "SELECT SQL_CACHE DISTINCT(F.idFolhaFrequencia) AS idFolhaFrequencia, PR.nome, PR.idProfessor, P.idPlanoAcaoGrupo, MONTH(F.dataReferencia) AS mes, YEAR(F.dataReferencia) AS ano
		FROM clientePf AS C
		INNER JOIN integranteGrupo AS I ON I.clientePf_idClientePf = C.idClientePf
		INNER JOIN planoAcaoGrupo AS P ON I.planoAcaoGrupo_idPlanoAcaoGrupo = P.idPlanoAcaoGrupo
		INNER JOIN grupo AS G ON P.grupo_idGrupo = G.idGrupo
		INNER JOIN folhaFrequencia AS F ON F.planoAcaoGrupo_idPlanoAcaoGrupo = P.idPlanoAcaoGrupo AND F.finalizadaParcial = 1
		INNER JOIN professor AS PR ON PR.idProfessor = F.professor_idProfessor
		INNER JOIN diaAulaFF AS D ON F.idFolhaFrequencia = D.folhaFrequencia_idFolhaFrequencia " . $where;

//		echo $sql;

        $result = $this -> query($sql);

        if (mysqli_num_rows($result) > 0) {

            $html = "";

            while ($valor = mysqli_fetch_array($result)) {

                $idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
                $idFolhaFrequencia = $valor['idFolhaFrequencia'];
                $idProfessor = $valor['idProfessor'];
                $nome = $valor['nome'];
                $mes = $valor['mes'];
                $ano = $valor['ano'];
				
				if($mobile != 1) {

                $onclick = " onclick=\"abrirNivelPagina(this, '$caminhoAbrir?idPlanoAcaoGrupo=$idPlanoAcaoGrupo&idFolhaFrequencia=$idFolhaFrequencia&idProfessor=$idProfessor&mes=$mes&ano=$ano', '$caminhoAtualizar?idPlanoAcaoGrupo=$idPlanoAcaoGrupo', '$onde')\" ";
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo( '$caminhoAbrir?idPlanoAcaoGrupo=$idPlanoAcaoGrupo&idFolhaFrequencia=$idFolhaFrequencia&idProfessor=$idProfessor&mes=$mes&ano=$ano', '$onde')\" ";
				}

                if ($mes <10 ) {
                    $mes = "0".$mes;
                }


                $html .= "<tr>";

                $html .= "<td ></td>";

                $html .= "<td $onclick >" . $nome . "</td>";

                $html .= "<td $onclick > 01/".$mes."/".$ano." </td>";

                $where2 = " WHERE folhaFrequencia_idFolhaFrequencia = $idFolhaFrequencia AND integranteGrupo_idIntegranteGrupo IN (
	SELECT idIntegranteGrupo FROM integranteGrupo 
	WHERE clientePf_idClientePf = " . $_SESSION['idClientePf_SS'] . " AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo
)  order by idContestacaoFF DESC LIMIT 1";
                $rsContestacaoFF = $ContestacaoFF -> selectContestacaoFF($where2);
                $html .= "<td>";

                if($rsContestacaoFF){
                    foreach($rsContestacaoFF as $valorsContestacaoFF){
                        $conf = $valorsContestacaoFF["status"] == 1 ? "confirmada" : "contestada";
                        $obs = $valorsContestacaoFF["obs"] ? "<br />Comentário: ".$valorsContestacaoFF["obs"] : "";
                        $dataCadastroCFF = Uteis::exibirDataHora($valorsContestacaoFF["dataCadastro"]);

                        $html .= "Folha <strong>".$conf."</strong> pelo aluno em ".$dataCadastroCFF.$obs;

                    }
                } else {

                    $html .= "<font color=\"#FF0000\" style=\"font-weight:bold\"> Folha não confirmada pelo aluno. </font>";
                }


                $html .= "</td>";

                $html .= "</tr>";

            }
        }
        return $html;
    }

    function selectGrupoAlunoMesDetalhes($where = "", $soFinalizadasPri = true, $email) {

        $Relatorio = new Relatorio();
        $OcorrenciaFF = new OcorrenciaFF();
        $result = $Relatorio->relatorioFrequencia_porAula($where, $soFinalizadasPri);

        if ($result) {

            $html = "";
            $totalHG = 0;
            $totalHA = 0;

            foreach($result as $valor){
				
				$atestado = $valor['obs'];
				
				if ($valor['diaAula'] < 10) {
				$dia = "0".$valor['diaAula'];	
				} else {
				$dia = $valor['diaAula'];		
				}
				
				if ($valor['mes'] < 10) {
				$mes1 = "0".$valor['mes'];	
				} else {
				$mes1 = $valor['mes'];		
				}
				
				$dataAula = $valor['ano']."-".$mes1."-".$dia;
	
                if ($valor['sigla'] != "") {

                    $valorDescricaoSigla = $OcorrenciaFF->selectOcorrenciaFF(" WHERE sigla = '".$valor['sigla']."'");
                    $descricaoSigla = $valorDescricaoSigla[0]['decricaoSigla'];
					$idOcorrenciaFF = $valorDescricaoSigla[0]['idOcorrenciaFF'];

                }
				
				if  (($idOcorrenciaFF == 2) || ($idOcorrenciaFF == 10) || ($idOcorrenciaFF == 15)) {
				$horasRealizadas = $valor['horasProgramadas'];	
				$totalHG += $valor['horasProgramadas'];
					
				} else {
				$horasRealizadas = 	$valor['horasRealizadasPeloGrupo'];
				$totalHG += $valor['horasRealizadasPeloGrupo'];	
				}

                $html .= "<tr " . ($valor['reposicao'] ? "class=\"reposicao\"" : "") . ">";

                $html .= "<td align=\"center\" >" . $valor['diaAula'] . "</td>";

                $html .= "<td align=\"center\">" . Uteis::exibirHoras($horasRealizadas)
                    . ($valor['sigla']  ? " <font color=\"#F00\">".$descricaoSigla."</font>"  : "" )
                    ."</td>";
   				
				if ($dataAula < $valor['dataEntrada']) {
					$html .= "<td style=\"center;color:red;text-align:center;\">Aluno não registrado</td>";
					
				} else {
			//	echo $valor['dataEntrada'];
				
				if ($email != 1) {

                $bt_justifica = "<img src=\"".CAMINHO_IMG."pa.png\" title=\"Justificar Falta\"";
                $bt_justifica .= "onclick=\"justificaFalta('".$valor['idDiaAulaFFIndividual']."', 'obscampo".$valor['idDiaAulaFFIndividual']."', '')\" />";
				
				$bt_justifica .= "   <img src=\"".CAMINHO_IMG."upload_file.png\" onclick=\"$('#add_file').click();addAtestado(".$valor['idDiaAulaFFIndividual'].");\" title=\"Anexar atestado\" /> <font id=\"visualizarFile_".$valor['idDiaAulaFFIndividual']."\" >";
                
              if( $atestado ){
	$bt_justifica .=	"<a href=\"". CAMINHO_UP."/atestados/".$atestado."\" target=\"_blank\" >";
	$bt_justifica .=	"<img src=\"". CAMINHO_IMG."contrato.png\" title=\"Visualizar\" /></a>";
            } 
		 
      $bt_justifica .= "</font> ";
	
                $df_justifica = (Uteis::exibirHoras($valor['horaRealizadaAluno'])=="00:00")? $bt_justifica : '';
				
				$html .= "<td align=\"center\">" . Uteis::exibirHoras($valor['horaRealizadaAluno'])
                    . "<small style=\"color:red\" id=\"obscampo".$valor['idDiaAulaFFIndividual']."\"><br />"
                    . ((strlen($valor['obsFaltaJustificada'])>2)  ? $valor['obsFaltaJustificada']  : $df_justifica )
                    . "</small></td>";
				} else {
					
				$html .= "<td align=\"center\">" . Uteis::exibirHoras($valor['horaRealizadaAluno'])
                    . "<small style=\"color:red\" id=\"obscampo".$valor['idDiaAulaFFIndividual']."\"><br />"
                    . ((strlen($valor['obsFaltaJustificada'])>2)  ? $valor['obsFaltaJustificada']  : " " )
                    . "</small></td>";	
					
				}

                $totalHA += $valor['horaRealizadaAluno'];
				}
                $html .= "</tr>";
                //Uteis::pr($valor);break;

            }
            //Totais
            $html .= "<tfoot><tr><td align=\"center\">Total : </td><td align=\"center\">".Uteis::exibirHoras($totalHG)."</td><td align=\"center\">".Uteis::exibirHoras($totalHA)."</td></tr></tfoot>";
        }
        return $html;
    }

    function getNome($id) {
        $rs = $this -> selectClientepf(" WHERE idClientePf = $id");
        return $rs[0]['nome'];
    }

    function getEmail($id, $soUm) {

        $emails = array();

        $sql = " SELECT E.valor, E.ePrinc FROM clientePf AS C
		INNER JOIN enderecoVirtual AS E ON E.clientePf_idClientePf = C.idClientePf AND E.tipoEnderecoVirtual_idTipoEnderecoVirtual = 1 		
		WHERE E.ePrinc = 1 AND C.naoReceberEmail = 0 AND C.idClientePf = " . $id;
  //      echo "//".$sql;//exit;
        $result = $this -> query($sql);
        while ($valor = mysqli_fetch_array($result)) {
            $emails = $valor['valor'];
            $soUmEmail = $valor['valor'];
        }
        if ($soUm == 1) {
            return $soUmEmail;
        } else {
            return $emails;
        }
    }

    function selectAlunosEmpresa($where = "", $idAtual=0) {

        $sql = "	SELECT distinct(IPA.clientePf_idClientePf), CPF.nome FROM grupoClientePj as GCPJ
		inner join planoAcaoGrupo as PAG on GCPJ.grupo_idGrupo = PAG.grupo_idGrupo
		inner join integranteGrupo as IPA on IPA.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
		inner join clientePf as CPF on CPF.idClientePf = IPA.clientePf_idClientePf
		where GCPJ.clientePj_idClientePj ".$where." order by CPF.nome";

        $result = $this->query($sql);

        $html = "<select id=\"idClientePf\" name=\"idClientePf\" >
		<option value=\"\">Selecione</option>";

        while ($valor = mysqli_fetch_array($result)) {
            $selecionado = $idAtual == $valor['idClientePf'] ? "selected=\"selected\"" : "";
            $html .= "<option value=\"" . $valor['clientePf_idClientePf'] . "\">" . ($valor['nome']) . "</option>";
        }
        //	$html .= "<option value=\"novo\">Novo Registro</option>";
        $html .= "</select>";
        return $html;
    }
}