<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$Downsell = new Downsell();

$idDownsell = $_GET['id'];
$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];

	$valorx = $Downsell -> selectDownsell(" WHERE idDownsell = " . $idDownsell);
	$tipo = $valorx[0]['tipo'];
	$dataInicio = Uteis::exibirData($valorx[0]['dataInicio']);
    $dataTermino = Uteis::exibirData($valorx[0]['dataTermino']);
	$obs= $valorx[0]['descricao'];
	$inativo = $valorx[0]['inativo'];
	
	if ($idPlanoAcaoGrupo == '') {
		$idPlanoAcaoGrupo = $valorx[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];	
	}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Downsell/Upselling</legend>
    <form id="form_Downsell" class="validate" method="post" action="" onsubmit="return false" >
      <input name="idDownsell" type="hidden" value="<?php echo $idDownsell?>" />
      <input name="idPlanoAcaoGrupo" type="hidden" value="<?php echo $idPlanoAcaoGrupo?>" />
        <div class="esquerda">
        <p>
        <label>Tipo:</label>
        <select  name="tipo" id="tipo" class="required">
          <option value="">Selecione</option>
          <option value="0" <?php if($tipo == 0){?> selected <?php } ?>>Permanente</option>
          <option value="1" <?php if($tipo == 1){?> selected <?php } ?>>Temporário</option>
        </select>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Data de Inicio:</label>
        <input type="text" name="dataInicio" id="dataInicio" class="required data" value="<?php echo $dataInicio?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
         <p>
        <label>Data de Termino:</label>
        <input type="text" name="dataTermino" id="dataTermino" class="required data" value="<?php echo $dataTermino?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
        <label>Descrição:</label>
        <textarea name="obs" id="obs"><?php echo $obs?></textarea>
         <span class="placeholder">Campo Obrigatório</span> </p>
         <p>
         <label>Inativo<input type="checkbox" value="1" name="inativo" id="inativo" <?php if ($inativo == 1) {echo "checked=\"checked\""; }?>/>
         </label>
         </p>
         </div>
         <div class="direita">
         <p>
         <label>Upselling<input type="checkbox" value="1" name="upselling" id="upselling" />
         </label>
         </p>
         <label>Carga Antiga:<input type="text" id="cargaAntiga" name="cargaAntiga" class="hora" value="<?php echo $cargaAntiga?>" maxlength="5" autocomplete="off"></label>
         <label>Carga Nova:<input type="text" id="cargaNova" name="cargaNova" class="hora" value="<?php echo $cargaAntiga?>" maxlength="5" autocomplete="off"></label>

         </div>
         <div class="linha-inteira">
      <p>
        <button class="button blue" onclick="postForm('form_Downsell', '<?php echo CAMINHO_REL?>grupo/include/acao/downsell.php?id=<?php echo $_GET['id']?>');">Salvar</button>
        
      </p>
    </form>
  </fieldset>
  </div>
</div>
<script>ativarForm();</script>
</div>
