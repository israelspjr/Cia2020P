<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	

$Prova = new Prova();	
$ItenProva = new ItenProva();	
$CalendarioProva = new CalendarioProva();	
$Professor = new Professor();
$AulaGrupoProfessor = new AulaGrupoProfessor();

$AulaDataFixa = new AulaDataFixa();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$IntegranteGrupo = new IntegranteGrupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$NivelEstudoIdioma = new NivelEstudoIdioma();
			
$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];
$idCalendarioProva = $_GET['id'];
//echo $idFolhaFrequencia;
if($idCalendarioProva != '' && $idCalendarioProva  > 0){

	$valorCalendarioProva = $CalendarioProva->selectCalendarioProva('WHERE idCalendarioProva='.$idCalendarioProva);
	
	$idProva = $valorCalendarioProva[0]['prova_idProva'];		
	$idPlanoAcaoGrupo = $valorCalendarioProva[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];	
	$dataPrevistaInicial = $valorCalendarioProva[0]['dataPrevistaInicial'];
	$dataPrevistaNova = $valorCalendarioProva[0]['dataPrevistaNova'];
	$dataAplicacao = $valorCalendarioProva[0]['dataAplicacao'];
	$obs = $valorCalendarioProva[0]['obs'];
		
	
	$rs = $Prova->selectProva(" WHERE idProva = $idProva");
	$nomeProva = $rs[0]['nome'];
}


$idNivel = $PlanoAcaoGrupo->getIdNivel($idPlanoAcaoGrupo);

$valorNivel = $NivelEstudoIdioma->selectNivelEstudoIdioma(" WHERE Nivel_IdNivel = ".$idNivel);
$provaOral = $valorNivel[0]['provaOral'];


