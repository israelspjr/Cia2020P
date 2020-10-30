<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/OcorrenciaFF.class.php");

$OcorrenciaFF = new OcorrenciaFF();

$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];

?>

<div id="div_ff">

  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>

  <div id="abas">
    <div id="aba_div_ff_geral" divExibir="div_ff_geral" class="aba_interna ativa" >Folha geral</div>
    <div id="aba_div_ff_individual" divExibir="div_ff_individual" class="aba_interna" 
    onclick="carregaAbaIndividual()" >Folha individual</div>
    <div id="aba_div_ff_siglas" divExibir="div_ff_siglas" class="aba_interna" >Siglas da folha de frequência</div>
  </div>

  <div id="div_ff_abas" class="conteudo_nivel">
    
    <div id="div_ff_geral" class="div_aba_interna" >     
    	<?php require_once "folhaFrequencia.php" ?>
    </div>
    
    <div id="div_ff_individual" class="div_aba_interna" style="display:none;" >
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
	carregarModulo('<?php echo CAMINHO_REL."grupo/include/form/diaAulaFFIndividual.php?idFolhaFrequencia=".$idFolhaFrequencia?>' , '#div_ff_individual')
}
</script>
