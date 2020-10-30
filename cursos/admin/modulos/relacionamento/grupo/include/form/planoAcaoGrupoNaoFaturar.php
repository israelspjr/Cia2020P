<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcaoGrupoNaoFaturar = new PlanoAcaoGrupoNaoFaturar();

$idPlanoAcaoGrupoNaoFaturar = $_GET['id'];
$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];

if($idPlanoAcaoGrupoNaoFaturar != '' && is_numeric($idPlanoAcaoGrupoNaoFaturar)){
	
	$valor = $PlanoAcaoGrupoNaoFaturar->selectPlanoAcaoGrupoNaoFaturar("WHERE idPlanoAcaoGrupoNaoFaturar = ".$idPlanoAcaoGrupoNaoFaturar);
	$idPlanoAcaoGrupo = $valor[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
	$data = Uteis::exibirData($valor[0]['data']);
	//$dataExcluido= $valor[0]['dataExcluido'];
	//$dataCadastro= $valor[0]['dataCadastro'];			
}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Não faturar a partir de:</legend>
    <form id="form_PlanoAcaoGrupoNaoFaturar" class="validate" method="post" action="" onsubmit="return false" >
      
      <input type="hidden" name="id" id="id" value="<?php echo $idPlanoAcaoGrupoNaoFaturar?>" />
      <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
      
      <p>
        <label>A partir de:</label>
        <input type="text" name="data" id="data" class="required data" value="<?php echo $data?>" />
        <span>Campo Obrigatório</span> </p>
    	<!--<p>
        <label>dataExcluido:</label>
        <input type="text" name="dataExcluido" id="dataExcluido" class="required" onsubmit="return false" value="<?php //echo $dataExcluido?>" />
        <span>Campo Obrigatório</span> </p>
      <p>
        <label>dataCadastro:</label>
        <input type="text" name="dataCadastro" id="dataCadastro" class="required" onsubmit="return false" value="<?php //echo $dataCadastro?>" />
        <span>Campo Obrigatório</span> </p>-->
      <p>
        <button class="button blue" 
        onclick="postForm('form_PlanoAcaoGrupoNaoFaturar', '<?php echo CAMINHO_REL."grupo/include/acao/planoAcaoGrupoNaoFaturar.php"?>')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();</script> 
