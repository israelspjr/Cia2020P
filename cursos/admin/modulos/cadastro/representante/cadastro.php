<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");	
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");	
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Representante.class.php");
	
		
$Representante = new Representante();

$idRepresentante = $_GET['id'];

if($idRepresentante != '' && is_numeric($idRepresentante)){
	$valor = $Representante->selectRepresentante("WHERE idRepresentante =".$idRepresentante);
	$idClientePf = $valor[0]['clientePf_idClientePf'];
	$idFuncionario = $valor[0]['funcionario_idFuncionario'];
	$idProfessor = $valor[0]['professor_idProfessor'];
  $inativo = $valor[0]['inativo'];
	$obs = $valor[0]['obs'];
}	
?>

<div id="cadastro_representante" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_cadastro_representante" divExibir="div_cadastro_representante" class="aba_interna ativa">Cadastro</div>
    <?php if($idRepresentante != '' && is_numeric($idRepresentante)){?>
    <div id="aba_cadastro_idioma" divExibir="div_cadastro_idioma" class="aba_interna">Idiomas</div>
    <?php } ?>
  </div>
  <div id="modulos_gerente" class="conteudo_nivel">
    <div id="div_cadastro_representante" style="" class="div_aba_interna">
      <?php require_once 'include/form/representante.php';?>
    </div>
    <div id="div_cadastro_idioma" style="display:none" class="div_aba_interna">
      <?php require_once 'include/resourceHTML/idioma.php';?>
    </div>
  </div>
</div>
