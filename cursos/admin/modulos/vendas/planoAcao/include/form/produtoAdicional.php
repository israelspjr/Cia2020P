<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProdutoAdicional.class.php");	
	
$ProdutoAdicional = new ProdutoAdicional();
		
$idPlanoAcaoProdutoAdicional = $_GET['id'];
$idValorSimuladoPlanoAcao = $_GET['idValorSimuladoPlanoAcao'];		
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Produto Adicional</legend>
    <div class="agrupa" id="div_form_PlanoAcao">
      <form id="form_ProdutoAdicional" class="validate" action="" method="post" onsubmit="return false" >
        <input type="hidden" name="idValorSimuladoPlanoAcao" id="idValorSimuladoPlanoAcao" value="<?php echo $idValorSimuladoPlanoAcao?>" />
        <p>
          <label>Produto Adicional:</label>
          <?php 		  
		  	$and=" AND idProdutoAdicional NOT IN (SELECT produtoAdicional_idProdutoAdicional FROM produtoAdicionalValorSimuladoPlanoAcao WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao.")";
		
		  echo $ProdutoAdicional->selectProdutoAdicionalSelect("required", $idProdutoAdicional, $and);?>
          <span class="placeholder">Campo Obrigatório</span> </p>
        <div class="linha-inteira">
          <p>
            <button class="button blue" onclick="postForm('form_ProdutoAdicional', '<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/produtoAdicional.php?id=<?php echo $idPlanoAcaoProdutoAdicional?>');">Salvar</button>
            
          </p>
        </div>
      </form>
    </div>
  </fieldset>
</div>
<script>ativarForm();</script>