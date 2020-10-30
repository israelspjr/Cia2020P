<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupoKitMaterial.class.php");

$PlanoAcaoGrupoKitMaterial = new PlanoAcaoGrupoKitMaterial();

$idPlanoAcaoGrupo = $_GET['id'];

$caminhoAtualizar = CAMINHO_REL."grupo/include/resourceHTML/material.php?id=".$idPlanoAcaoGrupo;
?>

<fieldset>
  <legend>Kit de material</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="NOVO KIT" 
    onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/planoAcaoGrupoKitMaterial.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoKitMaterial.php?id=".$idPlanoAcaoGrupo?>', '#div_lista_PlanoAcaoGrupoKitMaterial');" /> <img src="<?php echo CAMINHO_IMG."pasta.png";?>" title="HISTÓRICO DE DIAS" 
    onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoKitMaterial_historico.php?id=".$idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoKitMaterial.php?id=".$idPlanoAcaoGrupo?>', '#div_lista_PlanoAcaoGrupoKitMaterial');" /> </div>
  <div class="lista">
  <table id="tb_lista_PlanoAcaoGrupoKitMaterial" class="registros">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Itens</th>
        <th>Inicio</th>
        <th>Fim</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php 
	$where = " WHERE PAG.idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo.
	" AND (dataFim > CURDATE() OR dataFim IS NULL OR dataFim = '') ";
	
	echo $PlanoAcaoGrupoKitMaterial->selectPlanoAcaoGrupoKitMaterialTr(CAMINHO_REL."grupo/include/form/planoAcaoGrupoKitMaterial.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo, CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoKitMaterial.php?id=".$idPlanoAcaoGrupo, "#div_lista_PlanoAcaoGrupoKitMaterial", $where);
	?>
    </tbody>
    <tfoot>
      <tr>
        <th>Nome</th>
        <th>Itens</th>
        <th>Inicio</th>
        <th>Fim</th>
        <th></th>
      </tr>
    </tfoot>
  </table>
  </div>
</fieldset>
<script>
tabelaDataTable('tb_lista_PlanoAcaoGrupoKitMaterial', 'simples');
</script> 
