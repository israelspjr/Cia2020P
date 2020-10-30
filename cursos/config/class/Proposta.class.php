<?php
class Proposta extends Database {
	// class attributes
	var $idProposta;
	var $dataCadastro;
	var $dataExclusao;
	var $dataAprovacao;
	var $clientePjIdClientePj;
	var $idiomaIdIdioma;
	var $obs;
	var $tipoContatoIdTipoContato;
	var $gestorIdGestor;
	var $representanteIdRepresentante;
	var $statusAprovacaoIdStatusAprovacao;
	var $comoConheceuIdComoConheceu;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idProposta = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> dataExclusao = "NULL";
		$this -> dataAprovacao = "NULL";
		$this -> clientePjIdClientePj = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> obs = "NULL";
		$this -> tipoContatoIdTipoContato = "NULL";
		$this -> gestorIdGestor = "NULL";
		$this -> representanteIdRepresentante = "NULL";
		$this -> statusAprovacaoIdStatusAprovacao = "NULL";
		$this -> comoConheceuIdComoConheceu = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdProposta($value) {
		$this -> idProposta = ($value) ? $this -> gravarBD($value) : "NULL";
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

	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoContatoIdTipoContato($value) {
		$this -> tipoContatoIdTipoContato = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setGestorIdGestor($value) {
		$this -> gestorIdGestor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setRepresentanteIdRepresentante($value) {
		$this -> representanteIdRepresentante = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setStatusAprovacaoIdStatusAprovacao($value) {
		$this -> statusAprovacaoIdStatusAprovacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setComoConheceuIdComoConheceu($value) {
		$this -> comoConheceuIdComoConheceu = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addProposta() Function
	 */
	function addProposta() {
		$sql = "INSERT INTO proposta (dataCadastro, dataExclusao, dataAprovacao, clientePj_idClientePj, idioma_idIdioma, obs, tipoContato_idTipoContato, gestor_idGestor, representante_idRepresentante, statusAprovacao_idStatusAprovacao, comoConheceu_idComoConheceu) VALUES ($this->dataCadastro, $this->dataExclusao, $this->dataAprovacao, $this->clientePjIdClientePj, $this->idiomaIdIdioma, $this->obs, $this->tipoContatoIdTipoContato, $this->gestorIdGestor, $this->representanteIdRepresentante, $this->statusAprovacaoIdStatusAprovacao, $this->comoConheceuIdComoConheceu)";
//		echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}
  function insertProposta() {
    $sql = "INSERT INTO proposta (idProposta, dataCadastro, dataExclusao, dataAprovacao, clientePj_idClientePj, idioma_idIdioma, obs, tipoContato_idTipoContato, gestor_idGestor, representante_idRepresentante, statusAprovacao_idStatusAprovacao, comoConheceu_idComoConheceu) VALUES ($this->idProposta, $this->dataCadastro, $this->dataExclusao, $this->dataAprovacao, $this->clientePjIdClientePj, $this->idiomaIdIdioma, $this->obs, $this->tipoContatoIdTipoContato, $this->gestorIdGestor, $this->representanteIdRepresentante, $this->statusAprovacaoIdStatusAprovacao, $this->comoConheceuIdComoConheceu)";
    $result = $this -> query($sql, true);
    return mysqli_insert_id($this -> connect);
  }
	function updateFieldProposta($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE proposta SET " . $field . " = " . $value . " WHERE idProposta = $this->idProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateProposta() Function
	 */
	function updateProposta() {

		$sql = "UPDATE proposta SET  clientePj_idClientePj = $this->clientePjIdClientePj, idioma_idIdioma = $this->idiomaIdIdioma, obs = $this->obs, tipoContato_idTipoContato = $this->tipoContatoIdTipoContato, gestor_idGestor = $this->gestorIdGestor, statusAprovacao_idStatusAprovacao = $this->statusAprovacaoIdStatusAprovacao, comoConheceu_idComoConheceu = $this->comoConheceuIdComoConheceu WHERE idProposta = $this->idProposta";
		$result = $this -> query($sql, true);

	}

	/**
	 * selectProposta() Function
	 */
	function selectProposta($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idProposta, dataCadastro, dataExclusao, dataAprovacao, clientePj_idClientePj, idioma_idIdioma, obs, tipoContato_idTipoContato, gestor_idGestor, representante_idRepresentante, statusAprovacao_idStatusAprovacao, comoConheceu_idComoConheceu FROM proposta " . $where;
		//echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectPropostaTr($where = "", $apenasLinha = false) {

		$sql = " SELECT idProposta, I.idioma, COALESCE(PJ.razaoSocial,'Particular') AS razaoSocial
			,COALESCE(F.nome, PF.nome, P.nome, 'indefinido') AS nomeFK, ST.idStatusAprovacao, PP.dataCadastro, PP.dataAprovacao 
		FROM proposta AS PP 
		INNER JOIN idioma AS I ON I.idIdioma = PP.idioma_idIdioma 
		INNER JOIN statusAprovacao AS ST ON ST.idStatusAprovacao = PP.statusAprovacao_idStatusAprovacao 
		LEFT JOIN clientePj AS PJ ON PJ.idClientePj = PP.clientePj_idClientePj 
		LEFT JOIN gestor AS G ON G.idGestor = PP.gestor_idGestor 
		LEFT JOIN funcionario AS F ON F.idFuncionario = G.funcionario_idFuncionario 
		LEFT JOIN clientePf AS PF ON PF.idClientePf = G.clientePf_idClientePf 
		LEFT JOIN professor AS P ON P.idProfessor = G.professor_idProfessor 
		WHERE (dataExclusao = '' OR dataExclusao IS NULL) " . $where;
		//echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";
			$cont = 0;

			$caminhoAtualizar_base = CAMINHO_VENDAS . "proposta/index.php";

			while ($valor = mysqli_fetch_array($result)) {

				$idProposta = $valor['idProposta'];
				$dataCadastro = strtotime($valor['dataCadastro']);
				$idStatusAprovacao = $valor['idStatusAprovacao'];
				$idioma = $valor['idioma'];
				$razaoSocial = $valor['razaoSocial'];
				$nomeFK = $valor['nomeFK'];
				$dataCadastro = Uteis::exibirData($valor['dataCadastro']);
				$dataAprovacao = Uteis::exibirData($valor['dataAprovacao']);
				
				$caminhoAtualizar = $caminhoAtualizar_base."?tr=1&idProposta=" . $idProposta . "&ordem=" . ($cont++);
				
				$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "proposta/cadastro.php?id=" . $idProposta . "', '$caminhoAtualizar', 'tr')\" ";

				if ($valor['idStatusAprovacao'] != 1) {
					$delete = "";
				} else {
					$delete = "<center><img src=\"" . CAMINHO_IMG . "excluir.png\" 
					onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "proposta/include/acao/proposta.php', '$idProposta', '$caminhoAtualizar', 'tr')\" /></center>";
				}

				$integrantes = self::listaPessoas($idProposta);

				$ativo = Uteis::exibirStatusAprovacao($valor['idStatusAprovacao']);

				if ($apenasLinha) {

					$col = array();

					$col[] = $dataCadastro;
					$col[] = $idProposta;
					$col[] = $razaoSocial;
					$col[] = $idioma;
					$col[] = $integrantes;
					$col[] = $nomeFK;
					$col[] = $dataCadastro;
					$col[] = $dataAprovacao;
					$col[] = $ativo;
					$col[] = $delete;

					$html = $col;
					break;

				} else {

					$html .= "<tr>";

					$html .= "<td >" . $dataCadastro . "</td>";

					$html .= "<td $onclick >" . $idProposta . "</td>";

					$html .= "<td $onclick >" . $razaoSocial . "</td>";

					$html .= "<td $onclick >" . $idioma . "</td>";

					$html .= "<td $onclick >" . $integrantes . "</td>";

					$html .= "<td $onclick >" . $nomeFK . "</td>";

					$html .= "<td $onclick >" . $dataCadastro . "</td>";

					$html .= "<td $onclick >" . $dataAprovacao . "</td>";

					$html .= "<td $onclick >" . $ativo . "</td>";

					$html .= "<td >" . $delete . "</td>";

					$html .= "</tr>";

				}

			}
		}

		return $html;
	}
	
	function selectPropostaTr_hist(){
		
		$sql = " SELECT idProposta, I.idioma, COALESCE(PJ.razaoSocial,'Particular') AS razaoSocial
			,COALESCE(F.nome, PF.nome, P.nome, 'indefinido') AS nomeFK, ST.idStatusAprovacao, PP.dataCadastro, PP.dataAprovacao 
		FROM proposta AS PP 
		INNER JOIN idioma AS I ON I.idIdioma = PP.idioma_idIdioma 
		INNER JOIN statusAprovacao AS ST ON ST.idStatusAprovacao = PP.statusAprovacao_idStatusAprovacao 
		LEFT JOIN clientePj AS PJ ON PJ.idClientePj = PP.clientePj_idClientePj 
		LEFT JOIN gestor AS G ON G.idGestor = PP.gestor_idGestor 
		LEFT JOIN funcionario AS F ON F.idFuncionario = G.funcionario_idFuncionario 
		LEFT JOIN clientePf AS PF ON PF.idClientePf = G.clientePf_idClientePf 
		LEFT JOIN professor AS P ON P.idProfessor = G.professor_idProfessor 
		WHERE dataExclusao IS NOT NULL " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";
			
			while ($valor = mysqli_fetch_array($result)) {
					
				$idProposta = $valor['idProposta'];				
				$idioma = $valor['idioma'];
				$razaoSocial = $valor['razaoSocial'];
				
				$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "proposta/cadastro.php?id=" . $idProposta . "', '".CAMINHO_VENDAS . "proposta/historico.php', '')\" ";
						
				$html .= "<tr>";

				$html .= "<td >" . strtotime($valor['dataCadastro']) . "</td>";

				$html .= "<td $onclick >" . $idProposta . "</td>";

				$html .= "<td $onclick >" . $idioma . "</td>";
				
				$html .= "<td $onclick >" . $razaoSocial . "</td>";
				
				$html .= "</tr>";
				
			}
		}
		return $html;
	}
	
	function selectIntegrantesPropostaCheckBox($idProposta) {

		$ClientePf = new ClientePf();

		$sql = " SELECT DISTINCT(idIntegranteProposta), PF.nome, P.idProposta, PF.idClientePf
		FROM clientePf AS PF  
		INNER JOIN integranteProposta AS IP ON IP.clientePf_idClientePf = PF.idClientePf  
		INNER JOIN proposta AS P ON P.idProposta = IP.proposta_idProposta  		
		WHERE P.idProposta = " . $idProposta;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idClientePf = $valor['idClientePf'];

				$temEmail = $ClientePf -> getEmail($idClientePf);

				$html .= "<p>
				
				<label for=\"check_disparoEmail_integranteProposta_" . $valor['idIntegranteProposta'] . "\">
				<input type=\"checkbox\" id=\"check_disparoEmail_integranteProposta_" . $valor['idIntegranteProposta'] . "\" name=\"check_disparoEmail_integranteProposta[]\" value=\"" . $valor['idIntegranteProposta'] . "\" " . ($temEmail ? "" : "disabled") . " /> " . $valor['nome'] . ($temEmail ? "" : "(não possui e-mail)") . "</label>
				
				</p>";
			}
		}
		return $html;
	}

	function selectIntermediarioPropostaCheckBox($idProposta) {

		$ClientePf = new ClientePf();

		$sql = " SELECT DISTINCT(idIntermediarioProposta), PF.nome, P.idProposta, PF.idClientePf
		FROM clientePf AS PF  
		INNER JOIN intermediarioProposta AS IP ON IP.clientePf_idClientePf = PF.idClientePf  
		INNER JOIN proposta AS P ON P.idProposta = IP.proposta_idProposta  		
		WHERE P.idProposta = " . $idProposta;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idClientePf = $valor['idClientePf'];

				$temEmail = $ClientePf -> getEmail($idClientePf);

				$html .= "<p>
				
				<label for=\"check_disparoEmail_intermediarioProposta_" . $valor['idIntermediarioProposta'] . "\">				
				<input type=\"checkbox\" id=\"check_disparoEmail_intermediarioProposta_" . $valor['idIntermediarioProposta'] . "\" name=\"check_disparoEmail_intermediarioProposta[]\" value=\"" . $valor['idIntermediarioProposta'] . "\" " . ($temEmail ? "" : "disabled") . " /> " . $valor['nome'] . ($temEmail ? "" : "(não possui e-mail)") . "</label>";
			}
		}
		return $html;
	}

	function ImprimeProposta() {

		$IntermediarioProposta = new IntermediarioProposta();
		$IntegranteProposta = new IntegranteProposta();
		$ClientePf = new ClientePf();
		$ClientePj = new ClientePj();
		$Idioma = new Idioma();
		$StatusAprovacao = new StatusAprovacao();
		$Gestor = new Gestor();
		$ProdutoAdicionalItemValorSimuladoProposta = new ProdutoAdicionalItemValorSimuladoProposta();
		$ProdutoAdicional = new ProdutoAdicional();		
		$ValorSimuladoProposta = new ValorSimuladoProposta();
		$ItemValorSimuladoProposta = new ItemValorSimuladoProposta();
		$NaoFazAulaNestaSemanaProposta = new NaoFazAulaNestaSemanaProposta();

		$html = "<div id=\"proposta_" . $this -> idProposta . "\">";
		$html .= "<div style=\"padding:1em;padding: 1em; border: thin solid #cccccc; margin: 2em;\" class=\"body\">";		
		$html .= "<p style=\"font-size:16px\" ><strong>Informações específicas:</strong></p>";

		//DADOS DA PROPOSTA
		$html .= "<div style=\"margin-left:1em;\" >";

		$valorProposta = $this -> selectProposta(" WHERE idProposta = " . $this -> idProposta);

		$html .= "<p><strong>Número da proposta: </strong>: " . $valorProposta[0]['idProposta'] . "</p>";

		if ($valorProposta[0]['clientePj_idClientePj']) {
			$empresa = $ClientePj -> selectClientePj(" WHERE idClientePj = " . $valorProposta[0]['clientePj_idClientePj']);
			if ($empresa)
				$html .= "<p><strong>Empresa</strong>: " . $empresa[0]['razaoSocial'] . "</p>";
		}

		$idioma = $Idioma -> selectIdioma(" WHERE idIdioma = " . $valorProposta[0]['idioma_idIdioma']);
		if ($idioma)
			$html .= "<p><strong>Idioma</strong>: " . $idioma[0]['idioma'] . "</p>";

		if ($valorProposta[0]['gestor_idGestor']) {
			$nomeGestor = $Gestor -> gestorNome(" AND idGestor = " . $valorProposta[0]['gestor_idGestor']);
			$nomeGestor = $nomeGestor[0]['nomeFK'];
		} else {
			$nomeGestor = "indefinido";
		}

		if ($nomeGestor)
			$html .= "<strong>Gestor</strong>: " . $nomeGestor . "<br />";

		$status = $StatusAprovacao -> selectStatusAprovacao(" WHERE idStatusAprovacao = " . $valorProposta[0]['statusAprovacao_idStatusAprovacao']);
		if ($status)
			$html .= "<p><strong>Status da aprovação</strong>: " . $status[0]['status'] . "</p>";

		//INTERMEDIARIO
		$valorIntermediarioProposta = $IntermediarioProposta -> selectIntermediarioProposta(" WHERE proposta_idProposta = " . $this -> idProposta);
		$valorIntermediarioProposta = $valorIntermediarioProposta ? $valorIntermediarioProposta : array("0");
		$valorIntermediarioProposta = implode(",", Uteis::arrayCampoEspecifico($valorIntermediarioProposta, 'clientePf_idClientePf'));

		if ($valorIntermediarioProposta) {

			$valorClientepf = $ClientePf -> selectClientepf(" WHERE idClientePf IN(" . $valorIntermediarioProposta . ")");

			$html .= "<p><strong>Intermediário:</strong>";

			for ($row = 0; $row < count($valorClientepf, 0); $row++) {
				$nome = $valorClientepf[$row]['nome'];
				$html .= "<p style=\"margin-left:1em\" >Nome: " . $nome . "</p>";
			}

			$html .= "</p>";
		}

		//INTEGRANTE
		$valorIntegranteProposta = $IntegranteProposta -> selectIntegranteProposta(" WHERE proposta_idProposta = " . $this -> idProposta);
		$valorIntegranteProposta = $valorIntegranteProposta ? $valorIntegranteProposta : array("0");
		$valorIntegranteProposta = implode(",", Uteis::arrayCampoEspecifico($valorIntegranteProposta, 'clientePf_idClientePf'));

		if ($valorIntegranteProposta) {

			$valorClientepf = $ClientePf -> selectClientepf(" WHERE idClientePf IN(" . $valorIntegranteProposta . ")");
			$html .= "<p><strong>Integrantes:</strong>";

			for ($row = 0; $row < count($valorClientepf, 0); $row++) {
				$nome = $valorClientepf[$row]['nome'];
				$html .= "<p style=\"margin-left:1em\" >Nome: " . $nome . "</p>";
			}

			$html .= "</p>";
		}

		//VALORES SIMULADOS
		$valorValorSimuladoProposta = $ValorSimuladoProposta -> selectValorSimuladoProposta(" WHERE proposta_idProposta = " . $this -> idProposta);

		if ($valorValorSimuladoProposta) {

			$html .= "<p><strong>Opções de valores:</strong>";

			$totalMes = 0;
			$total = 0;

			for ($row = 0; $row < count($valorValorSimuladoProposta, 0); $row++) {

				$idValorSimuladoProposta = $valorValorSimuladoProposta[$row]['idValorSimuladoProposta'];
				$nome = $valorValorSimuladoProposta[$row]['nome'];

				$html .= "<p style=\"margin-left:1em\" >" . ($row + 1) . ") " . $nome . "</p>";

				$valorItemValorSimuladoProposta = $ItemValorSimuladoProposta -> selectItemValorSimuladoProposta(" WHERE valorSimuladoProposta_idValorSimuladoProposta = " . $idValorSimuladoProposta);

				$html .= "<div style=\"margin-left:2em\" >";

				for ($row2 = 0; $row2 < count($valorItemValorSimuladoProposta, 0); $row2++) {

					$html .= "<p>";

					$idItemValorSimuladoProposta = $valorItemValorSimuladoProposta[$row2]['idItemValorSimuladoProposta'];
					$valorDescontoHora = $valorItemValorSimuladoProposta[$row2]['valorDescontoHora'];
					$validadeDesconto = $valorItemValorSimuladoProposta[$row2]['validadeDesconto'];
					$valor = $valorItemValorSimuladoProposta[$row2]['valor'];
					$tipo = $valorItemValorSimuladoProposta[$row2]['tipo'];
					$horasPorAula = $valorItemValorSimuladoProposta[$row2]['horasPorAula'];
					$frequenciaSemanalAula = $valorItemValorSimuladoProposta[$row2]['frequenciaSemanalAula'];
					$cargaHorariaFixaMensal = $valorItemValorSimuladoProposta[$row2]['cargaHorariaFixaMensal'];

					$valorTotal = $ItemValorSimuladoProposta -> calculoItemValorSimuladoProposta($idItemValorSimuladoProposta);

					$textoAdicional = $valorDescontoHora ? "com desconto de R$" . Uteis::formatarMoeda($valorDescontoHora) . " por hora até " . Uteis::exibirData($validadeDesconto) : "";

					//PRODUTO ADICONAL
					$sql = "SELECT DISTINCT(produtoAdicional_idProdutoAdicional) AS produtoAdicional_idProdutoAdicional
					FROM produtoAdicionalItemValorSimuladoProposta
					WHERE itemValorSimuladoProposta_idItemValorSimuladoProposta = $idItemValorSimuladoProposta";
					$valorProdutoAdicionalItemValorSimuladoProposta = Uteis::executarQuery($sql);

					if ($valorProdutoAdicionalItemValorSimuladoProposta) {

						$valorProdutoAdicional = $ProdutoAdicional -> selectProdutoAdicional(" WHERE idProdutoAdicional IN(" . $valorProdutoAdicionalItemValorSimuladoProposta . ")");

						$textoAdicional .= ", mais adicional por hora <em>(";

						for ($row3 = 0; $row3 < count($valorProdutoAdicional, 0); $row3++) {
							$valorProduto = $valorProdutoAdicional[$row3]['valor'];
							$nomeProduto = $valorProdutoAdicional[$row3]['nome'];
							$textoAdicional .= ($row3 == 0 ? "" : ", ") . $nomeProduto . " - R$ " . Uteis::formatarMoeda($valorProduto);
						}
						$textoAdicional .= ")</em>";
					}

					if ($tipo == 'R') {
						$tipoDescricao = "Valor hora de ";
						$freq = $frequenciaSemanalAula ? $frequenciaSemanalAula . " vez(es) na semana " : "";

						//caraga fixa
						if ($cargaHorariaFixaMensal)
							$freq .= ", com uma carga horária maxima de " . Uteis::exibirHoras($cargaHorariaFixaMensal) . " no mês";

						//nao faz aula semanas
						$semanas = $NaoFazAulaNestaSemanaProposta -> selectNaoFazAulaNestaSemanaProposta(" WHERE itemValorSimuladoProposta_idItemValorSimuladoProposta = " . $idItemValorSimuladoProposta);
						$semanas = Uteis::arrayCampoEspecifico($semanas, 'semana');
						if ($semanas)
							$freq .= ", não tendo aulas toda " . implode("ª, ", $semanas) . "ª semana de cada mês";

						$textoAdicional .= ". Sendo " . Uteis::exibirHoras($horasPorAula) . " por aula " . $freq;
						$periodoPgt = "por mês";

						//total
						$totalMes += $ItemValorSimuladoProposta -> calculoItemValorSimuladoProposta($idItemValorSimuladoProposta);

					} elseif ($tipo == 'T') {

						$tipoDescricao = "Valor hora de ";
						$textoAdicional .= ", sendo um total de " . Uteis::exibirHoras($horasPorAula) . " de curso ";
						$periodoPgt = "";

						//total
						$total += $ItemValorSimuladoProposta -> calculoItemValorSimuladoProposta($idItemValorSimuladoProposta);

					} elseif ($tipo == 'E') {
						$tipoDescricao = "Valor total de ";
						$textoAdicional .= ", sendo um total de " . Uteis::exibirHoras($horasPorAula) . " de curso ";
						$periodoPgt = "";

						//total
						$total += $ItemValorSimuladoProposta -> calculoItemValorSimuladoProposta($idItemValorSimuladoProposta);
					}

					$html .= $tipoDescricao . "R$ " . Uteis::formatarMoeda($valor) . " " . $textoAdicional . ". Sub-total: R$ " . $valorTotal . " " . $periodoPgt . ".</p>";

				}

				if ($total)
					$html .= "<center><hr style=\" border:none; border-bottom:thin solid #cccccc;width: 98%;\" /></center><p><strong>TOTAL: R$ " . Uteis::formatarMoeda($total) . "</strong></p>";
				if ($totalMes)
					$html .= "<center><hr style=\" border:none; border-bottom:thin solid #cccccc;width: 98%;\" /></center><p><strong>TOTAL POR MÊS: R$ " . Uteis::formatarMoeda($totalMes) . "</strong></p>";

				$html .= "</div>";
			}
			$html .= "</p>";
		}

		$html .= "</div>";
		$html .= "</div>";
		$html .= "</div>";

		return $html;
	}

	function listaPessoas($idProposta) {

		$html = "";
		if ($idProposta) {
			$sql = "SELECT DISTINCT(P.clientePf_idClientePf), C.nome FROM (
				SELECT IP.clientePf_idClientePf, IP.proposta_idProposta FROM intermediarioProposta AS IP
				UNION 
				SELECT IP.clientePf_idClientePf, IP.proposta_idProposta FROM integranteProposta AS IP
			)  AS P
			INNER JOIN clientePf AS C ON C.idClientePf = P.clientePf_idClientePf
			WHERE P.proposta_idProposta = $idProposta";
			$rs = Uteis::executarQuery($sql);
			if ($rs) {
				foreach ($rs as $valor)
					$html .= "<div class=\"destacaLinha\">" . $valor['nome'] . "</div>";
			}
		}

		return $html;
	}
    function get_clientePj_idClientePJ($idProposta){
        $sql = "SELECT clientePj_idClientePj FROM proposta WHERE idProposta = ".$idProposta;
        $rs = Uteis::executarQuery($sql);
        return $rs[0]['clientePj_idClientePj'];
    }
	
	function getIdIdioma($idProposta) {
		$sql = "SELECT idioma_idIdioma FROM proposta WHERE idProposta = ".$idProposta;	
        $rs = Uteis::executarQuery($sql);
        return $rs[0]['idioma_idIdioma'];
		
	}
	
	function verificaStatusAprovacao($idProposta) {
		
		if ($idProposta) {
				
			$sql = "SELECT SQL_CACHE statusAprovacao_idStatusAprovacao, dataExclusao FROM proposta WHERE idProposta = $idProposta";
			$rs = Uteis::executarQuery($sql);
			return ( $rs[0]['dataExclusao'] || $rs[0]['statusAprovacao_idStatusAprovacao'] != "1" ) ? true : false;
			
		} else {
			return false;
		}
	}

}
?>