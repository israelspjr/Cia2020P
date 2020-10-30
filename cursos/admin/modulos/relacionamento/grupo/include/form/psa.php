<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$PsaIntegranteGrupo = new PsaIntegranteGrupo();	
	
$idPsaIntegranteGrupo = $_GET['id'];
$idIntegranteGrupo = $_GET['idIntegranteGrupo'];

if($idPsaIntegranteGrupo != '' && $idPsaIntegranteGrupo  > 0){

	$valorPsaIntegranteGrupo = $PsaIntegranteGrupo->selectPsaIntegranteGrupo('WHERE idPsaIntegranteGrupo='.$idPsaIntegranteGrupo);
	
	$dataReferencia = Uteis::exibirData($valorPsaIntegranteGrupo[0]['dataReferencia']);
	$obs = $valorPsaIntegranteGrupo[0]['obs'];
	$finalizado = $valorPsaIntegranteGrupo[0]['finalizado'];
	$idIntegranteGrupo = $valorPsaIntegranteGrupo[0]['integranteGrupo_idIntegranteGrupo'];
}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Pesquisa de satisfação </legend>
    <form id="form_psa" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="idIntegranteGrupo" id="idIntegranteGrupo" value="<?php echo $idIntegranteGrupo ?>" />
      <input type="hidden" name="idPsaIntegranteGrupo" id="idPsaIntegranteGrupo" value="<?php echo $idPsaIntegranteGrupo ?>" />
      <p>
        <label>Data Referencia: </label>
        <input type="text" name="dataReferencia" id="dataReferencia" value="<?php echo $dataReferencia ?>" class="required data" />
        <span class="placeholder">Campo obrigatório</span></p>
      <p>
        <label>Descrição: </label>
        <input type="text" name="obs" value="<?php echo $obs ?>" />
      </p>
      
      <p>        
        <?php 
		if(!$idPsaIntegranteGrupo){
			echo "<label>Perguntas: </label>".$PsaIntegranteGrupo->listaPerguntasCheck();
		}?>
      </p>
      <p>
        <button class="button blue" onclick="postForm('form_psa', '<?php echo CAMINHO_REL?>grupo/include/acao/psa.php?id=<?php echo $idPsaIntegranteGrupo?>&idIntegranteGrupo=<?php echo $idIntegranteGrupo?>');">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 