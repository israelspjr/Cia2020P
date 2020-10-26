<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Gerente = new Gerente();	
$Funcionario = new Funcionario();
$idGerente = $_GET['id'];	
?>

<div id="cadastro_gerente">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_cadastro_gerente" divExibir="div_cadastro_gerente" class="aba_interna ativa">Gerente</div>
    <?php if($idGerente != "" && $idGerente > 0){ ?>
    <div id="aba_vinculo_gerente" divExibir="div_vinculo_gerente" class="aba_interna">Vínculo com cliente</div>
    <?php } ?>
  </div>
  <div id="modulos_gerente" class="conteudo_nivel">
    <div id="div_cadastro_gerente" style="display:" class="div_aba_interna">
      <?php require_once 'include/form/gerente.php';?>
    </div>
    <?php if($idGerente != "" && $idGerente > 0){ ?>
    <div id="div_vinculo_gerente" style="display:none" class="div_aba_interna" >
      <?php require_once 'include/resourceHTML/gerenteTem.php';?>
    </div>
    <?php } ?>
  </div>
</div>
<script>
	ativarForm();
</script>