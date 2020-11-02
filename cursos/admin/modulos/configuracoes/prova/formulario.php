<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Prova.class.php");
	
	
	$Prova = new Prova();
		
$idProva = $_REQUEST['id'];

if($idProva != '' && $idProva  > 0){

	$valor = $Prova->selectProva('WHERE idProva='.$idProva);
	
	$idProva = $valor[0]['idProva'];
		 $nome = $valor[0]['nome'];
		 $ordem = $valor[0]['ordem'];
		 $obs = $valor[0]['obs'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Prova</legend>
    <form id="form_Prova" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idProva ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                
                <p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Ordem:</label>
				<input type="text" name="ordem" id="ordem" class="required" value="<?php echo $ordem?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Observação:</label>
				<textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_Prova', '<?php echo CAMINHO_MODULO?>configuracoes/prova/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

