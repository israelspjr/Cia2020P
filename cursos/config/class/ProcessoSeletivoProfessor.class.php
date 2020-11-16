<?php
class ProcessoSeletivoProfessor extends Database {
	// class attributes
	var $idProcessoSeletivoProfessor;
	var $professorIdProfessor;
	var $idiomaIdIdioma;
	var $dataReferencia;
	var $dataCadastro;
	var $obs;
	var $notaTeste;
	var $regiaoAtende;
	var $contratoAssinado;
	var $integracao;
	var $assistiu;
	var $trilha;
	var $analiseFinal;
	var $dataContrato;
	var $dataTrilha;
	var $dataIntegracao;
	var $comportamental;
	var $pedagogico;
	var $linguistico;
	var $finalT;
	var $dataNivel;
	var $idNivel;
	var $vpgV;
	var $vpgP;
	var $vpgG;
	var $avaliador;
	var $idSotaque;
	var $oralFinal;
	var $avaliadorC;
	var $dataC;
	var $analiseC;
	var $perfilG;
	var $pc2;
	var $pc3;
	var $pc4;
	var $pc5;
	var $pc6;
	var $pc7;
	var $pc8;
	var $pc9;
	var $pc10;
	var $pc11;
	var $pc12;
	var $pc13;
	var $pc14;
	var $pc15;
	var $pc16;
	var $pc17;
	var $pc18;
	var $pc19;
	var $avaliadorP;
	var $dataP;
	var $analiseP;
	var $pp1;
	var $pp2;
	var $pp3;
	var $pp4;
	var $pp5;
	var $pp6;
	var $pp7;
	var $pp8;
	var $pp9;
	var $pp10;
	var $pp11;
	var $pp12;
	var $pp13;
	var $pp14;
	var $nivelF;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idProcessoSeletivoProfessor = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> dataReferencia = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> obs = "NULL";
		$this -> notaTeste = "NULL";
		$this -> regiaoAtende = "NULL";
		$this -> contratoAssinado = 0;
		$this -> integracao = 0;
		$this -> assistiu = 0;
        $this -> trilha = 0;
		$this -> analiseFinal = 0;
		$this -> dataContrato = "NULL";
		$this -> dataTrilha = "NULL";
		$this -> dataIntegracao = "NULL";
		$this -> comportamental = "NULL";
		$this -> pedagogico = "NULL";
		$this -> linguistico = "NULL";
		$this -> finalT = "NULL";
		$this -> dataNivel = "NULL";
		$this -> idNivel = "NULL";
		$this -> vpgV = "NULL";
		$this -> vpgP = "NULL";
		$this -> vpgG = "NULL";
		$this -> avaliador = "NULL";
		$this -> idSotaque = 0;
		$this -> oralFinal = 0;
		$this -> avaliadorC = "NULL";
		$this -> dataC = "NULL";
		$this -> analiseC = 0;
		$this -> perfilG = "NULL";
		$this -> pc2 = "NULL";
		$this -> pc3 = "NULL";
		$this -> pc4 = "NULL";
		$this -> pc5 = "NULL";
		$this -> pc6 = "NULL";
		$this -> pc7 = "NULL";
		$this -> pc8 = "NULL";
		$this -> pc9 = "NULL";
		$this -> pc10 = "NULL";
		$this -> pc11 = "NULL";
		$this -> pc12 = "NULL";
		$this -> pc13 = "NULL";
		$this -> pc14 = "NULL";
		$this -> pc15 = "NULL";
		$this -> pc16 = "NULL";
		$this -> pc17 = "NULL";
		$this -> pc18 = "NULL";
		$this -> pc19 = "NULL";
		$this -> avaliadorP = "NULL";
		$this -> dataP = "NULL";
		$this -> analiseP = 0;
		$this -> pp1 = "NULL";
		$this -> pp2 = "NULL";
		$this -> pp3 = "NULL";
		$this -> pp4 = "NULL";
		$this -> pp5 = "NULL";
		$this -> pp6 = "NULL";
		$this -> pp7 = "NULL";
		$this -> pp8 = "NULL";
		$this -> pp9 = "NULL";
		$this -> pp10 = "NULL";
		$this -> pp11 = "NULL";
		$this -> pp12 = "NULL";
		$this -> pp13 = "NULL";
		$this -> pp14 = "NULL";
		$this -> nivelF = 0;

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdProcessoSeletivoProfessor($value) {
		$this -> idProcessoSeletivoProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataReferencia($value) {
		$this -> dataReferencia = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setNotaTeste($value) {
		$this -> notaTeste = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setRegiaoAtende($value) {
		$this -> regiaoAtende = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setContratoAssinado($value) {
		$this -> contratoAssinado = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setIntegracao($value) {
		$this -> integracao = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setAssistiu($value) {
		$this -> assistiu = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setTrilha($value) {
		$this -> trilha = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setAnaliseFinal($value) {
		$this -> analiseFinal = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setDataContrato($value) {
		$this -> dataContrato = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setDataTrilha($value) {
		$this -> dataTrilha = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setDataIntegracao($value) {
		$this -> dataIntegracao = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setComportamental($value) {
		$this -> comportamental = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPedagogico($value) {
		$this -> pedagogico = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setLinguistico($value) {
		$this -> linguistico = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setFinalT($value) {
		$this -> finalT = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setDataNivel($value) {
		$this -> dataNivel = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setIdNivel($value) {
		$this -> idNivel = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setVpgV($value) {
		$this -> vpgV = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setVpgP($value) {
		$this -> vpgP = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setVpgG($value) {
		$this -> vpgG = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setAvaliador($value) {
		$this -> avaliador = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setIdSotaque($value) {
		$this -> idSotaque = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setOralFinal($value) {
		$this -> oralFinal = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setAvaliadorC($value) {
		$this -> avaliador = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setDataC($value) {
		$this -> dataC = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setAnaliseC($value) {
		$this -> analiseC = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setPerfilG($value) {
		$this -> perfilG = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPc2($value) {
		$this -> pc2 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPc3($value) {
		$this -> pc3 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPc4($value) {
		$this -> pc4 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPc5($value) {
		$this -> pc5 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPc6($value) {
		$this -> pc6 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPc7($value) {
		$this -> pc7 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPc8($value) {
		$this -> pc8 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPc9($value) {
		$this -> pc9 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPc10($value) {
		$this -> pc10 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPc11($value) {
		$this -> pc11 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPc12($value) {
		$this -> pc12 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPc13($value) {
		$this -> pc13 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPc14($value) {
		$this -> pc14 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPc15($value) {
		$this -> pc15 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPc16($value) {
		$this -> pc16 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPc17($value) {
		$this -> pc17 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPc18($value) {
		$this -> pc18 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPc19($value) {
		$this -> pc19 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAvaliadorP($value) {
		$this -> avaliadorP = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataP($value) {
		$this -> dataP = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAnaliseP($value) {
		$this -> analiseP = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setPp1($value) {
		$this -> pp1 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPp2($value) {
		$this -> pp2 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPp3($value) {
		$this -> pp3 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPp4($value) {
		$this -> pp4 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPp5($value) {
		$this -> pp5 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPp6($value) {
		$this -> pp6 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPp7($value) {
		$this -> pp7 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPp8($value) {
		$this -> pp8 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPp9($value) {
		$this -> pp9 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPp10($value) {
		$this -> pp10 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPp11($value) {
		$this -> pp11 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPp12($value) {
		$this -> pp12 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPp13($value) {
		$this -> pp13 = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPp14($value) {
		$this -> pp14 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setNivelF($value) {
		$this -> nivelF = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addProcessoSeletivoProfessor() Function
	 */
	function addProcessoSeletivoProfessor() {
		
		$sql = "INSERT INTO processoSeletivoProfessor (professor_idProfessor, idioma_idIdioma, dataReferencia, obs, notaTeste, regiaoAtende, contratoAssinado, integracao, assistiu, trilha, analiseFinal, dataContrato, dataTrilha, dataIntegracao, comportamental, pedagogico, linguistico, finalT, dataNivel, idNivel, vpgV, vpgP, vpgG, avaliador, idSotaque, oralFinal, avaliadorC, dataC, analiseC, perfilG, pc2, pc3, pc4, pc5, pc6, pc7, pc8, pc9, pc10, pc11, pc12, pc13, pc14, pc15, pc16, pc17, pc18, pc19, avaliadorP, dataP, analiseP, pp1, pp2, pp3, pp4, pp5, pp6, pp7, pp8, pp9, pp10, pp11, pp12, pp13, pp14, nivelF) VALUES ($this->professorIdProfessor, $this->idiomaIdIdioma, $this->dataReferencia, $this->obs, $this->notaTeste, $this->regiaoAtende, $this->contratoAssinado, $this->integracao, $this->assistiu, $this->trilha, $this->analiseFinal, $this->dataContrato, $this->dataTrilha, $this->dataIntegracao, $this->comportamental, $this->pedagogico, $this->linguistico, $this->finalT, $this->dataNivel, $this->idNivel, $this->vpgV, $this->vpgP, $this->vpgG, $this->avaliador, $this->idSotaque, $this->oralFinal, $this->avaliadorC, $this->dataC, $this->analiseC, $this->perfilG, $this->pc2, $this->pc3, $this->pc4, $this->pc5, $this->pc6, $this->pc7, $this->pc8, $this->pc9, $this>pc10, $this->pc11, $this->pc12, $this->pc13, $this->pc14, $this->pc15, $this->pc16, $this->pc17, $this->pc18, $this->pc19, $this->avaliadorP, $this->dataP, $this->analiseP, $this->pp1, $this->pp2, $this->pp3, $this->pp4, $this->pp5, $this->pp6, $this->pp7, $this->pp8, $this->pp9, $this->pp10, $this->pp11, $this->pp12, $this->pp13, $this->pp14, $this->nivelF)";

		$result = $this -> query($sql, true);
		return $this -> connect;
	}
	
	function addProcessoSeletivoProfessor2() {

		$sql = "INSERT INTO processoSeletivoProfessor (professor_idProfessor, idioma_idIdioma, dataReferencia, obs, notaTeste, dataCadastro, nivelF) VALUES ($this->professorIdProfessor, $this->idiomaIdIdioma, $this->dataReferencia, $this->obs, $this->notaTeste, $this->dataCadastro, $this->nivelF)";
	//	echo $sql2;
		
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteProcessoSeletivoProfessor() Function
	 */
	function deleteProcessoSeletivoProfessor() {
		$sql = "DELETE FROM processoSeletivoProfessor WHERE idProcessoSeletivoProfessor = $this->idProcessoSeletivoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldProcessoSeletivoProfessor() Function
	 */
	function updateFieldProcessoSeletivoProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE processoSeletivoProfessor SET " . $field . " = " . $value . " WHERE idProcessoSeletivoProfessor = $this->idProcessoSeletivoProfessor";
		//echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateProcessoSeletivoProfessor() Function
	 */
	 
	function updateProcessoSeletivoProfessor() {
		$sql = "UPDATE processoSeletivoProfessor SET professor_idProfessor = $this->professorIdProfessor, idioma_idIdioma = $this->idiomaIdIdioma, dataReferencia = $this->dataReferencia, obs = $this->obs, notaTeste = $this->notaTeste, regiaoAtende = $this->regiaoAtende, contratoAssinado = $this->contratoAssinado, integracao = $this->integracao, assistiu = $this->assistiu, trilha = $this->trilha, analiseFinal = $this->analiseFinal, dataContrato = $this->dataContrato, dataTrilha = $this->dataTrilha, dataIntegracao = $this->dataIntegracao, comportamental = $this->comportamental, pedagogico = $this->pedagogico, linguistico = $this->linguistico, finalT = $this->finalT, dataNivel = $this->dataNivel, idNivel = $this->idNivel, vpgV = $this->vpgV, vpgP = $this->vpgP, vpgG = $this->vpgG, avaliador = $this->avaliador, idSotaque = $this->idSotaque, oralFinal = $this->oralFinal, 	avaliador = $this->avaliador, dataC = $this->dataC, analiseC = $this->analiseC, perfilG = $this->perfilG, pc2 = $this->pc2, pc3 = $this->pc3, pc4 = $this->pc4, pc5 = $this->pc5, pc6 = $this->pc6, pc7 = $this->pc7, pc8 = $this->pc8, pc9 = $this->pc9, pc10 = $this->pc10, pc11 = $this->pc11, pc12 = $this->pc12, pc13 = $this->pc13, pc14 = $this->pc14, pc15 = $this->pc15, pc16 = $this->pc16, pc17 = $this->pc17, pc18 = $this->pc18, pc19 = $this->pc19, avaliadorP = $this->avaliadorP, dataP = $this->dataP, analiseP = $this->analiseP, pp1 = $this->pp1, pp2 = $this->pp2, pp3 = $this->pp3, pp4 = $this->pp4, pp5 = $this->pp5, pp6 = $this->pp6, pp7 = $this->pp7, pp8 = $this->pp8, pp9 = $this->pp9, pp10 = $this->pp10, pp11 = $this->pp11, pp12 = $this->pp12, pp13 = $this->pp13, pp14 = $this->pp14, nivelF = $this->nivelF WHERE idProcessoSeletivoProfessor = $this->idProcessoSeletivoProfessor";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectProcessoSeletivoProfessor() Function
	 */	
	function selectProcessoSeletivoProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idProcessoSeletivoProfessor, professor_idProfessor, idioma_idIdioma, dataReferencia, dataCadastro, obs, notaTeste, regiaoAtende, contratoAssinado, integracao, assistiu, trilha, analiseFinal, dataContrato, dataTrilha, dataIntegracao, comportamental, pedagogico, linguistico, finalT, dataNivel, idNivel, vpgV, vpgG, vpgP, avaliador, idSotaque, oralFinal, avaliadorC, dataC, analiseC, perfilG, pc2, pc3, pc4, pc5, pc6, pc7, pc8, pc9, pc10, pc11, pc12, pc13, pc14, pc15, pc16, pc17, pc18, pc19, avaliadorP, dataP, analiseP, pp1, pp2, pp3, pp4, pp5, pp6, pp7, pp8, pp9, pp10, pp11, pp12, pp13, pp14, nivelF FROM processoSeletivoProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	function selectProcessoSeletivoProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE idProcessoSeletivoProfessor, professor_idProfessor, PS.notaTeste, I.idioma, PS.nivelF, dataReferencia 
		FROM processoSeletivoProfessor AS PS 
		INNER JOIN idioma AS I ON I.idIdioma = PS.idioma_idIdioma " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {


				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idProcessoSeletivoProfessor'] . $idPai . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>
				
				<td $onclick >" . ($valor['idioma']) . "</td>";
				
					if ($valor['nivelF'] == 1) {
					$nivelF = "Fluente";	
				} elseif ($valor['nivelF'] == 2) {
					$nivelF = "Nativo";
				} elseif ($valor['nivelF'] == 3) {
					$nivelF = "Avançado";
				} elseif ($valor['nivelF'] == 4) {
					$nivelF = "Intermediário";
				} elseif ($valor['nivelF'] == 5) {
					$nivelF = "Básico";
				}
				
				$html .= "<td>" . $nivelF . "</td>
				
				<td onclick >" . Uteis::exibirData($valor['dataReferencia']) . "</td>
				
				<td onclick >" . $valor['notaTeste'] . "</td>
				
				<td align=\"center\" >
					<img title=\"Excluir\" src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"deletaRegistro('" . CAMINHO_CAD . "professor/include/acao/processoSeletivoProfessor.php', " . $valor['idProcessoSeletivoProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">
				</td>
				
				</tr>";
			}
		}
		return $html;
	}

	function getIdIdioma($id) {
		$rs = $this -> selectProcessoSeletivoProfessor(" WHERE idProcessoSeletivoProfessor = $id");
		return $rs[0]['idioma_idIdioma'];
	}

	function selectProcessoSeletivoProfessor_checkBox($idProfessor) {

		$sql = "SELECT SQL_CACHE 
		PS.idProcessoSeletivoProfessor, I.idioma, PS.professor_idProfessor, PS.idioma_idIdioma, PS.dataReferencia
		FROM processoSeletivoProfessor AS PS 
		INNER JOIN idioma AS I ON I.idIdioma = PS.idioma_idIdioma 
		WHERE professor_idProfessor = $idProfessor ";
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$NivelLinguistico = new NivelLinguistico();
			$IdiomaProfessor = new IdiomaProfessor();

			while ($valor = mysqli_fetch_array($result)) {

				$idProcessoSeletivoProfessor = $valor['idProcessoSeletivoProfessor'];
				$idIdioma = $valor['idioma_idIdioma'];
				$idioma = $valor['idioma'];
				$idProfessor = $valor['professor_idProfessor'];
				$dataReferencia = Uteis::exibirData($valor['dataReferencia']);

				$sql = "SELECT COUNT(idProcessoSeletivoProfessorComEtapas) AS total
				FROM processoSeletivoProfessorComEtapas  
				WHERE processoSeletivoProfessor_idProcessoSeletivoProfessor = $idProcessoSeletivoProfessor ";
				$qtdEtapas = mysqli_fetch_array($this -> query($sql));

				$sql .= " AND status = 1";
				$qtdEtapasAprovadas = mysqli_fetch_array($this -> query($sql));

				$podeContratar = true;

				if ($qtdEtapas["total"] == "0" || $qtdEtapas["total"] != $qtdEtapasAprovadas["total"]) {
					$podeContratar = false;
					$podeContratar_msg = " - não passou em todas as etapas";
				}

				if ($podeContratar) {
					$rsIdiomaProfessor = $IdiomaProfessor -> selectIdiomaProfessor(" WHERE professor_idProfessor = $idProfessor AND idioma_idIdioma = $idIdioma");
					if ($rsIdiomaProfessor) {
						$podeContratar = false;
						$podeContratar_msg = " - idioma já existe para o professor";
					}
				}

				$html .= "<p>
				
				<label for=\"check_processoSeletivoProfessor_" . $idProcessoSeletivoProfessor . "\">
				
				<input type=\"checkbox\" id=\"check_processoSeletivoProfessor_" . $idProcessoSeletivoProfessor . "\" 
				name=\"check_processoSeletivoProfessor[]\" value=\"$idProcessoSeletivoProfessor\" '
				onclick=\"ativaOutrosCampos(this)\" from=\"$idProcessoSeletivoProfessor\" " . (!$podeContratar ? " disabled=\"disabled\" " : "") . " />$idioma ($dataReferencia)" . (!$podeContratar ? $podeContratar_msg : "") . "</label>";

				if ($podeContratar) {
					$html .= "<div id=\"div_processoSeletivoProfessor_" . $idProcessoSeletivoProfessor . "\" 
					style=\"margin-left:3em;display:none;\" >
					
					<p><label>Nivel linguistico:" . $NivelLinguistico -> selectNivelLinguisticoSelect("", "", " idNivelLinguistico IN ( 
						SELECT nivelLinguistico_idNivelLinguistico 
						FROM nivelLinguisticoIdioma WHERE inativo = 0 AND idioma_idIdioma = $idIdioma
					)", "_processoSeletivoProfessor_" . $idProcessoSeletivoProfessor) . "<span class=\"placeholder\">Campo Obrigatório</span></label></p>
		
					<p><label>Data de contratação:
					<input type=\"text\" 
					name=\"dataContratacao_processoSeletivoProfessor_" . $idProcessoSeletivoProfessor . "\" 
					id=\"dataContratacao_processoSeletivoProfessor_" . $idProcessoSeletivoProfessor . "\" 
					class=\"data\" disabled=\"disabled\" /><span class=\"placeholder\"></span>
					</label></p>
		
					</div>";
				}

				$html .= "</p>";
			}
		}
		return $html;
	}

}
?>
