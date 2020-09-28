<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$FolhaFrequencia = new FolhaFrequencia();
$DemonstrativoCobranca = new DemonstrativoCobranca();
$DemonstrativoCobrancaDias = new DemonstrativoCobrancaDias();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$AulaDataFixa = new AulaDataFixa();
$Professor = new Professor();
$DiaAulaFF = new DiaAulaFF();
$OcorrenciaFF = new OcorrenciaFF();
$ContestacaoFF = new ContestacaoFF();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$PlanoAcao = new PlanoAcao();
$AcompanhamentoMaterial = new AcompanhamentoMaterial();
$AcompanhamentoCurso = new AcompanhamentoCurso();
$Relatorio = new Relatorio();

$AcompanhamentoCurso = new AcompanhamentoCurso();
$PeriodoAcompanhamento = new PeriodoAcompanhamentoCurso();
$RelatorioDesempenho = new RelatorioDesempenho();
$IntegranteGrupo = new IntegranteGrupo();
$CalendarioProva = new CalendarioProva();
$Prova = new Prova();
$AulaGrupoProfessor = new AulaGrupoProfessor();
$FechamentoGrupo = new FechamentoGrupo();

//INSERÇÃO/CARREGAMENTO DA FF
$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];
$Ndados = $_REQUEST['Ndados'];

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
//echo $finalizar;
$finalizarPri = $valorFolhaFrequencia[0]['finalizadaPrincipal'];
$obsFF = $valorFolhaFrequencia[0]['obs'];	
$dataReferencia = $valorFolhaFrequencia[0]['dataReferencia'];
	$data = explode("-",$dataReferencia);
	$mesRef = $data[1];
	$anoRef = $data[0];	

$naoAtualizarMais = $_REQUEST['naoAtualizarMais'];	
$dataFechamento = $FechamentoGrupo->getDataFechamento($idPlanoAcaoGrupo);
//Uteis::pr($dataFechamento);
//if ($dataFechamentoTmp) {
//	$dataFechamento = 
//}
//=================================================================================================================================================

//Verificação de Provas
$idPlanoAcao = $PlanoAcaoGrupo->getIdPlanoAcao($idPlanoAcaoGrupo);

$valorTipoAval = $PlanoAcao->selectPlanoAcao(" WHERE idPlanoAcao = ".$idPlanoAcao);

$tipoAval = $valorTipoAval[0]['tipoAval'];
$tipoMaterial = $valorTipoAval[0]['tipoMaterial'];

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

$periodo = $PeriodoAcompanhamento->selectPeriodoAcompanhamentoCurso("WHERE mes = $mesRef AND ano = $anoRef");
$acomp = $AcompanhamentoCurso->selectAcompanhamentoCurso(" WHERE professor_idProfessor = $idProfessor AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso = ".$periodo[0]['idPeriodoAcompanhamentoCurso']);

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
	
	if ($tipoMaterial == 0) {
 
$mat =  $AcompanhamentoMaterial->selectAcompanhamentoMaterial("WHERE folhaFrequencia_idFolhaFrequencia = ".$idFolhaFrequencia);
if($mat[0]['idAcompanhamentoMaterial']){
//    $AM = true;    
 }else{
 //   $AM = false;    
}

	} else {
		
//	$AM = true;	
	}
