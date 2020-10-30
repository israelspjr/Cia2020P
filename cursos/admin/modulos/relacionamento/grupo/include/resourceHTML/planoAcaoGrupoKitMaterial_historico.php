<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcaoGrupoKitMaterial = new PlanoAcaoGrupoKitMaterial();

$idPlanoAcaoGrupo = $_GET['id'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Histórico de kits</legend>
    <div class="lista">
    <table id="tb_lista_PlanoAcaoGrupoKitMaterial_HIST" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Itens</th>
          <th>Inicio</th>
          <th>Fim</th>
        </tr>
      </thead>
      <tbody>
        <?php 
	$where = " AND PAG.idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;	
	echo $PlanoAcaoGrupoKitMaterial->selectPlanoAcaoGrupoKitMaterialTr_historico($where);
	?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Itens</th>
          <th>Inicio</th>
          <th>Fim</th>
        </tr>
      </tfoot>
    </table>
    </div>
  </fieldset>
</div>
<script>
tabelaDataTable('tb_lista_PlanoAcaoGrupoKitMaterial_HIST', 'simples');
</script> 
