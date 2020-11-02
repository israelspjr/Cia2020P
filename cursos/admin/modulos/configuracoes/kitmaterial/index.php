<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/KitMaterial.class.php");

$KitMaterial = new KitMaterial();

?>

<div id="cadastro_KitMaterial" class="">
  <fieldset>
    <legend>Kit Material</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/kitmaterial/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/kitmaterial/index.php";?>', '#cadastro_KitMaterial');" /> </div>
    <div class="lista">
      <table id="tb_lista_KitMaterial" class="registros">
        <thead>
          <tr>
            <th>idKitMaterial</th>
            <th>Nome</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/kitmaterial/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/kitmaterial/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/kitmaterial/";		
		
		echo $KitMaterial->selectKitMaterialTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idKitMaterial</th>
            <th>Nome</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_KitMaterial', 'config');</script> 
</div>
