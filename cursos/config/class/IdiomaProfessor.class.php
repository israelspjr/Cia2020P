<?php
class IdiomaProfessor extends Database {
	// class attributes
	var $idIdiomaProfessor;
	var $professorIdProfessor;
	var $idiomaIdIdioma;
	var $sotaqueIdiomaProfessorIdSotaqueIdiomaProfessor;
	var $nivelLinguisticoIdNivelLinguistico;
	var $dataContratacao;
	var $dataCadastro;
	var $inativo;
	var $obs;
	var $nivelF;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idIdiomaProfessor = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> sotaqueIdiomaProfessorIdSotaqueIdiomaProfessor = "NULL";
		$this -> nivelLinguisticoIdNivelLinguistico = "NULL";
		$this -> dataContratacao = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> inativo = "0";
		$this -> obs = "NULL";
		$this -> nivelF = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdIdiomaProfessor($value) {
		$this -> idIdiomaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setSotaqueIdiomaProfessorIdSotaqueIdiomaProfessor($value) {
		$this -> sotaqueIdiomaProfessorIdSotaqueIdiomaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNivelLinguisticoIdNivelLinguistico($value) {
		$this -> nivelLinguisticoIdNivelLinguistico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataContratacao($value) {
		$this -> dataContratacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setNivel($value) {
		$this -> nivelF = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addIdiomaProfessor() Function
	 */
	function addIdiomaProfessor() {
		$sql = "INSERT INTO idiomaProfessor (professor_idProfessor, idioma_idIdioma, sotaqueIdiomaProfessor_idSotaqueIdiomaProfessor, nivelLinguistico_idNivelLinguistico, dataContratacao, dataCadastro, inativo, obs, nivelF) VALUES ($this->professorIdProfessor, $this->idiomaIdIdioma, $this->sotaqueIdiomaProfessorIdSotaqueIdiomaProfessor, $this->nivelLinguisticoIdNivelLinguistico, $this->dataContratacao, $this->dataCadastro, $this->inativo, $this->obs, $this->nivelF)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteIdiomaProfessor() Function
	 */
	function deleteIdiomaProfessor() {
		$sql = "DELETE FROM idiomaProfessor WHERE idIdiomaProfessor = $this->idIdiomaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldIdiomaProfessor() Function
	 */
	function updateFieldIdiomaProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE idiomaProfessor SET " . $field . " = " . $value . " WHERE idIdiomaProfessor = $this->idIdiomaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateIdiomaProfessor() Function
	 */
	function updateIdiomaProfessor() {
		$sql = "UPDATE idiomaProfessor SET professor_idProfessor = $this->professorIdProfessor, idioma_idIdioma = $this->idiomaIdIdioma, sotaqueIdiomaProfessor_idSotaqueIdiomaProfessor = $this->sotaqueIdiomaProfessorIdSotaqueIdiomaProfessor, nivelLinguistico_idNivelLinguistico = $this->nivelLinguisticoIdNivelLinguistico, dataContratacao = $this->dataContratacao, inativo = $this->inativo, obs = $this->obs, nivelF = $this->nivelF WHERE idIdiomaProfessor = $this->idIdiomaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectIdiomaProfessor() Function
	 */
	function selectIdiomaProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idIdiomaProfessor, professor_idProfessor, idioma_idIdioma, sotaqueIdiomaProfessor_idSotaqueIdiomaProfessor, nivelLinguistico_idNivelLinguistico, dataContratacao, dataCadastro, inativo, obs, nivelF FROM idiomaProfessor " . $where;
		return $this -> executeQuery($sql);
	}
    
    function getIdsProfessores($where){
        $sql = "SELECT SQL_CACHE professor_idProfessor FROM idiomaProfessor ".$where;
        $result = $this -> executeQuery($sql);
        foreach($result as $valor) $ids[] = $valor['professor_idProfessor'];
        return $ids;
    }

	function selectIdiomaProfessorContratadoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "") {
		
		$sql = " SELECT idIdiomaProfessor, professor_idProfessor, S.valor,  I.idioma, N.nivel, IP.nivelF, PC.plano, S.valor, IP.inativo ";
		$sql .= " FROM idiomaProfessor AS IP ";
		$sql .= " INNER JOIN idioma AS I ON I.idIdioma = IP.idioma_idIdioma ";
		$sql .= " LEFT JOIN sotaqueIdiomaProfessor AS S ON S.idSotaqueIdiomaProfessor = IP.sotaqueIdiomaProfessor_idSotaqueIdiomaProfessor ";
		$sql .= "	AND S.idioma_idIdioma = I.idIdioma ";
		$sql .= " LEFT JOIN nivelLinguistico AS N ON N.idNivelLinguistico = IP.nivelLinguistico_idNivelLinguistico ";
		$sql .= " LEFT JOIN planoCarreirraIdiomaProfessor AS PCI ON PCI.idiomaProfessor_idIdiomaProfessor = IP.idIdiomaProfessor  ";
		$sql .= " 	AND PCI.mesFim IS NULL AND PCI.anoFim IS NULL ";
		$sql .= " LEFT JOIN planoCarreirra AS PC ON PC.idPlanoCarreira = PCI.planoCarreirra_idPlanoCarreira " . $where;
		//echo $sql;
		//exit;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idIdiomaProfessor'] . $idPai . "', '$caminhoAtualizar', '$ondeAtualiza')\" >" . ($valor['idioma']) . "</td>";
				$html .= "<td>".$valor['valor']."</td>";
				$html .= "<td>" . $valor['nivel'] . "</td>";
				
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
				$html .= "<td>" . $nivelF . "</td>";
				$valorHora = $valor['plano'] ? "R$ " . number_format($valor['plano'], 2, ',', '.') : " ainda não definido ";
				$html .= "<td>" . $valorHora . "</td>";
				$html .= "<td align=\"center\">" . Uteis::exibirStatus(!$valor['inativo']) . "</td>";

			//	if ($valor['inativo'] == 0) {
					$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "professor/contratado/include/acao/idiomaProfessor.php', " . $valor['idIdiomaProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
			//	} else {
			//		$html .= "<td></td>";
			//	}
				$html .= "</tr>";
			}
		}

		return $html;
	}
	
	function selectIdiomaProfessorContratadoTr_professor($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "") {
		
		$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();
		
		$sql = " SELECT 
    idIdiomaProfessor,
    IP.professor_idProfessor,
    S.valor,
    I.idioma,
    N.nivel,
    S.valor,
    IP.inativo,
    I.linkTeste,
    P.tipoDocumentoUnico_idTipoDocumentoUnico,
    P.documentoUnico,
    P.nome ,
    EV.valor AS email,
	I.idIdioma
FROM
    idiomaProfessor AS IP
        INNER JOIN
    idioma AS I ON I.idIdioma = IP.idioma_idIdioma
        LEFT JOIN
    sotaqueIdiomaProfessor AS S ON S.idSotaqueIdiomaProfessor = IP.sotaqueIdiomaProfessor_idSotaqueIdiomaProfessor
        AND S.idioma_idIdioma = I.idIdioma
        LEFT JOIN
    nivelLinguistico AS N ON N.idNivelLinguistico = IP.nivelLinguistico_idNivelLinguistico
        INNER JOIN
    professor AS P ON IP.professor_idProfessor = P.idProfessor
        INNER JOIN
    enderecoVirtual AS EV ON EV.professor_idProfessor = P.idProfessor
	" . $where;
//		echo $sql;
		//exit;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				
				//Verificando se tem Nota de teste
				$rs = $ProcessoSeletivoProfessor->selectProcessoSeletivoProfessor(" WHERE idioma_idIdioma = ".$valor['idIdioma']." AND professor_idProfessor = ".$valor['professor_idProfessor']);
					
				$html .= "<tr>";
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idIdiomaProfessor'] . $idPai . "', '$caminhoAtualizar', '$ondeAtualiza')\" >" . ($valor['idioma']) . "</td>";
				$html .= "<td>".$valor['valor']."</td>";
				$html .= "<td>" . $valor['nivel'] . "</td>";
				$valorHora = $valor['plano'] ? "R$ " . number_format($valor['plano'], 2, ',', '.') : " ainda não definido ";
				$html .= "<td><a href=\"".$valor['linkTeste']."&criarNovo=true&tipo=".$valor['tipoDocumentoUnico_idTipoDocumentoUnico']."&documento=".$valor['documentoUnico']."&nome=".$valor['nome']."&emailPrincipal=".$valor['email']."&pais_id=33&tipoDocumentoUnico_id=1&empresa_id=1&senha=1234\" target=\"_blank\" >".$valor['linkTeste']."</a></td>";
				$html .= "<td>".$rs[0]['notaTeste']."</td>";
				$html .= "<td align=\"center\">" . Uteis::exibirStatus(!$valor['inativo']) . "</td>";

				if ($valor['inativo'] == 0) {
					$html .= "<td onclick=\"zerarCentro();deletaRegistro('modulos/cadastro/acao/idiomaProfessor.php', " . $valor['idIdiomaProfessor'] . ", '$caminhoAtualizar', '#centro')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				} else {
					$html .= "<td></td>";
				}
				$html .= "</tr>";
			}
		}

		return $html;
	}
	
	function getNivelAtual($id, $nomeIdioma = true) {
		
		$NivelLinguistico = new NivelLinguistico();
		
		$rs = $this->selectIdiomaProfessor(" WHERE professor_idProfessor = ".$id." AND inativo = 0");
		
			if ($nomeIdioma == true) { 
		$nome = $NivelLinguistico->getNome($rs[0]['nivelLinguistico_idNivelLinguistico']);
			} else {
		$nome = $rs[0]['nivelLinguistico_idNivelLinguistico'];		
			}
		
		return $nome;
		
	}
	

}
?>