<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItenRelatorioDesempenho.class.php");

$ItenRelatorioDesempenho = new ItenRelatorioDesempenho();

?>
<div id="cadastro_ItenRelatorioDesempenho" class="">
<fieldset>
  <legend>Item Relatório Desempenho</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/itenrelatoriodesempenho/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/itenrelatoriodesempenho/index.php";?>', '#cadastro_ItenRelatorioDesempenho');" /> </div>
<div class="lista"><table id="tb_lista_ItenRelatorioDesempenho" class="registros">
    <thead>
      <tr>
	  <th>idItenRelatorioDesempenho</th><th>Nome</th><th>Status</th><th>Tipo Item Relatório Desempenho</th><th>Orientação</th><th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/itenrelatoriodesempenho/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/itenrelatoriodesempenho/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE i.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/itenrelatoriodesempenho/";		
		
		echo $ItenRelatorioDesempenho->selectItenRelatorioDesempenhoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idItenRelatorioDesempenho</th><th>Nome</th><th>Status</th><th>Tipo Item Relatório Desempenho</th><th>Orientação</th><th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_ItenRelatorioDesempenho', 'config');</script> 
</div>