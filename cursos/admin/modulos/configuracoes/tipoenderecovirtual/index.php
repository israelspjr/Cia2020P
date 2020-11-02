<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoEnderecoVirtual.class.php");

$TipoEnderecoVirtual = new TipoEnderecoVirtual();

?>
<div id="cadastro_TipoEnderecoVirtual" class="">
<fieldset>
  <legend>Tipo Endereço Virtual</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/tipoenderecovirtual/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/tipoenderecovirtual/index.php";?>', '#cadastro_TipoEnderecoVirtual');" /> </div>
<div class="lista"><table id="tb_lista_TipoEnderecoVirtual" class="registros">
    <thead>
      <tr>
	  <th>idTipoEnderecoVirtual</th><th>Tipo</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/tipoenderecovirtual/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/tipoenderecovirtual/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/tipoenderecovirtual/";		
		
		echo $TipoEnderecoVirtual->selectTipoEnderecoVirtualTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idTipoEnderecoVirtual</th><th>Tipo</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_TipoEnderecoVirtual', 'config');</script> 
</div>