<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MaterialDidatico.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupo.class.php");

$MaterialDidatico = new MaterialDidatico();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Novo material avulso</legend>
    <form id="form_MaterialDidatico" class="validate" method="post" action="" onsubmit="return false">
      <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
      <p>
      <label>Material avulso:</label>
        <?php 
		
		$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);				
		$and .= " WHERE INF.idioma_idIdioma = ".$idIdioma;
		
		echo $MaterialDidatico->selectMaterialDidaticoSelect("required", "", $and);
		?>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Início:</label>
        <input type="text" name="dataInicio" id="dataInicio" class="required data"  />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Fim (opcional):</label>
        <input type="text" name="dataFim" id="dataFim" class="data" />
      </p>
      <p>
        <button class="button blue" 
        onclick="postForm('form_MaterialDidatico', '<?php echo CAMINHO_REL."grupo/include/acao/planoAcaoGrupoMaterialDidatico.php"?>')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();</script> 
