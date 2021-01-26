<?php
class PsaIntegranteGrupo extends Database {
	// class attributes
	var $idPsaIntegranteGrupo;
	var $integranteGrupoIdIntegranteGrupo;
	var $dataReferencia;
	var $dataCadastro;
	var $obs;
	var $finalizado;
	var $desistirPsa;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPsaIntegranteGrupo = "NULL";
		$this -> integranteGrupoIdIntegranteGrupo = "NULL";
		$this -> dataReferencia = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> obs = "NULL";
		$this -> finalizado = "0";
		$this -> desistirPsa = "0";		
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPsaIntegranteGrupo($value) {
		$this -> idPsaIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIntegranteGrupoIdIntegranteGrupo($value) {
		$this -> integranteGrupoIdIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
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

	function setFinalizado($value) {
		$this -> finalizado = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setDesistirPsa($value) {
		$this -> desistirPsa = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addPsaIntegranteGrupo() Function
	 */
	function addPsaIntegranteGrupo() {

		$sql = "INSERT INTO psaIntegranteGrupo (integranteGrupo_idIntegranteGrupo, dataReferencia, dataCadastro, obs, finalizado, desistirPsa) 
			VALUES ($this->integranteGrupoIdIntegranteGrupo, $this->dataReferencia, $this->dataCadastro, $this->obs, $this->finalizado, $this->desistirPsa)";
		$result = $this -> query($sql, true);

		return $this -> connect;
	}

	function deletePsaIntegranteGrupo(){
	    
	  $psr = new RespostaPsaRegular(); 
	  $psr->deleteRespostaPsaRegular(" OR psaIntegranteGrupo_idPsaIntegranteGrupo = ".$this->idPsaIntegranteGrupo);
    
      $psrP = new RespostaPsaProfessor();
      $psrP->deleteRespostaPsaProfessor(" OR psaIntegranteGrupo_idPsaIntegranteGrupo = ".$this->idPsaIntegranteGrupo);
		
		$sql = "DELETE FROM psaIntegranteGrupo WHERE idPsaIntegranteGrupo = ".$this->idPsaIntegranteGrupo;
		$result = $this -> query($sql, true);
		
		//$this->updateFieldPsaIntegranteGrupo("excluido", "1");		
	}

	/**
	 * updateFieldPsaIntegranteGrupo() Function
	 */
	function updateFieldPsaIntegranteGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE psaIntegranteGrupo SET " . $field . " = " . $value . " WHERE idPsaIntegranteGrupo = $this->idPsaIntegranteGrupo";
		$result = $this -> query($sql, true);
	}

	function updatePsaIntegranteGrupo() {
		$sql = "UPDATE psaIntegranteGrupo SET integranteGrupo_idIntegranteGrupo = $this->integranteGrupoIdIntegranteGrupo, dataReferencia = $this->dataReferencia, obs = $this->obs, finalizado = $this->finalizado WHERE idPsaIntegranteGrupo = $this->idPsaIntegranteGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPsaIntegranteGrupo() Function
	 */
	function selectPsaIntegranteGrupo($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPsaIntegranteGrupo, integranteGrupo_idIntegranteGrupo, dataReferencia, dataCadastro, obs, finalizado, desistirPsa FROM psaIntegranteGrupo " . $where;
		//echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectPsaIntegranteGrupoTr() Function
	 */
	function selectPsaIntegranteGrupoAluno_Tr($caminhoAbrir, $caminhoAtualizar, $onde, $where, $mobile) {

		$sql = "SELECT SQL_CACHE PSAIG.idPsaIntegranteGrupo, IG.idIntegranteGrupo, PSAIG.dataReferencia, PSAIG.finalizado, PSAIG.obs, IG.planoAcaoGrupo_idPlanoAcaoGrupo
		FROM psaIntegranteGrupo AS PSAIG
		INNER JOIN integranteGrupo AS IG ON IG.idIntegranteGrupo = PSAIG.integranteGrupo_idIntegranteGrupo " . $where;
		$result = $this -> query($sql);
	//	echo $sql;

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {

				$idPsaIntegranteGrupo = $valor['idPsaIntegranteGrupo'];
				$idIntegranteGrupo = $valor['idIntegranteGrupo'];
				$dataReferencia = $valor['dataReferencia'];
				$idPlanoAcaoGrupo = $valor['planoAcaoGrupo_idPlanoAcaoGrupo'];
				$obs = $valor['obs'];
				$finalizado = $valor['finalizado'];

				$html .= "<tr>
					
					<td>" . Uteis::exibirData($dataReferencia) . ($obs ? " - $obs" : "") . "</td>
					
					<td>" . Uteis::exibirStatus($finalizado) . "</td>";
					
					if ($mobile != 1) {
					$html .= "<td align=\"center\" onclick=\"abrirNivelPagina(this, '$caminhoAbrir?id=" . $idPsaIntegranteGrupo . "&idIntegranteGrupo=" . $idIntegranteGrupo . "&idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "', '$caminhoAtualizar', '$onde')\">";
					
					} else {
					$html .= "<td align=\"center\" onclick=\"zerarCentro();carregarModulo( '$caminhoAbrir?id=" . $idPsaIntegranteGrupo . "&idIntegranteGrupo=" . $idIntegranteGrupo . "&idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "', '#centro')\">";
						
						
					}
					
					$html .= "<img src=\"" . CAMINHO_IMG . "ver16.png\" title=\"Visualizar Pesquisa de satisfação\" />
					</td>
					
					</tr>";
			}
		}
		return $html;
	}

	function selectPsaIntegranteGrupoTr($idIntegranteGrupo, $idClientePf, $idPlanoAcaoGrupo) {
		
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
		
		$todosPAG = $PlanoAcaoGrupo->getTodosPAG($idPlanoAcaoGrupo);

		$sql = "SELECT SQL_CACHE PSAIG.idPsaIntegranteGrupo, PSAIG.dataReferencia, PSAIG.obs, PSAIG.finalizado, IG.planoAcaoGrupo_idPlanoAcaoGrupo, NE.nivel
		FROM psaIntegranteGrupo AS PSAIG
		INNER JOIN integranteGrupo AS IG ON IG.idIntegranteGrupo = PSAIG.integranteGrupo_idIntegranteGrupo 
		 INNER JOIN
    planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = IG.planoAcaoGrupo_idPLanoAcaoGrupo
        INNER JOIN
    planoAcao AS PA ON PAG.planoAcao_idPlanoAcao = PA.idPlanoAcao
        INNER JOIN
    nivelEstudo AS NE ON NE.idNivelEstudo = PA.nivelEstudo_idNivelEstudo";
		
		if ($idClientePf == '') {
			
		$sql .= " WHERE integranteGrupo_idIntegranteGrupo = " . $idIntegranteGrupo;
		
		} else {
			
		$sql .= " WHERE IG.clientePf_idClientePf = ".$idClientePf;	
		}
		$sql .= " AND PAG.idPlanoAcaoGrupo in (".$todosPAG.")";
		
	//	echo $sql;
		
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idPsaIntegranteGrupo = $valor['idPsaIntegranteGrupo'];
				$idPlanoAcaoGrupo = $valor['planoAcaoGrupo_idPlanoAcaoGrupo'];       
				$dataReferencia = $valor["dataReferencia"];
				$dataAtual = new DateTime();
				$finalizado = $valor["finalizado"];
				$dd = date("Y-m-d", strtotime("+90 days", strtotime($dataReferencia)));
                $rp = ($dd);
				$camAtu = CAMINHO_REL . "grupo/include/resourceHTML/psa.php?idIntegranteGrupo=" . $idIntegranteGrupo;
				$ondeAtu = "#div_lista_psa";
				$html .= "<tr>";

				//PARA ORDENAR
				$html .= "<td>". $idPsaIntegranteGrupo . "</td>";

				$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/psa.php?id=" . $idPsaIntegranteGrupo . "&idIntegranteGrupo=" . $idIntegranteGrupo . "', '$camAtu', '$ondeAtu')\" ";

				$html .= "<td $onclick >" . Uteis::exibirData($valor['dataReferencia'])."</td>";

				$html .= "<td $onclick >" . $valor['nivel']."</td> ";
				
				$html .= "<td $onclick >" . $valor['obs']."</td> ";
                
                

				if ($valor['finalizado'] == 0) {
					$ativo = "inativo.png";
				} else {
					$ativo = "ativo.png";
				}

				$html .= "<td align=\"center\" $onclick >
					<img src=\"" . CAMINHO_IMG . $ativo . "\" > 
				</td> 
				
				<td align=\"center\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/perguntasPsa.php?id=".$idPsaIntegranteGrupo."&idIntegranteGrupo=".$idIntegranteGrupo."&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."', '$camAtu', '$ondeAtu')\" >
					<img src=\"" . CAMINHO_IMG . "/pa.png\" title=\"Visualizar\">
				</td> ";

				$html .= "<td align=\"center\" >";
				if (!$finalizado) {
					$html .= " <img src=\"" . CAMINHO_IMG . "email16.png\" title=\"Avisar o aluno sobre o PSA\"
						onclick=\"postForm('', '" . CAMINHO_REL . "grupo/include/acao/psa.php', 'acao=email&idIntegranteGrupo=$idIntegranteGrupo&idPlanoAcaoGrupo=$idPlanoAcaoGrupo')\" > ";
				}
				
				$html .= "</td>";
				
								
				$html2 = "onclick=\"deletaRegistro('" . CAMINHO_REL. "grupo/include/acao/psa.php', '$idPsaIntegranteGrupo', '$camAtu', '$ondeAtu')\"";
				$imgD = " <center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>";
					
				$html .= "<td $html2 >";
				
				$html .= $imgD;
				
				$html .= "</td>";

				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectPsaIntegranteGrupoSelect() Function
	 */
	function selectPsaIntegranteGrupoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idPsaIntegranteGrupo, integranteGrupo_idIntegranteGrupo, dataReferencia, dataCadastro, obs, finalizado FROM psaIntegranteGrupo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idPsaIntegranteGrupo\" name=\"idPsaIntegranteGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idPsaIntegranteGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idPsaIntegranteGrupo'] . "\">" . ($valor['idPsaIntegranteGrupo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function listaPerguntasCheck() {

		$PsaProfessor = new PsaProfessor();
		$PsaRegular = new PsaRegular();

		$rs = $PsaProfessor -> selectPsaProfessor(" WHERE inativo = 0");

		if ($rs) {
			$html .= "<p><strong>Sobre o professor:</strong></p>
			<div class=\"linha-inteira\">";
			foreach ($rs as $valor) {

				$html .= "<div>";
				

				if ($valor['idPsaProfessor'] > 1) {
					
				$html .= "<label for=\"check_PsaProfessor_" . $valor['idPsaProfessor'] . "\">
				
				<input type=\"checkbox\" id=\"check_PsaProfessor_" . $valor['idPsaProfessor'] . "\" name=\"check_PsaProfessor[]\" value=\"" .$valor['idPsaProfessor'] . "\" checked=\"checked\" />" . $valor['pergunta'] . "</label>
				<input type=\"hidden\" id=\"nota_" . $valor['idPsaProfessor'] . "\" name=\"nota[".$valor['idPsaProfessor']."]\" value=\"".$valor['tipo']."\">
				</div>";
				
					
				}
			}
			$html .= "</div> <div class=\"linha-inteira\">&nbsp;</div>";
		}

		$rs = $PsaRegular -> selectPsaRegular(" WHERE inativo = 0 AND tipo = 4 ORDER BY idPSA DESC");
		if ($rs) {
			$html .= "<p><strong>Gerais:</strong></p>
			<div class=\"linha-inteira\">";
			foreach ($rs as $valor) {
				$html .= "<div style=\"float:left;width:50%;\">
				
				<label for=\"check_PsaRegular_" . $valor['idPsa'] . "\">
				
				<input type=\"checkbox\" id=\"check_PsaRegular_" . $valor['idPsa'] . "\" name=\"check_PsaRegular[]\" value=\"" .$valor['idPsa']. "\" checked=\"checked\" />" . $valor['pergunta'] . "</label>
				<input type=\"hidden\" id=\"nota_" . $valor['idPsa'] . "\" name=\"nota[".$valor['idPsa']."]\" value=\"".$valor['tipo']."\">
				</div>";
			}
			$html .= "</div> <div class=\"linha-inteira\">&nbsp;</div>";
		}
		return $html;
	}

	function finalizarPSA($idPsaIntegranteGrupo) {
		
		$TextoEmailPadrao = new TextoEmailPadrao();
		//ATUALIZA REGISTRO
		$this -> setIdPsaIntegranteGrupo($idPsaIntegranteGrupo);
		$this -> updateFieldPsaIntegranteGrupo("finalizado", "1");

		//ENVIAR E-MAIL PARA O RESPONSAVEL
		//$nomeAluno = $this -> getNomeIntegrnate($idPsaIntegranteGrupo);
		///$msg = "<p>Aluno: $nomeAluno</p>".$TextoEmailPadrao->getTexto("7");					
		//$paraQuem = Uteis::aviso_porSetor("4");        
		//Uteis::enviarEmail("Pesquisa de satisfação finalizada", $msg, $paraQuem, "");

	}
    
    function desfinalizarPSA($idPsaIntegranteGrupo){
        $this -> setIdPsaIntegranteGrupo($idPsaIntegranteGrupo);
        $this -> updateFieldPsaIntegranteGrupo("finalizado", "0");
    }

	function getNomeIntegrnate($idPsaIntegranteGrupo) {
		$IntegranteGrupo = new IntegranteGrupo();
		$rs = $this -> selectPsaIntegranteGrupo(" WHERE idPsaIntegranteGrupo = $idPsaIntegranteGrupo");
		return $IntegranteGrupo -> getNomePF($rs[0]['integranteGrupo_idIntegranteGrupo']);
	}
	
	function selectPsaIntegranteAlunoTr($idIntegranteGrupo, $aluno, $mobile, $idClientePf) {

		$sql = "SELECT SQL_CACHE PSAIG.idPsaIntegranteGrupo, PSAIG.dataReferencia, PSAIG.obs, PSAIG.finalizado, IG.planoAcaoGrupo_idPlanoAcaoGrupo
		FROM psaIntegranteGrupo AS PSAIG
		INNER JOIN integranteGrupo AS IG ON IG.idIntegranteGrupo = PSAIG.integranteGrupo_idIntegranteGrupo ";
		
		if ($idClientePf == '') {
			
		$sql .= " WHERE integranteGrupo_idIntegranteGrupo = " . $idIntegranteGrupo;
		
		} else {
			
		$sql .= " WHERE IG.clientePf_idClientePf = ".$idClientePf;	
		}
		
		$sql .= " ORDER BY PSAIG.idPsaIntegranteGrupo DESC";
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idPsaIntegranteGrupo = $valor['idPsaIntegranteGrupo'];
				$idPlanoAcaoGrupo = $valor['planoAcaoGrupo_idPlanoAcaoGrupo'];       
				$dataReferencia = $valor["dataReferencia"];
				$dataAtual = new DateTime();
				$finalizado = $valor["finalizado"];
				$dd = date("Y-m-d", strtotime("+90 days", strtotime($dataReferencia)));
                $rp = ($dd);
				$camAtu = CAMINHO_PSA . "resourceHTML/psa.php?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo;
				$ondeAtu = "#div_lista_psa";
				$html .= "<tr>";
				
			//	if ($mobile != 1) {
			//	$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_PSA . "form/perguntasPsa.php?id=" . $idPsaIntegranteGrupo . "&idIntegranteGrupo=" . $idIntegranteGrupo . "&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."', '$camAtu', '$ondeAtu')\" ";
			//	} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('modulos/psa/perguntasPsa.php?id=" . $idPsaIntegranteGrupo . "&idIntegranteGrupo=" . $idIntegranteGrupo . "&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."', '#centro')\" ";	
					
			//	}

				$html .= "<td $onclick >" . Uteis::exibirData($valor['dataReferencia'])."</td>";
				if ($aluno != 1)
				$html .= "<td $onclick >" . $valor['nivel']."</td> ";

				$html .= "<td $onclick >" . $valor['obs']."</td> ";
  
				if ($valor['finalizado'] == 0) {
					$ativo = "inativo.png";
				} else {
					$ativo = "ativo.png";
				}

				$html .= "<td align=\"center\" $onclick ><img src=\"" . CAMINHO_IMG . $ativo . "\" > 
				</td> 	<td align=\"center\" $onclick>";
				$html .= "	<img src=\"" . CAMINHO_IMG . "/pa.png\" title=\"Visualizar\">
				</td> ";


				$html .= "</tr>";
			}
		}
		return $html;
	}
	
	function psaFinalizada($idClientePf, $idPlanoAcaoGrupo) {
		
		$IntegranteGrupo = new IntegranteGrupo();
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
		
		$valorPAG = $PlanoAcaoGrupo->getTodosPAG($idPlanoAcaoGrupo);
		
		$where = " WHERE clientePf_idClientePf = ".$idClientePf. " AND planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorPAG.")";
		
		 $valorI = $IntegranteGrupo->selectIntegranteGrupo($where);
			 		  
		  		$IntegranteGrupoX = "(";
		  			foreach ($valorI as $valor2) {
			  			$IntegranteGrupoX .= $valor2['idIntegranteGrupo'].", ";
		  			}
		  		$IntegranteGrupoX .= "0)";
		
		 $resp = self::selectPsaIntegranteGrupo(" WHERE integranteGrupo_idIntegranteGrupo  in ".$IntegranteGrupoX." ORDER BY idPsaIntegranteGrupo DESC");
				
	//			Uteis::pr($resp);
                
               // $dataReferencia = new DateTime();
               $UltimaPsa = $resp[0]['dataReferencia'];
			   $envioPsa = $valor['envioPsa'];
				
				if ($UltimaPsa == '') {
					$d = strtotime($dataEntrada);
					$dias = $envioPsa;
				} else {
					$d = strtotime($UltimaPsa);
					if ($prazoPsa > 0) {
						$dias = $prazoPsa;
					} else {
					    $dias = 90;
					}
				}
	
               $dataReferencia = date('Y-m-d', strtotime("+".$dias ."days",$d));
			   $dataAtual = date("Y-m-d"); 
			/*   echo $valor['idIntegranteGrupo']. "   ".$dataReferencia."   ";
               
			   echo  $dataAtual."  ";
               echo !$resp." ".(strtotime($dataReferencia)>=strtotime($dataAtual))."<br>";*/
                if(!$resp && (strtotime($dataReferencia)>=strtotime($dataAtual))):
                    $cor = "style='border:2px solid #FFFF00'";
		        else:
                    if($resp[0]['finalizado']):
                       if(strtotime($dataReferencia)>=strtotime($dataAtual)):
                            $cor = "blue"; //"style='border:2px solid #006400'";
                        else:
                            $cor = "red"; //"style='border:2px solid #FF0000'";
                       endif;                    
                    else:
                            $cor = "red"; //"style='border:2px solid #FF0000'";
					endif;        
                endif;
		
		return $cor;
	}

}
?>

