<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
echo 1;
$ProdutoAdicional = new ProdutoAdicional();

?>
<div id="cadastro_ProdutoAdicional" class="">
<fieldset>
  <legend>ProdutoAdicional</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/produtoadicional/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/produtoadicional/index.php";?>', '#cadastro_ProdutoAdicional');" /> </div>
<div class="lista"><table id="tb_lista_ProdutoAdicional" class="registros">
    <thead>
      <tr>
	  <th>idProdutoAdicional</th><th>Nome</th><th>Descrição</th><th>Valor</th><th>Cobrar por hora</th><th>Status</th><th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/produtoadicional/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/produtoadicional/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/produtoadicional/";		
		
		echo $ProdutoAdicional->selectProdutoAdicionalTrLista($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idProdutoAdicional</th><th>Nome</th><th>Descrição</th><th>Valor</th><th>Cobrar por hora</th><th>Status</th><th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_ProdutoAdicional', 'config');</script> 
</div>