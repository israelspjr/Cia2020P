<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PsaProfessor.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoNota.class.php");
	
	
	$PsaProfessor = new PsaProfessor();
	$TipoNota = new TipoNota();
		
$idPsaProfessor = $_REQUEST['id'];

if($idPsaProfessor != '' && $idPsaProfessor  > 0){

	$valor = $PsaProfessor->selectPsaProfessor('WHERE idPsaProfessor='.$idPsaProfessor);
	
	$idPsaProfessor = $valor[0]['idPsaProfessor'];
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
    <legend>Cadastro - PsaProfessor</legend>
    <form id="form_PsaProfessor" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idPsaProfessor ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Tipo Nota:</label>
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
				<input type="text" name="pergunta" id="pergunta" class="required" value="<?php echo $pergunta?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Observação:</label>
				<textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_PsaProfessor', '<?php echo CAMINHO_MODULO?>configuracoes/psaprofessor/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

