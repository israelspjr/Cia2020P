<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FocoCurso = new FocoCurso();
$NivelEstudo = new NivelEstudo();
$ExpectativaInicio = new ExpectativaInicio();
$Idioma = new Idioma();
$Grupo = new Grupo();
$idAnterior = $_REQUEST['idAnterior'];

$randid = rand();
if($idPlanoAcao){

	$valorPlanoAcao = $PlanoAcao->selectPlanoAcao(" WHERE idPlanoAcao = $idPlanoAcao");
	$rsPlanoAcaoGrupo2 = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE planoAcao_idPlanoAcao = $idPlanoAcao");
	$dataTermino = Uteis::exibirData($rsPlanoAcaoGrupo2[0]['dataPrevisaoTerminoEstagio']); 	
	
	$idGrupo = $rsPlanoAcaoGrupo2[0]['grupo_idGrupo']; 
    $proposta_idProposta = $valorPlanoAcao[0]['proposta_idProposta'];	
	$IdNivelEstudo_ant = $valorPlanoAcao[0]['nivelEstudo_IdNivelEstudo']; 		
	$horasPrograma = Uteis::exibirHorasInput($valorPlanoAcao[0]['horasPrograma']); 
	$idFocoCurso = $valorPlanoAcao[0]['focoCurso_idFocoCurso']; 
	$idKitMaterial = $valorPlanoAcao[0]['kitMaterial_idKitMaterial']; 		
	$dataExpectativaInicio = Uteis::exibirData($valorPlanoAcao[0]['dataExpectativaInicio']); 
	$idExpectativaInicio = $valorPlanoAcao[0]['expectativaInicio_idExpectativaInicio'];		
	$abordagemCurso = $valorPlanoAcao[0]['abordagemCurso'];
	$mes = $valorPlanoAcao[0]['mesReferenciaMudanca'];
	$ano = $valorPlanoAcao[0]['anoReferenciaMudanca']; 	
	$tipoContrato = $valorPlanoAcao[0]['tipoContrato'];
	$tipoCurso = $valorPlanoAcao[0]['tipoCurso'];
	$tipoAval = $valorPlanoAcao[0]['tipoAval'];
	$tipoMaterial = $valorPlanoAcao[0]['tipoMaterial'];

	
	$idIdioma = $Grupo->getIdIdioma($idGrupo);
	$nomeGrupo = $Grupo->getNome($idGrupo);
	
	
	
	
}else{

	$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];	
	$mes = $_REQUEST['mes'];
	$ano = $_REQUEST['ano'];

	$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);	
	$nomeGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);
	$rsPlanoAcaoGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = $idPlanoAcaoGrupo");	
	$idGrupo = $rsPlanoAcaoGrupo[0]['grupo_idGrupo'];
	$rsPlanoAcao = $PlanoAcao->selectPlanoAcao(" WHERE idPlanoAcao = ".$rsPlanoAcaoGrupo[0]['planoAcao_idPlanoAcao']);
	$idFocoCurso = $rsPlanoAcao[0]['focoCurso_idFocoCurso'];
	$horasPrograma =  Uteis::exibirHorasInput($rsPlanoAcao[0]['horasPrograma']);
	$IdNivelEstudo_ant = $rsPlanoAcao[0]['nivelEstudo_IdNivelEstudo']; 	
	$dataTermino = Uteis::exibirData($rsPlanoAcaoGrupo[0]['dataPrevisaoTerminoEstagio']); 	
}

$nomeIdioma = $Idioma->getNome($idIdioma);
$tipoHora = strlen($horasPrograma) == 6 ? "checked" : "";
?>

