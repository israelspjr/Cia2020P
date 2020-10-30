<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$AulaGrupoProfessor = new AulaGrupoProfessor();

$idAulaPermanenteGrupo = $_REQUEST['idAulaPermanenteGrupo'];
$idProfessor = $_REQUEST['idProfessor'];
$idAulaGrupo = $_REQUEST['id'];

if ($idAulaPermanenteGrupo > 0) {
	$and = 	" AND aulaPermanenteGrupo_idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo;
}
$idAulaFixa = $_REQUEST['idAulaFixa'];
if ($idAulaFixa > 0) {
	$and = 	" AND aulaDataFixa_idAulaDataFixa = ".$idAulaFixa;
}
if ($idAulaGrupo > 0) {
	$and = " AND idAulaGrupoProfessor = ".$idAulaGrupo;	
}

$where = " WHERE professor_idProfessor = ".$idProfessor. $and;



$rs = $AulaGrupoProfessor->selectAulaGrupoProfessor($where);

if ($rs[0]['plano'] > 0) {
	$valorHora = Uteis::formatarMoeda($rs[0]['plano']);
}
$idAulaPermanenteGrupo = $rs[0]['aulaPermanenteGrupo_idAulaPermanenteGrupo'];

$dataInicio = Uteis::exibirData($rs[0]['dataInicio']);

?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Registro de novo valor hora para professor: <?php echo $motivo?></legend>
    <form id="form_rejeicao" class="validate"  method="post" onsubmit="return false" >
      <input id="acao" name="acao" type="hidden" value="alterar" />
      <input id="idAulaPermanenteGrupo" name="idAulaPermanenteGrupo" type="hidden" value="<?php echo $idAulaPermanenteGrupo ?>" />
    <input id="idAulaFixa" name="idAulaFixa" type="hidden" value="<?php echo $idAulaFixa ?>" />
      <input id="idProfessor" name="idProfessor" type="hidden" value="<?php echo $idProfessor ?>" />
      <input id="aceito" name="aceito" type="hidden" value="<?php echo $aceito ?>" />
      <input id="idPlanoAcaoGrupo" name="idPlanoAcaoGrupo" type="hidden" value="<?php echo $idPlanoAcaoGrupo ?>" />
      <p>
        <label>Valor:</label>
       <input id="valorHora" name="valorHora" type="text" value="<?php echo $valorHora ?>" /> 
<!--        <textarea id="motivo" name="motivo" id="motivo" class="required"><?php echo $motivo?></textarea>         -->
        <span class="placeholder">Campo obrigatório</span>
     </p>      
     <p><label>A partir de qual data? </label>
   <input type="text" name="dataInicio" id="dataInicio" class="required data" value="<?php echo $dataInicio;?>" >
      <p>        
      <button class="button blue" onclick="postForm('form_rejeicao', '<?php echo CAMINHO_REL?>grupo/include/acao/valorHora.php')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();

</script>