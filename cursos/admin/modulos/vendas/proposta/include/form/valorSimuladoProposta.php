<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ValorSimuladoProposta.class.php");	
		
		
	$ValorSimuladoProposta = new ValorSimuladoProposta();	
		
	$idValorSimuladoProposta = $_GET['id'];
	$proposta_idProposta = $_GET['idProposta'];
	
	if($idValorSimuladoProposta != '' && $idValorSimuladoProposta  > 0){
	
		$valorValorSimuladoProposta = $ValorSimuladoProposta->selectValorSimuladoProposta('WHERE idValorSimuladoProposta='.$idValorSimuladoProposta);

		$proposta_idProposta = $valorValorSimuladoProposta[0]['proposta_idProposta'];
		$nome = $valorValorSimuladoProposta[0]['nome'];			
	}	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Valor simulado</legend>
    <form id="form_ValorSimuladoProposta" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="proposta_idProposta" id="proposta_idProposta" value="<?php echo $proposta_idProposta ?>" />
      <p>
        <label>Descrição:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $nome?>" class="required" />
        <span class="placeholder">Campo obrigatório</span>
      </p>
      
      <div class="linha-inteira">
        <p>
          <button class="button blue" onclick="postForm('form_ValorSimuladoProposta', '<?php echo CAMINHO_VENDAS?>proposta/include/acao/valorSimuladoProposta.php?id=<?php echo $idValorSimuladoProposta?>');">Salvar</button>
          
        </p>
      </div>
    </form>
    
    <?php if($idValorSimuladoProposta != '' && $idValorSimuladoProposta  > 0){?>    
	    <div id="div_lista_itemValorSimuladoProposta">
    	<?php require_once $_SERVER['DOCUMENT_ROOT'].CAMINHO_VENDAS."proposta/include/resourceHTML/itemValorSimuladoProposta.php";?>
	    </div>
	<?php } ?>
    
  </fieldset>
</div>
<script>ativarForm();</script>