<fieldset>
  <legend>Mudança de estágio</legend>
  <p>Grupo: <strong><?php echo $nomeGrupo?></strong></p>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_PlanoAcao', 'img_');" />
  <div class="agrupa" id="div_form_PlanoAcao" >
    <form id="form_PlanoAcao" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="idPlanoAcao" id="idPlanoAcao" value="<?php echo $idPlanoAcao?>" />
      <input type="hidden" name="grupo_idGrupo" id="grupo_idGrupo" value="<?php echo $idGrupo ?>" />
      <input type="hidden" name="idAnterior" id="idAnterior" value="<?php echo $idAnterior ?>" />
      <input type="hidden" name="proposta_idProposta" id="proposta_idProposta" value="<?php echo $proposta_idProposta ?>" />
      <input type="hidden" name="idIdioma" id="idIdioma" value="<?php echo $idIdioma?>" />
      <input type="hidden" name="acao" id="acao" value="gerar" />
      <div class="esquerda"> <?php echo "<p>Id: <strong>".($idPlanoAcao ? $idPlanoAcao : "NOVO")."</strong></p>" ?>
        <?php if( !$idPlanoAcao ){?>
        <p>
          <label>Mês da mudança:</label>
          <select name="mes" id="mes" class="required">
            <option value="">[Selecione]</option>
            <?php for($x=1; $x <= 12; $x++){ ?>
            <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
            <?php }?>
          </select>
          <span class="placeholder">Campo obrigatório</span></p>
        <p>
          <label>Ano da mudança:</label>
          <select name="ano" id="ano" class="required">
            <option value="">[Selecione]</option>
            <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
            <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
            <?php } ?>
          </select>
          <span class="placeholder">Campo obrigatório</span></p>
        <?php }else{?>
        <p>
          <label>Período da mudança:</label>
          <strong><?php echo "$mes/$ano"?></strong></p>
        <input type="hidden" name="mes" id="mes" value="<?php echo $mes?>" />
        <input type="hidden" name="ano" id="ano" value="<?php echo $ano ?>" />
        <?php }?>
        <p>
          <label>Idioma: <strong><?php echo $nomeIdioma?></strong></label>
        </p>
      <p>
          <label <?php if($idPlanoAcaoGrupo==""){echo "style=\"display:hidden;\"";}?>>Nível anterior:</label>
          <?php
					if( $IdNivelEstudo_ant ){
						echo $NivelEstudo->getNome($IdNivelEstudo_ant);
				/*		echo " <input type=\"hidden\" name=\"IdNivelEstudo\" id=\"IdNivelEstudo\" value=\"$IdNivelEstudo\" />";
					}else{
						$sql = " INNER JOIN nivelEstudoIdioma AS NI ON NI.nivel_IdNivel = N.IdNivelEstudo 
						INNER JOIN idioma AS I ON I.idIdioma = NI.idioma_idIdioma AND I.idIdioma = $idIdioma 
						";
						echo $NivelEstudo->selectNivelEstudoSelect("required inf", "", $sql)."<span class=\"placeholder\">Campo obrigatório</span>";*/
					}?>
          
       	  <label >Novo nível: </label>
          <p>
		  <?=$NivelEstudo->selectNivelEstudoSelect("required inf", "", $sql);?></label>
        </p>
          <p>
        <label>Material Regular:</label>
        <input type="radio" name="tipoMaterial" id="tipoMaterial" class="required" value="0" <?php if($tipoMaterial == 0) { echo "checked= 'checked'"; } ?> /  />SIM <br />      	

