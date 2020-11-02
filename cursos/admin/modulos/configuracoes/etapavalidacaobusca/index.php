<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//include_once ($_SERVER['DOCUMENT_ROOT']."/sistema/config/class/Uteis.class.php");
//include_once ($_SERVER['DOCUMENT_ROOT']."/sistema/config/class/EtapaValidacaoBusca.class.php");

$EtapaValidacaoBusca = new EtapaValidacaoBusca();

?>
<div id="cadastro_EtapaValidacaoBusca" class="">
<fieldset>
  <legend>Etapa Validação Busca</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina('<?php echo CAMINHO_MODULO."configuracoes/etapavalidacaobusca/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/etapavalidacaobusca/index.php";?>', '#cadastro_EtapaValidacaoBusca');" /> </div>
<div class="lista"><table id="tb_lista_EtapaValidacaoBusca" class="registros">
    <thead>
      <tr>
	  <th>ID</th><th>Etapa</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/etapavalidacaobusca/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/etapavalidacaobusca/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/etapavalidacaobusca/";		
		
		echo $EtapaValidacaoBusca->selectEtapaValidacaoBuscaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>ID</th><th>Etapa</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_EtapaValidacaoBusca', 'config');</script> 
</div>