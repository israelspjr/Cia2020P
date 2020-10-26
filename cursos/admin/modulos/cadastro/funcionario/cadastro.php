<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idFuncionario = $_GET['id'];
?>

<div id="cadastro_funcionario" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_cadastro_funcionario" divExibir="div_cadastro_funcionario" class="aba_interna ativa">Dadoss pessoais</div>
    <?php if($idFuncionario != "" && $idFuncionario > 0){ ?>
    <div id="aba_aviso_funcionario" divExibir="div_aviso_funcionario" class="aba_interna">Documentos</div>
    <div id="aba_fp_funcionario" divExibir="div_fp_funcionario" class="aba_interna">Folha de Ponto</div>
    <?php } ?>
  </div>
  <div id="modulos_funcionario" class="conteudo_nivel">
    <div id="div_cadastro_funcionario" style="display:;" class="div_aba_interna">
      <?php require_once 'include/form/funcionario.php';?>
      <?php if($idFuncionario != "" && $idFuncionario > 0){ ?>
      <div class="esquerda" >
        <div id="div_lista_telefone" class="">
          <?php require_once 'include/resourceHTML/telefone.php';?>
        </div>
        <div id="div_lista_endereco" class="">
          <?php require_once 'include/resourceHTML/endereco.php';?>
        </div>
      </div>
      <div class="direita">
        <div id="div_lista_contatoAdicional" class="">
          <?php require_once 'include/resourceHTML/contatoAdicional.php';?>
        </div>
        <div id="div_lista_enderecoVirtual" class="">
          <?php require_once 'include/resourceHTML/enderecoVirtual.php';?>
        </div>
      </div>
      <?php } ?>
    </div>
       <div id="div_fp_funcionario" style="display:none;" class="div_aba_interna">
      <?php require_once 'include/resourceHTML/folhaPonto.php'?>
    </div>
    <?php if($idFuncionario != "" && $idFuncionario > 0){ ?>
    <div id="div_aviso_funcionario" style="display:none;" class="div_aba_interna">
      <?php require_once 'include/resourceHTML/aviso.php'?>
    </div>
       <div id="div_contrato_funcionario"  class="div_aba_interna">
      <?php require_once 'include/resourceHTML/contrato.php';?>
    </div>
   </div>
    <?php } ?>
     
  
 
</div>
