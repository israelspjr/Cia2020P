<?php
error_reporting(0);
 require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	

	
$BancoHoras = new BancoHoras();	
$DiaAulaFF = new DiaAulaFF();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$FolhaFrequencia = new FolhaFrequencia();

$arrayRetorno = array();

$idPlanoAcaoGrupo = $_GET['id'];

$pag = $PlanoAcaoGrupo->selectPlanoAcaoGrupo("WHERE idPlanoAcaoGrupo = $idPlanoAcaoGrupo");
$idGrupo = $pag[0]['grupo_idGrupo'];

//echo $grupo."- ";

//Gerar Total com Debito e Credito
$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);

for ($x=0;$x<count($ids);$x++) {
	$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
}

$valorx2 = implode(', ',$valorX);

$valorFolha = $FolhaFrequencia->selectFolhaFrequencia(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND finalizadaPrincipal = 1 order by dataReferencia DESC");

$dataReferenciaF = $valorFolha[0]['dataReferencia'];

//Where Temporario para trazer os créditos e débitos para junto do quadro
	 $where = "WHERE  DFF.reposicao = 0 AND DFF.banco = 1 AND PAG.idPlanoAcaoGrupo in (".$valorx2.") 
                 OR DFF.idDiaAulaFF in 
                 (SELECT 
            diaAulaFF_idDiaAulaFF
        FROM
            planoAcaoGrupo AS PAG
                INNER JOIN
            folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
                AND FF.finalizadaParcial = 1
                AND FF.finalizadaPrincipal = 1
                INNER JOIN
            diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                INNER JOIN
            bancoHoras AS BH ON BH.diaAulaFF_idDiaAulaFF = DFF.idDiaAulaFF
        WHERE
            PAG.grupo_idGrupo =".$idGrupo.")";

	//Total Ocorrências
	 $opcao = "totalOcorrencia";
	 $totalBanco = $BancoHoras->selectBancoHorasTo($where, true, $opcao, $valorx2);
	 
	 $opcao = "expirada";
     $horasExpiradas = $BancoHoras->selectBancoHorasTo($where, true, $opcao, $valorx2);
	
	 $opcao = "restantes";
     $horasRestantes = $BancoHoras->selectBancoHorasTo($where, true, $opcao, $valorx2);
	 
//	 var_dump ($horasRestantes);
	 
	 $opcao = "reposicao";
	 $totalReposicao = $BancoHoras->selectBancoHorasTo($where, true, $opcao, $valorx2);
 	
	 
//	 echo $totalBanco;*/

	$saldoHoras = $totalBanco - $totalReposicao - $horasExpiradas;
	
	if($saldoHoras == 0){
         $obs = "";
    }else if($saldoHoras > 0){
		 $obs = " a compensar";
	}else{
		$calcularHorasRestantes = 1;
		$saldoHoras *= -1;
		$obs = " realizadas a mais";
	}
	 
			
	
	$html2 = "
	<tr><td>Mês de referência:</td> <td>". date('m/Y', strtotime($dataReferenciaF)) ."</td></tr>
	<tr><td>Total de horas não realizadas:</td> <td><strong>". Uteis::exibirHoras($totalBanco)."</strong></td></tr>
	<tr><td>Total de horas repostas:</td> <td><strong>".Uteis::exibirHoras($totalReposicao)."</strong></td></tr>	
	<tr><td>Total de horas expiradas: </td><td><strong>". Uteis::exibirHoras($horasExpiradas)."</strong></td></tr>	
	<tr><td>Saldo final de horas: </td><td><strong>". Uteis::exibirHoras($saldoHoras).$obs."</strong></td></tr>
	<tr>&nbsp;</tr>";
	
	 $colunas = array("Item  ", "Descrição ");
	 
	 $html_base2 = Relatorio::montaTb($colunas, 1,"",1);
	 
	 $html .= $html_base2 .$html2;
	 
	 $html .=  $BancoHoras->selectBancoHorasRead($where, false,"","",1);
	 
//  
  
//  $html =  $html_base . $html;


	$arrayRetorno['excel'] = $html;

echo json_encode($arrayRetorno);