<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$FechamentoGrupo = new FechamentoGrupo();
if (!$PlanoAcaoGrupo){
    $PlanoAcaoGrupo = new PlanoAcaoGrupo();
}
$idPlanoAcaoGrupo = $_GET['id'];
$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);	

$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);


for ($x=0;$x<count($ids);$x++) {
	$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
}
//Uteis::pr($valorX);

$valorx2 = implode(', ',$valorX);

$caminhoAbrir = CAMINHO_REL . "grupo/include/";
$caminhoAtualizar = CAMINHO_REL . "grupo/include/resourceHTML/planoAcaoGrupoNaoFaturar.php?id=" . $idPlanoAcaoGrupo;
$ondeAtualiza = "#div_lista_fechamentoGrupo";
$where = " WHERE dataExcluido IS NULL AND planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo;
?>

<fieldset>
	<legend>
		Fechamento / Não faturar a partir de
	</legend>
  <div class="menu_interno"><img src="<?php echo CAMINHO_IMG."novo.png";?>" title="cadastrar anotação" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/fechamentoGrupo.php?idPlanoAcaoGrupo=$idPlanoAcaoGrupo"?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoNaoFaturar.php?id=".$idPlanoAcaoGrupo?>', '#div_fechamentoGrupo');" /></div>
  <div id="div_lista_fechamentoGrupo" class="lista">
    <table id="tb_lista_fechamentoGrupo" class="registros">
      <thead>
        <tr>
          <th>Data</th>
          <th>Tipo</th>
          <th></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Data</th>
          <th>Tipo</th>
          <th></th>
        </tr>
      </tfoot>
      <tbody>
        <?php 
	echo $FechamentoGrupo->selectFechamentoGrupoTr(CAMINHO_REL."grupo/include/form/fechamentoGrupo.php", CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoNaoFaturar.php?id=".$idPlanoAcaoGrupo, "#div_fechamentoGrupo", "WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND tipo IS NOT NULL ORDER BY idFechamentoGrupo DESC");
	?>
      </tbody>
    </table>
  </div>
</fieldset>
<script>tabelaDataTable('tb_lista_fechamentoGrupo');</script> 