?>
<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  	<fieldset>
        <legend><?php echo $nomeProva;?></legend>
        <div class="esquerda">
        <div class="lista" >
            <?php
            $html = "";
            $rsIntegrantes = $IntegranteGrupo->selectIntegranteGrupoFF($idPlanoAcaoGrupo, date('Y-m-d'));
            if( $rsIntegrantes ){
							foreach($rsIntegrantes as $valorIntegrantes){
									
								$idIntegranteGrupo = $valorIntegrantes['idIntegranteGrupo'];				
								$nomeAluno = $IntegranteGrupo->getNomePF($idIntegranteGrupo); ?>
								
								<div class="linha-inteira" data-id="<?php echo $idIntegranteGrupo; ?>">
								
									<img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar" 
									id="img_IntegranteGrupo_<?php echo $idIntegranteGrupo?>" onclick="abrirFormulario('div_IntegranteGrupo_<?php echo $idIntegranteGrupo?>', 'img_IntegranteGrupo_<?php echo $idIntegranteGrupo?>')" />
									<strong><?php echo $nomeAluno?> - Média: <span data-media="0" class="media<?php echo $idIntegranteGrupo;?>">0</span></strong>
									
									<div class="agrupa" id="div_IntegranteGrupo_<?php echo $idIntegranteGrupo?>" >
									
										<?php 	
										
										$where = " WHERE inativo = 0 AND prova_idProva = ".$idProva;
										
										if ($provaOral == 0) {
										$where .= " AND nome != 'Nota Oral Avaliador'";	
											
										}
														
										$rsItens = $ItenProva->selectItenProva($where);
									
										if( $rsItens ){
											foreach($rsItens as $valor){
													
												$idItenProva = $valor['idItenProva'];
												$nomeProva = $valor['nome']; 
					
												$campo = $idItenProva."_".$idIntegranteGrupo;
												?>
													
												<div class="linha-inteira tab2">
													<p><?php echo $nomeProva?></p>						
																											
													<?php 	
													$sql = "SELECT SQL_CACHE nota, anexo, professor_idProfessor, idItemCalendarioProva, data, obs 
													FROM itemCalendarioProva 
													WHERE calendarioProva_idCalendarioProva=".$idCalendarioProva." 
													AND integranteGrupo_idIntegranteGrupo=".$idIntegranteGrupo." 
													AND itenProva_idItenProva=".$idItenProva;								
													$rsNota = mysqli_fetch_array($Prova->query($sql));
													
													$aulaFixaIds = $AulaDataFixa->selectAulaDataFixa(" AND planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
													$aulaPermanenteIds = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
									
													$aulaFixaIds = implode(",",Uteis::arrayCampoEspecifico($aulaFixaIds,'idAulaDataFixa'));
													$aulaFixaIds = $aulaFixaIds ? $aulaFixaIds : "0";
													
													$aulaPermanenteIds = implode(",",Uteis::arrayCampoEspecifico($aulaPermanenteIds,'idAulaPermanenteGrupo'));
													$aulaPermanenteIds = $aulaPermanenteIds ? $aulaPermanenteIds : "0";
													
											    	$rsProf = $IntegranteGrupo->select_professoresIntegranteGrupoPsa($idIntegranteGrupo,$rsNota['professor_idProfessor'],"");
												
													?>
													
													<form id="formulario_upload_nota_<?php echo $campo?>" method="post" 
													style="display:none;" enctype="multipart/form-data" action="<?php echo CAMINHO_REL."grupo/include/acao/nota.php"?>" >
													
															<input type="hidden" name="acao" value="upload" />
															
															<input type="hidden" name="destino" value="#visualizar_contrato<?php echo $campo?>" />

															<input type="file" name="file" id="add_file_contrato<?php echo $campo?>"
															onchange="postFileForm('formulario_upload_nota_<?php echo $campo?>')" /> 
															
													</form>
													
													<form id="form_nota<?php echo $campo?>" class="validate prova" method="post" onsubmit="return false" >
                                                    </label></p>
                                                            <p><label><input name="obs" type="checkbox" id="obs<?php echo $campo?>" value="1" <?php if ($rsNota['obs'] == 1) { echo "checked" ; }?>/>
															Aluno não fez prova</label>	
																															
															<input name="idIntegranteGrupo" type="hidden" 
															value="<?php echo $idIntegranteGrupo?>" />
															
															<input name="idCalendarioProva" type="hidden" 
															value="<?php echo $idCalendarioProva?>" />
											
															<input id="idItemCalendarioProva<?php echo $campo?>" 
															name="idItemCalendarioProva" type="hidden" 
															value="<?php echo $rsNota['idItemCalendarioProva']?>" />
															
															<input name="idItenProva" type="hidden" value="<?php echo $idItenProva?>" />
													
															<p><label>Nota:
																	<input name="nota" id="nota" class="nota" maxlength="3" data-id="<?php echo $idIntegranteGrupo;?>" type="text"
																	value="<?php echo Uteis::exibirMoeda($rsNota['nota'])?>" onkeyup="somaNotas(this);" >
															</label></p>

                                                            <p><label>Data:
                                                                <input name="data" id="data<?php echo $campo?>" class="data" maxlength="10" type="text"
                                                                       value="<?php echo Uteis::exibirData($rsNota['data'])?>">
                                                            </label></p>
															
															<p><label>Professor:<?php echo $rsProf?><span class="placeholder"></span></label></p>
																							
															<p><label>Anexo: 
							
															
															<img id="anexar<?php echo $campo?>" 
															src="<?php echo CAMINHO_IMG."upload_file.png"?>" title="Anexar" 
															onclick="$('#add_file_contrato<?php echo $campo?>').click()" />
															&nbsp;&nbsp;
															
															<font id="visualizar_contrato<?php echo $campo?>" >
																<?php if( $rsNota['anexo'] ){?>
																		<a href="<?php echo CAMINHO_UP."/anexonota/".$rsNota['anexo']?>" target="_blank" >
																		<img src="<?php echo CAMINHO_IMG."contrato.png"?>" title="Visualizar" /></a>	                                            
																<?php }?>                                
																<input name="anexo" type="hidden" value="<?php echo $rsNota['anexo']?>" id="anexo<?php echo $campo?>"/>							
															</font> 
																															
																														
													</form>                                 
													
												</div>                      
												
											<?php }
										}?>
									</div>
								
								</div>
									
							<?php }	?>
          <!--    <p><button class="button gray" onclick="gravarNotas()">Gravar notas</button></p>-->
            <?php }?>
        
        </div>
 </div>
<div class="direita">
 <form id="form_CalendarioProva" class="validate" method="post" action="" onsubmit="return false" >
        <input name="idPlanoAcaoGrupo" type="hidden" value="<?php echo $idPlanoAcaoGrupo?>" />
        <p>
          <label>Prova:</label>
          <?php 
					if($idProva){
							$rs = $Prova->selectProva(" WHERE idProva = $idProva");
							echo "<strong>".$rs[0]['nome']."</strong>";
							echo "<input type=\"hidden\" name=\"idProva\" value=\"".$idProva."\" />";
					}else{
							echo $Prova->selectProvaDisponivel($idPlanoAcaoGrupo, $idProva);
					}?>
        </p>
        
         <p>
        <label><strong>Itens da Prova:</strong></label>
      	<div id="itensProva" class="tab2"></div>
      </p>
        <p>
          <label>Data Prevista Inicial:</label>
          <input type="text" name="dataPrevistaInicial" id="dataPrevistaInicial" class="required data" value="<?php echo Uteis::exibirData($dataPrevistaInicial)?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Nova Data Prevista:</label>
          <input type="text" name="dataPrevistaNova" id="dataPrevistaNova" class="data" value="<?php echo Uteis::exibirData($dataPrevistaNova)?>" />
        </p>
        <p>
          <label>Data da aplicação:</label>
          <input type="text" name="dataAplicacao" id="dataAplicacao" class="data" value="<?php echo Uteis::exibirData($dataAplicacao)?>" />
        </p>
        <p>
          <label>Observação:</label>
          <textarea name="obs" id="obs" class="" cols="40" rows="4"><?php echo $obs?></textarea>
          <span class="placeholder">Campo Obrigatório</span> </p>
       
      </form>
     
    </div>   	
	</fieldset>
<div class="linhaInteira">
  <p>
          <button class="button blue" onclick="notaEscrita();">
          Salvar</button>
        </p>
        </div>
</div>
 
<script>
ativarForm();

function gravarNotas(){
	
	var gravado = false, idForm, nota, data, prof, anexo, notaNova, profNova, anexoNova, todasnotas = true, obs;
	
	$.each(idForms_base, function(index) {       
	 
	    idForm = idForms_base[index][0];
		nota = idForms_base[index][1];
        data = idForms_base[index][2];
		prof = idForms_base[index][3];
		anexo = idForms_base[index][4];
		obs = idForms_base[index][5];
		
		notaNova = $('#' + idForm).find('input[name=nota]:first').val();
		profNova = $('#' + idForm).find('select[name=idProfessor]:first').val();
		anexoNova = $('#' + idForm).find('input[name=anexo]:first').val();
        dataNova = $('#' + idForm).find('input[name=data]:first').val();
		obsNova = $('#' + idForm).find('input[name=obs]:first').val();

	  //VERIFICA SE CAMPO NAO ESTA EM BRANCO E DIFERENTE DO VALOR INICIAL
	  if( notaNova != nota || profNova != prof  || anexoNova != anexo  || dataNova != data || obsNova != obs ){
			gravado = true;					
			postForm(idForm, '<?php echo CAMINHO_REL."grupo/include/acao/nota.php"?>');							
	  }
      if (notaNova==='' || profNova==='' || dataNova===''){
          todasnotas = false;
      }
	});
    if (todasnotas!=false){
		
        $.ajax({
            method: "get",
            url: "<?php echo CAMINHO_REL."grupo/include/acao/nota.php"?>",
            data: "acao=email&idPlanoAcaoGrupo=<?php echo $idPlanoAcaoGrupo; ?>&data=<?php echo $_GET['data']; ?>&idProfessor="+prof
        });
    }
	postForm('form_CalendarioProva', '<?php echo CAMINHO_REL?>grupo/include/acao/provas.php?id=<?php echo $idCalendarioProva?>');
	if( !gravado ) alerta('Nenhuma nota foi alterada.');	
	idForms_base = carregarValorFormsInicial();
}

function carregarValorFormsInicial(){	
	var idForms = new Array()
	$('form.prova').each(function(i) { 		
		idForms[i] = new Array();		
		idForms[i][0] = $(this).attr('id'); 
		idForms[i][1] = $(this).find('input[name=nota]:first').val();
        idForms[i][3] = $(this).find('input[name=data]:first').val();
		idForms[i][4] = $(this).find('select[name=idProfessor]:first').val();
		idForms[i][5] = $(this).find('input[name=anexo]:first').val();
		idForms[i][6] = $(this).find('input[name=obs]:first').val();
  });	
	return idForms;
}

var idForms_base = carregarValorFormsInicial();

function atualizaIntens(idProva){
	if( idProva ){
		$('#itensProva').load('<?php echo CAMINHO_REL?>grupo/include/acao/itensProva.php?idProva='+idProva);
	}
}

atualizaIntens('<?php echo $idProva?>');

function somaNotas(){
    jQuery('div[data-id]').each(function(){
        var idElem = jQuery(this).data('id');
        var notaTotal = 0;
        var mediaDiv = 0;
        jQuery('input[data-id='+idElem+']').each(function(){
            var nota = jQuery(this).val();
			nota = nota.replace(',', '.');
		if (nota!==''){
                notaTotal += parseFloat(nota);
                mediaDiv++;
            }
        });
    //    console.log(notaTotal);
        media = (notaTotal!==0)? (notaTotal/mediaDiv).toFixed(2) : 0;
        jQuery('.media'+idElem).html(media);
    });
	
	
}

function notaEscrita(){
	var x = 0;
	var y = 0;
	jQuery('div[data-id]').each(function(){
        var idElem = jQuery(this).data('id');
		var nota = $('#form_nota2_'+idElem+' :input[data-id='+idElem+']').val();
		var anexo = $('#anexo2_'+idElem+'').val(); 
		x++;
		if ((nota >0) && (anexo == '')) {
			alert("Não tem anexo, por favor envie a prova digitalizada");
			$('#form_nota2_'+idElem+' :input[data-id='+idElem+']').focus();
			$('#form_nota2_'+idElem+' :input[data-id='+idElem+']').css('box-shadow','0 0 3px #e73013');
		gravarNotas();
			
		} else {
		y++;
		gravarNotas();
		
		}
		
		
	});
	if (x == y) {
		fecharNivel();
	}
}
window.onload = somaNotas();
</script>