<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItenProva.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Prova.class.php");
	
	
	$ItenProva = new ItenProva();
	$Prova = new Prova();
		
$idItenProva = $_REQUEST['id'];

if($idItenProva != '' && $idItenProva  > 0){

	$valor = $ItenProva->selectItenProva('WHERE idItenProva='.$idItenProva);
	
	$idItenProva = $valor[0]['idItenProva'];
		 $prova_idProva = $valor[0]['prova_idProva'];
		 $nome = $valor[0]['nome'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - ItenProva</legend>
    <form id="form_ItenProva" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idItenProva ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Prova:</label>
                <?php echo $Prova->selectProvaSelect("required", $prova_idProva, " WHERE inativo = 0 AND excluido = 0"); ?>
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_ItenProva', '<?php echo CAMINHO_MODULO?>configuracoes/itenprova/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

