<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DisparoEmail = new DisparoEmail();

$idDisparoEmail = $_REQUEST['id'];

?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>E-mail enviado</legend>
    
    <?php echo $DisparoEmail->formEmail($idDisparoEmail); ?>      
  </fieldset>
</div>

