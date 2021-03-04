<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

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
$idProfessor = $_SESSION['idProfessor_SS'];
$dataReferencia = $valorFolhaFrequencia[0]['dataReferencia'];
$finalizar = $valorFolhaFrequencia[0]['finalizadaParcial'];
$finalizadaPrincipal = $valorFolhaFrequencia[0]['finalizadaPrincipal'];
$data = explode("-",$dataReferencia);
$mesRef = $data[1];
$anoRef = $data[0];	

$rsIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupoFF($idPlanoAcaoGrupo, $dataReferencia);
?>

<form id="form_uploadFile2" method="post" enctype="multipart/form-data" action="modulos/ff/professor/diaAulaFFIndividualAcao.php" style="display:none">
    <input type="hidden" id="acao" name="acao" value="file" />
    <input type="hidden" id="atestadoDia" name="atestadoDia" value="" />
    <input type="file" id="add_file" name="file" />
  </form>
  
<fieldset>
  <legend>Folha de frequência individual</legend>
  <button class="Bblue" onclick="carregaGeral()">Folha geral</button>
    
  <p>Grupo: <strong><?php echo $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo)?></strong></p>
  <p>Professor: <strong><?php echo $Professor->getNome($idProfessor)?></strong></p>
  <p>Período: <strong><?php echo "$mesRef/$anoRef"?></strong></p>
  
  <p><button class="button blue" onclick="mostrarAlunos()">Mostrar Alunos</button></p>
  <div id="mostrarAlunos" style="display:none;">
  
  <?php foreach($rsIntegranteGrupo as $valorIntegranteGrupo){?>  
     <p> 
     <strong>Aluno: </strong><?php echo $IntegranteGrupo->getNomePF($valorIntegranteGrupo['idIntegranteGrupo'], true);?><br />
     <strong>Telefone:</strong><?php echo $IntegranteGrupo->getTelefone($valorIntegranteGrupo['idIntegranteGrupo']);?><br />
     <strong>Email:</strong><?php echo $IntegranteGrupo->getEmail($valorIntegranteGrupo['idIntegranteGrupo']);?><br /> 
     </p>  
    <?php }?> 
 </div>
  
  
