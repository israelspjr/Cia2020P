<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

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
//$KitMaterial = new KitMaterial();
$Montado = new MaterialMontadoPlanoAcao();
$MaterialPlano = new MaterialDidaticPlanoAcao();
$Relatorio = new Relatorio();
$AulaGrupoProfessor = new AulaGrupoProfessor();
$FechamentoGrupo = new FechamentoGrupo();
error_reporting(E_ALL);
//INSERÇÃO/CARREGAMENTO DA FF
$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];
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
$obsFF = $valorFolhaFrequencia[0]['obs'];
$dataFinalizada = $valorFolhaFrequencia[0]['dataFinalizada'];
$dataReferencia = $valorFolhaFrequencia[0]['dataReferencia'];
	$data = explode("-",$dataReferencia);
	$mesRef = $data[1];
	$anoRef = $data[0];	
$naoAtualizarMais = $_REQUEST['naoAtualizarMais'];	
	$dataFechamento = $FechamentoGrupo->getDataFechamento($idPlanoAcaoGrupo);
	if ($dataFechamento) {
		$dataFechamentoTmp = date("Y-m-01", strtotime($dataFechamento));
	}
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

$idGrupoF = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);

//Gerar Total com Debito e Credito
$ids = $PlanoAcaoGrupo->getPAG_total($idGrupoF);

foreach($ids AS $valor) {
$valorX[] = $valor['idPlanoAcaoGrupo'];		
}

$valorx2 = implode(', ',$valorX);

$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.")  AND mes = $mesRef AND ano = $anoRef ";

$rsDemonstrativo = $DemonstrativoCobranca->selectDemonstrativoCobranca($where);

$rsDiasCobrados = $DemonstrativoCobrancaDias->selectDemonstrativoCobrancaDias("WHERE demonstrativoCobranca_idDemonstrativoCobranca = ".$rsDemonstrativo[0]['idDemonstrativoCobranca']);


foreach($rsDiasCobrados as $valor){
    $horasCobradas += $valor['horas'];
}

if($horasCobradas <= 360){
    $ccas = 1;
}elseif($horasCobradas <= 720){
    $ccas = 2;
 }else{
    $ccas = 3;  
 } 

//Programação para trazer FF anterioes e posteriores



