<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/LocalAula.class.php");
	
	
	$LocalAula = new LocalAula();
		
$idLocalAula = $_REQUEST['id'];

if($idLocalAula != '' && $idLocalAula  > 0){

	$valor = $LocalAula->selectLocalAula('WHERE idLocalAula='.$idLocalAula);
	
	$idLocalAula = $valor[0]['idLocalAula'];
		 $local = $valor[0]['local'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - LocalAula</legend>
    <form id="form_LocalAula" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idLocalAula ?>" />
				<p>
          <label for="inativo">Inativo</label>
          <input type="checkbox" name="inativo" id="inativo" <?php if($inativo != 0){ ?> checked="checked" <?php } ?>  value="1"/>
        </p> 
        
        <p>
				<label>Local:</label>
				<input type="text" name="local" id="local" class="required" value="<?php echo $local?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_LocalAula', '<?php echo CAMINHO_MODULO?>configuracoes/localaula/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

