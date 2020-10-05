<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$OcorrenciaFF = new OcorrenciaFF();
$FolhaFrequencia = new FolhaFrequencia();

$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];

$valorFolhaFrequencia = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = $idFolhaFrequencia");
$idPAG = $valorFolhaFrequencia[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
?>

<button class="Bblue" onclick="carregaGeral()">Folha geral</button>
   <button onclick="carregaAbaIndividual()"  class="Bblue">Folha individual</button>
    <button class="Bblue" onclick="carregaAbaIndividualD()">Folha individual Desktop</button>
    <button class="Bblue">Siglas </button>
        
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
	carregarModulo('<?php echo "modulos/ff/professor/diaAulaFFIndividual.php?idFolhaFrequencia=".$idFolhaFrequencia?>' , '#div_ff_individual')
}

function carregaAbaIndividualD(){
	$('#div_ff_siglas').hide();
	$('#div_ff_geral').hide();
	$('#div_ff_individual').hide();
	carregarModulo('<?php echo "modulos/ff/professor/diaAulaFFIndividualD.php?idFolhaFrequencia=".$idFolhaFrequencia?>' , '#div_ff_individualD')
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
