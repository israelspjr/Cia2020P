<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$NivelEstudo = new NivelEstudo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$idPlanoAcaoGrupo = $_GET['id'];	

//$idNivel = $PlanoAcaoGrupo->getIdNivel($idPlanoAcaoGrupo);	
$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);	
$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);	

$idPlanoAcaoGrupo_atual = $PlanoAcaoGrupo->getPAG_atual($idGrupo);
?>

<div class="menu_interno">

<p style="float:left"><strong><?php echo $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);?></strong></p>

<form id="form_MudarNivel" class="validate" action="" method="post" onsubmit="return false" >  
  <p>
    <label>Consultar nível:: <?php echo $NivelEstudo->selectNivelEstudoSelect_con("required", $idPlanoAcaoGrupo, " WHERE PAG.grupo_idGrupo = $idGrupo AND I.idIdioma = $idIdioma", $idPlanoAcaoGrupo_atual)?> <span class="placeholder">Campo obrigatório</span>
      <button class="button blue" onclick="mudarNivel()" >Ok</button>
    </label>
  </p>
</form>
</div>

<script>
ativarForm();
function mudarNivel(){
	var idAba = $('.camada[nivel='+nivel+']').find('.aba_interna.ativa').prop('id')
	postForm('form_MudarNivel', '<?php echo CAMINHO_REL."grupo/include/acao/mudarNivel.php"?>', '&mudarAba='+idAba);	
}
</script>