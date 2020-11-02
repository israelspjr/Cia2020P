<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$ItenRelatorioDesempenho = new ItenRelatorioDesempenho();
	$TipoItenRelatorioDesempenho = new TipoItenRelatorioDesempenho();
		
$idItenRelatorioDesempenho = $_REQUEST['id'];

if($idItenRelatorioDesempenho != '' && $idItenRelatorioDesempenho  > 0){

	$valor = $ItenRelatorioDesempenho->selectItenRelatorioDesempenho('WHERE idItenRelatorioDesempenho='.$idItenRelatorioDesempenho);
	
	$idItenRelatorioDesempenho = $valor[0]['idItenRelatorioDesempenho'];
		 $nome = $valor[0]['nome'];
		 $inativo = $valor[0]['inativo'];
		 $tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho = $valor[0]['tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho'];
		 $excluido = $valor[0]['excluido'];
         $orientacao = $valor[0]['orientacao'];	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Item Relatório Desempenho</legend>
    <form id="form_ItenRelatorioDesempenho" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idItenRelatorioDesempenho ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                
                <p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
				<p>
				<label>Tipo Item Relatório Desempenho:</label>
				
                <?php echo $TipoItenRelatorioDesempenho->selectTipoItenRelatorioDesempenhoSelect("required", $tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho, " WHERE inativo = 0 AND excluido = 0"); ?>
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				    <label>Orientação:</label>
				    <textarea id="orientacao_base" name="orientacao_base" ><?php echo $orientacao ?></textarea>
				    <textarea id="orientacao" name="orientacao" ></textarea>
				</p>    
	  
        <button class="button blue" onclick="postForm_editor('orientacao','form_ItenRelatorioDesempenho', '<?php echo CAMINHO_MODULO?>configuracoes/itenrelatoriodesempenho/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>
viraEditor('orientacao');
ativarForm();
</script> 

