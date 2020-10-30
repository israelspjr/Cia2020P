<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FolhaFrequencia = new FolhaFrequencia();
$IntegranteGrupo = new IntegranteGrupo();
$Professor = new Professor();
$DiaAulaFF = new DiaAulaFF();
$OcorrenciaFF = new OcorrenciaFF();
$DiaAulaFFIndividual = new DiaAulaFFIndividual();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$AulaDataFixa = new AulaDataFixa();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$AcompanhamentoCurso = new AcompanhamentoCurso();
$PeriodoAcompanhamento = new PeriodoAcompanhamentoCurso();
$RelatorioDesempenho = new RelatorioDesempenho();

$EndecoVirtual = new EnderecoVirtual();
$Telefone = new Telefone();

$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];

$valorFolhaFrequencia = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = ".$idFolhaFrequencia);

$idPlanoAcaoGrupo = $valorFolhaFrequencia[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
$idProfessor = $valorFolhaFrequencia[0]['professor_idProfessor'];
$dataReferencia = $valorFolhaFrequencia[0]['dataReferencia'];
$finalizar = $valorFolhaFrequencia[0]['finalizadaParcial'];
$finalizadaPrincipal = $valorFolhaFrequencia[0]['finalizadaPrincipal'];
$data = explode("-",$dataReferencia);
$mesRef = $data[1];
$anoRef = $data[0];	

$rsIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupoFF($idPlanoAcaoGrupo, $dataReferencia);

$grupoNome = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);
?>

 <form id="form_uploadFile" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_REL."grupo/"?>include/acao/diaAulaFFIndividual.php" style="display:none">
    <input type="hidden" id="acao" name="acao" value="file" />
    <input type="hidden" id="atestadoDia" name="atestadoDia" value="" />
    <input type="file" id="add_file" name="file" />
  </form>
  
  
<div>
<fieldset>
  <legend>Folha de frequência individual</legend>
  
  <a href="<?php  echo CAMINHO_REL."grupo/include/form/diaAulaFFIndividualPdf.php?id=".$idFolhaFrequencia ?>" target="_blank"><button class="button blue">Gerar Pdf</button></a>
    
  <p>Grupo: <strong><?php echo $grupoNome; ?></strong></p>
  <p>Professor: <strong><?php echo $Professor->getNome($idProfessor)?></strong></p>
  <p>Período: <strong><?php echo "$mesRef/$anoRef"?></strong></p>
  <?php foreach($rsIntegranteGrupo as $valorIntegranteGrupo){?>  
     <p> 
     <strong>Aluno: </strong><?php echo $IntegranteGrupo->getNomePF($valorIntegranteGrupo['idIntegranteGrupo'], true);?><br />
     <strong>Telefone:</strong><?php echo $IntegranteGrupo->getTelefone($valorIntegranteGrupo['idIntegranteGrupo']);?><br />
     <strong>Email:</strong><?php echo $IntegranteGrupo->getEmail($valorIntegranteGrupo['idIntegranteGrupo']);?><br /> 
     </p>  
    <?php }?> 
 
  <table id="tb_lista_FolhaFrequencia_form_individual" class="registros">
    <thead>
      <tr>
        <th>Data</th>
        <th>Dia da semana</th>
        <th>Período</th>
        <th>Horas dadas</th>
        <?php foreach($rsIntegranteGrupo as $valorIntegranteGrupo){?>
          <th><?php echo $IntegranteGrupo->getNomePF($valorIntegranteGrupo['idIntegranteGrupo'], true);
          //echo Uteis::pr($valorIntegranteGrupo);          
          ?></th>
        <?php }?>
      </tr>
    </thead>
    
    <tbody>
			<?php 
      
      $temAulaPermanenteGrupo = $AulaPermanenteGrupo->ffTem_AulaPermanenteGrupo($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor);
//	  Uteis::pr( $temAulaPermanenteGrupo);
      $temAulaDataFixa = $AulaDataFixa->ffTem_AulaDataFixa($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor);
      
	  $rsDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE aulaInexistente = 0 AND folhaFrequencia_idFolhaFrequencia = ".$idFolhaFrequencia);		
	  
