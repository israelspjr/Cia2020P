<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$CreditoDebitoGrupo = new CreditoDebitoGrupo();
$Grupo = new Grupo();

$idCreditoDebitoGrupo = $_GET['id'];

//if ($idProfessor == "") {
	$idProfessor = $_GET['idProfessor'];
//} else {
	
//$idProfessor = $idCreditoDebitoGrupo;	
//}

if ($idCreditoDebitoGrupo != '' && is_numeric($idCreditoDebitoGrupo)) {

	$valorx = $CreditoDebitoGrupo -> selectCreditoDebitoGrupo(" WHERE idCreditoDebitoGrupo = " . $idCreditoDebitoGrupo);
	$mes = $valorx[0]['mes'];
	$ano = $valorx[0]['ano'];
	$tipo = $valorx[0]['tipo'];
	$valor = $valorx[0]['valor'];
	$obs = $valorx[0]['obs'];
	$premiacao = $valorx[0]['premiacao'];
	$idGrupo = $valorx[0]['grupo_idGrupo'];

}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Credito e/ou Debito Grupo</legend>
    <form id="form_CreditoDebitoGrupo" class="validate" method="post" action="" onsubmit="return false" >
      <input name="idCreditoDebitoGrupo" type="hidden" value="<?php echo $idCreditoDebitoGrupo?>" />
      <input name="idProfessor" type="hidden" value="<?php echo $idProfessor?>" />
      <div class="esquerda">
      <p>
        <label>Tipo:</label>
        <select  name="tipo" id="tipo" class="required">
          <option value=""> Selecione </option>
          <option value="1" <?php if($tipo == 1){?> selected <?php } ?>>Crédito</option>
          <option value="2" <?php if($tipo == 2){?> selected <?php } ?>>Débito</option>
        </select>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
      <label><input type="checkbox" value="1" <?php if ($premiacao == 1) { echo "checked"; } ?> name="premiacao" id="premiacao"   />Premiação</label>
      </p>
      <p>
      
        <label>Valor:</label>
        <input type="text" name="valor" id="valor" class="required numeric" value="<?php echo $valor?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Mes:</label>
        <select name="mes" id="mes" class="required">
          <option value="1" <?php if((date('m') == 1 && $mes == "") || ($mes == 1)){ ?> selected="selected" <?php } ?>>Janeiro</option>
          <option value="2" <?php if((date('m') == 2 && $mes == "") || ($mes == 2)){ ?> selected="selected" <?php } ?>>Fevereiro</option>
          <option value="3" <?php if((date('m') == 3 && $mes == "") || ($mes == 3)){ ?> selected="selected" <?php } ?>>Março</option>
          <option value="4" <?php if((date('m') == 4 && $mes == "") || ($mes == 4)){ ?> selected="selected" <?php } ?>>Abril</option>
          <option value="5" <?php if((date('m') == 5 && $mes == "") || ($mes == 5)){ ?> selected="selected" <?php } ?>>Maio</option>
          <option value="6" <?php if((date('m') == 6 && $mes == "") || ($mes == 6)){ ?> selected="selected" <?php } ?>>Junho</option>
          <option value="7" <?php if((date('m') == 7 && $mes == "") || ($mes == 7)){ ?> selected="selected" <?php } ?>>Julho</option>
          <option value="8" <?php if((date('m') == 8 && $mes == "") || ($mes == 8)){ ?> selected="selected" <?php } ?>>Agosto</option>
          <option value="9" <?php if((date('m') == 9 && $mes == "") || ($mes == 9)){ ?> selected="selected" <?php } ?>>Setembro</option>
          <option value="10" <?php if((date('m') == 10 && $mes == "") || ($mes == 10)){ ?> selected="selected" <?php } ?>>Outubro</option>
          <option value="11" <?php if((date('m') == 11 && $mes == "") || ($mes == 11)){ ?> selected="selected" <?php } ?>>Novenbro</option>
          <option value="12" <?php if((date('m') == 12 && $mes == "") || ($mes == 12)){ ?> selected="selected" <?php } ?>>Dezembro</option>
        </select>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Ano:</label>
        <select name="ano" id="ano" class="required">
          <?php for($x = date('Y')+1;$x >= 2000; $x-- ){?>
          <option value="<?php echo $x?>" <?php if((date('Y') == $x && $ano == "") || ($ano == $x)){ ?> selected="selected" <?php } ?>><?php echo $x?></option>
          <?php } ?>
        </select>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Observação:</label>
        <input type="text" name="obs" id="obs" value="<?php echo $obs?>" />
      </p>
      </div>
      <div class="direita">
      <p>
      <label>Grupo: </label>
      <?php echo $Grupo->selectGrupoSelect("",$idGrupo); ?>
      </p>      
      </div>
      <div class="linha-inteira">
      <p>
        <button class="button blue" onclick="postForm('form_CreditoDebitoGrupo', '<?php echo CAMINHO_CAD."professor/"?>contratado/include/acao/creditoDebitoGrupo.php?id=<?php echo $idCreditoDebitoGrupo;?>&idProfessor=<?php echo $idProfessor;?>');">Salvar</button>
        
      </p>
      </div>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script>
</div>
