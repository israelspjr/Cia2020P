<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PsaIntegranteGrupo = new PsaIntegranteGrupo();
$RespostaPsaProfessor = new RespostaPsaProfessor();
$RespostaPsaRegular = new RespostaPsaRegular();	
$IntegranteGrupo = new IntegranteGrupo();
$NotasTipoNota = new NotasTipoNota();
$Professor = new Professor();

$idPsaIntegranteGrupo = $_GET['id'];
$idIntegranteGrupo = $_GET['idIntegranteGrupo'];
$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];

$where = " WHERE psaIntegranteGrupo_idPsaIntegranteGrupo = ".$idPsaIntegranteGrupo." AND pp.inativo = 0 AND pp.excluido = 0 ORDER BY pp.idPsaProfessor ASC";
$respostasProfessor = $RespostaPsaProfessor->selectRespostaPsaProfessor($where);

$where = " WHERE psaIntegranteGrupo_idPsaIntegranteGrupo = ".$idPsaIntegranteGrupo."  AND pp.excluido = 0 ORDER BY pp.idPsa ASC ";
$respostasRegular = $RespostaPsaRegular->selectRespostaPsaRegular($where);
Uteis::pr($respostasRegular);
$rsPsaIntegranteGrupo = $PsaIntegranteGrupo->selectPsaIntegranteGrupo(" WHERE idPsaIntegranteGrupo = ".$idPsaIntegranteGrupo);
$finalizado = $rsPsaIntegranteGrupo[0]['finalizado'];
$dataReferencia = Uteis::exibirData($rsPsaIntegranteGrupo[0]['dataReferencia']);

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  
  <fieldset>
  
  <legend>ACES</legend>
  
  <?php 
  if($respostasProfessor){ 
	  foreach($respostasProfessor as $valor){
		
			$idRespostaPsaProfessor = $valor['idRespostaPsaProfessor'];
			$psaProfessor_idPsaProfessor = $valor['psaProfessor_idPsaProfessor'];
			$professor_idProfessor = $valor['professor_idProfessor'];
			$titulo = $valor['titulo'];
			$pergunta = $valor['pergunta'];
			$nota = $valor['notasTipoNota_idNotasTipoNota'];
			$tipo = $valor['tipo'];
			$obs = $valor['obs']; ?>
      
			<div class="linha-inteira">
        
        <p><strong><?php echo strtoupper($titulo)?></strong></p>					
        <p><strong><?php echo $pergunta?></strong></p>
        
        <div class="tab2">
        
				<?php if( $finalizado ){ 
			
					if( $nota ){					
						echo "<p><label>Resposta: <strong>".$NotasTipoNota->getNome($nota)."</strong></label></p>
						<p><label>Professor: <strong>".$Professor->getNome($professor_idProfessor)."</strong></label></p>".
						( $obs ? "<p><label>Observação: <strong>$obs</strong></label></p>" : "" );
					}else{
						echo "<p>----</p>";
					}
					
				}else{ ?>
          
          <form id="form_clientepf_professor_<?php echo $idRespostaPsaProfessor.$idIntegranteGrupo?>" 
          class="validate psa" action="" method="post"  onsubmit="return false" >                        
            <input type="hidden" name="action" value="<?php echo CAMINHO_REL."grupo/include/acao/gravarPsa.php?idRespostaPsaProfessor=".$idRespostaPsaProfessor?>" />
            <input type="hidden" name="psaProfessor_idPsaProfessor" value="<?php echo $psaProfessor_idPsaProfessor?>" />
            <p>
            <label>Resposta:</label>
            <?php echo $NotasTipoNota->selectNotasTipoNotaSelect("", "$nota", " AND inativo = 0 AND tipoNota_idTipoNota = ".$tipo)?>
            <span class="placeholder">Campo obrigatório</span></p>
            
                        
            <p><label>Professor :</label>
            <?php echo $IntegranteGrupo->select_professoresIntegranteGrupoPsa($idIntegranteGrupo, $professor_idProfessor, "")?> <!--"required")?>
           <!-- <span class="placeholder">Campo obrigatório</span></p>-->
           </p>
     <!--      <label>OU</label>

            <p><label>Outros Professores:</label>
            <?php //echo $Professor->selectProfessorSelect("",$professor_idProfessor,"");?>
            </p>
            -->
            <p><label>Observação:</label><textarea id="obs" name="obs"><?php echo $obs?></textarea></p>              
					</form>
          
				<?php }?>
        
      	</div>
        
			</div>
      
		<?php }
  }
  

  
  $nps = $respostasRegular[0];
  unset($respostasRegular[0]);
  $respostasRegular[5] = $nps;
  
  if($respostasRegular){ 
	  foreach($respostasRegular as $valor){
		
			$idRespostaPsaRegular = $valor['idRespostaPsaRegular'];
			$psaRegular_idPsa = $valor['psaRegular_idPsa'];			
			$titulo = $valor['titulo'];
			$pergunta = $valor['pergunta'];
			$nota = $valor['notasTipoNota_idNotasTipoNota'];
			$tipo = $valor['tipo'];
			$obs = $valor['obs']; ?>
      
      <div class="linha-inteira">
      
      	<p><strong><?php echo strtoupper($titulo)?></strong></p>					
				<p><strong><?php echo $pergunta?></strong></p>
				
        <div class="tab2">
        
				<?php if( $finalizado ){ 
        
					if( $nota ){			
				 		echo "<p><label>Resposta: <strong>".$NotasTipoNota->getNome($nota)."</strong></label></p>".
          	( $obs ? "<p><label>Observação: <strong>$obs</strong></label></p>" : "" );
       		}else{
						echo "<p>----</p>";
					}
        }else{ ?>
          
          <form id="form_clientepf_regular_<?php echo $idRespostaPsaRegular.$idIntegranteGrupo?>" 
          class="validate psa" action="" method="post"  onsubmit="return false" >          
            <input type="hidden" name="action" value="<?php echo CAMINHO_REL."grupo/include/acao/gravarPsa.php?idRespostaPsaRegular=".$idRespostaPsaRegular?>" />
            <input type="hidden" name="psaRegular_idPsa" value="<?php echo $psaRegular_idPsa?>" />
             <p>
              <label>Resposta:</label>
               <?php 
              if($tipo != 3):
              echo $NotasTipoNota->selectNotasTipoNotaSelect("", $nota, " AND inativo = 0 AND tipoNota_idTipoNota = ".$tipo)
              ?> 
              <span class="placeholder">Campo obrigatório</span></p>
              <p><label>Observação:</label>
              <textarea id="obs" name="obs" class=""><?php echo $obs?></textarea></p> 
            <?php 
              else:
            ?>
            <p><label>Resposta:</label>
             <textarea id="dissertativa" name="dissertativa" class="required" style="margin: 0px; width: 671px; height: 158px;"><?php echo $obs?></textarea>
             <span class="placeholder">Campo obrigatório</span></p>
            <?php  
               endif;
              ?>          
          </form>
          
        <?php }?>
      	</div>
			</div>
      
		<?php }
  }
	
	if( $respostasProfessor || $respostasRegular ){ ?>
	
		<?php if($finalizado != 1 ){ ?>
    
    	<p><button class="button gray" onclick="gravarRespostas()">Gravar respostas</button></p>
    
      <p><button class="button blue" onclick="postForm('', '<?php echo CAMINHO_REL."grupo/include/acao/perguntasPsa.php"?>', '<?php echo "idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&idPsaIntegranteGrupo=".$idPsaIntegranteGrupo."&dataReferencia=".$dataReferencia."&acao=finalizar"?>')">Finalizar ACES</button></p>
      
    <?php }else{ ?>    
      <p><button class="button blue" onclick="postForm('', '<?php echo CAMINHO_REL."grupo/include/acao/perguntasPsa.php"?>', '<?php echo "idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&idPsaIntegranteGrupo=".$idPsaIntegranteGrupo."&dataReferencia=".$dataReferencia."&acao=desfinalizar"?>')">Desfinalizar ACES</button></p>
  <?php }
    }?>
  
  </fieldset>
  
