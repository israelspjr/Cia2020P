<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$SubvencaoMaterialGrupo = new SubvencaoMaterialGrupo();

$idSubvencaoMaterialGrupo = $_REQUEST['id'];

if($idSubvencaoMaterialGrupo){
	
	$valorSubvencaoMaterialGrupo = $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupo(" WHERE idSubvencaoMaterialGrupo = $idSubvencaoMaterialGrupo");
	
	$idIntegranteGrupo = $valorSubvencaoMaterialGrupo[0]['integranteGrupo_idIntegranteGrupo']; 
	$subvencao = $valorSubvencaoMaterialGrupo[0]['subvencao'];
	$teto = Uteis::formatarMoeda($valorSubvencaoMaterialGrupo[0]['teto']);
	$quemPaga = $valorSubvencaoMaterialGrupo[0]['quemPaga'];
	$dataInicio = Uteis::exibirData($valorSubvencaoMaterialGrupo[0]['dataInicio']);
	$obs = $valorSubvencaoMaterialGrupo[0]['obs'];
}else{
	$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Coparticipação do Material do Curso</legend>
    <form id="form_cursoIntegrante" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="acao" value="alterar" />
      <input type="hidden" name="idIntegranteGrupo" id="idIntegranteGrupo" value="<?php echo $idIntegranteGrupo?>" />
      <p>
        <label>Data do inicio:</label>
        <input type="text" name="dataInicio" id="dataInicio" class="required data" value="" />
        <span class="placeholder">Campo Obrigatório</span> </p>      
      <p>
        <label>Valor da coparticipação(%):</label>
        <input type="text" name="subvencao" id="subvencao" value="<?php echo $subvencao?>" class="required numeric percentual" maxlength="6" />
        <span class="placeholder">Campo obrigatório</span></p>
      <p>
        <label>Valor teto(R$):</label>
        <input type="text" name="teto" id="teto" value="<?php echo $teto?>" class="numeric" />
        <span class="placeholder"></span></p>
      <p>
        <label>Quem pagará a coparticipação acima:</label>
        <select name="quemPaga" id="quemPaga" class="required">
          <option value="">Selecione</option>
          <option value="E" <?php echo $quemPaga=='E' ? "selected" : ""?> >Cliente Pessoa Jurídica</option>
          <option value="A" <?php echo $quemPaga=='A' ? "selected" : ""?> >Cliente Pessoa Física</option>
        </select>
        <span class="placeholder">Campo obrigatório</span> </p>
        <p>
        <button class="button blue" 
          onclick="postForm('form_cursoIntegrante', '<?php echo CAMINHO_REL."grupo/include/acao/subvencaoMaterialGrupo.php?id=".$idSubvencaoMaterialGrupo?>');"> Enviar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();
</script> 
