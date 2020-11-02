<?php require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

	
	
	$DescontoGeral = new DescontoGeral();
		
$idDescontoGeral = $_REQUEST['id'];

if($idDescontoGeral != '' && $idDescontoGeral  > 0){

	$valor = $DescontoGeral->selectDescontoGeral('WHERE idDescontoGeral='.$idDescontoGeral);
	
	$idDescontoGeral = $valor[0]['idDescontoGeral'];
		 $nome = $valor[0]['descricao'];
		 $inativo = $valor[0]['inativo'];
		 $valorDesconto = Uteis::formatarMoeda($valor[0]['valor']);
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Desconto Geral</legend>
    <form id="form_DescontoGeral" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idDescontoGeral ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Descricao:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
                <p>
				<label>Valor:</label>
				<input type="text" name="valorDesconto" id="valorDesconto" class="required numeric" value="<?php echo $valorDesconto?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_DescontoGeral', '<?php echo CAMINHO_MODULO?>configuracoes/descontoGeral/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