<input type="radio" name="tipoMaterial" id="tipoMaterial" class="required" value="1" <?php if($tipoMaterial == 1) { echo "checked= 'checked'"; } ?> /  />NÃO <br />      	
</p>
        <p>
       <div id="focoDoCurso">   <label>Foco do curso:</label>
          <?php $sql = " INNER JOIN focoCursoIdioma AS FI ON FI.focoCurso_idFocoCurso = F.idFocoCurso
    INNER JOIN idioma AS I ON I.idIdioma = FI.idioma_idIdioma AND I.idIdioma = ".$idIdioma;		
    echo $FocoCurso->selectFocoCursoSelect("required inf", $idFocoCurso, $sql) ?>
          <span class="placeholder">Campo obrigatório</span></p>
          </div>
         <p>  
        <div id="kitMaterial"></div>
        </p>
        <p> 
        <div id="nomeMaterial"></div>
        </p>
      </div>
      <div class="direita">
       <p>
      <label> Tipo de contrato:       </label>
      <input type="radio" name="tipoContrato" id="tipoContrato" class="required" value="0" <?php if($tipoContrato == 0) { echo "checked= 'checked'"; } ?> />Prazo indeterminado <br />
      <input type="radio" name="tipoContrato" id="tipoContrato" class="required" value="1" <?php if($tipoContrato == 1) { echo "checked= 'checked'"; } ?>/>Pacote de horas <br />
      <input type="radio" name="tipoContrato" id="tipoContrato" class="required" value="2" <?php if($tipoContrato == 2) { echo "checked= 'checked'"; } ?>/>Prazo Determinado (Verificar Contrato) <br />   
      </p>
       <p>
      <label> Tipo de curso:       </label>
      <input type="radio" name="tipoCurso" id="tipoCurso" class="required" value="0" <?php if($tipoCurso == 0) { echo "checked= 'checked'"; } ?> />Presencial <br />
      <input type="radio" name="tipoCurso" id="tipoCurso" class="required" value="1" <?php if($tipoCurso == 1) { echo "checked= 'checked'"; } ?> />On-line <br />
      <input type="radio" name="tipoCurso" id="tipoCurso" class="required" value="2" <?php if($tipoCurso == 2) { echo "checked= 'checked'"; } ?> />Skype <br />
      
       <input type="radio" name="tipoCurso" id="tipoCurso" class="required" value="3" <?php if($tipoCurso == 3) { echo "checked= 'checked'"; } ?> />ChatClub <br /></p>
        <p>
        <label>Avaliações:</label>
        <input type="radio" name="tipoAval" id="tipoAval" class="required" value="0" <?php if($tipoAval == 0) { echo "checked= 'checked'"; } ?> /  />Avaliação no final do programa <br />      	

<input type="radio" name="tipoAval" id="tipoAval" class="required" value="1" <?php if($tipoAval == 1) { echo "checked= 'checked'"; } ?> /  />Não tem avaliação no programa <br />      	
</p>
        <p>
          <label>Horas do programa:</label>
          <label>
            <input type="checkbox" value="1" name="mudarClassHora" id="mudarClassHora" onchange="mudarClass()" <?php echo $tipoHora?>/>
            usar horas maiores (ou iguais) a 100:00</label>
          <img src="<?php echo CAMINHO_IMG?>/carrega.png" title="Carregar carga horária padrão para este progrma" onclick="atualizarCargaHoraria()" />
          <input type="text" name="horasPrograma_1" id="horasPrograma_1" class="required hora" value="<?php echo $horasPrograma?>" />
          <input type="text" name="horasPrograma_2" id="horasPrograma_2" class="required hora" value="<?php echo $horasPrograma?>" />
          <input type="hidden" name="horasPrograma" id="horasPrograma" class="required hora" value="" />
          <span class="placeholder">Campo obrigatório</span> </p>
        <p>
          <label>Expectativa de início:</label>
          <?php echo $ExpectativaInicio->selectExpectativaInicioSelect("required", $idExpectativaInicio);?><span class="placeholder">Campo obrigatório</span></p>
        <p>
          <label>Data de expectativa de início:</label>
          <input type="text" name="dataExpectativaInicio" id="dataExpectativaInicio" class="data" value="<?php echo $dataExpectativaInicio?>" />
        </p>
        <p>
          <label>Data de previsão de término de estágio:</label>
          <input type="text" name="dataTermino" id="dataTermino" class="data" value="<?php echo $dataTermino?>" />
        </p>
    <!--    <button class="button blue" onclick="Importar(<?=$idAnterior?>)">Importar Dias</button> -->
      </div>
      <div class="linha-inteira">
        <p>
          <label>Abordagem do curso:</label>
          <textarea name="abordagemCurso_base" id="abordagemCurso_base" rows="6" cols="80" ><?php echo $abordagemCurso?></textarea>
         <textarea name="abordagemCurso" id="abordagemCurso" ></textarea>
        </p>
        <p>
  <!--        <button class="button blue" onclick="postTemp();">Salvar</button>-->
        </p>
      </div>
    </form>
  </div>
</fieldset>

<script>

