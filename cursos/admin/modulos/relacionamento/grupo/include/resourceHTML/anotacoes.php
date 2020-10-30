<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RegistroDeAnotacoes = new RegistroDeAnotacoes();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$idPlanoAcaoGrupo = $_GET['id'];

$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);	

$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);


for ($x=0;$x<count($ids);$x++) {
	$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
	
	$valorXP[] = $PlanoAcaoGrupo->getIdPlanoAcao($ids[$x]['idPlanoAcaoGrupo']);
}
//Uteis::pr($valorX);

$valorx2 = implode(', ',$valorX);

$valorx3 = implode(',', $valorXP);
?>

<fieldset>
  <legend>Registro de anotações</legend>
  <div class="menu_interno"><img src="<?php echo CAMINHO_IMG."novo.png";?>" title="cadastrar anotação" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/anotacoes.php";?>?idPlanoAcaoGrupo=<?php echo $idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/anotacoes.php?id=".$idPlanoAcaoGrupo?>', '#div_anotacoes');" /></div>
  <div id="div_lista_anotacoes" class="lista">
    <table id="tb_lista_anotacoes" class="registros">
      <thead>
        <tr>
          <th></th>
          <th>Título</th>
             <th>Anotação</th>
          <th>Data de abertura</th>
          <th>Data para novo contato</th>
          <th>Financeiro</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
	echo $RegistroDeAnotacoes->selectRegistroDeAnotacoesTr(CAMINHO_REL."grupo/include/form/anotacoes.php", CAMINHO_REL."grupo/include/resourceHTML/anotacoes.php?id=".$idPlanoAcaoGrupo, "#div_anotacoes", "WHERE financeiro = 0 AND (planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") OR planoAcao_idPlanoAcao in (".$valorx3."))", "&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo);
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
tabelaDataTable('tb_lista_anotacoes', 'ordenaColuna');
</script> 
