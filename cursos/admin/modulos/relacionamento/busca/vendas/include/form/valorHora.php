<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$idBuscaProfessor = $_REQUEST['idBuscaProfessor'];
$idProfessor = $_REQUEST['idProfessor'];
//$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$OpcaoBuscaProfessorSelecionada = new OpcaoBuscaProfessorSelecionada();
//$aceito = $_REQUEST['aceito'];
$op = $OpcaoBuscaProfessorSelecionada->selectOpcaoBuscaProfessorSelecionada("WHERE buscaProfessor_idBuscaProfessor=".$idBuscaProfessor." AND professor_idProfessor = ".$idProfessor);
$valorHora = $op[0]['valorHora'];

?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Registro de novo valor hora para professor: <?php echo $motivo?></legend>
    <form id="form_rejeicao" class="validate"  method="post" onsubmit="return false" >
      <input id="acao" name="acao" type="hidden" value="alterar" />
      <input id="idBuscaProfessor" name="idBuscaProfessor" type="hidden" value="<?php echo $idBuscaProfessor ?>" />
      <input id="idProfessor" name="idProfessor" type="hidden" value="<?php echo $idProfessor ?>" />
      <input id="aceito" name="aceito" type="hidden" value="<?php echo $aceito ?>" />
      <input id="idPlanoAcaoGrupo" name="idPlanoAcaoGrupo" type="hidden" value="<?php echo $idPlanoAcaoGrupo ?>" />
      <p>
        <label>Valor:</label>
       <input id="valorHora" name="valorHora" type="text" value="<?php echo $valorHora ?>" /> 
<!--        <textarea id="motivo" name="motivo" id="motivo" class="required"><?php echo $motivo?></textarea>         -->
        <span class="placeholder">Campo obrigatório</span>
      </p>      
      <p>        
      <button class="button blue" onclick="postForm('form_rejeicao', '<?php echo CAMINHO_REL?>busca/vendas/include/acao/valorHora.php')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();

</script>