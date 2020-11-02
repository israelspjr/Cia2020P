<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoItenRelatorioDesempenho.class.php");

$TipoItenRelatorioDesempenho = new TipoItenRelatorioDesempenho();

?>
<div id="cadastro_TipoItenRelatorioDesempenho" class="">
<fieldset>
  <legend>Tipo Item Relatório Desempenho</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/tipoitenrelatoriodesempenho/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/tipoitenrelatoriodesempenho/index.php";?>', '#cadastro_TipoItenRelatorioDesempenho');" /> </div>
<div class="lista"><table id="tb_lista_TipoItenRelatorioDesempenho" class="registros">
    <thead>
      <tr>
	  <th>idTipoItenRelatorioDesempenho</th><th>Nome</th><th>Status</th><th>Avaliação</th><th>Reavaliação</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/tipoitenrelatoriodesempenho/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/tipoitenrelatoriodesempenho/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/tipoitenrelatoriodesempenho/";		
		
		echo $TipoItenRelatorioDesempenho->selectTipoItenRelatorioDesempenhoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
       <th>idTipoItenRelatorioDesempenho</th><th>Nome</th><th>Status</th><th>Avaliação</th><th>Reavaliação</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_TipoItenRelatorioDesempenho', 'config');</script> 
</div>