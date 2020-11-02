<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

	$PsaRegular = new PsaRegular();
	$TipoNota = new TipoNota();
		
$idPsaRegular = $_REQUEST['id'];

if($idPsaRegular != '' && $idPsaRegular  > 0){

	$valor = $PsaRegular->selectPsaRegular('WHERE idPsa='.$idPsaRegular);
	

		 $tipo = $valor[0]['tipo'];
		 $titulo = $valor[0]['titulo'];
		 $pergunta = $valor[0]['pergunta'];
		 $obs = $valor[0]['obs'];
		 $inativo = $valor[0]['inativo'];
		 $dataCadastro = $valor[0]['dataCadastro'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - P.S.A. Regular</legend>
    <form id="form_PsaRegular" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idPsaRegular ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
				<p>
				<label>Tipo:</label>
				<?php echo $TipoNota->selectTipoNotaSelect("required", $tipo, " WHERE inativo = 0 AND excluido = 0"); ?>

				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Título:</label>
				<input type="text" name="titulo" id="titulo" class="required" value="<?php echo $titulo?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Pergunta:</label>
				<textarea class="required" rows="5" name="pergunta" id="pergunta" cols="100"><?php echo $pergunta;?></textarea>
                
              <!--  <input type="text" name="pergunta" id="pergunta" class="required" value="<?php echo $pergunta?>" />-->
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Observação:</label>
				<textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_PsaRegular', '<?php echo CAMINHO_MODULO?>configuracoes/psaregular/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

