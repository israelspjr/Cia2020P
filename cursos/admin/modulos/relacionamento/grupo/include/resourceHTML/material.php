<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idPlanoAcaoGrupo = $_GET['id'];
?>

<div id="cadastro_material" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_div_material" divExibir="div_material" class="aba_interna ativa">Materiais</div>
    <div id="aba_div_encomendarMaterial" divExibir="div_encomendarMaterial" class="aba_interna"
    onclick="carregarModulo('<?php echo CAMINHO_REL."grupo/include/resourceHTML/encomendaMaterialGrupo.php?id=".$idPlanoAcaoGrupo?>', '#div_encomendarMaterial')">Encomendar material</div>
    <div id="aba_div_encomendarMaterial_ver" divExibir="div_encomendarMaterial_ver" class="aba_interna"
    onclick="carregarModulo('<?php echo CAMINHO_REL."grupo/include/resourceHTML/encomendaMaterialGrupo_ver.php?id=".$idPlanoAcaoGrupo?>', '#div_encomendarMaterial_ver')">Materias encomendados</div>
  </div>
  <div id="modulos_Grupo" class="conteudo_nivel">
    
    <div id="div_material">
      <div id="div_lista_PlanoAcaoGrupoKitMaterial" class="div_aba_interna">
        <?php require_once 'planoAcaoGrupoKitMaterial.php';?>
      </div>
      <div id="div_lista_PlanoAcaoGrupoMaterialDidatico" class="div_aba_interna">
        <?php require_once 'planoAcaoGrupoMaterialDidatico.php';?>
      </div>
      <div id="div_lista_PlanoAcaoGrupoMaterialMontado" class="div_aba_interna">
        <?php require_once 'planoAcaoGrupoMaterialMontado.php';?>
      </div>
    </div>
    
    <div id="div_encomendarMaterial" style="display:none;"> 
    </div>
    
     <div id="div_encomendarMaterial_ver" style="display:none;"> 
    </div>
    
  </div>
</div>