<script>

ativarForm();

function gravarRespostas(){
	
	var gravado = false, idForm, resp, prof, obs, respNova, profNova, obsNova, action
	$.each(idForms_base, function(index) {       
	 
	  idForm = idForms_base[index][0];      	  
			resp = idForms_base[index][1];
			prof = idForms_base[index][2];
			obs = idForms_base[index][3];
		
		respNova = $('#' + idForm).find('select[name=idNotasTipoNota]:first').val();
		profNova = $('#' + idForm).find('select[name=idProfessor]:first').val();
		obsNova = $('#' + idForm).find('input[name=obs]:first').val();
		
	  //VERIFICA SE CAMPO NAO ESTA EM BRANCO E DIFERENTE DO VALOR INICIAL
	  if( respNova != resp || profNova != prof  || obsNova != obs ){			
			gravado = true;	
			action = $('#' + idForm).find('input[name=action]:first').val();				
			postForm(idForm, action);							
	 }		
		  
	});
	
	if( !gravado ) alerta('Nenhuma resposta foi alterada.');	
	idForms_base = carregarValorFormsInicial();
}

function carregarValorFormsInicial(){	
	var idForms = new Array()
	$('form.psa').each(function(i) { 		
		idForms[i] = new Array();		
		idForms[i][0] = $(this).attr('id'); 
		idForms[i][1] = $(this).find('select[name=idNotasTipoNota]:first').val();
		idForms[i][2] = $(this).find('select[name=idProfessor]:first').val();
		idForms[i][3] = $(this).find('textarea[name=obs]:first').val();
  });	
	return idForms;
}

var idForms_base = carregarValorFormsInicial();

</script> 
</div>
