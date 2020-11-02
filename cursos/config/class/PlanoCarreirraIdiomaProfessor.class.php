<?php
class PlanoCarreirraIdiomaProfessor extends Database {
	// class attributes
	var $idPlanoCarreirraIdiomaProfessor;
	var $idiomaProfessorIdIdiomaProfessor;
	var $planoCarreirraIdPlanoCarreira;
	var $mesIni;
	var $anoIni;
	var $mesFim;
	var $anoFim;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPlanoCarreirraIdiomaProfessor = "NULL";
		$this -> idiomaProfessorIdIdiomaProfessor = "NULL";
		$this -> planoCarreirraIdPlanoCarreira = "NULL";		
		$this -> mesIni = "NULL";
		$this -> anoIni = "NULL";
		$this -> mesFim = "NULL";
		$this -> anoFim = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPlanoCarreirraIdiomaProfessor($value) {
		$this -> idPlanoCarreirraIdiomaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaProfessorIdIdiomaProfessor($value) {
		$this -> idiomaProfessorIdIdiomaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoCarreirraIdPlanoCarreira($value) {
		$this -> planoCarreirraIdPlanoCarreira = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMesIni($value) {
		$this -> mesIni = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAnoIni($value) {
		$this -> anoIni = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMesFim($value) {
		$this -> mesFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAnoFim($value) {
		$this -> anoFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function addPlanoCarreirraIdiomaProfessor() {
		
		if( $this->anoIni && $this->mesIni ){
			
			$rs = $this->selectPlanoCarreirraIdiomaProfessor(" WHERE idiomaProfessor_idIdiomaProfessor = $this->idiomaProfessorIdIdiomaProfessor AND				
				(mesFim IS NULL AND anoFim IS NULL) 
				AND 
				( $this->anoIni < anoIni OR ( $this->anoIni = anoIni AND $this->mesIni <= mesIni ) ) ");
			if( $rs ){
				//NAO PODE INSERIR
				return "Defina um periodo de inicio maior que ".$rs[0]['mesIni']."/".$rs[0]['anoIni'];
			}else{				
				$this -> atualizarPlanoCarreirraIdiomaProfessor();				
				$sql = "INSERT INTO planoCarreirraIdiomaProfessor (idiomaProfessor_idIdiomaProfessor, planoCarreirra_idPlanoCarreira, mesIni, anoIni, mesFim, anoFim, dataCadastro) 
				VALUES ($this->idiomaProfessorIdIdiomaProfessor, $this->planoCarreirraIdPlanoCarreira, $this->mesIni, $this->anoIni, $this->mesFim, $this->anoFim, $this->dataCadastro)";
				$result = $this -> query($sql, true);
				return mysqli_insert_id($this -> connect);
			}
		}else{
			return "Defina inicio e fim.";
		}
		
	}

	function deletePlanoCarreirraIdiomaProfessor() {
		$sql = "DELETE FROM planoCarreirraIdiomaProfessor WHERE idPlanoCarreirraIdiomaProfessor = $this->idPlanoCarreirraIdiomaProfessor";
		$result = $this -> query($sql, true);
	}

	function updateFieldPlanoCarreirraIdiomaProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE planoCarreirraIdiomaProfessor SET " . $field . " = " . $value . " WHERE idPlanoCarreirraIdiomaProfessor = $this->idPlanoCarreirraIdiomaProfessor";
		$result = $this -> query($sql, true);
	}

	function updatePlanoCarreirraIdiomaProfessor() {
		//, dataInicio = $this->dataInicio, dataFim = $this->dataFim		
		$sql = "UPDATE planoCarreirraIdiomaProfessor 
		SET idiomaProfessor_idIdiomaProfessor = $this->idiomaProfessorIdIdiomaProfessor, planoCarreirra_idPlanoCarreira = $this->planoCarreirraIdPlanoCarreira, mesIni = $this->mesIni, anoIni = $this->anoIni, mesFim = $this->mesFim, anoFim = $this->anoFim  
		WHERE idPlanoCarreirraIdiomaProfessor = $this->idPlanoCarreirraIdiomaProfessor";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	function selectPlanoCarreirraIdiomaProfessor($where = "WHERE 1") {
		//, dataInicio, dataFim
		$sql = "SELECT SQL_CACHE idPlanoCarreirraIdiomaProfessor, idiomaProfessor_idIdiomaProfessor, planoCarreirra_idPlanoCarreira, mesIni, anoIni, mesFim, anoFim, dataCadastro 
		FROM planoCarreirraIdiomaProfessor " . $where;
//		echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectPlanoCarreirraIdiomaProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "") {

		$sql = " SELECT PCI.idPlanoCarreirraIdiomaProfessor, PCI.mesIni, PCI.anoIni, PCI.mesFim, PCI.anoFim, PC.plano, PC.descricao, IP.idIdiomaProfessor
		FROM planoCarreirraIdiomaProfessor AS PCI 
		INNER JOIN idiomaProfessor AS IP ON IP.idIdiomaProfessor = PCI.idiomaProfessor_idIdiomaProfessor 
		INNER JOIN planoCarreirra AS PC ON PC.idPlanoCarreira = PCI.planoCarreirra_idPlanoCarreira " . $where . " ORDER BY PCI.anoIni DESC, PCI.mesIni DESC ";
		//echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				//$dataInicio = $valor['dataInicio'];
				//$dataFim = $valor['dataFim'];
				$dataInicio_exibir = $valor['mesIni']."/".$valor['anoIni'];
				$dataFim_exibir = $valor['mesFim']."/".$valor['anoFim'];
				$dataInicio = $valor['anoIni'].$valor['mesIni'];
				$dataFim = $valor['anoFim'].$valor['mesFim'];
				$plano = $valor['plano'];
                $tipo = $valor['descricao'];
				$idAtual = $valor['idPlanoCarreirraIdiomaProfessor'];
				$idIdioma = $valor['idIdiomaProfessor'];

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=$idAtual&id_IdiomaProfessor=$idIdioma', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				
				$html .= "<tr>";

				$html .= "<td >" .Uteis::exibirData($valor['anoIni']."-".$valor['mesIni']."-01"). "</td>";
								
				$html .= "<td $onclick>" .$tipo. "</td>";

				$periodo = " - de " . ($dataInicio_exibir) . (($valor['anoFim'] && $valor['mesFim']) ? " até " . ($dataFim_exibir) : ""); //." - ". $valor['idPlanoCarreirraIdiomaProfessor'];

				$html .= "<td > R$ " . Uteis::formatarMoeda($plano) . $periodo . "</td>";

				if ( $dataInicio <= date('Ym') && ($dataFim > date('Ym') || !$dataFim ) ) {
					$ativo = "<img src=\"" . CAMINHO_IMG . "ativo.png\">";
				} else {
					$ativo = "";
				}

				$html .= "<td align=\"center\">" . $ativo . "</td>";

				$html .= "</tr>";
			}
		}

		return $html;
	}

	function atualizarPlanoCarreirraIdiomaProfessor() {
		
		/*$sql = "UPDATE planoCarreirraIdiomaProfessor SET dataFim = " . $this -> dataInicio ." 
		WHERE idiomaProfessor_idIdiomaProfessor = " . $this -> idiomaProfessorIdIdiomaProfessor . " AND ( dataFim IS NULL OR dataFim = '' ) ";*/
		
		//echo $this -> anoIni	. "-" .	$this -> mesIni . "-01";
		$dataFim_nova = explode("-", date('Y-m', strtotime("-1 months", strtotime($this -> anoIni	. "-" .	$this -> mesIni . "-01"))));
		//print_r($dataFim_nova);exit;
		$sql = "UPDATE planoCarreirraIdiomaProfessor SET anoFim = " . $dataFim_nova[0] .",  mesFim = " . $dataFim_nova[1] ." 
		WHERE idiomaProfessor_idIdiomaProfessor = " . $this -> idiomaProfessorIdIdiomaProfessor . " AND ( mesFim IS NULL OR anoFim = '' ) ";
		$this -> query($sql);

	}

}
?>