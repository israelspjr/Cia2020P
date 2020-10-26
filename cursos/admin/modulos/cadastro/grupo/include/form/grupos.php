<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/OcorrenciaFF.class.php");

$Grupo = new Grupo();
$idGrupo = $_POST['idGrupo'];

?>

<div id="div_ff">

  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>

  <div id="abas">
    <div id="aba_div_grupo_nome" divExibir="div_grupo_nome" class="aba_interna ativa" >Mudar Nome do Grupo</div>
    <div id="aba_div_grupo_empresa" divExibir="div_grupo_empresa" class="aba_interna">Mudar Grupo de Empresa</div>
    
  </div>

  <div id="div_ff_abas" class="conteudo_nivel">
    
    <div id="div_grupo_nome" class="div_aba_interna" >     
        <?php require_once "trocarNome.php" ?>
    </div>
    
    <div id="div_grupo_empresa" class="div_aba_interna" style="display:none;" >
        <?php require_once "trocarEmpresa.php" ?>
    </div>    
       
  </div>
  
</div>