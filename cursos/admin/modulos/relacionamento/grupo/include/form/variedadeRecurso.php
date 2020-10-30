<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$AcompanhamentoCurso = new AcompanhamentoCurso();
$VariedadeRecurso = new VariedadeRecurso();
$TipoVariedadeRecurso = new TipoVariedadeRecurso();

$idVariedadeRecurso = $_REQUEST['id'];
$idAcompanhamentoCurso = $_REQUEST['idAcompanhamentoCurso'];

if(is_numeric($idVariedadeRecurso) && $idVariedadeRecurso > 0){
	$rs = $VariedadeRecurso->selectVariedadeRecurso(" WHERE idVariedadeRecurso = ".$idVariedadeRecurso);
	$idAcompanhamentoCurso= $rs[0]['acompanhamentoCurso_idAcompanhamentoCurso'];
	$titulo= $rs[0]['titulo'];
	$dataAplicacao= Uteis::exibirData($rs[0]['dataAplicacao']);
	$idTipoVariedadeRecurso= $rs[0]['tipoVariedadeRecurso_idTipoVariedadeRecurso'];
	$obs= $rs[0]['obs'];
}
$mostrarAcoes = $AcompanhamentoCurso->verificaPodeEditar($idAcompanhamentoCurso);
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Variedade de Recurso </legend>
    <form id="form_VariedadeRecurso" class="validate" method="post" action="" onsubmit="return false" >
      <input name="idAcompanhamentoCurso" type="hidden" value="<?php echo $idAcompanhamentoCurso?>" />
      <p>
        <label>Tipo:</label>
        <?php echo $TipoVariedadeRecurso->selectTipoVariedadeRecursoSelect("required", $idTipoVariedadeRecurso, " WHERE inativo = 0")?>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Título:</label>
        <input type="text" name="titulo" id="titulo" class="required" value="<?php echo $titulo?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Data da aplicação:</label>
        <input type="text" name="dataAplicacao" id="dataAplicacao" class="required data" value="<?php echo $dataAplicacao?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <?php if($mostrarAcoes){?>
        <button class="button blue" onclick="postForm('form_VariedadeRecurso', '<?php echo CAMINHO_REL."grupo/include/acao/variedadeRecurso.php?id=$idVariedadeRecurso"?>');">Salvar</button>
              
        <?php } ?>
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
