<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idProfessor = $_GET['id'];

$cadastroDeCandidato = 0;	

?>

<div id="cadastro_professor">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_cadastro_professor" divExibir="div_cadastro_professor" class="aba_interna ativa">Dados pessoais</div>
    <?php if($idProfessor != "" && $idProfessor > 0){ ?>
    <div id="aba_perfil_professor" divExibir="div_perfil_professor" class="aba_interna">Perfil pessoal</div>
    <div id="aba_processoSeletivo_professor" divExibir="div_processoSeletivo_professor" class="aba_interna">Processo seletivo</div>
    <div id="aba_idioma_professor" divExibir="div_idioma_professor" class="aba_interna">Idioma</div>
    <div id="aba_disponibilidade_professor" divExibir="div_disponibilidade_professor" class="aba_interna">Disponibilidade</div>
    <div id="aba_localAula_professor" divExibir="div_localAula_professor" class="aba_interna">Local de aula</div>
    <div id="aba_contrato_professor" divExibir="div_contrato_professor" class="aba_interna">Arquivos</div>
    <div id="aba_feedback_professor" divExibir="div_feedback_professor" class="aba_interna">Aulas Assistidas</div>
  <!--  <div id="aba_permissao_professor" divExibir="div_permissao_professor" class="aba_interna">Permissão Aula Livre/Avulsa</div>-->
    <div id="aba_workshop" divExibir="div_workshop" class="aba_interna">Participação em Eventos</div>
    <div id="aba_aviso_financeiro" divExibir="div_aviso_financeiro" class="aba_interna">Financeiro</div>
    <div id="aba_demo_financeiro" divExibir="div_demo_financeiro" class="aba_interna">Demonstrativos Financeiros</div>
    <div id="aba_aviso2_professor" divExibir="div_aviso2_professor" class="aba_interna">Aviso</div>
    <?php } ?>
  </div>
  <div id="modulos_professor"  class="conteudo_nivel" >
    <div id="div_cadastro_professor" class="div_aba_interna">
      <?php require_once '../include/form/professor.php';?>
      <?php if($idProfessor != "" && $idProfessor > 0){ ?>
      <div class="esquerda">
        <div id="div_lista_endereco">
          <?php require_once '../include/resourceHTML/endereco.php';?>
        </div>
        <div id="div_lista_telefone">
          <?php require_once '../include/resourceHTML/telefone.php';?>
        </div>
      </div>
      <div class="direita">
        <div id="div_lista_enderecoVirtual">
          <?php require_once '../include/resourceHTML/enderecoVirtual.php';?>
        </div>
        <div id="div_lista_contatoAdicional">
          <?php require_once '../include/resourceHTML/contatoAdicional.php';?>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php if($idProfessor != "" && $idProfessor > 0){ ?>
    <div id="div_perfil_professor" style="display:none" class="div_aba_interna">
      <div class="esquerda">
        <div id="div_lista_formacaoPerfil">
          <?php require_once '../include/resourceHTML/formacaoPerfil.php';?>
        </div>
         <div id="div_lista_certificacoes">
          <?php  require_once '../include/resourceHTML/certificacoes.php';?>
        </div>
        <div id="div_lista_meioLocomocaoProfessor">
          <?php require_once '../include/form/meioLocomocaoProfessor.php';?>
        </div>
      </div>
      <div class="direita" >
        <div id="div_lista_experienciaProfissional">
          <?php require_once '../include/resourceHTML/experienciaProfissional.php';?>
        </div>
        <div id="div_lista_vivenciaProfessor">
          <?php require_once '../include/resourceHTML/vivenciaProfessor.php';?>
        </div>
      </div>
      <div class="linha-inteira" id="div_lista_opcaoAtividadeExtraProfessor" >
        <?php require_once '../include/form/opcaoAtividadeExtraProfessor.php';?>
      </div>
    </div>
    <div id="div_processoSeletivo_professor" style="display:none" class="div_aba_interna">
      <?php require_once '../include/resourceHTML/processoSeletivoProfessor.php';?>
    </div>
    <div id="div_idioma_professor" style="display:none" class="div_aba_interna">
      <?php require_once 'include/resourceHTML/idiomaProfessor.php';?>
    </div>
    <div id="div_disponibilidade_professor" style="display:none" class="div_aba_interna">
      <?php require_once '../include/resourceHTML/disponibilidadeProfessor.php';?>
    </div>
    <div id="div_localAula_professor" style="display:none" class="div_aba_interna">
      <?php require_once '../include/resourceHTML/localAulaProfessor.php';?>
    </div>
    <div id="div_contrato_professor" style="display:none" class="div_aba_interna">
      <?php require_once '../include/resourceHTML/contrato.php';?>
    </div>
    <div id="div_feedback_professor" style="display:none" class="div_aba_interna">
      <?php require_once '../include/resourceHTML/feedbackProfessor.php';?>
    </div>
    <div id="div_workshop" style="display:none" class="div_aba_interna">
        <?php require_once 'include/resourceHTML/workshopPresenca.php';?>
      </div>
    
    <div id="div_aviso_financeiro" style="display:none" class="div_aba_interna">
     <div id="div_aviso_dadosBancario">
        <?php //require_once 'include/form/dadosBancario.php';?>
      </div>
      <div id="div_impostosProfessor">
        <?php //require_once 'include/form/impostosProfessor.php';?>
      </div>
      <div id="div_creditoDebitoGrupo">
        <?php //require_once "include/resourceHTML/creditoDebitoGrupo.php" ?>
      </div>
      <div id="div_outrosServicos">
        <?php //require_once "include/resourceHTML/outrosServicos.php" ?>
      </div>
      <div id="div_valorHora">
        <?php //require_once "include/resourceHTML/valorHoraHistorico.php" ?>
      </div>
    </div>
    <div id="div_demo_financeiro" style="display:none" class="div_aba_interna">
    	<?php //require_once "include/resourceHTML/demonstrativos.php" ?>
    </div>
    <div id="div_aviso2_professor" style="display:none" class="div_aba_interna">
      <?php //require_once '../include/resourceHTML/aviso.php';?>
    </div>
    <?php } ?>
  </div>
</div>
<script>
	ativarForm();
</script> 