<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/OcorrenciaFF.class.php");

$PlanoAcao = new PlanoAcao();
$idPlanoAcao = $_POST['id'];

?>

<div id="div_ff">

  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>

  <div id="abas">
    <div id="aba_div_grupo_nome" divExibir="div_grupo_nome" class="aba_interna ativa" >Mudar Empresa</div>
 </div>

  <div id="div_ff_abas" class="conteudo_nivel">
    
    <div id="div_grupo_nome" class="div_aba_interna" >    
        <?php require_once "trocarEmpresa.php" ?>
    </div>
  
  </div>
  
</div>