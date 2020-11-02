<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/DescricaoTelefone.class.php");
	
	
	$DescricaoTelefone = new DescricaoTelefone();
		
$idDescricaoTelefone = $_REQUEST['id'];

if($idDescricaoTelefone != '' && $idDescricaoTelefone  > 0){

	$valor = $DescricaoTelefone->selectDescricaoTelefone('WHERE idDescricaoTelefone='.$idDescricaoTelefone);
	
	$idDescricaoTelefone = $valor[0]['idDescricaoTelefone'];
		 $nome = $valor[0]['nome'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Descrição Telefone</legend>
    <form id="form_DescricaoTelefone" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idDescricaoTelefone ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_DescricaoTelefone', '<?php echo CAMINHO_MODULO?>configuracoes/descricaotelefone/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

