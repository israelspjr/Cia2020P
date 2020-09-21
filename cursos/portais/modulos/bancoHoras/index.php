<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

//$Relatorio = new Relatorio();
$BancoHoras = new BancoHoras();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$DiaAulaFF = new DiaAulaFF();
$Grupo = new Grupo();
$gerentePorEmpresa = new GerenteTem();

//$where = " WHERE PAG.inativo = 0 ";

$where = " WHERE PAG.inativo = 0 AND (G.naoBancoHoras = 0 or G.naoBancoHoras is null) AND G.inativo = 0";

$caminhoAbrir = "modulos/grupo/abas.php";
$caminhoAtualizar = "modulos/bancoHoras/index.php";

$IdClientePj = $_SESSION['idClientePj_SS'];
//if($IdClientePj != "-"){
if($IdClientePj!= "") $where .= " AND CL.idClientePj = ".$IdClientePj; 
//}

	$valorIdEmpresas = $gerentePorEmpresa->selectGerenteTemBH($where);
	
	
	for ($x=0;$x<count($valorIdEmpresas);$x++) {
		$valorIdGrupos[] = $valorIdEmpresas[$x]['idGrupo'];
		
	}
	
	$idGrupos = $valorIdGrupos;
	

if(isset($_REQUEST["tr"])){
    
	$arrayRetorno = array();
	
	$idPlanoAcaoGrupo = $_REQUEST["idPlanoAcaoGrupo"];
	$ordem = $_REQUEST["ordem"];
	
	echo json_encode($arrayRetorno);
	exit;		
}

//Gerar Total com Debito e Credito
 
 for ($y=0;$y<count($idGrupos);$y++) {
	 
	 $idGrupo = $idGrupos[$y];
 
$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);

for ($x=0;$x<count($ids);$x++) {
	$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
	
}

$ultimoId = $PlanoAcaoGrupo->getPAG_atual($idGrupo);


$valorx2 = implode(', ',$valorX);

unset($valorX);

//Uteis::pr($valorx2);



$nome = $Grupo->Getnome($idGrupo);
	   
	//Where Temporario para trazer os créditos e débitos para junto do quadro
	 $where = "WHERE  DFF.reposicao = 0 AND DFF.banco = 1 AND 
	 			PAG.idPlanoAcaoGrupo in (".$valorx2.")";
			/*	And FF.dataReferencia between '".$data_ini."' and '".$data_fim."'   */
     $where .= "            OR DFF.idDiaAulaFF in 
                 (SELECT 
            diaAulaFF_idDiaAulaFF
        FROM
            planoAcaoGrupo AS PAG
                INNER JOIN
            folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
                AND FF.finalizadaParcial = 1
                AND FF.finalizadaPrincipal = 1";
		/*	And FF.dataReferencia between '".$data_ini."' and '".$data_fim."'*/
        $where .=	"        INNER JOIN
            diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                INNER JOIN
            bancoHoras AS BH ON BH.diaAulaFF_idDiaAulaFF = DFF.idDiaAulaFF
        WHERE
            PAG.grupo_idGrupo =".$idGrupo.") ";
			
//			echo $where;
		
		$datafim = date('y-m-d');
		$dataini = "2015-02-01";//$data_ini;
	
	//Total Ocorrências
//	 $opcao = "totalOcorrencia";
	 $banco = $BancoHoras->selectBancoHorasTo($where, true, $opcao, $valorx2, $dataini, $datafim,1);
	 
	 $totalBanco = $banco['ocorrencia'];
	 $horasExpiradas = $banco['expirada'];
	 $totalReposicao = $banco['reposicao'];
	 $saldoHoras = $banco['saldo']; 
	 	 
	 	$saldoHoras = $totalBanco - $totalReposicao - $horasExpiradas;
		
		$totalGeral += $saldoHoras;
		$totalGeralBanco += $totalBanco;
		$totalGeralExpiradas += $horasExpiradas;
		$totalGeralReposicao += $totalReposicao;
	
	if($saldoHoras == 0){
         $obs = "";
    }else if($saldoHoras > 0){
		 $obs = " a compensar";
	}else{
//		$calcularHorasRestantes = 1;
		$saldoHoras *= -1;
		$obs = " realizadas a mais";
	}
	$idPlanoAcao = $PlanoAcaoGrupo->getIdPlanoAcao($ultimoId);
	 $onclick = " title=\"Ver grupo\" onclick=\"zerarCentro();carregarModulo( '$caminhoAbrir?id=$ultimoId&idPlanoAcao=$idPlanoAcao', '#centro')\" ";
	
	
	$html .= "<tr><th".$onclick.">". $nome."</th>  
	  <th>".Uteis::exibirHoras($totalBanco)."</th>
	   <th>".Uteis::exibirHoras($totalReposicao)."</th>
	  <th>".Uteis::exibirHoras($horasExpiradas)."</th>
      <th>".Uteis::exibirHoras($saldoHoras).$obs."</th>
      </tr>";
	  
	  $valorx2 = 0;
	}
 
	
	if($totalGeral == 0){
         $obs1 = "";
    }else if($totalGeral > 0){
		 $obs1 = " a compensar";
	}else{
	//	$calcularHorasRestantes = 1;
		$totalGeral *= -1;
		$obs1 = " realizadas a mais";
	}

?>

<!--<div class="linha-inteira">-->

<fieldset>
<legend>Consolidado Banco de Horas</legend>

<div>
    <table id="tb_lista_bancoHoras" class="registros">
      <thead>
        <tr> 
          <th <?php echo $onclick?> title="Ver Grupo">Grupo</th>
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
    <?php echo "<tr><th>Total</th>
	 <th>".Uteis::exibirHoras($totalGeralBanco)."</th>
	   <th>".Uteis::exibirHoras($totalGeralReposicao)."</th>
	  <th>".Uteis::exibirHoras($totalGeralExpiradas)."</th>
      <th>".Uteis::exibirHoras($totalGeral).$obs1."</th>
	  </tr>"; ?>
      </tfoot>
    </table>
  </div>
</fieldset>
<!--</div>-->

<?php //} ?>
<script> 
//tabelaDataTable('tb_lista_bancoHoras', 'simples');
//tabelaDataTable('tb_lista_Reposicao', 'simples');
</script> 