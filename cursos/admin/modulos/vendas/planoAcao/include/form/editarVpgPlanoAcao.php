<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$idVpg = $_REQUEST['idVpg'];
$vpg = new VpgPlanoAcao();
$Integrante = new IntegrantePlanoAcao();	
$editar = $vpg->selectVpgPlanoAcao(" WHERE idVpgPlanoAcao =".$idVpg);
$rs = $Integrante->selectIntegrantePlanoAcao(" WHERE idIntegrantePlanoAcao=".$editar[0]['integrantePlanoAcao_idIntegrantePlanoAcao']);
$idPlanoAcao = $rs[0]['planoAcao_idPlanoAcao'];
?>
<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
<div class="conteudo_nivel">
<fieldset>
  <legend>Editar VPG</legend>
  
  <div style="float:left;width:30%;padding:1em;" >
    <form id="form" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="integrantePlanoAcao_idIntegrantePlanoAcao" id="integrantePlanoAcao_idIntegrantePlanoAcao" value="<?php echo $editar[0]['integrantePlanoAcao_idIntegrantePlanoAcao']; ?>" />
      <input type="hidden" name="acao" id="acao" value="editar" />
      <input type="hidden" name="id" id="id" value="<?php echo $editar[0]['idVpgPlanoAcao'];?>" />
      <input type="hidden" name="tipo" id="tipo" value="<?php echo $editar[0]['tipo'];?>" />
      <input type="hidden" name="idPlanoAcao" id="idPlanoAcao" value="<?php echo $idPlanoAcao;?>" />
      <p>
        <label><?php echo(($editar[0]['tipo']=="V") ? "Vocabulário:":($editar[0]['tipo']=="P") ?"Pronúncia:":($editar[0]['tipo']=="G") ? "Gramática:":"");?></label>
        <input type="text" name="valor" id="valor" class="required" value="<?php echo $editar[0]['valor'];?>">
        <span class="placeholder">Campo obrigatório</span></p>
      <p>
        <button class="button blue" onclick="gravarVPG('form');">Salvar</button>
        
      </p>
    </form>
    </div>
  
</fieldset>
</div>
</div>
<script>
function gravarVPG(form){
	postForm(form, '<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/vpgPlanoAcao.php');			
}
ativarForm();
</script>