<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$dataApartir = $_REQUEST['dataApartir'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];


?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel()"></div>
  <fieldset>
    <legend>Finalizar</legend>
    <form id="form_finalizar" class="validate" method="post" action="" onsubmit="return false">
      <input name="idBuscaProfessor" type="hidden" value="<?php echo $_GET['idBuscaProfessor'] ?>" />
      <?php if($idPlanoAcaoGrupo != '') {?>
      	<input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
      <?php }?>
      <p>
        <label>Data Início:</label>
        <input type="text" name="data" id="data" value="<?php echo $dataApartir?>" class="required data"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
      <button class="button blue" onclick="postForm('form_finalizar', '<?php echo CAMINHO_REL."busca/vendas/include/acao/finalizar.php"?>');">Enviar</button>
      </p>
    </form>
  </fieldset>
  <script>ativarForm();</script> 
</div>
