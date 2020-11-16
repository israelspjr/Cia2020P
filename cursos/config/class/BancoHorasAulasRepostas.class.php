<?php
class BancoHorasAulasRepostas extends Database {
	// class attributes
	var $idBancoHorasAulasRepostas;
	var $diaAulaFFIdDiaAulaFF;
	var $horasRepostas;
	var $bancoHorasIdBancoHoras;
	var $ativo;
	var $excluido;
	var $professoridProfessor;
	var $totalReposto;
	var $dataReferenciaFinal;
	var $ocorrenciaExpirada;
	var $finalizado;
	var $idDiaAulaFFR;
	var $somaReposicao;
	var $horaSobra;
	var $planoAcaoGrupoidPlanoAcaoGrupo;
	var $reposicaoFinalizada;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idBancoHorasAulasRepostas = "NULL";
		$this -> diaAulaFFIdDiaAulaFF = "NULL";
		$this -> horasRepostas = 0;
		$this -> bancoHorasIdBancoHoras = "NULL";
		$this -> ativo = 0;
		$this -> excluido = 0;
		$this -> professoridProfessor = 0;
		$this -> totalReposto = 0;
		$this -> dataReferenciaFinal = "NULL";
		$this -> ocorrenciaExpirada = 0;
		$this -> finalizado = 0;
		$this -> idDiaAulaFFR = 0;
		$this -> somaReposicao = 0;
		$this -> horaSobra = 0;
		$this -> planoAcaoGrupoidPlanoAcaoGrupo = 0;
		$this -> reposicaoFinalizada = 0;

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdBancoHorasAulasRepostas($value) {
		$this -> idBancoHorasAulasRepostas = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDiaAulaFFIdDiaAulaFF($value) {
		$this -> diaAulaFFIdDiaAulaFF = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHorasRepostas($value) {
		$this -> horasRepostas = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setBancoHorasIdBancoHoras($value) {
		$this->bancoHorasIdBancoHoras = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setAtivo($value) {
		$this -> ativo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setProfessoridProfessor($value) {
		$this -> professoridProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setTotalReposto($value) {
		$this -> totalReposto = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setDataReferenciaFinal($value) {
		$this -> dataReferenciaFinal = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setOcorrenciaExpirada($value) {
		$this -> ocorrenciaExpirada = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setFinalizado($value) {
		$this -> finalizado = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setIdDiaAulaFFR($value) {
		$this -> idDiaAulaFFR = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setSomaReposicao($value) {
		$this -> somaReposicao = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setHoraSobra($value) {
		$this -> horaSobra = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPlanoAcaoGrupoidPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoidPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setReposicaoFinalizada($value) {
		$this -> reposicaoFinalizada = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addBancoHorasAulasRepostas() Function
	 */
	function addBancoHorasAulasRepostas() {
		$sql = "INSERT INTO bancoHorasAulasRepostas (diaAulaFF_idDiaAulaFF, horasRepostas, bancoHoras_IdBancoHoras, ativo, excluido, professor_idProfessor, totalReposto, dataReferenciaFinal, ocorrenciaExpirada, finalizado, idDiaAulaFFR, somaReposicao, horaSobra, planoAcaoGrupo_idPlanoAcaoGrupo, reposicaoFinalizada) VALUES ($this->diaAulaFFIdDiaAulaFF, $this->horasRepostas, $this->bancoHorasIdBancoHoras, $this->ativo, $this->excluido, $this->professoridProfessor, $this->totalReposto, $this->dataReferenciaFinal, $this->ocorrenciaExpirada, $this->finalizado, $this->idDiaAulaFFR, $this->somaReposicao, $this->horaSobra, $this->planoAcaoGrupoidPlanoAcaoGrupo, $this->reposicaoFinalizada)";
		$result = $this -> query($sql, true);
	//	echo "<hr>".$sql."<hr>";
		return $this -> connect;
	}

	/**
	 * deleteBancoHorasAulasRepostas() Function
	 */
	function deleteBancoHorasAulasRepostas($or = "") {
		$sql = "DELETE FROM bancoHorasAulasRepostas WHERE idBancoHorasAulasRepostas = $this->idBancoHorasAulasRepostas " . $or;
//		echo $sql;
		return $result = $this -> query($sql, true);
	}
	
	function deleteBancoHorasAulasRepostasPlanoAcaoGrupo($or = "") {
		$sql = "DELETE FROM bancoHorasAulasRepostas WHERE idDiaAulaFFR = " .$or;
//		echo $sql;
		return $result = $this -> query($sql, true);	
	}

	/**
	 * updateFieldBancoHorasAulasRepostas() Function
	 */
	function updateFieldBancoHorasAulasRepostas($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE bancoHorasAulasRepostas SET " . $field . " = " . $value . " WHERE idBancoHorasAulasRepostas = $this->idBancoHorasAulasRepostas";
		
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateBancoHorasAulasRepostas() Function
	 */
	function updateBancoHorasAulasRepostas() {
		$sql = "UPDATE bancoHorasAulasRepostas SET diaAulaFF_idDiaAulaFF = $this->diaAulaFFIdDiaAulaFF, horasRepostas = $this->horasRepostas, bancoHorasIdBancoHoras = $this->bancoHorasIdBancoHoras, ativo = $this->ativo, excluido = $this->excluido, professor_idProfessor = $this->professoridProfessor, totalReposto = $this ->totalReposto, dataReferenciaFinal = $this ->dataReferenciaFinal, ocorrenciaExpirada = $this ->ocorrenciaExpirada, finalizado = $this->finalizado, idDiaAulaFFR = $this->idDiaAulaFFR, somaReposicao = $this->somaReposicao, horaSobra = $this->horaSobra, planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoidPlanoAcaoGrupo, reposicaoFinalizada = $this->reposicaoFinalizada WHERE idBancoHorasAulasRepostas = $this->idBancoHorasAulasRepostas";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectBancoHoras() Function
	 */
	function selectBancoHorasAulasRepostas($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idBancoHorasAulasRepostas, 
		diaAulaFF_idDiaAulaFF, 
		horasRepostas, 
		bancoHoras_idBancoHoras, 
		ativo, excluido, 
		professor_idProfessor, 
		totalReposto, dataReferenciaFinal,
		 ocorrenciaExpirada, finalizado, 
		 idDiaAulaFFR, somaReposicao,
		 horaSobra, planoAcaoGrupo_idPlanoAcaoGrupo, reposicaoFinalizada
		  FROM bancoHorasAulasRepostas 
		 " . $where;
	//	Uteis::pr( $sql);
		
		return $this -> executeQuery($sql);
	}

 
	/**
	 * selectBancoHorasSelect() Function
	 */
	function selectBancoHorasAulasRepostasSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idBancoHorasAulasRepostas, diaAulaFF_idDiaAulaFF, horasRepostas, bancoHorasIdBancoHoras, ativo, excluido, professor_idProfessor FROM bancoHorasAulasRepostas " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idBancoHorasAulasRepostas\" name=\"idBancoHorasAulasRepostas\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idBancoHorasAulasRepostas'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idBancoHorasAulasRepostas'] . "\">" . ($valor['idBancoHorasAulasRepostas']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}
	
	function selectBancoHorasAulasRepostasMax($where) {
		
	$sql = "select sum(totalReposto) as horas FROM bancoHorasAulasRepostas ".$where;
//	echo $sql;
	return $this -> executeQuery($sql);
	
//	return $rs[0];	
	}
	
	function selectBancoHorasAulasHoraSobra($where) {
		
	$sql = "select sum(totalReposto) as horas FROM bancoHorasAulasRepostas ".$where;
	return $this -> executeQuery($sql);
	
//	return $rs[0];	
	}
	
	function BancoHorasAulasRepostas($where) {
		
	$sql = "select BAR.totalReposto, BAR.diaAulaFF_idDiaAulaFF, BAR.idDiaAulaFFR, DAF.idDiaAulaFF, DAF.dataAula
	 FROM bancoHorasAulasRepostas AS BAR
	 	INNER JOIN
	 diaAulaFF AS DAF on DAF.idDiaAulaFF = BAR.idDiaAulaFFR
	 	".$where;
	return $this -> executeQuery($sql);
	
//	return $rs[0];	
	}
	
	
	function calcularReposicao($idDiaAulaFFO, $dataExpira, $horasDoBanco, $idDiaAulaFFR, $dataReferenciaFinal, $horaRealizada, $dataReposicao,$idBancoHoras,$idProfessor, $planoAcaoGrupo, $expirar) {

	// Versão 1.0.11 08/08/2016
/*		echo "<hr>";
		echo "IdOcorrencia :".$idDiaAulaFFO."<br>";
		echo "dataExpira :".$dataExpira."<br>";
		echo "horasdo Banco :".$horasDoBanco."<br>";
		echo "idReposicao :".$idDiaAulaFFR."<br>";
		echo "dataReferenciaFinal :".$dataReferenciaFinal."<br>";
		echo "horarealizada:".$horaRealizada."<br>";
		echo "datareposicao:".$dataReposicao."<br>";
		echo "PlanoAcaoGrupo:".$planoAcaoGrupo."<br>";
		echo "<br>";*/
	
		$rs = $this->selectBancoHorasAulasRepostas("where diaAulaFF_idDiaAulaFF = ".$idDiaAulaFFO ." order By idBancoHorasAulasRepostas Desc");
		
		$rsReposicaoUsada = $this->selectBancoHorasAulasRepostas("where idDiaAulaFFR = ".$idDiaAulaFFR. " order By idBancoHorasAulasRepostas Desc");
		
		$totalHorasRepondo = 0;
		
		$horaSobra = $rsReposicaoUsada[0]['horaSobra'];
//		echo "horaSobra:".$horaSobra."<br>";
		
		$reposicaoAtiva = $rsReposicaoUsada[0]['ativo'];
		
		$reposicaoFinalizada = $rsReposicaoUsada[0]['finalizado'];
		
		$idOcorrencia = $rs[0]['idBancoHorasAulasRepostas'];
		
		if ($expirar == 1) {
			
			$dataExpiraMes = date("Y-m-t", strtotime($dataExpira));
			
			
			 if (count($rs) > 0) {
			
			
			 } else {
				
			//		$this->setIdBancoHorasAulasRepostas($idOcorrencia);
					$this->setDiaAulaFFIdDiaAulaFF($idDiaAulaFFO);
					$this->setHorasRepostas($horasDoBanco);
					$this->setBancoHorasIdBancoHoras($idBancoHoras);
					$this->setAtivo(1);					
					$this->setExcluido(0);
					$this->setProfessoridProfessor($idProfessor);
					$this->setTotalReposto(0);
					$this->setDataReferenciaFinal($dataExpiraMes);
	//				$this->setDataReferenciaFinal($dataReferenciaFinal);
					$this->setOcorrenciaExpirada(1);
					$this->setFinalizado(1);
					$this->setIdDiaAulaFFR(-1);		
					$this->setSomaReposicao(0);
					$this->setHoraSobra(0);		
					$this->setPlanoAcaoGrupoidPlanoAcaoGrupo($planoAcaoGrupo);							
					$this->addBancoHorasAulasRepostas(); 
				 
				 
			 }
			 
		}
			
		if ($dataExpira > 0) {
		
/*		list($year, $month, $day) = split('-', $dataExpira);
		
		$dataReferenciaTmp = date(" ".$year."-".$month."-t");
		
		$dataReferencia = date("Y-m-d", strtotime($dataReferenciaTmp));
		
		$dataExpiraTmp = $dataExpira;
		
		$dataExpira = date("Y-m-d", strtotime($dataExpiraTmp));*/
		
		
		$dataReferencia = $dataExpiraMes;
		
		$dataExpira = $dataExpiraMes;
		
		} else {$dataExpira = 0; }
		

		if ($expirar == 1) {
//		echo "teste 8";
		
		} elseif  (($rs[0]['finalizado'] == 1) or ($rs[0]['ocorrenciaExpirada'] == 1))  {
 //      echo "teste 1";
			
		 } elseif  (($reposicaoFinalizada == 1) && ($horaSobra <= 1)) {
//	 echo "teste 6";
		 
		 } elseif  (($reposicaoAtiva == 1) && ($horaSobra <= 1) && ($reposicaoFinalizada == 2)) {
//		echo "teste 2";

		} elseif (($reposicaoAtivva == 1) && ($horaSobra <= 1)) {
//			echo "teste 4";
				
		} elseif (($resposicaoAtiva == 1) && ($finalizado == 1) && ($horaSobra <= 1)) {
//			echo "teste 5";
		
		} elseif  (($dataExpira > 0) && ($dataReposicao > $dataReferencia)) {
//			echo "teste 7";
		
		}	else {
			
				//Variaveis globais
				
				//Valor total a repor
		$totalOcorrencia = $horasDoBanco;
//		echo "Total a Repor : ".$totalOcorrencia."<br>";
				
				//Horas Repostas
		$rsO = self::selectBancoHorasAulasRepostasMax(" WHERE diaAulaFF_idDiaAulaFF = ".$idDiaAulaFFO);
		$totalReposto = $rsO[0]['horas'];
//		echo "totalreposto : ".$totalReposto."<br>"; 
				
				
				//Hora que vem pra repor
		$horaSobra = $horaSobra;
//		echo "horaSobra: ".$horaSobra."<br>";
		
		if ($horaSobra >0 ) {
			$horaRealizada = $horaSobra;
		}
			
		
		//Hora de reposição
		$horaReposicao = $horaRealizada;
//		echo "horadereposicao :".$horaReposicao."<br>";
		
		//Calcular horas desse turno
		//Horas a Repor - o que já foi reposto
		$valorAtual = $totalOcorrencia - $totalReposto;
//		echo "total a repor neste turno".$valorAtual."<br>";
		
		if ($valorAtual == 0) {
		
//		echo "teste10";	
		} else {
		
		//somaReposicao
		$somaReposicao = $totalReposto + $horaReposicao;
				
		
		if ($horaReposicao > $valorAtual) {
		$diferença = $horaReposicao - $valorAtual;
//		$horaReposicao = $valorAtual;
		$horaRealizada = $valorAtual;
		$somaReposicao = $totalOcorrencia;
		$finalizacao = 1;
		
		}
		
					
					if ($diferença > 0) {
						$reposicaoFinalizada = 2;
					
					} else {
						$reposicaoFinalizada = 1;	
					}
	    			$this->setDiaAulaFFIdDiaAulaFF($idDiaAulaFFO);
					$this->setHorasRepostas($horasDoBanco);
					$this->setBancoHorasIdBancoHoras($idBancoHoras);
					$this->setAtivo(1);					
					$this->setExcluido(0);
					$this->setProfessoridProfessor($idProfessor);
					$this->setTotalReposto($horaRealizada);
					$this->setDataReferenciaFinal($dataReferenciaFinal);
					$this->setOcorrenciaExpirada(0);
					
					if ($efetuarFinalizacao == 1) {
						$this->setFinalizado(1);
					} else {
						$this->setFinalizado(2);
					}
					
					$this->setIdDiaAulaFFR($idDiaAulaFFR);		
					$this->setSomaReposicao($somaReposicao);
					$this->setHoraSobra($diferença);		
					$this->setPlanoAcaoGrupoidPlanoAcaoGrupo($planoAcaoGrupo);	
					$this->setReposicaoFinalizada($reposicaoFinalizada);						
					$this->addBancoHorasAulasRepostas();
	
			} 

		}

		return $html;
	}
	
	
 }
?>