<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoNota.class.php");
	
	
	$TipoNota = new TipoNota();
		
$idTipoNota = $_REQUEST['id'];

if($idTipoNota != '' && $idTipoNota  > 0){

	$valor = $TipoNota->selectTipoNota('WHERE idTipoNota='.$idTipoNota);
	
	$idTipoNota = $valor[0]['idTipoNota'];
		 $nome = $valor[0]['nome'];
		 $descricao = $valor[0]['descricao'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 $descritiva = $valor[0]['descritiva'];		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Aspecto</legend>
    <form id="form_TipoNota" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idTipoNota ?>" />
				<p>
          		<label for="inativo">Inativo</label>
         		 <input type="checkbox" name="inativo" id="inativo" <?php if($inativo != 0){ ?> checked="checked" <?php } ?>  value="1"/>
        		</p>
        		
        		<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Descrição:</label>
				<input type="text" name="descricao" id="descricao" class="" value="<?php echo $descricao?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
          		<label for="descritiva">Esta pergunta será dissertativa?</label>
         		 <input type="checkbox" name="descritiva" id="descritiva" <?php if($descritiva != 0){ ?> checked="checked" <?php } ?>  value="1"/>
        		</p>
		
				
	  
        <button class="button blue" onclick="postForm('form_TipoNota', '<?php echo CAMINHO_MODULO?>configuracoes/tiponota/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

