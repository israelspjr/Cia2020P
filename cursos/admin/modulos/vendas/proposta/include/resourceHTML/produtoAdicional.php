<?php
	
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProdutoAdicionalItemValorSimuladoProposta.class.php");

	$ProdutoAdicionalItemValorSimuladoProposta = new ProdutoAdicionalItemValorSimuladoProposta();
	
	$idItemValorSimuladoProposta = $_GET['id'];

?>

<fieldset>
  <legend>Produto Adicional</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."proposta/include/form/produtoAdicional.php";?>?idItemValorSimuladoProposta=<?php echo $idItemValorSimuladoProposta?>', '<?php echo CAMINHO_VENDAS."proposta/include/resourceHTML/produtoAdicional.php?id=".$idItemValorSimuladoProposta?>', '#div_lista_ProdutoAdicional');" /> </div>
  <div class="lista">
    <table id="tb_lista_ProdutoAdicional" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Valor(somado por hora)</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $ProdutoAdicionalItemValorSimuladoProposta->selectProdutoAdicionalItemValorSimuladoPropostaTr(" WHERE itemValorSimuladoProposta_idItemValorSimuladoProposta = ".$idItemValorSimuladoProposta);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Valor(somado por hora)</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_ProdutoAdicional');</script> 
