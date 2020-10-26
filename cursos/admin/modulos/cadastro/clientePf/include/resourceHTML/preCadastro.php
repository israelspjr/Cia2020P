<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$EstadoCivil = new EstadoCivil();
$Pais = new Pais();
$ClientePf = new ClientePf();
$ClientePj = new ClientePj();
$TipoDocumentoUnico = new TipoDocumentoUnico();
$TipoCliente = new TipoCliente();
	
$idClientePf = $_GET['id'];
$proposta = $_GET['p'];	
?>

<div id="cadastro_clientepf" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_cadastro_clientepf" divExibir="div_cadastro_clientepf" class="aba_interna ativa">Dados Pessoais</div>
 <!-- <div id="aba_aviso" divExibir="div_aviso2" class="aba_interna">Enviar Email</div>-->
  </div>
  <div id="modulos_clientepf" class="conteudo_nivel">
    <div id="div_cadastro_clientepf" class="div_aba_interna">
      <?php require_once '../form/preclientepf.php';
	  
	?>
    </div>
 <!--   <div id="div_aviso2" style="display:none" class="div_aba_interna">
      <?php require_once 'aviso.php';?>
    </div>-->

  </div>
</div>
<script>	
</script> 
