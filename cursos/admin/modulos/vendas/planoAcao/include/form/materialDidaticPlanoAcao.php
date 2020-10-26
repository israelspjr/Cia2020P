<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$MaterialDidatico = new MaterialDidatico();
$PlanoAcao = new PlanoAcao();
$Proposta = new Proposta();
		
$idMaterialDidaticPlanoAcao = $_GET['id'];
$planoAcao_idPlanoAcao = $_GET['idPlanoAcao'];

$valorPlanoAcao = $PlanoAcao->selectPlanoAcao('WHERE idPlanoAcao='.$planoAcao_idPlanoAcao);

$idIdioma = $PlanoAcao->getIdIdioma($planoAcao_idPlanoAcao);
$idNivelEstudo = $valorPlanoAcao[0]['nivelEstudo_IdNivelEstudo']; 
$idFocoCurso = $valorPlanoAcao[0]['focoCurso_idFocoCurso']; 
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Materiais didático</legend>
    <div class="agrupa" id="div_form_PlanoAcao">
      <form id="form_MaterialDidatico" class="validate" action="" method="post" onsubmit="return false" >
        <input type="hidden" name="idPlanoAcao" id="idPlanoAcao" value="<?php echo $planoAcao_idPlanoAcao ?>" />
        <p>
          <label>Material didático:</label>
          <?php 		  
		  	$and = " WHERE idMaterialDidatico NOT IN (SELECT materialDidatico_idMaterialDidatico FROM materialDidaticPlanoAcao WHERE planoAcao_idPlanoAcao = ".$planoAcao_idPlanoAcao.") ";
			$and .= " AND M.idioma_idIdioma = ".$idIdioma;
			//." AND INF.nivelEstudo_IdNivelEstudo = ".$idNivelEstudo." AND INF.focoCurso_idFocoCurso = ".$idFocoCurso;
		 
		  echo $MaterialDidatico->selectMaterialDidaticoSelect("required", $idMaterialDidatico, $and);?>
          <span class="placeholder">Campo Obrigatório</span> </p>
        <div class="linha-inteira">
          <p>
            <button class="button blue" onclick="postForm('form_MaterialDidatico', '<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/materialDidaticPlanoAcao.php?id=<?php echo $idMaterialDidaticPlanoAcao?>');">Salvar</button>
            
          </p>
        </div>
      </form>
    </div>
  </fieldset>
</div>
<script>ativarForm();</script>