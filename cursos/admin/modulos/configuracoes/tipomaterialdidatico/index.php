<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoMaterialDidatico.class.php");

$TipoMaterialDidatico = new TipoMaterialDidatico();

?>
<div id="cadastro_TipoMaterialDidatico" class="">
<fieldset>
  <legend>Tipo Material Didático</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/tipomaterialdidatico/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/tipomaterialdidatico/index.php";?>', '#cadastro_TipoMaterialDidatico');" /> </div>
<div class="lista"><table id="tb_lista_TipoMaterialDidatico" class="registros">
    <thead>
      <tr>
	  <th>idTipoMaterialDidatico</th><th>Tipo</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/tipomaterialdidatico/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/tipomaterialdidatico/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/tipomaterialdidatico/";		
		
		echo $TipoMaterialDidatico->selectTipoMaterialDidaticoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idTipoMaterialDidatico</th><th>Tipo</th><th>Status</th>
		<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_TipoMaterialDidatico', 'config');</script> 
</div>