<?php  //foreach($rsIntegranteGrupo as $valorIntegranteGrupo){ ?>
  <table id="tb_lista_FolhaFrequencia_form_individual" class="registros">
  
    <thead>
      <tr>
        <th>Data</th>
        <th>Dia da semana</th>
        <th>Período</th>
        <th>Horas dadas</th>
    <!--    <th>Aluno: <?php //echo $IntegranteGrupo->getNomePF($valorIntegranteGrupo['idIntegranteGrupo'], true);?>
	</th>
        </tr>-->
        
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
      $temAulaDataFixa = $AulaDataFixa->ffTem_AulaDataFixa($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor);
      
      $rsDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE aulaInexistente = 0 AND folhaFrequencia_idFolhaFrequencia = ".$idFolhaFrequencia);     

 
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
						
						$idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
                        echo Uteis::exibirHoras($horasTotal);                   
                        if($idOcorrenciaFF){
                            $ocor = $OcorrenciaFF->selectOcorrenciaFF(" WHERE idOcorrenciaFF = ".$idOcorrenciaFF);
                            echo " - <font color=\"#FF0000\">".$ocor[0]['sigla']."</font>";
                        }               
                        ?>
                        
                        <img src="<?php echo CAMINHO_IMG."seta.png"?>" title="Preenchimento automático" 
                        onclick="preencheAlunos('<?php echo "horaRealizadaAluno_".$idDiaAulaFF."_base"?>', '<?php echo $idDiaAulaFF?>')" <?php echo $finalizar ? "style=\"display:none;\"" : ""?> />
                        
                        <input type="hidden" id="<?php echo "horaRealizadaAluno_".$idDiaAulaFF."_base"?>" 
                        value="<?php echo Uteis::exibirHorasInput($horasTotal)?>" /></td>
                        
                        <!--HORAS DADAS / OCORRENCIA-->
                        <?php       
                         foreach($rsIntegranteGrupo as $valorIntegranteGrupo){
                                    
                            $idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
                            $dataSaida_aluno = $valorIntegranteGrupo['dataSaida'];
            			    $dataEntrada_aluno = $valorIntegranteGrupo['dataEntrada'];        
                            
                            $nomeCampo = "ff_individual_".$idIntegranteGrupo."_".$idDiaAulaFF;
                      //      $nomeCampo = "ff_individual_".$idDiaAulaFF;
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
              
                            <?php if($finalizar){                               
                                
                                echo Uteis::exibirHoras($horaRealizadaAluno, TRUE);                      
                                
                                if( $difHoras > 0){
                                        echo "<small><br /><font color=\"#FF0000\">";
                                        if($faltaJustificada){
                                                echo "".$obsFaltaJustificada;
												  if( $atestado ){
	?>	<a href="<?php echo CAMINHO_UP."/atestados/".$atestado?>" target="_blank" >
		<img src="<?php echo CAMINHO_IMG."contrato.png"?>" title="Visualizar" /></a>
      <?php			} 
                                        }else{
										?>	
												 <img src="<?php echo CAMINHO_IMG?>upload_file.png" onclick="$('#add_file').click();addAtestado(<?php echo $idDiaAulaFFIndividual?>);" title="Anexar atestado" />
															&nbsp;&nbsp;
															
		<font id="visualizarFile_<?php echo $idDiaAulaFFIndividual?>" >
		<?php if( $atestado2 ){?>
		<a href="<?php echo CAMINHO_UP."/atestados/".$atestado?>" target="_blank" >
		<img src="<?php echo CAMINHO_IMG."contrato.png"?>" title="Visualizar" /></a>
        	    <?php } ?>       
          </font>                       
										<?php	
                                                //echo "não justificada";
                                        }
                                        echo "</font></small>";
                                }
                                
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
                                                <input type="text" name="<?php echo "horaRealizadaAluno_".$nomeCampo?>" class="hora required <?php echo "dia_".$idDiaAulaFF?>" size="5"
                                                id="<?php echo "horaRealizadaAluno_".$nomeCampo?>" value="<?php echo Uteis::exibirHorasInput($horaRealizadaAluno)?>"  />                    
                                                <span class="placeholder"></span> 
                                                
                                                <font id="div_falta_<?php echo $nomeCampo?>" >
                                                
                                                <?php if($horaRealizadaAluno == '0' /*||  $difHoras > 0*/){
                                                                
                                                    $title = $faltaJustificada ? "Falta justificada:\n".$obsFaltaJustificada : "Justificar falta";?>
                                                    &nbsp;&nbsp; 
                                                    <img src="<?php echo CAMINHO_IMG."pa.png"?>" title="<?php echo $title?>"
                                                    onclick="justificaFalta('<?php echo $idDiaAulaFFIndividual?>', '<?php echo $nomeCampo?>', '<?php echo $obsFaltaJustificada?>')" />
                                                    
                                                     <img src="<?php echo CAMINHO_IMG?>upload_file.png" onclick="$('#add_file').click();addAtestado(<?php echo $idDiaAulaFFIndividual?>);" title="Anexar atestado" />
                                                    
      
             <font id="visualizarFile_<?php echo $idDiaAulaFFIndividual?>" >
             
             <?php if( $atestado ){?>
		<a href="<?php echo CAMINHO_UP."/atestados/".$atestado?>" target="_blank" >
		<img src="<?php echo CAMINHO_IMG."contrato.png"?>" title="Visualizar" /></a>
           <?php } ?>
		 
              </font>        
                                          
                                                    
                                                    <?php if($faltaJustificada){?>
                                                        &nbsp;&nbsp;
                                                        <img src="<?php echo CAMINHO_IMG."excluir.png"?>" title="Excluir justificativa"
                                                        onclick="excluiJustificativa('<?php echo $idDiaAulaFFIndividual?>', '<?php echo $nomeCampo?>');" />
                                                    <?php }
                                            
                                                }?>
                                                </font>
                                            </p>
                                        </form>
                    
                                <?php }
								
//								echo "</tr>";
                                                                    
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
          <!--  <th>Aluno</th>-->
            <?php foreach($rsIntegranteGrupo as $valorIntegranteGrupo){?>
               <th><?php echo $IntegranteGrupo->getNomePF($valorIntegranteGrupo['idIntegranteGrupo'], true);?></th>
            <?php }?>
            
        <?php }?>   
        
      </tr>
    </tfoot>
    
  </table>
  <div style="width: 100%;;overflow: hidden;">
      <a onclick="eventRolarParaTopo();" class="button gray" style="float: right; display: block;margin-right:40px">Topo</a>
  </div>
  <div class="esquerda">
    <?php if(!$finalizar){?>
    <button class="button gray" onclick="gravarHorasIndividual();" >Gravar</button>
    <?php }?>
  </div>
