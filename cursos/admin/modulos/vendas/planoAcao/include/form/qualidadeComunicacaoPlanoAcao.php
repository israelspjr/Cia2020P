<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/QualidadeComunicacaoPlanoAcao.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$QualidadeComunicacaoPlanoAcao = new QualidadeComunicacaoPlanoAcao();//checks marcados

?>
<style>
floatDiv {
    position: absolute;
    left: 50%;
    width: 200px; height: 200px;
    margin-top: 200px; margin-left: -200px;
}
</style>
<fieldset>
  <legend>Qualidade Comunicação</legend>
  <form id="form_QualidadeComunicacaoPlanoAcao" class="validate" action="" method="post" onsubmit="return false" >
    <input type="hidden" name="idIntegrantePlanoAcao" id="idIntegrantePlanoAcao" value="<?php echo $idIntegrantePlanoAcao ?>" />
    <?php echo $QualidadeComunicacaoPlanoAcao->selectQualidadeComunicacaoPlanoAcaoCheck($idIntegrantePlanoAcao); ?>
    <div class="floatDiv">
      <p>
        <button class="button blue" onclick="postForm('form_QualidadeComunicacaoPlanoAcao', '<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/qualidadeComunicacaoPlanoAcao.php?idIntegrante=<?php echo $idIntegrantePlanoAcao?>&idPlanoAcao=<?php echo $planoAcao_idPlanoAcao?>');">Salvar</button>
        
      </p>
    </div>
  </form>
</fieldset>
<script>
jQuery(document).ready(function() {
    $(window).scroll(function () {
        set = $(document).scrollTop()+"px";
        jQuery('#floatDiv').animate(
            {top:set},
            {duration:1000, queue:false}
        );
    });
});
ativarForm();
</script>