<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$OutrosServicos = new OutrosServicos();

$idOutrosServicos = $_GET['id'];

if ($idProfessor == "") {
	$idProfessor = $_GET['idProfessor'];
}

if ($idOutrosServicos  != '' && is_numeric($idOutrosServicos )) {

	$valorx = $OutrosServicos  -> selectOutrosServicos(" WHERE idOutrosServicos = " . $idOutrosServicos );
	$mes = $valorx[0]['mes'];
	$ano = $valorx[0]['ano'];
	$tipo = $valorx[0]['tipo'];
	$valor = Uteis::formatarMoeda($valorx[0]['valor']);
	$obs = $valorx[0]['obs'];
	$impostos = $valorx[0]['impostos'];

}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Outros Serviços (Consultoria | Tradução | Versão)</legend>
    <form id="form_OutrosServicos" class="validate" method="post" action="" onsubmit="return false" >
      <input name="idOutrosServicos" type="hidden" value="<?php echo $idOutrosServicos?>" />
      <input name="idProfessor" type="hidden" value="<?php echo $idProfessor?>" />
      <p>
        <label>Tipo:</label>
        <select  name="tipo" id="tipo" class="required">
          <option value=""> Selecione </option>
          <option value="1" <?php if($tipo == 1){?> selected <?php } ?>>Consultoria</option>
          <option value="2" <?php if($tipo == 2){?> selected <?php } ?>>Tradução</option>
          <option value="3" <?php if($tipo == 3){?> selected <?php } ?>>Revisão</option>
          <option value="4" <?php if($tipo == 4){?> selected <?php } ?>>Versão</option>
          <option value="5" <?php if($tipo == 5){?> selected <?php } ?>>Correção</option>
          <option value="6" <?php if($tipo == 6){?> selected <?php } ?>>Outros</option>
          <option value="7" <?php if($tipo == 7){?> selected <?php } ?>>Débitos</option>
        </select>
        <span class="placeholder">Campo Obrigatório</span> </p>
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
      <p>
      <label>Não cobrar impostos
      <input type="checkbox" value="1" name="impostos" id="impostos" <?php if ($impostos == 1) { echo "checked"; } ?> />
      </label>
      <p>
        <button class="button blue" onclick="postForm('form_OutrosServicos', '<?php echo CAMINHO_CAD."professor/"?>contratado/include/acao/outrosServicos.php?id=<?php echo $_GET['id']?>');">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script>
</div>
