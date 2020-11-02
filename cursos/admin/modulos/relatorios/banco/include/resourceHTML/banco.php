<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();
$BancoHoras = new BancoHoras();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$DiaAulaFF = new DiaAulaFF();
$Grupo = new Grupo();
$AulaGrupoProfessor = new AulaGrupoProfessor();
$IdiomaProfessor = new IdiomaProfessor();
$PlanoCarreirraIdiomaProfessor = new PlanoCarreirraIdiomaProfessor();
$PlanoCarreira = new PlanoCarreirra();
$Professor = new Professor();

$caminhoAbrir = CAMINHO_MODULO."relacionamento/grupo/cadastro.php";
$caminhoAtualizar = ""; 

require_once "../acao/filtros.php";

foreach ($valorGrupos AS $valor) {
	$idPlanoAcaoGrupo = $PlanoAcaoGrupo->getPAG_atual($valor['grupo_idGrupo']);
	$valorx2 = $PlanoAcaoGrupo->getTodosPAG($idPlanoAcaoGrupo);
	$nome = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);
	
	
	if ($idProfessor > 0) {

		$valorIdEmpresas = $Professor->selectGrupoProfTr_query(" WHERE P.idProfessor =".$idProfessor." AND PAG.inativo = 0 AND G.inativo = 0"); 
	} else {
//		$valorIdEmpresas = $gerentePorEmpresa->selectGerenteTemBH($where);
		
	}


 $valor = $AulaGrupoProfessor->selectAulaGrupoProfessor_periodo($idPlanoAcaoGrupo, $data_fim);

 $nomeProfessor = "";
 $valorProfessorNotaT = "";
 $totalHoras = 0;
 $t =0;
 
 foreach($valor as $valor2) {
 
 $valorIdioma = $IdiomaProfessor->selectIdiomaProfessor(" WHERE professor_idProfessor = ".$valor2);
 $valorPlanoCarreira = $PlanoCarreirraIdiomaProfessor->selectPlanoCarreirraIdiomaProfessor(" WHERE idiomaProfessor_idIdiomaProfessor =".$valorIdioma[0]['idIdiomaProfessor'] ." AND mesFim is null");
 $valorPlanoCarreiraValor = $PlanoCarreira->selectPlanoCarreirra(" WHERE idPlanoCarreira =".$valorPlanoCarreira[0]['planoCarreirra_idPlanoCarreira']);
 	 
 $nomeProfessor .= $Professor->getNome($valor2)."<br>";
 $valorProfessorNotaT .= Uteis::formatarMoeda($valorPlanoCarreiraValor[0]['plano'])."<br>";
 $totalHoras += $valorPlanoCarreiraValor[0]['plano'];
 $t++;
 }
 if ($t > 0) {
 $mediaHoras = $totalHoras/$t;
 }

 	$dataX = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($data_fim)))); 
	$bancoAC = $BancoHoras->selectBancoHorasTo($where2, true, $opcao, $valorx2, $data_ini, $dataX, 1, "", $campos, $camposNome);
	
	// Totais
	$totalBancoAc = $bancoAC['ocorrencia'];
    $horasExpiradasAc = $bancoAC['expirada'];
	$totalReposicaoAc = $bancoAC['reposicao'];
	$saldoHorasAc = $bancoAC['saldo']; 
	$obs3 = $bancoAC['obs']; 
	
 		$saldoHorasSomaAc += $saldoHorasAc;
		$saldoHorasAcVisivel = $saldoHorasAc;
		$totalHorasAc += $saldoHorasAcVisivel;
		$totalOcorrencia += $totalBancoAc;
		$totalR += $totalReposicaoAc;
		$totalE += $horasExpiradasAc;
		
		$saldoHoras = $saldoHorasAc + $totalBanco - $totalReposicao - $horasExpiradas;
		$totalSaldo  += $saldoHoras;
		$total4 += $bancoAC['totalOcorrencia'][4];
		$totalOutras += $outrasOcorrencias;
		
			 $onclick = "onclick='abrirNivelPagina(this,\"/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$idPlanoAcaoGrupo."\", \"\", \"\")'";
	
		if($saldoHoras == 0){
			
		$totalOcorrenciaZ += $totalBancoAc;
		$totalRZ += $totalReposicaoAc;
		$totalEZ += $horasExpiradasAc;
		
		$saldoHorasZ = $totalOcorrenciaZ - $totalRZ - $totalEZ;
		$totalSaldoZ  += $saldoHorasZ;


			
			$htmlZ .= "<tr>";
			foreach ($campos AS $campo) {
				if ($campo == 'grupo') {
					$htmlZ .= "<td ><img src='/cursos/images/cad.png' title='Ver grupo' $onclick>".$nome."</td>";
				} elseif ($campo == 'nome') {
					$htmlZ .= "<td>".$nomeProfessor."</td>";
				} else if ($campo == 'valorP') {
					$htmlZ .= "<td>".$mediaHoras."</td>";
				} else if ($campo == 'valorA') {
					$htmlZ .= "<td>".Uteis::exibirHoras($saldoHoras).$obs3."</td>";	
				} else if ($campo == 'horaN') {
					$htmlZ .= "<td>".Uteis::exibirHoras($totalBancoAc)."</td>";	
				} else if ($campo == 'horaR') {
					$htmlZ .= "<td>".Uteis::exibirHoras($totalReposicaoAc)."</td>";	
				} else if ($campo == 'horaE') {
					$htmlZ .= "<td>".Uteis::exibirHoras($horasExpiradasAc)."</td>";		
					}
				}
			$htmlZ .= "</tr>";
			
    //    	 $obs = "";
    	}else if($saldoHoras > 0){
			
		$totalOcorrenciaA += $totalBancoAc;
		$totalRA += $totalReposicaoAc;
		$totalEA += $horasExpiradasAc;
	
		$saldoHorasA = $totalOcorrenciaA - $totalRA - $totalEA;
		$totalSaldoA  += $saldoHorasA;


			 $obs = " a compensar (Total de PA(Geral): ".Uteis::exibirHoras($bancoAC['totalOcorrencia'][4]).$outrasOcorrencias.")";
			 
			 			$htmlA .= "<tr>";
			foreach ($campos AS $campo) {
				if ($campo == 'grupo') {
					$htmlA .= "<td ><img src='/cursos/images/cad.png' title='Ver grupo' $onclick>".$nome."</td>";
				} elseif ($campo == 'nome') {
					$htmlA .= "<td>".$nomeProfessor."</td>";
				} else if ($campo == 'valorP') {
					$htmlA .= "<td>".$mediaHoras."</td>";
				} else if ($campo == 'valorA') {
					$htmlA .= "<td>".Uteis::exibirHoras($saldoHoras).$obs3."</td>";	
				} else if ($campo == 'horaN') {
					$htmlA .= "<td>".Uteis::exibirHoras($totalBancoAc)."</td>";	
				} else if ($campo == 'horaR') {
					$htmlA .= "<td>".Uteis::exibirHoras($totalReposicaoAc)."</td>";	
				} else if ($campo == 'horaE') {
					$htmlA .= "<td>".Uteis::exibirHoras($horasExpiradasAc)."</td>";		
					}
				}
			$htmlA .= "</tr>";
	
		}else{
			
		$totalOcorrenciaE += $totalBancoAc;
		$totalRE += $totalReposicaoAc;
		$totalEE += $horasExpiradasAc;
		
		$saldoHorasE = $totalOcorrenciaE - $totalRE - $totalEE;
		$totalSaldoE  += $saldoHorasE;


     	$saldoHoras *= -1;
		$totalSaldoE *= -1;
		$obs = " realizadas a mais";
		
					$htmlE .= "<tr>";
			foreach ($campos AS $campo) {
				if ($campo == 'grupo') {
					$htmlE .= "<td ><img src='/cursos/images/cad.png' title='Ver grupo' $onclick>".$nome."</td>";
				} elseif ($campo == 'nome') {
					$htmlE .= "<td>".$nomeProfessor."</td>";
				} else if ($campo == 'valorP') {
					$htmlE .= "<td>".$mediaHoras."</td>";
				} else if ($campo == 'valorA') {
					$htmlE .= "<td>".Uteis::exibirHoras($saldoHoras).$obs3."</td>";	
				} else if ($campo == 'horaN') {
					$htmlE .= "<td>".Uteis::exibirHoras($totalBancoAc)."</td>";	
				} else if ($campo == 'horaR') {
					$htmlE .= "<td>".Uteis::exibirHoras($totalReposicaoAc)."</td>";	
				} else if ($campo == 'horaE') {
					$htmlE .= "<td>".Uteis::exibirHoras($horasExpiradasAc)."</td>";		
					}
				}
			$htmlE .= "</tr>";
	
		}
	}	

		if($totalSaldo == 0){
        	 $obs2 = "";
    	}else if($totalSaldo > 0){
			 $obs2 = " a compensar (Total de PA (Geral): ".Uteis::exibirHoras($total4).")";
		}else{
     	$totalSaldo *= -1;
		$obs2 = " realizadas a mais";
		}

			
		$html = "";
