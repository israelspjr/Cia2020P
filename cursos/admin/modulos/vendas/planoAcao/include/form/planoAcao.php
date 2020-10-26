<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcao = new PlanoAcao();
$Idioma = new Idioma();	
$FocoCurso = new FocoCurso();
$FocoCursoIdioma = new FocoCursoIdioma();	
$ExpectativaInicio = new ExpectativaInicio();	
$NivelEstudo = new NivelEstudo();	
$MedicaoResultado = new MedicaoResultado();	
$ClientePf = new ClientePf();
$ClientePj = new ClientePj();	
$TipoCurso = new TipoCurso();

$proposta_idProposta = $_GET['idProposta'];
$idPlanoAcao = $_GET['id'];

//POR PADRÃO COMEÇA EM ABERTO
$statusAprovacaoIdStatusAprovacao = "1";

if($idPlanoAcao != '' && $idPlanoAcao  > 0){

	$valorPlanoAcao = $PlanoAcao->selectPlanoAcao('WHERE idPlanoAcao='.$idPlanoAcao);
	
	$proposta_idProposta = $PlanoAcao->getIdProposta($idPlanoAcao); //$valorPlanoAcao[0]['proposta_idProposta']; 
	$grupo_idGrupo = $valorPlanoAcao[0]['grupo_idGrupo']; 
	
	$IdNivelEstudo = $valorPlanoAcao[0]['nivelEstudo_IdNivelEstudo'];
	$horasPrograma = Uteis::exibirHorasInput($valorPlanoAcao[0]['horasPrograma']);
	$idFocoCurso = $valorPlanoAcao[0]['focoCurso_idFocoCurso'];
    $idKitMaterial = $valorPlanoAcao[0]['kitMaterial_idKitMaterial']; 		
	$dataExpectativaInicio = Uteis::exibirData($valorPlanoAcao[0]['dataExpectativaInicio']); 
	$idExpectativaInicio = $valorPlanoAcao[0]['expectativaInicio_idExpectativaInicio'];		
	$statusAprovacaoIdStatusAprovacao = $valorPlanoAcao[0]['statusAprovacao_idStatusAprovacao']; 			
	$abordagemCurso = $valorPlanoAcao[0]['abordagemCurso']; 
	$tipoContrato = $valorPlanoAcao[0]['tipoContrato'];
	$tipoCursoD = $valorPlanoAcao[0]['tipoCurso'];
//	$people = array();
//	foreach($tipoCursoD as $valor) {
//		$people[] = $valor;
//	}
//	Uteis::pr( $people);
	$tipoAval = $valorPlanoAcao[0]['tipoAval'];
	$tipoMaterial = $valorPlanoAcao[0]['tipoMaterial'];
	$dataContrato = Uteis::exibirData($valorPlanoAcao[0]['dataContrato']);
	
	$linkVisualizacao = "p=".Uteis::base64_url_encode($idPlanoAcao);	
	$linkVisualizacaoP = "p=".Uteis::base64_url_encode($idPlanoAcao)."&a=".Uteis::base64_url_encode(2);	
							
}

$tipoHora = strlen($horasPrograma) == 6 ? "checked" : "";

?>

