<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$FechamentoGrupo = new FechamentoGrupo();
$ItenMotivoFechamento = new ItenMotivoFechamento();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
	
$idFechamentoGrupo = $_GET['id'];
$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];	

if($idFechamentoGrupo){

	$valorFechamentoGrupo = $FechamentoGrupo->selectFechamentoGrupo(" WHERE idFechamentoGrupo = $idFechamentoGrupo");

	$idPlanoAcaoGrupo = $valorFechamentoGrupo[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
	$dataCadastro = Uteis::exibirData($valorFechamentoGrupo[0]['dataFechamento']);	
	$tipo = $valorFechamentoGrupo[0]['tipo'];
	$obs = $valorFechamentoGrupo[0]['obs'];
	
}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Tentativa de fechamento do grupo </legend>
    <form id="form_FechamentoGrupo" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo ?>" />
     <div class="esquerda">
      <p>
        <label>Data: </label>
        <input type="text" name="dataCadastro" id="dataCadastro" value="<?php echo $dataCadastro ?>" class="data required" />
        <span class="placeholder">Campo obrigatório</span> </p>
      <p>
        <label>Tipo: </label>
        <select name="tipo" id="tipo" class="required" >
          <option value=""  >[Selecione]</option>
          <option value="1" <?php echo ($tipo==1) ? "selected" : ""?> >Fechamento</option>
          <option value="2" <?php echo ($tipo==2) ? "selected" : ""?> >Reversão</option>
          <option value="3" <?php echo ($tipo==3) ? "selected" : ""?> >Pendente</option>
        </select>
        </p>
        </div>
       
        <span class="placeholder">Campo obrigatório</span></p>
      <div class="linha-inteira">
        <label>Motivos:</label>
        <?php echo $ItenMotivoFechamento->selectItenMotivoFechamentoCheckbox("", $idFechamentoGrupo);?> </div>
     <p>&nbsp;</p>
      <p>
        <label>Observação: </label>
        <textarea id="obs" name="obs"  cols="150" rows="15" class="required"><?php echo $obs ?></textarea>
         <span class="placeholder">Campo obrigatório</span></p>
      </p>
      <p>
        <button class="button blue" onclick="postForm('form_FechamentoGrupo', '<?php echo CAMINHO_REL."grupo/include/acao/fechamentoGrupo.php?id=$idFechamentoGrupo"?>');"> Enviar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
