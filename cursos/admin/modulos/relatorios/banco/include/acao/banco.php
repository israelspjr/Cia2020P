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
$caminhoAtualizar = CAMINHO_RELAT."banco/include/resourceHTML/banco.php";

require_once "../acao/filtros.php";

if(isset($_REQUEST["tr"])){
    
	$arrayRetorno = array();
	$idPlanoAcaoGrupo = $_REQUEST["idPlanoAcaoGrupo"];
	$ordem = $_REQUEST["ordem"];
	echo json_encode($arrayRetorno);
	exit;		
}





//Montar Acumulado

$dataFimMesAnterior = date("Y-m-t", strtotime("-1 months", strtotime($data_ini)));
//echo $dataFimMesAnterior."<br>";
$dataInicioSistema = "2015-02-01";

if ($dataFimMesAnterior > $dataInicioSistema) {


	//Where Temporario para trazer os créditos e débitos para junto do quadro
	 $where = "WHERE  DFF.reposicao = 0 AND DFF.banco = 1 AND 
	 			PAG.idPlanoAcaoGrupo in (".$valorx2.")
				And FF.dataReferencia between '".$dataInicioSistema."' and '".$dataFimMesAnterior."'   
                 OR DFF.idDiaAulaFF in 
                 (SELECT 
            diaAulaFF_idDiaAulaFF
        FROM
            planoAcaoGrupo AS PAG
                INNER JOIN
            folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
                AND FF.finalizadaParcial = 1
                AND FF.finalizadaPrincipal = 1
				And FF.dataReferencia between '".$dataInicioSistema."' and '".$dataFimMesAnterior."'
                INNER JOIN
            diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                INNER JOIN
            bancoHoras AS BH ON BH.diaAulaFF_idDiaAulaFF = DFF.idDiaAulaFF
        WHERE
            PAG.grupo_idGrupo =".$idGrupo.") ";
 
 		$datafim = $dataFimMesAnterior;
		$dataini = $dataInicioSistema;
	
	//Total Ocorrências
//	 $opcao = "totalOcorrencia";

//	$where2 = $BancoHoras->OcorrenciaGrupoNovo($valorx2, $dataini, $datafim);


	$bancoAC = $BancoHoras->selectBancoHorasTo($where, true, $opcao, $valorx2, $dataini, $datafim, 1, "", $campos, $camposNome);
	
	Uteis::pr($bancoAC);
	
	$totalBancoAc = $bancoAC['ocorrencia'];
	 $horasExpiradasAc = $bancoAC['expirada'];
	 $totalReposicaoAc = $bancoAC['reposicao'];
	 $saldoHorasAc = $bancoAC['saldo']; 
	  $obs3 = $bancoAC['obs']; 
	
 		$saldoHorasSomaAc += $saldoHorasAc;
		$saldoHorasAcVisivel = $saldoHorasAc;
		$totalHorasAc += $saldoHorasAcVisivel;

} else {
	
//	echo "Não é possivel selecionar, primeira data é menor do que data inicial do sistema";
	
	}
	
}
 // Fim Acumulado

	   
	//Where Temporario para trazer os créditos e débitos para junto do quadro
	 $where = "WHERE  DFF.reposicao = 0 AND DFF.banco = 1 AND 
	 			PAG.idPlanoAcaoGrupo in (".$valorx2.")
				And FF.dataReferencia between '".$data_ini."' and '".$data_fim."'   
                 OR DFF.idDiaAulaFF in 
                 (SELECT 
            diaAulaFF_idDiaAulaFF
        FROM
            planoAcaoGrupo AS PAG
                INNER JOIN
            folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
                AND FF.finalizadaParcial = 1
                AND FF.finalizadaPrincipal = 1
				And FF.dataReferencia between '".$data_ini."' and '".$data_fim."'
                INNER JOIN
            diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                INNER JOIN
            bancoHoras AS BH ON BH.diaAulaFF_idDiaAulaFF = DFF.idDiaAulaFF
        WHERE
            PAG.grupo_idGrupo =".$idGrupo.") ";
			
//			echo $where;
		
		$datafim = $data_fim;
		$dataini = $data_ini;
	
	//Total Ocorrências
//	 $opcao = "totalOcorrencia";
	 $banco = $BancoHoras->selectBancoHorasTo($where, true, $opcao, $valorx2, $dataini, $datafim, 1,$idGrupo);
	 