//	  Uteis::pr($rsDiaAulaFF);
	  	
      foreach($rsDiaAulaFF as $valorDiaAulaFF){
      
        $idDiaAulaFF = $valorDiaAulaFF['idDiaAulaFF'];
        $dataAula = $valorDiaAulaFF['dataAula'];
        $dia = date('d',strtotime($dataAula));
        $diaDaSemanaAtual = date('w',strtotime($dataAula))+1;
        $horasTotal = $valorDiaAulaFF['horaRealizada'];          
        $idOcorrenciaFF = $valorDiaAulaFF['ocorrenciaFF_idOcorrenciaFF'];
        $reposicao = $valorDiaAulaFF['reposicao'];
    				
        $idAulaPermanenteGrupo = $valorDiaAulaFF['aulaPermanenteGrupo_idAulaPermanenteGrupo']; 
        if($idAulaPermanenteGrupo){
          $rsAulaPermanenteGrupo = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo);	
          $horaInicio = $rsAulaPermanenteGrupo[0]['horaInicio'];
          $horaFim = $rsAulaPermanenteGrupo[0]['horaFim'];
        }
        
        $idAulaDataFixa = $valorDiaAulaFF['aulaDataFixa_idAulaDataFixa']; 
        if($idAulaDataFixa){
          $rsAulaDataFixa = $AulaDataFixa->selectAulaDataFixa(" AND idAulaDataFixa = ".$idAulaDataFixa);	
          $horaInicio = $rsAulaDataFixa[0]['horaInicio'];
          $horaFim = $rsAulaDataFixa[0]['horaFim'];				
        }
      	
				//verifica se o dia esta nas aulas gerais antes de exibi-lo na aula individual
				//durante a finalização os dias que estao inseridos mas que nao pertencem mais a ff, são deletados
				$continua = false;
				
				if( $idAulaPermanenteGrupo){
					foreach($temAulaPermanenteGrupo as $cadaDia){
						if( $cadaDia['idAulaPermanenteGrupo'] == $idAulaPermanenteGrupo ){
							$continua = true;
							break;
						}
					}
				}elseif( $idAulaDataFixa ){
					foreach($temAulaDataFixa as $cadaDia){
						if( $cadaDia['idAulaDataFixa'] == $idAulaDataFixa ){
							$continua = true;
							break;
						}
					}
				}elseif( $reposicao ){
					$continua = true;					
				}
								
				if( $continua ) {?>
					
          <tr align="center" class="<?php echo $reposicao ? "reposicao" : ""?>"> 
						
						<!--DIA-->
						<td ><?php echo $dia?></td>
						
						<!--DIA DA SEMANA-->
						<td><?php echo Uteis::exibirDiaSemana($diaDaSemanaAtual)?></td>
						
						<!--HORARIO DA AULA -->
						<td>
						<?php if( !$reposicao && $horaInicio && $horaFim){?>
							das <?php echo Uteis::exibirHoras($horaInicio)?> às <?php echo Uteis::exibirHoras($horaFim)?>
						<?php }?>
						</td>
						
						<!--HORAS DE AULA-->
						<td><?php
						echo Uteis::exibirHoras($horasTotal);					
						if($idOcorrenciaFF){
							$ocor = $OcorrenciaFF->selectOcorrenciaFF(" WHERE idOcorrenciaFF = ".$idOcorrenciaFF);
							echo " - <font color=\"#FF0000\">".$ocor[0]['sigla']."</font>";
						}				
						?>
						
						<img src="<?php echo CAMINHO_IMG."seta.png"?>" title="Preenchimento automático"
                            <?php echo ($horasTotal=="0")? 'class="preencheAlunosAuto" data-t1="horaRealizadaAluno_'.$idDiaAulaFF.'_base" data-t2="dia_'.$idDiaAulaFF.'"': ''; ?>
						onclick="preencheAlunos('<?php echo "horaRealizadaAluno_".$idDiaAulaFF."_base"?>', '<?php echo "dia_$idDiaAulaFF"?>')" <?php echo $finalizar ? "style=\"display:none;\"" : ""?> />
						
                        
						<input type="hidden" id="<?php echo "horaRealizadaAluno_".$idDiaAulaFF."_base"?>" 
						value="<?php echo Uteis::exibirHorasInput($horasTotal)?>" /></td>
						
						<!--HORAS DADAS / OCORRENCIA-->
						<?php 		
						foreach($rsIntegranteGrupo as $valorIntegranteGrupo){
									
							$idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
							$dataSaida_aluno = $valorIntegranteGrupo['dataSaida'];
                            $dataEntrada_aluno = $valorIntegranteGrupo['dataEntrada'];        
							
							$nomeCampo = "ff_individual_".$idIntegranteGrupo."_".$idDiaAulaFF;
							
							$where = " WHERE integranteGrupo_idIntegranteGrupo = ".$idIntegranteGrupo." AND diaAulaFF_idDiaAulaFF = ".$idDiaAulaFF;
							$valorDiaAulaFFIndividual = $DiaAulaFFIndividual->selectDiaAulaFFIndividual($where);
							
							$idDiaAulaFFIndividual = $valorDiaAulaFFIndividual[0]['idDiaAulaFFIndividual'];
							$horaRealizadaAluno = $valorDiaAulaFFIndividual[0]['horaRealizadaAluno'];
							$totalHorasAluno[$idIntegranteGrupo] += $horaRealizadaAluno;
							$faltaJustificada = $valorDiaAulaFFIndividual[0]['faltaJustificada'];
							$obsFaltaJustificada = $valorDiaAulaFFIndividual[0]['obsFaltaJustificada'];
							$atestado =    $valorDiaAulaFFIndividual[0]['obs'];
												
							$difHoras = $horasTotal - $horaRealizadaAluno;
							?>
							
              <td align="center">
              <div id="<?php echo $nomeCampo?>"></div>
							<?php if($finalizar){                				
								
								echo Uteis::exibirHoras($horaRealizadaAluno, TRUE);   
								                   
								
								echo "<div id=\"".$nomeCampo."_".$idDiaAulaFFIndividual."\">";
										echo "<small><br /><font color=\"#FF0000\">";
								if( $difHoras >= 0){
										if($faltaJustificada){
												echo "".$obsFaltaJustificada; ?>
                                                <?php if( $atestado ){?>
		<a href="<?php echo CAMINHO_UP."/atestados/".$atestado?>" target="_blank" >
		<img src="<?php echo CAMINHO_IMG."contrato.png"?>" title="Visualizar" /></a>
        	         
                                                    
                                                    <?php } ?>
													<img src="<?php echo CAMINHO_IMG."excluir.png"?>" title="Excluir justificativa"
														onclick="excluiJustificativa('<?php echo $idDiaAulaFFIndividual?>', '<?php echo $nomeCampo?>');" /> 
											<img src="<?php echo CAMINHO_IMG."editar.png"?>" title="Editar justificativa"
											onclick="editarJustificativa('<?php echo $idDiaAulaFFIndividual?>', '<?php echo $nomeCampo?>', '<?php echo $obsFaltaJustificada?>')" />
                                              	 <img src="<?php echo CAMINHO_IMG?>upload_file.png" onclick="$('#add_file').click();addAtestado(<?php echo $idDiaAulaFFIndividual?>);" title="Anexar atestado" />
															&nbsp;&nbsp;
															
		<font id="visualizarFile_<?php echo $idDiaAulaFFIndividual?>" >
		<?php if( $atestado2 ){?>
		<a href="<?php echo CAMINHO_UP."/atestados/".$atestado?>" target="_blank" >
		<img src="<?php echo CAMINHO_IMG."contrato.png"?>" title="Visualizar" /></a>
        	    <?php } ?>       
          </font>                       

										<?php
										
										}else{
											
											?>
                                            <?php  if($horaRealizadaAluno!= '' && $difHoras > 0 || $horaRealizadaAluno == 0){
																
													$title = $faltaJustificada ? "Falta justificada:\n".$obsFaltaJustificada : "Justificar falta";?>
													
													<img src="<?php echo CAMINHO_IMG."pa.png"?>" title="<?php echo $title?>"	onclick="justificaFalta('<?php echo $idDiaAulaFFIndividual?>', '<?php echo $nomeCampo?>', '<?php echo $obsFaltaJustificada?>')" />
                                                    
            <!--         <img id="anexar<?php echo $campo?>" src="<?php echo CAMINHO_IMG."upload_file.png"?>" title="Anexar" onclick="$('#add_file_contrato<?php echo $campo?>').click()" />-->
                     
                     	 <img src="<?php echo CAMINHO_IMG?>upload_file.png" onclick="$('#add_file').click();addAtestado(<?php echo $idDiaAulaFFIndividual?>);" title="Anexar atestado" />
															&nbsp;&nbsp;
															
		<font id="visualizarFile_<?php echo $idDiaAulaFFIndividual?>" >
		<?php if( $atestado ){?>
		<a href="<?php echo CAMINHO_UP."/atestados/".$atestado?>" target="_blank" >
		<img src="<?php echo CAMINHO_IMG."contrato.png"?>" title="Visualizar" /></a>
        	    <?php } ?>       
          </font>                                          
                                                  
					<?php 								 } 
												//echo "não justificada";
										}
								}
										echo "</font></small>";
								echo "</div>";
								
							}else{ 
								
								//VERIFICA SE O ALUNO JA SAIU NESTA DATA																
								if( $dataEntrada_aluno <= $dataAula && (!$dataSaida_aluno || ( $dataSaida_aluno && $dataSaida_aluno >= $dataAula)) ){ ?>
                                
  
                
	<form id="<?php echo "form_".$nomeCampo?>" class="validate ff_individual" method="post" action="" onsubmit="return false"  >
		
											<input type="hidden" name="<?php echo "idDiaAulaFFIndividual_".$nomeCampo?>" 
											id="<?php echo "idDiaAulaFFIndividual_".$nomeCampo?>" value="<?php echo $idDiaAulaFFIndividual?>" />
											
											<input type="hidden" name="<?php echo "idDiaAulaFF_".$nomeCampo?>" 
											id="<?php echo "idDiaAulaFF_".$nomeCampo?>" value="<?php echo $idDiaAulaFF?>" />
											
											<input type="hidden" name="<?php echo "idIntegranteGrupo_".$nomeCampo?>" 
											id="<?php echo "idIntegranteGrupo_".$nomeCampo?>" value="<?php echo $idIntegranteGrupo?>" />
											
											<input type="hidden" name="<?php echo "horasTotal_".$nomeCampo?>" 
											id="<?php echo "horasTotal_".$nomeCampo?>"  value="<?php echo $horasTotal?>" />
											
											<input type="hidden" name="<?php echo "diaAulaExibir_".$nomeCampo?>" 
											id="<?php echo "diaAulaExibir_".$nomeCampo?>" value="<?php echo $dataAula?>" />
											
											<input type="hidden" name="nomeCampo" value="<?php echo $nomeCampo?>" />

											<p>
                                                <input type="text" name="<?php echo "horaRealizadaAluno_".$nomeCampo?>"
                                                       data-frm="<?php echo $nomeCampo; ?>"
                                                    class="hora8 required <?php echo "dia_$idDiaAulaFF"?>" size="5"
												    id="<?php echo "horaRealizadaAluno_".$nomeCampo?>" value="<?php echo Uteis::exibirHorasInput($horaRealizadaAluno)?>" />
												<span class="placeholder"></span>
												
												<font id="div_falta_<?php echo $nomeCampo?>" >
												<?php  if($horaRealizadaAluno!= '' && $difHoras > 0 || $horaRealizadaAluno == 0){
																
													$title = $faltaJustificada ? "Falta justificada:\n".$obsFaltaJustificada : "Justificar falta";?>
													&nbsp;&nbsp; 
		<img src="<?php echo CAMINHO_IMG."pa.png"?>" title="<?php echo $title?>" onclick="justificaFalta('<?php echo $idDiaAulaFFIndividual?>', '<?php echo $nomeCampo?>', '<?php echo $obsFaltaJustificada?>')" />
                                                    
        <!-- UPLOAD DO FILE (POLITICA) $('#add_file').click();-->
 
  	 <img src="<?php echo CAMINHO_IMG?>upload_file.png" onclick="$('#add_file').click();addAtestado(<?php echo $idDiaAulaFFIndividual?>);" title="Anexar atestado" />
                                                    
      
             <font id="visualizarFile_<?php echo $idDiaAulaFFIndividual?>" >
             
             <?php if( $atestado ){?>
		<a href="<?php echo CAMINHO_UP."/atestados/".$atestado?>" target="_blank" >
		<img src="<?php echo CAMINHO_IMG."contrato.png"?>" title="Visualizar" /></a>
           <?php } ?>
		 
              </font>        
                                                    
                                                    
													
													<?php 
													
													if($faltaJustificada){?>
														&nbsp;&nbsp;
														<img src="<?php echo CAMINHO_IMG."excluir.png"?>" title="Excluir justificativa"
														onclick="excluiJustificativa('<?php echo $idDiaAulaFFIndividual?>', '<?php echo $nomeCampo?>');" />
													<?php }
											
												}?>
												</font>
											</p>
										</form>
                                        <?php
                                            if($horasTotal=='0'){
                                                echo "<div  onload=\"preencheAlunos('horaRealizadaAluno_".$idDiaAulaFF."_base', 'dia_".$idDiaAulaFF."');\"></div>";
                                            }
                                        ?>
                    
								<?php }
																	
							}?>	
              						
              </td>
              
						<?php }?>
					</tr>
          
      	<?php }
				
			}?>
    </tbody>
    
    <tfoot>
      <tr >
      	<?php       	
      	if($finalizadaPrincipal){
      		
	      	$Relatorio = new Relatorio();
					$rsH = $Relatorio->relatorioFrequencia_mensal(" WHERE FF.idFolhaFrequencia = $idFolhaFrequencia");
					$totalHorasProgramadas = $rsH[0]['horasProgramadas'];
					$totalHorasAssistidas = $rsH[0]['horasRealizadasPeloGrupo'] + $rsH[0]['somarCom_horasRealizadasPeloGrupo'];
					$contadorDias = $rsH[0]['diasAula_total'];
	      	?>
	        <th colspan="2"><?php echo $contadorDias?> dias</th>
	        <th><?php echo Uteis::exibirHoras($totalHorasProgramadas)?></th>
	        <th><?php echo Uteis::exibirHoras($totalHorasAssistidas)?></th>        
	        <?php 
	        if( $rsIntegranteGrupo ){
		        
		        foreach($rsIntegranteGrupo as $valorIntegranteGrupo){	        		
		        	$rsH = $Relatorio->relatorioFrequencia_mensal(" WHERE FF.idFolhaFrequencia = $idFolhaFrequencia AND IG.idIntegranteGrupo = ".$valorIntegranteGrupo['idIntegranteGrupo']);
		        	
		        	?>
		        	
		        	<th><?php echo Uteis::exibirHoras($rsH[0]['horaRealizadaAluno'])?></th>
		        	
		        <?php }
					}
					
				}else{?>
						
					<th>Data</th>
	        <th>Dia da semana</th>
	        <th>Período</th>
	        <th>Horas dadas</th>
	        <?php foreach($rsIntegranteGrupo as $valorIntegranteGrupo){?>
	        	<th><?php echo $IntegranteGrupo->getNomePF($valorIntegranteGrupo['idIntegranteGrupo'], true);?></th>
	        <?php }?>
      		
      	<?php }?>	
      	
      </tr>
    </tfoot>
    
  </table>
  <div class="esquerda">
    <?php if(!$finalizar){?>
    <button class="button gray" onclick="gravarHorasIndividual();" >Gravar</button>
    <?php }?>
  </div>
