<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$TipoCurso = new TipoCurso();
		
$idTipoCurso = $_REQUEST['id'];

if($idTipoCurso != '' && $idTipoCurso  > 0){

	$valor = $TipoCurso->selectTipoCurso('WHERE idTipoCurso='.$idTipoCurso);
	
	$idTipoCurso = $valor[0]['idTipoCurso'];
		 $nome = $valor[0]['nome'];
		 $inativo = $valor[0]['inativo'];
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Tipo Curso</legend>
    <form id="form_TipoCurso" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idTipoCurso ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                
                <p>
				<label>Tipo:</label>
				<input type="text" name="tipo" id="tipo" value="<?php echo $tipo?>" class="required" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
	  
        <button class="button blue" onclick="postForm('form_TipoCurso', '<?php echo CAMINHO_MODULO?>configuracoes/tipoCurso/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

