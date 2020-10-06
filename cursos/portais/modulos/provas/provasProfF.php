<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
//Form	
$Prova = new Prova();	
$CalendarioProva = new CalendarioProva();	
		
$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];
$idCalendarioProva = $_GET['id'];
$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];

$mesAtual = date('m');
$anoAtual = date('Y');

if($idCalendarioProva != '' && $idCalendarioProva  > 0){

	$valorCalendarioProva = $CalendarioProva->selectCalendarioProva(" WHERE idCalendarioProva=".$idCalendarioProva);
	
	$idProva = $valorCalendarioProva[0]['prova_idProva'];
	$idPlanoAcaoGrupo = $valorCalendarioProva[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];	
	$dataPrevistaInicial = $valorCalendarioProva[0]['dataPrevistaInicial'];
	$dataPrevistaNova = $valorCalendarioProva[0]['dataPrevistaNova'];
	$dataAplicacao = $valorCalendarioProva[0]['dataAplicacao'];
	$obs = $valorCalendarioProva[0]['obs'];
	$dataValidacao = $valorCalendarioProva[0]['validacao'];
	$codLiberacao = $valorCalendarioProva[0]['codLiberacao'];
	$provaOn = $valorCalendarioProva[0]['provaOn'];
	

	$data = date("Y-m-d"); 

//	$data = date('d/m/Y', strtotime("-1 month",strtotime($data))); 
	$mesFuturo = date('Y-m-d', strtotime("+1 month",strtotime($data))); 

			$vr = explode("-", $dataValidacao);
//			Uteis::pr($vr);
		$anoV = $vr[0];
		$mesV = $vr[1];	
//		echo $mesV;
//		echo $anoV;
		
	
		if  (($anoAtual == $anoV) && ($mesAtual == $mesV)) {
		$validado = 1;	
			
		} else {
		$validado = 0;	
			
		}
		
	
	if (($dataPrevistaInicial >= $data) && ($dataPrevistaInicial <= $mesFuturo)) {
		echo "<script> var perguntar = 1</script>";
	} else {
		echo "<script> var perguntar = 0</script>";
	}
	
	if (($dataPrevistaNova >= $data) && ($dataPrevistaNova <= $mesFuturo)) {
		echo "<script> var perguntar = 1</script>";
	} else {
		echo "<script> var perguntar = 0</script>";
	}
	
}	
?>
<script>
function atualizaIntens(idProva){
	if( idProva ){
		$('#itensProva').load('<?php echo "modulos/provas/itensProva.php?idProva="?>' + idProva);
	}
}

/* $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',                
                language: 'pt-BR'
            });
        });
	*/	
var dataAplicacao = $('#dataAplicacao').val(<?php echo $dataAplicacao?>);
if (dataAplicacao != '') {
		$('#validaP').hide();
}
var salvarDireto = 0;
if (perguntar == 1) {
	
var txt;
var r = confirm("Será possivel aplicar a prova no prazo ?");
if (r == true) {
    $('#validacao').prop('checked', true);
	$('#validaP').show();
	$('#obsP').hide();
	salvarDireto = 1;
} else {
    var dataPrevistaNova = prompt("Por favor insira a nova data Prevista");
	
	if (dataPrevistaNova != null) {
		$('#dataPrevistaNova').val(dataPrevistaNova);
		$('#prevista').show();
		$('#validacao').prop('checked', true);
		$('#validaP').show();
		$('#obsP').show();
	}
}	
	enviadoOK();
	postForm('form_CalendarioProva', '<?php echo "modulos/provas/provasAcao.php?id=$idCalendarioProva"?>');
	
}

