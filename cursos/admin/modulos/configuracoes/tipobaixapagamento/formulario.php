<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoBaixaPagamento.class.php");
	
	
	$TipoBaixaPagamento = new TipoBaixaPagamento();
		
$idTipoBaixaPagamento = $_REQUEST['id'];

if($idTipoBaixaPagamento != '' && $idTipoBaixaPagamento  > 0){

	$valor = $TipoBaixaPagamento->selectTipoBaixaPagamento('WHERE idTipoBaixaPagamento='.$idTipoBaixaPagamento);
	
	$idTipoBaixaPagamento = $valor[0]['idTipoBaixaPagamento'];
		 $nome = $valor[0]['nome'];
		 $inativo = $valor[0]['inativo'];
		 $dataCadastro = $valor[0]['dataCadastro'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Tipo Baixa Pagamento</legend>
    <form id="form_TipoBaixaPagamento" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idTipoBaixaPagamento ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
				<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
	  
        <button class="button blue" onclick="postForm('form_TipoBaixaPagamento', '<?php echo CAMINHO_MODULO?>configuracoes/tipobaixapagamento/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

