<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$SubvencaoMaterialPlanoAcao = new SubvencaoMaterialPlanoAcao();
	
if($idIntegrantePlanoAcao != '' && $idIntegrantePlanoAcao  > 0){

	$valorSubvencaoMaterialPlanoAcao = $SubvencaoMaterialPlanoAcao->selectSubvencaoMaterialPlanoAcao('WHERE integrantePlanoAcao_idIntegrantePlanoAcao='.$idIntegrantePlanoAcao);
	
	$idSubvencaoMaterialPlanoAcao = $valorSubvencaoMaterialPlanoAcao[0]['idSubvencaoMaterialPlanoAcao'];		
	$integrantePlanoAcao_idIntegrantePlanoAcao = $valorSubvencaoMaterialPlanoAcao[0]['integrantePlanoAcao_idIntegrantePlanoAcao'];
	$subvencao = Uteis::exibirMoeda($valorSubvencaoMaterialPlanoAcao[0]['subvencao']);
	$teto = Uteis::formatarMoeda($valorSubvencaoMaterialPlanoAcao[0]['teto'], true);
	$quemPaga = $valorSubvencaoMaterialPlanoAcao[0]['quemPaga'];
}
	
?>

<fieldset>
  <legend>Coparticipação do material didático</legend>
  <form id="form_SubvencaoMaterialPlanoAcao" class="validate" action="" method="post" onsubmit="return false" >
   
    <input type="hidden" name="integrantePlanoAcao_idIntegrantePlanoAcao" id="integrantePlanoAcao_idIntegrantePlanoAcao" value="<?php echo $idIntegrantePlanoAcao ?>" />
    
    <p><label>Valor da subvenção(%):</label>
    <input type="text" name="subvencao" id="subvencao" value="<?php echo $subvencao?>" class="required numeric percentual" maxlength="4" />
    <span class="placeholder">Campo obrigatório</span></p>
    
    <p><label>Valor teto(R$):</label>
    <input type="text" name="teto" id="teto" value="<?php echo $teto?>" class="numeric" />
    <span class="placeholder"></span></p>
    
    <p><label>Quem pagará a subvenção acima:</label>
    <select name="quemPaga" id="quemPaga" class="required">
    	<option value="">Selecione</option>
        <option value="E" <?php echo $quemPaga=='E' ? "selected" : ""?> >Cliente Pessoa Jurídica</option>
		<option value="A" <?php echo $quemPaga=='A' ? "selected" : ""?> >Cliente Pessoa Física</option>                
    </select>
    <span class="placeholder">Campo obrigatório</span>
    </p>	
    
    <div class="linha-inteira">
      <p>
        <button class="button blue" onclick="postForm('form_SubvencaoMaterialPlanoAcao', '<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/subvencaoMaterialPlanoAcao.php');">Salvar</button>
        
      </p>
    </div>
  </form>
</fieldset>
<script>ativarForm();</script>