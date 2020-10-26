<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$SubvencaoCursoPlanoAcao = new SubvencaoCursoPlanoAcao();
	
if($idIntegrantePlanoAcao != '' && $idIntegrantePlanoAcao  > 0){

	$valorSubvencaoCursoPlanoAcao = $SubvencaoCursoPlanoAcao->selectSubvencaoCursoPlanoAcao('WHERE integrantePlanoAcao_idIntegrantePlanoAcao='.$idIntegrantePlanoAcao);
	
	$idSubvencaoCursoPlanoAcao = $valorSubvencaoCursoPlanoAcao[0]['idSubvencaoCursoPlanoAcao'];		
	$integrantePlanoAcao_idIntegrantePlanoAcao = $valorSubvencaoCursoPlanoAcao[0]['integrantePlanoAcao_idIntegrantePlanoAcao'];
	$subvencao = Uteis::exibirMoeda($valorSubvencaoCursoPlanoAcao[0]['subvencao']);
	$teto = Uteis::formatarMoeda($valorSubvencaoCursoPlanoAcao[0]['teto'], true);
	$quemPaga = $valorSubvencaoCursoPlanoAcao[0]['quemPaga'];
}
	
?>

<fieldset>
  <legend>Coparticipação do curso </legend>
  <form id="form_SubvencaoCursoPlanoAcao" class="validate" action="" method="post" onsubmit="return false" >
   
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
        <button class="button blue" onclick="postForm('form_SubvencaoCursoPlanoAcao', '<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/subvencaoCursoPlanoAcao.php');">Salvar</button>
        
      </p>
    </div>
  </form>
</fieldset>
<script>ativarForm();</script>