<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupoMaterialDidatico.class.php");

$PlanoAcaoGrupoMaterialDidatico = new PlanoAcaoGrupoMaterialDidatico();

$idPlanoAcaoGrupo = $_GET['id'];

$caminhoAtualizar = CAMINHO_REL."grupo/include/resourceHTML/material.php?id=".$idPlanoAcaoGrupo;
?>

<fieldset>
  <legend>Material didático avulso</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="NOVO MATERIAL AVULSO" 
    onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/planoAcaoGrupoMaterialDidatico.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoMaterialDidatico.php?id=".$idPlanoAcaoGrupo?>', '#div_lista_PlanoAcaoGrupoMaterialDidatico');" /> <img src="<?php echo CAMINHO_IMG."pasta.png";?>" title="HISTÓRICO DE DIAS" 
    onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoMaterialDidatico_historico.php?id=".$idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoMaterialDidatico.php?id=".$idPlanoAcaoGrupo?>', '#div_lista_PlanoAcaoGrupoMaterialDidatico');" /> </div>
  <div class="lista">
    <table id="tb_lista_PlanoAcaoGrupoMaterialDidatico" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Inicio</th>
          <th>Fim</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
	$where = " WHERE PAG.idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo.
	" AND (dataFim > CURDATE() OR dataFim IS NULL OR dataFim = '') ";
	
	echo $PlanoAcaoGrupoMaterialDidatico->selectPlanoAcaoGrupoMaterialDidaticoTr(CAMINHO_REL."grupo/include/form/planoAcaoGrupoMaterialDidatico.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo, CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoMaterialDidatico.php?id=".$idPlanoAcaoGrupo, "#div_lista_PlanoAcaoGrupoMaterialDidatico", $where);
?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Inicio</th>
          <th>Fim</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
tabelaDataTable('tb_lista_PlanoAcaoGrupoMaterialDidatico', 'simples');
</script> 