//	 Uteis::pr($banco);

	$totalBanco = $banco['ocorrencia'];
	 $horasExpiradas = $banco['expirada'];
	 $totalReposicao = $banco['reposicao'];
	 $saldoHoras = $banco['saldo']; 
	 
//	 echo $banco['obs'];
	 
	 $outrasOcorrencias = "";
	 if ($banco['totalOcorrencia']['outras'] > 0) {
	 	$outrasOcorrencias = " Outras: ".Uteis::exibirHoras($banco['totalOcorrencia']['outras']);
	 }
	$obs = ""; 
	 
	 	$saldoHoras = $saldoHorasAc + $totalBanco - $totalReposicao - $horasExpiradas;
		$saldoHorasSoma += $saldoHoras;
//		echo Uteis::exibirHoras($saldoHorasSoma)."<br>";
		
	
	if($saldoHoras == 0){
         $obs = "";
    }else if($saldoHoras > 0){
		 $obs = $obs ." a compensar (Total de PA: ".Uteis::exibirHoras($banco['totalOcorrencia'][4]).$outrasOcorrencias.")";
		 $xy = 1;
	}else{
		$yx = 1;
     	$saldoHoras *= -1;
		$obs = " realizadas a mais";
	}
	$img = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"Acessar cadastro do grupo\" />";
	 $onclick = " title=\"Ver grupo\" onclick=\"abrirNivelPagina(this, '$caminhoAbrir?id=$ultimoId', '', '')\" ";
	$html .= "<tr><th>".$tt."</th>";
	if ($HorasS == "-") {
	$html .= "<th ".$onclick.">".$img. $nome."</th>  
	<th>".Uteis::exibirHoras($saldoHorasAcVisivel).$obs3."</th>
	  <th>".Uteis::exibirHoras($totalBanco)."</th>
	   <th>".Uteis::exibirHoras($totalReposicao)."</th>
	  <th>".Uteis::exibirHoras($horasExpiradas)."</th>
      <th>".Uteis::exibirHoras($saldoHoras).$obs."</th>
      </tr>";
	    $totalGeral += $saldoHoras;
		$totalGeralBanco += $totalBanco;
		$totalGeralExpiradas += $horasExpiradas;
		$totalGeralReposicao += $totalReposicao;
		
/*	  $html3 .= "<td>".Uteis::exibirHoras($saldoHoras)."</td>";	
	  $html3 .= "<td>".Uteis::exibirHoras($saldoHoras)."</td>";*/
	} else {
		if (($HorasS == 0)  && $xy == 1) {
			$saldoFinalC = 0;
				$html3 .= "<tr><th>".$tt."</th>";

	$html .= "<tr><th ".$onclick.">".$img. $nome."</th>  
	  <th>".Uteis::exibirHoras($totalBanco)."</th>
	   <th>".Uteis::exibirHoras($totalReposicao)."</th>
	  <th>".Uteis::exibirHoras($horasExpiradas)."</th>
      <th>".Uteis::exibirHoras($saldoHoras).$obs."</th>
      </tr>";
	
		$html3 .="<td ".$onclick.">".$img.$nome."</td>
		 <td>".$nomeProfessor."</td>
		 <td>".$valorProfessorNotaT."</td>";	  
	  $html3 .= "<td>".Uteis::exibirHoras($saldoHoras).$obs."</td>";	
	  if ($valorProfessorNotaT > 0) {
	  $saldoFinalC = $mediaHoras * ($saldoHoras / 60);
	  }
	  $html3 .= "<td>".Uteis::formatarMoeda($saldoFinalC)."</td>";
	    $totalGeral += $saldoHoras;
		$totalGeralBanco += $totalBanco;
		$totalGeralExpiradas += $horasExpiradas;
		$totalGeralReposicao += $totalReposicao;
		$TotalSaldoFinalC += $saldoFinalC;
	
		
	}elseif ($HorasS == 1 && $yx == 1) {
		$html3 .= "<tr><th>".$tt."</th>";
	$html .= "<tr><th ".$onclick.">".$img. $nome."</th>  
	  <th>".Uteis::exibirHoras($totalBanco)."</th>
	   <th>".Uteis::exibirHoras($totalReposicao)."</th>
	  <th>".Uteis::exibirHoras($horasExpiradas)."</th>
      <th>".Uteis::exibirHoras($saldoHoras).$obs."</th>
      </tr>";
	  
	  	$html3 .="<td ".$onclick.">".$img.$nome."</td>
		 <td>".$nomeProfessor."</td>
		 <td>".$valorProfessorNotaT."</td>";	  
	  $html3 .= "<td>".Uteis::exibirHoras($saldoHoras)."</td>";	
	  if ($valorProfessorNotaT > 0) {
	  $saldoFinalC = $mediaHoras * ($saldoHoras / 60);
	  }
	  $html3 .= "<td>".Uteis::formatarMoeda($saldoFinalC)."</td></tr>";
        $totalGeral += $saldoHoras;
		$totalGeralBanco += $totalBanco;
		$totalGeralExpiradas += $horasExpiradas;
		$totalGeralReposicao += $totalReposicao;
		$TotalSaldoFinalC += $saldoFinalC;
		} 
		
		
		if ($HorasS == 2) {
			if ($horasExpiradas > 0) {
		$html3 .= "<tr><th>".$tt."</th>";
		$html3 .="<td".$onclick.">".$img. $nome."</td>
		 <td>".$nomeProfessor."</td>
		 <td>".$valorProfessorNotaT."</td>";	
		 
	 $html3 .= "<td>".Uteis::exibirHoras($horasExpiradas)."</td>";
	 $totalGeral += $horasExpiradas;

	 $valorFinal = $mediaHoras * ($horasExpiradas/ 60);
	 
	 $TotalSaldoFinalC += $valorFinal;
	 
	 $html3 .= "<td>".Uteis::formatarMoeda($valorFinal)."</td></tr>";
	}
	
	 
		}
		
	}
	  $valorx2 = 0;
	  $xy = 0;
	  $yx = 0;
	  $tt++;
	  
	}
	
	if($totalHorasAc == 0){
         $obs1 = "";
    }else if($totalHorasAc > 0){
		 $obs1 = " a compensar";
	}else{
	//	$calcularHorasRestantes = 1;
		$totalHorasAc *= -1;
		$obs1 = " realizadas a mais";
	}
	
	if($saldoHorasSoma == 0){
         $obs1 = "";
    }else if($saldoHorasSoma > 0){
		 $obs5 = " a compensar";
	}else{
	//	$calcularHorasRestantes = 1;
		$saldoHorasSoma *= -1;
		$obs5 = " realizadas a mais";
	}
	
	if (($usarProfessor == 0) && ($HorasS == "-")){
	
	$html2 .= "<tr><th>Total</th><th></th>
	<th>".Uteis::exibirHoras($totalHorasAc).$obs1."</th>
	 <th>".Uteis::exibirHoras($totalGeralBanco)."</th>
	   <th>".Uteis::exibirHoras($totalGeralReposicao)."</th>
	  <th>".Uteis::exibirHoras($totalGeralExpiradas)."</th>
      <th>".Uteis::exibirHoras($saldoHorasSoma).$obs5."</th>
	  </tr>";
	} else {
		
	if (($HorasS	== 0) || ($HorasS == 2) || ($HorasS == 1)) {
	$html2 .= "<tr><th>Total</th>
	 <th></th>
	   <th></th>
	   <th></th>
	  <th>".Uteis::exibirHoras($totalGeral)."</th>
      <th>".Uteis::formatarMoeda($TotalSaldoFinalC)."</th>
	  </tr>";

	}
}

