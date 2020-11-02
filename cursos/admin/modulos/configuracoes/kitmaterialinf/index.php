<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/KitMaterialINF.class.php");

$KitMaterialINF = new KitMaterialINF();

?>
<div id="cadastro_KitMaterialINF" class="">
<fieldset>
  <legend>Kit Material I.N.F.</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/kitmaterialinf/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/kitmaterialinf/index.php";?>', '#cadastro_KitMaterialINF');" /> </div>
<div class="lista"><table id="tb_lista_KitMaterialINF" class="registros">
    <thead>
      <tr>
	  <th>idKitMaterialINF</th><th>Kit Material</th><th>Relacionamento I.N.F.</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/kitmaterialinf/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/kitmaterialinf/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE k.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/kitmaterialinf/";		
		
		echo $KitMaterialINF->selectKitMaterialINFTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idKitMaterialINF</th><th>Kit Material</th><th>Relacionamento I.N.F.</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_KitMaterialINF', 'config');</script> 
</div>