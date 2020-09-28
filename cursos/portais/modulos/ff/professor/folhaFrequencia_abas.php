<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$OcorrenciaFF = new OcorrenciaFF();
$FolhaFrequencia = new FolhaFrequencia();

$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];

$valorFolhaFrequencia = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = $idFolhaFrequencia");
$idPAG = $valorFolhaFrequencia[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
?>

<div id="div_ff">

<!--  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>-->

  <div id="abas">
    <div id="aba_div_ff_geral" divExibir="div_ff_geral" style="    float: left;" ><button class="Bblue" onclick="carregaGeral()">Folha geral</button></div>
    <div id="aba_div_ff_individual" divExibir="div_ff_individual" class="aba_interna" onclick="carregaAbaIndividual()" style="    float: left;    padding-left: 10px;
    padding-right: 10px;"><button class="Bblue">Folha individual</button></div>
    <div id="aba_div_ff_individual" divExibir="div_ff_individualD" class="aba_interna" onclick="carregaAbaIndividualD()" style="        padding-left: 10px;
    padding-right: 10px;"><button class="Bblue">Folha individual Desktop</button></div>
    <div id="aba_div_ff_siglas" divExibir="div_ff_siglas" class="aba_interna" onclick="mudarAbasFF();" style="    float: left;"><button class="Bblue">Siglas </button></div>
    <div style="padding-left: 10px;padding-right: 10px;"><button onclick="zerarCentro();carregarModulo('modulos/ff/resourceHTML/ff.php?id=<?php echo $idPAG?>', '#centro');" class="Bblue">Voltar</button></div>
  </div>

  <div id="div_ff_abas" class="conteudo_nivel">
    
    <div id="div_ff_geral" class="div_aba_interna" >     
    	<?php require_once "folhaFrequencia.php" ?>
    </div>
    
    <div id="div_ff_individual" class="div_aba_interna" style="display:none;" >
    </div>  
    
     <div id="div_ff_individualD" class="div_aba_interna" style="display:none;" >
    </div>    
    
    <div id="div_ff_siglas" class="div_aba_interna" style="display:none;" >     
    	<fieldset>
			<legend>Descrição das siglas da folha de frequência</legend>
			<?php echo $OcorrenciaFF->selectOcorrenciaFF_legenda();?> 
		</fieldset>
    </div>
    
  </div>
  
</div>

<script>
function carregaAbaIndividual(){
	$('#div_ff_siglas').hide();
	$('#div_ff_geral').hide();
	$('#div_ff_individualD').hide();
	carregarModulo('<?php echo "modulos/ff/form/diaAulaFFIndividual.php?idFolhaFrequencia=".$idFolhaFrequencia?>' , '#div_ff_individual')
}

function carregaAbaIndividualD(){
	$('#div_ff_siglas').hide();
	$('#div_ff_geral').hide();
	$('#div_ff_individual').hide();
	carregarModulo('<?php echo "modulos/ff/form/diaAulaFFIndividualD.php?idFolhaFrequencia=".$idFolhaFrequencia?>' , '#div_ff_individualD')
}


function mudarAbasFF(){
$('#div_ff_geral').hide();
$('#div_ff_individual').hide();
$('#div_ff_individualD').hide();
}

function carregaGeral(){
$('#div_ff_individual').hide();	
$('#div_ff_individualD').hide();
$('#div_ff_geral').show();
$('#div_ff_siglas').hide();
}
</script>
