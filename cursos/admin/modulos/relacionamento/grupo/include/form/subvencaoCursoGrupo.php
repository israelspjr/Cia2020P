<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/SubvencaoCursoGrupo.class.php");

$SubvencaoCursoGrupo = new SubvencaoCursoGrupo();

$idSubvencaoCursoGrupo = $_REQUEST['id'];

if($idSubvencaoCursoGrupo){
	
	$valorSubvencaoCursoGrupo = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo(" WHERE idSubvencaoCursoGrupo = $idSubvencaoCursoGrupo");
	
	$idIntegranteGrupo = $valorSubvencaoCursoGrupo[0]['integranteGrupo_idIntegranteGrupo']; 
	$subvencao = $valorSubvencaoCursoGrupo[0]['subvencao'];
	$teto = Uteis::formatarMoeda($valorSubvencaoCursoGrupo[0]['teto']);
	$quemPaga = $valorSubvencaoCursoGrupo[0]['quemPaga'];
	$dataInicio = Uteis::exibirData($valorSubvencaoCursoGrupo[0]['dataInicio']);
	$obs = $valorSubvencaoCursoGrupo[0]['obs'];
}else{
	$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Subvenção para curso</legend>
    <form id="form_cursoIntegrante" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="idIntegranteGrupo" id="idIntegranteGrupo" value="<?php echo $idIntegranteGrupo?>" />
      <input type="hidden" name="acao" id="acao" value="alterar" />
      <p>
        <label>Data do vínculo:</label>
        <input type="text" name="dataEntrada" id="dataEntrada" class="required data" 
        value=""/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Valor da subvenção(%):</label>
        <input type="text" name="subvencao" id="subvencao" value="<?php echo $subvencao?>" class="required numeric percentual" maxlength="6" />
        <span class="placeholder">Campo obrigatório</span></p>
      <p>
        <label>Valor teto(R$):</label>
        <input type="text" name="teto" id="teto" value="<?php echo $teto?>" class="numeric" />
        <span class="placeholder"></span></p>
      <p>
        <label>Quem pagará a subvenção acima:</label>
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