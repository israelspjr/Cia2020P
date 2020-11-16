<?php
class DiaAulaFF extends Database {
	// class attributes
	var $idDiaAulaFF;
	var $folhaFrequenciaIdFolhaFrequencia;
	var $aulaPermanenteGrupoIdAulaPermanenteGrupo;
	var $aulaDataFixaIdAulaDataFixa;
	var $dataAula;
	var $horaRealizada;
	var $ocorrenciaFFIdOcorrenciaFF;
	var $reposicao;
    var $banco;
	var $aulaInexistente;	
	var $dataCadastro;
	var $obs;
	var $professorNomeProfessorRep;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDiaAulaFF = "NULL";
		$this -> folhaFrequenciaIdFolhaFrequencia = "NULL";
		$this -> aulaPermanenteGrupoIdAulaPermanenteGrupo = "NULL";
		$this -> aulaDataFixaIdAulaDataFixa = "NULL";
		$this -> dataAula = "NULL";
		$this -> horaRealizada = "0";
		$this -> ocorrenciaFFIdOcorrenciaFF = "NULL";
		$this -> reposicao = "0";
        $this -> banco = "0";
		$this -> aulaInexistente = "0";		
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> obs = "NULL";
		$this -> professorNomeProfesssorRep = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDiaAulaFF($value) {
		$this -> idDiaAulaFF = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFolhaFrequenciaIdFolhaFrequencia($value) {
		$this -> folhaFrequenciaIdFolhaFrequencia = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAulaPermanenteGrupoIdAulaPermanenteGrupo($value) {
		$this -> aulaPermanenteGrupoIdAulaPermanenteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAulaDataFixaIdAulaDataFixa($value) {
		$this -> aulaDataFixaIdAulaDataFixa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataAula($value) {
		$this -> dataAula = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHoraRealizada($value) {
		$this -> horaRealizada = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setOcorrenciaFFIdOcorrenciaFF($value) {
		$this -> ocorrenciaFFIdOcorrenciaFF = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setReposicao($value) {
		$this -> reposicao = ($value) ? $this -> gravarBD($value) : "0";
	}
    
	function setBanco($value) {
        $this -> banco = ($value) ? $this -> gravarBD($value) : "0";
    }
    
	function setAulaInexistente($value) {
		$this -> aulaInexistente = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setProfessorNomeProfessorRep($value) {
       $this -> professorNomeProfessorRep = ($value) ? $this -> gravarBD($value) : "NULL";
    }

	/**
	 * addDiaAulaFF() Function
	 */
	function addDiaAulaFF() {
		$sql = "INSERT INTO diaAulaFF (folhaFrequencia_idFolhaFrequencia, aulaPermanenteGrupo_idAulaPermanenteGrupo, aulaDataFixa_idAulaDataFixa, dataAula, horaRealizada, ocorrenciaFF_idOcorrenciaFF, reposicao, banco, aulaInexistente, dataCadastro, obs) 
		VALUES ($this->folhaFrequenciaIdFolhaFrequencia, $this->aulaPermanenteGrupoIdAulaPermanenteGrupo, $this->aulaDataFixaIdAulaDataFixa, $this->dataAula, $this->horaRealizada, $this->ocorrenciaFFIdOcorrenciaFF, $this->reposicao, $this->banco, $this->aulaInexistente, $this->dataCadastro, $this->obs)";
	//	echo $sql;
		
		$result = $this -> query($sql);
       
		return $this -> connect;
	}

	function deleteDiaAulaFF() {

		$DiaAulaFFIndividual = new DiaAulaFFIndividual();
		$DiaAulaFFIndividual -> deleteDiaAulaFFIndividual(" OR diaAulaFF_idDiaAulaFF = " . $this -> idDiaAulaFF);

		$sql = "DELETE FROM diaAulaFF WHERE idDiaAulaFF = $this->idDiaAulaFF";
		return $result = $this -> query($sql);
	}

	/**
	 * updateFieldDiaAulaFF() Function
	 */
	function updateFieldDiaAulaFF($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE diaAulaFF SET " . $field . " = " . $value . " WHERE idDiaAulaFF = $this->idDiaAulaFF";
	//	echo "<BR>$sql";
		$result = $this -> query($sql);
	}

	function updateDiaAulaFF() {
		$sql = "UPDATE diaAulaFF SET folhaFrequencia_idFolhaFrequencia = $this->folhaFrequenciaIdFolhaFrequencia, aulaPermanenteGrupo_idAulaPermanenteGrupo = $this->aulaPermanenteGrupoIdAulaPermanenteGrupo, 
		aulaDataFixa_idAulaDataFixa = $this->aulaDataFixaIdAulaDataFixa, dataAula = $this->dataAula, horaRealizada = $this->horaRealizada, ocorrenciaFF_idOcorrenciaFF = $this->ocorrenciaFFIdOcorrenciaFF, 
		reposicao = $this->reposicao, banco = $this->banco, aulaInexistente = $this->aulaInexistente, obs = $this->obs WHERE idDiaAulaFF = $this->idDiaAulaFF";
//		echo $sql;
		$result = $this -> query($sql);
	}

	/**
	 * selectDiaAulaFF() Function
	 */
	function selectDiaAulaFF($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDiaAulaFF, folhaFrequencia_idFolhaFrequencia, aulaPermanenteGrupo_idAulaPermanenteGrupo, aulaDataFixa_idAulaDataFixa, dataAula, horaRealizada, ocorrenciaFF_idOcorrenciaFF, 
		reposicao, banco, aulaInexistente, dataCadastro, obs FROM diaAulaFF " . $where;
//		echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectDiaAulaFF_qtdHoras($where = "") {

		$sql = "SELECT SQL_CACHE COALESCE(SUM(horaRealizada),0) AS totalHoras FROM diaAulaFF " . $where;
		$rs = Uteis::executarQuery($sql);
	//	echo $sql;
		return $rs[0]['totalHoras'];
	}
	
	function selectDiaAulaFFPerdidas($where = "") {
		
	$sql = "SELECT SQL_CACHE
    coalesce(sum((APG.horafim - APG.horaInicio)- DFF.horaRealizada),0) as totalHoras
    
FROM
    diaAulaFF AS DFF
    LEFT JOIN
		aulaPermanenteGrupo as APG on DFF.aulaPermanenteGrupo_idAulaPermanenteGrupo = APG.idAulaPermanenteGrupo
	/*	LEFT JOIN
      aulaDataFixa AS AD on DFF.aulaDataFixa_idAulaDataFixa = AD.idAulaDataFixa */" . $where;
		$rs = Uteis::executarQuery($sql);
	//	echo $sql;
		return $rs[0]['totalHoras'];
	}

	

	function ffTem_Reposicao($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor = "") {

		$sql = " SELECT DFF.idDiaAulaFF, DFF.horaRealizada, DFF.dataAula, DFF.obs 
		FROM folhaFrequencia AS FF 
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo 
		INNER JOIN professor AS P ON P.idProfessor = FF.professor_idProfessor ";

		if ($idProfessor)
			$sql .= " AND P.idProfessor = " . $idProfessor;

		$sql .= " INNER JOIN diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia AND reposicao = 1 
		WHERE PAG.idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . " 
		AND MONTH(DFF.dataAula) = '" . $mesRef . "' AND YEAR(DFF.dataAula) = '" . $anoRef . "'";
    // echo $sql;
		$valor = Uteis::executarQuery($sql);
		return $valor;
	}
	
	function aulaInexistente($id = "", $aulaInexistente = "0"){
		
		$this->setIdDiaAulaFF($id);		
		$this->updateFieldDiaAulaFF("horaRealizada", "0");
		$this->updateFieldDiaAulaFF("ocorrenciaFF_idOcorrenciaFF", "NULL");
		$this->updateFieldDiaAulaFF("reposicao", "0");
		$this->updateFieldDiaAulaFF("aulaInexistente", $aulaInexistente);	

		
	}
	
	function CreditosDebitosBH($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $valorx2, $podeExcluir = false){
	    
	    $sql ="SELECT DFF.idDiaAulaFF, DFF.horaRealizada, DFF.dataAula, DFF.obs, DFF.ocorrenciaFF_idOcorrenciaFF, PAG.idPlanoAcaoGrupo FROM diaAulaFF AS DFF
	             INNER JOIN folhaFrequencia AS FF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia 
                 INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo
                 INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo WHERE reposicao = 0 AND banco = 1 AND PAG.idPlanoAcaoGrupo in ( ".$valorx2. ")";    
//				 echo $sql;    
        $valor = Uteis::executarQuery($sql);
        
        $ocorrencia = new OcorrenciaFF();
        
        $total = 0;
       foreach($valor as $k => $val):
                if($val['ocorrenciaFF_idOcorrenciaFF'] == 7):
                    $horas = $val['horaRealizada'];
                    $credeb = "Horas realizadas a mais";
					$total += $horas;
                else:
                    $horas = $val['horaRealizada'];
                    $credeb = "<font color=\"#FF0000\">Horas a compensar</font>";
					$total -= $horas;
                endif; 
                
           $html .= "<tr>
                        <td>".$credeb."</td>
                        <td>".Uteis::exibirHoras($horas)."</td>
                        <td>".Uteis::exibirData($val['dataAula'])."</td> 
                        <td>".$ocorrencia->getSiglaOcorrencia($val['ocorrenciaFF_idOcorrenciaFF'])."</td>                      
                        <td>".$val['obs']."</td>
                        <td onclick=\"abrirNivelPagina(this, '".$caminhoAbrir."form/bancoHoras_lancamentos.php?idPlanoAcaoGrupo=".$val['idPlanoAcaoGrupo']."&idDiaAulaFF=".$val['idDiaAulaFF']."', '$caminhoAtualizar')\" >
            <center><img src=\"" . CAMINHO_IMG . "editar.png\" title=\"Editar Valores\"></center></td>
            <td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/bancoHoras_lancamentos.php', '" . $val['idDiaAulaFF'] . "', '$caminhoAtualizar', '$ondeAtualiza')\">
                    <center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
                </td>
            </tr>";
       endforeach;   
	/*   
	   if ($total < 0) { 
	   $total = -1 * $total;
	   }
		
		$html .= " </tbody>
      <tfoot>
        <tr>            
          <th>Total</th>
          <th>".Uteis::exibirHoras($total)."</th>
          <th>".$credeb."</th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </tfoot>
    </table>";
		*/
		
      return $html;
	}
    function ContarOcorrencias($where){
        $sql = "SELECT count(ocorrenciaFF_idOcorrenciaFF) AS Total FROM diaAulaFF ".$where;
      //  echo $sql;
        $resp = $this->executeQuery($sql);
        return $resp[0]['Total'];   
}
}
?>