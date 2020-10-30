<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."mpdf60/mpdf.php");

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
$PeriodoAcompanhamentoCurso = new PeriodoAcompanhamentoCurso();
$RelatorioDesempenho = new RelatorioDesempenho();

$EndecoVirtual = new EnderecoVirtual();
$Telefone = new Telefone();

$idFolhaFrequencia = $_REQUEST['id'];

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

$html2 .= "<div style='width:100%'><img style='width:100%;' src=".CAMINHO_IMG2."_cabecalho.png></div>

<div><fieldset><legend>Folha de frequência individual</legend>
    
  <p>Grupo: <strong>".$grupoNome."</strong></p>
  <p>Professor: <strong>".$Professor->getNome($idProfessor)."</strong></p>
  <p>Período: <strong>".$mesRef."/".$anoRef."</strong></p>";
  
 foreach($rsIntegranteGrupo as $valorIntegranteGrupo){ 
 $html2 .= "<p> 
     <strong>Aluno: </strong>".$IntegranteGrupo->getNomePF($valorIntegranteGrupo['idIntegranteGrupo'], true)."<br />
     <strong>Telefone:</strong>".$IntegranteGrupo->getTelefone($valorIntegranteGrupo['idIntegranteGrupo'])."<br />
     <strong>Email:</strong>".$IntegranteGrupo->getEmail($valorIntegranteGrupo['idIntegranteGrupo'])."<br /> 
     </p>  ";
     } 
 
 $html2 .=" </div> <div>
  <table width=\"100%\" id=\"tb_lista_FolhaFrequencia_form_individual\" class=\"registros\" border=\"2\">
     <thead>
      <tr>
        <th>Data</th>
        <th>Dia da semana</th>
        <th>Período</th>
        <th>Horas dadas</th>";
        foreach($rsIntegranteGrupo as $valorIntegranteGrupo){
          
		$html2 .= "  <th>".$IntegranteGrupo->getNomePF($valorIntegranteGrupo['idIntegranteGrupo'], true)."</th>";
        }
      $html2 .= "</tr>
	  </thead>
	  <tbody>";			 
      
      $temAulaPermanenteGrupo = $AulaPermanenteGrupo->ffTem_AulaPermanenteGrupo($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor);
      $temAulaDataFixa = $AulaDataFixa->ffTem_AulaDataFixa($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor);
      $rsDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE aulaInexistente = 0 AND folhaFrequencia_idFolhaFrequencia = ".$idFolhaFrequencia. " ORDER BY dataAula");			  
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
								
				if( $continua ) {
					
					if ($reposicao) {
						$classR = "reposicao";	
					} else {
						$classR = "";
					}
					
$html2 .= "<tr align=\"center\" class=\"".$classR."\" />

						
						<!--DIA-->
						<td >".$dia."</td>
						
						<!--DIA DA SEMANA-->
						<td>".Uteis::exibirDiaSemana($diaDaSemanaAtual)."</td>
						
						<!--HORARIO DA AULA -->
						<td>";
						if( !$reposicao && $horaInicio && $horaFim){
						$html2 .= "	das ".Uteis::exibirHoras($horaInicio)." às ".Uteis::exibirHoras($horaFim)."";
						}
			$html2 .= "			</td>
						
						<!--HORAS DE AULA-->
						<td>".Uteis::exibirHoras($horasTotal)."";					
						if($idOcorrenciaFF){
							$ocor = $OcorrenciaFF->selectOcorrenciaFF(" WHERE idOcorrenciaFF = ".$idOcorrenciaFF);
							$html2 .=  " - <font color=\"#FF0000\">".$ocor[0]['sigla']."</font>";
						}				
						
					if ($horasTotal == "0") {
						$classR2 = 'class="preencheAlunosAuto" data-t1="horaRealizadaAluno_'.$idDiaAulaFF.'_base" data-t2="dia_'.$idDiaAulaFF.'"';
					} else {
						$classR2 = '';
					}
					if ($finalizar) {
						$styleR = "display:none";
					} else {
						$styleR = "";
					}
				
			
				
//	$html2 .= "	<img src=".CAMINHO_IMG."seta.png"." title=\"Preenchimento automático\" ".$classR2." onclick=\"preencheAlunos('horaRealizadaAluno_".$idDiaAulaFF."_base', 'dia_".$idDiaAulaFF."')".$styleR." />
//	<input type=\"hidden\" id=\"horaRealizadaAluno_".$idDiaAulaFF."_base\" value=\"".Uteis::exibirHorasInput($horasTotal)."\" /></td>
						
//						<!--HORAS DADAS / OCORRENCIA-->
//						"; 		
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
							
							$difHoras = $horasTotal - $horaRealizadaAluno;
							
							
    $html2 .= "          <td align=\"center\">
              <div id=\"".$nomeCampo."\"></div>";
					 if($finalizar){                				
								
						$html2 .= Uteis::exibirHoras($horaRealizadaAluno, TRUE)."
								                   
								
							<div id=\"".$nomeCampo."_".$idDiaAulaFFIndividual."\"><small><br /><font color=\"#FF0000\">";
								if( $difHoras >= 0){
									if($faltaJustificada){
		$html2 .=  $obsFaltaJustificada;										
$html2 .= "<img src=\"".CAMINHO_IMG."excluir.png\" title=\"Excluir justificativa\" onclick=\"excluiJustificativa('".$idDiaAulaFFIndividual."', '". $nomeCampo."')\" />";
		$html2 .= "<img src=\"".CAMINHO_IMG."editar.png\" title=\"Editar justificativa\"
											onclick=\"editarJustificativa('".$idDiaAulaFFIndividual."', '".$nomeCampo."', '".$obsFaltaJustificada."')\" />";

										
										
										}else{
											
											
                                           if($horaRealizadaAluno!= '' && $difHoras > 0 || $horaRealizadaAluno == 0){
																
													$title = $faltaJustificada ? "Falta justificada:\n".$obsFaltaJustificada : "Justificar falta";
$html2 .= "&nbsp;&nbsp	<img src=\"".CAMINHO_IMG."pa.png\" title=\"".$title."\"	onclick=\"justificaFalta('".$idDiaAulaFFIndividual."', '".$nomeCampo."', '". $obsFaltaJustificada."')\" />";
                                                    
                                                   } 
												//echo "não justificada";
										}
								}
										$html2 .=  "</font></small>	</div>";
								
							}else{ 
								
								//VERIFICA SE O ALUNO JA SAIU NESTA DATA																
								if( $dataEntrada_aluno <= $dataAula && (!$dataSaida_aluno || ( $dataSaida_aluno && $dataSaida_aluno >= $dataAula)) ){ 
               /* 
	$html2 .= "	<form id=\"form_".$nomeCampo."\" class=\"validate ff_individual\" method=\"post\" action=\"\" onsubmit=\"return false\"  >
				<input type=\"hidden\" name=\"idDiaAulaFFIndividual_".$nomeCampo."\" id=\"idDiaAulaFFIndividual_".$nomeCampo."\" value=\"".$idDiaAulaFFIndividual."\" />
				<input type=\"hidden\" name=\"idDiaAulaFF_".$nomeCampo."\" 	id=\"idDiaAulaFF_".$nomeCampo."\" value=\"".$idDiaAulaFF."\" />
				<input type=\"hidden\" name=\"idIntegranteGrupo_".$nomeCampo."\" id=\"idIntegranteGrupo_".$nomeCampo."\" value=\"".$idIntegranteGrupo."\" />
				<input type=\"hidden\" name=\"horasTotal_".$nomeCampo."\" id=\"horasTotal_".$nomeCampo."\"  value=\"".$horasTotal."\" />
				<input type=\"hidden\" name=\"diaAulaExibir_".$nomeCampo."\" id=\"diaAulaExibir_".$nomeCampo."\" value=\"".$dataAula."\" />
				<input type=\"hidden\" name=\"nomeCampo\" value=\"".$nomeCampo."\" />
				<p>
                <input type=\"text\" name=\"horaRealizadaAluno_".$nomeCampo."\"   data-frm=\"".$nomeCampo."\"
                                                    class=\"hora8 required dia_".$idDiaAulaFF."\" size=\"5\"
												    id=\"horaRealizadaAluno_".$nomeCampo."\" value=\"".Uteis::exibirHorasInput($horaRealizadaAluno)."\" />
												<span class=\"placeholder\"></span>
												
												<font id=\"div_falta_".$nomeCampo."\" >";
												  if($horaRealizadaAluno!= '' && $difHoras > 0 || $horaRealizadaAluno == 0){
																
													$title = $faltaJustificada ? "Falta justificada:\n".$obsFaltaJustificada : "Justificar falta";
			$html2 .="								&nbsp;&nbsp
													<img src=\"".CAMINHO_IMG."pa.png\" title=\"".$title."\"
													onclick=\"justificaFalta('". $idDiaAulaFFIndividual."', '".$nomeCampo."', '".$obsFaltaJustificada."')\" />";
													
													if($faltaJustificada){
												$html2 .="		&nbsp;&nbsp
														<img src=\"".CAMINHO_IMG."excluir.png\" title=\"Excluir justificativa\"
														onclick=\"excluiJustificativa('".$idDiaAulaFFIndividual."', '".$nomeCampo."')\" />";
													 }
											
												}
									$html2 .= "	</font>	</p></form>";*/
                                        
                                            if($horasTotal=='0'){
                                                $html2 .=  "<div  onload=\"preencheAlunos('horaRealizadaAluno_".$idDiaAulaFF."_base', 'dia_".$idDiaAulaFF."');\"></div>";
                                            }
                                       
                    
								 }
																	
							}	
              						
           $html2 .= "   </td>";
              
						 } 
		$html2 .= "		</tr>";
          
       }
				
			}
   $html2 .= " </tbody>
    
   <tfoot>  
   <tr >";       	
      	if($finalizadaPrincipal){
      		
	      	$Relatorio = new Relatorio();
					$rsH = $Relatorio->relatorioFrequencia_mensal(" WHERE FF.idFolhaFrequencia = $idFolhaFrequencia");
					$totalHorasProgramadas = $rsH[0]['horasProgramadas'];
					$totalHorasAssistidas = $rsH[0]['horasRealizadasPeloGrupo'] + $rsH[0]['somarCom_horasRealizadasPeloGrupo'];
					$contadorDias = $rsH[0]['diasAula_total'];
	      
	      $html2 .= "  <th colspan=\"2\">".$contadorDias."dias</th>
	        <th>".Uteis::exibirHoras($totalHorasProgramadas)."</th>
	        <th>".Uteis::exibirHoras($totalHorasAssistidas)."</th>        ";
	        
	        if( $rsIntegranteGrupo ){
		        
		        foreach($rsIntegranteGrupo as $valorIntegranteGrupo){	        		
		        	$rsH = $Relatorio->relatorioFrequencia_mensal(" WHERE FF.idFolhaFrequencia = $idFolhaFrequencia AND IG.idIntegranteGrupo = ".$valorIntegranteGrupo['idIntegranteGrupo']);
		        	
		        
		        	
		        $html2 .="	<th>".Uteis::exibirHoras($rsH[0]['horaRealizadaAluno'])."</th>";
		        	
		         }
					}
					
				}else{
						
		$html2 .= "	<th>Data</th>
		            <th>Dia da semana</th>
	                <th>Período</th>
	                <th>Horas dadas</th>";
	        foreach($rsIntegranteGrupo as $valorIntegranteGrupo){
	        	$html2 .= "<th>".$IntegranteGrupo->getNomePF($valorIntegranteGrupo['idIntegranteGrupo'], true)."</th>";
	         }
      		
      	 }
		 
      $html2 .= "	
      </tr>
    </tfoot>
   
 </table>
  </div>
