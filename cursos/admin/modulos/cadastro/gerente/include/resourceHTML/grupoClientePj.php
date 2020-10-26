<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/GrupoClientePj.class.php");
$GrupoClientePj = new GrupoClientePj();
$idGerente = $_GET['id'];
?>

<fieldset>
  <legend>Vinculo com grupos particulares</legend>
  <div class="menu_interno"><img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."gerente/include/form/grupoClientePj.php";?>?id_Gerente=<?php echo $idGerente?>', '<?php echo CAMINHO_CAD."gerente/include/resourceHTML/grupoClientePj.php?id=".$idGerente?>', '#div_vinculo_GrupoClientePj');" /></div>
  <div id="div_lista_GrupoClientePj" class="lista">
    <table id="tb_lista_GrupoClientePj" class="registros">
      <thead>
        <tr>
          <th>Grupo</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $GrupoClientePj->selectGrupoClientePjTr(CAMINHO_CAD."gerente/include/resourceHTML/grupoClientePj.php?id=".$idGerente, "#div_vinculo_GrupoClientePj", " WHERE (GPJ.dataFim IS NULL OR GPJ.dataFim = '') AND GPJ.gerente_idGerente =".$idGerente);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Grupo</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
	tabelaDataTable('tb_lista_GrupoClientePj');
</script> 