</script>

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  --><fieldset>
    <legend>Alterar Prova </legend>
      <form id="form_CalendarioProva" class="validate" method="post" action="" onsubmit="return false" >
        <input name="idPlanoAcaoGrupo" type="hidden" value="<?php echo $idPlanoAcaoGrupo?>" />
        <input name="idFolhaFrequencia" type="hidden" value="<?php echo $idFolhaFrequencia?>" />
 
  
    <div class="esquerda">
         <p>
          <label>Prova:</label>
          <?php 
			$rs = $Prova->selectProva(" WHERE idProva = $idProva");
			echo "<strong>".$rs[0]['nome']."</strong>";
			echo "<input type=\"hidden\" name=\"idProva\" value=\"".$idProva."\" />";
		?>
        </p>
       
        <p>
          <label>Data prevista:</label>
          <?php echo Uteis::exibirData($dataPrevistaInicial)?></p>
       
        <div id="prevista" name="prevista" style="display:none"> 
        <p>
          <label>Nova data prevista:</label>
           <input type="datee" name="dataPrevistaNova" id="dataPrevistaNova" class="datepicker" value="<?php echo $dataPrevistaNova?>" />
          <?php //echo Uteis::exibirData($dataPrevistaNova)?></p>
          </div>
          
          <?php if ($dataAplicacao != '') { ?>
       <p>
          <label>Data da aplicação: </label>
          <?php echo Uteis::exibirData($dataAplicacao)?> <br />
         <!-- <font color="#FF0000">Professor, coloque a data de aplicação após a aplicação da prova, essa data não poderá ser alterada depois. </font>-->
        </p>
        <?php  } ?>
        <div id="validaP" name="validaP">
        <p>
        
          <label>Validação do Professor:</label>
          <input type="checkbox" name="validacao" id="validacao" value="1" <?php if ($validado == 1) { echo "checked=\"checked\""; } ?> />
       
        </p>
        </div>
        <div id="obsP" name="obsP">
        <p>
          <p><label>Por favor, informe aqui os motivos para o atraso na data para aplicação desta prova:</label></p>
          <textarea name="obs" id="obs" class="" cols="40" rows="4"><?php echo $obs?></textarea>
       <!--   <span class="placeholder">Campo Obrigatório</span> </p>-->
        </p>
        </div>
        
        
     
    </div>
    <div class="direita">
      <p>
        <label><strong>Itens da Prova:</strong></label>
      <div id="itensProva" class="tab2"></div>
      </p>
      
        <p>
        <label for="inativo"><strong>Prova on-line</strong></label>
        <input type="checkbox" name="provaOn" id="provaOn" disabled="disabled" value="1" <?php if($provaOn != 0){ ?> checked="checked" <?php } ?> />
      </p>
      
      <p><Label><strong>Código de liberação da prova:</strong></Label><p style="font-size:18px;    display: block;"><?php echo $codLiberacao?></p>
      Caso não tenha nenhum clique no botão salvar para gerar um novo código. (Somente para Prova on-line)
      <input type="hidden" name="codLiberacao" id="codLiberacao" value="<?php echo $codLiberacao?>" />
    </div>
    
    

</div>
   <p>
          <button class="Bblue" onclick="salvar();">Salvar</button>&nbsp;&nbsp;
          <button class="button gray" onclick="zerarProva();">Fechar </button> <!-- ;carregarModulo('/cursos/mobile/professor/modulos/provas/index.php', '#centro');">Fechar</button>-->
          
        </p>
        </p>
      </form>
  </fieldset>
<script>
//ativarForm();
atualizaIntens('<?php echo $idProva?>');
function zerarProva() {
$('#provasF').html('');	
}
function salvar() {
	
	if (salvarDireto == 0) {
	var n = $('#dataPrevistaNova').val();
	var o = $('#obs').val();

if ((o == '') && (n != '')) {
	
alert("Verifique a observação (Não pode ficar vazia) e a nova data de aplicação");
} else {
	$('#validacao').prop('checked', true);
	

	enviadoOK();
	postForm('form_CalendarioProva', '<?php echo "modulos/provas/provasAcao.php?id=$idCalendarioProva"?>');
	
	}
	
	} else {
	enviadoOK();
	postForm('form_CalendarioProva', '<?php echo "modulos/provas/provasAcao.php?id=$idCalendarioProva"?>');	
		
	}
}
</script> 
