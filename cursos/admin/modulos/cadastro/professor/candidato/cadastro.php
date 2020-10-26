<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idProfessor = $_GET['id'];

$cadastroDeCandidato = 1;

?>

<div id="cadastro_professor">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_cadastro_professor" divExibir="div_cadastro_professor" class="aba_interna ativa">Dados pessoais</div>
    <?php if($idProfessor != "" && $idProfessor > 0){ ?>
    <div id="aba_perfil_professor" divExibir="div_perfil_professor" class="aba_interna">Perfil pessoal</div>
    <div id="aba_processoSeletivo_professor" divExibir="div_processoSeletivo_professor" class="aba_interna">Processo seletivo</div>
    <div id="aba_localAula_professor" divExibir="div_localAula_professor" class="aba_interna">Local de aula</div>
    <?php } ?>
  </div>
  <div id="modulos_professor"  class="conteudo_nivel" >
    <div id="div_cadastro_professor" style="display:" class="div_aba_interna">
      <?php require_once '../include/form/professor.php';?>
      <?php if($idProfessor != "" && $idProfessor > 0){ ?>
      <div class="esquerda">
        <div id="div_lista_telefone" class="">
          <?php require_once '../include/resourceHTML/telefone.php';?>
        </div>
        <div id="div_lista_endereco" class="">
          <?php require_once '../include/resourceHTML/endereco.php';?>
        </div>
        
        <div id="div_lista_vivenciaProfessor" class="">
          <?php require_once '../include/resourceHTML/vivenciaProfessor.php';?>
        </div>
      </div>
      <div class="direita">
        <div id="div_lista_contatoAdicional" class="">
          <?php require_once '../include/resourceHTML/contatoAdicional.php';?>
        </div>
        <div id="div_lista_enderecoVirtual" class="">
          <?php require_once '../include/resourceHTML/enderecoVirtual.php';?>
        </div>
          <div id="div_lista_certificacoes">
          <?php  require_once '../include/resourceHTML/certificacoes.php';?>
        </div>
        <div id="div_lista_meioLocomocaoProfessor" class="">
          <?php require_once '../include/form/meioLocomocaoProfessor.php';?>
        </div>
       
      </div>
      <?php } ?>
      <!--opçoes por checkbox--> 
    </div>
    <?php if($idProfessor != "" && $idProfessor > 0){ ?>
    <div id="div_perfil_professor" style="display:none" class="div_aba_interna">     
      <div class="esquerda" id="div_lista_formacaoPerfil">
        <?php require_once '../include/resourceHTML/formacaoPerfil.php';?>
      </div>
      <div class="direita" id="div_lista_experienciaProfissional">
        <?php require_once '../include/resourceHTML/experienciaProfissional.php';?>
      </div>
       <div class="linha-inteira" id="div_lista_opcaoAtividadeExtraProfessor">
        <?php require_once '../include/form/opcaoAtividadeExtraProfessor.php';?>
      </div>
    </div>
    <div id="div_processoSeletivo_professor" style="display:none" class="div_aba_interna">
      <?php require_once '../include/resourceHTML/processoSeletivoProfessor.php';?>
    </div>
    <div id="div_localAula_professor" style="display:none" class="div_aba_interna">
      <?php require_once '../include/resourceHTML/localAulaProfessor.php';?>
      <!--opçoes por checkbox--> 
    </div>
    <?php } ?>
  </div>
</div>
<script>
	ativarForm();
</script> 