$AM = true;
//$KitMaterial = new KitMaterial();
$Montado = new MaterialMontadoPlanoAcao();
$MaterialPlano = new MaterialDidaticPlanoAcao();


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
 
 // Validação de agendamento de Provas
 
 if ($tipoAval == 0) {
 
 $rp = $CalendarioProva->selectCalendarioProva(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
 
 
 //1
 if ($rp[0]['dataAplicacao'] == '') {
	 
 $dataV = explode("-",$rp[0]['validacao']);
 $anoV = $dataV[0];
 $mesV = $dataV[1];
 
 $anoAtual = date("Y");
 $mesAtual = date("m");

 $dataA2 = $rp[0]['dataPrevistaInicial'];
 
 $dataN = $rp[0]['dataPrevistaNova'];
  
 // data Futura
 
 if ($mesAtual == 12) {
	 $mesF = 01;
	 $anoF = $anoAtual + 1;
 } else {
	$mesF = $mesAtual + 1;
	$anoF = $anoAtual;
 }
	 $dataF = date("Y-m-t", strtotime($anoF."-".$mesF."-30"));
	 $dataAtual = $anoAtual."-".$mesAtual."-01";
 
if ($rp[0]['dataPrevistaInicial'] != '') {

	if  ( ($dataA2 >= $dataAtual) && ($dataA2 <= $dataF)) { 
	$dataProva = 1;
	
	// Precisa Validar	
	
	} else {
	$dataProva = 0;
	
	// Não Precisa Validar
	}
	
}

if ($rp[0]['dataPrevistaNova'] != '') {

	if  ( ($dataN >= $dataAtual) && ($dataN <= $dataF)) { // 	&& ($mesA <= $mesF) && ($anoA >= $anoAtual) && ($anoA <= $anoF)) {
	$dataProva = 1;
	
	// Precisa Validar	
	
	} else {
	$dataProva = 0;
	
	// Não Precisa Validar
	}
	
} 


 //2
 if (($rp[0]['dataPrevistaInicial'] != '') || ($rp[0]['dataPrevistaNova'] != '')) {
	
	
	//3 
	 if ((($anoV == $anoAtual) && ($mesV == $mesAtual)) ||  ($dataProva == 0)) {
		 
		 $rProva = 1;
		 $indice = 1;
	//3	 
	 } else {
		 
		 $rProva = 0;
	//3	 		 $indice = 2;
	 }
		 
	 //2
 }
	//1 
 } else {
	$rProva = 1; 
			 $indice = 3;
	 
 }//1
 

 
} else {
	$rProva = 1;
}
?>
<style>
/*.Bblue {
	display: inline-block;
    zoom: 1;
    vertical-align: baseline;
    margin: 0 2px;
    outline: none;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    font: 14px/100% Arial, Helvetica, sans-serif;
    padding: 0.5em 1.5em 0.5em;
    text-shadow: 0 1px 1px rgba(0,0,0,.3);
    -webkit-border-radius: .5em;
    -moz-border-radius: .5em;
    border-radius: .5em;
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
    -moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
    box-shadow: 0 1px 2px rgba(0,0,0,.2);
	    color: #d9eef7;
    border: solid 1px #0076a3;
    background: #0095cd;
    background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
    background: -moz-linear-gradient(top, #00adee, #0078a5);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00adee', endColorstr='#0078a5');
	
}*/
</style>
<fieldset>
  <legend>Folha de frequência</legend>
  <div class="menu_interno">        
    <?php if(!$finalizar){?>
        <br />
        <p><span><button class="Bblue" onclick="zerarCentro();carregarModulo('<?php echo "modulos/ff/professor/diaAulaFF.php?idFolhaFrequencia=".$idFolhaFrequencia?>', '#centro');" >Adicionar Reposição</button></span> &nbsp;<button class="gray" onclick="fecharReposicao()">Fechar Reposicao</button></p>
   <!--     <img src="<?php echo CAMINHO_IMG."novo.png";?>" style="    cursor: pointer;" title="Adicionar REPOSIÇÃO" -->
        
        <div id="reposicao"></div>
        <p>&nbsp;</p>
        <?php }?>
  </div> 
  <div class="lista">
  <?php echo "<a href='/cursos/portais/modulos/ff/professor/folhaFrequenciaPdf.php?id=".$idFolhaFrequencia."' target='_blank'><button class='Bblue'>Gerar Pdf</button></a>"; ?>
   <?php echo "<button onclick=\"javascript:AllInexistenteProf();\" id=\"AIaut\" class=\"button red\" style=\"display:none\">Aulas Inexistentes</button>"; ?>
   <p>Grupo: <strong><?php echo $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo)?></strong></p>
  <p>Professor: <strong><?php echo $Professor->getNome($idProfessor)?></strong></p>
  <p>Período: <strong><?php echo "$mesRef/$anoRef"?></strong></p>
  <p>Horas Cobradas: <strong><?php echo Uteis::exibirHoras($horasCobradas);?></strong></p>
  <p style="color:#bb0000;">CCAs permitidos: <strong><?php echo $ccas;?></strong></p>
  <?php foreach($rsIntegranteGrupo as $valorIntegranteGrupo){?>  
     <p> 
     <strong>Aluno: </strong><?php echo $IntegranteGrupo->getNomePF($valorIntegranteGrupo['idIntegranteGrupo'], true);?><br />
     
     <?php if ($Ndados != 1) { ?>
     <strong>Telefone:</strong><?php echo $IntegranteGrupo->getTelefone($valorIntegranteGrupo['idIntegranteGrupo']);?><br />
     <strong>Email:</strong><?php echo $IntegranteGrupo->getEmail($valorIntegranteGrupo['idIntegranteGrupo']);?><br /> 
     <?php } ?>
     
     </p>  
    <?php }?>
    
    <table id="tb_lista_FolhaFrequencia_form" class="registros">
      <thead>
        <tr>
          <th>Data</th>
          <th>Dia da semana</th>
          <th>Período</th>
          <th>Horas de aula</th>
          <th>Horas dadas</th>
        </tr>
      </thead>
     
      <tbody>
        <?php   
		 $anoRef = date('Y', strtotime($dataReferencia));
         $mesRef = date('m', strtotime($dataReferencia));
		//		echo $anoRef.$mesRef;
			$valorProfessor = $AulaGrupoProfessor ->selectAulaGrupoProfessor_periodo($idPlanoAcaoGrupo, $dataReferencia);
		
	//	Uteis::pr($valorProfessor);
				        $totalHorasAulas = 0;
						$qP = 0;
				foreach ($valorProfessor as $valorP) {
						$qP++;
						$totalHorasProfessor = 0;
						if ($valorP != $idProfessor) {
						
	$rsFFT = $FolhaFrequencia->selectFF_diasHoras($idPlanoAcaoGrupo, $anoRef, $mesRef, $valorP," ",$totalHorasAulas);
						 $rsFF_pf2 = array_merge($rsFFT['permanente'], $rsFFT['fixa']);

                //Uteis::pr($rsFF_pf);
        
				
                foreach($rsFF_pf2 as $valorFF2){
                    //foreach($rsFF['permanente'] as $valorPermanente){

                    //INF GERAIS
                //    $dataAtual = $valorFF["dataAtual"];
                 //   $diaDaSemanaAtual = $valorFF["diaSemana"];
                //    $horaInicio = $valorFF["horaInicio"];
                //    $horaFim = $valorFF["horaFim"];
                    $horasTotal2 = $valorFF2["horasTotal"];
                    $totalHorasAulas += $horasTotal2;
					$totalHorasProfessor += $horasTotal2;
                	
				}
	//			echo $totalHorasProfessor."<br>";
						} else {
				$rsFFP = $FolhaFrequencia->selectFF_diasHoras($idPlanoAcaoGrupo, $anoRef, $mesRef, $valorP," ",$totalHorasAulas);
						 $rsFF_pf3 = array_merge($rsFFP['permanente'], $rsFFP['fixa']);


				
                foreach($rsFF_pf3 as $valorFF3){
                    $horasTotal3 = $valorFF3["horasTotal"];
     				$totalHorasProfessorA += $horasTotal3;
                	
				}			
							
						}
						
		
				}   
				// Caso os outros professores seja muito maior que o professor atual, tenho que eliminar pelo menos uma aula para meses de 5 semanas.
				if ($totalHorasProfessorN > $totalHorasProfessorA) {
					$totalHorasAulas = $totalHorasProfessorN - $totalHorasProfessorA;
				}
				 $rsFF = $FolhaFrequencia->selectFF_diasHoras($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor, " ",$totalHorasAulas);                       
     //   $rsFF = $FolhaFrequencia->selectFF_diasHoras($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor);
        $rsFF_pf = array_merge($rsFF['permanente'], $rsFF['fixa']); 
            
        //Uteis::pr($rsFF_pf);
        foreach($rsFF_pf as $valorFF){
            //foreach($rsFF['permanente'] as $valorPermanente){ 
            
                        //INF GERAIS                
            $dataAtual = $valorFF["dataAtual"];
            $diaDaSemanaAtual = $valorFF["diaSemana"];            
            $horaInicio = $valorFF["horaInicio"];
            $horaFim = $valorFF["horaFim"];
            $horasTotal = $valorFF["horasTotal"];
			if (!$aulaInexistente ) {
			$totalHorasAulas += $horasTotal;
			}
            
            $d = date('d', strtotime($dataAtual));
                        
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
						$obs_dia = $valorDiaAulaFF[0]['obs'];
                        
                        if( !$aulaInexistente ) $cont_dias[] = $d;
                                
            ?>
            
            <?php if (!$aulaInexistente) { ?>
            
            <tr align="center" <?php echo $aulaInexistente ? "class=\"aulaInexistente\"" : "" ?>> 
              
              <!--DIA-->
              <td ><?php echo $d?></td>
              
              <!--DIA DA SEMANA-->
              <td><?php echo Uteis::exibirDiaSemana($diaDaSemanaAtual)?></td>
              
              <!--HORARIO DA AULA -->
              <td>das <?php echo Uteis::exibirHoras($horaInicio)?> às <?php echo Uteis::exibirHoras($horaFim)?></td>
              
              <!--PERIODO DA AULA-->
              <td>
                        
                            <?php echo Uteis::exibirHoras($horasTotal)?>
                             
              <?php if( !$aulaInexistente ){ ?> 
              <img src="<?php echo CAMINHO_IMG."seta.png"?>" title="Preenchimento automático" 
              onclick="preencheCampo('<?php echo "horasDadas_".$nomeCampo."_base"?>', '<?php echo "horasDadas_".$nomeCampo?>')" <?php echo $finalizar ? "style=\"display:none;\"" : ""?> />
              
              <input type="hidden" id="<?php echo "horasDadas_".$nomeCampo."_base"?>" 
              value="<?php echo Uteis::exibirHorasInput($horasTotal)?>" />
              <?php }?>
              
              </td>
              
              <!--HORAS DADAS / OCORRENCIA-->
              <td>
                                <?php if(!$finalizar){ ?>
                
                  <form id="<?php echo "form_".$nomeCampo?>" class="validate ff" method="post" action="" onsubmit="return false" >
                  <input type="hidden" name="<?php echo "ccaspremitidos"?>" id="ccaspremitidos" value="<?php echo $ccas?>" />
                  
                  <input type="hidden" name="<?php echo "idAulaPermanenteGrupo"?>" id="<?php echo "idAulaPermanenteGrupo"?>"
                  value="<?php echo $idAulaPermanenteGrupo?>" />
                  
                  <input type="hidden" name="<?php echo "idAulaDataFixa"?>"  id="<?php echo "idAulaDataFixa"?>"
                  value="<?php echo $idAulaDataFixa?>" />
                    
                  <input type="hidden" name="<?php echo "idDiaAulaFF"?>" id="<?php echo "idDiaAulaFF_".$nomeCampo?>" 
                  value="<?php echo $idDiaAulaFF?>" />
                  
                  <input type="hidden" name="<?php echo "horasTotal"?>" id="<?php echo "horasTotal"?>" 
                  value="<?php echo $horasTotal?>" />
                  
                  <input type="hidden" name="<?php echo "idFolhaFrequencia"?>" id="<?php echo "idFolhaFrequencia"?>"
                  value="<?php echo $idFolhaFrequencia?>" />
                  
                  <input type="hidden" name="<?php echo "dataAula"?>"  id="<?php echo "dataAula"?>" 
                  value="<?php echo $dataAtual?>" />
                  
                  <input type="hidden" name="nomeCampo" value="<?php echo $nomeCampo?>" />
                    
                  <p><input type="time" name="<?php echo "horasDadas"?>" id="<?php echo "horasDadas_".$nomeCampo?>" <?php echo $aulaInexistente ? "disabled" : "" ?> 
                  value="<?php echo Uteis::exibirHorasInput($horasDadas)?>" class="horas required" size="5" />
                  <span class="placeholder">Horas dadas</span>
                   
                  <font id="div_ocorrencia_<?php echo $nomeCampo?>">
                  <?php if($horasDadas!='' && !$aulaInexistente){                                        
                                            $difHoras = $horasTotal - $horasDadas;                                  
                                            if($difHoras != 0) echo $OcorrenciaFF->selectOcorrenciaFFSelectSemRep("", $idOcorrenciaFF, " AND professorVe = 1 ");                              
                                    }?>
                                    </font>
                                    
                                     <?php          if($obs_dia) echo "<strong title=\"Obs.: $obs_dia\">&nbsp;*obs</strong>";
						   
						   ?>
                           <img src="<?php echo CAMINHO_IMG."editar.png"?>" title="Editar conteúdo de aula" onclick="editarJustificativa('<?php echo $idDiaAulaFF?>', '<?php echo $nomeCampo?>', '<?php echo $obs_dia?>',  '<?php echo $idFolhaFrequencia?>')" />
                   
                                      </p>
                    
                    </form>
                    
                                <?php }else{
                        
                                    echo Uteis::exibirHoras($horasDadas);
									
									if($obs_dia) echo "<strong title=\"Obs.: $obs_dia\">&nbsp;*obs</strong>";
                        
                                    if($idOcorrenciaFF){
                                        $ocor = $OcorrenciaFF->selectOcorrenciaFF(" WHERE idOcorrenciaFF = ".$idOcorrenciaFF);
                                        echo " <font color=\"#FF0000\">".$ocor[0]['sigla']."</font>";
										
										?>
                                        
                                        <img src="<?php echo CAMINHO_IMG."editar.png"?>" title="Editar conteúdo de aula" onclick="editarJustificativa('<?php echo $idDiaAulaFF?>', '<?php echo $nomeCampo?>', '<?php echo $obs_dia?>',  '<?php echo $idFolhaFrequencia?>')" />
                                        
                                        <?php
                                    }
                            
                                }?>
                
                            </td>
                        
                        </tr>
           <?php             } ?>
            
        <?php }
        //Uteis::pr($rsFF['reposicao']);
        foreach($rsFF['reposicao'] as $valorReposicao){ 
            
            $idDiaAulaFF = $valorReposicao["id"];                       
            $dataAtual = $valorReposicao["dataAtual"];
            $diaDaSemanaAtual = $valorReposicao["diaSemana"];
            
            $horaInicio = $valorReposicao["horaInicio"];
            $horaFim = $valorReposicao["horaFim"];
            $horasTotal = $valorReposicao["horasTotal"];
                $total_horasDadas += $horasTotal;
            $d = date('d',strtotime($dataAtual));
            $cont_dias[] = $d;
                        
            $rsidDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE idDiaAulaFF = ".$idDiaAulaFF);
            $obs_dia = $rsidDiaAulaFF[0]['obs'];
                        
            if(!$finalizar){    
                $onclick = " onclick=\"zerarCentro();carregarModulo('".CAMINHO_MODULO."ff/professor/diaAulaFF.php?id=".$idDiaAulaFF."&idFolhaFrequencia=".$idFolhaFrequencia."', '#div_ff_geral')\" ";
            }
                            
            ?>
            
            <tr align="center" class="reposicao" > 
              
              <!--DIA-->
              <td <?php echo $onclick?> ><?php echo $d?></td>
              
              <!--DIA DA SEMANA-->
              <td <?php echo $onclick?> ><?php echo Uteis::exibirDiaSemana($diaDaSemanaAtual)?></td>
              
              <!--HORARIO DA AULA -->
              <td <?php echo $onclick?> ></td>
              
              <!--PERIODO DA AULA-->
              <td <?php echo $onclick?> ></td>
              
              <!--HORAS DADAS / OCORRENCIA-->
              <td >
                        <?php if(!$finalizar){                                                                              
                echo "<img src=\"".CAMINHO_IMG."excluir.png\" title=\"Excluir reposição\" onclick=\"deletaRegistro('modulos/ff/professor/diaAulaFFAcao.php', '".$idDiaAulaFF."', 'modulos/ff/form/folhaFrequencia.php?idFolhaFrequencia=".$idFolhaFrequencia."', '#div_ff_geral')\" />&nbsp;";
              }
          
                                echo Uteis::exibirHoras($horasTotal);               
                                    
                                if($obs_dia) echo "<strong title=\"Obs.: $obs_dia\">&nbsp;*obs</strong>";
								?>
								<img src="<?php echo CAMINHO_IMG."editar.png"?>" title="Editar conteúdo de aula" onclick="editarJustificativa('<?php echo $idDiaAulaFF?>', '<?php echo $nomeCampo?>', '<?php echo $obs_dia?>', '<?php echo $idFolhaFrequencia?>')" />
                    
               </td>
            </tr>
            
        <?php }
		$rsH = $Relatorio->relatorioFrequencia_mensal(" WHERE FF.idFolhaFrequencia = $idFolhaFrequencia");
		$totalHorasAssistidas = $rsH[0]['horasRealizadasPeloGrupo'] + $rsH[0]['somarCom_horasRealizadasPeloGrupo'];
            //print_r($cont_dias)?>
        
      </tbody>
            
             <tfoot>
        <tr>
          <th colspan="2"><?php echo count(array_unique($cont_dias))?> dia(s)</th>          
          <th>Período</th>
          <th><?php echo Uteis::exibirHoras($totalHorasAulas)?></th>
      <!--    <th><?php echo Uteis::exibirHoras($total_horasDadas)?></th>-->
      <th><?php echo Uteis::exibirHoras($totalHorasAssistidas)?></th>
        </tr>
      </tfoot>
      
    </table>
    <p><strong>Clique em gravar para gravar as aulas e somente clique em finalizar após preencher todas as aulas!!!</strong></p>
        <?php if(!$finalizar){?>
        <button class="button gray" onclick="eventRolarParaTopo();gravarHoras('<?php echo "modulos/ff/professor/diaAulaFFAcao.php"?>');" >Gravar</button>
        <?php if($AM && $AF && ($rProva == 1) ){?>
        <button class="Bblue" id="finalizar" onclick="eventRolarParaTopo();finalizarProfessor('1');" >Finalizar</button>
        
    <?php  } 
		}?>
  <div style="width: 100%;;overflow: hidden;">
      <a onclick="eventRolarParaTopo();" class="button gray" style="float: right; display: block;margin-right:40px">Topo</a>
  </div>
  </div>
  <div class="linha-inteira">
  <fieldset>
  <legend>Plano de Curso - Controle</legend>
  
  <table id="tb_lista_acompanhamentoMaterial" class="registros">
  <thead>
    <tr>
       <th>Livro</th>
       <th>Unidade Inicial</th>
       <th>Unidade Final</th>
       <th>Unidade Atual</th>
       <th>Obs</th>     
    </tr>
  </thead>
  <tbody>
    <?php 
