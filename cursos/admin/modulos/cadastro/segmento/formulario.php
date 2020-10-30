<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

	
$Segmento = new Segmento();

$idSegmento = $_GET['id'];	


if($idSegmento!='' && $idSegmento>0){
	
	$valorSegmento = $Segmento->selectSegmento('WHERE idSegmento='.$idSegmento);
	
	$idSegmento = $valorSegmento[0]['idSegmento'];

	$descricao = $valorSegmento[0]['valor'];
	$inativo = $valorSegmento[0]['inativo'];
	$sistema = $valorSegmento[0]['sistema'];
	$bc = $valorSegmento[0]['bc'];
		
}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <!--clientePf_idClientePf é a FK-->
  
  <fieldset>
    <legend>Segmento</legend>
    <form id="form_Segmento" class="validate" method="post" action="" onsubmit="return false" >
    <input type="hidden" value="<?php echo $bc?>" name="bc" id="bc" />

      <div class="esquerda">                 
        <p>
          <label>Descrição:</label>          
          <input type="text" name="descricao" id="descricao"  class="required" onsubmit="return false" value="<?php echo $descricao?>" />
      <span class="placeholder">Campo Obrigatório</span>
        <!--funcao retorna descricaoSegmento-->
        </p>
         <p>
          <label>
            <input type="checkbox" name="sistema" id="sistema" value="1" <?php if($sistema != 0){ ?> checked="checked" <?php } ?> />
            Sistema</label>
        </p>
        
         <p>
          <label>
            <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
            Inativo</label>
        </p>
        
          <p>
        <button class="button blue" onclick="postForm('form_Segmento', '<?php echo CAMINHO_CAD?>segmento/grava.php?id=<?php echo $idSegmento?>')">Salvar</button>
        
      </p>
 
          </div>
      <div class="direita">
 
    
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 