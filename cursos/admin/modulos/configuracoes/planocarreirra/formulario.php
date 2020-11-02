<?php
//pagina conteudo o formulario 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoCarreirra.class.php");


$PlanoCarreirra = new PlanoCarreirra();
		
$idPlanoCarreirra = $_REQUEST['id'];

if($idPlanoCarreirra != '' && $idPlanoCarreirra  > 0){

	$valor = $PlanoCarreirra->selectPlanoCarreirra('WHERE idPlanoCarreira='.$idPlanoCarreirra);
	
	//$idPlanoCarreira = $valor[0]['idPlanoCarreira'];
	 $plano = Uteis::exibirMoeda($valor[0]['plano']);
   $descricao = $valor[0]['descricao'];
	 $inativo = $valor[0]['inativo'];
	 $dataCadastro = $valor[0]['dataCadastro'];
	 $excluido = $valor[0]['excluido'];
	 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Plano Carreira</legend>
    <form id="form_PlanoCarreirra" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idPlanoCarreirra ?>" />
      <p>
        <label>Nome:</label>
        <input type="text" name="descricao" id="descricao" class="required" value="<?php echo $descricao?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
      <p>
        <label>Valor:</label>
        <input type="text" name="plano" id="plano" class="required numeric" value="<?php echo $plano?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label for="inativo">Inativo</label>
        <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <button class="button blue" onclick="postForm('form_PlanoCarreirra', '<?php echo CAMINHO_MODULO?>configuracoes/planocarreirra/grava.php')">Salvar</button>
      
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
