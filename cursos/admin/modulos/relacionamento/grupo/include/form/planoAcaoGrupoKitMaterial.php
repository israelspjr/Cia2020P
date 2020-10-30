<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/KitMaterial.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupo.class.php");

$KitMaterial = new KitMaterial();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Novo kit de material</legend>
    <form id="form_KitMaterial" class="validate" method="post" action="" onsubmit="return false">
      <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
      <p>
      <label>Kits de material:</label>
        <?php 
		
		$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);
		$idNivelEstudo = $PlanoAcaoGrupo->getIdNivel($idPlanoAcaoGrupo);
		$idFocoCurso = $PlanoAcaoGrupo->getIdFoco($idPlanoAcaoGrupo);

		$sql = " INNER JOIN relacionamentoINF AS INF ON INF.idioma_idIdioma = ".$idIdioma;
		$sql .= "	AND INF.nivelEstudo_IdNivelEstudo = ".$idNivelEstudo." AND INF.focoCurso_idFocoCurso = ".$idFocoCurso;
		$sql .= " INNER JOIN kitMaterialINF AS KMINF ON KMINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF  ";
		$sql .= " 	AND kitMaterial_idKitMaterial = K.idKitMaterial ";

		echo $KitMaterial->selectKitMaterialSelect("required", "", $sql);
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
        onclick="postForm('form_KitMaterial', '<?php echo CAMINHO_REL."grupo/include/acao/planoAcaoGrupoKitMaterial.php"?>')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();</script> 
