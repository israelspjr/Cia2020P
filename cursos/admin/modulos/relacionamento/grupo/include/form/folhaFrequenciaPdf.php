<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."mpdf60/mpdf.php");


$FolhaFrequencia = new FolhaFrequencia();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$DemonstrativoCobranca = new DemonstrativoCobranca();
$DemonstrativoCobrancaDias = new DemonstrativoCobrancaDias();
$AulaDataFixa = new AulaDataFixa();
$Professor = new Professor();
$DiaAulaFF = new DiaAulaFF();
$OcorrenciaFF = new OcorrenciaFF();
$ContestacaoFF = new ContestacaoFF();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$PlanoAcao = new PlanoAcao();
$AcompanhamentoMaterial = new AcompanhamentoMaterial();
$AcompanhamentoCurso = new AcompanhamentoCurso();
$PeriodoAcompanhamento = new PeriodoAcompanhamentoCurso();
$RelatorioDesempenho = new RelatorioDesempenho();
$IntegranteGrupo = new IntegranteGrupo();
$KitMaterial = new KitMaterial();
$Montado = new MaterialMontadoPlanoAcao();
$MaterialPlano = new MaterialDidaticPlanoAcao();

//INSERÇÃO/CARREGAMENTO DA FF
$idFolhaFrequencia = $_REQUEST['id'];


$totalHorasAulas = 0;

if($idFolhaFrequencia){
	
	$valorFolhaFrequencia = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = $idFolhaFrequencia");


}else{
	
	$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
	$idProfessor = $_REQUEST['idProfessor'];	
	$dataReferencia = $_REQUEST['dataReferencia'];
	$data = explode("/",$dataReferencia);
	$mesRef = $data[0];
	$anoRef = $data[1];	
		
	$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND professor_idProfessor = $idProfessor AND dataReferencia = '$anoRef-$mesRef-01'";
	$valorFolhaFrequencia = $FolhaFrequencia->selectFolhaFrequencia($where);

	if(!$valorFolhaFrequencia){	
			
		$FolhaFrequencia->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);	
		$FolhaFrequencia->setProfessorIdProfessor($idProfessor);	
		$FolhaFrequencia->setDataReferencia($anoRef."-".$mesRef."-01");
		$idFolhaFrequencia = $FolhaFrequencia->addFolhaFrequencia();		
		$valorFolhaFrequencia = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = $idFolhaFrequencia ");
	}
}

