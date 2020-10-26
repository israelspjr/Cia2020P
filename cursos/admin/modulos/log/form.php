<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Log = new Log();

$idLog = $_REQUEST['idLog'];

?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Ação executada no banco</legend>
    
    <textarea style="width: 100%" rows="15"><?php echo $Log->getAcao($idLog); ?></textarea>      
  </fieldset>
</div>

