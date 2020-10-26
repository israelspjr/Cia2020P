<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/GerenteClientePj.class.php");

$GerenteClientePj = new GerenteClientePj();
$idGerente = $_GET['id'];

echo "ooo";	
?>
<div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" 
	onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."gerente/include/form/gerenteClientePj.php";?>?idGerente=<?php echo $idGerente?>', '<?php echo CAMINHO_CAD."gerente/include/resourceHTML/gerenteClientePj.php?id=".$idGerente?>', '#div_vinculo_gerenteClientePj');" /> </div>
<fieldset>
  <legend>Vinculo com cliente PJ</legend>
  <div id="div_lista_gerenteClientePj" class="lista">
    <table id="tb_lista_gerenteClientePj" class="registros">
      <thead>
        <tr>
          <th>Empresa</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $GerenteClientePj->selectGerenteClientePjTr(CAMINHO_CAD."gerente/include/resourceHTML/gerenteClientePj.php", "#div_vinculo_gerenteClientePj");?>
      </tbody>
      <tfoot>
        <tr>
          <th>Empresa</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
	tabelaDataTable('tb_lista_gerenteClientePj');
</script> 