//	if($anoRef > 2014):
    $abrir = "modulos/ff/professor/acompanhamentoMaterial.php";
    $atualizar= "modulos/ff/professor/folhaFrequencia.php";
//$kit = $KitMaterial->AcompanhamentoPorKit($idPlanoAcaoGrupo, $idFolhaFrequencia, $abrir, $atualizar,"","",1);
$mont = $Montado->AcompanhamentoMaterialMontado($idPlanoAcaoGrupo, $idFolhaFrequencia, $abrir, $atualizar,"","",1);
$plan = $MaterialPlano->AcompanhamentoMaterialPlano($idPlanoAcaoGrupo, $idFolhaFrequencia, $abrir, $atualizar,"","",1);
    
    if($kit!="")
        echo $kit;
    elseif($mont!="")
        echo $mont;
    elseif($plan!="")
        echo $plan;
    
//    endif;
    ?>
  </tbody>

</table>
</fieldset>
</div>
<div id="planodecurso"></div>
      <div style="width: 100%;;overflow: hidden;">
      <input type="text" id="esconderMaterial" value="" style="height:1px; width:1px">
          <a onclick="eventRolarParaTopo();" class="button gray" style="float: right; display: block;margin-right:40px">Topo</a>
      </div>
</fieldset>
<div id="div_provas_grupo2">
<?php //require_once("provasF.php"); ?>
<fieldset>
  <legend>Provas</legend>
  
   <div class="lista">
    <table id="tb_lista_prova2" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Nível</th>
          <th>Data prevista</th>
          <th>Data aplicada</th>
          <th>Data validação</th>
          <th>Notas</th>
          
        </tr>
      </thead>
      <tbody>
        <?php 		
		echo $Prova->selectProvaTr_grupo("modulos/provas/", "modulos/ff/professor/folhaFrequencia_abas.php?idFolhaFrequencia=".$idFolhaFrequencia, "#provasF", " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo, false,"",1,$idFolhaFrequencia);
		?>        
      </tbody>
    </table>
  </div>
</fieldset>
<div id="provasF">
<input type="text" id="provasFAlunos" value="" style="height:1px; width:1px">
</div>
    <div style="width: 100%;;overflow: hidden;">
        <a onclick="eventRolarParaTopo();" class="button gray" style="float: right; display: block;margin-right:40px">Topo</a>
    </div>
    
 <div id="notaM">
 

<fieldset>
  <legend>Nota Mensal - Habilidade e Atitude</legend>
  
    <table id="tb_lista_Acompanhamento" class="registros">
      <thead>
      <tr>
        <th>Data</th>  
        <th>Professor</th>                      
        <th>Finalizados</th>      
      </tr>
    </thead>
    <tbody>
    <?php    
      echo $AcompanhamentoCurso->selectAcompanhamentoCursoTr("modulos/ff/professor/itemAcompanhamento.php", "modulos/ff/professor/folhaFrequencia_abas.php?idFolhaFrequencia=".$idFolhaFrequencia, "#notasMensais", $idProfessor, $mesRef, $anoRef,$idPlanoAcaoGrupo, false,1,$idFolhaFrequencia);
    ?>
    </tbody>
 <!--   <tfoot>
       <tr>
        <th>Data</th>   
       <th>Professor</th>                 
       <th>Finalizados</th>     
      </tr>      
    </tfoot>-->
    </table>
    <div id="notasMensais"><input type="text" id="esconderNota" value="" style="height:1px; width:1px"></div>
    <div style="width: 100%;;overflow: hidden;">
        <a onclick="eventRolarParaTopo();" class="button gray" style="float: right; display: block;margin-right:40px">Topo</a>
    </div>
</fieldset>
</div>   
<?php require_once("tabelaBHf.php"); ?>
</div>




  <div class="esquerda">
   
  <p><strong>Clique em gravar para gravar as aulas e somente clique em finalizar após preencher todas as aulas!!!</strong></p>
        <?php if(!$finalizar){?>
        <button class="button gray" onclick="eventRolarParaTopo();gravarHoras('<?php echo "modulos/ff/professor/diaAulaFFAcao.php"?>');" >Gravar</button>
        <?php if($AM && $AF && ($rProva == 1) ){?>
        <button class="Bblue" id="finalizar" onclick="eventRolarParaTopo();finalizarProfessor('1');" >Finalizar</button>
        
    <?php  } else { ?>
	<p  ><marquee onMouseOver="stop()" onMouseOut="start()" style="color:#FF0000; font-size:14px" behavior="alternate" > Professor não esqueça de verificar o(s) item(ns):<br />
    <?php if ($AM != true) { echo "<button class=\"Bblue\" id=\"acompanhar\" onclick=\"acompanharMaterial();\" >Clique aqui para acessar </button> o Plano de curso Controle ;<br>"; } ?>  <?php if ($AF != true) { echo "<button class=\"Bblue\" id=\"acompanharAluno\" onclick=\"acompanharNAlunos();\" >Clique aqui para acessar </button> as notas mensais de habilidade e atitude;<br> "; } ?> <?php if ($rProva != true) { echo "<button class=\"Bblue\" id=\"provaAlunos\" onclick=\"provaAlunos();\" >Clique aqui para acessar </button> a data de agendamento da prova;<br>"; } ?> </marquee></p>
	
<?php 	}}    ?>
    
    <?php if(!$finalizar){?>
        <form id="form_ff_obs" class="validate" method="post" action="" onsubmit="return false">
          <p>
            <label>Observação:</label>
            <textarea name="obsF" id="obsF" cols="30" rows="6" ><?php echo $obsFF?></textarea>
          </p>
          <p>
            <button class="button gray"  
            onclick="eventRolarParaTopo();postForm('form_ff_obsF', '<?php echo "modulos/ff/professor/folhaFrequenciaAcao.php?acao=gravaObs&id=".$idFolhaFrequencia?>');" > Enviar observação</button>
          </p>
        </form>
    <?php }else{ ?>
            <p><?php echo $obsFF?></p>
   <?php }
        
        echo $contest?>
        
         <?php if ($finalizar == '') $finalizar = 0; ?>
  </div>
   
</fieldset>
<script src="<?php echo CAMINHO_CFG?>js/ff.js" language="javascript" type="text/javascript"></script>
<script>

//tabelaDataTable('tb_lista_FolhaFrequencia_form');
//tabelaDataTable('tb_lista_acompanhamentoMaterial');
//tabelaDataTable('tb_lista_Acompanhamento', '');
//tabelaDataTable('tb_lista_prova2');

function finalizarProfessor(finalizar){ 
    postForm('', '<?php echo "modulos/ff/professor/folhaFrequenciaAcao.php"?>', '<?php echo "&acao=finalizarProfessor&id=".$idFolhaFrequencia."&finalizar="?>'+finalizar);
	carregarModulo('modulos/ff/professor/folhaFrequencia_abas.php?idFolhaFrequencia=<?=$idFolhaFrequencia;?>', '#centro');
}

function finalizarProfessorPri(finalizar){
    postForm('', '<?php echo "modulos/ff/professor/folhaFrequenciaAcao.php"?>', '<?php echo "&acao=finalizarProfessorPri&id=".$idFolhaFrequencia."&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&idProfessor=".$idProfessor."&finalizar="?>'+finalizar); 
}

function removerLink(){
    var finalizar = <?=$finalizar;?>;
    if(finalizar == 1){
        $('finalizar').removeAttr("onclick");
    }
}
function avisoAula(campo){
    $('#'+campo).show();   
}
function avisoOff(campo){
    $('#'+campo).hide();
}
removerLink();
//ativarForm();

function fecharReposicao(){
	$('#reposicao').html('');
}

function enviadoOK() {
alert("Informação gravada com sucesso!");	
}

function zerarPlano() {
$('#planodecurso').html('');	
}

function zerarProva() {
$('#provasF').html('');	
}

function acompanharMaterial() {
$('#AcompMat').click();
$('#esconderMaterial').focus(); 

}

function acompanharNAlunos() {
$('#AcompAluno').click();	
$('#esconderNota').focus(); 
	
}

function zerarNotas() {
$('#notasMensais').html('');	
	
}

function provaAlunos() {
$('#provaGrupo').click();	
$('#provasFAlunos').focus();	
	
}

function editarJustificativa(idDiaAulaFFIndividual, nomeCampo, obsFaltaJustificada, idFolhaFrequencia){
	var idDiaulaFF = $('#idDiaAulaFF_'+nomeCampo).val();
	
	if (idDiaulaFF == '') {
		alert("Necessário clicar em gravar antes de colocar a justificativa!");
		
	} else {

	
	var justificaFalta = prompt ("Editar conteúdo de aula", obsFaltaJustificada);	
	if(justificaFalta!=null && justificaFalta != 'undefined' ){
		showLoad();
		$.post('modulos/ff/professor/diaAulaFFAcao.php',{acao:"EditarConteudoAula", idDiaAulaFFIndividual:idDiaulaFF, justificaFalta:justificaFalta, nomeCampo:nomeCampo, idFolhaFrequencia:idFolhaFrequencia}, function(e){	
			fecharNivel_load();
			acaoJson(e);			
		});
		}
	}
}


<?php 

if  ($naoAtualizarMais != 1) {

}
	$naoAtualizarMais = 1; 
?>


</script> 
