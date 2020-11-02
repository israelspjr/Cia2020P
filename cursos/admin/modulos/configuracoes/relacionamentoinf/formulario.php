<?php
//pagina conteudo o formulario 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RelacionamentoINF = new RelacionamentoINF();
$Idioma = new Idioma();
$NivelEstudo = new NivelEstudo();
$FocoCurso = new FocoCurso();
		
$idRelacionamentoINF = $_REQUEST['id'];

if($idRelacionamentoINF != '' && $idRelacionamentoINF  > 0){

	$valor = $RelacionamentoINF->selectRelacionamentoINF('WHERE idRelacionamentoINF='.$idRelacionamentoINF);
	
	//$idRelacionamentoINF = $valor[0]['idRelacionamentoINF'];
	 $idioma_idIdioma = $valor[0]['idioma_idIdioma'];
	 $nivelEstudo_IdNivelEstudo = $valor[0]['nivelEstudo_IdNivelEstudo'];
	 $focoCurso_idFocoCurso = $valor[0]['focoCurso_idFocoCurso'];
	 $cargaHoraria = Uteis::exibirHorasInput($valor[0]['cargaHoraria']);
	 $inativo = $valor[0]['inativo'];
	 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Relacionamento I.N.F.</legend>
    <form id="form_RelacionamentoINF" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idRelacionamentoINF ?>" />
      <p>
        <label for="inativo">Inativo</label>
        <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label>Idioma:</label>
        <?php echo $Idioma->selectIdiomaSelect("required", $idioma_idIdioma, "  AND excluido = 0"); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Nível Estudo:</label>
        <?php echo $NivelEstudo->selectNivelEstudoSelect("required", $nivelEstudo_IdNivelEstudo, ""); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Foco Curso:</label>
        <?php echo $FocoCurso->selectFocoCursoSelect("required", $focoCurso_idFocoCurso, ""); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Carga Horária:</label>
        <input type="text" name="cargaHoraria" id="cargaHoraria" class="hora2" value="<?php echo $cargaHoraria?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <button class="button blue" onclick="postForm('form_RelacionamentoINF', '<?php echo CAMINHO_MODULO?>configuracoes/relacionamentoinf/grava.php')">Salvar</button>
      
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
