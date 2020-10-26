<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/GerenteTem.class.php");

$GerenteTem = new GerenteTem();

$idGerente = $_GET['id'];

?>
<!--
<div class="direita">
<fieldset>
    <legend>Vinculo com grupos</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."gerente/include/form/gerenteTem_grupo.php?idGerente=$idGerente"?>', '<?php echo CAMINHO_CAD."gerente/include/resourceHTML/gerenteTem.php?id=$idGerente"?>', '#div_vinculo_gerente');" /> </div>
    <div class="lista">
      <table id="tb_lista_gerenteTem_grupo" class="registros">
        <thead>
          <tr>
            <th>Grupo</th>
            <th>Inicio</th>
            <th>Fim</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Grupo</th>
            <th>Inicio</th>
            <th>Fim</th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
        <?php 
		/*$caminhoAbrir = "";
		$caminhoAtualizar = CAMINHO_CAD."gerente/include/resourceHTML/gerenteTem.php?id=$idGerente";
		$onde = "#div_vinculo_gerente";
		$where = " WHERE gerente_idGerente = $idGerente AND grupo_idGrupo IS NOT NULL ";
		
		echo $GerenteTem->selectGerenteTemTr_grupo($caminhoAbrir, $caminhoAtualizar, $onde, $where);
		*/?>
        </tbody>
      </table>
    </div>
  </fieldset>
</div>
-->
<div class="linha-inteira">
  <fieldset>
    <legend>Vinculo com cliente p. jurídica</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."gerente/include/form/gerenteTem_empresa.php?idGerente=$idGerente"?>', '<?php echo CAMINHO_CAD."gerente/include/resourceHTML/gerenteTem.php?id=$idGerente"?>', '#div_vinculo_gerente');" /> </div>
    <div class="lista">
      <table id="tb_lista_gerenteTem_empresa" class="registros">
        <thead>
          <tr>
            <th>Empresa</th> 
            <th>Inicio</th>
            <th>Fim</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Empresa</th>
            <th>Inicio</th>
            <th>Fim</th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
        <?php 
		$caminhoAbrir = "";
		$caminhoAtualizar = CAMINHO_CAD."gerente/include/resourceHTML/gerenteTem.php?id=$idGerente";
		$onde = "#div_vinculo_gerente";
		$where = " WHERE gerente_idGerente = $idGerente AND GT.clientePj_idClientePj IS NOT NULL ";
		
		echo $GerenteTem->selectGerenteTemTr_empresa($caminhoAbrir, $caminhoAtualizar, $onde, $where);
		?>
        </tbody>
      </table>
    </div>
  </fieldset>
</div>
<script>
	tabelaDataTable('tb_lista_gerenteTem_grupo');
	tabelaDataTable('tb_lista_gerenteTem_empresa');
</script> 