</fieldset>


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
  //  if( $anoRef > 2014):
      echo $AcompanhamentoCurso->selectAcompanhamentoCursoTr(CAMINHO_REL."grupo/include/resourceHTML/itemAcompanhamento.php", CAMINHO_REL."grupo/include/resourceHTML/diaAulaFFIndividual.php?id=".$idPlanoAcaoGrupo, $ondeAtualiza, $idProfessor, $mesRef, $anoRef, $idPlanoAcaoGrupo, false);
  //  endif;
    ?>
    </tbody>
    <tfoot>
       <tr>
        <th>Data</th>   
       <th>Professor</th>                 
       <th>Finalizados</th>     
      </tr>      
    </tfoot>
    </table> 
    </div>
</fieldset>

<script>
tabelaDataTable('tb_lista_FolhaFrequencia_form_individual');
tabelaDataTable('tb_lista_Acompanhamento', '');
$('tr p, table form').css({'margin':'0'});

var optionshora =  {
    onComplete: function(hora) {
        var frmHoraId = jQuery('input:focus').attr('data-frm');
        postForm('form_'+frmHoraId, '<?php echo CAMINHO_REL."grupo/include/acao/diaAulaFFIndividual.php"?>');
        jQuery('div_falta_'+frmHoraId).hide();
    }
};
jQuery('.hora8').mask('00:00', optionshora).css("min-width","75px");


