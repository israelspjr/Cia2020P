<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$idBuscaAvulsa = $_REQUEST['idBuscaAvulsa'];
$idBuscaAvulsaProfessor = $_REQUEST['id'];
$idProfessor = $_REQUEST['idProfessor'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$OpcaoBuscaProfessorSelecionada = new DiasBuscaAvulsaProfessor();
//$aceito = $_REQUEST['aceito'];
$op = $OpcaoBuscaProfessorSelecionada->selectDiasBuscaAvulsaProfessor("WHERE idDiasBuscaAvulsaProfessor=".$idBuscaAvulsaProfessor);
$motivo = $op[0]['obs'];
$aceito = $op[0]['escolhido'];

?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Observação:</legend>
    <form id="form_rejeicao" class="validate"  method="post" onsubmit="return false" >
      <input id="acao" name="acao" type="hidden" value="alterar" />
      <input id="idBuscaAvulsaProfessor" name="idBuscaAvulsaProfessor" type="hidden" value="<?php echo $idBuscaAvulsaProfessor ?>" />
      <input id="idBuscaAvulsa" name="idBuscaAvulsa" type="hidden" value="<?php echo $idBuscaAvulsa ?>" />
      <input id="idProfessor" name="idProfessor" type="hidden" value="<?php echo $idProfessor ?>" />
      <input id="aceito" name="aceito" type="hidden" value="<?php echo $aceito ?>" />
      <input id="idPlanoAcaoGrupo" name="idPlanoAcaoGrupo" type="hidden" value="<?php echo $idPlanoAcaoGrupo ?>" />
      <p>
        <label for="motivo">Motivo:</label>
        <textarea id="motivo" name="motivo" id="motivo" cols="100" rows="10" class="required"><?php echo $motivo?></textarea>
        <span class="placeholder">Campo obrigatório</span>
      </p>      
      <p>        
      <button class="button blue" onclick="postForm('form_rejeicao', '<?php echo CAMINHO_REL?>busca/avulsa/include/acao/obs.php')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();
</script>