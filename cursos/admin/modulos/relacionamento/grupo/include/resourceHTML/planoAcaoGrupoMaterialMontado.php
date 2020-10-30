<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupoMaterialMontado.class.php");

$PlanoAcaoGrupoMaterialMontado = new PlanoAcaoGrupoMaterialMontado();

$idPlanoAcaoGrupo = $_GET['id'];

$caminhoAtualizar = CAMINHO_REL."grupo/include/resourceHTML/material.php?id=".$idPlanoAcaoGrupo;
?>

<fieldset>
  <legend>Material montado/personalizado</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="NOVO MATERIAL PERSONALIZADO/MONTADO" 
    onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/planoAcaoGrupoMaterialMontado.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoMaterialMontado.php?id=".$idPlanoAcaoGrupo?>', '#div_lista_PlanoAcaoGrupoMaterialMontado');" /> <img src="<?php echo CAMINHO_IMG."pasta.png";?>" title="HISTÓRICO DE DIAS" 
    onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoMaterialMontado_historico.php?id=".$idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoMaterialMontado.php?id=".$idPlanoAcaoGrupo?>', '#div_lista_PlanoAcaoGrupoMaterialMontado');" /> </div>
  <div class="lista">
    <table id="tb_lista_PlanoAcaoGrupoMaterialMontado" class="registros">
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
	
	echo $PlanoAcaoGrupoMaterialMontado->selectPlanoAcaoGrupoMaterialMontadoTr(CAMINHO_REL."grupo/include/form/planoAcaoGrupoMaterialMontado.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo, CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoMaterialMontado.php?id=".$idPlanoAcaoGrupo, "#div_lista_PlanoAcaoGrupoMaterialMontado", $where);
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
tabelaDataTable('tb_lista_PlanoAcaoGrupoMaterialMontado', 'simples');
</script> 