<fieldset>
  <legend>Dados principais</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_PlanoAcao', 'img_');" />
  <div class="agrupa" id="div_form_PlanoAcao" style="display:">
    <form id="form_PlanoAcao" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="proposta_idProposta" id="proposta_idProposta" value="<?php echo $proposta_idProposta ?>" />
      <input type="hidden" name="grupo_idGrupo" id="grupo_idGrupo" value="<?php echo $grupo_idGrupo ?>" />
      <input type="hidden" name="statusAprovacaoIdStatusAprovacao" id="statusAprovacaoIdStatusAprovacao" value="<?php echo $statusAprovacaoIdStatusAprovacao ?>" />
      <p>
      Plano Ação Professor:
      
          <img src="<?php echo CAMINHO_IMG."ver16.png"?>" onclick="window.open('<?php echo CAMINHO_PA."index.php?".$linkVisualizacaoP?>');">
          </p>
	  <?php
	  
	  
      if($statusAprovacaoIdStatusAprovacao==1):?>
      <div class="linha-inteira">
          
      <div class="esquerda">
          <p>
           Plano Ação RH:
          <img src="<?php echo CAMINHO_IMG."ver16.png"?>" onclick="window.open('<?php echo CAMINHO_PA."index.php?".$linkVisualizacao?>');">
          </p>
          </div>
      <div class="direita">
          <p><Label>Link para o Plano de Ação por Integrante:</Label>
      <?php 
      if($idPlanoAcao!=''): 
        $IntegrantePlanoAcao = new IntegrantePlanoAcao();
        $rs = $IntegrantePlanoAcao->selectIntegrantePlanoAcao(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao);
	            
        foreach($rs as $valor) {
            $linkVisualizacao2 = "p=".Uteis::base64_url_encode($idPlanoAcao)."&b=".Uteis::base64_url_encode($valor['idIntegrantePlanoAcao'])."&a=".Uteis::base64_url_encode(3);
            $nome = $ClientePf->getNome($valor['clientePf_idClientePf']);   
   
      if ($valor['aprovacaoAluno'] == '') {
		$style = "style=\"color:red\"";  
	  } else {
		$style = "style=\"color:green\"";  
	  }
	  ?>          
            <p><label <?php echo $style;?>><?=$nome;?> Data da aceitação da PA: <?php echo Uteis::exibirData($valor['aprovacaoAluno']);?></span> </label>&nbsp;&nbsp;<img src="<?php echo CAMINHO_IMG."ver16.png"?>" onclick="window.open('<?php echo CAMINHO_PA."index.php?".$linkVisualizacao2?>');"> <input type="text" readonly value="<?php echo CAMINHO_VER_PA."index.php?".$linkVisualizacao2;?>"></p>
      <?php 
		}
      endif;?>
            </p>
            </div>
            </div>
       <?php endif;?>
       
      <div class="esquerda"> 
          <?php echo "<p>Id: <strong>".($idPlanoAcao ? $idPlanoAcao : "NOVO")."</strong></p>" ?>
        <p>
        
        <?php if($idPlanoAcao=='') { ?>
        <p>
        <Label>Selecione o idioma: </Label>
        <?php echo "<p onchange=\"idioma()\">".$Idioma->selectIdiomaSelect("required")."</p>"; ?>
        <span class="placeholder">Campo obrigatório</span>
        </p>
        <p>
        <label>Selecione a empresa: </label>
        <?php echo $ClientePj->selectClientePjSelect("", "required", " AND inativo = 0"); ?>
        <span class="placeholder">Campo obrigatório</span>
        </p>
          <?php }
		$sql = " SELECT I.idIdioma, I.idioma FROM proposta AS P ";
		$sql .= " INNER JOIN idioma AS I ON I.idIdioma = P.idioma_idIdioma ";
		$sql .= " WHERE idProposta = ".$proposta_idProposta;
		
		$idiomaSelecionado =  Uteis::executarQuery($sql);
		echo "<strong>".$idiomaSelecionado[0]['idioma']."</strong>"; 
		$idIdioma = $idiomaSelecionado[0]['idIdioma'] 
		?>
        </p>
        <p>
        <label>Material Regular:</label>
        <input type="radio" name="tipoMaterial" id="tipoMaterial" class="required" value="0" <?php if($tipoMaterial == 0) { echo "checked= 'checked'"; } ?> /  />SIM <br />      	

