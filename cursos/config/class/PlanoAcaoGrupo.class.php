<?php
class PlanoAcaoGrupo extends Database {

	// class attributes
	var $idPlanoAcaoGrupo;
	var $planoAcaoIdPlanoAcao;
	var $grupoIdGrupo;
	var $dataCadastro;
	var $dataInicioEstagio;
	var $dataPrevisaoTerminoEstagio;
	var $inativo;
	var $categoria;
	var $nivelEstudoIdNivelEstudo;
	var $dataValidade;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPlanoAcaoGrupo = "NULL";
		$this -> planoAcaoIdPlanoAcao = "NULL";
		$this -> grupoIdGrupo = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> dataInicioEstagio = "NULL";
		$this -> dataPrevisaoTerminoEstagio = "NULL";
		$this -> inativo = "0";
		$this -> categoria = "NULL";
		$this -> nivelEstudoIdNivelEstudo = "NULL";
		$this -> dataValidade = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPlanoAcaoGrupo($value) {
		$this -> idPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoIdPlanoAcao($value) {
		$this -> planoAcaoIdPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setGrupoIdGrupo($value) {
		$this -> grupoIdGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setDataInicioEstagio($value) {
		$this -> dataInicioEstagio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataPrevisaoTerminoEstagio($value) {
		$this -> dataPrevisaoTerminoEstagio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setCategoria($value) {
		$this -> categoria = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNivelEstudoIdNivelEstudo($value) {
		$this -> nivelEstudoIdNivelEstudo = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setDataValidade($value) {
		$this -> dataValidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addPlanoAcaoGrupo() Function
	 */
	function addPlanoAcaoGrupo() {
		$sql = "INSERT INTO planoAcaoGrupo (planoAcao_idPlanoAcao, grupo_idGrupo, dataCadastro, dataInicioEstagio, dataPrevisaoTerminoEstagio, inativo, categoria, nivelEstudo_IdNivelEstudo) VALUES ($this->planoAcaoIdPlanoAcao, $this->grupoIdGrupo, $this->dataCadastro, $this->dataInicioEstagio, $this->dataPrevisaoTerminoEstagio, $this->inativo, $this->categoria, $this->nivelEstudoIdNivelEstudo)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deletePlanoAcaoGrupo() Function
	 */
	function deletePlanoAcaoGrupo() {
		$sql = "DELETE FROM planoAcaoGrupo WHERE idPlanoAcaoGrupo = $this->idPlanoAcaoGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPlanoAcaoGrupo() Function
	 */
	function updateFieldPlanoAcaoGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE planoAcaoGrupo SET " . $field . " = " . $value . " WHERE idPlanoAcaoGrupo = $this->idPlanoAcaoGrupo";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePlanoAcaoGrupo() Function
	 */
	function updatePlanoAcaoGrupo() {
		$sql = "UPDATE planoAcaoGrupo 	SET dataInicioEstagio = $this->dataInicioEstagio, dataPrevisaoTerminoEstagio = $this->dataPrevisaoTerminoEstagio, inativo = $this->inativo, categoria = $this->categoria 	WHERE idPlanoAcaoGrupo = $this->idPlanoAcaoGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPlanoAcaoGrupo() Function
	 */
	function selectPlanoAcaoGrupo($where = "") {
		$sql = "SELECT SQL_CACHE idPlanoAcaoGrupo, planoAcao_idPlanoAcao, grupo_idGrupo, dataCadastro, dataInicioEstagio, dataPrevisaoTerminoEstagio, inativo, categoria, nivelEstudo_IdNivelEstudo, dataValidade FROM planoAcaoGrupo " . $where;
     //   echo $sql;
		return $this -> executeQuery($sql);
	}
  
  function selectPlanoAcaoGrupoJoin($where = "") {
    $sql = "SELECT SQL_CACHE PAG.idPlanoAcaoGrupo, PAG.planoAcao_idPlanoAcao, PAG.grupo_idGrupo, PAG.dataCadastro, PAG.dataInicioEstagio, PAG.dataPrevisaoTerminoEstagio, PAG.inativo, PAG.categoria, PAG.nivelEstudo_IdNivelEstudo FROM planoAcaoGrupo AS PAG " . $where;

    return $this -> executeQuery($sql);
  }
  
	/**
	 * selectPlanoAcaoGrupoSelect() Function
	 */
	function selectPlanoAcaoGrupoSelect($classes = "", $idAtual = 0, $where = "") {

		$sql = "SELECT SQL_CACHE idPlanoAcaoGrupo, planoAcao_idPlanoAcao, grupo_idGrupo, dataCadastro, dataInicioEstagio, 
		dataPrevisaoTerminoEstagio, inativo, categoria, nivelEstudo_IdNivelEstudo FROM planoAcaoGrupo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idPlanoAcaoGrupo\" name=\"idPlanoAcaoGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idPlanoAcaoGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idPlanoAcaoGrupo'] . "\">" . ($valor['idPlanoAcaoGrupo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function getNomeGrupo($idPlanoAcaoGrupo, $passaId = false) {
		$sql = "SELECT SQL_CACHE G.nome, G.idGrupo FROM planoAcaoGrupo PAG INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo WHERE idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo;
		$result = $this -> query($sql);
		if ($valor = mysqli_fetch_array($result)) {
			if ($passaId == true) {
				return $valor['idGrupo'];
			} else {
				return $valor['nome'];
			}
		}
	}

	function getIdIdioma($idPlanoAcaoGrupo) {
		$PlanoAcao = new PlanoAcao();
		$rs = $this -> selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = $idPlanoAcaoGrupo");
		$idPlanoAcao = $rs[0]['planoAcao_idPlanoAcao'];
		return $PlanoAcao -> getIdIdioma($idPlanoAcao);
	}

	function getIdNivel($idPlanoAcaoGrupo, $nome = false) {

		$sql = "SELECT SQL_CACHE PA.nivelEstudo_IdNivelEstudo, N.nivel
		FROM planoAcaoGrupo AS PAG 
		INNER JOIN planoAcao AS PA ON PA.idPlanoAcao = PAG.PlanoAcao_idPlanoAcao
		INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = PA.nivelEstudo_IdNivelEstudo 
		WHERE PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo ";

		$result = $this -> query($sql);
		if ($valor = mysqli_fetch_array($result)) {
			return !$nome ? $valor['nivelEstudo_IdNivelEstudo'] : $valor['nivel'];
		}
	}

	function getIdFoco($idPlanoAcaoGrupo) {

		$sql = "SELECT SQL_CACHE pa.focoCurso_idFocoCurso FROM planoAcaoGrupo pag 
		INNER JOIN planoAcao pa ON pa.idPlanoAcao = pag.PlanoAcao_idPlanoAcao 
		WHERE pag.idPlanoAcaoGrupo = $idPlanoAcaoGrupo ";

		$result = $this -> query($sql);
		if ($valor = mysqli_fetch_array($result)) {
			return $valor['focoCurso_idFocoCurso'];
		}
	}

	function listaMaterial($idPlanoAcaoGrupo) {

		$html = "";

		//KIT DE MATERIAL
		$sql = "SELECT SQL_CACHE MD.nome, EMD.editora, TMD.tipo FROM planoAcaoGrupo AS PAG 
		INNER JOIN planoAcaoGrupoKitMaterial AS PAGK ON 
			PAGK.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo AND dataInicio <= CURDATE() 
			AND ( dataFim >= CURDATE() OR dataFim = '' OR dataFim IS NULL) 
		INNER JOIN kitMaterialDidatico AS KMD ON KMD.kitMaterial_idKitMaterial = PAGK.kitMaterial_idKitMaterial  
		INNER JOIN materialDidatico AS MD ON MD.idMaterialDidatico = KMD.materialDidatico_idMaterialDidatico 
		LEFT JOIN editoraMaterialDidatico AS EMD ON EMD.idEditoraMaterialDidatico = MD.materialDidaticoTipo_idMaterialDidaticoTipo 
		LEFT JOIN tipoMaterialDidatico AS TMD ON TMD.idTipoMaterialDidatico = MD.materialDidaticoTipo_idMaterialDidaticoTipo  
		WHERE PAG.idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . " UNION SELECT MD.nome, EMD.editora, TMD.tipo FROM planoAcaoGrupo AS PAG 
		INNER JOIN planoAcaoGrupoMaterialDidatico AS PAMD ON PAMD.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo 
			AND dataInicio <= CURDATE() AND  ( dataFim >= CURDATE() OR dataFim = '' OR dataFim IS NULL) 
		INNER JOIN materialDidatico AS MD ON MD.idMaterialDidatico = PAMD.materialDidatico_idMaterialDidatico 
		LEFT JOIN editoraMaterialDidatico AS EMD ON EMD.idEditoraMaterialDidatico = MD.materialDidaticoTipo_idMaterialDidaticoTipo  
		LEFT JOIN tipoMaterialDidatico AS TMD ON TMD.idTipoMaterialDidatico = MD.materialDidaticoTipo_idMaterialDidaticoTipo  
		WHERE PAG.idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . " UNION SELECT PAMM.nome, '' AS editora, '' AS tipo 
		FROM planoAcaoGrupo AS PAG 
		INNER JOIN planoAcaoGrupoMaterialMontado AS PAMM ON PAMM.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo 
		WHERE PAG.idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo;
		//echo $sql;
		$valor = Uteis::executarQuery($sql);

		$html .= "<div style=\"margin-left:2em;\" >";

		if ($valor) {
			for ($row = 0; $row < count($valor, 0); $row++) {
				$nome = $valor[$row]['nome'];
				$editora = $valor[$row]['editora'] ? " - " . $valor[$row]['editora'] : "";
				$tipo = $valor[$row]['tipo'] ? " - " . $valor[$row]['tipo'] : "";
				$html .= $nome . $tipo . $editora . "; ";
			}
		}
		$html .= "</div>";
		return $html;
	}

	//AREA ALUNO
	function selectPlanoAcaoGrupoTr_grupoIntegrante($idClientePf, $caminhoAtualizar, $ondeAtualiza) {

		$sql = " SELECT DISTINCT(P.idPlanoAcaoGrupo), G.nome, PAG.planoAcao_idPlanoAcao, G.idGrupo 
		FROM planoAcaoGrupo AS P 
		INNER JOIN planoAcaoGrupo AS PAG ON P.idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo 		
		INNER JOIN grupo AS G ON G.idGrupo = P.grupo_idGrupo 
		INNER JOIN integranteGrupo AS IG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo 
		WHERE IG.idIntegranteGrupo IN (
			SELECT idIntegranteGrupo FROM integranteGrupo WHERE clientePf_idClientePf = " . $idClientePf . ")";
		$rsGrupos = $this -> query($sql);

		$html = "";

		if (mysqli_num_rows($rsGrupos) > 0) {

			$html = "";

			$DiaAulaFF = new DiaAulaFF();
			$BancoHoras = new BancoHoras();

			while ($valor = mysqli_fetch_array($rsGrupos)) {

				$idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];

				$html .= "<tr>";

				$html .= "<td>" . $valor['nome'] . "</td>
				
				<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_BH . "resourceHTML/bancoHoras.php?id=" . $idPlanoAcaoGrupo . "', '$caminhoAtualizar', '$ondeAtualiza')\">";

				$where = " WHERE idDiaAulaFF IN ( ";
				$where .= " SELECT DFF.idDiaAulaFF FROM planoAcaoGrupo AS PAG ";
				$where .= " INNER JOIN folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo ";
				$where .= " INNER JOIN diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia AND DFF.reposicao = 1 ";
				$where .= " WHERE PAG.idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . ")";
				$totalReposicao = $DiaAulaFF -> selectDiaAulaFF_qtdHoras($where);

				$where = " WHERE diaAulaFF_idDiaAulaFF IN ( ";
				$where .= " SELECT diaAulaFF_idDiaAulaFF FROM planoAcaoGrupo AS PAG ";
				$where .= " INNER JOIN folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo ";
				$where .= " INNER JOIN diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia ";
				$where .= " INNER JOIN bancoHoras AS BH ON BH.diaAulaFF_idDiaAulaFF = DFF.idDiaAulaFF ";
				$where .= " WHERE PAG.idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . ")";
				$totalBanco = $BancoHoras -> selectBancoHoras_qtdHoras($where);

				$saldoHoras = $totalBanco - $totalReposicao;

				if ($saldoHoras) {
					if ($saldoHoras >= 0) {
						$obs = " de crédito";
					} else {
						$saldoHoras *= -1;
						$obs = " em débito";
					}
				} else {
					$saldoHoras = "0";
					$obs = "";
				}

				$html .= Uteis::exibirHoras($saldoHoras) . $obs . "</td>
				
				</tr>";

			}
		}

		return $html;

	}

	function mudancaEstagio_previstas($caminhoAtualizar, $onde, $where = "", $feitas = 0) {
		
		$NivelEstudo = new NivelEstudo();
	     
		 if ($feitas == 0) {
		$sql = "SELECT SQL_CACHE PAG.idPlanoAcaoGrupo, G.nome AS nomeGrupo, G.idGrupo, PAG.dataPrevisaoTerminoEstagio
		, MONTH(PAG.dataPrevisaoTerminoEstagio) AS mes, YEAR(PAG.dataPrevisaoTerminoEstagio) AS ano";
		 } else {
		$sql = "SELECT SQL_CACHE PAG.idPlanoAcaoGrupo, G.nome AS nomeGrupo, G.idGrupo, PAG.dataInicioEstagio
		, MONTH(PAG.dataInicioEstagio) AS mes, YEAR(PAG.dataInicioEstagio) AS ano";
		 
		 }
		
		
		$sql .= "
		FROM planoAcaoGrupo AS PAG 
		INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo 
		INNER JOIN grupoClientePj AS GCP on GCP.grupo_idGrupo = G.idGrupo
		INNER JOIN gerenteTem as GT on GT.clientePj_idClientePj = GCP.clientePj_idClientePj
					AND GT.dataExclusao is null
		WHERE idPlanoAcaoGrupo NOT IN (
			SELECT idPlanoAcaoGrupo FROM planoAcao AS PA2 
			INNER JOIN planoAcaoGrupo AS PAG2 ON PAG2.grupo_idGrupo = PA2.grupo_idGrupo
		) " . $where;
		
		$rs = $this -> query($sql);

		$html = "";

		if (mysqli_num_rows($rs) > 0) {

			$GerenteTem = new GerenteTem();

			while ($valor = mysqli_fetch_array($rs)) {

				$idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
				$idPlanoAcao = self::getIdPlanoAcao($idPlanoAcaoGrupo);
				$mes = $valor['mes'];
				$ano = $valor['ano'];
				if ($feitas == 0) {
				$dataTermino = Uteis::exibirData($valor['dataPrevisaoTerminoEstagio']);
				} else {
				$dataTermino = Uteis::exibirData($valor['dataInicioEstagio']);	
				}
				
				$and = " AND idPlanoAcaoGrupo NOT IN (".$idPlanoAcaoGrupo.")";
				
				$valorNivel = self::getPAG_total($valor['idGrupo'],0,$and);
				if (count($valorNivel) > 0) {
				$niveis = "";
				for ($x=0; $x<count($valorNivel);$x++) {
					
				$niveis .= $NivelEstudo->getNome($valorNivel[$x]['nivelEstudo_IdNivelEstudo'])."<br>";	
					
				}
				} else {
				$niveis = "Sem estágio anterior";	
					
				}
				
				$mesAtual = date("m");
				$anoAtual = date("Y");
				
				if (($mes < $mesAtual) && ( $ano <= $anoAtual)&& ($feitas == 0)) {
				
				$nomeGrupo = "<font color=\"RED\" ><strong>" . $valor['nomeGrupo'] . "</strong></font>";
	
				} else {
					
				$nomeGrupo = "<font color=\"green\" ><strong>" . $valor['nomeGrupo'] . "</strong></font>";	
				}
		
				$nomeNivel = $this -> getIdNivel($idPlanoAcaoGrupo, true);

				$html .= "<tr>
				
				<td align=\"center\" >
					<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"Grupo\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_MODULO . "relacionamento/grupo/cadastro.php?id=$idPlanoAcaoGrupo', '$caminhoAtualizar', '$onde')\" >
				</td>
				
				<td >$nomeGrupo</td>";
				if ($feitas == 1) {
				$html .= "<td> $niveis</td>";
				}
				
				$html .= "<td >$nomeNivel</td>
				
				<td>$dataTermino</td>
				
				<td align=\"center\" >
					<img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Iniciar mudança de estágio\" 
					onclick=\"abrirNivelPagina(this, '" . CAMINHO_MODULO . "relacionamento/mudanca/cadastro.php?id=$idPlanoAcao&mes=$mes&ano=$ano', '$caminhoAtualizar', '$onde')\" />
				</td>
				
				</tr>";
			}
		}

		return $html;

	}

	function verificaMudancaEstagio($where) {
		$sql = "SELECT DISTINCT(G.idGrupo), G.nome AS nomeGrupo, PA.idPlanoAcao, PAG.idPlanoAcaoGrupo, N.nivel, PA.statusAprovacao_idStatusAprovacao
		, PA.mesReferenciaMudanca, PA.anoReferenciaMudanca
		FROM planoAcao AS PA
		INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = PA.nivelEstudo_IdNivelEstudo
		INNER JOIN grupo AS G ON G.idGrupo = PA.grupo_idGrupo
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo AND PAG.inativo = 0
		WHERE PA.idPlanoAcao NOT IN(
			SELECT PA2.idPlanoAcao FROM planoAcao AS PA2
			INNER JOIN planoAcaoGrupo AS PAG2 ON PAG2.planoAcao_idPlanoAcao = PA2.idPlanoAcao
		) " . $where;
		//echo "//".$sql;
		return Uteis::executarQuery($sql);
	}

	function mudancaEstagio($caminhoAtualizar, $onde, $where = "") {

		$html = "";

		$rs = $this -> verificaMudancaEstagio($where);

		if ($rs) {

			$GerenteTem = new GerenteTem();

			foreach ($rs as $valor) {

				$idPlanoAcao = $valor['idPlanoAcao'];
				$idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
				$idStatusAprovacao = $valor['statusAprovacao_idStatusAprovacao'];
				// == "2"; // ? true : false;
				$nomeGrupo = "<font color=\"" . $GerenteTem -> selectGerenteTem_cor($idPlanoAcaoGrupo) . "\" ><strong>" . $valor['nomeGrupo'] . "</strong></font>";
				$nivel = $valor['nivel'];

				$html .= "<tr>
					
				<td align=\"center\" >
					<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"Grupo\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=$idPlanoAcaoGrupo', '$caminhoAtualizar', '$onde')\" >
				</td>
				
				<td >
					$nomeGrupo
				</td>
				
				<td $onclick >$nivel</td>
				
				<td align=\"center\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_MODULO . "relacionamento/mudanca/cadastro.php?id=$idPlanoAcao', '$caminhoAtualizar', '$onde')\" >
					" . ($idStatusAprovacao ? Uteis::exibirStatusAprovacao($idStatusAprovacao) : "<img title=\"Novo plano de ação\" src=\"" . CAMINHO_IMG . "pa.png\">") . "
					" . ($idPlanoAcao ? " <strong>$idPlanoAcao</strong>" : "") . "					
				</td>
				
				<td align=\"center\" >
					" . ($idStatusAprovacao == 2 ? "<img title=\"Finalizar retorno do grupo\" src=\"" . CAMINHO_IMG . "success.png\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_MODULO . "relacionamento/mudanca/include/form/finalizar.php?id=$idPlanoAcao', '$caminhoAtualizar', '$onde')\" >" : "") . "
				</td>				
				
				</tr>";
			}
		}

		return $html;

	}

	function inativaGrupos($idGrupo) {
		$rs = $this -> selectPlanoAcaoGrupo(" WHERE grupo_idGrupo = $idGrupo");
		foreach ($rs as $valor) {
			$this -> idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
			$this -> updateFieldPlanoAcaoGrupo("inativo", "1");
		}
	}

	function getIdGrupo($id) {
		$rs = $this -> selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = $id");
		return $rs[0]['grupo_idGrupo'];
	}
	
	function getDataValidade($id) {
		$rs = $this -> selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = $id");
		return $rs[0]['dataValidade'];
	}

	function getIdPlanoAcao($id) {
		$rs = $this -> selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = $id");
		return $rs[0]['planoAcao_idPlanoAcao'];
	}
	
	function getInativo($id) {
		$rs = $this -> selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = $id");
		return $rs[0]['inativo'];
	}

	function getPAG_atual($idGrupo) {
		$PlanoAcao = new PlanoAcao();
		$rs = $this -> selectPlanoAcaoGrupo(" WHERE grupo_idGrupo = $idGrupo AND inativo = 0");
		return $rs[0]['idPlanoAcaoGrupo'];
	}
	
	function getPAGPrimeiro($idGrupo) {
		$rs = $this -> selectPlanoAcaoGrupo(" WHERE grupo_idGrupo = $idGrupo ORDER BY idPlanoAcaoGrupo ASC");
		return $rs[0]['idPlanoAcaoGrupo'];
	}
	
	function getPAG_total($idGrupo, $id,$and = "" ) {
		$PlanoAcao = new PlanoAcao();
		$rs = $this -> selectPlanoAcaoGrupo(" WHERE grupo_idGrupo = $idGrupo". $and);
		
		if ($id != 1) {
		return $rs; //[0]['idPlanoAcaoGrupo'];
		} else {
		return $rs[0]['idPlanoAcaoGrupo'];
		}
	}
	
	function getTodosPAG($idPlanoAcaoGrupo) {
		$idGrupo = $this ->getIdGrupo($idPlanoAcaoGrupo);	
				
		if ($idGrupo > 0) {
		$sql = "SELECT idPlanoAcaoGrupo FROM planoAcaoGrupo where grupo_idGrupo = ".$idGrupo;
		$result = $this ->query($sql);
		
		if (mysqli_num_rows($result) > 0) {

            $html = "";

            while ($valor = mysqli_fetch_array($result)) {
				
			$html .= $valor['idPlanoAcaoGrupo'].",";	
				
				}
		}
	
			$html .= "0";
	
		}
		
		return $html;
		
	}
	
	
	
	
	function selectIntegrantesGrupoCheckBox($idPlanoAcaoGrupo,$x = 0, $inativar = 0) {

        $ClientePf = new ClientePf();
		
		$dataAtual = date("Y-m-t");
		
        $sql = " SELECT DISTINCT(idIntegranteGrupo), PF.nome, PF.idClientePf";
		if ($x == 1) {
			$sql .= ", PF.motivo, PF.inativo, PF.dataRetorno, PF. dataInativar ";	
			
		}
        $sql .= " FROM clientePf AS PF  
        INNER JOIN integranteGrupo AS IG ON IG.clientePf_idClientePf = PF.idClientePf          
        WHERE (IG.dataSaida is null OR IG.dataSaida <= '".$dataAtual."') AND IG.planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo;
    //    echo $sql;
        $result = $this -> query($sql);
        if (mysqli_num_rows($result) > 0) {

            $html = "";

            while ($valor = mysqli_fetch_array($result)) {
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				$dataRetorno = Uteis::exibirData($valor['dataRetorno']);
				$dataInativar = Uteis::exibirData($valor['dataInativar']);
				$motivo = $valor['motivo'];

                $idClientePf = $valor['idClientePf'];

                $temEmail = $ClientePf -> getEmail($idClientePf);
				
				$sql2 = "SELECT DISTINCT
    (idIntegranteGrupo),
    PF.nome,
    G.nome
FROM
    clientePf AS PF
        INNER JOIN
    integranteGrupo AS IG ON IG.clientePf_idClientePf = PF.idClientePf
		INNER JOIN
	planoAcaoGrupo AS PAG on PAG.idPlanoAcaoGrupo = IG.planoAcaoGrupo_idPlanoAcaoGrupo
		AND PAG.inativo = 0
		INNER JOIN
	grupo AS G on G.idGrupo = PAG.grupo_idGrupo
WHERE
    (IG.dataSaida IS NULL) AND PF.idClientePf =".$idClientePf;
   //     OR IG.dataSaida <= '".$dataAtual."')
        
		
	//	echo $sql2;
		
		$valorG = Uteis::executarQuery($sql2);
		
		$nomeGrupo = "";
		$x = 0;
		foreach ($valorG AS $valor2) {
			$nomeGrupo .= $valor2['nome']." ";
			$x++;
		}
		
		if (($inativar == 1) && ($x > 1)) {
			$html2 =  $valor['nome'] . "<strong> Não é possivel inativar o aluno, faça o desvinculo dos outros grupos:".$nomeGrupo."</strong>";
				
			
		} else {
			 $html2 = "<input type=\"checkbox\" id=\"check_disparoEmail_integranteGrupo_" . $valor['idIntegranteGrupo'] . "\" name=\"check_disparoEmail_integranteGrupo[]\" value=\"" . $valor['idClientePf'] . "\" " . ($temEmail ? "" : "disabled") . " /> " . $valor['nome'] . ($temEmail ? "" : "(não possui e-mail)") . "</label>";
					
			
		}
			

                $html .= "<p>                
                <label for=\"check_disparoEmail_integranteGrupo_" . $valor['idIntegranteGrupo'] . "\">";
				
				$html .= $html2;
				              
               
				if ($x == 1) {
					if ($valor['inativo'] == 1) {
					$html .= "Status: ".$inativo." Data Inativado: ".$dataInativar. "  Data Retorno: ".$dataRetorno."  Motivo: ".$motivo;	
					}
				}
				
				$html .= "</p>
                <input type=\"hidden\" id=\"idIntegranteGrupo\" name=\"idIntegranteGrupo[".$valor['idClientePf']."]\" value=\"".$valor['idIntegranteGrupo']."\">";
            }
        }
        return $html;
    }
	
	function totalReposto($idPlanoAcaoGrupo) {
	
		$sql = "select sum(DFF.horaRealizada) as total	FROM folhaFrequencia AS FF 
				INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo AND FF.finalizadaPrincipal = 1
				INNER JOIN professor AS P ON P.idProfessor = FF.professor_idProfessor 
				INNER JOIN diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia	AND (DFF.reposicao = 1 or DFF.ocorrenciaFF_idOcorrenciaFF = 7)
				WHERE FF.planoAcaoGrupo_idPlanoAcaoGrupo in ($idPlanoAcaoGrupo) ";
		$rs = Uteis::executarQuery($sql);
		
		return $rs;	
		
	}
}
?>