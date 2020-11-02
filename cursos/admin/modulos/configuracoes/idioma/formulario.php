<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	
	$Idioma = new Idioma();
		
$idIdioma = $_REQUEST['id'];

if($idIdioma != '' && $idIdioma  > 0){

	$valor = $Idioma->selectIdioma('WHERE idIdioma='.$idIdioma);
	
	$idIdioma = $valor[0]['idIdioma'];
		 $idioma = $valor[0]['idioma'];
		 $icon = $valor[0]['icon'];
		 $inativo = $valor[0]['inativo'];
		 $disponivelAula = $valor[0]['disponivelAula'];
		 $dataCadastro = $valor[0]['dataCadastro'];
		 $excluido = $valor[0]['excluido'];
		 $linkTeste = $valor[0]['linkTeste'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Idioma</legend>
    <form id="form_Idioma" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idIdioma ?>" />
         
         <p>
				<label>Idioma:</label>
				<input type="text" name="idioma" id="idioma" class="required" value="<?php echo $idioma?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
                
                <p>
				<label for="disponivelAula">Disponivel Aula</label>
				  <input type="checkbox" name="disponivelAula" id="disponivelAula" value="1" <?php if($disponivelAula != 0){ ?> checked="checked" <?php } ?> />
				</p>
                
                <p>
				<label for="disponivelAula">Link para teste</label>
				  <input type="text" name="linkTeste" id="linkTeste" value="<?php echo $linkTeste ?>" />
				</p>
                
                
                
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
				
				
                
				

	  
        <button class="button blue" onclick="postForm('form_Idioma', '<?php echo CAMINHO_MODULO?>configuracoes/idioma/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

