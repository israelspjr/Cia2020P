<?php
class BuscaProfessor extends Database {
	// class attributes
	var $idBuscaProfessor;
	var $aulaPermanenteGrupoIdAulaPermanenteGrupo;
	var $aulaDataFixaIdAulaDataFixa;
	var $obs;
	var $urgente;
	var $dataApartir;
	var $finalizada;
	var $excluida;
	var $origem;
	var $tipoBuscaIdTipoBusca;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idBuscaProfessor = "NULL";
		$this -> aulaPermanenteGrupoIdAulaPermanenteGrupo = "NULL";
		$this -> aulaDataFixaIdAulaDataFixa = "NULL";
		$this -> obs = "NULL";
		$this -> urgente = "0";
		$this -> dataApartir = "NULL";
		$this -> finalizada = "0";
		$this -> excluida = "0";
		$this -> origem = "NULL";
		$this -> tipoBuscaIdTipoBusca = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdBuscaProfessor($value) {
		$this -> idBuscaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAulaPermanenteGrupoIdAulaPermanenteGrupo($value) {
		$this -> aulaPermanenteGrupoIdAulaPermanenteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAulaDataFixaIdAulaDataFixa($value) {
		$this -> aulaDataFixaIdAulaDataFixa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setUrgente($value) {
		$this -> urgente = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataApartir($value) {
		$this -> dataApartir = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFinalizada($value) {
		$this -> finalizada = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluida($value) {
		$this -> excluida = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setOrigem($value) {
		$this -> origem = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoBuscaIdTipoBusca($value) {
		$this -> tipoBuscaIdTipoBusca = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addBuscaProfessor() Function
	 */
	function addBuscaProfessor() {
		$sql = "INSERT INTO buscaProfessor (aulaPermanenteGrupo_idAulaPermanenteGrupo, aulaDataFixa_idAulaDataFixa, obs, urgente, dataApartir, finalizada, excluida, origem, tipoBusca_idTipoBusca) VALUES ($this->aulaPermanenteGrupoIdAulaPermanenteGrupo, $this->aulaDataFixaIdAulaDataFixa, $this->obs, $this->urgente, $this->dataApartir, $this->finalizada, $this->excluida, $this->origem, $this->tipoBuscaIdTipoBusca)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteBuscaProfessor() Function
	 */
	function deleteBuscaProfessor() {
		$sql = "DELETE FROM buscaProfessor WHERE idBuscaProfessor = $this->idBuscaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldBuscaProfessor() Function
	 */
	function updateFieldBuscaProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE buscaProfessor SET " . $field . " = " . $value . " WHERE idBuscaProfessor = $this->idBuscaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateBuscaProfessor() Function
	 */
	function updateBuscaProfessor() {
		$sql = "UPDATE buscaProfessor SET aulaPermanenteGrupo_idAulaPermanenteGrupo = $this->aulaPermanenteGrupoIdAulaPermanenteGrupo, aulaDataFixa_idAulaDataFixa = $this->aulaDataFixaIdAulaDataFixa, obs = $this->obs, urgente = $this->urgente, dataApartir = $this->dataApartir, finalizada = $this->finalizada, excluida = $this->excluida, origem = $this->origem, tipoBusca_idTipoBusca = $this->tipoBuscaIdTipoBusca WHERE idBuscaProfessor = $this->idBuscaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectBuscaProfessor() Function
	 */
	function selectBuscaProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idBuscaProfessor, aulaPermanenteGrupo_idAulaPermanenteGrupo, aulaDataFixa_idAulaDataFixa, obs, urgente, dataApartir, finalizada, excluida, origem, tipoBusca_idTipoBusca FROM buscaProfessor " . $where;
		//echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectBuscaProfessorSelect() Function
	 */
	function selectBuscaProfessorSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idBuscaProfessor, aulaPermanenteGrupo_idAulaPermanenteGrupo, aulaDataFixa_idAulaDataFixa, obs, urgente, dataApartir, finalizada, excluida, origem, tipoBusca_idTipoBusca FROM buscaProfessor " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idBuscaProfessor\" name=\"idBuscaProfessor\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idBuscaProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idBuscaProfessor'] . "\">" . ($valor['idBuscaProfessor']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectBuscaProfessorTr($where = "", $caminhoAtualizar_base, $apenasLinha = false) {

		$EtapaValidacaoBusca = new EtapaValidacaoBusca();
		$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada = new EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada();
		$OpcaoBuscaProfessorSelecionada = new OpcaoBuscaProfessorSelecionada();
		$GerenteTem = new GerenteTem();
		$Gerente = new Gerente();

		$sql_corpo = " FROM buscaProfessor AS B 
		LEFT JOIN aulaDataFixa AF ON AF.idAulaDataFixa = B.aulaDataFixa_idAulaDataFixa AND AF.excluido = 0 
		LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = B.aulaPermanenteGrupo_idAulaPermanenteGrupo 
		INNER JOIN planoAcaoGrupo PAG ON 
			(PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo)
		INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
		LEFT JOIN opcaoBuscaProfessorSelecionada OBPS ON OBPS.buscaProfessor_idBuscaProfessor = B.idBuscaProfessor AND aceito = 1 
		WHERE B.finalizada = 0 AND B.excluida = 0 
		$where ";

		//(AF.idAulaDataFixa IS NOT NULL OR AP.idAulaPermanenteGrupo IS NOT NULL) AND
		$sql = " SELECT DISTINCT(PAG.idPlanoAcaoGrupo), G.nome, G.idGrupo, PAG.planoAcao_idPlanoAcao " . $sql_corpo;
       //echo $sql;
		$rsGrupos = $this -> query($sql);

		if (mysqli_num_rows($rsGrupos) > 0) {

			$html = "";
			$cont = 0;
            
			while ($valor = mysqli_fetch_array($rsGrupos)) {

				$idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
				$idPlanoAcao = $valor['planoAcao_idPlanoAcao'];
				$nomeGrupo = $valor['nome'];
				
				$idGerente = $Gerente->getIdGerentePorGrupo($valor['idGrupo']);
		//		echo $idGerente;
				
				$nomeGerente = $Gerente->getNomeGerente($idGerente);

				$sql = " SELECT B.idBuscaProfessor, COALESCE(B.aulaDataFixa_idAulaDataFixa, B.aulaPermanenteGrupo_idAulaPermanenteGrupo) AS id, 
				COALESCE(AF.horaInicio, AP.horaInicio) AS horaInicio, COALESCE(AF.horaFim, AP.horaFim) AS horaFim, COALESCE(AF.dataAula, AP.diaSemana) AS dia, 
				AF.idAulaDataFixa, AP.idAulaPermanenteGrupo, 
				OBPS.idOpcaoBuscaProfessorSelecionada, OBPS.professor_idProfessor, B.dataApartir, B.urgente, B.obs " . $sql_corpo . " AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo
				ORDER BY AF.dataAula, AP.diaSemana ";
				$result = $this -> query($sql);
                 //echo $sql."<hr>";
				if (mysqli_num_rows($result) > 0) {

					if ($apenasLinha !== false) {
						$caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&ordem=" . $apenasLinha;
					} else {
						$caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&ordem=" . ($cont++);
					}

					$grupo = "<div onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=" . $idPlanoAcaoGrupo . "', '$caminhoAtualizar', 'tr')\"><img src='/cursos/images/cad.png'>" . $nomeGrupo . "</div>";

					$planoAcao = " <img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Visualizar plano de ação\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "planoAcao/cadastro.php?id=$idPlanoAcao', '$caminhoAtualizar', 'tr')\" />";

					//DIAS
					mysqli_data_seek($result, 0);
					$dias = "";
                    $cdias = 0;
					while ($valor2 = mysqli_fetch_array($result)) {
                        $cdias++;    
						$idBuscaProfessor = $valor2["idBuscaProfessor"];
                        if($ids=="")
                            $ids = $idBuscaProfessor;
                        else
                            $ids .= ",".$idBuscaProfessor;
						$urgente = $valor2["urgente"];
						$dataApartir = $valor2["dataApartir"];
						$dataApartir = $dataApartir ? " - <font color=\"#009900;\"> " . Uteis::exibirData($dataApartir) . "</font>" : "";
						$obs = $valor2["obs"];
						$hi = Uteis::exibirHoras($valor2['horaInicio']);
						$hf = Uteis::exibirHoras($valor2['horaFim']);
						$dia = ($valor2['idAulaDataFixa']) ? Uteis::exibirData($valor2['dia']) : Uteis::exibirDiaSemana($valor2['dia']);

						$dias .= "
						<img style=\"float:left;margin-right:1em;\" onclick=\"deletaRegistro('" . CAMINHO_REL . "busca/vendas/include/acao/removerDias.php', '" . $idBuscaProfessor . "', '$caminhoAtualizar', 'tr')\" src=\"" . CAMINHO_IMG . "excluir.png\">
						
						<div class=\"destacaLinha\" ref=\"" . $idBuscaProfessor . "\" >
							<div onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/vendas/include/resourceHTML/busca.php?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&idBuscaProfessor=" . $idBuscaProfessor . "', '$caminhoAtualizar', 'tr')\">" . $dia . " das " . $hi . " às " . $hf . $dataApartir . ($urgente ? " <strong style=\"color:#FF0000\">URGENTE</strong>" : "") . ($obs ? " | Obs.: $obs</strong>" : "") . "	</div>
						</div>";
                        
					}

					//PROFESSOR
					mysqli_data_seek($result, 0);
					$prof = "<div style=\"width:150px\">";                 
					while ($valor2 = mysqli_fetch_array($result)) {

						$nomeProf = $OpcaoBuscaProfessorSelecionada -> professorDoDia($valor2['idBuscaProfessor']);

						$prof .= "<div class=\"destacaLinha\" ref=\"" . $valor2['idBuscaProfessor'] . "\" >" . $professor;

						if ($nomeProf) {
							$prof .= "<img style=\"float:left;margin-right:1em;\" src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"deletaRegistro('" . CAMINHO_REL . "busca/vendas/include/acao/professor.php', '" . $valor2['idOpcaoBuscaProfessorSelecionada'] . "', '$caminhoAtualizar', 'tr');\" /> $nomeProf ";
						}

						$prof .= "&nbsp;</div>";
					}
					$etapas .= "</div>";

					//ETAPAS//
					mysqli_data_seek($result, 0);
					$etapas = "<div style=\"width:100px\">";

					while ($valor2 = mysqli_fetch_array($result)) {

						$idOpcaoBuscaProfessorSelecionada = $valor2["idOpcaoBuscaProfessorSelecionada"];
						$idBuscaProfessor = $valor2["idBuscaProfessor"];
						$tipo = ($valor2['idAulaDataFixa']) ? "AF" : "AP";
						$dataApartir = $valor2["dataApartir"];

						$etapas .= "<div class=\"destacaLinha\" ref=\"" . $idBuscaProfessor . "\" id=\"etapas_busca_" . $idBuscaProfessor . "\" >";

						if ($valor2['idOpcaoBuscaProfessorSelecionada'] != '') {
							$etapas .= $EtapaValidacaoBusca -> selectEtapaValidacaoBusca_etapas($idOpcaoBuscaProfessorSelecionada, $idBuscaProfessor, $idPlanoAcaoGrupo, $caminhoAtualizar, $tipo, $dataApartir);
						}

						$etapas .= "&nbsp;</div>";
					}
					$etapas .= "</div>";
                    
                   if($cdias >= 2){
                 $ofertas = "<center><img src=\"" . CAMINHO_IMG . "copy16.png\" title=\"Extender Ofertas\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/vendas/include/form/copiarOpcaoProfessores.php?idBuscaProfessor=$ids&idPlanoAcaoGrupo=$idPlanoAcaoGrupo', '$caminhoAtualizar', 'tr')\" /></center>";;
                }else{
                     $ofertas="";  
                  }
                                                            
					//EMAIL
					$email = "<center><img src=\"" . CAMINHO_IMG . "email.png\" title=\"Enviar por e-mail\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/vendas/include/resourceHTML/disparoEmail.php?id=$idPlanoAcaoGrupo', '$caminhoAtualizar', 'tr')\" /></center>";

					if ($apenasLinha !== false) {

						$col = array();

						$col[] = $grupo;
						$col[] = $planoAcao;
						$col[] = $dias;
                        $col[] = $ofertas;
						$col[] = $prof;
						$col[] = $nomeGerente;
						$col[] = $etapas;
						$col[] = $email;

						$html = $col;
						break;

					} else {

						$html .= "<tr >";

						$html .= "<td>" . $grupo . "</td>";

						$html .= "<td>" . $planoAcao . "</td>";

						$html .= "<td>" . $dias . "</td>";
						
						$html .= "<td>" . $ofertas . "</td>";

						$html .= "<td>" . $prof . "</td>";
						
						$html .= "<td>" . $nomeGerente . "</td>";

						$html .= "<td>" . $etapas . "</td>";

						$html .= "<td>" . $email . "</td>";

						$html .= "</tr>";

					}

				}
			}
		}
		return $html;
	}
	
	function selectBuscaProfessorTrGrupo($where = "", $caminhoAtualizar_base, $apenasLinha = false) {

		$EtapaValidacaoBusca = new EtapaValidacaoBusca();
		$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada = new EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada();
		$OpcaoBuscaProfessorSelecionada = new OpcaoBuscaProfessorSelecionada();
		$GerenteTem = new GerenteTem();
		$Gerente = new Gerente();

		$sql_corpo = " FROM buscaProfessor AS B 
		LEFT JOIN aulaDataFixa AF ON AF.idAulaDataFixa = B.aulaDataFixa_idAulaDataFixa AND AF.excluido = 0 
		LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = B.aulaPermanenteGrupo_idAulaPermanenteGrupo 
		INNER JOIN planoAcaoGrupo PAG ON 
			(PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo)
		INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
		LEFT JOIN opcaoBuscaProfessorSelecionada OBPS ON OBPS.buscaProfessor_idBuscaProfessor = B.idBuscaProfessor AND aceito = 1 
		WHERE B.finalizada = 0 AND B.excluida = 0 
		$where ";

		//(AF.idAulaDataFixa IS NOT NULL OR AP.idAulaPermanenteGrupo IS NOT NULL) AND
		$sql = " SELECT DISTINCT(PAG.idPlanoAcaoGrupo), G.nome, G.idGrupo, PAG.planoAcao_idPlanoAcao " . $sql_corpo;
       //echo $sql;
		$rsGrupos = $this -> query($sql);

		if (mysqli_num_rows($rsGrupos) > 0) {

			$html = "";
			$cont = 0;
            
			while ($valor = mysqli_fetch_array($rsGrupos)) {

				$idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
				$idPlanoAcao = $valor['planoAcao_idPlanoAcao'];
				$nomeGrupo = $valor['nome'];
				
				$idGerente = $Gerente->getIdGerentePorGrupo($valor['idGrupo']);
		//		echo $idGerente;
				
				$nomeGerente = $Gerente->getNomeGerente($idGerente);

				$sql = " SELECT B.idBuscaProfessor, COALESCE(B.aulaDataFixa_idAulaDataFixa, B.aulaPermanenteGrupo_idAulaPermanenteGrupo) AS id, 
				COALESCE(AF.horaInicio, AP.horaInicio) AS horaInicio, COALESCE(AF.horaFim, AP.horaFim) AS horaFim, COALESCE(AF.dataAula, AP.diaSemana) AS dia, 
				AF.idAulaDataFixa, AP.idAulaPermanenteGrupo, 
				OBPS.idOpcaoBuscaProfessorSelecionada, OBPS.professor_idProfessor, B.dataApartir, B.urgente, B.obs " . $sql_corpo . " AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo
				ORDER BY AF.dataAula, AP.diaSemana ";
				$result = $this -> query($sql);
                 //echo $sql."<hr>";
				if (mysqli_num_rows($result) > 0) {

					if ($apenasLinha !== false) {
						$caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&ordem=" . $apenasLinha;
					} else {
						$caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&ordem=" . ($cont++);
					}

					$grupo = "<div onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=" . $idPlanoAcaoGrupo . "', '$caminhoAtualizar', 'tr')\"><img src='/cursos/images/cad.png'>" . $nomeGrupo . "</div>";

					$planoAcao = " <img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Visualizar plano de ação\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "planoAcao/cadastro.php?id=$idPlanoAcao', '$caminhoAtualizar', 'tr')\" />";

					//DIAS
					mysqli_data_seek($result, 0);
					$dias = "";
                    $cdias = 0;
					while ($valor2 = mysqli_fetch_array($result)) {
                        $cdias++;    
						$idBuscaProfessor = $valor2["idBuscaProfessor"];
                        if($ids=="")
                            $ids = $idBuscaProfessor;
                        else
                            $ids .= ",".$idBuscaProfessor;
						$urgente = $valor2["urgente"];
						$dataApartir = $valor2["dataApartir"];
						$dataApartir = $dataApartir ? " - <font color=\"#009900;\"> " . Uteis::exibirData($dataApartir) . "</font>" : "";
						$obs = $valor2["obs"];
						$hi = Uteis::exibirHoras($valor2['horaInicio']);
						$hf = Uteis::exibirHoras($valor2['horaFim']);
						$dia = ($valor2['idAulaDataFixa']) ? Uteis::exibirData($valor2['dia']) : Uteis::exibirDiaSemana($valor2['dia']);

						$dias .= "
						<img style=\"float:left;margin-right:1em;\" onclick=\"deletaRegistro('" . CAMINHO_REL . "busca/vendas/include/acao/removerDias.php', '" . $idBuscaProfessor . "', '$caminhoAtualizar', 'tr')\" src=\"" . CAMINHO_IMG . "excluir.png\">
						
						<div class=\"destacaLinha\" ref=\"" . $idBuscaProfessor . "\" >
							<div onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/vendas/include/resourceHTML/busca.php?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&idBuscaProfessor=" . $idBuscaProfessor . "', '$caminhoAtualizar', 'tr')\">" . $dia . " das " . $hi . " às " . $hf . $dataApartir . ($urgente ? " <strong style=\"color:#FF0000\">URGENTE</strong>" : "") . ($obs ? " | Obs.: $obs</strong>" : "") . "	</div>
						</div>";
                        
					}

					//PROFESSOR
					mysqli_data_seek($result, 0);
					$prof = "<div style=\"width:150px\">";                 
					while ($valor2 = mysqli_fetch_array($result)) {

						$nomeProf = $OpcaoBuscaProfessorSelecionada -> professorDoDia($valor2['idBuscaProfessor']);

						$prof .= "<div class=\"destacaLinha\" ref=\"" . $valor2['idBuscaProfessor'] . "\" >" . $professor;

						if ($nomeProf) {
							$prof .= "<img style=\"float:left;margin-right:1em;\" src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"deletaRegistro('" . CAMINHO_REL . "busca/vendas/include/acao/professor.php', '" . $valor2['idOpcaoBuscaProfessorSelecionada'] . "', '$caminhoAtualizar', 'tr');\" /> $nomeProf ";
						}

						$prof .= "&nbsp;</div>";
					}
					$etapas .= "</div>";

					//ETAPAS//
					mysqli_data_seek($result, 0);
					$etapas = "<div style=\"width:100px\">";

					while ($valor2 = mysqli_fetch_array($result)) {

						$idOpcaoBuscaProfessorSelecionada = $valor2["idOpcaoBuscaProfessorSelecionada"];
						$idBuscaProfessor = $valor2["idBuscaProfessor"];
						$tipo = ($valor2['idAulaDataFixa']) ? "AF" : "AP";
						$dataApartir = $valor2["dataApartir"];

						$etapas .= "<div class=\"destacaLinha\" ref=\"" . $idBuscaProfessor . "\" id=\"etapas_busca_" . $idBuscaProfessor . "\" >";

						if ($valor2['idOpcaoBuscaProfessorSelecionada'] != '') {
							$etapas .= $EtapaValidacaoBusca -> selectEtapaValidacaoBusca_etapas($idOpcaoBuscaProfessorSelecionada, $idBuscaProfessor, $idPlanoAcaoGrupo, $caminhoAtualizar, $tipo, $dataApartir);
						}

						$etapas .= "&nbsp;</div>";
					}
					$etapas .= "</div>";
                    
                   if($cdias >= 2){
                 $ofertas = "<center><img src=\"" . CAMINHO_IMG . "copy16.png\" title=\"Extender Ofertas\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/vendas/include/form/copiarOpcaoProfessores.php?idBuscaProfessor=$ids&idPlanoAcaoGrupo=$idPlanoAcaoGrupo', '$caminhoAtualizar', 'tr')\" /></center>";;
                }else{
                     $ofertas="";  
                  }
                                                            
					//EMAIL
					$email = "<center><img src=\"" . CAMINHO_IMG . "email.png\" title=\"Enviar por e-mail\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/vendas/include/resourceHTML/disparoEmail.php?id=$idPlanoAcaoGrupo', '$caminhoAtualizar', 'tr')\" /></center>";

					if ($apenasLinha !== false) {

						$col = array();

			//			$col[] = $grupo;
			//			$col[] = $planoAcao;
						$col[] = $dias;
                        $col[] = $ofertas;
						$col[] = $prof;
				//		$col[] = $nomeGerente;
						$col[] = $etapas;
						$col[] = $email;

						$html = $col;
						break;

					} else {

						$html .= "<tr >";

			//			$html .= "<td>" . $grupo . "</td>";

			//			$html .= "<td>" . $planoAcao . "</td>";

						$html .= "<td>" . $dias . "</td>";
						
						$html .= "<td>" . $ofertas . "</td>";

						$html .= "<td>" . $prof . "</td>";
						
				//		$html .= "<td>" . $nomeGerente . "</td>";

						$html .= "<td>" . $etapas . "</td>";

						$html .= "<td>" . $email . "</td>";

						$html .= "</tr>";

					}

				}
			}
		}
		return $html;
	}
	

	//MARGEM DE LUCRO(%) MINIMA NECESSÁRIA PARA CONTRATAÇÃO DE PROFS
	static function margemLucroAulas() {
        $sql = "SELECT valor FROM margemLucro";
        $rs = Uteis::executarQuery($sql);
        return $rs[0]['valor'];
    }

}
?>