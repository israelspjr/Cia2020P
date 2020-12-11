<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProdutoAdicionalItemValorSimuladoProposta.class.php");	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProdutoAdicional.class.php");	
		
	$ProdutoAdicionalItemValorSimuladoProposta = new ProdutoAdicionalItemValorSimuladoProposta();	
	$ProdutoAdicional = new ProdutoAdicional();
		
	$idProdutoAdicionalItemValorSimuladoProposta = trim($_GET['id']);
	$idItemValorSimuladoProposta = $_GET['idItemValorSimuladoProposta'];
	
	if($idProdutoAdicionalItemValorSimuladoProposta != '' && $idProdutoAdicionalItemValorSimuladoProposta  > 0){
	
		$valorProdutoAdicionalItemValorSimuladoProposta = $ProdutoAdicionalItemValorSimuladoProposta->selectProdutoAdicionalItemValorSimuladoProposta('WHERE idProdutoAdicionalItemValorSimuladoProposta='.$idProdutoAdicionalItemValorSimuladoProposta);

		$idProdutoAdicional = $valorProdutoAdicionalItemValorSimuladoProposta[0]['produtoAdicional_idProdutoAdicional'];
				
	}
		
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Produto Adicional</legend>
    <div class="agrupa" id="div_form_Proposta">
      <form id="form_ProdutoAdicional" class="validate" action="" method="post" onsubmit="return false" >
		
        
        <input type="hidden" name="idItemValorSimuladoProposta" id="idItemValorSimuladoProposta" value="<?php echo $idItemValorSimuladoProposta ?>" />
        
		<p>
          <label>Produto Adicional:</label>
          <?php 
		  
		  $and=" AND idProdutoAdicional NOT IN (SELECT produtoAdicional_idProdutoAdicional FROM produtoAdicionalItemValorSimuladoProposta WHERE itemValorSimuladoProposta_idItemValorSimuladoProposta = ".$idItemValorSimuladoProposta.")";
		  
		  echo $ProdutoAdicional->selectProdutoAdicionalSelect("required", $idProdutoAdicional, $and);?>
          <span class="placeholder">Campo Obrigatório</span> </p>
          

        <div class="linha-inteira">
          <p>
            <button class="button blue" onclick="postForm('form_ProdutoAdicional', '<?php echo CAMINHO_VENDAS?>proposta/include/acao/produtoAdicional.php?id=<?php echo $idProdutoAdicionalItemValorSimuladoProposta?>');">Salvar</button>
            
          </p>
        </div>
      </form>
    </div>
  </fieldset>
</div>
<script>ativarForm();</script>