<input type="radio" name="tipoMaterial" id="tipoMaterial" class="required" value="1" <?php if($tipoMaterial == 1) { echo "checked= 'checked'"; } ?> /  />NÃO <br />      	
</p>
        <div id="focoDoCurso"></div>
        <div id="nivelDoCurso"></div>
        <?php if ($idPlanoAcao != '' && $idPlanoAcao > 0) { ?>
        <p>
          <label>Foco do curso:</label>
          <?php 		
	//	$sql = "INNER JOIN focoCursoIdioma AS FI ON FI.focoCurso_idFocoCurso = F.idFocoCurso ";
	//	$sql .= "INNER JOIN idioma AS I ON I.idIdioma = FI.idioma_idIdioma AND I.idIdioma = ".$idIdioma;
		$sql = " where FCI.excluido = 0 AND FCI.idioma_idIdioma = ".$idIdioma;
		
		echo $FocoCursoIdioma->selectFocoCursoIdiomaSelect2("required inf", $idFocoCurso, $sql);?>
          <span class="placeholder">Campo obrigatório</span>
          </p>
        <p>
          <label>Nível:</label>
          <?php 
			$sql = " INNER JOIN nivelEstudoIdioma AS NI ON NI.nivel_IdNivel = N.IdNivelEstudo ";
			$sql .= "INNER JOIN idioma AS I ON I.idIdioma = NI.idioma_idIdioma AND I.idIdioma = ".$idIdioma;
		
			echo $NivelEstudo->selectNivelEstudoSelect("required inf", $IdNivelEstudo, $sql);?>
          <span class="placeholder">Campo obrigatório</span>
          </p>
          <?php } ?>
    <!--    <p>  
        <div id="kitMaterial"></div>
        </p>-->
        <p> 
        <div id="nomeMaterial"></div>
        </p> 
      </div>
	  <div class="direita">
      <p>
      <label> Tipo de contrato:       </label>
      <input type="radio" onclick="tipoCon(0);" name="tipoContrato" id="tipoContrato" class="required" value="0" <?php if($tipoContrato == 0) { echo "checked= 'checked'"; } ?> />Prazo indeterminado <br />
      <input type="radio" onclick="tipoCon(1);" name="tipoContrato" id="tipoContrato" class="required" value="1" <?php if($tipoContrato == 1) { echo "checked= 'checked'"; } ?>/>Pacote de horas <br />
      <input type="radio" onclick="tipoCon(2);" name="tipoContrato" id="tipoContrato" class="required" value="2" <?php if($tipoContrato == 2) { echo "checked= 'checked'"; } ?>/>Prazo Determinado  <br /> </p>
      <div id="dataCadastroDiv" style="display:none">Data vigência do contrato: <input type="text" name="dataContrato3" id="dataContrato3" class="data" value="<?php echo $dataContrato?>" > <span class="placeholder">Campo obrigatório</span> </div>
      
       <p>
      <label> Tipo de curso:       </label>
      <?php echo $TipoCurso->selectTipoCursoCheckbox($idPlanoAcao, $and, "", $tipoCursoD) ?>
 
        <p>
        <label>Avaliações:</label>
        <input type="radio" name="tipoAval" id="tipoAval" class="required" value="0" <?php if($tipoAval == 0) { echo "checked= 'checked'"; } ?> /  />Avaliação no final do programa <br />      	

<input type="radio" name="tipoAval" id="tipoAval" class="required" value="1" <?php if($tipoAval == 1) { echo "checked= 'checked'"; } ?> /  />Não tem avaliação no programa <br />      	
</p>
       
          <label>Horas do programa:</label>
          
          <label><input type="checkbox" value="1" name="mudarClassHora" id="mudarClassHora" onchange="mudarClass()" <?php echo $tipoHora?>/>usar horas maiores (ou iguais) a 100:00</label>
          
          <img src="<?php echo CAMINHO_IMG?>/carrega.png" title="Carregar carga horária padrão para este progrma" onclick="atualizarCargaHoraria()" />
          
          <input type="text" name="horasPrograma_1" id="horasPrograma_1" class="required hora" value="<?php echo $horasPrograma?>" />          
          <input type="text" name="horasPrograma_2" id="horasPrograma_2" class="required hora2" value="<?php echo $horasPrograma?>" />
          <input type="hidden" name="horasPrograma" id="horasPrograma" value="" />
          
          <span class="placeholder">Campo obrigatório</span> </p>
        <p>
          <label>Expectativa de início:</label>
          <?php echo $ExpectativaInicio->selectExpectativaInicioSelect("required", $idExpectativaInicio);?>
          <span class="placeholder">Campo obrigatório</span></p>
        <p>
          <label>Data de expectativa de início:</label>
          <input type="text" name="dataExpectativaInicio" id="dataExpectativaInicio" class="data" value="<?php echo $dataExpectativaInicio?>" />
        </p>
      </div>
      <div class="linha-inteira">
      <style>
	  .validate p span {
		display:block;  
		  
	  }
       </style>
          <p><label>Abordagem do curso:</label> 
          <textarea name="abordagemCurso" id="abordagemCurso" style="display:block"></textarea>
          <textarea name="abordagemCurso_base" id="abordagemCurso_base" rows="6" cols="80"><?php echo $abordagemCurso?></textarea>         
         
       </p> 
       <?php 
	   if($idPlanoAcao != '' && $idPlanoAcao  > 0){
		   
	   } else { ?>
        <p>
          <button class="button blue" onclick="postTemp();">Salvar</button>
        </p>
        
        <?php } ?>
      </div>
    </form>
  </div>
</fieldset>
<script>
function tipoCon(x) {
if ((x == 2) || (x == 1)) {
	$('#dataCadastroDiv').show();
	$('#dataContrato3').addClass('required');
} else {
	$('#dataCadastroDiv').hide();
	$('#dataContrato3').removeClass('required');
	}
}

