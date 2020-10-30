<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcaoGrupo = new PlanoAcaoGrupo();	
$IntegranteGrupo = new IntegranteGrupo();	

$idPlanoAcaoGrupo = $_GET['id'];

$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);	

$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);


for ($x=0;$x<count($ids);$x++) {
	$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
}
//Uteis::pr($valorX);

$valorx2 = implode(', ',$valorX);
?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
<fieldset>
  <legend>Histórico de integrantes</legend>
 
  <div class="lista">
    <table id="tb_lista_AlunosGrupo_historico" class="registros">
      <thead>
        <tr>
          <th>Dia</th>
          <th>Incio</th>
          <th>Saida</th>
          <th>Saida do demonstrativo</th>
          <th>Notas</th>
          <th>Motivo da Saida</th>
          <th>Data para Retorno</th>
        </tr>
      </thead>
      <tbody>
        <?php 
		echo $IntegranteGrupo->selectIntegranteGrupoTr_historico(" AND planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.")")?>
      </tbody>
      <tfoot>
        <tr>
          <th>Dia</th>
          <th>Incio</th>
          <th>Saida</th>
          <th>Saida do demonstrativo</th>
          <th>Notas</th>
          <th>Motivo da Saida</th>
          <th>Data para Retorno</th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
</div>
<script>
tabelaDataTable('tb_lista_AlunosGrupo_historico');

function deletarDataSaida(x) {
var r = confirm("Tem certeza que deseka deletar essa data?");
if (r == true) {
	postForm('','<?php echo CAMINHO_REL.'grupo/include/acao/deletarDataSaida.php?id='?>'+x);
	
} else {
	return false;	
}
	
}
</script>