$valorFolhaA = $FolhaFrequencia->selectFolhaFrequencia(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND finalizadaPrincipal = 1 order by dataReferencia DESC");


$folhas = array();
foreach ($valorFolhaA as $key => $val) {
	$folhas[$key+1] = $val['idFolhaFrequencia'];
	
}

// Find the index of the current item
$current_index = array_search($idFolhaFrequencia, $folhas);

// Find the index of the next/prev items
$next = $current_index + 1;
$prev = $current_index - 1;
if ($prev <= 0) {
	$prev = 0;	
}

 $onclickA = " onclick=\"postForm('', '" . CAMINHO_REL . "grupo/include/acao/trocaFolhaFrequencia.php?idFolhaFrequencia=$folhas[$next]')\" ";
 
  $onclickP = " onclick=\"postForm('', '" . CAMINHO_REL . "grupo/include/acao/trocaFolhaFrequencia.php?idFolhaFrequencia=$folhas[$prev]')\" ";


?>

<fieldset>
  <legend>Folha de frequência</legend>
  <div class="menu_interno">        
    <?php if(!$finalizar){?>
        <br />
        <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Adicionar REPOSIÇÃO" 
        onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/diaAulaFF.php?idFolhaFrequencia=".$idFolhaFrequencia?>', '<?php echo CAMINHO_REL."grupo/include/form/folhaFrequencia.php?idFolhaFrequencia=".$idFolhaFrequencia?>', '#div_ff_geral');" />
        <p><span>Adicionar Reposição</span></p>
        <?php }?>
  </div> 
  <div class="lista">
  <?php echo "<a href='".CAMINHO_REL."grupo/include/form/folhaFrequenciaPdf.php?id=".$idFolhaFrequencia."' target='_blank'><button class=\"button blue\">Gerar Pdf</button></a>"; ?>
 
  <button onclick="AllInexistenteAut();" id="AIaut" class="button red" >Aulas Inexistentes</button>
  <p>Grupo: <strong><?php echo $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo)?></strong></p>
  <p>Professor: <strong><?php echo $Professor->getNome($idProfessor)?></strong></p>
  <p>Período: <strong><?php echo "$mesRef/$anoRef"?></strong></p>
  <p>Horas Cobradas: <strong><?php echo Uteis::exibirHoras($horasCobradas);?></strong></p>
  <p style="color:#bb0000;">CCAs permitidos: <strong><?php echo $ccas;?></strong></p>
  <?php foreach($rsIntegranteGrupo as $valorIntegranteGrupo){?>  
     <p> 
     <strong>Aluno: </strong><?php echo $IntegranteGrupo->getNomePF($valorIntegranteGrupo['idIntegranteGrupo'], true);?><br />
     <strong>Telefone:</strong><?php echo $IntegranteGrupo->getTelefone($valorIntegranteGrupo['idIntegranteGrupo']);?><br />
     <strong>Email:</strong><?php echo $IntegranteGrupo->getEmail($valorIntegranteGrupo['idIntegranteGrupo']);?><br /> 
     </p>  
    <?php }?>
    
    <div class="esquerda">
    <p>
    <?php if ($valorFolhaA > 0) { ?>
    <button class="button blue" <?php echo $onclickA?>><span style=" font-size: 20px;padding: 10px;">Anterior</span></button>
    <br />
    </p>
    <?php } ?>
    </div>
    <div class="direita">
    <?php if ($prev > 0) { ?>
    <button class="button blue" style=" float: right;" <?php echo $onclickP?>><span style=" font-size: 20px;padding: 10px;">Próxima</span></button><p>&nbsp;</p>
    <br />
    <?php } ?>
    </div>
    <p>&nbsp;</p>
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
						$totalHorasProfessorN = 0;
						$qP = 0;
				foreach ($valorProfessor as $valorP) {
						$qP++;
						$totalHorasProfessor = 0;
						if ($valorP != $idProfessor) {
						
	$rsFFT = $FolhaFrequencia->selectFF_diasHoras($idPlanoAcaoGrupo, $anoRef, $mesRef, $valorP," ",$totalHorasAulas);
						 $rsFF_pf2 = array_merge($rsFFT['permanente'], $rsFFT['fixa']);

                foreach($rsFF_pf2 as $valorFF2){
                   $horasTotal2 = $valorFF2["horasTotal"];
                    $totalHorasAulas += $horasTotal2;
					$totalHorasProfessorN += $horasTotal2;
                	
				}
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
		
				$totalHorasAulas = 0;
        //Uteis::pr($rsFF);
       	$rsFF_pf = array_merge($rsFF['permanente'], $rsFF['fixa']);	
        	
 //       Uteis::pr($rsFF_pf);
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
            
            <tr align="center" <?php echo $aulaInexistente ? "class=\"aulaInexistente\"" : "" ?>> 
              
              <!--DIA-->
              <td ><?php echo $d?></td>
              
              <!--DIA DA SEMANA-->
              <td><?php echo Uteis::exibirDiaSemana($diaDaSemanaAtual)?></td>
              
              <!--HORARIO DA AULA -->
              <td>das <?php echo Uteis::exibirHoras($horaInicio)?> às <?php echo Uteis::exibirHoras($horaFim)?></td>
              
              <!--PERIODO DA AULA-->
              <td>
			  			
							<?php echo Uteis::exibirHoras($horasTotal);
							
							
							
							
							?>
                            
                            
							 
              <?php if( !$aulaInexistente ){ ?> 
              <img src="<?php echo CAMINHO_IMG."seta.png"?>" title="Preenchimento automático" 
              onclick="preencheCampo('<?php echo "horasDadas_".$nomeCampo."_base"?>', '<?php echo "horasDadas_".$nomeCampo?>')" <?php echo $finalizar ? "style=\"display:none;\"" : ""?> />
              
              <input type="hidden" id="<?php echo "horasDadas_".$nomeCampo."_base"?>" 
              value="<?php echo Uteis::exibirHorasInput($horasTotal)?>" />
              
              
              <?php 
			  
			  
			  }?>
              
              </td>
              
              <!--HORAS DADAS / OCORRENCIA-->
              <td>
								<?php if(!$finalizar){ ?>
                
                  <form id="<?php echo "form_".$nomeCampo?>" class="validate ff" method="post" 
                  action="" onsubmit="return false" >
                  
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
											if($difHoras != 0) echo $OcorrenciaFF->selectOcorrenciaFFSelectSemRep("", $idOcorrenciaFF, " AND adminVe = 1 ");								
									}?>
									</font>
                                    
                           <?php          if($obs_dia) echo "<strong title=\"Obs.: $obs_dia\">&nbsp;*obs</strong>";
						   
						   ?>
                           <img src="<?php echo CAMINHO_IMG."editar.png"?>" title="Editar conteúdo de aula" onclick="editarJustificativa('<?php echo $idDiaAulaFF?>', '<?php echo $nomeCampo?>', '<?php echo $obs_dia?>',  '<?php echo $idFolhaFrequencia?>')" />
                   
                  <input type="checkbox" title="Aula inexistente" value="1" name="aulaInexistente" <?php echo $aulaInexistente ? "checked" : "" ?>
                  onclick="gravarAulaInexistente('<?php echo 'horasDadas_'.$nomeCampo?>', '<?php echo 'form_'.$nomeCampo?>', '<?php echo CAMINHO_REL.'grupo/include/acao/diaAulaFF.php'?>')"
                  onmouseover="avisoAula('aviso_<?=$nomeCampo?>')" onmouseout="avisoOff('aviso_<?=$nomeCampo?>')" />
                  <div style="display:none;" id="aviso_<?=$nomeCampo?>"><strong style="color:#FF0000;">
                      Somente Clique nesta caixa caso tenha CERTEZA que está aula não existe pois a mesma não será cobrada
                  </strong></div> 
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
							
								}
								
								
								?>
                
							</td>
						
						</tr>
            
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
                $onclick = " onclick=\"abrirNivelPagina(this, '".CAMINHO_REL."grupo/include/form/diaAulaFF.php?id=".$idDiaAulaFF."&idFolhaFrequencia=".$idFolhaFrequencia."', '".CAMINHO_REL."grupo/include/form/folhaFrequencia.php?idFolhaFrequencia=".$idFolhaFrequencia."', '#div_ff_geral')\" ";
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
              	echo "<img src=\"".CAMINHO_IMG."excluir.png\" title=\"Excluir reposição\" onclick=\"deletaRegistro('".CAMINHO_REL."grupo/include/acao/diaAulaFF.php', '".$idDiaAulaFF."', '".CAMINHO_REL."grupo/include/form/folhaFrequencia.php?idFolhaFrequencia=".$idFolhaFrequencia."', '#div_ff_geral')\" />&nbsp;";
              }
																																									
								echo Uteis::exibirHoras($horasTotal);				
									
								if($obs_dia) echo "<strong title=\"Obs.: $obs_dia\">&nbsp;*obs</strong>";
								?>
	<img src="<?php echo CAMINHO_IMG."editar.png"?>" title="Editar conteúdo de aula" onclick="editarJustificativa('<?php echo $idDiaAulaFF?>', '<?php echo $nomeCampo?>', '<?php echo $obs_dia?>', '<?php echo $idFolhaFrequencia?>')" />
					
               </td>
            </tr>
            
        <?php }
		
	//	if($finalizarPri){
      		
	      	
					$rsH = $Relatorio->relatorioFrequencia_mensal(" WHERE FF.idFolhaFrequencia = $idFolhaFrequencia");
			//		$totalHorasProgramadas = $rsH[0]['horasProgramadas'];
					$totalHorasAssistidas = $rsH[0]['horasRealizadasPeloGrupo'] + $rsH[0]['somarCom_horasRealizadasPeloGrupo'];
			//		$contadorDias = $rsH[0]['diasAula_total'];
					
	//	} else {
	//		$totalHorasAssistidas = $total_horasDadas;
	//	}
		
			//print_r($cont_dias)?>
        
      </tbody>
			
			 <tfoot>
        <tr>
          <th colspan="2"><?php echo count(array_unique($cont_dias))?> dia(s)</th>          
          <th>Período</th>
          <th><?php echo Uteis::exibirHoras($totalHorasAulas)?></th>
      <!--    <th><?php //echo Uteis::exibirHoras($total_horasDadas)?></th>-->
         <th><?php echo Uteis::exibirHoras($totalHorasAssistidas)?></th>
        </tr>
      </tfoot>
      
    </table>
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
   // if($anoRef > 2014):
        
    $abrir = CAMINHO_REL."grupo/include/form/acompanhamentoMaterial.php";
    $atualizar = CAMINHO_REL."grupo/include/form/folhaFrequencia.php";
    $kit = $KitMaterial->AcompanhamentoPorKit($idPlanoAcaoGrupo, $idFolhaFrequencia, $abrir, $atualizar);
    $mont = $Montado->AcompanhamentoMaterialMontado($idPlanoAcaoGrupo, $idFolhaFrequencia, $abrir, $atualizar);
    $plan = $MaterialPlano->AcompanhamentoMaterialPlano($idPlanoAcaoGrupo, $idFolhaFrequencia, $abrir, $atualizar);
    
    if($kit!="") {
        echo $kit;
	} elseif ($mont!="") {
        echo $mont;
	} elseif($plan!="") {
        echo $plan;
	}
  //  endif;
    ?>
  </tbody>
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
<div id="div_provas_grupo2a">
<?php require_once("provasF.php"); ?> 
</div>
<div class="esquerda">

  
  <?php require_once("tabelaBHf.php"); ?> 
  </div>
    <div class="direita">  
      <div id="integrantes">
        <label> Mandar FF somente para estes alunos: </label>
        <?php echo $PlanoAcaoGrupo->selectIntegrantesGrupoCheckBox($idPlanoAcaoGrupo); ?>
        <button class="button blue" onclick="finalizarProfessor('1');" >Enviar</button>
        </div>
        </div>
  
  <div class="esquerda">
  
		<?php if(!$finalizar){?>
     	<button class="button gray" onclick="gravarHoras('<?php echo CAMINHO_REL."grupo/include/acao/diaAulaFF.php"?>')" >Gravar</button>
               
	    <button class="button blue" onclick="finalizarProfessor('1');" >Finalizar</button>
        
        
      </div>
        </div>
        <div class="esquerda">
    <?php }elseif(!$finalizarPri){?>
    	<div id="integrantes"></div>
    	<button class="button blue" onclick="finalizarProfessor('0');" >Desfinalizar</button>
        <div style="float: right;"><label>Data de Finalização pelo professor: </label><?php echo "<strong>".Uteis::exibirData($dataFinalizada)."</strong><br>"; ?></div>
        
    <?php }?>
    
    <?php if($finalizar){
        if(!$finalizarPri){?>
		    <button class="button blue" onclick="finalizarProfessorPri('1');" >
            Finalizar [financeiro]</button>
    	<?php }else{?>
  			<button class="button blue" onclick="finalizarProfessorPri('0');" >
            Desfinalizar [financeiro]</button>
            
	    <?php }
    }?>
    
    <?php if(!$finalizar){?>
        <form id="form_ff_obs" class="validate" method="post" action="" onsubmit="return false">
          <p>
            <label>Observação:</label>
            <textarea name="obs" id="obs" cols="80" rows="6" ><?php echo $obsFF?></textarea>
          </p>
          <p>
            <button class="button gray"  
            onclick="postForm('form_ff_obs', '<?php echo CAMINHO_REL."grupo/include/acao/folhaFrequencia.php?acao=gravaObs&id=".$idFolhaFrequencia?>')" > Enviar observação</button>
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

tabelaDataTable('tb_lista_FolhaFrequencia_form');
tabelaDataTable('tb_lista_acompanhamentoMaterial', 'simples');

function finalizarProfessor(finalizar){	
    var checkedvalue = "";
    var arrChecks = document.getElementById("integrantes").getElementsByTagName('input');

    for (i = 0; i < arrChecks.length; i++) {
         var box = arrChecks[i];
         if (box.checked) {
            checkedvalue = checkedvalue + box.value + " ";
         }
    }

//alert(checkedvalue);
	if (finalizar == 1) {
		postForm('form_ff_obs', '<?php echo CAMINHO_REL."grupo/include/acao/folhaFrequencia.php?acao=gravaObs&id=".$idFolhaFrequencia?>')
	}

   	postForm('', '<?php echo CAMINHO_REL."grupo/include/acao/folhaFrequencia.php"?>', '<?php echo "&acao=finalizarProfessor&id=".$idFolhaFrequencia."&finalizar="?>'+finalizar+'<?php echo "&integrantes="?>'+checkedvalue);
}

function finalizarProfessorPri(finalizar){
	postForm('', '<?php echo CAMINHO_REL."grupo/include/acao/folhaFrequencia.php"?>', '<?php echo "&acao=finalizarProfessorPri&id=".$idFolhaFrequencia."&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&idProfessor=".$idProfessor."&finalizar="?>'+finalizar);	
}

function removerLink(){
    var finalizar = <?=$finalizar;?>;
    if(finalizar){
        $('td').removeAttr("onclick");
    }
}
function avisoAula(campo){
    $('#'+campo).show();   
}
function avisoOff(campo){
    $('#'+campo).hide();
}
//removerLink();
ativarForm();

function justificaFalta(idDiaAulaFFIndividual, nomeCampo, obsFaltaJustificada){
	
	var justificaFalta = prompt ("Conteúdo de aula", obsFaltaJustificada);	
	if(justificaFalta!=null && justificaFalta != 'undefined' ){
		showLoad();
		$.post('<?php echo CAMINHO_REL?>grupo/include/acao/diaAulaFF.php',{acao:"conteudoAula", idDiaAulaFFIndividual:idDiaAulaFFIndividual, justificaFalta:justificaFalta, nomeCampo:nomeCampo}, function(e){
			fecharNivel_load();
			acaoJson(e);
		});
	}
}

function editarJustificativa(idDiaAulaFFIndividual, nomeCampo, obsFaltaJustificada, idFolhaFrequencia){
	
	var justificaFalta = prompt ("Editar conteúdo de aula", obsFaltaJustificada);	
	if(justificaFalta!=null && justificaFalta != 'undefined' ){
		showLoad();
		$.post('<?php echo CAMINHO_REL?>grupo/include/acao/diaAulaFF.php',{acao:"EditarConteudoAula", idDiaAulaFFIndividual:idDiaAulaFFIndividual, justificaFalta:justificaFalta, nomeCampo:nomeCampo, idFolhaFrequencia:idFolhaFrequencia}, function(e){	
			fecharNivel_load();
			acaoJson(e);			
		});
	}
}
<?php if  ($naoAtualizarMais != 1) {
	//echo "teste".$dataFechamentoTmp;
if ($dataFechamento != '') {
	if ($dataReferencia >= $dataFechamentoTmp) { ?>
//	echo "teste";
$('#AIaut').click();
	
<?php 
		}
	}
}
	$naoAtualizarMais = 1; 
?>

//AllInexistenteAut();

</script> 