tipoCon(<?php echo $tipoContrato ?>);

function atualizaKitMaterialINF(){	
<?php if ($idIdioma == '') { ?>
	var idIdioma = $('#idIdioma').val();
<?php } else { ?>
	var idIdioma = '<?php echo $idIdioma?>';
<?php } ?>

	var idNivelEstudo = $('#IdNivelEstudo').val();
	var idFocoCurso = $('#idFocoCursoIdioma').val();
	if(idFocoCurso != 0){
       $("#nomeMaterial").show();     
	$.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/planoAcao.php',{acao:"atualizaKitMaterialINF", idIdioma:idIdioma, idNivelEstudo:idNivelEstudo, idFocoCurso:idFocoCurso}, function(e){
		$('#div_form_PlanoAcao #nomeMaterial').html(e);
	});
	}else{
	   $("#nomeMaterial").hide(); 
	}	
	atualizarCargaHoraria();
}

function atualizarCargaHoraria(){ 
<?php if ($idIdioma == '') { ?>
	var idIdioma = $('#idIdioma').val();
<?php } else { ?>
	var idIdioma = '<?php echo $idIdioma?>';
<?php } ?>

    var carga =  '<?php echo $horasPrograma?>'; 
//	var idIdioma = '<?php echo $idIdioma?>';
	var idNivelEstudo = $('#IdNivelEstudo').val();
	var idFocoCurso = $('#idFocoCursoIdioma').val();
    if(carga ==""){
	$.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/planoAcao.php',{acao:"atualizarCargaHoraria", idIdioma:idIdioma, idNivelEstudo:idNivelEstudo, idFocoCurso:idFocoCurso}, function(e){	
		acaoJson(e)
	});
	}
}

function Multifuncao(){
    atualizaKitMaterialINF();
    atualizarCargaHoraria();
}
/*function kitDescricao(kit){
<?php if ($idIdioma == '') { ?>
	var idIdioma = $('#idIdioma').val();
<?php } else { ?>
	var idIdioma = '<?php echo $idIdioma?>';
<?php } ?>

  var idNivelEstudo = $('#IdNivelEstudo').val();
  var idFocoCurso = $('#idFocoCurso').val();
  if (kit == null){  
//  $("#idKitMaterial option:selected").each(function() {
 //     idKitMaterial = $(this).val();
   idKitMaterial = $('#idKitMaterial').val();
//  });
  }else{
    idKitMaterial = kit;
  }

    $.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/planoAcao.php',{acao:"nomeMaterial", idIdioma:idIdioma, idNivelEstudo:idNivelEstudo, idFocoCurso:idFocoCurso, idKitMaterial:idKitMaterial}, function(e){
    $('#div_form_PlanoAcao #nomeMaterial').html(e);
    }); 
}
*/
function focoDoCurso(){
  var idIdioma = $('#idIdioma').val();

    $.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/planoAcao.php',{acao:"focoDoCurso", idIdioma:idIdioma}, function(e){
    $('#div_form_PlanoAcao #focoDoCurso').html(e);
    }); 
   Multifuncao();
}

function nivelDoCurso(){
  var idIdioma = $('#idIdioma').val();

    $.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/planoAcao.php',{acao:"nivelDoCurso", idIdioma:idIdioma}, function(e){
    $('#div_form_PlanoAcao #nivelDoCurso').html(e);
    }); 
	
	Multifuncao();
//	kitDescricao();
   
}


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

function postTemp(){
	mudarClass();
	if( $('#horasPrograma_1').val() != '' ){
		$('#horasPrograma').val( $('#horasPrograma_1').val() )
	}else{
		$('#horasPrograma').val( $('#horasPrograma_2').val() )
	}
	postForm_editor('abordagemCurso', 'form_PlanoAcao', '<?php echo CAMINHO_VENDAS."planoAcao/include/acao/planoAcao.php?id=$idPlanoAcao"?>');
}

$('#div_form_PlanoAcao .inf').attr('onchange', 'Multifuncao();');
<?php if ($idPlanoAcao != '') { ?>
Multifuncao();
<?php } ?>

function idioma() {
	focoDoCurso();
	nivelDoCurso();
	Multifuncao();
}

$('#div_form_PlanoAcao #kitMaterial').attr('onchange', 'kitDescricao();');
$('#div_form_PlanoAcao #IdNivelEstudo').attr('onchange', 'atualizaKitMaterialINF();');
//kitDescricao(<?= $idKitMaterial?>);

viraEditor('abordagemCurso');
ativarForm();



</script>