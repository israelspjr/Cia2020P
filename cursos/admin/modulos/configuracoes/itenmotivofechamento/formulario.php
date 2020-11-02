<?php
//pagina conteudo o formulario 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItenMotivoFechamento.class.php");
	
	
	$ItenMotivoFechamento = new ItenMotivoFechamento();
		
$idItenMotivoFechamento = $_REQUEST['id'];

if($idItenMotivoFechamento != '' && $idItenMotivoFechamento  > 0){

	$valor = $ItenMotivoFechamento->selectItenMotivoFechamento('WHERE idItenMotivoFechamento='.$idItenMotivoFechamento);
	
	$idItenMotivoFechamento = $valor[0]['idItenMotivoFechamento'];
		 $iten = $valor[0]['iten'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();"></div>
  <fieldset>
    <legend>Cadastro - Item Motivo Fechamento</legend>
    <form id="form_ItenMotivoFechamento" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idItenMotivoFechamento ?>" />
				<p>
				<label>Item:</label>
				<input type="text" name="iten" id="iten" class="required" value="<?php echo $iten?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
				
	  
        <button class="button blue" onclick="postForm('form_ItenMotivoFechamento', '<?php echo CAMINHO_MODULO?>configuracoes/itenmotivofechamento/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