</fieldset>";
  
 // <div class=\"esquerda\">";
 //    if(!$finalizar){
 //  $html2 .= " <button class=\"button gray\" onclick=\"gravarHorasIndividual();\" >Gravar</button>";
 //    }
	
	
	 $html2 .= "</div>
</fieldset>
<fieldset>
  <legend>Nota Mensal - Habilidade e Atitude</legend>";
 
 $dateU = date("Y-m-t", strtotime($anoRef . "-" . $mesRef . "-01"));
 
 $valorPeriodo = $PeriodoAcompanhamentoCurso->selectPeriodoAcompanhamentoCurso(" WHERE mes = " . $mesRef . " AND ano = " . $anoRef);
                $idPeriodoAcompanhamentoCurso = $valorPeriodo[0]['idPeriodoAcompanhamentoCurso'];

//Buscar se já existe
                $rsAcomapanhamentoCurso = $AcompanhamentoCurso->selectAcompanhamentoCurso("WHERE planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . "  AND periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso = " . $idPeriodoAcompanhamentoCurso . " AND (arquivado = 0 OR arquivado is null) ");

                $idAcompanhamentoCurso = $rsAcomapanhamentoCurso[0]['idAcompanhamentoCurso'];
 
  foreach($rsIntegranteGrupo as $valorIntegranteGrupo){
	  
	  $idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
	  
	  
	  $nota1 = $RelatorioDesempenho->selectRelatorioDesempenhoTr(" AND acompanhamentoCurso_idAcompanhamentoCurso = " . $idAcompanhamentoCurso . " AND integranteGrupo_idIntegranteGrupo = " . $idIntegranteGrupo, $idAcompanhamentoCurso, $idIntegranteGrupo, $mesRef, 1);

                $media1 = $RelatorioDesempenho->selectRelatorioDesempenhoTr(" AND acompanhamentoCurso_idAcompanhamentoCurso = " . $idAcompanhamentoCurso . " AND integranteGrupo_idIntegranteGrupo = " . $idIntegranteGrupo, $idAcompanhamentoCurso, $idIntegranteGrupo, $mesRef, 1, 1);
				
				$observacao = $RelatorioDesempenho->selectRelatorioDesempenhoTrObs(" AND acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso." AND integranteGrupo_idIntegranteGrupo = ".$idIntegranteGrupo, $idAcompanhamentoCurso, $idIntegranteGrupo, $mesRef);

                $sql = "SELECT SQL_CACHE TRD.idTipoItenRelatorioDesempenho, TRD.nome,  IRD.orientacao
			FROM tipoItenRelatorioDesempenho AS TRD
			INNER JOIN itenRelatorioDesempenho AS IRD on IRD.tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho = TRD.idTipoItenRelatorioDesempenho
			WHERE TRD.inativo = 0 AND (avaliacao = $mesRef or reavaliacao = $mesRef)";
//			echo $sql;
                $result = Uteis::executarQuery($sql);

                $habilidade = $result[0]['nome'];
                $textoAtitude = $result[1]['orientacao'];

                if ($media1[0] > 0 && $media1[1] > 0) {
                    $x = ($media1[0] + $media1[1]) / 2;

                }

                $mystring = $nota1;
                $findme = ']';

                $texto1 = substr($nota1, 1, 2);
                $texto1 = str_replace(']', '', $texto1);

                $pos = strripos($mystring, $findme);
                $pos = $pos - 2;

                $texto2 = substr($nota1, $pos);
                $texto2 = str_replace(']', '', $texto2);
				$texto2 = str_replace('[','',$texto2);

                $texto3 = str_replace('média', 'Total ', $media1);

                $html2 .= "
				<strong>Aluno: </strong>".$IntegranteGrupo->getNomePF($valorIntegranteGrupo['idIntegranteGrupo'], true)."<br />
        <p><label><strong>1º Nota:</strong> " . $habilidade . ": " . $texto1 . " </label></p>
        <p><label><strong>2º Nota: </strong> Atitude : " . $texto2 . $textoAtitude . " </label></p>
		<p><label><strong>Observações: </strong></label></p><p>".$observacao."</p><hr style=\"size:2;\">";
		
	    
  }
 
 
 
 
 
 
$html2 .= " </fieldset>";


 $html2 .= "<div style='width:100%'><img style='width:100%;' src=".CAMINHO_IMG2."_rodape.png></div>";
/*
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
</script> 
*/

//echo $html2;

	$mpdf=new mPDF('utf-8', 'A4-L'); 
	$mpdf->SetDisplayMode('fullpage');
//---	$css = file_get_contents("css/estilo.css");
//---	$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($html2);
    $mpdf->Output();
	
	?>