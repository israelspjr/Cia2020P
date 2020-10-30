<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$SubvencaoCursoGrupo = new SubvencaoCursoGrupo();
$IntegranteGrupo = new IntegranteGrupo();
$idSubvencaoCursoGrupo = $_REQUEST['id'];

if($idSubvencaoCursoGrupo){
	
	$valorSubvencaoCursoGrupo = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo(" WHERE idSubvencaoCursoGrupo = $idSubvencaoCursoGrupo");
	
	$idIntegranteGrupo = $valorSubvencaoCursoGrupo[0]['integranteGrupo_idIntegranteGrupo']; 
	$subvencao = $valorSubvencaoCursoGrupo[0]['subvencao'];
	$teto = Uteis::formatarMoeda($valorSubvencaoCursoGrupo[0]['teto']);
	$quemPaga = $valorSubvencaoCursoGrupo[0]['quemPaga'];
	$dataInicio = Uteis::exibirData($valorSubvencaoCursoGrupo[0]['dataInicio']);
	$obs = $valorSubvencaoCursoGrupo[0]['obs'];
}elseif(isset($_REQUEST['idIntegranteGrupo'])){
	$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
}else{
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;
$alunos =  $IntegranteGrupo->selectIntegranteGrupoSelect("", 0, $where, 1);
}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Coparticipação do curso <?=$idIntegranteGrupo;?></legend>
    <form id="form_cursoIntegrante" class="validate" action="" method="post" onsubmit="return false" >
        <input type="hidden" name="acao" id="acao" value="alterar" />
      <?php if(isset($_REQUEST['idIntegranteGrupo'])){ ?>
        <input type="hidden" name="idIntegranteGrupo" id="idIntegranteGrupo" value="<?php echo $idIntegranteGrupo?>" />
      <?php }else{ ?>
        <p>
            <label for="idIntegranteGrupo">
                <?php echo $alunos; ?>
            </label>
        </p>
      <?php } ?>
      <p>
        <label>Data do vínculo:</label>
        <input type="text" name="dataEntrada" id="dataEntrada" class="required data" 
        value=""/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Valor da Coparticipação(%):</label>
        <input type="text" name="subvencao" id="subvencao" value="<?php echo $subvencao?>" class="required numeric percentual" maxlength="6" />
        <span class="placeholder">Campo obrigatório</span></p>
      <p>
        <label>Valor teto(R$):</label>
        <input type="text" name="teto" id="teto" value="<?php echo $teto?>" class="numeric" />
        <span class="placeholder"></span></p>
      <p>
        <label>Quem pagará a Coparticipação acima:</label>
        <select name="quemPaga" id="quemPaga" class="required">
          <option value="">Selecione</option>
          <option value="E" <?php echo $quemPaga=='E' ? "selected" : ""?> >Cliente Pessoa Jurídica</option>
          <option value="A" <?php echo $quemPaga=='A' ? "selected" : ""?> >Cliente Pessoa Física</option>
        </select>
        <span class="placeholder">Campo obrigatório</span> </p>
     
      <p>
        <button class="button blue" 
          onclick="postForm('form_cursoIntegrante', '<?php echo CAMINHO_REL."grupo/include/acao/subvencaoCursoGrupo.php?id=".$idSubvencaoCursoGrupo?>');"> Enviar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();
</script> 
