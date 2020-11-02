<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MeioLocomocao.class.php");
	
	
	$MeioLocomocao = new MeioLocomocao();
		
$idMeioLocomocao = $_REQUEST['id'];

if($idMeioLocomocao != '' && $idMeioLocomocao  > 0){

	$valor = $MeioLocomocao->selectMeioLocomocao('WHERE idMeioLocomocao='.$idMeioLocomocao);
	
	$idMeioLocomocao = $valor[0]['idMeioLocomocao'];
		 $nome = $valor[0]['nome'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Meio Locomoção</legend>
    <form id="form_MeioLocomocao" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idMeioLocomocao ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                
                <p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_MeioLocomocao', '<?php echo CAMINHO_MODULO?>configuracoes/meiolocomocao/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

