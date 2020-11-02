<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$ComoConheceu = new ComoConheceu();
		
$idComoConheceu = $_REQUEST['id'];

if($idComoConheceu != '' && $idComoConheceu  > 0){

	$valor = $ComoConheceu->selectComoConheceu('WHERE idComoConheceu='.$idComoConheceu);
	
	$idComoConheceu = $valor[0]['idComoConheceu'];
		 $comoConheceu = $valor[0]['comoConheceu'];
		 $inativo = $valor[0]['inativo'];
		 $aluno = $valor[0]['aluno'];
		 $professor = $valor[0]['professor'];
		 $geral = $valor[0]['geral'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Como Conheceu</legend>
    <form id="form_ComoConheceu" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idComoConheceu ?>" />
         		<p>
				<label>Como Conheceu:</label>
				<input type="text" name="comoConheceu" id="comoConheceu" class="required" value="<?php echo $comoConheceu?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p>
                <p>
				<label for="inativo">Somente para Aluno</label>
				  <input type="radio" name="comoConheceuF" id="comoConheceuF" value="1" <?php if($aluno != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label for="inativo">Somente para Professor</label>
				  <input type="radio" name="comoConheceuF" id="comoConheceuF" value="2" <?php if($professor != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label for="inativo">Geral</label>
				  <input type="radio" name="comoConheceuF" id="comoConheceuF" value="3" <?php if($geral != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
				 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_ComoConheceu', '<?php echo CAMINHO_MODULO?>configuracoes/comoconheceu/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