//		echo $HorasS;
		if ($HorasS == 3) {
			$html = $htmlA;	
		$camposNome[3] = "Horas não realizadas. Total:". Uteis::exibirHoras($totalOcorrenciaA);
		$camposNome[4] = "Horas reposição. Total:". Uteis::exibirHoras($totalRA);
		$camposNome[5] = "Horas expiradas. Total:". Uteis::exibirHoras($totalEA);
		$camposNome[6] = "Total Saldo:". Uteis::exibirHoras($totalSaldoA).$obs2;

		} elseif ($HorasS == 1) {
			$html = $htmlE;	
		$camposNome[3] = "Horas não realizadas. Total:". Uteis::exibirHoras($totalOcorrenciaE);
		$camposNome[4] = "Horas reposição. Total:". Uteis::exibirHoras($totalRE);
		$camposNome[5] = "Horas expiradas. Total:". Uteis::exibirHoras($totalEE);
		$camposNome[6] = "Total Saldo:". Uteis::exibirHoras($totalSaldoE).$obs2;

		} elseif ($HorasS == 2) {
			$html = $htmlZ;
		$camposNome[3] = "Horas não realizadas. Total:". Uteis::exibirHoras($totalOcorrenciaZ);
		$camposNome[4] = "Horas reposição. Total:". Uteis::exibirHoras($totalRZ);
		$camposNome[5] = "Horas expiradas. Total:". Uteis::exibirHoras($totalEZ);
		$camposNome[6] = "Total Saldo:". Uteis::exibirHoras($totalSaldoZ).$obs2;

		} elseif ($HorasS == 4) {
			$html = $htmlE . $htmlA. $htmlZ;
		$camposNome[3] = "Horas não realizadas. Total:". Uteis::exibirHoras($totalOcorrencia);
		$camposNome[4] = "Horas reposição. Total:". Uteis::exibirHoras($totalR);
		$camposNome[5] = "Horas expiradas. Total:". Uteis::exibirHoras($totalE);
		$camposNome[6] = "Total Saldo:". Uteis::exibirHoras($totalSaldo).$obs2;

		}

   $html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $colunas);	
   echo $html_base . $html;

?>
<script> 
tabelaDataTable('tb_lista_res' );
</script> 