$idFolhaFrequencia = $valorFolhaFrequencia[0]['idFolhaFrequencia'];
$idPlanoAcaoGrupo = $valorFolhaFrequencia[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
$idProfessor = $valorFolhaFrequencia[0]['professor_idProfessor'];
$finalizar = $valorFolhaFrequencia[0]['finalizadaParcial'];
$finalizarPri = $valorFolhaFrequencia[0]['finalizadaPrincipal'];
$obs = $valorFolhaFrequencia[0]['obs'];
$dataReferencia = $valorFolhaFrequencia[0]['dataReferencia'];
	$data = explode("-",$dataReferencia);
	$mesRef = $data[1];
	$anoRef = $data[0];	
//=================================================================================================================================================

//DIAS TOTAIS NO MES
$diasNoMes = Uteis::totalDiasMes($mesRef, $anoRef);


//CONTESTAÇÃO
$contest = $ContestacaoFF->getContestacoes($idFolhaFrequencia);


$rsIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupoFF($idPlanoAcaoGrupo, $dataReferencia);

$cont = 1;
foreach($rsIntegranteGrupo as $valIntegranteGrupo):
if($cont > 1):
$Integrantes .= ",".$valIntegranteGrupo['idIntegranteGrupo'];
else:
$Integrantes = $valIntegranteGrupo['idIntegranteGrupo'];
endif;
$cont++;
endforeach;

if($anoRef > 2014):
$periodo = $PeriodoAcompanhamento->selectPeriodoAcompanhamentoCurso("WHERE mes = $mesRef AND ano = $anoRef");
$acomp = $AcompanhamentoCurso->selectAcompanhamentoCurso(" WHERE professor_idProfessor = $idProfessor AND periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso = ".$periodo[0]['idPeriodoAcompanhamentoCurso']);
if( $acomp[0]['idAcompanhamentoCurso'] ):
$rel = $RelatorioDesempenho->selectRelatorioDesempenho("WHERE acompanhamentoCurso_idAcompanhamentoCurso = ". $acomp[0]['idAcompanhamentoCurso']." AND integranteGrupo_idIntegranteGrupo in(".$Integrantes.")");
$r1 = count($rel);
$r2 = 2 * count($rsIntegranteGrupo);
if($r1 == $r2):
$AF = true;
else: 
$AF = false;
endif;
else:
$AF = false; 
endif;  
$mat =  $AcompanhamentoMaterial->selectAcompanhamentoMaterial("WHERE folhaFrequencia_idFolhaFrequencia = ".$idFolhaFrequencia);

if($mat[0]['idAcompanhamentoMaterial']){
$AM = true;    
}else{
$AM = false;    
}
endif;




$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND mes = $mesRef AND ano = $anoRef ";

$rsDemonstrativo = $DemonstrativoCobranca->selectDemonstrativoCobranca($where);

$rsDiasCobrados = $DemonstrativoCobrancaDias->selectDemonstrativoCobrancaDias("WHERE demonstrativoCobranca_idDemonstrativoCobranca = ".$rsDemonstrativo[0]['idDemonstrativoCobranca']);


foreach($rsDiasCobrados as $valor){
    $horasCobradas += $valor['horas'];
}

if($horasCobradas < 365){
    $ccas = 1;
}elseif($horasCobradas < 725){
    $ccas = 2;
 }else{
    $ccas = 3;  
 } 
$html2 .= "<div style='width:100%'><img style='width:100%;' src=".CAMINHO_IMG2."_cabecalho.png></div>";

$html2 .= "<fieldset>
  <legend>Folha de frequência</legend>
  <div class=\"menu_interno\">
  
   </div> 
  <div class=\"lista\">
  <p>Grupo: <strong>".$PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo)."</strong></p>
  <p>Professor: <strong>".$Professor->getNome($idProfessor)."</strong></p>
  <p>Período: <strong>".$mesRef."/".$anoRef."</strong></p>
  <p>Horas Cobradas: <strong>".Uteis::exibirHoras($horasCobradas)."</strong></p>
  <p style=\"color:#bb0000;\">CCAs permitidos: <strong>".$ccas."</strong></p>";        

  foreach($rsIntegranteGrupo as $valorIntegranteGrupo){
  $html2 .="   <p> 
     <strong>Aluno: </strong>". $IntegranteGrupo->getNomePF($valorIntegranteGrupo['idIntegranteGrupo'], true)."<br />
     <strong>Telefone:</strong>".$IntegranteGrupo->getTelefone($valorIntegranteGrupo['idIntegranteGrupo'])."<br />
     <strong>Email:</strong>". $IntegranteGrupo->getEmail($valorIntegranteGrupo['idIntegranteGrupo'])."<br /> 
     </p>  ";
    }

  $html2 .= " </div> <p>&nbsp;</p><div>
    <table width=\"100%\" id=\"tb_lista_FolhaFrequencia_form\" class=\"registros\" border=\"2\">
      <thead>
        <tr>
          <th>Data</th>
          <th>Dia da semana</th>
          <th>Período</th>
          <th>Horas de aula</th>
          <th>Horas dadas</th>
        </tr>
      </thead><tbody>
      ";
	
	  $rsFF = $FolhaFrequencia->selectFF_diasHoras($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor);
      //  Uteis::pr($rsFF);
       	$rsFF_pf = array_merge($rsFF['permanente'], $rsFF['fixa']);	
		
		$rsFF_pf2 = array_merge($rsFF['permanente'], $rsFF['fixa']);	
		
		$diasArray = array();
		foreach($rsFF_pf2 as $valorFF2) {
		$dataAtual = $valorFF2["dataAtual"];
		$d2 = date('d', strtotime($dataAtual));

		$diasArray[] = $d2;
			
		}
        	$y =0;
//        Uteis::pr($rsFF_pf);
        foreach($rsFF_pf as $valorFF){
			
			
        	//foreach($rsFF['permanente'] as $valorPermanente){ 
            
						//INF GERAIS       			
      		$dataAtual = $valorFF["dataAtual"];
            $diaDaSemanaAtual = $valorFF["diaSemana"];            
            $horaInicio = $valorFF["horaInicio"];
            $horaFim = $valorFF["horaFim"];
            $horasTotal = $valorFF["horasTotal"];
			$totalHorasAulas += $horasTotal;
            
            $d = date('d', strtotime($dataAtual));
			
    		
			
			$d1 = $d;
                        
						$idAulaPermanenteGrupo = "";
						$idAulaDataFixa = "";
						
						if( $valorFF["origem"] == "permanente" ){       				
       				$idAulaPermanenteGrupo = $valorFF["id"];
							$nomeCampo = "aulaPermanenteGrupo_".$idAulaPermanenteGrupo."_".$d;
							$addWhere = " AND aulaPermanenteGrupo_idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo;
						}elseif( $valorFF["origem"] == "fixa" ) {
							$idAulaDataFixa = $valorFF["id"];
							$nomeCampo = "aulaDataFixa_".$idAulaDataFixa."_".$d;
							$addWhere = " AND aulaDataFixa_idAulaDataFixa = ".$idAulaDataFixa;
						}
												
						//INF ESPECIFICAS DO DIA
						$where = " WHERE folhaFrequencia_idFolhaFrequencia = ".$idFolhaFrequencia." AND dataAula = '".$dataAtual."' ".$addWhere;						
						$valorDiaAulaFF = $DiaAulaFF->selectDiaAulaFF($where);
                
						$idDiaAulaFF = $valorDiaAulaFF[0]['idDiaAulaFF'];
						$idOcorrenciaFF = $valorDiaAulaFF[0]['ocorrenciaFF_idOcorrenciaFF'];						
						$horasDadas = $valorDiaAulaFF[0]['horaRealizada'];
						$total_horasDadas += $horasDadas;
						$aulaInexistente = $valorDiaAulaFF[0]['aulaInexistente'];
						
						if( !$aulaInexistente ) $cont_dias[] = $d;
						
				 
     $html2 .="<!--DIA--><tr "; 
	 if($aulaInexistente) { 
	 	$html2 .= "style=\"text-align:center;background-color: rgba(214, 112, 112, 0.5)\""; 
		} else {
		$html2 .= "style=\"text-align:center;\""; 
		};
	 $html2 .= ">	 
	 		   <td >".$d."</td>
              
              <!--DIA DA SEMANA-->
              <td >".Uteis::exibirDiaSemana($diaDaSemanaAtual)."</td>
              
              <!--HORARIO DA AULA -->
              <td >das ".Uteis::exibirHoras($horaInicio)." às ".Uteis::exibirHoras($horaFim)."</td>
              
              <!--PERIODO DA AULA-->		
			   <td >".Uteis::exibirHoras($horasTotal)."</td>
			   
			   <td >".Uteis::exibirHoras($horasDadas);
			   
			   		if($idOcorrenciaFF){
						$ocor = $OcorrenciaFF->selectOcorrenciaFF(" WHERE idOcorrenciaFF = ".$idOcorrenciaFF);
	 $html2 .= " <font color=\"#FF0000\">".$ocor[0]['sigla']."</font>";
									}
	 $html2 .="</td></tr>";			

			$y++;
			$dA = $diasArray[$y];

		  foreach($rsFF['reposicao'] as $valorReposicao){	
            
            $idDiaAulaFF = $valorReposicao["id"];						
            $dataAtual = $valorReposicao["dataAtual"];
            $diaDaSemanaAtual = $valorReposicao["diaSemana"];
			$d = date('d',strtotime($dataAtual));

           if (($d < $dA) && ($d >= $d1)) {
            $horaInicio = $valorReposicao["horaInicio"];
            $horaFim = $valorReposicao["horaFim"];
            $horasTotal = $valorReposicao["horasTotal"];
            $total_horasDadas += $horasTotal;
            
            $cont_dias[] = $d;
						
            $rsidDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE idDiaAulaFF = ".$idDiaAulaFF);
            $obs_dia = $rsidDiaAulaFF[0]['obs'];
                        
            if(!$finalizar){	
                $onclick = " onclick=\"abrirNivelPagina(this, '".CAMINHO_REL."grupo/include/form/diaAulaFF.php?id=".$idDiaAulaFF."&idFolhaFrequencia=".$idFolhaFrequencia."', '".CAMINHO_REL."grupo/include/form/folhaFrequencia.php?idFolhaFrequencia=".$idFolhaFrequencia."', '#div_ff_geral')\" ";
            }
                            
            
            
           $html2 .=" <tr align=\"center\" style=\"background-color: rgba(158, 214, 112, 0.5)\"> 
              
              <!--DIA-->
              <td >".$d."</td>
              
              <!--DIA DA SEMANA-->
              <td >".Uteis::exibirDiaSemana($diaDaSemanaAtual)."</td>
              
              <!--HORARIO DA AULA -->
              <td>Reposição</td>
              
              <!--PERIODO DA AULA-->
              <td></td>
              
              <!--HORAS DADAS / OCORRENCIA-->
              <td>".Uteis::exibirHoras($horasTotal)."</td>
            </tr>";
			}
			  }
			}
        
	     
 $html2 .="   </tbody>
	<tfoot>
        <tr style=\"text-align:center;\">
		<th >Total </th>
          <th >". count(array_unique($cont_dias))." dia(s)</th>          
          <th >Período</th>
          <th >". Uteis::exibirHoras($totalHorasAulas)."</th>
          <th >". Uteis::exibirHoras($total_horasDadas)."</th>
		  
        </tr>
    </tfoot>      
    </table></div>";
  
$html2 .= "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
 <div class=\"linha-inteira\">
  <fieldset>
  <legend>Plano de Curso - Controle</legend>
  <p>&nbsp;</p>
  <table id=\"tb_lista_acompanhamentoMaterial\" class=\"registros\" width=\"100%\">
  <thead>
    <tr>
       <th text-align=\"center\">Livro</th>
       <th text-align=\"center\">Unidade Inicial</th>
       <th text-align=\"center\">Unidade Final</th>
       <th text-align=\"center\">Unidade Atual</th>
       <th text-align=\"center\">Obs</th>     
    </tr>
  </thead>
  <tbody>";
    
//    if($anoRef > 2014):
        
    $abrir = CAMINHO_REL."grupo/include/form/acompanhamentoMaterial.php";
    $atualizar = CAMINHO_REL."grupo/include/form/folhaFrequencia.php";
    $kit = $KitMaterial->AcompanhamentoPorKit($idPlanoAcaoGrupo, $idFolhaFrequencia, $abrir, $atualizar);
    $mont = $Montado->AcompanhamentoMaterialMontado($idPlanoAcaoGrupo, $idFolhaFrequencia, $abrir, $atualizar);
    $plan = $MaterialPlano->AcompanhamentoMaterialPlano($idPlanoAcaoGrupo, $idFolhaFrequencia, $abrir, $atualizar);
    
    if($kit!="")
        $html2 .= $kit;
    elseif($mont!="")
        $html2 .= $mont;
    elseif($plan!="")
        $html2 .= $plan;
    
 //   endif;
    
 $html2 .=" </tbody>
  <tfoot>
    <tr>
       <th>Livro</th>
       <th>Unidade Inicial</th>
       <th>Unidade Final</th>
       <th>Unidade Atual</th>
       <th>Obs</th>
    </tr>
  </tfoot>
</table>
</fieldset>
  </div>";



$html2 .= "<div style='width:100%'><img style='width:100%;' src=".CAMINHO_IMG2."_rodape.png></div>";


//echo $html2;

	$mpdf=new mPDF(); 
	$mpdf->SetDisplayMode('fullpage');
//	$css = file_get_contents("css/estilo.css");
//	$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($html2);
	$mpdf->Output();
/*
	exit;
*/
?>

