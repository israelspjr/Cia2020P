<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$inscricao = new WorkshopPresenca();  
$evento = new Workshop();
$idWorkshopPresenca = $_GET['idWorkpresenca']; 
?>

<div id="inscricao_presenca" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_inscricao" divExibir="div__inscricao" class="aba_interna ativa">Inscrição</div>
    <?php if($idWorkshopPresenca != "" && $idWorkshopPresenca > 0){ ?>
    <div id="aba_confirmacao" divExibir="div_confirmacao" class="aba_interna" >Confirmação</div>
    <div id="aba_presenca" divExibir="div_presenca" class="aba_interna" >Presença</div>
    <?php } ?>
  </div>
  <div id="modulos_inscricao" class="conteudo_nivel">
    <div id="div_inscricao" class="div_aba_interna">
      <?php 
        require_once 'form_inscricao.php';    
        if($idWorkshopPresenca != "" && $idWorkshopPresenca > 0){
      ?>
      <div class="esquerda">
        <div id="div_confirmacao">
          <?php require_once 'form_confirma.php';?>
        </div>
        <div id="div_presenca">
          <?php require_once 'form_confirma.php';?>
        </div>
      </div>
     <?php } ?>
    </div>
 </div>
</div>
<script>  
</script> 