//Gerar Total com Debito e Credito
/*
if ($mes_ini <10) {
	$mes_ini = "0".$mes_ini;
}

$data_ini = date(" ".$ano_ini."-".$mes_ini."-01");

if ($mes_fim <10) {
	$mes_fim = "0".$mes_fim;
}

$data_fim = date(" ".$ano_fim."-".$mes_fim."-01");

 $html = " ";
 $valorx2 = 0;
 
 if ($data_fim < $data_ini) {
	 echo "Atenção dataFim é menor que data de inicio, não é possivel continuar";
 } else {
	 
 
 $tt=0;
 $saldoHorasSoma = 0;
 for ($y=0;$y<count($idGrupos);$y++) {
	 
	 $idGrupo = $idGrupos[$y];
 
$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);

for ($x=0;$x<count($ids);$x++) {
	$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
}

$ultimoId = $PlanoAcaoGrupo->getPAG_atual($idGrupo);

 //ValorHoraProfessor
 $valor = $AulaGrupoProfessor->selectAulaGrupoProfessor_periodo($ultimoId, $data_fim);

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

$valorx2 = implode(', ',$valorX);

unset($valorX);

$nome = $Grupo->Getnome($idGrupo);

//Montar Acumulado

$dataFimMesAnterior = date("Y-m-t", strtotime("-1 months", strtotime($data_ini)));
$dataInicioSistema = "2015-02-01";

if ($dataFimMesAnterior > $dataInicioSistema) {

	//Where Temporario para trazer os créditos e débitos para junto do quadro
	 $where = "WHERE  DFF.reposicao = 0 AND DFF.banco = 1 AND 
	 			PAG.idPlanoAcaoGrupo in (".$valorx2.")
				And FF.dataReferencia between '".$dataInicioSistema."' and '".$dataFimMesAnterior."'   
                 OR DFF.idDiaAulaFF in 
                 (SELECT 
            diaAulaFF_idDiaAulaFF
        FROM
            planoAcaoGrupo AS PAG
                INNER JOIN
            folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
                AND FF.finalizadaParcial = 1
                AND FF.finalizadaPrincipal = 1
				And FF.dataReferencia between '".$dataInicioSistema."' and '".$dataFimMesAnterior."'
                INNER JOIN
            diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                INNER JOIN
            bancoHoras AS BH ON BH.diaAulaFF_idDiaAulaFF = DFF.idDiaAulaFF
        WHERE
            PAG.grupo_idGrupo =".$idGrupo.") ";
 
 		$datafim = $dataFimMesAnterior;
		$dataini = $dataInicioSistema;
	
	//Total Ocorrências

	$bancoAC = $BancoHoras->selectBancoHorasTo($where, true, $opcao, $valorx2, $dataini, $datafim, 1);
	
     $totalBancoAc = $bancoAC['ocorrencia'];
	 $horasExpiradasAc = $bancoAC['expirada'];
	 $totalReposicaoAc = $bancoAC['reposicao'];
	 $saldoHorasAc = $bancoAC['saldo']; 

 		$saldoHorasSomaAc += $saldoHorasAc;
		
		$saldoHorasAcVisivel = $saldoHorasAc;
		$totalHorasAc += $saldoHorasAcVisivel;
		
	if($saldoHorasAc == 0){
         $obs3 = "";
    }else if($saldoHorasAc > 0){
		 $obs3 = " a compensar";
	}else{
		$saldoHorasAcVisivel *= -1;
		$obs3 = " realizadas a mais";
	}

} else {
	
//	echo "Não é possivel selecionar, primeira data é menor do que data inicial do sistema";
	
}
 
 // Fim Acumulado

	   
	//Where Temporario para trazer os créditos e débitos para junto do quadro
	 $where = "WHERE  DFF.reposicao = 0 AND DFF.banco = 1 AND 
	 			PAG.idPlanoAcaoGrupo in (".$valorx2.")
				And FF.dataReferencia between '".$data_ini."' and '".$data_fim."'   
                 OR DFF.idDiaAulaFF in 
                 (SELECT 
            diaAulaFF_idDiaAulaFF
        FROM
            planoAcaoGrupo AS PAG
                INNER JOIN
            folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
                AND FF.finalizadaParcial = 1
                AND FF.finalizadaPrincipal = 1
				And FF.dataReferencia between '".$data_ini."' and '".$data_fim."'
                INNER JOIN
            diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                INNER JOIN
            bancoHoras AS BH ON BH.diaAulaFF_idDiaAulaFF = DFF.idDiaAulaFF
        WHERE
            PAG.grupo_idGrupo =".$idGrupo.") ";
		
		$datafim = $data_fim;
		$dataini = $data_ini;
	
	//Total Ocorrências
	 $banco = $BancoHoras->selectBancoHorasTo($where, true, $opcao, $valorx2, $dataini, $datafim, 1);

     $totalBanco = $banco['ocorrencia'];
	 $horasExpiradas = $banco['expirada'];
	 $totalReposicao = $banco['reposicao'];
	 $saldoHoras = $banco['saldo']; 
	 
     $saldoHoras = $saldoHorasAc + $totalBanco - $totalReposicao - $horasExpiradas;
	 $saldoHorasSoma += $saldoHoras;
	
	if($saldoHoras == 0){
         $obs = "";
    }else if($saldoHoras > 0){
		 $obs = " a compensar";
		 $xy = 1;
	}else{
		$yx = 1;
		
		$saldoHoras *= -1;
		$obs = " realizadas a mais";
	}
	$img = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"Acessar cadastro do grupo\" />";
	 $onclick = " title=\"Ver grupo\" onclick=\"abrirNivelPagina(this, '$caminhoAbrir?id=$ultimoId', '$caminhoAtualizar?tr=1&idPlanoAcaoGrupo=$ultimoId', 'tr')\" ";
	$html .= "<tr><th>".$tt."</th>";
	if ($HorasS == "-") {
	$html .= "<th ".$onclick.">".$img. $nome."</th>  
	<th>".Uteis::exibirHoras($saldoHorasAcVisivel).$obs3."</th>
	  <th>".Uteis::exibirHoras($totalBanco)."</th>
	   <th>".Uteis::exibirHoras($totalReposicao)."</th>
	  <th>".Uteis::exibirHoras($horasExpiradas)."</th>
      <th>".Uteis::exibirHoras($saldoHoras).$obs."</th>
      </tr>";
	    $totalGeral += $saldoHoras;
		$totalGeralBanco += $totalBanco;
		$totalGeralExpiradas += $horasExpiradas;
		$totalGeralReposicao += $totalReposicao;
	} else {
		if (($HorasS == 0)  && $xy == 1) {
			$saldoFinalC = 0;
				$html3 .= "<tr><th>".$tt."</th>";

	$html .= "<tr><th ".$onclick.">".$img. $nome."</th>  
	  <th>".Uteis::exibirHoras($totalBanco)."</th>
	   <th>".Uteis::exibirHoras($totalReposicao)."</th>
	  <th>".Uteis::exibirHoras($horasExpiradas)."</th>
      <th>".Uteis::exibirHoras($saldoHoras).$obs."</th>
      </tr>";
	
		$html3 .="<td ".$onclick.">".$img.$nome."</td>
		 <td>".$nomeProfessor."</td>
		 <td>".$valorProfessorNotaT."</td>";	  
	  $html3 .= "<td>".Uteis::exibirHoras($saldoHoras)."</td>";	
	  if ($valorProfessorNotaT > 0) {
	  $saldoFinalC = $mediaHoras * ($saldoHoras / 60);
	  }
	  $html3 .= "<td>".Uteis::formatarMoeda($saldoFinalC)."</td>";
	    $totalGeral += $saldoHoras;
		$totalGeralBanco += $totalBanco;
		$totalGeralExpiradas += $horasExpiradas;
		$totalGeralReposicao += $totalReposicao;
		$TotalSaldoFinalC += $saldoFinalC;
	
		
	}elseif ($HorasS == 1 && $yx == 1) {
		$html3 .= "<tr><th>".$tt."</th>";
	$html .= "<tr><th ".$onclick.">".$img. $nome."</th>  
	  <th>".Uteis::exibirHoras($totalBanco)."</th>
	   <th>".Uteis::exibirHoras($totalReposicao)."</th>
	  <th>".Uteis::exibirHoras($horasExpiradas)."</th>
      <th>".Uteis::exibirHoras($saldoHoras).$obs."</th>
      </tr>";
	  
	  	$html3 .="<td ".$onclick.">".$img.$nome."</td>
		 <td>".$nomeProfessor."</td>
		 <td>".$valorProfessorNotaT."</td>";	  
	  $html3 .= "<td>".Uteis::exibirHoras($saldoHoras)."</td>";	
	  if ($valorProfessorNotaT > 0) {
	  $saldoFinalC = $mediaHoras * ($saldoHoras / 60);
	  }
	  $html3 .= "<td>".Uteis::formatarMoeda($saldoFinalC)."</td></tr>";
        $totalGeral += $saldoHoras;
		$totalGeralBanco += $totalBanco;
		$totalGeralExpiradas += $horasExpiradas;
		$totalGeralReposicao += $totalReposicao;
		$TotalSaldoFinalC += $saldoFinalC;
		} 
		
		if ($HorasS == 2) {
			if ($horasExpiradas > 0) {
		$html3 .= "<tr><th>".$tt."</th>";
		$html3 .="<td".$onclick.">".$img. $nome."</td>
		 <td>".$nomeProfessor."</td>
		 <td>".$valorProfessorNotaT."</td>";	
		 
	 $html3 .= "<td>".Uteis::exibirHoras($horasExpiradas)."</td>";
	 $totalGeral += $horasExpiradas;
	 	 
	 $valorFinal = $mediaHoras * ($horasExpiradas/ 60);
	 
	 $TotalSaldoFinalC += $valorFinal;
	 
	 $html3 .= "<td>".Uteis::formatarMoeda($valorFinal)."</td></tr>";
	}
	
	 
		}
		
	}
	  $valorx2 = 0;
	  $xy = 0;
	  $yx = 0;
	  $tt++;
	  
	}
	
	if($totalHorasAc == 0){
         $obs1 = "";
    }else if($totalHorasAc > 0){
		 $obs1 = " a compensar";
	}else{
	//	$calcularHorasRestantes = 1;
		$totalHorasAc *= -1;
		$obs1 = " realizadas a mais";
	}
	
	if($saldoHorasSoma == 0){
         $obs1 = "";
    }else if($saldoHorasSoma > 0){
		 $obs5 = " a compensar";
	}else{
	//	$calcularHorasRestantes = 1;
		$saldoHorasSoma *= -1;
		$obs5 = " realizadas a mais";
	}
	
	if (($usarProfessor == 0) && ($HorasS == "-")){
	
	$html2 .= "<tr><th>Total</th><th></th>
	<th>".Uteis::exibirHoras($totalHorasAc).$obs1."</th>
	 <th>".Uteis::exibirHoras($totalGeralBanco)."</th>
	   <th>".Uteis::exibirHoras($totalGeralReposicao)."</th>
	  <th>".Uteis::exibirHoras($totalGeralExpiradas)."</th>
      <th>".Uteis::exibirHoras($saldoHorasSoma).$obs5."</th>
	  </tr>";
	} else {
		
	if (($HorasS	== 0) || ($HorasS == 2) || ($HorasS == 1)) {
	$html2 .= "<tr><th>Total</th>
	 <th></th>
	   <th></th>
	   <th></th>
	  <th>".Uteis::exibirHoras($totalGeral)."</th>
      <th>".Uteis::formatarMoeda($TotalSaldoFinalC)."</th>
	  </tr>";
		}
	}
?>
<div class="esquerda">
    <button class="button gray" onclick="postForm('form_rel_banco', '<?php echo CAMINHO_RELAT."banco/include/acao/banco.php"?>')"> Exportar relatório</button>
</div>
<div class="linha-inteira">

<?php

if (($HorasS == "-") && ($usarProfessor == 0)) {
	
	?>
<fieldset>
<legend>Consolidado Banco de Horas</legend>

<div>
    <table id="tb_lista_bancoHoras" class="registros">
      <thead>
        <tr> 
        <th>Ordem</th>
          <th <?php echo $onclick?> title="Ver Grupo">Grupo</th>
          <th>Valor Acumulado</th>
          <th>Horas não realizada</th>
          <th>Horas repostas</th>
          <th>Horas expiradas</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
    <?php echo $html; ?>
	
       </tbody>
       <tfoot>
       <?php echo $html2; ?>
       </tfoot>
    </table>
  </div>
</fieldset>
</div>

<?php 

} else {
// Horas Expiradas com Valor Hora Professor
?>
<fieldset>
<?php  if ($HorasS == 2) {  ?>
<legend>Horas Expiradas com Valor Professor</legend>
<?php } elseif ($HorasS == 1) { ?>
<legend>Horas A mais com Valor Professor</legend>
<?php } else {?>
<legend>Horas A compensar com Valor Professor</legend>
<?php } ?>

<div>
    <table id="tb_lista_bancoHoras" class="registros">
      <thead>
        <tr> 
        <th>Ordem</th>
          <th <?php echo $onclick?> title="Ver Grupo">Grupo</th>
          <th>Nome Professor</th>
          <th>Valor Hora Professor</th>

<?php  if ($HorasS == 2) {  ?>
          <th>Horas expiradas</th>
 <?php } elseif ($HorasS == 0)  { ?>
		  <th>Horas a Compensar</th>
<?php } else {?> 
<th>Horas a Mais</th>
<?php } ?>        
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
    <?php echo $html3; ?>
	
       </tbody>
       <tfoot>
       <?php echo $html2; ?>
       </tfoot>
    </table>
  </div>
</fieldset>
</div>	
	
<?php 	
}

} 
*/

?>
<script> 
tabelaDataTable('tb_lista_bancoHoras' );
tabelaDataTable('tb_lista_Reposicao');
</script> 