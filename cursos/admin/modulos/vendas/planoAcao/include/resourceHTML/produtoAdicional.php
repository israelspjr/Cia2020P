<?php
	
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProdutoAdicionalValorSimuladoPlanoAcao.class.php");

$ProdutoAdicionalValorSimuladoPlanoAcao = new ProdutoAdicionalValorSimuladoPlanoAcao();

$idValorSimuladoPlanoAcao = $_GET['id'];

?>

<fieldset>
  <legend>Produto Adicional</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."planoAcao/include/form/produtoAdicional.php";?>?idValorSimuladoPlanoAcao=<?php echo $idValorSimuladoPlanoAcao?>', '<?php echo CAMINHO_VENDAS."planoAcao/include/resourceHTML/produtoAdicional.php?id=".$idValorSimuladoPlanoAcao?>', '#div_lista_ProdutoAdicional');" /> </div>
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
        <?php echo $ProdutoAdicionalValorSimuladoPlanoAcao->selectProdutoAdicionalValorSimuladoPlanoAcaoTr(" WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao);?>
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
<script> tabelaDataTable('tb_lista_ProdutoAdicional', 'simples');</script> 
