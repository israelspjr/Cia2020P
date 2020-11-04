<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$Downsell = new Downsell();
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
$caminhoAtualizar = CAMINHO_REL . "grupo/include/resourceHTML/downsell.php?id=" . $idPlanoAcaoGrupo;
$ondeAtualiza = "#div_lista_downsell";
$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo;
?>

<fieldset>
	<legend>
		DownSell/Upselling
	</legend>
  <div class="menu_interno"><img src="<?php echo CAMINHO_IMG."novo.png";?>" title="cadastrar Downsell" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/downsell.php?idPlanoAcaoGrupo=$idPlanoAcaoGrupo"?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/downsell.php?id=".$idPlanoAcaoGrupo?>', '#div_downsell');" /></div>
  <div id="div_lista_downsell" class="lista">
    <table id="tb_lista_downsell" class="registros">
      <thead>
        <tr>
          <th>Tipo</th>
          <th>Data de Inicio</th>
          <th>Data de Termino</th>
           <th>Descrição</th>
           <th>Carga Antiga</th>
           <th>Carga Nova</th>
           <th>Upselling</th>
             <th>Status</th>
            <th></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Tipo</th>
          <th>Data de Inicio</th>
          <th>Data de Termino</th>
           <th>Descrição</th>
           <th>Carga Antiga</th>
           <th>Carga Nova</th>
           <th>Upselling</th>
            <th>Status</th>

            <th></th>
        </tr>
      </tfoot>
      <tbody>
        <?php 
	echo $Downsell->selectDownSellTr(CAMINHO_REL."grupo/include/form/downsell.php", CAMINHO_REL."grupo/include/resourceHTML/downsell.php?id=".$idPlanoAcaoGrupo, "#div_downsell", "WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND tipo IS NOT NULL ORDER BY idDownsell DESC");
	?>
      </tbody>
    </table>
  </div>
</fieldset>
<script>tabelaDataTable('tb_lista_downsell', 'ordenaColuna_simples');</script> 
