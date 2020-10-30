<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$Professor = new Professor();

	
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$idBuscaProfessor = $_REQUEST['idBuscaProfessor'];
?>

<div id="cadastro" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_planoAcaoGrupo" divExibir="div_pesquisa_planoacaogrupo" class="aba_interna ativa" onclick="carregarModulo('<?php echo CAMINHO_REL?>busca/vendas/include/form/pesquisa.php?idPlanoAcaoGrupo=<?php echo $idPlanoAcaoGrupo?>&idBuscaProfessor=<?php echo $idBuscaProfessor?>', '#div_pesquisa_planoacaogrupo')">Pesquisa com filtro</div>
    <div id="aba_planoAcaoGrupo_op" divExibir="div_opcoes_planoacaogrupo" class="aba_interna" onclick="carregarModulo('<?php echo CAMINHO_REL?>busca/vendas/include/resourceHTML/opcao.php?idPlanoAcaoGrupo=<?php echo $idPlanoAcaoGrupo?>&idBuscaProfessor=<?php echo $idBuscaProfessor?>', '#div_opcoes_planoacaogrupo')">Opções escolhidas</div>    
  </div>
  <div id="modulos_planoAcao" class="conteudo_nivel">
    <div id="div_pesquisa_planoacaogrupo" class="div_aba_interna" >
      <?php require_once '../form/pesquisa.php';?>
    </div> 
    <div id="div_opcoes_planoacaogrupo" class="div_aba_interna" style="display:none"> </div>
  </div>
</div>
