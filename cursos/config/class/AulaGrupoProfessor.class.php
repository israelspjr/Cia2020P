<?php
class AulaGrupoProfessor extends Database {
	// class attributes
	var $idAulaGrupoProfessor;
	var $aulaPermanenteGrupoIdAulaPermanenteGrupo;
	var $aulaDataFixaIdAulaDataFixa;
	var $professorIdProfessor;
	var $dataInicio;
	var $dataFim;
	var $dataCadastro;
	var $tipoAulaGrupoProfessorIdTipoAulaGrupoProfessor;
	var $motivo;
	var $plano;
	var $subMotivo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idAulaGrupoProfessor = "NULL";
		$this -> aulaPermanenteGrupoIdAulaPermanenteGrupo = "NULL";
		$this -> aulaDataFixaIdAulaDataFixa = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> dataInicio = "NULL";
		$this -> dataFim = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> tipoAulaGrupoProfessorIdTipoAulaGrupoProfessor = "NULL";
		$this -> motivo = "0";
		$this -> plano = "NULL";
		$this -> subMotivo = "0";
		
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdAulaGrupoProfessor($value) {
		$this -> idAulaGrupoProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAulaPermanenteGrupoIdAulaPermanenteGrupo($value) {
		$this -> aulaPermanenteGrupoIdAulaPermanenteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAulaDataFixaIdAulaDataFixa($value) {
		$this -> aulaDataFixaIdAulaDataFixa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataInicio($value) {
		$this -> dataInicio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setdataFim($value) {
		$this -> dataFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setTipoAulaGrupoProfessorIdTipoAulaGrupoProfessor($value) {
		$this -> tipoAulaGrupoProfessorIdTipoAulaGrupoProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setMotivo($value) {
		$this -> motivo = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setPlano($value) {
		$this -> plano = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setSubMotivo($value) {
		$this -> subMotivo = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addAulaGrupoProfessor() Function
	 */
	function addAulaGrupoProfessor() {
		$sql = "INSERT INTO aulaGrupoProfessor (aulaPermanenteGrupo_idAulaPermanenteGrupo, aulaDataFixa_idAulaDataFixa, professor_idProfessor, dataInicio, dataFim, dataCadastro, tipoAulaGrupoProfessor_idTipoAulaGrupoProfessor, motivo, plano, subMotivo) VALUES ($this->aulaPermanenteGrupoIdAulaPermanenteGrupo, $this->aulaDataFixaIdAulaDataFixa, $this->professorIdProfessor, $this->dataInicio, $this->dataFim, $this->dataCadastro, $this->tipoAulaGrupoProfessorIdTipoAulaGrupoProfessor, $this->motivo, $this->plano, $this->subMotivo)";
//		echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteAulaGrupoProfessor() Function
	 */
	function deleteAulaGrupoProfessor() {
		$sql = "DELETE FROM aulaGrupoProfessor WHERE idAulaGrupoProfessor = $this->idAulaGrupoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldAulaGrupoProfessor() Function
	 */
	function updateFieldAulaGrupoProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE aulaGrupoProfessor SET " . $field . " = " . $value . " WHERE idAulaGrupoProfessor = $this->idAulaGrupoProfessor";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateAulaGrupoProfessor() Function
	 */
	function updateAulaGrupoProfessor() {
		$sql = "UPDATE aulaGrupoProfessor SET aulaPermanenteGrupo_idAulaPermanenteGrupo = $this->aulaPermanenteGrupoIdAulaPermanenteGrupo, aulaDataFixa_idAulaDataFixa = $this->aulaDataFixaIdAulaDataFixa, professor_idProfessor = $this->professorIdProfessor, dataInicio = $this->dataInicio, dataFim = $this->dataFim, tipoAulaGrupoProfessor_idTipoAulaGrupoProfessor = $this->tipoAulaGrupoProfessorIdTipoAulaGrupoProfessor, motivo = $this->motivo, plano = $this->plano, subMotivo = $this->subMotivo WHERE idAulaGrupoProfessor = $this->idAulaGrupoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectAulaGrupoProfessor() Function
	 */
	function selectAulaGrupoProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idAulaGrupoProfessor, aulaPermanenteGrupo_idAulaPermanenteGrupo, aulaDataFixa_idAulaDataFixa, professor_idProfessor, dataInicio, dataFim, dataCadastro, tipoAulaGrupoProfessor_idTipoAulaGrupoProfessor, motivo, plano, subMotivo FROM aulaGrupoProfessor " . $where;
//	echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectAulaGrupoProfessorTr() Function
	 */
	function selectAulaGrupoProfessorTr_historico($where = "", $caminhoAtualizar = "", $ondeAtualiza = "") {

		$html = "";

		$sql = "SELECT SQL_CACHE idAulaGrupoProfessor, professor_idProfessor, dataInicio, dataFim, aulaDataFixa_idAulaDataFixa, aulaPermanenteGrupo_idAulaPermanenteGrupo, motivo, subMotivo, plano FROM aulaGrupoProfessor ";
		$sql .= " WHERE dataFim <= CURDATE() " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$Professor = new Professor();

			while ($valor = mysqli_fetch_array($result)) {
				
				if ($valor['motivo'] == 1) {
					$motivo = "Alteração de dia / horário";
				} else if ($valor['motivo'] == 2) {
					$motivo = "insatisfação Aluno ou RH";
				} else if ($valor['motivo'] == 3) {
					$motivo = "Professor deixou o grupo";
				} else if ($valor['motivo'] == 4) {
					$motivo = "Decisão CI (Coordenação)";
				} else if ($valor['motivo'] == 5) {
					$motivo = "Previsto em contrato";	
				} else if ($valor['motivo'] == 13) {
					$motivo = "Grupo fechou";	
				}
				
				
				if($valor['subMotivo'] == 6) {
				   $subMotivo = "Emprego CLT/ Passou em concurso";	
				} else if($valor['subMotivo'] == 7) {
				   $subMotivo = "Indisponibilidade de agenda";	
				} else if($valor['subMotivo'] == 8) {
				   $subMotivo = "Mudou de região/ cidade ";	
				} else if($valor['subMotivo'] == 9) {
				   $subMotivo = "Problemas de saúde";	
				} else if($valor['subMotivo'] == 10) {
				   $subMotivo = "Não adaptação ao método";	
				} else if($valor['subMotivo'] == 11) {
				   $subMotivo = "Pedagógico";	
				} else if($valor['subMotivo'] == 12) {
				   $subMotivo = "Comportamental";	
				} 

				$idProfessor = $valor['professor_idProfessor'];

				$html .= "<tr>";

				if ($valor['aulaDataFixa_idAulaDataFixa'])
					$idPai = "?idAulaDataFixa=" . $valor['aulaDataFixa_idAulaDataFixa'];

				if ($valor['aulaPermanenteGrupo_idAulaPermanenteGrupo'])
					$idPai = "?idAulaPermanenteGrupo=" . $valor['aulaPermanenteGrupo_idAulaPermanenteGrupo'];

				//PROFESSOR
				$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $idProfessor . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" ";
				$cad = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"VER O CADASTRO\" $onclick />";

				$nomeProfessor = $Professor -> selectProfessor(" WHERE idProfessor = " . $idProfessor);
				$nomeProfessor = $nomeProfessor[0]['nome'];

				$html .= "<td>" . $cad . $nomeProfessor . "</td>";

				//INICIO
				$dataInicio = Uteis::exibirData($valor['dataInicio']);
				$html .= "<td>" . $dataInicio . "</td>";

				//SAIDA
				$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/dataFim_professor.php".$idPai."&idProfessor=" . $idProfessor . "', '" . CAMINHO_REL . "grupo/include/resourceHTML/aulaGrupoProfessor_historico.php".$idPai. "', '$ondeAtualiza')\" ";
				$cad = "<img src=\"" . CAMINHO_IMG . "editar.png\" title=\"Alterar data de saída\" $onclick />";
				
				
				$dataFim = Uteis::exibirData($valor['dataFim']);
				$html .= "<td>". $dataFim .  $cad. "</td>";
				$html .= "<td>". $motivo."</td>";
				$html .= "<td>". $subMotivo."</td>";
				$html .= "<td>". Uteis::exibirMoeda($valor['plano'])."</td>";	

				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectAulaGrupoProfessorSelect() Function
	 */
	function selectAulaGrupoProfessorSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idAulaGrupoProfessor, aulaPermanenteGrupo_idAulaPermanenteGrupo, aulaDataFixa_idAulaDataFixa, professor_idProfessor, dataInicio, dataFim, dataCadastro, tipoAulaGrupoProfessor_idTipoAulaGrupoProfessor FROM aulaGrupoProfessor " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idAulaGrupoProfessor\" name=\"idAulaGrupoProfessor\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idAulaGrupoProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idAulaGrupoProfessor'] . "\">" . ($valor['idAulaGrupoProfessor']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectAulaGrupoProfessor_periodo($idPlanoAcaoGrupo, $dataReferencia) {

		$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));

		$sql = " SELECT DISTINCT(AGP.professor_idProfessor) AS idProfessor 
		FROM planoAcaoGrupo AS PAG
		LEFT JOIN aulaDataFixa AS AF ON AF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
		LEFT JOIN aulaPermanenteGrupo AS AP ON AP.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo 
		INNER JOIN aulaGrupoProfessor AS AGP ON 
			(AGP.aulaDataFixa_idAulaDataFixa = AF.idAulaDataFixa OR AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo = AP.idAulaPermanenteGrupo) 
		WHERE PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND AGP.dataInicio <= '" . $dataReferenciaFinal . "' 
			AND (
				(AGP.dataFim >= '" . $dataReferencia . "' AND AGP.dataFim <= '" . $dataReferenciaFinal . "') 
				OR 
				AGP.dataFim IS NULL OR AGP.dataFim = ''
			) ";
	//	echo $sql;	
		//exit;

		$rs = Uteis::executarQuery($sql);

		return array_unique(Uteis::arrayCampoEspecifico($rs, "idProfessor"));

	}
	
	function selectAulaGrupoProfessor_periodoDemo($idPlanoAcaoGrupo, $dataReferencia) {

		$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));

		$sql = " SELECT DISTINCT(AGP.professor_idProfessor) AS idProfessor 
		FROM planoAcaoGrupo AS PAG
		LEFT JOIN aulaDataFixa AS AF ON AF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
		LEFT JOIN aulaPermanenteGrupo AS AP ON AP.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo 
		INNER JOIN aulaGrupoProfessor AS AGP ON 
			(AGP.aulaDataFixa_idAulaDataFixa = AF.idAulaDataFixa OR AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo = AP.idAulaPermanenteGrupo) 
		WHERE PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND AGP.dataInicio <= '" . $dataReferenciaFinal . "' 
			AND (
				(AGP.dataFim >= '" . $dataReferencia . "' ) /*AND AGP.dataFim <= '" . $dataReferenciaFinal . "') */
				OR 
				AGP.dataFim IS NULL OR AGP.dataFim = ''
			) ";
	//	echo $sql;	
		//exit;

		$rs = Uteis::executarQuery($sql);

		return array_unique(Uteis::arrayCampoEspecifico($rs, "idProfessor"));

	}
	

}
?>