</fieldset>

<script>
//tabelaDataTable('tb_lista_FolhaFrequencia_form_individual');

$('tr p, table form').css({'margin':'0'});

function justificaFalta(idDiaAulaFFIndividual, nomeCampo, obsFaltaJustificada){
    
    var justificaFalta = prompt ("Justificativa da falta", obsFaltaJustificada);    
    if(justificaFalta!=null && justificaFalta != 'undefined' ){
        showLoad();
        $.post('modulos/ff/professor/diaAulaFFIndividualAcao.php',{acao:"justificaFalta", idDiaAulaFFIndividual:idDiaAulaFFIndividual, justificaFalta:justificaFalta, nomeCampo:nomeCampo}, function(e){  
            fecharNivel_load();
            acaoJson(e);
        });
    }
}

function excluiJustificativa(idDiaAulaFFIndividual, nomeCampo){ 
    showLoad();
    $.post('modulos/ff/professor/diaAulaFFIndividualAcao.php',{acao:"excluiJustificativa", idDiaAulaFFIndividual:idDiaAulaFFIndividual, nomeCampo:nomeCampo}, function(e){    
        fecharNivel_load();     
        acaoJson(e);
    });
}

function preencheAlunos(id, classe){
	$('#tb_lista_FolhaFrequencia_form_individual').find('input[type=text].dia_'+classe).each(function(){

        preencheCampo(id, $(this).attr('id'));      
    });
//	var horas = $('#'+id).val();

//$('#horaRealizadaAluno_ff_individual_'+idAluno+'_'+classe).val(horas);

}

function gravarHorasIndividual(){
    
    var gravado = false, hora, horaNova, idForm;    
        
    $.each(idFormsIndividual_base, function(index) {
     
      idForm = idFormsIndividual_base[index][0];
      
      hora = idFormsIndividual_base[index][1];
      horaNova = $('#' + idForm).find('input[type=text].hora:first').val();  
           
      //VERIFICA SE CAMPO NAO ESTA EM BRANCO E DIFERENTE DO VALOR INICIAL
      if( hora != horaNova ){
            gravado = true;
            postForm(idForm, '<?php echo "modulos/ff/professor/diaAulaFFIndividualAcao.php"?>')           
      } 
              
    });
    
    if( !gravado ){
        alerta('Nenhum dia foi alterado.'); 
    }else{
		alert("Gravado/Alterado com sucesso!");
  //      $('#aba_div_ff_individual').click();
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

function mostrarAlunos() {
$('#mostrarAlunos').show();	
	
}

function zerarNotas() {
$('#notasMensais').html('');	
	
}

function addAtestado(x) {
	$('#atestadoDia').val(x);
	}

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_file').on('change', function(){
	
	var x = $('#atestadoDia').val();

	$('#visualizarFile_'+x+'').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile2').ajaxForm({
		target:'#visualizarFile_'+x+'' // o callback será no elemento com o id #visualizar
	}).submit();

});

function carregaGeral(){
$('#div_ff_individual').hide();	
$('#div_ff_individualD').hide();
$('#div_ff_geral').show();
$('#div_ff_siglas').hide();
zerarCentro();
carregarModulo('modulos/ff/professor/folhaFrequencia_abas.php?idFolhaFrequencia=<?php echo $idFolhaFrequencia?>&Ndados=', '#centro');
}
</script> 
