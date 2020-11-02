<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoAtividadeExtra.class.php");

$TipoAtividadeExtra = new TipoAtividadeExtra();

?>
<div id="cadastro_TipoAtividadeExtra" class="">
<fieldset>
  <legend>Tipo Atividade Extra</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/tipoatividadeextra/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/tipoatividadeextra/index.php";?>', '#cadastro_TipoAtividadeExtra');" /> </div>
<div class="lista"><table id="tb_lista_TipoAtividadeExtra" class="registros">
    <thead>
      <tr>
	  <th>idTipoAtividadeExtra</th><th>Nome</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/tipoatividadeextra/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/tipoatividadeextra/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/tipoatividadeextra/";		
		
		echo $TipoAtividadeExtra->selectTipoAtividadeExtraTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idTipoAtividadeExtra</th><th>Nome</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_TipoAtividadeExtra', 'config');</script> 
</div>