function justificaFalta(idDiaAulaFFIndividual, nomeCampo, obsFaltaJustificada){
	
	var justificaFalta = prompt ("Justificativa da falta", obsFaltaJustificada);	
	if(justificaFalta!=null && justificaFalta != 'undefined' ){
		showLoad();
		$.post('<?php echo CAMINHO_REL?>grupo/include/acao/diaAulaFFIndividual.php',{acao:"justificaFalta", idDiaAulaFFIndividual:idDiaAulaFFIndividual, justificaFalta:justificaFalta, nomeCampo:nomeCampo}, function(e){
			fecharNivel_load();
			acaoJson(e);
		});
	}
}

function editarJustificativa(idDiaAulaFFIndividual, nomeCampo, obsFaltaJustificada){
	
	var justificaFalta = prompt ("Editar justificativa da falta", obsFaltaJustificada);	
	if(justificaFalta!=null && justificaFalta != 'undefined' ){
		showLoad();
		$.post('<?php echo CAMINHO_REL?>grupo/include/acao/diaAulaFFIndividual.php',{acao:"EditarJustificativa", idDiaAulaFFIndividual:idDiaAulaFFIndividual, justificaFalta:justificaFalta, nomeCampo:nomeCampo}, function(e){	
			fecharNivel_load();
			acaoJson(e);			
		});
	}
}

