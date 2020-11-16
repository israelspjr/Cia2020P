<?php
class Endereco extends Database {
	// class attributes
	var $idEndereco;
	var $clientePjIdClientePj;
	var $clientePfIdClientePf;
	var $idPlanoAcaoGrupo;
	var $funcionarioIdFuncionario;
	var $professorIdProfessor;
    var $valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao;
	var $cidadeIdCidade;
	var $paisIdPais;
	var $zonaAtendimentoCidadeIdZonaAtendimentoCidade;
	var $principal;
	var $rua;
	var $bairro;
	var $numero;
	var $cep;
	var $complemento;
	var $obs;
	var $referencia;
	var $linkMapa;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idEndereco = "NULL";
		$this -> clientePjIdClientePj = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> idPlanoAcaoGrupo = "NULL";
		$this -> funcionarioIdFuncionario = "NULL";
		$this -> professorIdProfessor = "NULL";
        $this -> valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = 'NULL';
		$this -> cidadeIdCidade = "NULL";
		$this -> paisIdPais = "NULL";
		$this -> zonaAtendimentoCidadeIdZonaAtendimentoCidade = "NULL";
		$this -> principal = "0";
		$this -> rua = "NULL";
		$this -> bairro = "NULL";
		$this -> numero = "NULL";
		$this -> cep = "NULL";
		$this -> complemento = "NULL";
		$this -> obs = "NULL";
		$this -> referencia = "NULL";
		$this -> linkMapa = "NULL";
		$this -> excluido = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdEndereco($value) {
		$this -> idEndereco = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setidPlanoAcaoGrupo($value) {
		$this -> idPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFuncionarioIdFuncionario($value) {
		$this -> funcionarioIdFuncionario = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}
  
  function setvalorSimuladoPlanoAcao_idValorSimuladoPlanoAcao($value) {
    $this -> valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
	function setCidadeIdCidade($value) {
		$this -> cidadeIdCidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPaisIdPais($value) {
		$this -> paisIdPais = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setZonaAtendimentoCidadeIdZonaAtendimentoCidade($value) {
		$this -> zonaAtendimentoCidadeIdZonaAtendimentoCidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPrincipal($value) {
		$this -> principal = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setRua($value) {
		$this -> rua = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setBairro($value) {
		$this -> bairro = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNumero($value) {
		$this -> numero = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCep($value) {
		$this -> cep = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setComplemento($value) {
		$this -> complemento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setReferencia($value) {
		$this -> referencia = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setLinkMapa($value) {
		$this -> linkMapa = ($value) ? $this -> gravarBD(htmlspecialchars($value, ENT_QUOTES)) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addEndereco() Function
	 */
	function addEndereco() {
		$sql = "INSERT INTO endereco (clientePj_idClientePj, clientePf_idClientePf, idPlanoAcaoGrupo, funcionario_idFuncionario, professor_idProfessor, valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao, cidade_idCidade, pais_idPais, zonaAtendimentoCidade_idZonaAtendimentoCidade, principal, rua, bairro, numero, cep, complemento, obs, referencia, linkMapa, excluido) VALUES ($this->clientePjIdClientePj, $this->clientePfIdClientePf, $this->idPlanoAcaoGrupo, $this->funcionarioIdFuncionario, $this->professorIdProfessor, $this->valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao, $this->cidadeIdCidade, $this->paisIdPais, $this->zonaAtendimentoCidadeIdZonaAtendimentoCidade, $this->principal, $this->rua, $this->bairro, $this->numero, $this->cep, $this->complemento, $this->obs, $this->referencia, $this->linkMapa, $this->excluido)";
		
//		echo $sql;

		$result = $this -> query($sql, true);
		$idEnderecoUltimo = $this -> connect;

		if ($this -> principal == 1) {
			$this -> atualizarEnderecoPrincipal(($this -> connect));
		}
		
		return $idEnderecoUltimo;//($this -> connect);
	}

	/**
	 * deleteEndereco() Function
	 */
	function deleteEndereco() {
		$this -> updateFieldEndereco("excluido", "1");
	}

	/**
	 * updateFieldEndereco() Function
	 */
	function updateFieldEndereco($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE endereco SET " . $field . " = " . $value . " WHERE idEndereco = $this->idEndereco";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateEndereco() Function
	 */
	function updateEndereco() {
		$sql = "UPDATE endereco SET 
		clientePj_idClientePj = $this->clientePjIdClientePj, 
		clientePf_idClientePf = $this->clientePfIdClientePf, 
		idPlanoAcaoGrupo = $this->idPlanoAcaoGrupo,
		funcionario_idFuncionario = $this->funcionarioIdFuncionario, 
		professor_idProfessor = $this->professorIdProfessor, 
		valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = $this->valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao, cidade_idCidade = $this->cidadeIdCidade, pais_idPais = $this->paisIdPais, zonaAtendimentoCidade_idZonaAtendimentoCidade = $this->zonaAtendimentoCidadeIdZonaAtendimentoCidade, principal = $this->principal, rua = $this->rua, bairro = $this->bairro, numero = $this->numero, cep = $this->cep, complemento = $this->complemento, obs = $this->obs, referencia = $this->referencia, linkMapa = $this->linkMapa, excluido = $this->excluido WHERE idEndereco = $this->idEndereco";
		//echo "$sql";exit;
		$result = $this -> query($sql, true);

		if ($this -> principal == 1) {
			$this -> atualizarEnderecoPrincipal($this -> idEndereco);
		}

	}

	/**
	 * selectEndereco() Function
	 */
	function selectEndereco($where = "") {
		$sql = "SELECT SQL_CACHE idEndereco, clientePj_idClientePj, clientePf_idClientePf, idPlanoAcaoGrupo, funcionario_idFuncionario, professor_idProfessor, valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao, cidade_idCidade, pais_idPais, zonaAtendimentoCidade_idZonaAtendimentoCidade, principal, rua, bairro, numero, cep, complemento, obs, referencia, linkMapa, excluido FROM endereco " . $where;
		return $this -> executeQuery($sql);
	}

	function selectEnderecoTr($caminhoAbrir = "", $caminhoAtualizar, $ondeAtualiza, $where = "", $mobile = 0) {

		$sql = "SELECT SQL_CACHE E.idEndereco, E.cep, E.linkMapa, E.principal, Z.zona 
		FROM endereco AS E 
		LEFT JOIN zonaAtendimentoCidade AS Z ON E.zonaAtendimentoCidade_idZonaAtendimentoCidade = Z.idZonaAtendimentoCidade 
		WHERE E.excluido = 0 " . $where;
        //echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idEndereco = $valor['idEndereco'];
				$linkMapa = $valor['linkMapa'];
				$zona = $valor['zona'];
				$cep = $valor['cep'] ? $valor['cep'] : "sem CEP";
				$principal = $valor['principal'] == 1 ? "<img src=\"" . CAMINHO_IMG . "ativo.png \">" : "";
				
				if ($mobile == 0) {

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/endereco.php?id=$idEndereco', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "form/endereco.php?id=$idEndereco' '$ondeAtualiza');\" ";	
					
				}

				$html .= "<tr>
				
				<td $onclick >" . $this -> getEnderecoCompleto2($idEndereco) . "</td>
								
				<td align=\"center\" > " . ($linkMapa ? "<img src=\"" . CAMINHO_IMG . "mapa16.png\" title=\"Ver mapa\" onclick=\"abrirLink('$linkMapa')\" >" : "") . "</td>
				
				<td align=\"center\">" . $principal . "</td>
				
				<td align=\"center\" onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/endereco.php', '$idEndereco', '$caminhoAtualizar', '$ondeAtualiza')\" >
					<img src=\"" . CAMINHO_IMG . "excluir.png\">
				</td>
				
				</tr>";
			}
		}

		return $html;
	}

	/*
	 * atualizarEnderecoPrincipal
	 */

	function atualizarEnderecoPrincipal($id) {

		$sql = "SELECT SQL_CACHE clientePj_idClientePj, clientePf_idClientePf, funcionario_idFuncionario, professor_idProfessor 
		FROM endereco WHERE idEndereco = " . $id;
		$result = $this -> query($sql);

		if ($valor = mysqli_fetch_array($result)) {

			$this -> query("UPDATE endereco SET principal = 0 WHERE idEndereco <> " . $id . " 
			AND (clientePj_idClientePj = '" . $valor['clientePj_idClientePj'] . "' OR clientePj_idClientePj IS NULL) 
			AND (clientePf_idClientePf = '" . $valor['clientePf_idClientePf'] . "' OR clientePf_idClientePf is null) 
			AND (funcionario_idFuncionario = '" . $valor['funcionario_idFuncionario'] . "' OR funcionario_idFuncionario IS NULL) 
			AND (professor_idProfessor = '" . $valor['professor_idProfessor'] . "' OR professor_idProfessor IS NULL)");
		}
	}

	function selectEnderecoSelectAgendamento($classes = "", $idAtual = 0, $idProposta) {

		$sql = "SELECT SQL_CACHE E.idEndereco FROM endereco AS E WHERE E.excluido = 0 ";

		$html = "<select id=\"idEndereco\" name=\"idEndereco\"  class=\"" . $classes . "\" >
			<option value=\"\">Selecione</option>";

		$sql_integranteProposta = " AND E.clientePf_idClientePf IN( 
			SELECT clientePf_idClientePf FROM integranteProposta WHERE proposta_idProposta = " . $idProposta . "
		)";
		$result = $this -> query($sql . $sql_integranteProposta);

		if (mysqli_num_rows($result) > 0) {
			$html .= "<optgroup label=\"Integrantes\">";
			while ($valor = mysqli_fetch_array($result)) {
				$selecionado = $idAtual == $valor['idEndereco'] ? "selected=\"selected\"" : "";
				$html .= "<option " . $selecionado . " value=\"" . $valor['idEndereco'] . "\">" . $this -> getEnderecoCompleto($valor['idEndereco']) . "</option>";
			}
			$html .= "</optgroup>";
		}

		$sql_intermediarioProposta = " AND E.clientePf_idClientePf IN ( 
			SELECT clientePf_idClientePf FROM intermediarioProposta WHERE proposta_idProposta = $idProposta
		)";
		$result = $this -> query($sql . $sql_intermediarioProposta);

		if (mysqli_num_rows($result) > 0) {
			$html .= "<optgroup label=\"Intermediarios\">";
			while ($valor = mysqli_fetch_array($result)) {
				$selecionado = $idAtual == $valor['idEndereco'] ? "selected=\"selected\"" : "";
				$html .= "<option " . $selecionado . " value=\"" . $valor['idEndereco'] . "\">" . $this -> getEnderecoCompleto($valor['idEndereco']) . "</option>";
			}
			$html .= "</optgroup>";
		}

		$sql_clientePj = " AND E.clientePj_idClientePj IN ( SELECT clientePj_idClientePj FROM proposta WHERE idProposta = " . $idProposta . ")";
		$result = $this -> query($sql . $sql_clientePj);

		if (mysqli_num_rows($result) > 0) {
			$html .= "<optgroup label=\"Cliente Pj\">";
			while ($valor = mysqli_fetch_array($result)) {
				$selecionado = $idAtual == $valor['idEndereco'] ? "selected=\"selected\"" : "";
				$html .= "<option " . $selecionado . " value=\"" . $valor['idEndereco'] . "\">" . $this -> getEnderecoCompleto($valor['idEndereco']) . "</option>";
			}
			$html .= "</optgroup>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectEnderecoSelectPlanoAcao($classes = "", $idAtual = 0, $idPlanoAcao) {

		$sql = "SELECT SQL_CACHE E.idEndereco FROM endereco AS E WHERE E.excluido = 0 ";

		//MONTE SELECT
		$html = "<select id=\"idEndereco_aluno\" name=\"idEndereco_aluno\"  class=\"" . $classes . "\" >
		<option value=\"\">Selecione</option>";

		//ENDEREÇOS DOS INTEGRANTES
			$sqlIntegrantePlanoAcao = " AND E.clientePf_idClientePf IN( 
			SELECT clientePf_idClientePf FROM integrantePlanoAcao WHERE planoAcao_idPlanoAcao = $idPlanoAcao
		)";
	//	echo $sql.$sqlIntegrantePlanoAcao;
		$resultIntegrantePlanoAcao = $this -> query($sql . $sqlIntegrantePlanoAcao);

		if (mysqli_num_rows($resultIntegrantePlanoAcao) > 0) {

			$html .= "<optgroup label=\"Integrantes\">";

			while ($valor = mysqli_fetch_array($resultIntegrantePlanoAcao)) {
				$selecionado = ($idAtual == $valor['idEndereco']) ? "selected=\"selected\"" : "";
				$html .= "<option " . $selecionado . " value=\"" . $valor['idEndereco'] . "\">" . $this -> getEnderecoCompleto($valor['idEndereco']) . "</option>";
			}

			$html .= "</optgroup>";

		}
		$html .= "</select>";
		return $html;
	}
		
		function selectEnderecoSelectPlanoAcaoArray($classes = "", $idAtual = 0, $idPlanoAcao, $d) {

		$sql = "SELECT SQL_CACHE E.idEndereco FROM endereco AS E WHERE E.excluido = 0 ";

		//MONTE SELECT
		$html = "<select id=\"idEnderecoA_$d\" name=\"idEnderecoA_$d\"  class=\"" . $classes . "\" >
		<option value=\"\">Selecione</option>";

		//ENDEREÇOS DOS INTEGRANTES
			$sqlIntegrantePlanoAcao = " AND E.clientePf_idClientePf IN( 
			SELECT clientePf_idClientePf FROM integrantePlanoAcao WHERE planoAcao_idPlanoAcao = $idPlanoAcao
		)";
		$resultIntegrantePlanoAcao = $this -> query($sql . $sqlIntegrantePlanoAcao);

		if (mysqli_num_rows($resultIntegrantePlanoAcao) > 0) {

			$html .= "<optgroup label=\"Integrantes\">";

			while ($valor = mysqli_fetch_array($resultIntegrantePlanoAcao)) {
				$selecionado = ($idAtual == $valor['idEndereco']) ? "selected=\"selected\"" : "";
				$html .= "<option " . $selecionado . " value=\"" . $valor['idEndereco'] . "\">" . $this -> getEnderecoCompleto($valor['idEndereco']) . "</option>";
			}

			$html .= "</optgroup>";

		}
		$html .= "</select>";
		return $html;
	}

    function selectEnderecoSelectPlanoAcaoGrupoEmp($classes = "", $idAtual = 0, $idPlanoAcaoGrupo) {
		$sql = "SELECT E.idEndereco FROM planoAcaoGrupo AS P
		INNER JOIN grupoClientePj AS GCP on GCP.grupo_idGrupo = P.grupo_idGrupo
		INNER JOIN endereco AS E on E.clientePj_idClientePj = GCP.clientePj_idClientePj
		WHERE E.excluido = 0
		AND P.idPlanoAcaoGrupo = ". $idPlanoAcaoGrupo;
//	echo $sql;	
			
		
	
		//MONTE SELECT
		$html = "<select id=\"idEndereco_empresa\" name=\"idEndereco_empresa\" >
		<option value=0>Selecione</option>";
		$resultClientePj = $this -> query($sql);// . $sqlClientePj);

		if (mysqli_num_rows($resultClientePj) > 0) {			

			while ($valor = mysqli_fetch_array($resultClientePj)) {			
				$selecionado = ($idAtual == $valor['idEndereco']) ? "selected=\"selected\"" : "";
				$html .= "<option " . $selecionado . " value=\"" . $valor['idEndereco'] . "\">" . $this -> getEnderecoCompleto($valor['idEndereco']) . "</option>";
			}
			
		}
			$html .= "</select>";
		return $html;
	}
        function selectEnderecoSelectPlanoAcaoEmp($classes = "", $idAtual = 0, $idPlanoAcao, $d="") {
            $sql = "SELECT C.idEndereco from planoAcao AS A
               INNER JOIN proposta AS B
               INNER JOIN endereco AS C
               WHERE A.proposta_idProposta = B.idProposta
               AND C.clientePj_idClientePj = B.clientePj_idClientePj
               AND C.excluido <> 1
               AND A.idPlanoAcao = " . $idPlanoAcao;
   // echo $sql;
        //MONTE SELECT
        $html = "<select id=\"idEndereco_empresa$d\" name=\"idEndereco_empresa$d\" >
        <option value=0>Selecione</option>";
        

        $resultClientePj = $this -> query($sql);// . $sqlClientePj);

        if (mysqli_num_rows($resultClientePj) > 0) {         

            while ($valor = mysqli_fetch_array($resultClientePj)) {          
                $selecionado = ($idAtual == $valor['idEndereco']) ? "selected=\"selected\"" : "";
                $html .= "<option " . $selecionado . " value=\"" . $valor['idEndereco'] . "\">" . $this -> getEnderecoCompleto($valor['idEndereco']) . "</option>";
            }
            
        }
            $html .= "</select>";
        return $html;
    }


	function selectEnderecoSelect_PlanoAcaoAluno($classes = "", $idAtual = 0, $idPlanoAcaoGrupo) {

        $sql = "SELECT SQL_CACHE E.idEndereco FROM endereco AS E WHERE E.excluido = 0 ";

        //MONTE SELECT
        $html = "<select id=\"idEndereco\" name=\"idEndereco\"  class=\"" . $classes . "\" ><option value=\"\">Selecione</option>";

        //ENDEREÇOS DOS INTEGRANTES
        $sqlIntegranteGrupo = " AND E.clientePf_idClientePf IN (
            SELECT IG.clientePf_idClientePf FROM integranteGrupo AS IG 
            INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo  = IG.planoAcaoGrupo_idPlanoAcaoGrupo 
            WHERE PAG.idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . "
        )";
        $resultIntegranteGrupo = $this -> query($sql . $sqlIntegranteGrupo);

        if (mysqli_num_rows($resultIntegranteGrupo) > 0) {
          

            while ($valor = mysqli_fetch_array($resultIntegranteGrupo)) {
                $selecionado = $idAtual == $valor['idEndereco'] ? "selected=\"selected\"" : "";
                $html .= "<option " . $selecionado . " value=\"" . $valor['idEndereco'] . "\">" . $this -> getEnderecoCompleto($valor['idEndereco']) . "</option>";
            }

         

        }      

        $html .= "</select>";
        return $html;
    }	

	function selectEnderecoSelect_PlanoAcaoGrupo($classes = "", $idAtual = 0, $idPlanoAcaoGrupo) {

		$sql = "SELECT SQL_CACHE E.idEndereco FROM endereco AS E WHERE E.excluido = 0 ";

		//MONTE SELECT
		$html = "<select id=\"idEndereco\" name=\"idEndereco\"  class=\"" . $classes . "\" ><option value=\"\">Selecione</option>";

		//ENDEREÇOS DOS INTEGRANTES
		$sqlIntegranteGrupo = " AND E.clientePf_idClientePf IN (
			SELECT IG.clientePf_idClientePf FROM integranteGrupo AS IG 
			INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo  = IG.planoAcaoGrupo_idPlanoAcaoGrupo 
			WHERE PAG.idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . "
		)";
		$resultIntegranteGrupo = $this -> query($sql . $sqlIntegranteGrupo);

		if (mysqli_num_rows($resultIntegranteGrupo) > 0) {

			$html .= "<optgroup label=\"Aluno\">";

			while ($valor = mysqli_fetch_array($resultIntegranteGrupo)) {
				$selecionado = $idAtual == $valor['idEndereco'] ? "selected=\"selected\"" : "";
				$html .= "<option " . $selecionado . " value=\"" . $valor['idEndereco'] . "\">" . $this -> getEnderecoCompleto($valor['idEndereco']) . "</option>";
			}

			$html .= "</optgroup>";

		}

		//ENDEREÇOS DOS PJ

		$sqlClientePj = " AND E.clientePj_idClientePj IN (
			SELECT clientePj_idClientePj FROM grupoClientePj AS GPJ 
			INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = GPJ.grupo_idGrupo
			WHERE PAG.idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . "
		)";
		$resultClientePj = $this -> query($sql . $sqlClientePj);

		if (mysqli_num_rows($resultClientePj) > 0) {

			$html .= "<optgroup label=\"Empresa\">";

			while ($valor = mysqli_fetch_array($resultClientePj)) {
				$selecionado = $idAtual == $valor['idEndereco'] ? "selected=\"selected\"" : "";
				$html .= "<option " . $selecionado . " value=\"" . $valor['idEndereco'] . "\">" . $this -> getEnderecoCompleto($valor['idEndereco']) . "</option>";
			}

			$html .= "</optgroup>";

		}

		$html .= "</select>";
		return $html;
	}

	function getEnderecoCompleto($id) {
		if ($id) {
			$sql = "SELECT SQL_CACHE C.cidade, P.pais, U.nome AS uf, Z.zona, E.rua, E.bairro, E.numero, COALESCE(E.cep, 'sem cep') AS cep, E.complemento
			FROM endereco AS E 
			LEFT JOIN cidade AS C ON C.idCidade = E.cidade_idCidade 
			LEFT JOIN pais AS P ON P.idPais = E.pais_idPais 
			LEFT JOIN uf AS U ON U.idUf = C.uf_idUf 			
			LEFT JOIN zonaAtendimentoCidade AS Z ON E.zonaAtendimentoCidade_idZonaAtendimentoCidade = Z.idZonaAtendimentoCidade 
			WHERE E.idEndereco = $id";
           // echo $sql;
			$rs = mysqli_fetch_array($this -> query($sql));
			if ($rs['rua'] == "Por Telefone") {
				return ("<center>*** ".$rs['rua']." ***</center>");
			}
			if ($rs['rua'] == "Por Skype") {
				return ("<center>*** ".$rs['rua']." ***</center>");
			}
			 else {
           return ($rs['zona'] ? "<strong>" . $rs['zona'] . "</strong>: " : "") . "Rua " . $rs['rua'] . "," .(($rs['numero'] > 0)? "nº ".$rs['numero']:"S/n"). ", " . $rs['bairro'] . " - " . $rs['cidade'] . "/" . $rs['uf'] . " - " . $rs['cep'] . ($rs['complemento'] ? " (" . $rs['complemento'] . ")" : "");
			}
		}
	}
	
	function getEnderecoCompleto2($id) {
        if ($id) {
            $sql = "SELECT SQL_CACHE C.cidade, P.pais, U.nome AS uf, Z.zona, E.rua, E.bairro, E.numero, COALESCE(E.cep, 'sem cep') AS cep, E.complemento
            FROM endereco AS E 
            LEFT JOIN cidade AS C ON C.idCidade = E.cidade_idCidade 
            LEFT JOIN pais AS P ON P.idPais = E.pais_idPais 
            LEFT JOIN uf AS U ON U.idUf = C.uf_idUf             
            LEFT JOIN zonaAtendimentoCidade AS Z ON E.zonaAtendimentoCidade_idZonaAtendimentoCidade = Z.idZonaAtendimentoCidade 
            WHERE E.idEndereco = $id";
            $rs = mysqli_fetch_array($this -> query($sql));
            return ($rs['zona'] ? "<strong>" . $rs['zona'] . "</strong>: " : "") . "Rua " . $rs['rua'] . ", nº " . $rs['numero'] . ", " . $rs['bairro'] . " - " . $rs['cidade'] . "/" . $rs['uf'] . " - " . $rs['cep'] . ($rs['complemento'] ? " (" . $rs['complemento'] . ")" : "");
        }
    }
	
	function getEnderecoCompleto2semZona($id) {
        if ($id) {
            $sql = "SELECT SQL_CACHE C.cidade, P.pais, U.nome AS uf, Z.zona, E.rua, E.bairro, E.numero, COALESCE(E.cep, 'sem cep') AS cep, E.complemento
            FROM endereco AS E 
            LEFT JOIN cidade AS C ON C.idCidade = E.cidade_idCidade 
            LEFT JOIN pais AS P ON P.idPais = E.pais_idPais 
            LEFT JOIN uf AS U ON U.idUf = C.uf_idUf             
            LEFT JOIN zonaAtendimentoCidade AS Z ON E.zonaAtendimentoCidade_idZonaAtendimentoCidade = Z.idZonaAtendimentoCidade 
            WHERE E.idEndereco = $id";
            $rs = mysqli_fetch_array($this -> query($sql));
            return $rs['rua'] . ", nº " . $rs['numero'] . ", " . $rs['bairro'] . " - " . $rs['cidade'] . "/" . $rs['uf'] . " - " . $rs['cep'] . ($rs['complemento'] ? " (" . $rs['complemento'] . ")" : "");
        }
    }
	

	function getMapa($id) {
		$rs = $this -> selectEndereco(" WHERE idEndereco = $id");
		return html_entity_decode($rs[0]['linkMapa']);
	}

}
?>