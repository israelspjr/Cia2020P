<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$AulaPermanenteGrupo = new AulaPermanenteGrupo();	

$idPlanoAcaoGrupo = $_GET['id'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Historico de dias de aula permanente</legend>
    <div class="lista">
      <table id="tb_lista_AulaPermanenteGrupo_historico" class="registros">
        <thead>
          <tr>
            <th>Dia</th>
            <th>Incio</th>
            <th>Saida</th>
            <th>Histórico professor</th>            
          </tr>
        </thead>
        <tbody>
        <?php 
		echo $AulaPermanenteGrupo->selectAulaPermanenteGrupoTr_historico(" AND planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo)?>
        </tbody>
        <tfoot>
          <tr>
            <th>Dia</th>
            <th>Incio</th>
            <th>Saida</th>
            <th>Histórico professor</th>           
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
</div>
<script>
tabelaDataTable('tb_lista_AulaPermanenteGrupo_historico');
</script>