function focoDoCurso(){
	$('#focoDoCurso').html('');	
  var idIdioma = $('#idIdioma').val();

    $.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/planoAcao.php',{acao:"focoDoCurso", idIdioma:idIdioma}, function(e){
    $('#focoDoCurso').html(e);
    }); 
//   Multifuncao();
}

function atualizaKitMaterialINF(){	
	var idKitMaterial = '<?php echo $idKitMaterial?>';
	var idIdioma = '<?php echo $idIdioma?>';
	var idNivelEstudo = $('#IdNivelEstudo').val();
	var idFocoCurso = $('#idFocoCursoIdioma').val();
	if(idFocoCurso != 1){
	   $("#kitMaterial").show();
       $("#nomeMaterial").show();     
	$.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/planoAcao.php',{acao:"atualizaKitMaterialINF", idIdioma:idIdioma, idNivelEstudo:idNivelEstudo, idFocoCurso:idFocoCurso}, function(e){
		$('#div_form_PlanoAcao #kitMaterial').html(e);
	});
	}else{
	   $("#kitMaterial").hide();
	   $("#nomeMaterial").hide(); 
	}	
}


function atualizarCargaHoraria(){
	var idIdioma = '<?php echo $idIdioma?>';
	var idNivelEstudo = $('#IdNivelEstudo').val();
	var idFocoCurso = $('#idFocoCursoIdioma').val();

	$.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/planoAcao.php',{acao:"atualizarCargaHoraria", idIdioma:idIdioma, idNivelEstudo:idNivelEstudo, idFocoCurso:idFocoCurso}, function(e){	
		acaoJson(e)
//		$('#div_form_PlanoAcao #kitMaterial').html(e);
	});
}

//$('#div_form_PlanoAcao .inf').attr('onchange', 'atualizaKitMaterialINF();');
//atualizaKitMaterialINF();

function mudarClass(){
	if( $('#mudarClassHora').is(':checked') ){				
		$('#horasPrograma_1').hide().val('').removeClass('required');
		$('#horasPrograma_2').show().addClass('required');
	}else{
		$('#horasPrograma_2').hide().val('').removeClass('required');
		$('#horasPrograma_1').show().addClass('required');
	}		
}
mudarClass();
/*
function postTemp(){
	mudarClass();
	if( $('#horasPrograma_1').val() != '' ){
		$('#horasPrograma').val( $('#horasPrograma_1').val() )
	}else{
		$('#horasPrograma').val( $('#horasPrograma_2').val() )
	}
	postForm_editor('abordagemCurso', 'form_PlanoAcao', '<?php echo CAMINHO_MODULO."relacionamento/mudanca/include/acao/mudanca.php"?>');
}
*/
viraEditor('abordagemCurso');
/*function Importar(){
	
}
*/

function Multifuncao(){
	focoDoCurso();
    atualizaKitMaterialINF();
    atualizarCargaHoraria();
}

$('#div_form_PlanoAcao .inf').attr('onchange', 'Multifuncao();');
Multifuncao();

$('#div_form_PlanoAcao #kitMaterial').attr('onchange', 'kitDescricaoAntes();');

function kitDescricaoAntes() {
$("#idKitMaterial option:selected").each(function() {
      kit = $(this).val();
  });
kitDescricao();
}

function kitDescricao(kit){
$("#idKitMaterial option:selected").each(function() {
      kit = $(this).val();
  });
  var idIdioma = '<?php echo $idIdioma?>';
  var idNivelEstudo = $('#IdNivelEstudo').val();
  var idFocoCurso = $('#idFocoCursoIdioma').val();
  if(kit==""){  
  $("#idKitMaterial option:selected").each(function() {
      idKitMaterial = $(this).val();
  });
  }else{
    idKitMaterial = kit;
  }   
    $.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/planoAcao.php',{acao:"nomeMaterial", idIdioma:idIdioma, idNivelEstudo:idNivelEstudo, idFocoCurso:idFocoCurso, idKitMaterial:idKitMaterial}, function(e){
    $('#div_form_PlanoAcao #nomeMaterial').html(e);
    }); 
   
}
ativarForm();
</script>