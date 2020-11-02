<?php
//pagina conteudo o formulario 
	include_once($_SERVER['DOCUMENT_ROOT']."/sistema/config/admin.php");
	include_once($_SERVER['DOCUMENT_ROOT']."/sistema/config/class/Uteis.class.php");
	include_once($_SERVER['DOCUMENT_ROOT']."/sistema/config/class/EtapaValidacaoBusca.class.php");
	
	
	$EtapaValidacaoBusca = new EtapaValidacaoBusca();
		
$idEtapaValidacaoBusca = $_REQUEST['id'];

if($idEtapaValidacaoBusca != '' && $idEtapaValidacaoBusca  > 0){

	$valor = $EtapaValidacaoBusca->selectEtapaValidacaoBusca('WHERE idEtapaValidacaoBusca='.$idEtapaValidacaoBusca);
	
	$idEtapaValidacaoBusca = $valor[0]['idEtapaValidacaoBusca'];
		 $etapa = $valor[0]['etapa'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Etapa Validação Busca</legend>
    <form id="form_EtapaValidacaoBusca" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idEtapaValidacaoBusca ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Etapa:</label>
				<input type="text" name="etapa" id="etapa" class="required" value="<?php echo $etapa?>" />
				<span>Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_EtapaValidacaoBusca', '<?php echo CAMINHO_MODULO?>configuracoes/etapavalidacaobusca/grava.php')">Salvar</button>
        <!--<button class="button gray reset">Limpar</button>-->
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

