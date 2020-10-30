<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$CreditoDebitoGrupo = new CreditoDebitoGrupo();

$idCreditoDebitoGrupo = $_GET['id'];
$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];

if ($idCreditoDebitoGrupo != '' && is_numeric($idCreditoDebitoGrupo)) {

	$valorx = $CreditoDebitoGrupo -> selectCreditoDebitoGrupo(" WHERE idCreditoDebitoGrupo = " . $idCreditoDebitoGrupo);
	$mes = $valorx[0]['mes'];
	$ano = $valorx[0]['ano'];
    $quem = $valorx[0]['quem'];
	$tipo = $valorx[0]['tipo'];
	$valor = $valorx[0]['valor'];
	$obs = $valorx[0]['obs'];

}else{
	$mes = date('m');
	$ano = date('Y');
}
//echo "-$ano- $mes";
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Credito e/ou Debito Grupo</legend>
    <form id="form_CreditoDebitoGrupo" class="validate" method="post" action="" onsubmit="return false" >
      <input name="idCreditoDebitoGrupo" type="hidden" value="<?php echo $idCreditoDebitoGrupo?>" />
      <input name="idPlanoAcaoGrupo" type="hidden" value="<?php echo $idPlanoAcaoGrupo?>" />
      <p>
        <label>Empresa:</label>
        <input type="checkbox" id="flagEmpresa" name="flagEmpresa" value="1" <?php if ($quem == 'E') { echo "checked=\"checked\"";} ?>/>
      <p>
        <label>Tipo:</label>
        <select  name="tipo" id="tipo" class="required">
          <option value="">Selecione</option>
          <option value="1" <?php if($tipo == 1){?> selected <?php } ?>>Crédito</option>
          <option value="2" <?php if($tipo == 2){?> selected <?php } ?>>Débito</option>
        </select>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Valor:</label>
        <input type="text" name="valor" id="valor" class="required numeric" value="<?php echo Uteis::exibirMoeda($valor)?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Mes:</label>
        <select name="mes" id="mes" class="required">
        	<?php for($x = 1;$x <= 12; $x++ ){?>
          	<option value="<?php echo $x?>" <?php echo ( $mes == $x ) ? "selected" : "" ?> ><?php echo Uteis::retornaNomeMes($x)?></option>
          <?php } ?>          
        </select>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Ano:</label>
        <select name="ano" id="ano" class="required">
          <?php for($x = date('Y')+1;$x >= 2010; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ( $ano == $x) ? "selected" : "" ?> ><?php echo $x?></option>
          <?php } ?>
        </select>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Descrição:</label>
        <input type="text" name="obs" id="obs" value="<?php echo $obs?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <button class="button blue" onclick="postForm('form_CreditoDebitoGrupo', '<?php echo CAMINHO_REL?>grupo/include/acao/creditoDebitoGrupo.php?id=<?php echo $_GET['id']?>');">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script>
</div>