function excluiJustificativa(idDiaAulaFFIndividual, nomeCampo){	
	showLoad();
	$.post('<?php echo CAMINHO_REL?>grupo/include/acao/diaAulaFFIndividual.php',{acao:"excluiJustificativa", idDiaAulaFFIndividual:idDiaAulaFFIndividual, nomeCampo:nomeCampo}, function(e){	
		fecharNivel_load();
		acaoJson(e);
	});
	//$("#"+nomeCampo+"_"+idDiaAulaFFIndividual).html(e.valor2);
}

function preencheAlunos(id, classe){
	$('#tb_lista_FolhaFrequencia_form_individual').find('input[type=text].'+classe).each(function(){
    	preencheCampo(id, $(this).attr('id'));
        var frmHoraId = jQuery(this).attr('data-frm');
        postForm('form_'+frmHoraId, '<?php echo CAMINHO_REL."grupo/include/acao/diaAulaFFIndividual.php"?>');
        jQuery('div_falta_'+frmHoraId).hide();
    });
}

jQuery( ".preencheAlunosAuto" ).each(function() {
    var data1 = jQuery(this).data('t1');
    var data2 = jQuery(this).data('t2');
    preencheAlunos(data1, data2);
});

function gravarHorasIndividual(){
	
	var gravado = false, hora, horaNova, idForm;	
		
	$.each(idFormsIndividual_base, function(index) {
	 
	  idForm = idFormsIndividual_base[index][0];
      
	  hora = idFormsIndividual_base[index][1];
	  horaNova = $('#' + idForm).find('input[type=text].hora:first').val();  
      	   
	  //VERIFICA SE CAMPO NAO ESTA EM BRANCO E DIFERENTE DO VALOR INICIAL
	  if( hora != horaNova ){
			gravado = true;
			postForm(idForm, '<?php echo CAMINHO_REL."grupo/include/acao/diaAulaFFIndividual.php"?>')			
	  }	
			  
	});
	
	if( !gravado ){
		alerta('Nenhum dia foi alterado.');	
	}else{
		$('#aba_div_ff_individual').click();
	}
	
	idFormsIndividual_base = carregarValorFormsInicial_individual();
	
}


function carregarValorFormsInicial_individual(){	
	var idForms = new Array()
	$('form.ff_individual').each(function(i) { 		
		idForms[i] = new Array();		
		idForms[i][0] = $(this).attr('id'); 
		idForms[i][1] = $(this).find('input[type=text].hora').val();
    });	
	return idForms;
}

var idFormsIndividual_base = carregarValorFormsInicial_individual();

ativarForm();

function addAtestado(x) {
	$('#atestadoDia').val(x);
	}

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_file').on('change', function(){
	
	var x = $('#atestadoDia').val();

	$('#visualizarFile_'+x+'').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile').ajaxForm({
		target:'#visualizarFile_'+x+'' // o callback será no elemento com o id #visualizar
	}).submit();

});
</script> 
