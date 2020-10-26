<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RegistroDeAnotacoes = new RegistroDeAnotacoes();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

/*$idPlanoAcaoGrupo = $_GET['id'];

$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);	

$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);


for ($x=0;$x<count($ids);$x++) {
	$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
	
	$valorXP[] = $PlanoAcaoGrupo->getIdPlanoAcao($ids[$x]['idPlanoAcaoGrupo']);
}

$valorx2 = implode(', ',$valorX);

$valorx3 = implode(',', $valorXP);*/

//if ($idClientePj != '') {
	
	$where = " WHERE financeiro = 1 AND clientePj_idClientePj = ".$idClientePj;
	
//} else {
//$where = " WHERE financeiro = 1 AND (planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") OR planoAcao_idPlanoAcao in (".$valorx3."))";	
	
//}

?>

<fieldset>
  <legend>Registro de Anotações Financeiras</legend>
  <div class="menu_interno"><img src="<?php echo CAMINHO_IMG."novo.png";?>" title="cadastrar anotação" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePj/include/form/anotacoesFinanceiro.php";?>?idClientePj=<?php echo $idClientePj?>', '<?php echo CAMINHO_CAD."clientePj/include/resourceHTML/anotacoesFinanceiro.php?idClientePj=".$idClientePj?>', '#div_anotacoes_financeiro');" /></div>
  <div id="div_lista_anotacoes_financeiras" class="lista">
    <table id="tb_lista_anotacoes_financeiras" class="registros">
      <thead>
        <tr>
          <th></th>
          <th>Título</th>
          <th>Anotacao</th>
          <th>Data de abertura</th>
          <th>Data para novo contato</th>
          <th>Financeiro</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
	echo $RegistroDeAnotacoes->selectRegistroDeAnotacoesTr(CAMINHO_CAD."clientePj/include/form/anotacoesFinanceiro.php", CAMINHO_CAD."clientePj/include/resourceHTML/anotacoesFinanceiro.php?idClientePj=".$idClientePj, "#div_anotacoes_financeiro", $where, "&idClientePj=".$idClientePj);
	?>
      </tbody>
      <tfoot>
        <tr>
          <th></th>
          <th>Título</th>
          <th>Anotação</th>
          <th>Data de abertura</th>
          <th>Data para novo contato</th>
          <th>Financeiro</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
tabelaDataTable('tb_lista_anotacoes_financeiras', 'ordenaColuna');
</script> 
