<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$TipoQuestao = new TipoQuestao();

$idTipoQuestao = $_GET['id'];	



if($idTipoQuestao!='' && $idTipoQuestao>0){
	
	$valorTipoQuestao = $TipoQuestao->selectTipoQuestao(' WHERE idTipoQuestao='.$idTipoQuestao);
	
	$idTipoQuestao = $valorTipoQuestao[0]['idTipoQuestao'];
	$descricao = $valorTipoQuestao[0]['descricao'];
//	$link = $valorTipoQuestao[0]['link'];
//	$ordem = $valorTipoQuestao[0]['ordem'];
	$inativo = $valorTipoQuestao[0]['inativo'];
//	$TipoQuestao_idTipoQuestao = $valorTipoQuestao[0]['TipoQuestao_idTipoQuestao'];

}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <!--clientePf_idClientePf é a FK-->
  
  <fieldset>
    <legend>Tipo Questão</legend>
    <form id="form_TipoQuestao" class="validate" method="post" action="" onsubmit="return false" >
    
 
      <div class="esquerda">  
           
        <p>
          <label>Descrição:</label>          
          <input type="text" name="descricao" id="descricao"  class="required" onsubmit="return false" value="<?php echo $descricao?>" />
      <span class="placeholder">Campo Obrigatório</span>
        <!--funcao retorna descricaoTipoQuestao-->
        </p>
         
         <p>
          <label>
            <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
            Inativo</label>
        </p>
          <p>
        <button class="button blue" onclick="postForm('form_TipoQuestao', '<?php echo CAMINHO_CAD?>tipoQuestao/grava.php?id=<?php echo $idTipoQuestao?>')">Salvar</button>
        
      </p>
  
          </div>

    
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 